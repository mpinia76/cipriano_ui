<?php
namespace Cipriano\UI\pages\caja\abrir;

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

class AbrirCaja extends CiprianoPage{

	private $caja;

	public function __construct(){


		$this->caja = new Caja();

		$this->caja->setCajero( CiprianoUIUtils::getEmpleadoLogged() );
		$this->caja->setSucursal( CiprianoUIUtils::getSucursal() );
		$this->caja->setFecha ( new \DateTime() );
		$this->caja->setHoraApertura( new \DateTime() );
		$this->caja->setNumero( 1 );


	}


	protected function parseXTemplate(XTemplate $xtpl){

	}

	public function getTitle(){
		return $this->localize("caja.abrir.title") ;
	}

	public function getType(){

		return "AbrirCaja";

	}


	public function getCaja()
	{
	    return $this->caja;
	}

	public function setCaja($caja)
	{
	    $this->caja = $caja;
	}
}
?>
