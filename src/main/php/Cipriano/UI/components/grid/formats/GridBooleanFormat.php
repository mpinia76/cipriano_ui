<?php
namespace Cipriano\UI\components\grid\formats;

use Cipriano\UI\utils\CiprianoUIUtils;
use Rasty\Grid\entitygrid\model\GridValueFormat;

use Cipriano\Core\model\Sucursal;
use Cipriano\Core\model\Producto;
use Rasty\i18n\Locale;

/**
 * Formato para boolean
 *
 * @author Bernardo
 * @since 01-12-2014
 *
 */

class GridBooleanFormat extends  GridValueFormat{

	public function __construct(){

	}

	public function format( $value, $item=null ){

		if( $value )
			return  "si";
		else $value;
	}


}
