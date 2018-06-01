<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Customer_EmailMd5
{

	public function addAssets()
	{
		if (!$this->isEnabled())
		{
			return;
		}

		if ($headBlock = Mage::app()->getLayout()->getBlock('head'))
		{
			$headBlock->addItem('skin_js', 'js/googletagmanager/customer/emailMd5.js');
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
			$customerEmail = Mage::getSingleton('customer/session')->getCustomer()->getEmail();
			$customerEmail = mb_convert_encoding(trim(strtolower(str_replace('"',"",$customerEmail))), "UTF-8", "ISO-8859-1");
			if(!empty($customerEmail)) {
				$customerEmail = md5($customerEmail);
			}
		}

		Mage::getSingleton('core/cookie')->set('dataLayerCustomerEmailMd5', $customerEmail, null, null, null, null, false);
	}

	private function isEnabled()
	{
		return Mage::helper('inkl_googletagmanager/config_dataLayer_customer')->isCustomerEmailMd5Enabled();
	}
}
