<?php
/**
 * Created by PhpStorm.
 * User: kundan
 * Date: 6/10/21
 * Time: 11:31 AM
 */

namespace App\Http\Controllers;



use App\News;
use App\NewsChart;
use App\NewsData;
use App\NewsTag;
use App\Papers;
use App\Tagged;
use Illuminate\Http\Request;

/**
 * Class AdminNewsController
 * @package App\Http\Controllers
 */
class AdminNewsController extends Controller
{
    /**
     * @var User
     */
    private $model;


    /**
     * AdminNewsController constructor.
     * @param News $model
     */
    public function __construct(News $model)
    {
        $this->model = $model;
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = $this->model->query(); 
        $query = $query->join('news_sources', 'news_sources.id', 'news.source')
                ->select('news.*', 'news_sources.title as source_name')
                ->with('tags');
        if($request->has('search')){
            $search = $request->get('search');
            $query = $query->where(function($q) use ($search){
                $q->where('news.title','like',"%$search%")
                    ->orWhere('news.country','like',"%$search%")
                    ->orWhere('news.date','like',"%$search%")
                    ->orWhere('news.status','like',"%$search%")
                    ->orWhere('news.content_without_html_tags','like',"%$search%");
            });           
        }
        $records = $query->paginate(10);

        return view('admin.news.index',['records' => $records]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $news = $this->model->find($id);
        return view('admin.news.show',['news' => $news]);
    }
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        $img_path = storage_path('app') . $model->thumbnail;

        if(file_exists($img_path) && !is_dir($img_path)){
            unlink($img_path);
        }
        $model->papers()->sync([]);
        $model->tags()->sync([]);
        $model->charts()->sync([]);
        $model->delete();
        
        return redirect()->back()->with('message','News Deleted Successfully');
    }
    public function deleteAll()
    {
        News::truncate();
        NewsTag::truncate();
        NewsData::truncate();
        NewsChart::truncate();
        return redirect()->back()->with('message','All News Deleted Successfully');
    }
}