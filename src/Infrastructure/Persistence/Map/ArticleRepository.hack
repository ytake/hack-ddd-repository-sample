namespace Acme\Infrastructure\Persistence\Map;

use type DateTime;
use type Acme\Domain\Model\Article\Entity\Article;

class ArticleRepository extends BaseRepository<int, Article<int>> {

  <<__Rx>>
  public function latestArticles(DateTime $date): Map<int, Article<int>> {
    return $this->collect->filter(
      $v ==> $v->createdAt() > $date
    );
  }
}
