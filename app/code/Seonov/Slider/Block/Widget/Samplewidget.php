<?php

namespace Seonov\Slider\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Samplewidget extends Template implements BlockInterface
{
    protected $resourceCollection;
    protected $_template = "widget/sliderwidget.phtml";
    public function __construct(
         \Seonov\Slider\Model\SeonovsliderFactory $resourceCollection,
           \Magento\Catalog\Block\Product\Context $context,
         array $data = []
     ) {
         $this->resourceCollection = $resourceCollection;
         parent::__construct($context, $data);
     }
    public function getSliderImage(){
      $collection = $this->resourceCollection->create()->getCollection()->setOrder('id','DESC')->getData();
      return $collection;
    }


}
