<?hh // strict

namespace Acme\Domain\Model\Article\Specification;

use type Acme\Domain\Model\Article\Entity\Article;

interface SpecificationInterface {

  <<__Rx>>
  public function isSatisfiedBy<T>(Article<T> $entity): bool;
}
