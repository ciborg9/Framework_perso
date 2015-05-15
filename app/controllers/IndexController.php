<?php
namespace app\controllers;
use app\models\UserTable;
use MySite\Controller;

class IndexController extends Controller {

    public function indexAction() {
        $model = new UserTable();
        $data = $model->findOne("login = ?", ['ciborg']);
        return $this->render(":ViewFilename", $data);
    }
}
?>