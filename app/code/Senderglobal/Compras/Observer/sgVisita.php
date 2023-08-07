<?php
namespace Senderglobal\Compras\Observer;

use Magento\Framework\Event\ObserverInterface;

class sgVisita implements ObserverInterface
{
	protected $request;
	protected $sessionManager;

	public function __construct(\Magento\Framework\App\Request\Http $request, \Magento\Framework\Session\SessionManagerInterface $sessionManager)
	{
       $this->request = $request;
	   
	   $this->sessionManager = $sessionManager;
    }
	
	public function execute(\Magento\Framework\Event\Observer $observer)
	{
		$utm_source = $this->request->getParam('utm_source');
		
		if($utm_source == 'Senderglobal')
		{
			$utm_campaign = $this->request->getParam('utm_campaign');
			
			$this->sessionManager->unsSgCampaign();
			$this->sessionManager->setSgCampaign($utm_campaign);
		}
	}
}