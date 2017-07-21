<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Catalog_CategoryProducts
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		if (!Mage::helper('inkl_googletagmanager/route')->isCategory())
		{
			return;
		}

		$categoryProducts = $this->getCategoryProducts();

		$googleTagManager->addDataLayerVariable('categoryProducts', $categoryProducts);
	}

	private function getCategoryProducts()
	{
		/** @var Mage_Catalog_Block_Product_List $productListBlock */
		$productListBlock = Mage::app()->getLayout()->getBlock('product_list');
		if (!$productListBlock) return [];

		$categoryProducts = [];
		foreach ($productListBlock->getLoadedProductCollection() as $product)
		{
			$categoryProducts[] = [
				'id' => $product->getSku(),
				'name' => $product->getName(),
				'price' => round($product->getFinalPrice(), 2),
			];
		}

		return $categoryProducts;
	}

}
