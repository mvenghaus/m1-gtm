<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_Observer
{

	public function googletagmanager_render_tag_before(Varien_Event_Observer $observer)
	{
		/** @var GoogleTagManager $googleTagManager */
		$googleTagManager = $observer->getEvent()->getGoogleTagManager();

		Mage::getSingleton('inkl_googletagmanager/dataLayer_pageType')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_ecommerce_purchase')->handle($googleTagManager);
	}

}
