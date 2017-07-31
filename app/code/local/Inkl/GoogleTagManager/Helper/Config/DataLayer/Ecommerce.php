<?php

class Inkl_GoogleTagManager_Helper_Config_DataLayer_Ecommerce extends Inkl_GoogleTagManager_Helper_Config_General
{
	const XML_PATH_DETAIL = 'inkl_googletagmanager/datalayer_ecommerce/detail';
	const XML_PATH_CART = 'inkl_googletagmanager/datalayer_ecommerce/cart';
	const XML_PATH_PURCHASE = 'inkl_googletagmanager/datalayer_ecommerce/purchase';

	public function isDetailEnabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ? Mage::getStoreConfigFlag(self::XML_PATH_DETAIL, $storeId) : false);
	}

	public function isCartEnabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ? Mage::getStoreConfigFlag(self::XML_PATH_CART, $storeId) : false);
	}

	public function isPurchaseEnabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ? Mage::getStoreConfigFlag(self::XML_PATH_PURCHASE, $storeId) : false);
	}
}
