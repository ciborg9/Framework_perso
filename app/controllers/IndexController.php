<?php
namespace app\controllers;
use MySite\Controller;

class IndexController extends Controller {

    public function indexAction() {
        return $this->render(":ViewFilename",array('data' => 'LICORNE'));
    }
}
?>