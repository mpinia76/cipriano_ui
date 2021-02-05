<?php
namespace Cipriano\UI\pages\informes\semanal\stats;


use Cipriano\UI\pages\CiprianoPage;

use Cipriano\UI\components\filter\model\UIProfesionalCriteria;

use Cipriano\UI\service\UIServiceFactory;

use Cipriano\UI\service\UIProfesionalService;

use Cipriano\UI\utils\CiprianoUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;
use Rasty\utils\LinkBuilder;

use Cipriano\Core\model\Profesional;
use Cipriano\Core\model\EstadoTurno;

use Rasty\Grid\filter\model\UICriteria;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class InformeSemanalStats extends CiprianoPage{

	private $fecha;

	public function __construct(){

		$this->setFecha( new \Datetime() );
	}


	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("reportes_legend", $this->localize("stats.informeSemanal.reportes.legend") );
		$xtpl->assign("stats_legend", $this->localize("stats.informeSemanal.legend") );

		//reportes
		$this->parseReporte( $xtpl, $this->localize("stats.informeSemanal.porMes.legend"), "InformeSemanalPorMes" );
		$this->parseReporte( $xtpl, $this->localize("stats.informeSemanal.porSemana.legend"), "InformeSemanalPorSemana" );
		$this->parseReporte( $xtpl, $this->localize("stats.informeDiarioComision.porMes.legend"), "InformeDiarioComisionPorMes" );



	}

	protected function parseReporte(XTemplate $xtpl, $titulo, $link){

		$xtpl->assign("titulo",  $titulo);
		$xtpl->assign("linkReporte",  $link);
		$xtpl->parse( "main.reporte" );

	}

	public function getTitle(){
		///$nombre = $this->getProfesional()->getNombre();
		return  $this->localize("stats.informeSemanal.title")  ;
	}

	public function getMenuGroups(){

		$menuGroup = new MenuGroup();

//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "ausencia.agregar" ) );
//		$menuOption->setPageName("AusenciaAgregar");
//
//		$menuOption->setImageSource( $this->getWebPath() . "css/images/ausencias_48.png" );
//		$menuGroup->addMenuOption( $menuOption );

		return array();
	}

	public function getType(){

		return "InformeSemanalStats";

	}


	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}
}
?>
