<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Ecommerce_Detail
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		if (!$this->isProductView())
		{
			return;
		}

		$product = $this->getProduct();

		$ecommerce = [
			'detail' => [
				'actionField' => [],
				'products' => [[
					'id' => $product->getSku(),
					'name' => $product->getName(),
					'price' => $product->getFinalPrice(),
				]]
			]
		];

		$googleTagManager->addDataLayerVariable('ecommerce', $ecommerce, 'ecommerce_detail');
	}

	private function getProduct()
	{
		return Mage::registry('current_product');
	}

	private function isProductView()
	{
		return (Mage::helper('inkl_googletagmanager/route')->getPath() === 'catalog/product/view');
	}
}
