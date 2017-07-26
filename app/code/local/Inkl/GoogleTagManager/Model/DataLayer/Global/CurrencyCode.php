<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Global_CurrencyCode
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		if (!$this->isEnabled())
		{
			return;
		}

		$googleTagManager->addDataLayerVariable('currencyCode', Mage::app()->getStore()->getCurrentCurrencyCode());
	}

	private function isEnabled()
	{
		return Mage::helper('inkl_googletagmanager/config_dataLayer_global')->isCurrencyCodeEnabled();
	}
}
