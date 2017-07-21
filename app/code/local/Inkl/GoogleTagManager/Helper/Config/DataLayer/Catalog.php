<?php

class Inkl_GoogleTagManager_Helper_Config_DataLayer_Catalog extends Mage_Core_Helper_Abstract
{
	const XML_PATH_CATEGORY_NAME = 'inkl_googletagmanager/datalayer_catalog/category_name';
	const XML_PATH_CATEGORY_PRODUCTS = 'inkl_googletagmanager/datalayer_catalog/category_products';
	const XML_PATH_SEARCH_KEYWORD = 'inkl_googletagmanager/datalayer_catalog/search_keyword';
	const XML_PATH_SEARCH_PRODUCTS = 'inkl_googletagmanager/datalayer_catalog/search_products';
	const XML_PATH_CART_PRODUCTS = 'inkl_googletagmanager/datalayer_catalog/cart_products';

	public function isCategoryNameEnabled($storeId = null)
	{
		return Mage::getStoreConfigFlag(self::XML_PATH_CATEGORY_NAME, $storeId);
	}

	public function isCategoryProductsEnabled($storeId = null)
	{
		return Mage::getStoreConfigFlag(self::XML_PATH_CATEGORY_PRODUCTS, $storeId);
	}

	public function isSearchKeywordEnabled($storeId = null)
	{
		return Mage::getStoreConfigFlag(self::XML_PATH_SEARCH_KEYWORD, $storeId);
	}

	public function isSearchProductsEnabled($storeId = null)
	{
		return Mage::getStoreConfigFlag(self::XML_PATH_SEARCH_PRODUCTS, $storeId);
	}

	public function isCartProductsEnabled($storeId = null)
	{
		return Mage::getStoreConfigFlag(self::XML_PATH_CART_PRODUCTS, $storeId);
	}

}
