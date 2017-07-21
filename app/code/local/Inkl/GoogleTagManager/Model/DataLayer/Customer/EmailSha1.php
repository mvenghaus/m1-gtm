<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Customer_EmailSha1
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		$customerEmail = '';
		if (Mage::getSingleton('customer/session')->isLoggedIn())
		{
			$customerEmail = sha1(strtolower(Mage::getSingleton('customer/session')->getCustomer()->getEmail()));
		}

		Mage::getSingleton('core/cookie')->set('dataLayerCustomerEmailSha1', $customerEmail, null, null, null, null, false);
	}
}
