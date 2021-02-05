<?php
namespace Cipriano\UI\pages\pagos;

use Cipriano\UI\pages\CiprianoPage;

use Cipriano\UI\components\filter\model\UIPagoCriteria;

use Cipriano\UI\components\grid\model\PagoGridModel;

use Cipriano\UI\service\UIPagoService;

use Cipriano\UI\utils\CiprianoUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Cipriano\Core\model\Pago;
use Cipriano\Core\criteria\PagoCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los pagos.
 *
 * @author Bernardo
 * @since 13-06-2014
 *
 */
class Pagos extends CiprianoPage{


	public function __construct(){

	}

	public function getTitle(){
		return $this->localize( "pagos.title" );
	}

	public function getMenuGroups(){

		$menuGroup = new MenuGroup();


		return array($menuGroup);
	}

	public function getType(){

		return "Pagos";

	}

	public function getModelClazz(){
		return get_class( new PagoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIPagoCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );

	}

}
?>
