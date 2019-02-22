<?php
namespace Frame;

use Frame\ApplicationComponent;
use Frame\Page;

abstract class BackController extends ApplicationComponent {
    protected $action = '';
    protected $module = '';
    protected $page = null;
    protected $view = '';

    protected $managers = null;

    public function __construct(Application $app, $module, $action)
    {
        parent::__construct($app);

        $this->managers = new Managers('PDO', PDOFactory::getMysqlConnection());
        $this->page = new Page($app);

        $this->setModule($module);
        $this->setAction($action);
        $this->setView($action);
    }

    public function execute() {

        $method = 'execute'.ucfirst($this->action);

        if (!is_callable([$this, $method])) {
            throw new \RuntimeException('The action '.$this->action.' 
            is not defined in that module');
        }

        $this->$method($this->app->httpRequest());
    }
    public function page() {
        return $this->page;
    }

    public function setModule($module) {
        if(!is_string($module) || empty($module))
        {
            throw new \InvalidArgumentException('The module must be a valid string');
        }

        $this->module = $module;
    }

    public function setAction($action) {
        if (!is_string($action) || empty($action)) {
            throw new \InvalidArgumentException('The action mus be a valid string');
        }

        $this->action = $action;
    }

    public function setView($view) {
        if (!is_string($view) || empty($view)) {
            throw new \InvalidArgumentException('The view must be a valid string');
        }

        $this->view = $view;

        $this->page->setContentFile(__DIR__.'/../../App/'.$this->app->name().'/Modules/'
        .$this->module.'/Views/'.$this->view.'.php');
    }
}
?>