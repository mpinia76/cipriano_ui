<?php
namespace Cipriano\UI\pages\informes\debitosCreditos;

use Cipriano\UI\pages\CiprianoPage;

use Cipriano\UI\components\filter\model\UIInformeDiarioDebitoCreditoCriteria;

use Cipriano\UI\components\grid\model\InformeDiarioDebitoCreditoGridModel;

use Cipriano\UI\service\UIInformeDiarioDebitoCreditoService;

use Cipriano\UI\utils\CiprianoUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Cipriano\Core\model\InformeDiarioDebitoCredito;
use Cipriano\Core\criteria\InformeDiarioDebitoCreditoCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los informes semanales.
 *
 * @author Bernardo
 * @since 14/04/2015
 *
 */
class InformesDiariosDebitoCredito extends CiprianoPage{


	public function __construct(){

	}

	public function getTitle(){
		return $this->localize( "informesDiariosDebitoCredito.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.informesDiariosDebitoCredito.agregar") );
		$menuOption->setPageName("InformeDiarioDebitoCreditoAgregar");
		$menuOption->setIconClass( "icon-agregar fg-green" );
		$menuGroup->addMenuOption( $menuOption );


		return array($menuGroup);
	}

	public function getType(){

		return "InformesDiariosDebitoCredito";

	}

	public function getModelClazz(){
		return get_class( new InformeDiarioDebitoCreditoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIInformeDiarioDebitoCreditoCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );

		$xtpl->assign("agregar_label", $this->localize("informeDiarioDebitoCredito.agregar") );
	}

}
?>
