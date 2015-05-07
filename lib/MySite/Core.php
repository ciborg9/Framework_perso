<?php
namespace MySite;

Class Core
{
    static public function run() {
        session_start();
        /*include('include/log_db.php');*/
        $call = ucfirst(isset($_GET['page']) ? $_GET['page'] : "");
        $call = explode('/', $call);
        var_dump($call);
        if (file_exists('../app/controllers/'.$call[0].'Controller.php')) // si le controller existe
        {
           include "../app/controllers/".$call[0]."Controller.php";
           call_user_func('app\controllers\\'. $call[0] . 'Controller' . '::' . $call[1] . 'Action');
        }
        else // SINON
        {
           include "../app/controllers/HomeController.php";

        }
    }
}
?>