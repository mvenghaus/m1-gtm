<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Global_CurrencyCode
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		$googleTagManager->addDataLayerVariable('currencyCode', Mage::app()->getStore()->getCurrentCurrencyCode());
	}
}
