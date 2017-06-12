<?php

use Inkl\GoogleTagManager\GoogleTagManager;

class Inkl_GoogleTagManager_Model_DataLayer_Ecommerce_Purchase
{

	/**
	 * @param GoogleTagManager $googleTagManager
	 */
	public function handle(GoogleTagManager $googleTagManager)
	{
		if (!$this->isCheckoutSuccess())
		{
			return;
		}

		$order = $this->getOrder();
		$ecommerce = [
			'purchase' => [
				'actionField' => $this->getActionField($order),
				'products' => $this->getProducts($order)
			]
		];

		$googleTagManager->addDataLayerVariable('ecommerce', $ecommerce, 'ecommerce_purchase');
	}

	private function getActionField(Mage_Sales_Model_Order $order)
	{
		return [
			'id' => $order->getIncrementId(),
			'affiliation' => 'Online Shop',
			'revenue' => round($order->getGrandTotal(), 2),
			'tax' => round($order->getTaxAmount(), 2),
			'shipping' => round($order->getShippingAmount(), 2),
			'coupon' => (string)$order->getCouponCode()
		];
	}

	private function getProducts(Mage_Sales_Model_Order $order)
	{
		$products = [];
		/** @var Mage_Sales_Model_Order_Item $orderItem */
		foreach ($order->getAllVisibleItems() as $orderItem)
		{
			$products[] = [
				'id' => $orderItem->getSku(),
				'name' => $orderItem->getName(),
				'price' => round($orderItem->getPriceInclTax(), 2),
				'qty' => (int)$orderItem->getQtyOrdered()
			];
		}

		return $products;
	}

	private function getOrder()
	{
		return Mage::getSingleton('checkout/session')->getLastRealOrder();
	}

	private function isCheckoutSuccess()
	{
		return (Mage::helper('inkl_googletagmanager/route')->getPath() === 'checkout/onepage/success');
	}
}
