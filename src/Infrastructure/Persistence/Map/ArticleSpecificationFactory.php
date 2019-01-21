<?hh // strict

namespace Acme\Infrastructure\Persistence\Map;

use type DateTime;
use namespace Acme\Domain\Model\Article\Specification;

final class ArticleSpecificationFactory
  implements Specification\ArticleSpecificationFactoryInterface {

  public function createLatestPosts(
    DateTime $since
  ): Specification\SpecificationInterface {
    return new LatestPostSpecification($since);
  }
}
