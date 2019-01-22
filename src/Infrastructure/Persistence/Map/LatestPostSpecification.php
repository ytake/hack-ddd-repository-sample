<?hh // strict

namespace Acme\Infrastructure\Persistence\Map;

use type DateTime;
use type Acme\Domain\Model\EntityInterface;
use type Acme\Domain\Model\Article\Entity\Article;
use type Acme\Domain\Model\Article\Specification\SpecificationInterface;

class LatestPostSpecification implements SpecificationInterface<Article> {

  public function __construct(
    private DateTime $since
  ) {}

  <<__Rx>>
  public function isSatisfiedBy(Article $article): bool {
    return $article->createdAt() > $this->since;
  }
}
