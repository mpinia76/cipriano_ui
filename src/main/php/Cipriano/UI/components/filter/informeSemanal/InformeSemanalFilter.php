<?php

namespace Cipriano\UI\components\filter\informeSemanal;

use Cipriano\UI\utils\CiprianoUIUtils;

use Cipriano\UI\components\filter\model\UIInformeSemanalCriteria;
use Cipriano\UI\service\UIServiceFactory;

use Cipriano\UI\components\grid\model\InformeSemanalGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filtro para buscar informesSemanales
 *
 * @author Bernardo
 * @since 14/04/2015
 */
class InformeSemanalFilter extends Filter{

	public function getType(){

		return "InformeSemanalFilter";
	}


	public function __construct(){

		parent::__construct();

		$this->setGridModelClazz( get_class( new InformeSemanalGridModel() ));

		$this->setUicriteriaClazz( get_class( new UIInformeSemanalCriteria()) );


		//agregamos las propiedades a popular en el submit.
		$this->addProperty("mes");
	}

	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		//$this->fillInput("nombre", $this->getInitialText() );

		parent::parseXTemplate($xtpl);

		$xtpl->assign("lbl_mes",  $this->localize("criteria.mes") );

		//$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "HistoriaClinica") );
		//$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "InformeSemanalModificar") );


	}



	public function getMeses(){

		$meses = CiprianoUIUtils::getMeses();

		return $meses;

	}

}
?>
