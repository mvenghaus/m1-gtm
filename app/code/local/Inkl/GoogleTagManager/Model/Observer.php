<?php

use Inkl\GoogleTagManager\GoogleTagManager;
use Inkl\GoogleTagManager\Schema\Id;

class Inkl_GoogleTagManager_Model_Observer
{

	public function controller_action_layout_generate_blocks_after(Varien_Event_Observer $observer)
	{
		Mage::getSingleton('inkl_googletagmanager/dataLayer_event_addToCart')->addAssets();
		Mage::getSingleton('inkl_googletagmanager/dataLayer_customer_email')->addAssets();
		Mage::getSingleton('inkl_googletagmanager/dataLayer_customer_emailSha1')->addAssets();
		Mage::getSingleton('inkl_googletagmanager/dataLayer_customer_emailMd5')->addAssets();
	}

	public function controller_front_send_response_before(Varien_Event_Observer $observer)
	{
		if (!Mage::helper('inkl_googletagmanager/config_general')->isEnabled())
		{
			return;
		}

		$response = $observer->getEvent()->getFront()->getResponse();

		$googleTagManager = GoogleTagManager::getInstance();

		Mage::dispatchEvent('googletagmanager_render_tag_before', ['google_tag_manager' => $googleTagManager]);

		$response->setBody(str_replace(
			Mage::helper('inkl_googletagmanager/config_general')->getTagPlaceholder(),
			$googleTagManager->renderTag(new Id(Mage::helper('inkl_googletagmanager/config_general')->getId())),
			$response->getBody()
		));
	}

	public function googletagmanager_render_tag_before(Varien_Event_Observer $observer)
	{
		/** @var GoogleTagManager $googleTagManager */
		$googleTagManager = $observer->getEvent()->getGoogleTagManager();

		/** global */
		Mage::getSingleton('inkl_googletagmanager/dataLayer_global_pageType')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_global_pageTypeEx')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_global_currencyCode')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_global_localeCode')->handle($googleTagManager);

		/** catalog */
		Mage::getSingleton('inkl_googletagmanager/dataLayer_catalog_categoryName')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_catalog_categoryProducts')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_catalog_searchKeyword')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_catalog_searchProducts')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_catalog_searchNumResults')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_catalog_cartProducts')->handle($googleTagManager);

		/** ecommerce */
		Mage::getSingleton('inkl_googletagmanager/dataLayer_ecommerce_detail')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_ecommerce_cart')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_ecommerce_purchase')->handle($googleTagManager);

		/** customer */
		Mage::getSingleton('inkl_googletagmanager/dataLayer_customer_email')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_customer_emailSha1')->handle($googleTagManager);
		Mage::getSingleton('inkl_googletagmanager/dataLayer_customer_emailMd5')->handle($googleTagManager);
	}

}
