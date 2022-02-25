<?php

namespace Cipriano\UI\components\stats\balance;

use Cipriano\UI\components\filter\model\UIMovimientoCuentaCriteria;
use Cipriano\UI\service\UIMovimientoCuentaService;

use Cipriano\UI\utils\CiprianoUIUtils;

use Cipriano\UI\service\UIServiceFactory;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;

use Rasty\utils\XTemplate;

use Cipriano\Core\model\Caja;

use Rasty\utils\LinkBuilder;

use Cipriano\Core\utils\CiprianoUtils;



use Rasty\factory\ComponentConfig;

use Rasty\factory\ComponentFactory;

use Rasty\utils\Logger;

/**
 * Balance de un mes.
 *
 * @author Marcos
 * @since 25-02-2022
 */
class BalanceMes extends RastyComponent{

	private $fecha;

	private $filter;

	private $filterType;

	public function getType(){

		return "BalanceMes";

	}

	public function __construct(){


	}

	protected function parseLabels(XTemplate $xtpl){

		$xtpl->assign("lbl_mes",  $this->localize( "balanceMes.mes" ) );
		$xtpl->assign("lbl_cuentas",  $this->localize( "balanceDia.cuentas" ) );
		$xtpl->assign("lbl_haber",  $this->localize( "balanceDia.haber" ) );
		$xtpl->assign("lbl_debe",  $this->localize( "balanceDia.debe" ) );
		$xtpl->assign("lbl_total",  $this->localize( "balanceDia.total" ) );
	}

	protected function parseXTemplate(XTemplate $xtpl){


		$componentConfig = new ComponentConfig();
	    $componentConfig->setId( "filter" );
		$componentConfig->setType( $this->getFilterType() );

	    $this->filter = ComponentFactory::buildByType($componentConfig, $this);



		$this->filter->fill( );

		$criteria = $this->filter->getCriteria();

		/*labels*/
		$this->parseLabels($xtpl);


		$fecha = $criteria->getFecha();
		if(empty($fecha)){
			$fecha = new DateTime();
		}

		$meses = CiprianoUIUtils::getMeses();
		$mes = $fecha->format("n");







		$xtpl->assign("mes",  $meses[$mes] . " " . $fecha->format("Y") );

		$serviceMovimiento = UIServiceFactory::getUIMovimientoCuentaService();
		$criteriaMovimiento = new UIMovimientoCuentaCriteria();


		$fecha= CiprianoUIUtils::formatDateToPersist($criteria->getFecha());

		$nuevafecha = new \DateTime($fecha);


		//$fechaHasta->modify('+1 day');
		//Logger::log($nuevafecha);

		$fechaDesde = CiprianoUtils::getFirstDayOfMonth( $nuevafecha );
		$fechaHasta = CiprianoUtils::getLastDayOfMonth( $nuevafecha);


		$criteriaMovimiento->setFechaDesde( $fechaDesde);
		$criteriaMovimiento->setFechaHasta(  $fechaHasta);

		if ($criteria->getCuenta()){
			$criteriaMovimiento->setCuenta($criteria->getCuenta());
		}

		$movimientoHaber = $serviceMovimiento->getTotalesHaber($criteriaMovimiento);
		$movimientoDebe = $serviceMovimiento->getTotalesDebe($criteriaMovimiento);

		$total = $movimientoHaber-$movimientoDebe;

		$xtpl->assign("haber", CiprianoUIUtils::formatMontoToView($movimientoHaber)  );
		$xtpl->assign("debe", CiprianoUIUtils::formatMontoToView((-1)*$movimientoDebe)  );
		$xtpl->assign("total", CiprianoUIUtils::formatMontoToView($total)  );



	}


	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}

	protected function initObserverEventType(){
		//TODO $this->addEventType( "Venta" );
	}

	public function getFilterType()
	{
	    return $this->filterType;
	}

	public function setFilterType($filterType)
	{
	    $this->filterType = $filterType;
	}
}
?>
