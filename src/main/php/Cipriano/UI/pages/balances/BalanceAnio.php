<?php
namespace Cipriano\UI\pages\balances;

use Cipriano\UI\pages\CiprianoPage;

use Cipriano\UI\service\UIServiceFactory;

use Cipriano\UI\utils\CiprianoUIUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;
use Rasty\utils\LinkBuilder;

use Cipriano\Core\model\Caja;

use Rasty\Grid\filter\model\UICriteria;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class BalanceAnio extends CiprianoPage{

	private $fecha;

	public function __construct(){


		$this->fecha = new \DateTime();

	}

	protected function parseLabels(XTemplate $xtpl){

		$xtpl->assign("legend",  $this->localize( "balanceAnio.legend" ) );


	}

	protected function parseXTemplate(XTemplate $xtpl){

		/*labels*/
		$this->parseLabels($xtpl);


	}

	public function getTitle(){
		return $this->localize("balanceAnio.title") ;
	}

	public function getType(){

		return "BalanceAnio";

	}


	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}

		public function setStrFecha($strFecha){
		if( !empty($strFecha) ){
			$fecha = CiprianoUIUtils::newDateTime($strFecha) ;
			$this->setFecha($fecha);
		}
	}

}
?>
