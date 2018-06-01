<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Catalog_SearchProducts
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		if (!$this->isEnabled() || !Mage::helper('inkl_googletagmanager/route')->isSearch())
		{
			return;
		}

		$searchProducts = $this->getSearchProducts();

		$googleTagManager->addDataLayerVariable('searchProducts', $searchProducts);
	}

	private function getSearchProducts()
	{
		/** @var Mage_Catalog_Block_Product_List $searchProductListBlock */
		$searchProductListBlock = Mage::app()->getLayout()->getBlock('search_result_list');
		if (!$searchProductListBlock) return [];

		$searchProducts = [];
		foreach ($searchProductListBlock->getLoadedProductCollection() as $product)
		{
			$searchProducts[] = [
				'id' => $product->getSku(),
				'name' => $product->getName(),
				'price' => round(Mage::helper('tax')->getPrice($product, $product->getFinalPrice(), false ), 2),
			];
		}

		return $searchProducts;
	}

	private function isEnabled()
	{
		return Mage::helper('inkl_googletagmanager/config_dataLayer_catalog')->isSearchProductsEnabled();
	}

}
