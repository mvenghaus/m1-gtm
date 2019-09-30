<?php

class Inkl_GoogleTagManager_Helper_Route extends Mage_Core_Helper_Abstract
{

	public function getPath()
	{
		$request = Mage::app()->getRequest();

		return sprintf('%s/%s/%s', $request->getModuleName(), $request->getControllerName(), $request->getActionName());
	}

	public function isHome()
	{
		if ($this->getPath() === 'cms/index/index' && Mage::getSingleton('cms/page')->getIdentifier() == 'home') return true;

		return false;
	}

	public function isCategory()
	{
		return ($this->getPath() === 'catalog/category/view');
	}

	public function isSearch()
	{
		return ($this->getPath() === 'catalogsearch/result/index');
	}

	public function isProduct()
	{
		return ($this->getPath() === 'catalog/product/view');
	}

	public function isCart()
	{
		return $this->getPath() === 'checkout/cart/index'
			|| $this->getPath() === 'gomage_checkout/cart/index'
			|| $this->getPath() === 'ajaxcart/checkout_cart/index';
	}

	public function isCheckout()
	{
		return $this->getPath() === 'checkout/onepage/index'
			|| $this->getPath() === 'mastercheckout/index/index'
			|| $this->getPath() === 'onestepcheckout/index/index';
	}

	public function isPurchase()
	{
		return ($this->getPath() === 'checkout/onepage/success');
	}

	public function isNotFound()
	{
		return ($this->getPath() === 'cms/index/noRoute');
	}

}
