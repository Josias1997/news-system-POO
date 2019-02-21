<?php
namespace Frame;

class Managers {
    protected $api = null;
    protected $dao = null;
    protected $managers = [];

    public function __construct($api, $dao) {
        $this->api = $api;
        $this->dao = $dao;
    }

    public function getMangerOf($module) {
        if(!is_string($module) ||($module)) {
            throw new \InvalidArguementException('The specified module is invalid');
        }

        if (!isset($this->managers[$module])) {
            $manager = '\\Model\\'.$module.'Manager'.$this->api;

            $this->managers[$module] = new $manger($this->dao);
        }

        return $this->managers[$module];
    }

}
?>