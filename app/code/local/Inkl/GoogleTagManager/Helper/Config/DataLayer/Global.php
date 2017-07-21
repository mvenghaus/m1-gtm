<?php

class Inkl_GoogleTagManager_Helper_Config_DataLayer_Global extends Mage_Core_Helper_Abstract
{
	const XML_PATH_PAGE_TYPE = 'inkl_googletagmanager/datalayer_global/page_type';
	const XML_PATH_CURRENCY_CODE = 'inkl_googletagmanager/datalayer_global/currency_code';

	public function isPageTypeEnabled($storeId = null)
	{
		return Mage::getStoreConfigFlag(self::XML_PATH_PAGE_TYPE, $storeId);
	}

	public function isCurrencyCodeEnabled($storeId = null)
	{
		return Mage::getStoreConfigFlag(self::XML_PATH_CURRENCY_CODE, $storeId);
	}
}
