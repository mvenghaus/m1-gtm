<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Global_PageType
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		if (!$this->isEnabled())
		{
			return;
		}

		$pageType = $this->determine();
		if ($pageType)
		{
			$googleTagManager->addDataLayerVariable('pageType', $pageType, 'page_type');
		}
	}

	/**
	 * @return string
	 */
	private function determine()
	{
		$routeHelper = Mage::helper('inkl_googletagmanager/route');

		if ($routeHelper->isHome()) return 'home';
		if ($routeHelper->isCategory()) return 'category';
		if ($routeHelper->isSearch()) return 'searchresults';
		if ($routeHelper->isProduct()) return 'product';
		if ($routeHelper->isCart() || $routeHelper->isCheckout()) return 'cart';
		if ($routeHelper->isPurchase()) return 'purchase';

		return 'other';
	}

	private function isEnabled()
	{
		return Mage::helper('inkl_googletagmanager/config_dataLayer_global')->isPageTypeEnabled();
	}

}
