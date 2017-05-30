<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_PageCategory
{

	public function handleRouteInfo($routeInfo)
	{
		$pageCategory = $this->determineByRouteInfo($routeInfo);

		if ($pageCategory)
		{
			GoogleTagManager::getInstance()->getDataLayer()->addVariable('pageCategory', $pageCategory);
		}
	}

	/**
	 * @param string $routeInfo
	 * @return string|null
	 */
	private function determineByRouteInfo($routeInfo)
	{
		if ($this->isHome($routeInfo)) return 'home';
		if ($this->isCategoryView($routeInfo)) return 'category.view';
		if ($this->isProductView($routeInfo)) return 'product.view';
		if ($this->isCheckoutCart($routeInfo)) return 'checkout.cart';
		if ($this->isCheckoutSuccess($routeInfo)) return 'checkout.success';

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
