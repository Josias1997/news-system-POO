<?php 
namespace Frame;

class Page extends ApplicationComponent {
    protected $contentFile;
    protected $var = [];

    public function addVar($var, $value) {
        if(!is_string($var) || is_numeric($var) || empty($var)) {
            throw new \InvalidArgumentException("The variable's name must be a not null string");
        }

        $this->vars[$var] = $value;
    }

    public function getGenerated() {
        if(!file_exists($this->contentFile)) {
            throw new \RuntimeException('The specified View doesn\'t exist');
        }

        extract($this->vars);

        \ob_start();
        require __DIR__.'/../../App/'.$this->app->name().'Templates/layout.php';

        return \ob_get_clean();
    }

    public function setContentFile($contentFile) {
        if (!is_string($contentFile) || empty($contentFile)) {
            throw new \InvalidArgumentException('The specified view is invalid');
        }

        $this->contentFile = $contentFile;
    }
}
?>