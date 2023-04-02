<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NAcademico;
use Yajra\Datatables\Datatables;

class NivelAcademicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('catalogs.nacademico.index');
    }

    public function get_datatable()
    {
        return Datatables::of(NAcademico::query())->make(true);
    }

    public function to_save(Request $request)
    {

        try{

            $response = array("status"=>400, "message"=>"");

            if( empty(  $request['nombre']  )   ){
                $response["message"] = "El campo nombre es requerido y no debe estar vacio";
            }else{

                // SE TRATA DE UNA INSERCIÓN
                $mge = "";
                $activo = empty(    $request['activo']  )   ?   '0' :   $request['activo'];
                if( empty(  $request["id_catalog"]  )   ){

                    $na = new NAcademico();
                    $na->created_at = date("Y-m-d h:i:s");
                    $na->updated_at = null;
                    $mge = "Se ha creado el registro";
                    
                }else{
                    // SE TRATA DE UNA EDICIÓN
                    $na = NAcademico::find( $request["id_catalog"]     );
                    $na->updated_at = date("Y-m-d h:i:s");
                    $mge = "Se ha editado el registro";
                    
                }

                $na->nombre = $request['nombre'];
                $na->descripcion = $request['descripcion'];
                $na->activo = $activo;

                $na->save();

                $response["message"] = $mge;
                $response["status"] = 200;

            }


        } catch (Exception $e) {
            $response["message"] = $e->getmessage();
            $response["status"] = 400;
        }

        return json_encode($response);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if( empty($id) )
            $id     =   0;

        try {
            $record = NAcademico::findOrFail( $id     )->toArray();
        } catch(\Exception $exception){

            return json_encode( array("status"=>400,"message"=>$exception->getmessage(), "data"=>"" ) );

        }

        return json_encode( array(
                "status"=>200,
                "message"=>"",
                "data" => $record
            )
        );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

        if( empty($id) ){

            return json_encode( array(
                    "status"=>500,
                    "message"=>"Registro no encontrado para eliminar"
                )
            );

        }else{

            $record = NAcademico::find( $id     );
            $result = $record->delete();

            if ($result) {
                $response = array("status"=>200,"message"=>"Registro se ha eliminado");
            }else{
                $response = array("status"=>400,"message"=>"No se pudo eliminar el registro");
            }
    
            return json_encode( $response );

        }

    }
}
