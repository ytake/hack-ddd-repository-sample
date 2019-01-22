<?hh // strict

namespace Acme\Infrastructure\Persistence\Map;

use type DateTime;
use type Acme\Domain\Model\Identifier;
use type Acme\Domain\Model\Article\ArticleId;
use type Acme\Domain\Model\Article\Entity\Article;
use type Acme\Domain\Model\Article\Specification\SpecificationInterface;
use type Acme\Domain\Model\Article\Repository\ArticleRepositoryInterface;

class ArticleRepository implements ArticleRepositoryInterface<Article> {

  private Map<int, Article> $collect = Map{};

  public function add(Article $article): void {
    $this->collect->add(Pair{$article->getID()->id(), $article});
  }

  public function remove(Article $article): void {
    $this->collect->remove($article->getID()->id());
  }

  <<__Rx>>
  public function findById(int $id): Article {
    if($this->collect->contains($id)) {
      return $this->collect->at($id);
    }
    throw new \RuntimeException('Not Found.');
  }

  <<__Rx>>
  public function latestArticles(DateTime $date): Map<int, Article> {
    return $this->collect->filter(
      $v ==> $v->createdAt() > $date
    );
  }

  <<__Rx>>
  public function query(
    SpecificationInterface<Article> $specification
  ): Map<int, Article> {
    return $this->collect->filter(
      $v ==> $specification->isSatisfiedBy($v)
    );
  }

  <<__Rx>>
  public function size(): int {
    return $this->collect->count();
  }
}
