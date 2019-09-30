<?php

class Inkl_GoogleTagManager_Helper_Config_DataLayer_Customer extends Inkl_GoogleTagManager_Helper_Config_General
{
	const XML_PATH_EMAIL = 'inkl_googletagmanager/datalayer_customer/email';
	const XML_PATH_EMAIL_SHA1 = 'inkl_googletagmanager/datalayer_customer/email_sha1';
	const XML_PATH_EMAIL_SHA256 = 'inkl_googletagmanager/datalayer_customer/email_sha256';
	const XML_PATH_EMAIL_MD5 = 'inkl_googletagmanager/datalayer_customer/email_md5';

	public function isCustomerEmailEnabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ? Mage::getStoreConfigFlag(self::XML_PATH_EMAIL, $storeId) : false);
	}

	public function isCustomerEmailSha1Enabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ? Mage::getStoreConfigFlag(self::XML_PATH_EMAIL_SHA1, $storeId) : false);
	}

	public function isCustomerEmailSha256Enabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ? Mage::getStoreConfigFlag(self::XML_PATH_EMAIL_SHA256, $storeId) : false);
	}

	public function isCustomerEmailMd5Enabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ? Mage::getStoreConfigFlag(self::XML_PATH_EMAIL_MD5, $storeId) : false);
	}
}
