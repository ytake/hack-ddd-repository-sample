<?hh // strict

namespace Acme\Infrastructure\Persistence\Map;

use type Acme\Domain\Model\EntityInterface;
use type Acme\Domain\Support\SpecificationInterface;
use type Acme\Domain\Model\Article\Repository\ArticleRepositoryInterface;

abstract class BaseRepository<TId, T as EntityInterface<TId>>
  implements ArticleRepositoryInterface<TId, T> {

  protected Map<TId, T> $collect = Map{};

  public function add(T $article): void {
    $this->collect->add(Pair{$article->getID(), $article});
  }

  public function remove(T $article): void {
    $this->collect->remove($article->getID());
  }

  <<__Rx>>
  public function findById(TId $id): T {
    if($this->collect->contains($id)) {
      return $this->collect->at($id);
    }
    throw new \RuntimeException('Not Found.');
  }

  <<__Rx>>
  public function query(
    SpecificationInterface<T> $specification
  ): Map<TId, T> {
    return $this->collect->filter(
      $v ==> $specification->isSatisfiedBy($v)
    );
  }

  <<__Rx>>
  public function size(): int {
    return $this->collect->count();
  }
}
