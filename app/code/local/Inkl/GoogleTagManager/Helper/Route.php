<?php

class Inkl_GoogleTagManager_Helper_Route extends Mage_Core_Helper_Abstract
{

	public function getPath()
	{
		$request = Mage::app()->getRequest();

		return sprintf('%s/%s/%s', $request->getModuleName(), $request->getControllerName(), $request->getActionName());
	}

}
