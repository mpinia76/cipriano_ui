<?php

namespace Cipriano\UI\components\form\caja;

use Cipriano\UI\service\finder\SucursalFinder;

use Cipriano\UI\service\finder\EmpleadoFinder;

use Cipriano\UI\components\filter\model\UIEmpleadoCriteria;

use Cipriano\UI\components\filter\model\UISucursalCriteria;

use Cipriano\UI\utils\CiprianoUIUtils;

use Cipriano\UI\service\UIServiceFactory;


use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Cipriano\Core\model\Sucursal;
use Cipriano\Core\model\Empleado;
use Cipriano\Core\model\Caja;

use Rasty\utils\LinkBuilder;

/**
 * Formulario para caja

 * @author Bernardo
 * @since 26/05/2014
 */
class CajaForm extends Form{



	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;


	/**
	 *
	 * @var Caja
	 */
	private $caja;


	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");

		$this->addProperty("fecha");
		$this->addProperty("horaApertura");
		$this->addProperty("numero");
		$this->addProperty("sucursal");
		$this->addProperty("cajero");
		$this->addProperty("saldoInicial");

		$this->setBackToOnSuccess("CajaHome");
		$this->setBackToOnCancel("CajaHome");

	}

	public function getOid(){

		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}

	public function fillEntity($entity){

		parent::fillEntity($entity);

//		$planOid = $this->getComponentById("planObraSocial")->getPopulatedValue( $this->getMethod() );
//		if(!empty($planOid)){
//			$this->clienteObraSocial->setPlanObraSocial( UIServiceFactory::getUIPlanObraSocialService()->get($planOid) );
//		}


	}

	public function getType(){

		return "CajaForm";

	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);


		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );

		$xtpl->assign("lbl_fecha", $this->localize("caja.fecha") );
		$xtpl->assign("lbl_horaApertura", $this->localize("caja.horaApertura") );
		$xtpl->assign("lbl_sucursal", $this->localize("caja.sucursal") );
		$xtpl->assign("lbl_cajero", $this->localize("caja.cajero") );
		$xtpl->assign("lbl_saldoInicial", $this->localize("caja.saldoInicial") );
		$xtpl->assign("lbl_numero", $this->localize("caja.numero") );
	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}

	public function getSucursales(){

		$sucursales = UIServiceFactory::getUISucursalService()->getList( new UISucursalCriteria() );

		return $sucursales;

	}

	public function getCajeros(){


		$empleados = UIServiceFactory::getUIEmpleadoService()->getList( new UIEmpleadoCriteria() );

		return $empleados;

	}

	public function getFechaEditable(){
		return CiprianoUIUtils::isAdminLogged();
	}

	public function getHoraEditable(){
		return CiprianoUIUtils::isAdminLogged();
	}

	public function getSucursalEditable(){
		return CiprianoUIUtils::isAdminLogged();
	}

	public function getCajeroEditable(){
		return CiprianoUIUtils::isAdminLogged();
	}


	public function getCaja()
	{
	    return $this->caja;
	}

	public function setCaja($caja)
	{
	    $this->caja = $caja;
	}

	public function getLinkCancel(){
		$params = array();

		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}

	public function getCajeroFinderClazz(){

		return get_class( new EmpleadoFinder() );

	}

	public function getSucursalFinderClazz(){

		return get_class( new SucursalFinder() );

	}


}
?>
