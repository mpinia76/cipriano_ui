<?php
namespace Cipriano\UI\pages\balances;

use Cipriano\UI\components\filter\model\UIMovimientoCuentaCriteria;
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

use Cipriano\Core\criteria\MovimientoCuentaCriteria;

class BalanceAnio extends CiprianoPage{



	public function __construct(){


		//$this->fecha = new \DateTime();

	}

	public function getUicriteriaClazz(){
		return get_class( new UIMovimientoCuentaCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );


	}

	public function getTitle(){
		return $this->localize("balanceAnio.title") ;
	}

	public function getType(){

		return "BalanceAnio";

	}




}
?>
