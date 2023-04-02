@extends('layouts.main')

@section('content')
    

	<div class="row">

		<div id="alertas">
        </div>

		<div class="col-sm-12">

			<h1>Intereses</h1>
			
			<div class="table-responsive">
				<table class="table table-striped" id="mitabla">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Descripción</th>
							<th>Activo</th>
							<th>Acciones</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>

	</div>





	

	<div class="modal" role="dialog" id="mdl_catalog">


        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span id="tittle_modal">a</span></h4>
                </div>

                <form class="form form-horizontal" id='frm_crear_actualizar'>
                
                    <div class="modal-body">

                    

                        <div class="form-body">

                            <div class="form-group row">
                                
                                <input class="form-control" id="id_catalog" name="id_catalog" size="30" type="hidden" />

                                <label for="nombre" class="col-sm-3 col-form-label" style="text-align: right;">Nombre *</label>

                                <div class="col-sm-9">

                                    <input class="form-control" id="nombre" style="display:inline;" value="" data-validation="required" data-validation-error-msg="Nombre es requerido y no puede estar vacio" name="nombre" maxlength="150" size="30" type="text" />

                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="descripcion" class="col-sm-3 col-form-label" style="text-align: right;">Descripci&oacute;n</label>

                                <div class="col-sm-9">

                                    ( <span id="max-length-element">100</span> caracteres )

                                    <textarea name="descripcion" style="display:inline;" id="descripcion" class="form-control"></textarea>

                                </div>

                            </div>

                            
                            <div class="form-group row">


                                <div class="col-sm-5" style="text-align: right;">

                                    <label for="activo" >&nbsp;

                                        <input class="" style="display:inline;" checked id="activo" value="1" name="activo" type="checkbox" /> Activo

                                    </label>

                                </div>

                                                             
                            </div>

                            <br/>

                        </div>
                    
                    
                    </div>
                    <div class="modal-footer">

                        <div class="row">
                            <div class="col-sm-12 mb-1">

                                <button type="button" class="btn btn-white btn-cons btn-warning" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary btn-cons btn-add">Guardar</button>

                            </div>

                        </div>
                    </div>
                </form>

            </div>
            
        </div>

    </div>



	<script type="text/javascript" src="{{URL::to('/js/catalogs/Catalog.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('/js/catalogs/interes/Interes_Catalog.js')}}"></script>


	<script type="text/javascript">
		
		var recargar_tabla = null;

		var callback = function(){

		    lang_path   = "";
            base_path   = '{!! action("InteresController@get_datatable") !!}';
            to_save   = '{!! action("InteresController@to_save") !!}';
            to_show   = "{!! action('InteresController@show', [ 'id' => 'num_param']) !!}";

            obj_cat = new Interes_Catalog(lang_path, base_path);

            obj_cat.set_method_save(to_save);
            
            obj_cat.set_method_get_record(to_show);
            obj_cat.set_method_delete(to_show);

            obj_cat.to_list();            

            recargar_tabla = function(){
                obj_cat.recargar_tabla();
            }

	    };

	    if (
	        document.readyState === "complete" ||
	        (document.readyState !== "loading" && !document.documentElement.doScroll)
	    ) {
	        callback();
	    } else {
	        document.addEventListener("DOMContentLoaded", callback);
	    }

	</script>


@endsection
