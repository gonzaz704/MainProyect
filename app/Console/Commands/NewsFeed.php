<?php

namespace App\Console\Commands;

use App\News;
use App\NewsSource;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;
use willvincent\Feeds\Facades\FeedsFacade;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PHPHtmlParser\Dom;

class NewsFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pulls the news from the feeds';

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
     * @return mixed
     */
    public function handle()
    {
        Log::info('Fetching News');
        $sources = NewsSource::get()->toArray();
        foreach ($sources as $news_source => $source) {
            $news_tags_map = [];
            //get news
            $feed = FeedsFacade::make([
                $source['url']
            ], $source['limit'] ?? config('feeds.default.limit'), true);
            $data = array(
                'title' => $feed->get_title(),
                'permalink' => $feed->get_permalink(),
                'items' => $feed->get_items()
            );
         
            foreach ($data['items'] as $key => $item) {
                $newsExists = News::where('url', $item->get_permalink())->first();
                $image_found = false;

                if (!$newsExists) {

                    //check for image in description
                    $description = (string) ($item->get_description());
                    $img_path = null;
                    $src = null;

                    if ($description !== "") {
                        try {
                            $content = (string) $item->get_content();
                            $crawler = new Crawler($content);
                            $images = $crawler->filterXPath('//img/@src')->each(function (Crawler $node, $i) {
                                return $node;
                            });

                            $image_found = isset($images[0]);                            

                            // If image not found, scrape the news page to pull images
                            if (!$image_found){
                                Log::info("\n 1st Attempt => images not found");                                
                                $client = new Client();

                                // Showing the allow_redirects for verbosity sake. This is on by default with GuzzleHTTP clients.
                                $request = $client->request('GET', $item->get_permalink(), ['allow_redirects' => true]);
                                Log::info("\n Second try to get images \n");
                                $dom = new Dom();
                                $domExample = $dom->loadStr($request->getBody()->getContents());
                                // The container element where image is located that is set in the config file will be used here to pull image
                                $images = $dom->find($source['image_element']);

                                if (isset($images[0])) {
                                    Log::info("2nd Attempt => image found");
                                    $src = $images[0]->getAttribute($source['image_attr']);
            
                                    if(isset($source['image_base_url'])){
                                        $src = $source['image_base_url'] . "/" . $src;
                                    }
            
                                    $parsed_url = parse_url($src);
                                    if(!isset($parsed_url['scheme'])){
                                        $parsed_url['scheme'] = "http";
                                    }
                                                        
                                    $src = build_url($parsed_url);                            
                                    $path_info = pathinfo($src);
                                    $filename = $path_info['filename'] . ".png";
                                    $path = 'app/news-images/' . $filename;
                                    $img_path = '/news-images/' . $filename;                                
                                }

                            }else{
                                Log::info("\n 1st Attempt => image found");     
                                $src = $images[0]->text();
                                $path_info = pathinfo($images[0]->text());
                                $filename = $path_info['filename'] . ".png";
                                $path = 'app/news-images/' . $filename;
                                $img_path = '/news-images/' . $filename;
                            }    
                        } catch(GuzzleException $e) {
                            print_r($e->getMessage());
                            continue;
                        }  
                    }
                    if ($src != ''){
                        Image::make($src)->resize(400, 300)->save(storage_path($path));
                        $n_news = News::create([
                            'url' => $item->get_permalink(),
                            'title' => $item->get_title(),
                            'description' => $item->get_description(),
                            'status' => 'draft',
                            'image' => $src,
                            'thumbnail' => $img_path,
                            'source' => $source['id'],
                            'content_without_html_tags' => trim(strip_tags($item->get_content())),
                            'date' => $item->get_date('Y.m.d H:i:s'),
                            'country' => $source['country']
                        ]);
                        $news_tags_map[] = $n_news->id;
                    }
                }
            }
        }
    }
}