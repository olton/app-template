<?php

namespace Core\Controllers;


use Core\Classes\Controller;
use Core\Classes\Url;
use Core\Classes\Viewer;
use Core\Defines\Constants;

class DefaultController extends Controller
{
    public function CheckLogin(){
        if (!$_SESSION['current'] && strpos($_SERVER['REQUEST_URI'], 'login') === false) {
            Url::Redirect("/login");
            exit(0);
        }
    }

    public function PageNotFound(){
        $params = array(
            "page_title" => Constants::$AIKIDO . " " . Constants::$SHIGAKUKAN
        );
        $view = new Viewer(TEMPLATE_PATH);
        echo $view->Render("index.phtml", $params);
    }
}