<?php

class Inkl_GoogleTagManager_Helper_Config_DataLayer_Ecommerce extends Mage_Core_Helper_Abstract
{
	const XML_PATH_DETAIL = 'inkl_googletagmanager/datalayer_ecommerce/detail';
	const XML_PATH_CART = 'inkl_googletagmanager/datalayer_ecommerce/cart';
	const XML_PATH_PURCHASE = 'inkl_googletagmanager/datalayer_ecommerce/purchase';

	public function isDetailEnabled($storeId = null)
	{
		return Mage::getStoreConfigFlag(self::XML_PATH_DETAIL, $storeId);
	}

	public function isCartEnabled($storeId = null)
	{
		return Mage::getStoreConfigFlag(self::XML_PATH_CART, $storeId);
	}

	public function isPurchaseEnabled($storeId = null)
	{
		return Mage::getStoreConfigFlag(self::XML_PATH_PURCHASE, $storeId);
	}
}
