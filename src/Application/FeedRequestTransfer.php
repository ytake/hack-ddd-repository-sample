<?hh // strict

namespace Acme\Application;

use type DateTime;

final class FeedRequestTransfer {
  
  const type FeedRequest = shape(
    'datetime' => DateTime
  );

  public function __construct(
    private array<arraykey, mixed> $request
  ) {}

  public function getDateTime(): DateTime {
    $request = $this->request as this::FeedRequest;
    return $request['datetime'];
  }
}
