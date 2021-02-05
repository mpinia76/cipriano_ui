<?php
namespace Cipriano\UI\actions\caja;

use Cipriano\UI\utils\CiprianoUIUtils;
use Cipriano\Core\utils\CiprianoUtils;

use Cipriano\UI\service\UIServiceFactory;

use Cipriano\Core\model\Caja;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;
use Rasty\exception\RastyDuplicatedException;
use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;

/**
 * se cierra una caja
 *
 * @author Bernardo
 * @since 26/05/2014
 */
class CerrarCaja extends Action{


	public function execute(){

		$forward = new Forward();

		try {

			//obtenemos la caja a cerrar.
			$cajaOid = RastyUtils::getParamPOST("cajaOid");

			$caja = UIServiceFactory::getUICajaService()->get( $cajaOid );

			$user = RastySecurityContext::getUser();
			$user = CiprianoUtils::getUserByUsername($user->getUsername());

			UIServiceFactory::getUICajaService()->cerrarCaja($caja,$user);

			//deseteamos la caja de la sesión.
			CiprianoUIUtils::setCaja(null);

			$forward->setPageName( "CajaHome" );

		} catch (RastyDuplicatedException $e) {

			$forward->setPageName( "CerrarCaja" );
			$forward->addError( $e->getMessage() );

		} catch (RastyException $e) {

			$forward->setPageName( "CerrarCaja" );
			$forward->addError(Locale::localize($e->getMessage()) );

		}

		return $forward;

	}

}
?>
