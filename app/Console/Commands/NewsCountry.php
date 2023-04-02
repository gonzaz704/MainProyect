<?php
/**
 * Created by PhpStorm.
 * User: kundan
 * Date: 7/13/21
 * Time: 12:39 PM
 */

namespace App\Console\Commands;


use App\News;
use Illuminate\Console\Command;

/**
 * Class NewsCountry
 * @package App\Console\Commands
 */
class NewsCountry extends Command
{
    /**
     * @var string
     */
    public $signature = "papers:news-country";

    /**
     * @var string
     */
    public $description = "Resets the country";

    /**
     *
     */
    public function handle()
    {
        News::whereNull('country')
            ->update([
               'country' => config('feeds.country')
            ]);
    }
}