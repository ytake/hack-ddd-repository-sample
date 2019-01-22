<?hh // strict

namespace Acme\Infrastructure\Persistence\Map;

use type DateTime;
use type Acme\Domain\Model\Article\Entity\Article;
use type Acme\Domain\Support\SpecificationInterface;
use type Acme\Domain\Model\Article\Specification\ArticleSpecificationFactoryInterface;

final class ArticleSpecificationFactory
  implements ArticleSpecificationFactoryInterface<Article<int>> {

  public function createLatestPosts(
    DateTime $since
  ): SpecificationInterface<Article<int>> {
    return new LatestPostSpecification($since);
  }
}
