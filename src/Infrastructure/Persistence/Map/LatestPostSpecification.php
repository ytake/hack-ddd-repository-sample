<?hh // strict

namespace Acme\Infrastructure\Persistence\Map;

use type DateTime;
use type Acme\Domain\Model\Article\Entity\Article;
use type Acme\Domain\Support\SpecificationInterface;

class LatestPostSpecification implements SpecificationInterface<Article<int>> {

  public function __construct(
    private DateTime $since
  ) {}

  <<__Rx>>
  public function isSatisfiedBy(Article<int> $article): bool {
    return $article->createdAt() > $this->since;
  }
}
