<?php

namespace Cipriano\UI\layouts;

use Rasty\Layout\layout\Rasty\Layout;

use Rasty\utils\XTemplate;


class CiprianoLoginMetroLayout extends CiprianoMetroLayout{

	public function getXTemplate($file_template=null){
		return parent::getXTemplate( dirname(__DIR__) . "/layouts/CiprianoLoginMetroLayout.htm" );
	}

	public function getType(){

		return "CiprianoLoginMetroLayout";

	}

}
?>
