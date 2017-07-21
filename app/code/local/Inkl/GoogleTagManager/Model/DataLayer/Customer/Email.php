<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Customer_Email
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		$customerEmail = '';
		if (Mage::getSingleton('customer/session')->isLoggedIn())
		{
			$customerEmail = strtolower(Mage::getSingleton('customer/session')->getCustomer()->getEmail());
		}

		Mage::getSingleton('core/cookie')->set('dataLayerCustomerEmail', $customerEmail, null, null, null, null, false);
	}
}
