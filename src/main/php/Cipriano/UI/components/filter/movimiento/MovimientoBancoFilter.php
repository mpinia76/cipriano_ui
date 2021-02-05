<?php

namespace Cipriano\UI\components\filter\movimiento;

use Cipriano\UI\service\finder\BancoFinder;

use Cipriano\UI\components\filter\model\UIBancoCriteria;

use Cipriano\UI\service\UIServiceFactory;

use Cipriano\UI\utils\CiprianoUIUtils;

use Cipriano\UI\components\grid\model\MovimientoCuentaGridModel;

use Cipriano\UI\components\filter\model\UIMovimientoCuentaCriteria;

use Cipriano\UI\components\filter\model\UIMovimientoCriteria;

use Cipriano\UI\components\grid\model\MovimientoGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filtro para buscar movimientos de Banco
 *
 * @author Bernardo
 * @since 09-06-2014
 */
class MovimientoBancoFilter extends Filter{



	public function getType(){

		return "MovimientoBancoFilter";
	}

	public function __construct(){

		parent::__construct();

		$this->setGridModelClazz( get_class( new MovimientoCuentaGridModel() ));

		$this->setUicriteriaClazz( get_class( new UIMovimientoCuentaCriteria()) );

		$this->addProperty("cuenta");
		$this->addProperty("fechaDesde");
		$this->addProperty("fechaHasta");

	}

	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el banco con bapro
		//$this->fillInput("cuenta", UIServiceFactory::getUIBancoService()->getCuentaBAPRO() );

		parent::parseXTemplate($xtpl);

		$xtpl->assign("lbl_fechaDesde",  $this->localize( "criteria.fechaDesde" ) );
		$xtpl->assign("lbl_fechaHasta",  $this->localize( "criteria.fechaHasta" ) );
		$xtpl->assign("lbl_banco",  $this->localize( "cuenta.banco" ) );

	}

	public function getBancos(){

		$bancos = UIServiceFactory::getUIBancoService()->getList( new UIBancoCriteria() );

		return $bancos;

	}

	public function getBancoFinderClazz(){

		return get_class( new BancoFinder() );

	}

}
?>
