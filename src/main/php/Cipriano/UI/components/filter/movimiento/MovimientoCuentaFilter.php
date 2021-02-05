<?php

namespace Cipriano\UI\components\filter\movimiento;

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
 * Filtro para buscar movimientos de Cuenta
 *
 * @author Bernardo
 * @since 05-06-2014
 */
class MovimientoCuentaFilter extends MovimientoFilter{


	public function getType(){

		return "MovimientoCuentaFilter";
	}


	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		//$this->fillInput("cuenta", CiprianoUIUtils::getCaja() );

		parent::parseXTemplate($xtpl);

		$xtpl->assign("lbl_saldo",  $this->localize( "cuenta.saldo" ) );


	}

}
?>
