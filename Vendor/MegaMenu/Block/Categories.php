<?php
namespace Vendor\MegaMenu\Block;

class Categories extends \Magento\Framework\View\Element\Template {

    protected $_categoryHelper;
    protected $_categoryFactory;
    protected $_catalogLayer;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,     
        \Magento\Catalog\Helper\Category $categoryHelper,     
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,   
        array $data = []
    ) {
        $this->_categoryHelper = $categoryHelper;   
        $this->_categoryFactory = $categoryFactory;
        parent::__construct(
            $context,          
            $data
        );
    }

    /**
     * Retrieve current store level 2 category
     *
     * @param bool|string $sorted (if true display collection sorted as name otherwise sorted as based on id asc)
     * @param bool $asCollection (if true display all category otherwise display second level category menu visible category for current store)
     * @param bool $toLoad
     */

    public function getStoreCategories($sorted = false, $asCollection = false, $toLoad = true)
    {
        return $this->_categoryHelper->getStoreCategories($sorted , $asCollection, $toLoad);
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
                ->addOrderField('name')
                ->addIdFilter($category->getChildren());
        return $collection;
    }

  }
