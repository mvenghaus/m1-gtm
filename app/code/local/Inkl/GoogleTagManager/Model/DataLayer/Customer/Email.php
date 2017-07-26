<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Customer_Email
{

	public function addAssets()
	{
		if (!$this->isEnabled())
		{
			return;
		}

		Mage::app()->getLayout()->getBlock('head')->addItem('skin_js', 'js/googletagmanager/customer/email.js');
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
			$customerEmail = strtolower(Mage::getSingleton('customer/session')->getCustomer()->getEmail());
		}

		Mage::getSingleton('core/cookie')->set('dataLayerCustomerEmail', $customerEmail, null, null, null, null, false);
	}

	private function isEnabled()
	{
		return Mage::helper('inkl_googletagmanager/config_dataLayer_customer')->isCustomerEmailEnabled();
	}
}
