<?hh // strict

namespace Acme\Domain\Model\Article\Repository;

use type DateTime;
use type Acme\Domain\Model\Article\Specification\SpecificationInterface;

interface ArticleRepositoryInterface<TId, T> {

  public function add(T $article): void;

  public function remove(T $article): void;

  public function findById(TId $id): T;

  public function latestArticles(DateTime $date): Map<TId, T>;

  public function query(SpecificationInterface<T> $specification): Map<TId, T>;

  public function size(): int;
}
