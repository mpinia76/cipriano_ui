<?php
namespace Cipriano\UI\components\grid\formats;

use Cipriano\UI\utils\CiprianoUIUtils;

use Cipriano\Core\model\Sucursal;
use Cipriano\Core\model\Producto;
use Rasty\i18n\Locale;
use Rasty\Grid\entitygrid\model\GridValueFormat;

/**
 * Formato para porcentaje
 *
 * @author Bernardo
 * @since 10-06-2014
 *
 */

class GridPorcentajeFormat extends  GridValueFormat{

	public function __construct(){

	}

	public function format( $value, $item=null ){

		if( $value !=null )
			return  CiprianoUIUtils::formatPorcentajeToView($value);
		else $value;
	}


}
