<?php

class Inkl_GoogleTagManager_Helper_Config_DataLayer_Customer extends Inkl_GoogleTagManager_Helper_Config_General
{
	const XML_PATH_EMAIL = 'inkl_googletagmanager/datalayer_customer/email';
	const XML_PATH_EMAIL_SHA1 = 'inkl_googletagmanager/datalayer_customer/email_sha1';

	public function isCustomerEmailEnabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ?  Mage::getStoreConfigFlag(self::XML_PATH_EMAIL, $storeId) : false);
	}

	public function isCustomerEmailSha1Enabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ?  Mage::getStoreConfigFlag(self::XML_PATH_EMAIL_SHA1, $storeId) : false);
	}
}
