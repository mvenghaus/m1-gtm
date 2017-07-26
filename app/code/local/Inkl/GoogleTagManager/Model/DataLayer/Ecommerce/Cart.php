<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Ecommerce_Cart
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		if (!$this->isEnabled() || !Mage::helper('inkl_googletagmanager/route')->isCart())
		{
			return;
		}

		$lastCartProducts = $this->getLastCartProducts();
		$cartProducts = $this->getCartProducts();

		$actionList = $this->createActionList($lastCartProducts, $cartProducts);
		foreach ($actionList as $event => $products)
		{
			if (count($products) === 0)
			{
				continue;
			}

			$type = ($event == 'addToCart' ? 'add' : 'remove');

			$googleTagManager->addDataLayerVariable('ecommerce', [
				'currencyCode' => Mage::app()->getStore()->getCurrentCurrencyCode(),
				$type => [
					'products' => $products
				]
			], 'ecommerce_' . $event);

			$googleTagManager->addDataLayerVariable('event', $event);
		}

		$this->setLastCartProducts($cartProducts);
	}

	private function createActionList($lastCartProducts, $cartProducts)
	{

		$actionList = ['addToCart' => [], 'removeFromCart' => []];
		foreach ($cartProducts as $cartProductData)
		{
			$key = $this->buildProductKey($cartProductData);

			// non existing product
			if (!isset($lastCartProducts[$key]))
			{
				$actionList['addToCart'][] = $cartProductData;
			}

			// existing product - check qty
			if (isset($lastCartProducts[$key]))
			{
				// add diff
				if ($lastCartProducts[$key]['quantity'] < $cartProductData['quantity'])
				{

					$cartProductData['quantity'] = $cartProductData['quantity'] - $lastCartProducts[$key]['quantity'];

					$actionList['addToCart'][] = $cartProductData;

					unset($lastCartProducts[$key]);

					continue;
				}

				// dec diff
				if ($lastCartProducts[$key]['quantity'] > $cartProductData['quantity'])
				{
					$cartProductData['quantity'] = $lastCartProducts[$key]['quantity'] - $cartProductData['quantity'];

					$actionList['removeFromCart'][] = $cartProductData;

					unset($lastCartProducts[$key]);

					continue;
				}
			}

			unset($lastCartProducts[$key]);
		}

		// removed products
		foreach ($lastCartProducts as $cartProductData)
		{
			$actionList['removeFromCart'][] = $cartProductData;
		}

		return $actionList;
	}

	private function setLastCartProducts(array $lastCartProducts)
	{
		Mage::getSingleton('core/session')->setData('gtm_last_cart', $lastCartProducts);
	}

	private function getLastCartProducts()
	{
		return (array)Mage::getSingleton('core/session')->getData('gtm_last_cart');
	}

	private function getCartProducts()
	{
		$cartProducts = [];
		/** @var Mage_Sales_Model_Quote_Item $quoteItem */
		foreach (Mage::getSingleton('checkout/cart')->getQuote()->getAllVisibleItems() as $quoteItem)
		{
			$cartProductData = [
				'id' => Mage::helper('inkl_googletagmanager/product')->getSkuById($quoteItem->getProductId()),
				'name' => $quoteItem->getName(),
				'price' => round($quoteItem->getPriceInclTax(), 2),
				'quantity' => 0
			];

			$key = $this->buildProductKey($cartProductData);
			if (!isset($cartProducts[$key]))
			{
				$cartProducts[$key] = $cartProductData;
			}

			$cartProducts[$key]['quantity'] += $quoteItem->getQty();
		}

		return $cartProducts;
	}

	/**
	 * @param array $cartProductData
	 * @return string
	 */
	private function buildProductKey($cartProductData)
	{
		return md5(implode('#', [
			$cartProductData['id'],
			$cartProductData['name'],
			$cartProductData['price']
		]));
	}

	private function isEnabled()
	{
		return Mage::helper('inkl_googletagmanager/config_dataLayer_ecommerce')->isCartEnabled();
	}
}
