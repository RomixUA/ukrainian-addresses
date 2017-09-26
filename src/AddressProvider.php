<?php

namespace Romix\UkrainianAddresses;

/**
 * Class AddressProvider
 *
 * @package Romix\UkrainianAddresses
 */
class AddressProvider implements AddressProviderInterface {

  /**
   * {@inheritdoc}
   */
  public function getAddressTree(array $address) {
    $result = [];
    $regions = json_decode(file_get_contents(__DIR__ . '/../address/regions.json'), TRUE);
    $result['regions'] = array_keys($regions);
    if (!empty($address['region']) && !empty($regions[$address['region']])) {
      $districts = json_decode(file_get_contents(__DIR__ . '/../address/' . $regions[$address['region']] . '/districts.json'), TRUE);
      $result['districts'] = array_keys($districts);
      if (!empty($address['district']) && !empty($districts[$address['district']])) {
        $settlements = json_decode(file_get_contents(__DIR__ . '/../address/' . $regions[$address['region']] . '/'. $districts[$address['district']] . '/settlements.json'), TRUE);
        $result['settlements'] = array_keys($settlements);
        if (!empty($address['settlement']) && !empty($settlements[$address['settlement']])) {
          $streets = json_decode(file_get_contents(__DIR__ . '/../address/' . $regions[$address['region']] . '/'. $districts[$address['district']] . '/' . $settlements[$address['settlement']] . '.json'), TRUE);
          $result['streets'] = array_keys($streets);
          if (!empty($address['street']) && !empty($streets[$address['street']])) {
            $houses = [];
            foreach ($streets[$address['street']] as $index => $houses_numbers) {
              $houses = array_merge($houses, $houses_numbers);
            }
            sort($houses);
            $result['houses'] = $houses;
            if (!empty($address['house'])) {
              if (count($streets[$address['street']]) == 1) {
                $result['index'] = !empty($index) ? $index : NULL;
              }
              else {
                foreach ($streets[$address['street']] as $index => $houses_numbers) {
                  if (in_array($address['house'], $houses_numbers)) {
                    $result['index'] = $index;
                  }
                  if (empty($result['index'])) {
                    $result['index'] = NULL;
                  }
                }
              }
            }
          }
        }
      }
    }

    return $result;
  }

}
