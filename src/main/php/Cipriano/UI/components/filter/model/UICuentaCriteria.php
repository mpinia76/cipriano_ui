<?php
namespace Cipriano\UI\components\filter\model;


use Cipriano\UI\components\filter\model\UICiprianoCriteria;

use Rasty\utils\RastyUtils;
use Cipriano\Core\criteria\CuentaCriteria;

/**
 * Representa un criterio de búsqueda
 * para cuenta.
 *
 * @author Bernardo
 * @since 06-06-2014
 *
 */
class UICuentaCriteria extends UICiprianoCriteria{


	private $numero;


	public function __construct(){

		parent::__construct();

	}

	protected function newCoreCriteria(){
		return new CuentaCriteria();
	}

	public function buildCoreCriteria(){

		$criteria = parent::buildCoreCriteria();

		$criteria->setNumero( $this->getNumero() );
		return $criteria;
	}


    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

}
