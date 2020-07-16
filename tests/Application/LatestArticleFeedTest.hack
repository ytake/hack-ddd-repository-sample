use type DateTime;
use type Acme\Domain\Model\Article\ArticleId;
use type Acme\Domain\Model\Article\Body;
use type Acme\Domain\Model\Article\Entity\Article;
use type Facebook\HackTest\HackTest;
use namespace Acme\Application;
use namespace Acme\Infrastructure\Persistence\Map;
use function Facebook\FBExpect\expect;

final class LatestArticleFeedTest extends HackTest {

  <<__LateInit>> private Application\Service\LatestArticleFeed $service;
  <<__LateInit>> private Map\ArticleRepository $repository;

  <<__Override>>
  public async function beforeEachTestAsync(): Awaitable<void> {
    $this->repository = new Map\ArticleRepository();
    $this->service = new Application\Service\LatestArticleFeed(
      $this->repository,
      new Map\ArticleSpecificationFactory()
    );
  }

  public function testShouldReturnArticles(): void {
    $temporary = $this->registerArticle(1, 'hello Hack', '-2 hours');
    $this->registerArticle(2, 'hello PHP', '-3 hours');
    $this->registerArticle(3, 'hello Sendai', '-5 hours');
    expect($this->repository->size())
      ->toBeSame(3,);
    $article = new ArticleId(1);
    expect($this->repository->findById($article->id()))
      ->toBeSame($temporary);
  }

  public function testShouldReturnVecArticle(): void {
    $temporary = $this->registerArticle(1, 'hello Hack', '-2 hours');
    $this->registerArticle(2, 'hello PHP', '-3 hours');
    $this->registerArticle(3, 'hello Sendai', '-5 hours');

    $result = $this->service->execute(new Application\FeedRequestTransfer(darray[
      'datetime' => new DateTime('-4 hours'),
    ]));
    expect(count($result))
      ->toBeSame(2,);
    if ($result is vec<_>) {
      $row = $result[0];
      expect(Shapes::idx($row, 'id'))->toBeSame(1);
      expect(Shapes::idx($row, 'content'))->toBeSame('hello Hack');
    }
  }

  public function testShouldThrow(): void {
    expect(() ==> $this->service->execute(new Application\FeedRequestTransfer(darray[
      'datetime' => 1234,
    ])))->toThrow(TypeAssertionException::class);
  }

  private function registerArticle(
    int $id,
    string $body,
    string $datetimeString
  ): Article<int> {
    $article = new Article(new ArticleId($id), new Body($body), new DateTime($datetimeString));
    $this->repository->add($article);
    return $article;
  }
}
