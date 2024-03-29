<?php
namespace Cipriano\UI\components\filter\model;


use Cipriano\UI\components\filter\model\UICiprianoCriteria;

use Cipriano\UI\service\UIServiceFactory;

use Rasty\utils\RastyUtils;
use Cipriano\Core\criteria\MovimientoCuentaCriteria;

use Datetime;

/**
 * Representa un criterio de búsqueda
 * para movimientos de cuenta.
 *
 * @author Bernardo
 * @since 28/05/2014
 *
 */
class UIMovimientoCuentaCriteria extends UICiprianoCriteria{


	private $fecha;

	private $fechaDesde;

	private $fechaHasta;

	private $cuenta;

	public function __construct(){

		parent::__construct();
        $cuentaOid = RastyUtils::getParamGET("cuentaOid");

        //obtenemos la vendedor
        $cuenta = UIServiceFactory::getUICuentaService()->get($cuentaOid);
        $this->setCuenta($cuenta);

        /*$fecha = new DateTime();
        $this->setFecha($fecha);*/
	}

	protected function newCoreCriteria(){
		return new MovimientoCuentaCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setFecha( $this->getFecha() );
		$criteria->setFechaDesde( $this->getFechaDesde() );
		$criteria->setFechaHasta( $this->getFechaHasta() );
		$criteria->setCuenta( $this->getCuenta() );

		return $criteria;
	}


	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}

	public function getFechaDesde()
	{
	    return $this->fechaDesde;
	}

	public function setFechaDesde($fechaDesde)
	{
	    $this->fechaDesde = $fechaDesde;
	}

	public function getFechaHasta()
	{
	    return $this->fechaHasta;
	}

	public function setFechaHasta($fechaHasta)
	{
	    $this->fechaHasta = $fechaHasta;
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
