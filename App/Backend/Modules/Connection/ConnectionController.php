<?php 
namespace App\Backend\Modules\Connection;

use Frame\BackController;
use Frame\HTTPRequest;

class ConnectionController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        if($request->postExists('login'))
        {
            $login = $request->postData('login');
            $password = $request->postData('password');

            if ($login == $this->app->config()->get('login')
            && $password == $this->app->config()->get('pass'))
            {
                $this->app->user()->setAuthenticated(true);
                $this->app->httpRequest()->redirect('.');
            }

            else
            {
                $this->app->user()->setFlash('The username or the password is wrong.');
            }
        }
    }
}

?>