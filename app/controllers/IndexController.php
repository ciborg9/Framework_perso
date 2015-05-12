<?php
namespace app\controllers;
use \app\Controllers\Controller;

class IndexController extends Controller {

    public function indexAction() {
        return $this->render(":ViewFilename",array('data' => 'LICORNE'));
    }
}
?>