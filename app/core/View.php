<?php


namespace app\core;


class View
{
    const VIEWS_DIR = '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'views';

    protected $template = 'main';

    protected $page;

    public function __construct(string $template = null)
    {
        if (!is_null($template)) {
            $this->template = $template;
        }
    }

    public function render(string $page, array $params = [])
    {
        extract($params);
        $this->page = $page;
        include_once $this->getTemplatePath();
    }

    /**
     * return formatted path to templates directory
     * @return string
     */
    private function getTemplatePath()
    {
        return self::VIEWS_DIR . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $this->template . '.php';
    }

    private function getPagePath()
    {
        return self::VIEWS_DIR . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . $this->page . '.php';
    }

}