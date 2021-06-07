<?php
namespace Vendor\MegaMenu\Block;

use Magento\Cms\Block\Block as cmsBlock;
use Magento\Framework\App\Request\Http as request;

class Categories extends \Magento\Framework\View\Element\Template {

    protected $_categoryHelper;
    protected $_categoryFactory;
    protected $_catalogLayer;
    /** @var \Magento\Store\Model\Store */
    protected $_store;
    protected $_storeManager;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Catalog\Helper\Category $categoryHelper,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager, 
        \Magento\Store\Model\Store $store,
        array $data = []
    ) {
        $this->_categoryHelper = $categoryHelper;
        $this->_categoryFactory = $categoryFactory;
        $this->_storeManager = $storeManager;    
        $this->_store = $store;
        parent::__construct(
            $context,
            $data
        );
    }

    public function getWebsiteId()
    {
        return $this->_storeManager->getStore()->getWebsiteId();
    }


    public function getRootCategoryId()
    {
        $store = $this->getWebsiteId();
        $rootCatId = $this->_storeManager->getStore($store)->getRootCategoryId();
        return $rootCatId;
    }

    /**
     * Get children categories
     *
     * @param $categoryId Parent category id
     * @return Magento\Catalog\Model\ResourceModel\Category\Collection
     */
    public function getChildCategories($categoryId)
    {

        $_category = $this->_categoryFactory->create();

        $category = $_category->load($categoryId);

        //Get category collection
        $collection = $category->getCollection()
                ->addIsActiveFilter()
                ->addAttributeToFilter('include_in_menu', 1)
                ->addAttributeToSelect('*')
                ->setOrder('position','ASC')
                ->addIdFilter($category->getChildren());
        return $collection;
    }

  }
