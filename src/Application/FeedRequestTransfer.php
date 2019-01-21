<?hh // strict

namespace Acme\Application;

use type DateTime;

type FeedRequest = shape(
  'datetime' => DateTime
);

final class FeedRequestTransfer {

  public function __construct(
    private FeedRequest $request
  ) {}

  public function getDateTime(): DateTime {
    return Shapes::idx($this->request, 'datetime', new DateTime());
  }
}
