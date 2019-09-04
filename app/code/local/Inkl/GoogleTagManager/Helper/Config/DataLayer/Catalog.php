<?php

class Inkl_GoogleTagManager_Helper_Config_DataLayer_Catalog extends Inkl_GoogleTagManager_Helper_Config_General
{
	const XML_PATH_CATEGORY_NAME = 'inkl_googletagmanager/datalayer_catalog/category_name';
	const XML_PATH_CATEGORY_PRODUCTS = 'inkl_googletagmanager/datalayer_catalog/category_products';
	const XML_PATH_SEARCH_KEYWORD = 'inkl_googletagmanager/datalayer_catalog/search_keyword';
	const XML_PATH_SEARCH_PRODUCTS = 'inkl_googletagmanager/datalayer_catalog/search_products';
	const XML_PATH_SEARCH_NUM_RESULTS = 'inkl_googletagmanager/datalayer_catalog/search_num_results';
	const XML_PATH_CART_PRODUCTS = 'inkl_googletagmanager/datalayer_catalog/cart_products';

	public function isCategoryNameEnabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ? Mage::getStoreConfigFlag(self::XML_PATH_CATEGORY_NAME, $storeId) : false);
	}

	public function isCategoryProductsEnabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ? Mage::getStoreConfigFlag(self::XML_PATH_CATEGORY_PRODUCTS, $storeId) : false);
	}

	public function isSearchKeywordEnabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ? Mage::getStoreConfigFlag(self::XML_PATH_SEARCH_KEYWORD, $storeId) : false);
	}

	public function isSearchProductsEnabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ? Mage::getStoreConfigFlag(self::XML_PATH_SEARCH_PRODUCTS, $storeId) : false);
	}

	public function isSearchNumResultsEnabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ? Mage::getStoreConfigFlag(self::XML_PATH_SEARCH_NUM_RESULTS, $storeId) : false);
	}

	public function isCartProductsEnabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ? Mage::getStoreConfigFlag(self::XML_PATH_CART_PRODUCTS, $storeId) : false);
	}

}
