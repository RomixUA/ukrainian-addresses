<?php

namespace Romix\UkrainianAddresses;

interface AddressProviderInterface {

  /**
   * Get address tree.
   *
   * @param array $address
   *   Address parts.
   *
   * @return array
   *   Address tree.
   */
  public function getAddressTree(array $address);

}