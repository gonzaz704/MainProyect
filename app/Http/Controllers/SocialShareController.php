<?php

namespace App\Http\Controllers;

use App\News;
use App\Chart;
use App\Tagged;
use App\NewsData;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use willvincent\Feeds\Facades\FeedsFacade;

/**
 * Class SocialShareController
 * @package App\Http\Controllers
 */
class SocialShareController extends Controller
{
    /**
     * @param $id
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function socialShare($id, News $news,Request $request)
    {
        $referer = parse_url($request->server('HTTP_REFERER'))['host'];
        $host = $request->server('HTTP_HOST');
        if($referer != $host){
           return redirect()->route('news.details',$id);
        }
        $news = $news->where('id',$id)->first();
        $thumbnail = $news->thumbnail;
        $data = NewsData::where('confirmed', 1)->select('paper_id')->selectRaw("count(*) as total")->whereIn('paper_id', $news->papers->pluck('id'))
            ->groupBy('paper_id')->orderByRaw('count(*) DESC')->first();
        $paper_thumbnail = null;
        if($data){
            $paper = $data->paper;
            $width       = 600;
            $height      = 300;
            $center_x    = $width / 2;
            $center_y    = $height / 2;
            $max_len     = 100;
            $font_size   = 50;
            $font_height = 10;

            $text = strip_tags($paper->abstract);

            $lines = explode("\n", wordwrap($text, $max_len));
            $y     = $center_y - ((count($lines) - 1) * $font_height);
            $img = Image::canvas($width, $height, '#000000');

            foreach ($lines as $line)
            {
                $img->text($line, $center_x, $y, function($font) use ($font_size){
                    $font->size($font_size);
                    $font->color('#ffffff');
                    $font->align('center');
                    $font->valign('center');
                });

                $y += $font_height * 2;
            }
            $img->save(public_path("/$news->title-share.png"));
            $paper_thumbnail = "/$news->title-share.png";
        }
        $chart_thumbnail = null;
        $chart = $news->charts()->latest()->first();
        if ($chart) {
            $chart_thumbnail = $chart->template;
        }
        return view("data.edit",[
            'news'=>$news,
            'thumbnail' => $thumbnail,
            'paper_thumbnail' => $paper_thumbnail,
            'chart_thumbnail' => $chart_thumbnail]
        );
    }

}
