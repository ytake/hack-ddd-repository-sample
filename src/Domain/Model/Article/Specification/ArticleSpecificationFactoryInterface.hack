namespace Acme\Domain\Model\Article\Specification;

use type DateTime;
use type Acme\Domain\Support\SpecificationInterface;

interface ArticleSpecificationFactoryInterface<T> {

  public function createLatestPosts(
    DateTime $since
  ): SpecificationInterface<T>;
}
