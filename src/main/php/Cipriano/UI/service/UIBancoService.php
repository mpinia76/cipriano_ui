<?php
namespace Cipriano\UI\service;

use Cipriano\UI\components\filter\model\UIBancoCriteria;


use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Cipriano\Core\service\ServiceFactory;

use Cipriano\Core\utils\CiprianoUtils;
use Cipriano\Core\model\Banco;
use Cipriano\Core\model\Transferencia;

use Cose\Security\model\User;
use Rasty\security\RastySecurityContext;


/**
 *
 * UI service para Banco.
 *
 * @author Bernardo
 * @since 09-06-2014
 */
class UIBancoService {

	private static $instance;

	private function __construct() {}

	public static function getInstance() {

		if( self::$instance == null ) {

			self::$instance = new UIBancoService();

		}
		return self::$instance;
	}



	public function getList( UIBancoCriteria $uiCriteria){

		try{

			$criteria = $uiCriteria->buildCoreCriteria() ;

			$service = ServiceFactory::getBancoService();

			$bancos = $service->getList( $criteria );

			return $bancos;

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}
	}


	public function get( $oid ){

		try {

			$service = ServiceFactory::getBancoService();

			return $service->get( $oid );

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}
	}

	public function getCuentaJosefina(){

		try {

			return CiprianoUtils::getCuentaJosefina();

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}

	}

	public function getCuentaCasa(){

		try {

			return CiprianoUtils::getCuentaCasa();

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}

	}

	public function getCuentaMarias(){

		try {

			return CiprianoUtils::getCuentaMarias();

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}

	}

	public function getCuentaCamion(){

		try {

			return CiprianoUtils::getCuentaCamion();

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}

	}

    public function getCuentaOtra(){

        try {

            return CiprianoUtils::getCuentaOtra();

        } catch (\Exception $e) {

            throw new RastyException($e->getMessage());

        }

    }

	public function getCuentaViajes(){

		try {

			return CiprianoUtils::getCuentaViajes();

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}

	}


	public function depositarEfectivo(Banco $banco, $monto, $observaciones, $fechaHora ){

		try{

			//recuperamos la caja chica.
			//$cajaChica = UIServiceFactory::getUICuentaService()->getCajaChica();

			$user = RastySecurityContext::getUser();
			$user = CiprianoUtils::getUserByUsername($user->getUsername());

			$transferencia = new Transferencia();
			//$transferencia->setOrigen( $cajaChica );
			$transferencia->setDestino( $banco );
			$transferencia->setMonto( $monto );
			$transferencia->setFechaHora( $fechaHora );
			$transferencia->setObservaciones( $observaciones );
			$transferencia->setUser( $user );

			UIServiceFactory::getUITransferenciaService()->add( $transferencia );

		} catch (\Exception $e) {

			throw new RastyException($e->getMessage());

		}

	}

	/**
	 * retorna los saldos de todos los bancos
	 */
	public function getSaldoBancos(){

		$bancos = $this->getList(new UIBancoCriteria());
		$saldos = 0;
		foreach ($bancos as $banco) {
			$saldos += $banco->getSaldo();
		}
		return $saldos;
	}

	/**
	 * retorna los saldos de todos los bancos
	 */
	public function getSaldoBanco(UIBancoCriteria $criteria){

		$bancos = $this->getList($criteria);
		$saldos = 0;
		foreach ($bancos as $banco) {
			$saldos += $banco->getSaldo();
		}
		return $saldos;
	}


}
?>
