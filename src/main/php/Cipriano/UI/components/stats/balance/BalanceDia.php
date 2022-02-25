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
 * Balance de una fecha.
 *
 * @author Marcos
 * @since 24-02-2022
 */
class BalanceDia extends RastyComponent{

	private $fecha;

	private $filter;

	private $filterType;


	public function getType(){

		return "BalanceDia";

	}

	public function __construct(){


	}

	protected function parseLabels(XTemplate $xtpl){

		$xtpl->assign("lbl_fecha",  $this->localize( "balanceDia.fecha" ) );
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


		//logger::logObject($criteria);

		/*labels*/
		$this->parseLabels($xtpl);




		$xtpl->assign("fecha",  CiprianoUIUtils::formatDateToView( $criteria->getFecha(), "D d M Y") );

		$serviceMovimiento = UIServiceFactory::getUIMovimientoCuentaService();
		$criteriaMovimiento = new UIMovimientoCuentaCriteria();


		$fechaHasta = CiprianoUIUtils::formatDateToPersist($criteria->getFecha());

		$nuevafecha = new \DateTime($fechaHasta);

		$nuevafecha->modify('+1 day');
		//$fechaHasta->modify('+1 day');
		//Logger::log($nuevafecha);


		$criteriaMovimiento->setFechaDesde( $criteria->getFecha());
		$criteriaMovimiento->setFechaHasta(  $nuevafecha);

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



	public function setFilter($filter)
	{
	    $this->filter = $filter;
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
