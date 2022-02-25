<?php

namespace Cipriano\UI\components\filter\balance;

use Cipriano\UI\components\filter\model\UIMovimientoCuentaCriteria;

use Cipriano\UI\components\filter\model\UIBancoCriteria;
use Cipriano\UI\service\finder\BancoFinder;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;
use Rasty\utils\RastyUtils;

use Cipriano\UI\service\UIServiceFactory;

/**
 * Filtro para buscar balances
 * 
 * @author Marcos
 * @since 25/02/2022
 */
class BalanceMesFilter extends Filter{



    private $fecha;

    /**
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param \DateTime $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getType(){

        return "BalanceDiaFilter";
    }


    public function __construct(){

        parent::__construct();

        $this->fecha = new \DateTime();

        $this->setUicriteriaClazz( get_class( new UIMovimientoCuentaCriteria()) );



        $this->addProperty("fecha");

        $this->addProperty("cuenta");

    }

    protected function parseXTemplate(XTemplate $xtpl){



        parent::parseXTemplate($xtpl);




        $xtpl->assign("lbl_fecha",  $this->localize("balanceDia.fecha") );

        $xtpl->assign("lbl_banco",  $this->localize("balanceDia.cuenta") );





    }

    public function getBancoFinderClazz(){

        return get_class( new BancoFinder() );

    }


    public function getBancos(){

        $bancos = UIServiceFactory::getUIBancoService()->getList( new UIBancoCriteria() );

        return $bancos;
    }
}
?>