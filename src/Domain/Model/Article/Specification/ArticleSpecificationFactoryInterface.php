<?hh // strict

namespace Acme\Domain\Model\Article\Specification;

use type DateTime;

interface ArticleSpecificationFactoryInterface<T> {

  public function createLatestPosts(
    DateTime $since
  ): SpecificationInterface<T>;
}
