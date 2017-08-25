<?php

class Inkl_GoogleTagManager_Helper_Config_DataLayer_Global extends Inkl_GoogleTagManager_Helper_Config_General
{
	const XML_PATH_PAGE_TYPE = 'inkl_googletagmanager/datalayer_global/page_type';
	const XML_PATH_CURRENCY_CODE = 'inkl_googletagmanager/datalayer_global/currency_code';
	const XML_PATH_LOCALE_CODE = 'inkl_googletagmanager/datalayer_global/locale_code';

	public function isPageTypeEnabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ? Mage::getStoreConfigFlag(self::XML_PATH_PAGE_TYPE, $storeId) : false);
	}

	public function isCurrencyCodeEnabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ? Mage::getStoreConfigFlag(self::XML_PATH_CURRENCY_CODE, $storeId) : false);
	}

	public function isLocaleCodeEnabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ? Mage::getStoreConfigFlag(self::XML_PATH_LOCALE_CODE, $storeId) : false);
	}
}
