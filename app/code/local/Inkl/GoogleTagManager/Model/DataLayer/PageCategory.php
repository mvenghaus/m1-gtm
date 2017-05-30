<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_PageCategory
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		$routePath = Mage::helper('inkl_googletagmanager/route')->getPath();
		$pageCategory = $this->determine($routePath);

		if ($pageCategory)
		{
			$googleTagManager->addDataLayerVariable('pageCategory', $pageCategory);
		}
	}

	/**
	 * @param string $routePath
	 * @return string|null
	 */
	private function determine($routePath)
	{
		if ($this->isHome($routePath)) return 'home';
		if ($this->isCategoryView($routePath)) return 'category.view';
		if ($this->isProductView($routePath)) return 'product.view';
		if ($this->isCheckoutCart($routePath)) return 'checkout.cart';
		if ($this->isCheckoutSuccess($routePath)) return 'checkout.success';

		return null;
	}

	private function isHome($routeInfo)
	{
		if ($routeInfo === 'cms/index/index' && Mage::getSingleton('cms/page')->getIdentifier() == 'home') return true;

		return false;
	}

	private function isCategoryView($routeInfo)
	{
		return ($routeInfo === 'catalog/category/view');
	}

	private function isProductView($routeInfo)
	{
		return ($routeInfo === 'catalog/product/view');
	}

	private function isCheckoutCart($routeInfo)
	{
		return ($routeInfo === 'checkout/cart/index');
	}

	private function isCheckoutSuccess($routeInfo)
	{
		return ($routeInfo === 'checkout/onepage/success');
	}

}
