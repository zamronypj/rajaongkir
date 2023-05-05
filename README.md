# RajaOngkir

[RajaOngkir API](https://rajaongkir.com) PHP client

- Support all kind of RajaOngkir account (Starter, Basic, Pro).
- Get shipping cost based on weight (gram) and/or volume (width x heigth x length).

This is [original RajaOngkir library](https://github.com/steevenz/rajaongkir) fork  with goal to add
PHP 8.0 support also replace HTTP Client with Guzzle.

## Requirements

- PHP >= 7.4, PHP >= 8.0
- [Composer](https://getcomposer.org)
- [Guzzle](https://docs.guzzlephp.org/en/stable/index.html)


## Installation

```
$ composer require juhara/rajaongkir
```
## Usage

### Initialization

Create instance for Starter account
```php
use Juhara\Rajaongkir;

$rajaongkir = new Rajaongkir('YOUR_API_KEY');
```

Create instance for Basic account
```php
use Juhara\Rajaongkir;

$rajaongkir = new Rajaongkir('YOUR_API_KEY', Rajaongkir::ACCOUNT_BASIC);
```

Create instance for Pro account
```php
use Juhara\Rajaongkir;

$rajaongkir = new Rajaongkir('YOUR_API_KEY', Rajaongkir::ACCOUNT_PRO);
```

### Get list of provinces

```php
use Juhara\Rajaongkir;

$rajaongkir = new Rajaongkir('YOUR_API_KEY', Rajaongkir::ACCOUNT_STARTER);
$provinces = $rajaongkir->getProvinces();

```

### Get detail of a province

```php
// province ID = 1
$province = $rajaongkir->getProvince(1);
```

### Get list of all cities

```php
$cities = $rajaongkir->getCities();
```

### Get list of cities in a province

```php
// province id = 1
$cities = $rajaongkir->getCities(1);
```

### Get city detail

```php
// city id = 1
$city = $rajaongkir->getCity(1);
```

### Get list of subdistricts in a city

```php
// city id = 39
$subdistricts = $rajaongkir->getSubdistricts(39);
```

### Get subdistrict detail

```php
// subdistrict id = 537
$subdistrict = $rajaongkir->getSubdistrict(537);
```

### Get list all cities with international shipping support

```php
// not available for starter
$internationalOrigins = $rajaongkir->getInternationalOrigins();
```

### Get list all cities  in a province with international shipping support

```php
// not available for starter
// province id = 6
$internationalOrigins = $rajaongkir->getInternationalOrigins(6);
```

### Get international origin detail

```php
// not available for starter
// city id = 152
// province id = 6
$internationalOrigin = $rajaongkir->getInternationalOrigin(152, 6);
```

### Get international country list

```php
// not available for starter
$internationalDestinations = $rajaongkir->getInternationalDestinations();
```

### Get international destination detail

```php
// not available for starter
// country id = 108
$internationalDestination = $rajaongkir->getInternationalDestination(108);
```

### Get shipping cost based on weight (in gram)

```php
// origin city id = 501
// destination subdistrict  id = 574
// weight 1000 gram
// courier = 'jne'
$cost = $rajaongkir->getCost(['city' => 501], ['subdistrict' => 574], 1000, 'jne');
```

### Get shipping cost based on volume

```php
// origin city id = 501
// destination subdistrict  id = 574
// volume 50x60x70
// courier = 'jne'
$cost = $rajaongkir->getCost(
    ['city' => 501],
    ['subdistrict' => 574],
    [
        'width'  => 50,
        'height' => 60,
        'length' => 70,
    ],
    'jne'
);
```

### Get shipping cost based on weight or volume

```php
// origin city id = 501
// destination subdistrict  id = 574
// weight 1000 gram
// volume 50x60x70
// courier = 'jne'
$cost = $rajaongkir->getCost(
    ['city' => 501],
    ['subdistrict' => 574],
    [
        'weight' => 1000,
        'length' => 50,
        'width'  => 50,
        'height' => 50,
    ],
    'jne'
);
```

### Get international shipping cost based on weight

```php
// not available for starter
// origin city id = 152
// destination country id = 108
// weight 1400 gram
// courier = 'pos'
$cost = $rajaongkir->getCost(
    ['city' => 152],
    ['country' => 108],
    1400,
    'pos'
);
```

### Track shipping

```php
// receipt id (no resi pengiriman) = 'SOCAG00183235715'
// courier = 'jne'
 $waybill = $rajaongkir->getWaybill('SOCAG00183235715', 'jne');
```

### Get IDR currency exchange to USD

```php
 $currency = $rajaongkir->getCurrency();
```

### Get latest error

```php
// get latest error
 if(false === ($waybill = $rajaongkir->getWaybill('SOCAG00183235715', 'jne'))) {
    var_dump($rajaongkir->getErrors());
 }
```

### Get courier list based on account type

```php
 $supportedCouriers = $rajaongkir->getSupportedCouriers();
```

### Get waybill tracking list based on account type
```php
 $supportedWayBills = $rajaongkir->getSupportedWayBills();
```


