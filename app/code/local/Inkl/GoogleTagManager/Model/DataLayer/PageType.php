<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_PageType
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		$routePath = Mage::helper('inkl_googletagmanager/route')->getPath();
		$pageType = $this->determine($routePath);

		if ($pageType)
		{
			$googleTagManager->addDataLayerVariable('pageType', $pageType);
		}
	}

	/**
	 * @param string $routePath
	 * @return string|null
	 */
	private function determine($routePath)
	{
		if ($this->isHome($routePath)) return 'home';
		if ($this->isCategory($routePath)) return 'category';
		if ($this->isSearch($routePath)) return 'searchresults';
		if ($this->isProduct($routePath)) return 'product';
		if ($this->isCart($routePath)) return 'cart';
		if ($this->isPurchase($routePath)) return 'purchase';

		return 'other';
	}

	private function isHome($routeInfo)
	{
		if ($routeInfo === 'cms/index/index' && Mage::getSingleton('cms/page')->getIdentifier() == 'home') return true;

		return false;
	}

	private function isCategory($routeInfo)
	{
		return ($routeInfo === 'catalog/category/view');
	}

	private function isSearch($routeInfo)
	{
		return ($routeInfo === 'catalogsearch/result/index');
	}

	private function isProduct($routeInfo)
	{
		return ($routeInfo === 'catalog/product/view');
	}

	private function isCart($routeInfo)
	{
		return ($routeInfo === 'checkout/cart/index');
	}

	private function isPurchase($routeInfo)
	{
		return ($routeInfo === 'checkout/onepage/success');
	}

}
