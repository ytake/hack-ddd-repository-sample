<?hh // strict

namespace Acme\Domain\Model\Article\Repository;

use type DateTime;
use type Acme\Domain\Model\Identifier;
use type Acme\Domain\Model\Article\Entity\Article;
use type Acme\Domain\Model\Article\Specification\SpecificationInterface;

interface ArticleRepositoryInterface<T> {

  public function add(Article<T> $article): void;

  public function remove(Article<T> $article): void;

  public function findById(Identifier<T> $id): Article<T>;

  public function latestArticles(DateTime $date): Map<T, Article<T>>;

  public function query(SpecificationInterface $specification): Map<T, Article<T>>;

  public function size(): int;
}
