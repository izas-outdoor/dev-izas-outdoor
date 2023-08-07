<?php
namespace FutureActivities\Api\Model;

use Magento\Downloadable\Model\Link\Purchased\Item;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\App\ObjectManager;

class Rma implements \FutureActivities\Api\Api\RmaInterface
{
     
    protected $resourceConnection;
    public function __construct(Context $context, ResourceConnection $resourceConnection)
    {
        $this->resourceConnection = $resourceConnection;
    }
    
 
    
    /**
     * {@inheritdoc}
     */
    public function getRmaList($from,$to)
    {

        $connection = $this->resourceConnection->getConnection();
        // $table is table name
        $table = $connection->getTableName('wp_rma');
       
        //For Select query
        $desde = date('Y-m-d', strtotime($from));
        $hasta = date('Y-m-d', strtotime($to));
        $query = "Select id, order_id, customer_id, customer_name, customer_email, status_id, status_name, store_id, created_at, updated_at FROM " . $table." WHERE created_at >= '".$desde."' and created_at <= '".$hasta."'";
      //  return $query;
        $result = $connection->fetchAll($query);
        // revisar articulos de cada pedido 
        $tableItems = $connection->getTableName('wp_rma_item');
        $objeto = [];

        foreach($result as $resultado){

        /*
Select wp_rma_item.order_item_id, wp_rma_item.qty,  wp_rma_item.resolution,  wp_rma_item.item_condition, sales_order_item.product_id, sales_order_item.sku, sales_order_item.name  FROM wp_rma_item 
LEFT JOIN sales_order_item ON sales_order_item.item_id = wp_rma_item.id
WHERE rma_id =634
        */

            $queyItems = "Select wp_rma_item.order_item_id, wp_rma_item.qty,  wp_rma_item.resolution,  wp_rma_item.item_condition, sales_order_item.product_id, sales_order_item.sku, sales_order_item.name  FROM " . $tableItems." LEFT JOIN sales_order_item ON sales_order_item.item_id = wp_rma_item.order_item_id WHERE rma_id = ".$resultado['id']."";
       //    echo $queyItems;
           $resultItems = $connection->fetchAll($queyItems);

     //      print_r($resultado);
       //    print_r($resultItems);
        
           $objetoItems = [];
           foreach($resultItems as $items){

            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $product = $objectManager->create('Magento\Catalog\Model\Product')->load($items['product_id']);

                $name = $product->getName();
                $sku = $product->getSku();
            $objetoItems [] = array(
                "product_id" => $items['product_id'],
                "sku" => $items['sku'],
                "name" => $items['name'],
                "qty" => $items['qty'],
                "resolution" => $items['resolution'],
                "item_condition" => $items['item_condition'],
            );
           }
           $resultado['items'] = $objetoItems;
        
           $objeto [] = $resultado;
         
        }
  
        return $objeto;

        $purchased = $this->downloadLinksFactory->create()
            ->addFieldToFilter('customer_id', $customerId)
            ->addOrder('created_at', 'desc');
        
        $purchasedIds = [];
        foreach ($purchased as $_item) {
            $purchasedIds[] = $_item->getId();
        }
        
        $purchasedItems = $this->downloadItemsFactory->create()->addFieldToFilter('purchased_id', ['in' => $purchasedIds])
            ->addFieldToFilter('status', ['nin' => [Item::LINK_STATUS_PENDING_PAYMENT, Item::LINK_STATUS_PAYMENT_REVIEW]])
            ->setOrder('item_id', 'desc');
        
        $result = [];
      
            
        //return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyRma($idRma){
        $connection = $this->resourceConnection->getConnection();
        // $table is table name
        $table = $connection->getTableName('wp_rma');

        $data = ["status_id"=>"7"]; 
        $where = ['id = ?' => (int)$idRma];
 
        $connection->update($table, $data, $where);
    }
}