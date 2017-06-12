<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_CartProducts
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		if (!$this->isCheckoutCart())
		{
			return;
		}

		$cartProducts = $this->getCartProducts();

		$googleTagManager->addDataLayerVariable('cartProducts', $cartProducts);
	}

	private function getCartProducts()
	{
		$cartProducts = [];
		/** @var Mage_Sales_Model_Quote_Item $quoteItem */
		foreach (Mage::getSingleton('checkout/cart')->getQuote()->getAllVisibleItems() as $quoteItem)
		{
			$sku = Mage::helper('inkl_googletagmanager/product')->getSkuById($quoteItem->getProductId());

			$cartProductData = [
				'id' => $sku,
				'name' => $quoteItem->getName(),
				'price' => $quoteItem->getPriceInclTax(),
				'quantity' => 0
			];

			if (!isset($cartProducts[$sku]))
			{
				$cartProducts[$sku] = $cartProductData;
			}

			$cartProducts[$sku]['quantity'] += $quoteItem->getQty();
		}

		return array_values($cartProducts);
	}



	private function isCheckoutCart()
	{
		return (Mage::helper('inkl_googletagmanager/route')->getPath() === 'checkout/cart/index');
	}


}
