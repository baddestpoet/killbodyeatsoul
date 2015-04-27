<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initViewHelpers()
	{
		//load layout resource from application.ini
		$this->bootstrap('layout');
		$layout = $this->getResource('layout');
		$view = $layout->getView(); 

		$view->doctype('HTML5');
		$view->headMeta()->appendHttpEquiv('Content-Type', 'text/html;')
			->appendName('description', 'killbodyeatsoul')
                        ->append;
		$view->headTitle()->setSeparator(' | ');

		$view->headTitle('killbodyeatsoul');
	}

	protected function _initRoutes()
	{
	    $router = Zend_Controller_Front::getInstance()->getRouter();
	    include APPLICATION_PATH . "/configs/routes.php";
	}
}