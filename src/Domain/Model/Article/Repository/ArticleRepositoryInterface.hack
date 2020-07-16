namespace Acme\Domain\Model\Article\Repository;

use type DateTime;
use type Acme\Domain\Support\RepositoryInterface;

interface ArticleRepositoryInterface<TId as arraykey, T> 
  extends RepositoryInterface<TId, T> {

  public function latestArticles(
    DateTime $date
  ): Map<TId, T>;
}
