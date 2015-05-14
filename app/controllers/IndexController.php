<?php
namespace app\controllers;
use app\models\UserTable;
use MySite\Controller;

class IndexController extends Controller {

    public function indexAction() {
        //$model = new UserTable();
        return $this->render(":ViewFilename",array('data' => 'LICORNE'));
    }
}
?>