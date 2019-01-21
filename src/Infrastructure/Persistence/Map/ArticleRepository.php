<?hh // strict

namespace Acme\Infrastructure\Persistence\Map;

use type DateTime;
use type Acme\Domain\Model\Identifier;
use type Acme\Domain\Model\Article\ArticleId;
use type Acme\Domain\Model\Article\Entity\Article;
use type Acme\Domain\Model\Article\Specification\SpecificationInterface;
use type Acme\Domain\Model\Article\Repository\ArticleRepositoryInterface;

class ArticleRepository<T> implements ArticleRepositoryInterface<T> {

  private Map<T, Article<T>> $collect = Map{};

  public function add(Article<T> $article): void {
    $this->collect->add(Pair{$article->getID()->id(), $article});
  }

  public function remove(Article<T> $article): void {
    $this->collect->remove($article->getID()->id());
  }

  <<__Rx>>
  public function findById(Identifier<T> $id): Article<T> {
    if($this->collect->contains($id->id())) {
      return $this->collect->at($id->id());
    }
    throw new \RuntimeException('Not Found.');
  }

  <<__Rx>>
  public function latestArticles(DateTime $date): Map<T, Article<T>> {
    return $this->collect->filter(
      $v ==> $v->createdAt() > $date
    );
  }

  <<__Rx>>
  public function query(SpecificationInterface $specification): Map<T, Article<T>> {
    return $this->collect->filter(
      $v ==> $specification->isSatisfiedBy($v)
    );
  }

  <<__Rx>>
  public function size(): int {
    return $this->collect->count();
  }
}
