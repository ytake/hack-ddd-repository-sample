<?hh // strict

namespace Acme\Infrastructure\Persistence\Map;

use type DateTime;
use type Acme\Domain\Model\Article\Entity\Article;
use type Acme\Domain\Model\Article\Specification\SpecificationInterface;

class LatestPostSpecification implements SpecificationInterface {

  public function __construct(
    private DateTime $since
  ) {}

  <<__Rx>>
  public function isSatisfiedBy<T>(Article<T> $article): bool {
    return $article->createdAt() > $this->since;
  }
}
