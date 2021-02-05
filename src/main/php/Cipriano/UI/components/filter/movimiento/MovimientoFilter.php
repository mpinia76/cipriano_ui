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
use Rasty\utils\RastyUtils;

/**
 * Filtro para buscar movimientos
 *
 * @author Bernardo
 * @since 26/05/2014
 */
abstract class MovimientoFilter extends Filter{

	private $cuenta;


	public function __construct(){

		parent::__construct();

		$this->setGridModelClazz( get_class( new MovimientoCuentaGridModel() ));

		$this->setUicriteriaClazz( get_class( new UIMovimientoCuentaCriteria()) );

		//$this->setSelectRowCallback("seleccionarMovimiento");

		//agregamos las propiedades a popular en el submit.
		//$this->addProperty("cuenta");


	}

	protected function parseXTemplate(XTemplate $xtpl){



		//rellenamos el nombre con el texto inicial
		//$this->fillInput("cuenta", CiprianoUIUtils::getCaja() );

		parent::parseXTemplate($xtpl);

		$xtpl->assign("lbl_cuenta",  $this->localize("movimientoCuenta.cuenta") );


		$cuenta = $this->getCuenta();
		$xtpl->assign("saldo",  CiprianoUIUtils::formatMontoToView($cuenta->getSaldo()) );
		$xtpl->assign("cuentaOid",  $cuenta->getOid() );

		//$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "HistoriaClinica") );
		//$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "MovimientoModificar") );
	}

	public function fillEntity($entity){

		parent::fillEntity($entity);

		$cuenta = UIServiceFactory::getUICuentaService()->get( RastyUtils::getParamPOST("cuentaOid") );

		$entity->setCuenta( $cuenta );

	}

	public function getCuenta()
	{
	    return $this->cuenta;
	}

	public function setCuenta($cuenta)
	{
	    $this->cuenta = $cuenta;
	}
}
?>
