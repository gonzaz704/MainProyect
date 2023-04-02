<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country_for_filters;


class FilterCountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $country = Country_for_filters::all(); // TODO: revisar con base de datos
        return view('admin.filters.countries.index', compact('country'));

        // filters/countries/index.blade.php
        /**
         * 
         *  foreach($country as $countries)
         *  <tr>
         *      <td>{{ $country->id }}</td>
         *      <td>{{ $country->name }}</td>
         *  </tr>
         * */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('filters.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = validate($request)
        Country::createIfNotExists($data);
        return redirect()->back(); // TODO: Revisar redireccion
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // POSIBLEMENTE NO LO USARÁS
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // /fiters/countries/1/edit
        $country = Country::find($id);
        return view('filters.countries.edit', $country);

        // filters.countries.edit
        // <input type="text" value="{{ country->name }}" >
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $country = Country::find($id);
        $country->country = $request->name;
        $country->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
