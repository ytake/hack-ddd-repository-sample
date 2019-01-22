<?hh // strict

namespace Acme\Domain\Model\Article\Specification;

use type Acme\Domain\Model\Article\Entity\Article;
use type Acme\Domain\Model\EntityInterface;

interface SpecificationInterface<T> {
  <<__Rx>>
  public function isSatisfiedBy(T $entity): bool;
}
