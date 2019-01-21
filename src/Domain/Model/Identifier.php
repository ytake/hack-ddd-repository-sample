<?hh // strict

namespace Acme\Domain\Model;

abstract class Identifier<T> {

  public function __construct(
    private T $id
  ) {}

  <<__Rx>>
  public function id(): T {
    return $this->id;
  }

  <<__Rx>>
  public function equals(Identifier<T> $id): bool {
    return $this->id === $id->id();
  }
}
