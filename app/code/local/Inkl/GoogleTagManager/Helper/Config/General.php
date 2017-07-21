<?php

class Inkl_GoogleTagManager_Helper_Config_General extends Mage_Core_Helper_Abstract
{
	const XML_PATH_ENABLED = 'inkl_googletagmanager/general/enabled';
	const XML_PATH_ID = 'inkl_googletagmanager/general/id';

	public function isEnabled($storeId = null)
	{
		return Mage::getStoreConfigFlag(self::XML_PATH_ENABLED, $storeId);
	}

	public function getId($storeId = null)
	{
		return Mage::getStoreConfig(self::XML_PATH_ID, $storeId);
	}

	public function getTagPlaceholder()
	{
		return '<!-- GOOGLE TAG MANAGER CODE PLACEHOLDER -->';
	}
}
