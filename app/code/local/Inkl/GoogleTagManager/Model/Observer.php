<?php

use Inkl\GoogleTagManager\GoogleTagManager;
use Inkl\GoogleTagManager\Schema\Id;

class Inkl_GoogleTagManager_Model_Observer
{

	public function googletagmanager_render_tag_before(Varien_Event_Observer $observer)
	{
		/** @var GoogleTagManager $googleTagManager */
		$googleTagManager = $observer->getEvent()->getGoogleTagManager();

		Mage::getSingleton('inkl_googletagmanager/dataLayer_pageType')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_currencyCode')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_categoryName')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_categoryProducts')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_cartProducts')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_searchKeyword')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_searchProducts')->handle($googleTagManager);

		Mage::getSingleton('inkl_googletagmanager/dataLayer_ecommerce_detail')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_ecommerce_cart')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_ecommerce_purchase')->handle($googleTagManager);
	}

	public function controller_front_send_response_before(Varien_Event_Observer $observer)
	{
		$response = $observer->getEvent()->getFront()->getResponse();

		$googleTagManager = GoogleTagManager::getInstance();

		Mage::dispatchEvent('googletagmanager_render_tag_before', ['google_tag_manager' => $googleTagManager]);

		$response->setBody(str_replace(
			Mage::helper('inkl_googletagmanager/config')->getTagPlaceholder(),
			$googleTagManager->renderTag(new Id(Mage::helper('inkl_googletagmanager/config')->getId())),
			$response->getBody()
		));
	}

}
