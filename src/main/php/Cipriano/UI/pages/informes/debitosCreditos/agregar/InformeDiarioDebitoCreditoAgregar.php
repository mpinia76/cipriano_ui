<?php
namespace Cipriano\UI\pages\informes\debitosCreditos\agregar;

use Cipriano\Core\utils\CiprianoUtils;
use Cipriano\UI\utils\CiprianoUIUtils;

use Cipriano\UI\pages\CiprianoPage;

use Rasty\utils\XTemplate;
use Cipriano\Core\model\InformeDiarioDebitoCredito;
use Cipriano\Core\model\EstadoInformeDiarioDebitoCredito;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class InformeDiarioDebitoCreditoAgregar extends CiprianoPage{

	/**
	 * informeDiarioDebitoCredito a agregar.
	 * @var InformeDiarioDebitoCredito
	 */
	private $informeDiarioDebitoCredito;


	public function __construct(){

		//inicializamos el informeDiarioDebitoCredito.
		$informeDiarioDebitoCredito = new InformeDiarioDebitoCredito();

		$informeDiarioDebitoCredito->setFecha( new \DateTime() );
		$informeDiarioDebitoCredito->setSucursal( CiprianoUIUtils::getSucursal() );
		$informeDiarioDebitoCredito->setEstado ( EstadoInformeDiarioDebitoCredito::Pendiente ) ;

		$this->setInformeDiarioDebitoCredito($informeDiarioDebitoCredito);


	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "form.volver") );
//		$menuOption->setPageName("InformeDiarioDebitoCreditos");
//		$menuGroup->addMenuOption( $menuOption );
//

		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "informeDiarioDebitoCredito.agregar.title" );
	}

	public function getType(){

		return "InformeDiarioDebitoCreditoAgregar";

	}

	protected function parseXTemplate(XTemplate $xtpl){


	}


	public function getInformeDiarioDebitoCredito()
	{
	    return $this->informeDiarioDebitoCredito;
	}

	public function setInformeDiarioDebitoCredito($informeDiarioDebitoCredito)
	{
	    $this->informeDiarioDebitoCredito = $informeDiarioDebitoCredito;
	}



	public function getMsgError(){
		return "";
	}
}
?>
