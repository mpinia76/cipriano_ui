<?php
namespace Cipriano\UI\components\grid\model;

use Cipriano\UI\utils\CiprianoUIUtils;

use Cipriano\UI\components\grid\formats\GridImporteFormat;

use Cipriano\UI\components\grid\formats\GridEstadoPagoFormat;

use Cipriano\UI\components\filter\model\UIPagoCriteria;

use Cipriano\Core\model\EstadoPago;

use Rasty\Grid\entitygrid\EntityGrid;
use Rasty\Grid\entitygrid\model\EntityGridModel;
use Rasty\Grid\entitygrid\model\GridModelBuilder;
use Rasty\Grid\filter\model\UICriteria;
use Rasty\Grid\entitygrid\model\GridDatetimeFormat;
use Cipriano\UI\service\UIServiceFactory;
use Rasty\utils\RastyUtils;
use Rasty\utils\Logger;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\MenuActionAjaxOption;

/**
 * Model para la grilla de Pagos.
 *
 * @author Bernardo
 * @since 13-06-2014
 */
class PagoGridModel extends EntityGridModel{

	public function __construct() {

        parent::__construct();
        $this->initModel();

    }

    public function getService(){

    	return UIServiceFactory::getUIPagoService();
    }

    public function getFilter(){

    	$filter = new UIPagoCriteria();
		return $filter;
    }

	protected function initModel() {

		$this->setHasCheckboxes( false );

		$column = GridModelBuilder::buildColumn( "oid", "pago.oid", 20, EntityGrid::TEXT_ALIGN_RIGHT );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "fechaHora", "pago.fechaHora", 20, EntityGrid::TEXT_ALIGN_CENTER, new GridDatetimeFormat("d/m/Y H:i:s") );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "sucursal", "pago.sucursal", 20, EntityGrid::TEXT_ALIGN_LEFT );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "cobrador", "pago.cobrador", 20, EntityGrid::TEXT_ALIGN_LEFT );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "cliente", "pago.cliente", 20, EntityGrid::TEXT_ALIGN_LEFT );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "monto", "pago.monto", 20, EntityGrid::TEXT_ALIGN_RIGHT, new GridImporteFormat() );
		$column->setCssClass("importe");
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "observaciones", "pago.observaciones", 20, EntityGrid::TEXT_ALIGN_LEFT );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "estado", "pago.estado", 20, EntityGrid::TEXT_ALIGN_LEFT, new GridEstadoPagoFormat() );
		$this->addColumn( $column );


	}

	public function getRowStyleClass($item){

		return CiprianoUIUtils::getEstadoPagoCss($item->getEstado());

	}

	public function getDefaultFilterField() {
        return "fechaHora";
    }

	public function getDefaultOrderField(){
		return "fechaHora";
	}

	public function getDefaultOrderType(){
		return "DESC";
	}

    /**
	 * opciones de menú dado el item
	 * @param unknown_type $item
	 */
	public function getMenuGroups( $item ){

		$group = new MenuGroup();
		$group->setLabel("grupo");
		$options = array();

		if( $item->podesAnularte() ){
			$menuOption = new MenuOption();
			$menuOption->setLabel( $this->localize( "menu.pagos.anular") );
			$menuOption->setPageName( "PagoAnular" );
			$menuOption->addParam("pagoOid",$item->getOid());
			$menuOption->setIconClass( "icon-anular" );
			$options[] = $menuOption ;
		}


		$group->setMenuOptions( $options );

		return array( $group );

	}

}
?>
