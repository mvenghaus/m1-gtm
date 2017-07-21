<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Catalog_SearchProducts
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		if (!Mage::helper('inkl_googletagmanager/route')->isSearch())
		{
			return;
		}

		$searchProducts = $this->getsearchProducts();

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
				'price' => round($product->getFinalPrice(), 2),
			];
		}

		return $searchProducts;
	}

}
