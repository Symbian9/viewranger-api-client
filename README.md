# ViewRanger API Client

A PHP client for the [ViewRanger Beacon API](http://www.viewranger.com/developers/)

### Get the latest Beacon

``` php
require_once('vendor/autoload.php');

use Symm\ViewRangerClient\ViewRangerClient;

$client     = ViewRangerClient::create('YOUR_API_KEY_HERE');
$lastBeacon = $client->getLastBeaconPosition('your-email@address.com', 1234);

print $beacon->getLocation();
print $beacon->getHeading();
print $beacon->getSpeed();
```

### Get Beacons between two given timestamps

``` php
$start   = new \DateTime('2014-08-11');
$end     = new \DateTime('2014-08-12');
$beacons = $client->getBeaconPositions('your-email@address.com', 1234, $start, $end);

foreach ($beacons as $beacon) {
    print $beacon->getLocation();
    print $beacon->getHeading();
    print $beacon->getSpeed();
}
```
