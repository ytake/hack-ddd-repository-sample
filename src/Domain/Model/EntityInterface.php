<?hh // strict

namespace Acme\Domain\Model;

<<__Sealed(Article\Entity\Article::class)>>
interface EntityInterface<T> {

  public function getID(): Identifier<T>;

}
