<?php


namespace Metagento\Faq\Controller\Adminhtml\Category;

use \Magento\Framework\App\Filesystem\DirectoryList;

class SampleDownload extends
    \Metagento\Faq\Controller\Adminhtml\AbstractController
{
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Metagento\Faq\Model\FaqFactory $faqFactory,
        \Metagento\Faq\Model\CategoryFactory $categoryFactory,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory
    ) {
        $this->_fileSystem  = $filesystem;
        $this->_fileFactory = $fileFactory;
        parent::__construct($context, $faqFactory, $categoryFactory, $pageFactory, $registry, $resultLayoutFactory);
    }

    public function execute()
    {
        $name = "import_category_sample.csv";
        $this->_fileSystem->getDirectoryWrite(DirectoryList::VAR_DIR)->create('import');
        $filename = DirectoryList::VAR_DIR . '/import/' . $name;
        $stream   = $this->_fileSystem->getDirectoryWrite(DirectoryList::VAR_DIR)
                                      ->openFile($filename, 'w+');
        $stream->lock();
        $data = array(
            array('CATEGORY NAME', 'URL_KEY', 'STORE_CODE', 'SORT_ORDER', 'META_KEYWORDS', 'META_DESCRIPTION'),
        );
        $data = array_merge($data, $this->sampleData());
        foreach ( $data as $row ) {
            $stream->writeCsv($row);
        }
        $stream->unlock();
        $stream->close();


        return $this->_fileFactory->create(
            'import_category_sample.csv',
            array(
                'type'  => 'filename',
                'value' => $filename,
                'rm'    => true
            ),
            DirectoryList::VAR_DIR
        );
    }

    public function sampleData()
    {
        return array(
            array('Category 1', 'category-1', 'default', '1', 'keywords', 'description'),
            array('Category 2', 'category-2', 'default', '2', 'keywords', 'description'),
        );
    }

}