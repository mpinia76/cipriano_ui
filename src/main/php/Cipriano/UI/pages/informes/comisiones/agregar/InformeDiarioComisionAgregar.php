<?php
namespace Cipriano\UI\pages\informes\comisiones\agregar;

use Cipriano\Core\utils\CiprianoUtils;
use Cipriano\UI\utils\CiprianoUIUtils;

use Cipriano\UI\pages\CiprianoPage;

use Rasty\utils\XTemplate;
use Cipriano\Core\model\InformeDiarioComision;
use Cipriano\Core\model\EstadoInformeDiarioComision;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class InformeDiarioComisionAgregar extends CiprianoPage{

	/**
	 * informeDiarioComision a agregar.
	 * @var InformeDiarioComision
	 */
	private $informeDiarioComision;


	public function __construct(){

		//inicializamos el informeDiarioComision.
		$informeDiarioComision = new InformeDiarioComision();

		$informeDiarioComision->setSucursal( CiprianoUIUtils::getSucursal() );
		$informeDiarioComision->setFecha( new \DateTime() );

		$this->setInformeDiarioComision($informeDiarioComision);


	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "form.volver") );
//		$menuOption->setPageName("InformeDiarioComisions");
//		$menuGroup->addMenuOption( $menuOption );
//

		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "informeDiarioComision.agregar.title" );
	}

	public function getType(){

		return "InformeDiarioComisionAgregar";

	}

	protected function parseXTemplate(XTemplate $xtpl){


	}


	public function getInformeDiarioComision()
	{
	    return $this->informeDiarioComision;
	}

	public function setInformeDiarioComision($informeDiarioComision)
	{
	    $this->informeDiarioComision = $informeDiarioComision;
	}



	public function getMsgError(){
		return "";
	}
}
?>
