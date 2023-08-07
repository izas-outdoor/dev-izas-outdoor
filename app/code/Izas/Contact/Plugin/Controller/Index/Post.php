<?php
namespace Izas\Contact\Plugin\Controller\Index;

use Magento\Framework\Phrase;
use Magento\Newsletter\Model\SubscriberFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Newsletter\Model\Subscriber;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Post
 * @package Izas\Contact\Plugin\Controller\Index
 */
class Post
{
    /**
     * @var SubscriberFactory
     */
    protected $subscriberFactory;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * Post constructor.
     * @param SubscriberFactory $subscriberFactory
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        SubscriberFactory $subscriberFactory,
        ManagerInterface $messageManager
    ) {
        $this->subscriberFactory = $subscriberFactory;
        $this->messageManager = $messageManager;
    }

    /**
     * @param \Magento\Contact\Controller\Index\Post $subject
     * @param $result
     * @return mixed
     * @throws LocalizedException
     */
    public function afterExecute(\Magento\Contact\Controller\Index\Post $subject, $result)
    {
        $request = $subject->getRequest();
        if ($request->getParam('is_subscribed')) {
            $email = $request->getParam('email');
            $subscriber = $this->subscriberFactory->create()->loadByEmail($email);
            if (!$subscriber->getId()) {
                $status = (int) $subscriber->subscribe($email);
                $this->messageManager->addSuccessMessage($this->getSuccessMessage($status));
            }
        }

        return $result;
    }

    /**
     * @param int $status
     * @return \Magento\Framework\Phrase
     */
    private function getSuccessMessage(int $status) : Phrase
    {
        if ($status === Subscriber::STATUS_NOT_ACTIVE) {
            return __('The confirmation request has been sent.');
        }

        return __('Thank you for your subscription.');
    }
}