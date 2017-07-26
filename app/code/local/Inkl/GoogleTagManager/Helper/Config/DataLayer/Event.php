<?php

class Inkl_GoogleTagManager_Helper_Config_DataLayer_Event extends Inkl_GoogleTagManager_Helper_Config_General
{
	const XML_PATH_ADDTOCART = 'inkl_googletagmanager/datalayer_event/addtocart';

	public function isAddToCartEnabled($storeId = null)
	{
		return ($this->isEnabled($storeId) ? Mage::getStoreConfigFlag(self::XML_PATH_ADDTOCART, $storeId) : false);
	}

}
