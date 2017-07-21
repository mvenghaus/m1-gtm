<?php

use Inkl\GoogleTagManager\GoogleTagManager;
use Inkl\GoogleTagManager\Schema\Id;

class Inkl_GoogleTagManager_Model_Observer
{

	public function googletagmanager_render_tag_before(Varien_Event_Observer $observer)
	{
		/** @var GoogleTagManager $googleTagManager */
		$googleTagManager = $observer->getEvent()->getGoogleTagManager();

		/** global */
		if (Mage::helper('inkl_googletagmanager/config_dataLayer_global')->isPageTypeEnabled())
		{
			Mage::getSingleton('inkl_googletagmanager/dataLayer_global_pageType')->handle($googleTagManager);
		}

		if (Mage::helper('inkl_googletagmanager/config_dataLayer_global')->isCurrencyCodeEnabled())
		{
			Mage::getSingleton('inkl_googletagmanager/dataLayer_global_currencyCode')->handle($googleTagManager);
		}

		/** catalog */
		if (Mage::helper('inkl_googletagmanager/config_dataLayer_catalog')->isCategoryNameEnabled())
		{
			Mage::getSingleton('inkl_googletagmanager/dataLayer_catalog_categoryName')->handle($googleTagManager);
		}

		if (Mage::helper('inkl_googletagmanager/config_dataLayer_catalog')->isCategoryProductsEnabled())
		{
			Mage::getSingleton('inkl_googletagmanager/dataLayer_catalog_categoryProducts')->handle($googleTagManager);
		}

		if (Mage::helper('inkl_googletagmanager/config_dataLayer_catalog')->isSearchKeywordEnabled())
		{
			Mage::getSingleton('inkl_googletagmanager/dataLayer_catalog_searchKeyword')->handle($googleTagManager);
		}

		if (Mage::helper('inkl_googletagmanager/config_dataLayer_catalog')->isSearchProductsEnabled())
		{
			Mage::getSingleton('inkl_googletagmanager/dataLayer_catalog_searchProducts')->handle($googleTagManager);
		}

		if (Mage::helper('inkl_googletagmanager/config_dataLayer_catalog')->isCartProductsEnabled())
		{
			Mage::getSingleton('inkl_googletagmanager/dataLayer_catalog_cartProducts')->handle($googleTagManager);
		}

		/** ecommerce */
		if (Mage::helper('inkl_googletagmanager/config_dataLayer_ecommerce')->isDetailEnabled())
		{
			Mage::getSingleton('inkl_googletagmanager/dataLayer_ecommerce_detail')->handle($googleTagManager);
		}

		if (Mage::helper('inkl_googletagmanager/config_dataLayer_ecommerce')->isCartEnabled())
		{
			Mage::getSingleton('inkl_googletagmanager/dataLayer_ecommerce_cart')->handle($googleTagManager);
		}

		if (Mage::helper('inkl_googletagmanager/config_dataLayer_ecommerce')->isPurchaseEnabled())
		{
			Mage::getSingleton('inkl_googletagmanager/dataLayer_ecommerce_purchase')->handle($googleTagManager);
		}

	}

	public function controller_front_send_response_before(Varien_Event_Observer $observer)
	{
		$response = $observer->getEvent()->getFront()->getResponse();

		$googleTagManager = GoogleTagManager::getInstance();

		Mage::dispatchEvent('googletagmanager_render_tag_before', ['google_tag_manager' => $googleTagManager]);

		$response->setBody(str_replace(
			Mage::helper('inkl_googletagmanager/config_general')->getTagPlaceholder(),
			$googleTagManager->renderTag(new Id(Mage::helper('inkl_googletagmanager/config_general')->getId())),
			$response->getBody()
		));
	}

}
