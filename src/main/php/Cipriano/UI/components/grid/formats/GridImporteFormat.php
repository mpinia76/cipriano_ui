<?php
namespace Cipriano\UI\components\grid\formats;

use Cipriano\UI\utils\CiprianoUIUtils;
use Rasty\Grid\entitygrid\model\GridValueFormat;

use Cipriano\Core\model\Sucursal;
use Cipriano\Core\model\Producto;
use Rasty\i18n\Locale;

/**
 * Formato para imprte
 *
 * @author Bernardo
 * @since 04-06-2014
 *
 */

class GridImporteFormat extends  GridValueFormat{

	public function __construct(){

	}

	public function format( $value, $item=null ){

		if( $value !=null )
			return  CiprianoUIUtils::formatMontoToView($value);
		else $value;
	}


}
