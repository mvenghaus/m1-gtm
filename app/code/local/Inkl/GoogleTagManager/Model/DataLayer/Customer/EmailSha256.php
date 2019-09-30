<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Customer_EmailSha256
{

	public function addAssets()
	{
		if (!$this->isEnabled())
		{
			return;
		}

		if ($headBlock = Mage::app()->getLayout()->getBlock('head'))
		{
			$headBlock->addItem('skin_js', 'js/googletagmanager/customer/emailSha256.js');
		}
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
			$customerEmail = hash("sha256", strtolower(Mage::getSingleton('customer/session')->getCustomer()->getEmail()));
		}

		Mage::getSingleton('core/cookie')->set('dataLayerCustomerEmailSha256', $customerEmail, null, null, null, null, false);
	}

	private function isEnabled()
	{
		return Mage::helper('inkl_googletagmanager/config_dataLayer_customer')->isCustomerEmailSha256Enabled();
	}
}
