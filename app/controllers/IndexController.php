<?php
namespace app\controllers;
use \app\Controllers\Controller;

class IndexController extends Controller {

    public function indexAction() {
        $this->render(":ViewFilename",array('data' => 'LICORNE'));
        echo __file__."test";
    }
}
?>