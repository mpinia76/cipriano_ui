<?php
namespace Cipriano\UI\pages\home;

use Cipriano\UI\pages\CiprianoPage;

use Cipriano\UI\components\filter\model\UIBancoCriteria;

use Cipriano\UI\service\UIServiceFactory;

use Cipriano\Core\utils\CiprianoUtils;

use Cipriano\UI\utils\CiprianoUIUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;
use Rasty\utils\LinkBuilder;



use Rasty\Grid\filter\model\UICriteria;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuActionOption;

use Rasty\security\RastySecurityContext;

class AdminHome extends CiprianoPage{



	private $cuentaJosefina;
	private $cuentaCasa;
	private $cuentaMarias;
	private $cuentaCamion;
    private $cuentaOtra;
	private $cuentaViajes;

	/**
	 * @return mixed
	 */
	public function getCuentaViajes()
	{
		return $this->cuentaViajes;
	}

	/**
	 * @param mixed $cuentaViajes
	 */
	public function setCuentaViajes($cuentaViajes)
	{
		$this->cuentaViajes = $cuentaViajes;
	}

    /**
     * @return mixed
     */
    public function getCuentaOtra()
    {
        return $this->cuentaOtra;
    }

    /**
     * @param mixed $cuentaOtra
     */
    public function setCuentaOtra($cuentaOtra)
    {
        $this->cuentaOtra = $cuentaOtra;
    }

	public function __construct(){
		$this->setCuentaJosefina( UIServiceFactory::getUIBancoService()->getCuentaJosefina() );
		$this->setCuentaCasa( UIServiceFactory::getUIBancoService()->getCuentaCasa() );
		$this->setCuentaMarias( UIServiceFactory::getUIBancoService()->getCuentaMarias() );
		$this->setCuentaCamion( UIServiceFactory::getUIBancoService()->getCuentaCamion() );
        $this->setCuentaOtra( UIServiceFactory::getUIBancoService()->getCuentaOtra() );
		$this->setCuentaViajes( UIServiceFactory::getUIBancoService()->getCuentaViajes() );
	}

	public function getTitle(){
		return $this->localize( "admin_home.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		return array($menuGroup);
	}

	protected function parseMenuUser(XTemplate $xtpl){

		$user = RastySecurityContext::getUser();
		$xtpl->assign("user", $user->getName() );

		$this->parseMenuExit($xtpl);

	}

	protected function parseXTemplate(XTemplate $xtpl){

		$title = $this->localize("admin_home.title");
		$subtitle = $this->localize("admin_home.subtitle");
		$xtpl->assign("app_title", $title );
		//$xtpl->assign("app_subtitle", $subtitle );

		$this->parseMenuUser($xtpl);

		$this->parseGastos($xtpl);



		$this->parseLinks($xtpl);

		$this->parseSaldos($xtpl);


	}

	public function parseLinks( XTemplate $xtpl){

		$xtpl->assign("menu_admin", $this->localize("menu.admin") );


		$xtpl->assign("menu_gastos", $this->localize("menu.gastos") );
		$xtpl->assign("linkGastos", $this->getLinkGastos() );
		$xtpl->assign("menu_gastos_agregar", $this->localize("menu.gastos.agregar") );
		$xtpl->assign("linkGastoAgregar", $this->getLinkGastoAgregar() );



		$xtpl->assign("menu_bancos", $this->localize("menu.total") );
		$xtpl->assign("linkBancos", $this->getLinkBancos() );




		$xtpl->assign("menu_balance_caja", $this->localize("menu.balances.caja") );
		$xtpl->assign("linkBalanceCaja", $this->getLinkBalanceCaja() );

		$xtpl->assign("menu_balance_dia", $this->localize("menu.balances.dia") );
		$xtpl->assign("linkBalanceDia", $this->getLinkBalanceDia() );

		$xtpl->assign("menu_balance_mes", $this->localize("menu.balances.mes") );
		$xtpl->assign("linkBalanceMes", $this->getLinkBalanceMes() );

		$xtpl->assign("menu_balance_anio", $this->localize("menu.balances.anio") );
		$xtpl->assign("linkBalanceAnio", $this->getLinkBalanceAnio() );

		$xtpl->assign("menu_cuentas", $this->localize("menu.cuentas") );
		$xtpl->assign("menu_caja", $this->localize("menu.caja") );
		$xtpl->assign("linkCaja", $this->getLinkCajaHome());




	}



	public function parseSaldos(XTemplate $xtpl){





		$xtpl->assign("saldo_bancos", CiprianoUIUtils::formatMontoToView( UIServiceFactory::getUIBancoService()->getSaldoBancos() ) );
		$xtpl->assign("linkMovimientosBanco", $this->getLinkMovimientosBanco(CiprianoUtils::getCuentaJosefina()));
        $xtpl->assign("linkMovimientosJosefina", $this->getLinkMovimientosBanco(CiprianoUtils::getCuentaJosefina()));
        $xtpl->assign("linkMovimientosMarias", $this->getLinkMovimientosBanco(CiprianoUtils::getCuentaMarias()));
        $xtpl->assign("linkMovimientosCasa", $this->getLinkMovimientosBanco(CiprianoUtils::getCuentaCasa()));
        $xtpl->assign("linkMovimientosCamion", $this->getLinkMovimientosBanco(CiprianoUtils::getCuentaCamion()));
        $xtpl->assign("linkMovimientosOtra", $this->getLinkMovimientosBanco(CiprianoUtils::getCuentaOtra()));
		$xtpl->assign("linkMovimientosViajes", $this->getLinkMovimientosBanco(CiprianoUtils::getCuentaViajes()));



        $xtpl->assign("menu_josefina",'La Josefina' );
		$uiCriteria = new UIBancoCriteria();
		$uiCriteria->setNombre( 'La Josefina' );
		$xtpl->assign("saldo_baproctate", CiprianoUIUtils::formatMontoToView( UIServiceFactory::getUIBancoService()->getSaldoBanco($uiCriteria) ) );

		$xtpl->assign("menu_Marias",'Las Marías' );
		$uiCriteria = new UIBancoCriteria();
		$uiCriteria->setNombre( 'Las Marías' );
		$xtpl->assign("saldo_Marias", CiprianoUIUtils::formatMontoToView( UIServiceFactory::getUIBancoService()->getSaldoBanco($uiCriteria) ) );

		$xtpl->assign("menu_casa",'Casa' );
		$uiCriteria = new UIBancoCriteria();
		$uiCriteria->setNombre( 'Casa' );
		$xtpl->assign("saldo_casa", CiprianoUIUtils::formatMontoToView( UIServiceFactory::getUIBancoService()->getSaldoBanco($uiCriteria) ) );



		$xtpl->assign("menu_Camion",'Camión' );
		$uiCriteria = new UIBancoCriteria();
		$uiCriteria->setNombre( 'Camión' );
		$xtpl->assign("saldo_Camion", CiprianoUIUtils::formatMontoToView( UIServiceFactory::getUIBancoService()->getSaldoBanco($uiCriteria) ) );

        $xtpl->assign("menu_otra",'Otra' );
        $uiCriteria = new UIBancoCriteria();
        $uiCriteria->setNombre( 'Otra' );
        $xtpl->assign("saldo_otra", CiprianoUIUtils::formatMontoToView( UIServiceFactory::getUIBancoService()->getSaldoBanco($uiCriteria) ) );

		$xtpl->assign("menu_viajes",'Viajes con mercadería' );
		$uiCriteria = new UIBancoCriteria();
		$uiCriteria->setNombre( 'Viajes con mercadería' );
		$xtpl->assign("saldo_viajes", CiprianoUIUtils::formatMontoToView( UIServiceFactory::getUIBancoService()->getSaldoBanco($uiCriteria) ) );



	}


	public function parseMenuExit( XTemplate $xtpl){

		$menuOption = new MenuActionOption();
		$menuOption->setLabel( $this->localize( "menu.logout") );
		$menuOption->setIconClass( "icon-exit" );
		$menuOption->setActionName( "Logout");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/logout.png" );

		$this->parseMenuOption($xtpl, $menuOption, "main.menuOptionExit");

	}

	public function parseMenuAdmin( XTemplate $xtpl){

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.admin_home") );
		//$menuOption->setIconClass( "icon-exit" );
		$menuOption->setPageName( "AdminHome");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/empleado_home_48.png" );

		$this->parseMenuOption($xtpl, $menuOption, "main.menuOptionAdmin");

	}
	public function parseMenuProfile( XTemplate $xtpl, $user){

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.profile") );
		$menuOption->setIconClass( "icon-cog" );
		$menuOption->setPageName( "UserProfile");
		$menuOption->addParam("oid",$user->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/profile.png" );
		$this->parseMenuOption($xtpl, $menuOption, "main.menuOptionProfile");

	}

	public function parseMenuOption( XTemplate $xtpl, MenuOption $menuOption, $blockName){
		$xtpl->assign("label", $menuOption->getLabel() );
		$xtpl->assign("onclick", $menuOption->getOnclick());
		$img = $menuOption->getImageSource();
		if(!empty($img)){
			$xtpl->assign("src", $img );
			$xtpl->parse("$blockName.image");
		}
		$xtpl->assign("iconClass", $menuOption->getIconClass());

		$xtpl->parse("$blockName");
	}

	public function parseGastos( XTemplate $xtpl){

		$gastos = UIServiceFactory::getUIGastoService()->getGastosPorVencer();

		if(count($gastos) == 0 ){
			$xtpl->assign("titulo", $this->localize("gastos.por_vencer.vacio") );
			$xtpl->parse("main.sin_gasto");
		}

		foreach ($gastos as $gasto) {
			$xtpl->assign("titulo", CiprianoUIUtils::formatDateToView( $gasto->getFechaVencimiento()) );
			$xtpl->assign("subtitulo", CiprianoUIUtils::formatMontoToView($gasto->getMonto()) );
			$xtpl->assign("descripcion", $gasto->getConcepto() );
			$xtpl->parse("main.gasto");
		}

		$xtpl->assign("total_gastos", count($gastos));

	}




	public function getType(){

		return "AdminHome";

	}








	public function getCuentaJosefina()
	{
	    return $this->cuentaJosefina;
	}

	public function setCuentaJosefina($cuentaJosefina)
	{
	    $this->cuentaJosefina = $cuentaJosefina;
	}

	public function getCuentaMarias()
	{
	    return $this->cuentaMarias;
	}

	public function setCuentaMarias($cuentaMarias)
	{
	    $this->cuentaMarias = $cuentaMarias;
	}

	public function getCuentaCasa()
	{
	    return $this->cuentaCasa;
	}

	public function setCuentaCasa($cuentaCasa)
	{
	    $this->cuentaCasa = $cuentaCasa;
	}

	public function getCuentaCamion()
	{
	    return $this->cuentaCamion;
	}

	public function setCuentaCamion($cuentaCamion)
	{
	    $this->cuentaCamion = $cuentaCamion;
	}
}
?>
