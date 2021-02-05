<?php
namespace Cipriano\UI\pages\cajaChica;

use Cipriano\UI\service\UIServiceFactory;

use Cipriano\UI\components\filter\model\UIMovimientoCuentaCriteria;

use Cipriano\UI\components\grid\model\MovimientoCuentaGridModel;

use Cipriano\UI\pages\CiprianoPage;

use Cipriano\UI\utils\CiprianoUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los movimientos de la cajaChica.
 *
 * @author Bernardo
 * @since 04-06-2014
 *
 */
class MovimientosCajaChica extends CiprianoPage{


	public function __construct(){

	}

	public function getTitle(){
		return $this->localize( "cajaChica.movimientos.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.transferir") );
		$menuOption->setIconClass("icon-movimientos");
		$menuOption->setPageName( "Transferir");
		$menuGroup->addMenuOption( $menuOption );

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.cajaChica.depositarEnBanco") );
		$menuOption->setPageName( "DepositarEfectivo" );
		$menuOption->setIconClass("icon-depositar-efectivo");
		//$menuOption->setImageSource( $this->getWebPath() . "css/images/depositar_32.png" );
		$menuGroup->addMenuOption( $menuOption );



		return array($menuGroup);
	}

	public function getType(){

		return "MovimientosCajaChica";

	}

	public function getModelClazz(){
		return get_class( new MovimientoCuentaGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIMovimientoCuentaCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );

		//$xtpl->assign("agregar_label", $this->localize("cliente.agregar") );
	}

	public function getCajaChica(){

		 return UIServiceFactory::getUICuentaService()->getCajaChica();
	}
}
?>
