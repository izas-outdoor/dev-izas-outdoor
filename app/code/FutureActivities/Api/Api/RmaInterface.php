<?php
namespace FutureActivities\Api\Api;
 
interface RmaInterface
{
  
   
   /**
    * Returns a list of available downloads for a customer
    *
    * @api
    * @param string $from
    * @param string $to
    * @return string
    */
   public function getRmaList($from,$to);

      
   /**
    * Modify status rma
    *
    * @api
    * @param string $idRma
    * @return null
    */
    public function modifyRma($idRma);
}