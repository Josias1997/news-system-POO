<?php 
namespace App\Backend\Modules\News;

use Frame\BackController;
use Frame\HTTPRequest;


class NewsController extends BackController
{
    public function executeIndex(HTTPRequest $request)
    {
        $this->page->addVar('title', 'News managing');

        $manager = $this->managers->getManagerOf('News');

        $this->page->addVar('listNews', $manager->getList());
        $this->page->addVar('numbNews', $manager->count());
    }
}
?>