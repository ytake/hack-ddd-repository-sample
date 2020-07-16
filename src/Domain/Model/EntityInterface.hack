namespace Acme\Domain\Model;

interface EntityInterface<T> {

  public function getID(): T;
}
