<?php
namespace Biztech\Translator\Ui\Component\Listing\Grid\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
 
class Action extends Column
{
    const ROW_EDIT_URL = 'translator/cron/masstranslateinmultistoredetail';
    protected $_urlBuilder;
    private $_detailUrl;
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::ROW_EDIT_URL
    ) 
    {
        $this->_urlBuilder = $urlBuilder;
        $this->_detailUrl = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->_urlBuilder->getUrl(
                            $this->_detailUrl,
                            ['id' => $item['id']]
                        ),
                        'label' => __('View Detail'),
                    ];
                }
            }
        }
        return $dataSource;
    }
}