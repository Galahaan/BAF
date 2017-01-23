<?php

namespace Controller;

use \W\Controller\Controller;

class DefaultController extends Controller
{
	// Page sur la documentation du framework 'W'
	public function docW(){
		$this->show('default/docW');
	}
}