# RajaOngkir

[RajaOngkir API](https://rajaongkir.com) PHP client

- Support all kind of RajaOngkir account (Starter, Basic, Pro).
- Get shipping cost based on weight (gram) and/or volume (width x heigth x length).

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
```php
/*
 * --------------------------------------------------------------
 * Mendapatkan list seluruh kota yang mendukung pengiriman
 * ke Internasional di propinsi tertentu
 * (tidak tersedia untuk tipe account starter)
 *
 * @param int Province ID (optional)
 * --------------------------------------------------------------
 */
$internationalOrigins = $rajaongkir->getInternationalOrigins(6);

/*
 * --------------------------------------------------------------
 * Mendapatkan detail Origin Internasional
 * (tidak tersedia untuk tipe account starter)
 *
 * @param int City ID (optional)
 * @param int Province ID (optional)
 * --------------------------------------------------------------
 */
$internationalOrigin = $rajaongkir->getInternationalOrigin(152, 6);

/*
 * --------------------------------------------------------------
 * Mendapatkan list seluruh negara tujuan Internasional
 * (tidak tersedia untuk tipe account starter)
 * --------------------------------------------------------------
 */
$internationalDestinations = $rajaongkir->getInternationalDestinations();

/*
 * --------------------------------------------------------------
 * Mendapatkan detail tujuan Internasional
 * (tidak tersedia untuk tipe account starter)
 *
 * @param int Country ID
 * --------------------------------------------------------------
 */
$internationalDestination = $rajaongkir->getInternationalDestination(108);

/*
 * --------------------------------------------------------------
 * Mendapatkan harga ongkos kirim berdasarkan berat dalam gram
 *
 * @param array Origin
 * @param array Destination
 * @param int|array Weight|Metrics
 * @param string Courier
 * --------------------------------------------------------------
 */
$cost = $rajaongkir->getCost(['city' => 501], ['subdistrict' => 574], 1000, 'jne');

/*
 * --------------------------------------------------------------
 * Mendapatkan harga ongkos kirim berdasarkan volume metrics
 * atau berdasarkan ukuran panjang x lebar x tinggi
 *
 * Catatan:
 * Berat akan otomatis dihitung berdasarkan volume metrics.
 *
 * @param array Origin
 * @param array Destination
 * @param int|array Weight|Metrics
 * @param string Courier
 * --------------------------------------------------------------
 */
$cost = $rajaongkir->getCost(['city' => 501], ['subdistrict' => 574],
                    [
                        'length' => 50,
                        'width'  => 50,
                        'height' => 50,
                    ], 'jne');

/*
 * --------------------------------------------------------------
 * Mendapatkan harga ongkos kirim berdasarkan berat dalam gram
 * atau berdasarkan ukuran panjang x lebar x tinggi
 *
 * Catatan:
 * Jika ukuran menghasilkan berat yang lebih besar dari
 * berat yang didefinisikan, berat yang akan dipakai sebagai
 * kalkulasi ongkos kirim adalah berat berdasarkan volume metrics
 *
 * @param array Origin
 * @param array Destination
 * @param int|array Weight|Metrics
 * @param string Courier
 * --------------------------------------------------------------
 */
 $cost = $rajaongkir->getCost(['city' => 501], ['subdistrict' => 574],
                     [
                         'weight' => 1000,
                         'length' => 50,
                         'width'  => 50,
                         'height' => 50,
                     ], 'jne');

/*
 * --------------------------------------------------------------
 * Mendapatkan harga ongkos kirim international berdasarkan berat
 * dalam gram (tidak tersedia untuk tipe account starter)
 *
 * @param array Origin
 * @param array Destination
 * @param int|array Weight|Metrics
 * @param string Courier
 * --------------------------------------------------------------
 */
$cost = $rajaongkir->getCost(['city' => 152], ['country' => 108], 1400, 'pos');

/*
 * --------------------------------------------------------------
 * Melacak status pengiriman
 *
 * @param string Receipt ID (Nomor Resi Pengiriman)
 * @param string Courier
 * --------------------------------------------------------------
 */
 $waybill = $rajaongkir->getWaybill('SOCAG00183235715', 'jne');

/*
 * --------------------------------------------------------------
 * Mendapatkan informasi nilai tukar rupiah terhadap US dollar.
 * --------------------------------------------------------------
 */
 $currency = $rajaongkir->getCurrency();

/*
 * --------------------------------------------------------------
 * Melakukan debugging errors.
 * --------------------------------------------------------------
 */
 if(false === ($waybill = $rajaongkir->getWaybill('SOCAG00183235715', 'jne'))) {
    print_out($rajaongkir->getErrors());
 }

/*
 * --------------------------------------------------------------
 * Mendapatkan daftar courier yang didukung oleh tipe akun anda
 * --------------------------------------------------------------
 */
 $supportedCouriers = $rajaongkir->getSupportedCouriers();

/*
 * --------------------------------------------------------------
 * Mendapatkan daftar way bill courier yang didukung oleh tipe akun anda
 * --------------------------------------------------------------
 */
 $supportedWayBills = $rajaongkir->getSupportedWayBills();
```


