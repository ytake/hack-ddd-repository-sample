<?hh // strict

namespace Acme\Domain\Model\Article;

use namespace HH\Lib\Str;
use function trim;

final class Body {
  const int MIN_LENGTH = 3;
  const int MAX_LENGTH = 250;

  public function __construct(
    private string $content
  ) {
    $this->setContent(Str\trim($content));
  }

  private function setContent(string $content): void {
    $this->assertNotEmpty($content);
    $this->assertFitsLength($content);
    $this->content = $content;
  }

  <<__Rx>>
  private function assertNotEmpty(string $content): void {
    if (Str\is_empty($content)) {
      throw new \DomainException('Empty body');
    }
  }

  <<__Rx>>
  private function assertFitsLength(string $content): void {
    if (Str\length($content) < self::MIN_LENGTH) {
      throw new \DomainException('Body is too sort');
    }

    if (Str\length($content) > self::MAX_LENGTH) {
      throw new \DomainException('Body is too long');
    }
  }

  <<__Rx>>
  public function content(): string {
    return $this->content;
  }
}
