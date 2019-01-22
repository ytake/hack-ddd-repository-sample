<?hh // strict

namespace Acme\Domain\Support;


interface RepositoryInterface<TId, T> {

  public function add(T $article): void;

  public function remove(T $article): void;

  public function findById(TId $id): T;

  public function query(SpecificationInterface<T> $specification): Map<TId, T>;

  public function size(): int;
}
