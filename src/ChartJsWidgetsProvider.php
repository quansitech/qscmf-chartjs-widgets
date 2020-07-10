<?php
namespace ChartJs;

use Bootstrap\Provider;
use Bootstrap\RegisterContainer;

class ChartJsWidgetsProvider implements Provider {

    public function register(){
        RegisterContainer::registerHeadJs(__ROOT__. '/Public/chartJs/Chart.bundle.min.js');
        RegisterContainer::registerSymLink(WWW_DIR . '/Public/chartJs', __DIR__ . '/../asset/chartJs');
    }
}