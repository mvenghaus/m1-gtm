<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Catalog_CategoryProducts
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		if (!$this->isEnabled() || !Mage::helper('inkl_googletagmanager/route')->isCategory())
		{
			return;
		}

		$categoryProducts = $this->getCategoryProducts();

		$googleTagManager->addDataLayerVariable('categoryProducts', $categoryProducts);
	}

	private function getCategoryProducts()
	{
		$category = Mage::registry('current_category');
		if ($category->getDisplayMode() == 'PAGE')
		{
			return [];
		}

		/** @var Mage_Catalog_Block_Product_List $productListBlock */
		$productListBlock = Mage::app()->getLayout()->getBlock('product_list');
		if (!$productListBlock) return [];

		$categoryProducts = [];
		foreach ($productListBlock->getLoadedProductCollection() as $product)
		{
			$categoryProducts[] = [
				'id' => $product->getSku(),
				'name' => $product->getName(),
				'price' => round(Mage::helper('tax')->getPrice($product, $product->getFinalPrice(), false ), 2),
			];
		}

		return $categoryProducts;
	}


	private function isEnabled()
	{
		return Mage::helper('inkl_googletagmanager/config_dataLayer_catalog')->isCategoryProductsEnabled();
	}

}
