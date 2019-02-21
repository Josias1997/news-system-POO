<?php 
namespace Frame;

use Frame\Page;

class HTTPResponse {
    protected $page;

    public function addHeader($header) {
        header($header);
    }

    public function redirect($location) {
        header('location: '.$location);
        exit;
    }

    public function redirect404() {
        $this->page = new Page($this->app);
        $this->page->setContentFile(__DIR__.'/../../Errors/404.html');

        $this->addHeader('HTTP/4.0 404 Not Found');

        $this->send();
    }

    public function sent() {

        exit($this->page->generatedPage());
    }

    public function setPage(Page $page) {
        $this->page = $page;
    }

    public function setCookie($name, $value = '', $expire = 0, $path = null,
    $domain = null, $secure = false, $httpOnly = true) {
        setCookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }
}
?>