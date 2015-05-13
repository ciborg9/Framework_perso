<?php
namespace MySite;

abstract Class Controller {

    public function render($view, $param = array()) {
        $views = explode(':', $view);
        if (empty($views[0])) {
            $dir = '../app/views/' . $views[1] . '.html';
        } else {
            $dir = '../app/views/' . $views[0] . '/' . $views[1] . '.html';
        }
        //var_dump($views);
        if (file_exists($dir)) {
            $file = file_get_contents($dir);
            if (!empty($param)) {
                //traitement de remplacement des clé par les valeur avec preg_replace
                foreach ($param as $key => $value) {
                    $file = preg_replace('/{{ (' . $key . ') }}/', $value, $file);
                }
            }
            echo $file;
        } else {
            echo "fichier de vue incorrect !!!";
        }
    }
}
?>