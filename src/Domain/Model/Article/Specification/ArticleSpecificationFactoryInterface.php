<?hh // strict

namespace Acme\Domain\Model\Article\Specification;

use type DateTime;

interface ArticleSpecificationFactoryInterface {

  public function createLatestPosts(
    DateTime $since
  ): SpecificationInterface;
}
