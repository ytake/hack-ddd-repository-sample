<?hh // strict

namespace Acme\Domain\Model\Article\Repository;

use type DateTime;
use type Acme\Domain\Model\Identifier;
use type Acme\Domain\Model\Article\Entity\Article;
use type Acme\Domain\Model\Article\Specification\SpecificationInterface;

interface ArticleRepositoryInterface<T> {

  public function add(T $article): void;

  public function remove(T $article): void;

  public function findById(int $id): T;

  public function latestArticles(DateTime $date): Map<int, T>;

  public function query(SpecificationInterface<T> $specification): Map<int, T>;

  public function size(): int;
}
