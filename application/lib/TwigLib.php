<?php

/**
 * Description of TwigLib
 *
 * @author DartVadius
 */
class TwigLib {
    public static $twig;
    private $viewPath;
    private $layout;
    public function __construct($className) {
        preg_match_all('/[A-Z][^A-Z]*/', $className, $results);
        $controllerFolder =  strtolower(current($results[0]));
        $this->viewPath = APP . 'view/' . $controllerFolder . '/';
        $this->layout = APP . 'view/layout/' . Application::$App->layout . '.php';
        Twig_Autoloader::register();
        $cache = PUB . 'compilation_cache/';
        $loader = new Twig_Loader_Filesystem($this->viewPath);
        $this->twig = new Twig_Environment($loader, array(
        'cache' => $cache,
        'auto_reload' => true
        ));
    }
    private function getTemplateContent($template, $params = []) {
        extract($params);
        ob_start();
        $pathToTemplate = $this->viewPath . $template . '.php';
        if (file_exists($pathToTemplate)) {
            require_once $pathToTemplate;
        }
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    public function render($template, $params = []) {
        $content = $this->getTemplateContent($template, $params);
        if (file_exists($this->layout)) {
            require_once $this->layout;
        }
    }
}
