<?php

namespace App\Http\Controllers; // encapsula la clase controller por si se usa en otro lado y se repite

use App\Notifications\PapperFeedbackNotification;
use App\Tag;
use App\News;
use App\User;
use App\Chart;
use Exception;
use App\Tagged;
use App\Category;
use App\ModelTag;
use App\PapersTag;
use Carbon\Carbon;
use App\Discussion;
use App\PaperReview;
use App\PaperFeedback;
use App\PaperDiscussion;
use App\Events\TaggedEvent;
use App\Country_for_filters;
use Illuminate\Http\Request;
use App\Events\UserRankEvent;
use App\Notifications\PeerReview;
use App\Notifications\VerifyPaper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Notifications\FeedbackNotification;
use App\Notifications\ApprovedPaperNotification;
use App\Papers; //tiene que ver con el namespace, solo va al lugar indicado (en este caso papers)
use App\Helpers\PaperHelper;
use App\Helpers\UserHelper;

/**
 * Class PapersController
 * @package App\Http\Controllers
 */
class PapersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paper_helper = new PaperHelper();
        $user = $paper_helper->getUserById(Auth::user()->id);

        $keyword = $request->get('search');
        
        $query = Papers::query();

        if ($keyword != "") {
            $query = $query->where('titulo', 'like', '%' .  $keyword. '%');
        }

        //$query = $query->where('reviewed', 1)->where('creado_por_id', Auth::user()->id);
        $query = $query->where('status', 1)->where('creado_por_id', Auth::user()->id);
        $papers = $query->with('tags')->get();
       
        $charts = Chart::where('status', 1)->where('user_id', Auth::user()->id)->get();
        $papers = collect($papers);
        $charts = collect($charts);

        $papers = $papers->merge($charts)->sortByDesc('created_at');
        return view("papers.index", compact('papers', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("papers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * @param Request $request
     * @return false|string
     */
    public function save_json(Request $request)
    {

        $a_result = $this->save($request, false);

        if ($a_result["error"]) {
            return json_encode(array("status" => 400, "message" => "Error al guardar Papper"));
        } else {
            return json_encode(array("status" => 200, "message" => "Se ha guardado el Papper"));
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Papers $papers
     * @return \Illuminate\Http\Response
     */


    public function save(Request $request, $redirect = true)
    {
        $a_result = ["error" => true, "msg" => "Categoria NO Guardada"];
        try {
            $images = $request->file('charts') ?? [];
            $destinationPath = public_path('/images');
            $ruta_grafico = [];
            foreach ($images as $image) {
                $imagename = md5(uniqid(rand(), true)) . '.' . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imagename);
                array_push($ruta_grafico, $imagename);
            }
            $data = $request->all();
            foreach($data['tags'] as $index => $tag)
            {
            $tags_data=Tag::where('id',$tag)->first();
                if(!$tags_data)
                {
                    $new_tag_data=[
                        'name'=>$tag,
                        'slug'=>strtolower($tag),
                        'is_papers_tags'=>1
                    ];
                    $new_tag=Tag::create($new_tag_data);
                    $data['tags'][$index]=(string)$new_tag->id;
                }
            }
            $data['ruta_grafico'] = $ruta_grafico;
            $data['creado_por_id'] = Auth::user()->id;
            
            $paper = Papers::create($data);
            
            if ($paper->author && $paper->author !== Auth::user()->email) {
                try {
                    $paper->notify(new VerifyPaper($paper));
                } catch (Exception $e) {
                    Log::error($e->getMessage());
                }
            } else {
                $data['verified'] = 1;
            }

            $paper->tags()->sync($data['tags'] ?? []);
            event(new UserRankEvent(config('points.paper')));
            if (!$paper->reviewed) {
                $authors = User::where('type', 'Researcher')
                    ->where('id', '!=', Auth::user()->id)
                    ->inRandomOrder()->limit(3)->get();
                foreach ($authors as $author) {
                    try {
                        PaperReview::create([
                            'paper_id' => $paper->id,
                            'user_id' => $author->id
                        ]);
                        $author->notify(new PeerReview($paper));
                    } catch (Exception $e) {
                        Log::error($e->getMessage());
                    }
                }
            }

            $a_result["msg"] = "Categoria guardada";
            $a_result["error"] = false;
        } catch (Exception $e) { //se llena la variable $e con el error y podria aparecer entre estas llaves
            echo $e;
        }
        if ($request->ajax()) {
            return response()->json('Paper added Successfully');
        }
        // return json_encode($a_result);
        return $redirect ? redirect()->route('data.index')->with('message', 'Your paper has been sent to admin approval. We will notify you when the paper review is completed and it can be matched with the news') : $a_result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria $categoria
     * @return \Illuminate\Http\Response
     */

    public function show(Papers $papers)
    {
    }


    /**
     * @param Papers $paper
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Papers $paper)
    {
        return view('papers.edit', ['model' => $paper]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Papers $paper, $redirect = true)
    {
        $a_result = ["error" => true, "msg" => "Categoria NO Guardada"];
        $data = $request->all();
        try {
            $images = $request->file('charts');
            if (isset($images)) {
                //remove files
                if (is_array($paper->ruta_grafico)) {
                    foreach ($paper->ruta_grafico as $image) {
                        if (file_exists(public_path() . '/images/' . $image)) {
                            unlink(public_path() . '/images/' . $image);
                        }
                    }
                }


                $destinationPath = public_path('/images');
                $ruta_grafico = [];
                foreach ($images as $image) {
                    $imagename = md5(uniqid(rand(), true)) . '.' . $image->getClientOriginalExtension();
                    $image->move($destinationPath, $imagename);
                    array_push($ruta_grafico, $imagename);
                }
                $data['ruta_grafico'] = $ruta_grafico;
            }

            $paper->update($data);
            $paper->tags()->sync($data['tags'] ?? []);
            $a_result["msg"] = "Categoria guardada";
            $a_result["error"] = false;
        } catch (Exception $e) { //se llena la variable $e con el error y podria aparecer entre estas llaves
            echo $e;
        }
        if ($request->has('referer')) {
            return redirect($request->get('referer'));
        }
        // return json_encode($a_result);
        return $redirect ? redirect()->route('data.index') : $a_result;
    }


    /**
     * @param Papers $paper
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Papers $paper, $id)
    {
        $paper = Papers::find($id);
        if (is_array($paper->ruta_grafico)) {
            foreach ($paper->ruta_grafico as $image) {
                if (file_exists(public_path() . '/images/' . $image)) {
                    unlink(public_path() . '/images/' . $image);
                }
            }
        }
        if($paper->delete()){
            $paper->tags()->sync([]);
            return redirect(route("admin.papers.index"))->with('message', 'Record deleted successfully');
        }else{
            return redirect(route("admin.papers.index"))->with('message', 'Something went wrong');
        }
    }

    public function deleteAll(Request $request)
    {        
        $ids = $request->ids;
        $papers = Papers::whereIn('id',explode(",",$ids))->delete();
        $data = [
            'success' => true,
            'message'=> 'Records deleted successfully.'
          ] ;
        if($papers){
            return response()->json($data);
        }else{
            return response()->json(['message'=> 'Something went wrong']);
        }        
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function actualizar(Request $request)
    {
        $papers = Categoria::find($request["id"]);
        $papers->titulo = $request["titulo"];
        $papers->conclusiones_1 = $request["conclusiones_1"];
        $papers->save();

        return redirect("/papers");
    }

    /**
     * @param $paper_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewPaperDetail($paper_id, UserHelper $userHelper)
    {
        $paper = Papers::findOrFail($paper_id);
        $paperfeedback= PaperFeedback::where('paper_id', $paper_id)->get();
        return view('papers.view', ['paper' => $paper,'paperfeedback'=>$paperfeedback,'userHelper'=>$userHelper]);
    }

    public function details($id)
    {
        $paper = Papers::findOrFail($id);
        $review = PaperReview::where('paper_id', $id)->where('user_id', Auth::user()->id)->first();
        $feedback = PaperFeedback::where('paper_id', $id)->where('user_id', Auth::user()->id)->first();
        return view('papers.details', ['paper' => $paper, 'review' => $review, 'feedback' => $feedback]);
    }

    public function confirm($id)
    {
        $paper = Papers::findOrFail($id);
        $paper->update([
            'verified' => 1
        ]);
        try {
            $paper->createdBy->notify(new ApprovedPaperNotification($paper));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect('/');
    }

    public function reject($id)
    {
        $paper = Papers::findOrFail($id);
        $paper->update([
            'verified' => 2
        ]);
        try {
            $paper->createdBy->notify(new ApprovedPaperNotification($paper));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect('/');
    }

    public function feedback(Request $request)
    {
        $data = $request->all();
        PaperFeedback::updateOrCreate(['user_id' => $data['user_id'], 'paper_id' => $data['paper_id']], $data);
        $author = Papers::find($data['paper_id'])->createdBy;
        $author->notify(new FeedbackNotification());
        return redirect()->route('papers.reviews.index');
    }

    public function filter(Request $request)
    {
        $data = $request->all();
        $query = Papers::query();
        if (isset($data['user_id']) && $data['user_id'] != '') {
            $query = $query->where('creado_por_id', $data['user_id']);
        }
        if (isset($data['country']) && $data['country'] != '') {
            $users = User::where('country', $data['country'])->pluck('id');
            $query = $query->whereIn('creado_por_id', $users);
        }
        // $data['tags']='"'.implode('","',$data['tags']).'"';
        if (isset($data['tags']) && !empty($data['tags'])) {
            foreach($data['tags'] as $key => $tag) {
                if($key == 0) {
                    $query->where('tags', 'like', '%"'.$tag.'"%');
                } else {
                    $query->orWhere('tags', 'like', '%"'.$tag.'"%');
                }
            }
        }
        $papers = $query->where('status', 1)->select('titulo', 'id')->get();
        return response()->json(['data' => $papers]);
    }

    public function filterTags(Request $request)
    {   
        if($request->get('selected')){
            $selected = explode(',', $request->get('selected'));
            $papers = Papers::whereHas('tags', function ($q) use ($selected) {
                $q->whereIn('tags.id', $selected);
            })->with('tags')->get()->filter(function ($paper) use ($selected) {
                $tags = $paper->tags->pluck('id')->toArray();
                return count(array_intersect($selected, $tags)) === count($selected);
            });
            $tag_ids = $papers->pluck('tags')->collapse()->pluck('id');
            return Tag::whereIn('id', $tag_ids)->pluck('name', 'id');
        }
      
        return Tag::select('name','id','is_news_tags','is_charts_tags','is_papers_tags');

    }

    public function adminManagePapers(Request $request){
        $search = $request->search;
        if(isset($search)){
            $records = Papers::where("titulo", "like", "%$search%")
                ->with('createdBy')
//                ->orWhere("author_name", "like", "%$search%")
//                ->orWhere("author", "like", "%$search%")
                ->paginate(10);
        }else{
            $records = Papers::query()
                ->with('createdBy')
                ->paginate(10);
        }
        return view('admin.papers.index', ['records' => $records, 'search' => $search]);
    }

    public function adminApprovePapers($id){
        $records = Papers::where('id',$id)->update(['status' => 1]);
        if($records){
            return redirect(route("admin.papers.index"))->with('message', 'Paper is Approved successfully');
        }else{
            return redirect(route("admin.papers.index"))->with('message', 'Paper was not Approved. Something went wrong');
        }
    }

    public function adminRejectPapers($id){
        $records = Papers::where('id',$id)->update(['status' => -1]);
        if($records){
            return redirect(route("admin.papers.index"))->with('message', 'Paper is Rejected successfully');
        }else{
            return redirect(route("admin.papers.index"))->with('message', 'Paper was not Rejected. Something went wrong');
        }
    }

    public function adminEditPapers($id){
        $record = Papers::where('id',$id)->first();
        $tags = Tag::all();
        return view('admin.papers.edit', ['record' => $record, 'tags' => $tags]);
    }

    public function adminReviewPapers(Request $request, $id, UserHelper $userHelper){
        $data = $request->all();
        
        $query = Papers::query();
        if(isset($data['user_id']) && $data['user_id'] != ''){
            $query = $query->where('creado_por_id' ,$data['user_id']);
        }
        if(isset($data['country']) && $data['country'] != ''){
            $users = User::where('country',$data['country'])->pluck('id');
            $query = $query->whereIn('creado_por_id',$users);
        }
        if(isset($data['topic']) && $data['topic'] != ''){
            $query = $query->where('topic' ,$data['topic']);
        }
        $paper = $query->where('id', $id)->first();

        $paperfeedback= PaperFeedback::where('paper_id', $id)->get();
        
        return view('admin.papers.review', ['paper' => $paper, 'paperfeedback' => $paperfeedback, 'userHelper'=>$userHelper]);
    }

    public function adminReviewUpdatePapers(Request $request, $id)
    {
        $data  = [
            'description' =>  $request->feedback,
            'paper_id' => $id,
            'user_id' => Auth::user()->id,
        ] ;

        $paperFeedback = PaperFeedback::create($data);

        if($paperFeedback){

            $paper_helper = new PaperHelper();
            $papper = $paper_helper->getPaperById($id);

            if (Auth::user()->id == 1){

                $user = $papper->createdBy;
                $user->notify(new PapperFeedbackNotification($paperFeedback));

                return redirect(route("admin.papers.index"))->with('message', 'Paper feedabck added successfully');
            }else{
                $user =  $paper_helper->getUserById(1);
                $user->notify(new PapperFeedbackNotification($paperFeedback));

                return redirect()->back()->with('message', 'Paper feedabck added successfully');
            }

        }else{
            return redirect()->back()->with('message', 'Something went wrong');
        }
    }

    /**
     * @param Papers $paper
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPaper(Papers $paper)
    {
        return view('papers.update', ['model' => $paper]);
    }

    public function updatePaper(Request $request, Papers $paper)
    {
        $a_result = ["error" => true, "msg" => "Categoria NO Guardada"];
        try {
            $old_images = $request->file('old_charts') ?? [];
            $images = $request->file('charts') ?? [];
            $destinationPath = public_path('/images');
            $ruta_grafico = $old_images;
            foreach ($images as $image) {
                $imagename = md5(uniqid(rand(), true)) . '.' . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imagename);
                array_push($ruta_grafico, $imagename);
            }
            $data = $request->all();
            foreach($data['tags'] as $index => $tag)
            {
            $tags_data=Tag::where('id',$tag)->first();
                if(!$tags_data)
                {
                    $new_tag_data=[
                        'name'=>$tag,
                        'slug'=>strtolower($tag),
                        'is_papers_tags'=>1
                    ];
                    $new_tag=Tag::create($new_tag_data);
                    $data['tags'][$index]=(string)$new_tag->id;
                }
            }
            $data['ruta_grafico'] = $ruta_grafico;
            
            $paper->update($data);
            
            if ($paper->author && $paper->author !== Auth::user()->email) {
                try {
                    $paper->notify(new VerifyPaper($paper));
                } catch (Exception $e) {
                    Log::error($e->getMessage());
                }
            } else {
                $data['verified'] = 1;
            }

            $paper->tags()->sync($data['tags'] ?? []);
            event(new UserRankEvent(config('points.paper')));
            if (!$paper->reviewed) {
                $authors = User::where('type', 'Researcher')
                    ->where('id', '!=', Auth::user()->id)
                    ->inRandomOrder()->limit(3)->get();
                foreach ($authors as $author) {
                    try {
                        PaperReview::create([
                            'paper_id' => $paper->id,
                            'user_id' => $author->id
                        ]);
                        $author->notify(new PeerReview($paper));
                    } catch (Exception $e) {
                        Log::error($e->getMessage());
                    }
                }
            }

            return redirect("/papers")->with('message', 'Your paper has been updated and sent to admin approval. We will notify you when the paper review is completed and it can be matched with the news');
        } catch (Exception $e) { //se llena la variable $e con el error y podria aparecer entre estas llaves
            echo $e;
        }
    }

    public function deletePaper(Papers $paper)
    {
        $paper->update(['status' => '0']);
        return redirect()->back()->with('message', 'Paper successfully deleted.');
    }

    public function restorePaper(Papers $paper)
    {
        $paper->update(['status' => '1']);
        return redirect()->back()->with('message', 'Paper successfully restored.');
    }
    
}
