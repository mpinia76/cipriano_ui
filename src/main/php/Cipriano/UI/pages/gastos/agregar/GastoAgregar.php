<?php
namespace Cipriano\UI\pages\gastos\agregar;

use Cipriano\Core\utils\CiprianoUtils;
use Cipriano\UI\utils\CiprianoUIUtils;

use Cipriano\UI\pages\CiprianoPage;

use Rasty\utils\XTemplate;
use Cipriano\Core\model\Gasto;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class GastoAgregar extends CiprianoPage{

	/**
	 * gasto a agregar.
	 * @var Gasto
	 */
	private $gasto;


	public function __construct(){

		//inicializamos el gasto.
		$gasto = new Gasto();

		$gasto->setFechaHora( new \Datetime() );
		//$gasto->setSucursal( CiprianoUIUtils::getSucursal() );
		//$gasto->setConcepto( CiprianoUtils::getConceptoGastoVarios() );

		$this->setGasto($gasto);


	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "form.volver") );
//		$menuOption->setPageName("Gastos");
//		$menuGroup->addMenuOption( $menuOption );
//

		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "gasto.agregar.title" );
	}

	public function getType(){

		return "GastoAgregar";

	}

	protected function parseXTemplate(XTemplate $xtpl){
		$gastoForm = $this->getComponentById("gastoForm");
		$gastoForm->fillFromSaved( $this->getGasto() );

	}


	public function getGasto()
	{
	    return $this->gasto;
	}

	public function setGasto($gasto)
	{
	    $this->gasto = $gasto;
	}



	public function getMsgError(){
		return "";
	}
}
?>
