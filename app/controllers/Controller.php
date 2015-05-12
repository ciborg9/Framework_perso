<?php
namespace app\controllers;

abstract Class Controller {

    public function render($view, $param = array()) {
        $views = explode(':', $view);
        var_dump($views);
        if (empty($views[0])) { /*si le view = ":fichier"*/
            $file = fopen('../app/views/' . $views[1] . '.html', 'r');
            $file = fread($file, filesize('../app/views/' . $views[1] . '.html'));
            if (!empty($param)) {
                //traitement de remplacement des clé par les valeur avec preg_replace
                foreach ($param as $key => $value) {
                    $file = preg_replace('/{{ (' . $key . ') }}/', $value, $file);
                }
            }
            echo $file;
        } else { /*si le view = "dosier:fichier"*/
            $file = fopen('../app/views/' . $views[0] . '/' . $views[1] . '.html', 'r');
            $file = fread($file, filesize('../app/views/' . $views[0] . '/' . $views[1] . '.html'));
            if (!empty($param)) {
                //traitement de remplacement des clé par les valeur avec preg_replace
                foreach ($param as $key => $value) {
                    $file = preg_replace('/{{ (' . $key . ') }}/', $value, $file);
                }
            }
            echo $file;
        }
    }
}
?>