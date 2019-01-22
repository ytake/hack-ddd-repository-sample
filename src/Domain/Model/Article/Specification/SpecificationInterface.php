<?hh // strict

namespace Acme\Domain\Model\Article\Specification;

interface SpecificationInterface<T> {
  <<__Rx>>
  public function isSatisfiedBy(T $entity): bool;
}
