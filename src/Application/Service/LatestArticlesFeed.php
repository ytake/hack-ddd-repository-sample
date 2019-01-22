<?hh // strict

namespace Acme\Application\Service;

use namespace HH\Lib\{Vec, C};
use type Acme\Application\FeedRequestTransfer;
use type Acme\Domain\Model\Article\Entity\Article;
use type Acme\Domain\Model\Article\Repository\ArticleRepositoryInterface as Repository;
use type Acme\Domain\Model\Article\Specification\ArticleSpecificationFactoryInterface as SpecificationFactory;

final class LatestArticleFeed {

  public function __construct(
    private Repository<int, Article<int>> $repository,
    private SpecificationFactory<Article<int>> $specificationFactory
  ) {}

  public function execute(
    FeedRequestTransfer $request
  ): vec<shape('id' => int, 'content' => string, 'created_at' => \DateTime)> {
    $result = $this->repository->query(
      $this->specificationFactory->createLatestPosts($request->getDateTime())
    );
    if(C\count($result)) {
      return Vec\map($result, ($v) ==> {
        return shape(
            'id' => $v->getID(),
            'content' => $v->body()->content(),
            'created_at' => $v->createdAt()
        );
      });
    }
    return vec[];
  }
}
