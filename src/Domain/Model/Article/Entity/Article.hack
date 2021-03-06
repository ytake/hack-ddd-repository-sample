namespace Acme\Domain\Model\Article\Entity;

use type DateTime;
use type Acme\Domain\Model\EntityInterface;
use type Acme\Domain\Model\Article\ArticleId;
use type Acme\Domain\Model\Article\Body;

class Article<T> implements EntityInterface<T> {

  const int EXPIRE_EDIT_TIME = 120;

  public function __construct(
    private ArticleId<T> $id,
    private Body $body,
    private DateTime $createdAt = new DateTime()
  ) {}

  public function updateBody(Body $body): void {
    if ($this->isExpired()) {
      throw new \RuntimeException('Edit time expired');
    }
    $this->body = $body;
  }

  private function isExpired(): bool {
    $expiringTime = $this->createdAt->getTimestamp() + self::EXPIRE_EDIT_TIME;
    return $expiringTime < \time();
  }

  <<__Rx>>
  public function getID(): T {
    return $this->id->id();
  }

  <<__Rx>>
  public function body(): Body {
    return $this->body;
  }

  <<__Rx>>
  public function createdAt(): DateTime {
    return $this->createdAt;
  }
}
