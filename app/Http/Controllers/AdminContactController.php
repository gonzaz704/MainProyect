<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    /**
     * @var Contact
     */
    private $model;


    /**
     * AdminNewsController constructor.
     * @param Contact $model
     */
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $query = $this->model->query();
        $records = $query->paginate(10);
        return view('admin.contact.index', ['records' => $records]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $model = $this->model->find($id);
        return view('admin.contact.show', ['model' => $model]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $model = $this->model->find($id);
        $model->delete();
        return redirect()->back()->with('message', 'Contact Deleted Successfully');
    }
}
