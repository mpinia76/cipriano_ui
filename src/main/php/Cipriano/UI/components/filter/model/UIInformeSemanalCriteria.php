<?php
namespace Cipriano\UI\components\filter\model;


use Cipriano\UI\components\filter\model\UICiprianoCriteria;

use Rasty\utils\RastyUtils;
use Cipriano\Core\criteria\InformeSemanalCriteria;

/**
 * Representa un criterio de búsqueda
 * para informes semanales.
 *
 * @author Bernardo
 * @since 14/04/2015
 *
 */
class UIInformeSemanalCriteria extends UICiprianoCriteria{

	private $mes;

	public function __construct(){

		parent::__construct();

	}

	protected function newCoreCriteria(){
		return new InformeSemanalCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setMes( $this->getMes() );

		return $criteria;
	}



	public function getMes()
	{
	    return $this->mes;
	}

	public function setMes($mes)
	{
	    $this->mes = $mes;
	}
}
