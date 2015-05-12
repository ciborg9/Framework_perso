<?php
namespace app\controllers;
use \app\Controllers\Controller;

class HomeController extends Controller {
    static public function indexAction() {
        echo __file__;
    }
}
?>