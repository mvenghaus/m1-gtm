<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Customer_EmailSha1
{

	public function addAssets()
	{
		if (!$this->isEnabled())
		{
			return;
		}

		Mage::app()->getLayout()->getBlock('head')->addItem('skin_js', 'js/googletagmanager/customer/emailSha1.js');
	}

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		if (!$this->isEnabled())
		{
			return;
		}

		$customerEmail = '';
		if (Mage::getSingleton('customer/session')->isLoggedIn())
		{
			$customerEmail = sha1(strtolower(Mage::getSingleton('customer/session')->getCustomer()->getEmail()));
		}

		Mage::getSingleton('core/cookie')->set('dataLayerCustomerEmailSha1', $customerEmail, null, null, null, null, false);
	}

	private function isEnabled()
	{
		return Mage::helper('inkl_googletagmanager/config_dataLayer_customer')->isCustomerEmailSha1Enabled();
	}
}
