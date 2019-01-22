<?hh // strict

namespace Acme\Infrastructure\Persistence\Map;

use type DateTime;
use type Acme\Domain\Model\Article\Entity\Article;
use namespace Acme\Domain\Model\Article\Specification;

final class ArticleSpecificationFactory
  implements Specification\ArticleSpecificationFactoryInterface<Article> {

  public function createLatestPosts(
    DateTime $since
  ): Specification\SpecificationInterface<Article> {
    return new LatestPostSpecification($since);
  }
}
