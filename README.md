# Ukrainian Addresses (Українські адреси)

## Library info
All address was take from official site of 'УкрПошта' https://ukrposhta.ua/dovidnik-poshtovix-adre/opis
The library doesn`t contains the addresses of the occupied territories.

## Installation

Run command `composer require romix/ukrainian-addresses`

## Using

Example to get Address tree.

```php
$provider = new AddressProvider();
$address = [
  'region' => 'Львівська',
  'district' => 'Львів',
  'settlement' => 'Львів',
  'street' => 'вул. Героїв УПА',
  'house' => '73',
];
$result = $provider->getAddressTree($address);
```
Variable result contain array with:
* regions - all regions of Ukraine
* districts - all districts of region
* settlement - all settlement of district
* street - all streets of settlement
* house - all houses of street
* index - zip-code of this address

## Author

Author of library is Romix
http://github.com/romixua

If you have any suggestions, questions, remarks, or found a bug, please write me romixua@ukr.net
