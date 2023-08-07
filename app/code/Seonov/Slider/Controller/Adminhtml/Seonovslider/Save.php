<?php
namespace Seonov\Slider\Controller\Adminhtml\Seonovslider;
use Magento\Framework\App\Filesystem\DirectoryList;
class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
	public function execute()
    {

        $data = $this->getRequest()->getParams();
        if ($data) {
            $model = $this->_objectManager->create('Seonov\Slider\Model\Seonovslider');

           if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
										try {
											    $uploader = $this->_objectManager->create('Magento\MediaStorage\Model\File\Uploader', array('fileId' => 'image'));
												$uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
												$uploader->setAllowRenameFiles(true);
												$uploader->setFilesDispersion(true);
												$mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
													->getDirectoryRead(DirectoryList::MEDIA);
												//$config = $this->_objectManager->get('Magento\Bannerslider\Model\Banner');
												$result = $uploader->save($mediaDirectory->getAbsolutePath('bannerslider/images'));
												unset($result['tmp_name']);
												unset($result['path']);
												$data['sliderimage'] = $result['file'];
										} catch (Exception $e) {
											$data['sliderimage'] = $_FILES['image']['name'];
										}


			}
			else{
				$data['image'] = '';
			}
			if(isset($_FILES['mobileimage']['name']) && $_FILES['mobileimage']['name'] != '') {
							 try {
										 $uploader = $this->_objectManager->create('Magento\MediaStorage\Model\File\Uploader', array('fileId' => 'mobileimage'));
									 $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
									 $uploader->setAllowRenameFiles(true);
									 $uploader->setFilesDispersion(true);
									 $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
										 ->getDirectoryRead(DirectoryList::MEDIA);
									 //$config = $this->_objectManager->get('Magento\Bannerslider\Model\Banner');
									 $result = $uploader->save($mediaDirectory->getAbsolutePath('bannerslider/images'));
									 unset($result['tmp_name']);
									 unset($result['path']);
									 $data['mobileimage'] = $result['file'];
							 } catch (Exception $e) {
								 $data['mobileimage'] = $_FILES['mobileimage']['name'];
							 }


 }
 else{
	 $data['mobileimage'] = '';
 }

			$id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }
						if (@$data['slidermenbtn']){
							$data['slidermenbtn'] = 1;
						}
						if (@$data['sliderwomenbtn']){
							$data['sliderwomenbtn'] = 1;
						}
            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('The Frist Grid Has been Saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId(), '_current' => true));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (\Magento\Framework\Model\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the banner.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array('banner_id' => $this->getRequest()->getParam('banner_id')));
            return;
        }
        $this->_redirect('*/*/');
    }
}
