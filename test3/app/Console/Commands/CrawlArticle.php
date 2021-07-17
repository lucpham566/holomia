<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class CrawlArticle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = 'https://vnexpress.net/';

        $client = new Client();

        $crawler = $client->request('GET', $url);

        $crawler->filter('article.item-news')->each(function (Crawler $node) {
            if($node->text()){
                $client = new Client();
                $title = $node->filter('.title-news')->text();
                $url = $node->filter('.title-news a')->attr('href');
                dump($url);
                if($url){

                    $article = $client->request('GET', $url);
                    if( $article->filter('article.fck_detail')->count()){
                        $content = $article->filter('article.fck_detail')->html();
                        $time = $article->filter('.header-content .date')->text();
                        $new_article = new Article();
                        $new_article->title = $title;
                        $new_article->url = $url;
                        $new_article->content = $content;
                        $new_article->time = $time;
                        $new_article->save();
                    }
                }

            }

        });

        $this->info('Word of the Day sent to All Users');
    }
}
