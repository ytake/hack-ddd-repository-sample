<?hh // strict

namespace Acme\Domain\Support;

interface SpecificationInterface<T> {
  <<__Rx>>
  public function isSatisfiedBy(T $entity): bool;
}
