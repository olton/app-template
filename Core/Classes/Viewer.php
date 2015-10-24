<?php

namespace Core\Classes;

class Viewer extends Super {
    protected $path;

    public function __construct($path = ''){
        $this->path = $path;
    }

    private function _render($template, $params = array()){
        extract($params);
        ob_start();
        include($template);
        return ob_get_clean();
    }

    public function Render($template, $params = array()){
        $template = $this->path . $template;
        if (!file_exists($template)) throw new \Exception("Template not found" . ". File: $template", E_USER_ERROR);
        $result = $this->_render($template, $params);
        return $result;
    }

    public function SetPath($path = "") {
        $this->path = $path;
        return $this;
    }
}
