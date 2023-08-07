<?php
namespace Seonov\Attribute\Plugin\Checkout\Block\Checkout\AttributeMerger;

class Plugin
{
  public function afterMerge(\Magento\Checkout\Block\Checkout\AttributeMerger $subject, $result)
  {
    if (array_key_exists('street', $result)) {
      
      $result['street']['children'][0]['label'] = __('Street Address');
      $result['street']['children'][1]['label'] = __('Flat No/House No/Building No');
      $result['street']['children'][2]['placeholder'] = __('Landmark');
    }

    return $result;
  }
}
