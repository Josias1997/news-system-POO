<?php
namespace App\Frontend\Modules\News;

use Frame\BackController;
use Frame\HTTPRequest;
use Frame\Application;

class NewsController extends BackController {

    public function executeIndex(HTTPRequest $request) {
        $numbNews = $this->app->config()->get('numb_news');

        $numbCharacters = $this->app->config()->get('numb_characters');


        $this->page->addVar('title', 'The last '.$numbNews.' news');

        $manager = $this->managers->getManagerOf('News');



        $listNews = $manager->getList(0, $numbNews);

        foreach($listNews as $news) {
            if (strlen($news->content()) > $numbCharacters) {
                $deb = substr($news->content(), 0, $numbCharacters);
                $deb = substr($deb, 0, strrpos($deb, ' ')).'...';

                $news->setContent($deb);
            }
        }

        $this->page->addVar('listNews', $listNews);
    }

    public function executeShow(HTTPRequest $request) {
        $news = $this->managers->getManagerOf('News')->getUniq($request->getData('id'));

        if (empty($news)) {
            $this->app->httpResponse()->redirect404();
        }

        $this->page->addVar('title', $news->title());
        $this->page->addVar('news', $news);
        $this->pagge->addVar('comments', $this->managers->getManagerOf('Comments')
        ->getListOf($news->id()));
    }

    public function executeInsertComment(HTTPRequest $request) {
        $this->page->addVar('title', 'Adding a comment');

        if ($request->postExists('pseudo')) {
            $comment = new Comment([
                'news' => $request->getData('news'),
                'author' => $request->postData('pseudo'),
                'content' => $request->postData('content')
            ]);


            if ($comment->isValid()) {
                $this->managers->getManagerOf('Comments')
                ->save($comment);

                $this->app->user()-setFlash('The comment has been added successfully');

                $this->app->httpResponse()->redirect('news-'.$request->getData('news').'.html');
            }
            else {
                $this->page->addVar('errors', $comment->errors());
            }

            $this->page->addVar('comment', $comment);
        }
    }
}
?>