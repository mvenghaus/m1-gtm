<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Ecommerce_Detail
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		if (!Mage::helper('inkl_googletagmanager/route')->isProduct())
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
					'price' => round($product->getFinalPrice(), 2),
				]]
			]
		];

		$googleTagManager->addDataLayerVariable('ecommerce', $ecommerce, 'ecommerce_detail');
	}

	private function getProduct()
	{
		return Mage::registry('current_product');
	}

}
