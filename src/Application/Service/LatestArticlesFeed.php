<?hh // strict

namespace Acme\Application\Service;

use namespace HH\Lib\{Vec, C};
use type Acme\Application\FeedRequestTransfer;
use Acme\Domain\Model\Article\Entity\Article;
use type Acme\Domain\Model\Article\Repository\ArticleRepositoryInterface;
use type Acme\Domain\Model\Article\Specification\ArticleSpecificationFactoryInterface;

final class LatestArticleFeed {

  public function __construct(
    private ArticleRepositoryInterface<Article> $repository,
    private ArticleSpecificationFactoryInterface<Article> $specificationFactory
  ) {}

  public function execute(
    FeedRequestTransfer $request
  ): vec<shape('id' => int, 'content' => string, 'created_at' => \DateTime)> {
    $result = $this->repository->query(
      $this->specificationFactory->createLatestPosts($request->getDateTime())
    );
    if(C\count($result)) {
      return Vec\map_with_key($result, ($_, $v) ==> {
        return shape(
            'id' => $v->getID()->id(),
            'content' => $v->body()->content(),
            'created_at' => $v->createdAt()
        );
      });
    }
    return vec[];
  }
}
