@extends('layouts.main')

@section('content') 


    <div class="row">

        <div id="alertas">
        </div>

        <div class="col-sm-12">

            <form id="frmimportpdf" method="POST" action="{{action("PdfToPapperssController@store")}}" enctype="multipart/form-data"> 

                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input> 
                
                <br>

                <div class="form-group">
                    <label for="pdf">Archivo PDF</label>
                    <input type="file" class="form-control" id="pdf" name="pdf">
                </div>

                <br>
                
                <button id="submit" type="button" class="btn btn-default">Importar</button>
            
            </form>

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

                                <label for="titulo" class="col-sm-3 col-form-label" style="text-align: right;">Título *</label>

                                <div class="col-sm-9">

                                    <input class="form-control" id="titulo" style="display:inline;" value="" data-validation="required" data-validation-error-msg="Título es requerido y no puede estar vacio" name="titulo" maxlength="500" size="30" type="text" />

                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="abstract" class="col-sm-3 col-form-label" style="text-align: right;">Abstract</label>

                                <div class="col-sm-9">

                                    <textarea name="abstract" rows="12" style="display:inline;" id="abstract" class="form-control"
                                    data-validation="required" data-validation-error-msg="Abstract es requerido y no puede estar vacio"></textarea>

                                </div>

                            </div>


                            <div class="form-group row">

                                <label for="conclusiones_1" class="col-sm-3 col-form-label" style="text-align: right;">Conclusi&oacute;n 1</label>

                                <div class="col-sm-9">

                                    <textarea name="conclusiones_1" rows="12" style="display:inline;" id="conclusiones_1" class="form-control"></textarea>

                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="conclusiones_2" class="col-sm-3 col-form-label" style="text-align: right;">Conclusi&oacute;n 2</label>

                                <div class="col-sm-9">

                                    <textarea name="conclusiones_2" style="display:inline;" id="conclusiones_2" class="form-control"></textarea>

                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="conclusiones_3" class="col-sm-3 col-form-label" style="text-align: right;">Conclusi&oacute;n 3</label>

                                <div class="col-sm-9">

                                    <textarea name="conclusiones_3" style="display:inline;" id="conclusiones_3" class="form-control"></textarea>

                                </div>

                            </div>


                            <div class="form-group row">

                                <label for="link_investigacion" class="col-sm-3 col-form-label" style="text-align: right;">Link de la investigación</label>

                                <div class="col-sm-9">

                                    <input class="form-control" id="link_investigacion" style="display:inline;" value="" name="link_investigacion" maxlength="500" size="30" type="text" />

                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="hashtags" class="col-sm-3 col-form-label" style="text-align: right;">Hashtags</label>

                                <div class="col-sm-9">

                                    <input class="form-control" id="hashtags" style="display:inline;" value="" name="hashtags" maxlength="500" size="30" type="text" />

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
    <script type="text/javascript" src="{{URL::to('/js/importar/PdfPapperss.js')}}"></script>


    <script type="text/javascript">

        var callback = function(){

            to_save   = '{!! action("PapersController@save_json") !!}';

            obj_cat = new PdfPapperss('', '');

            obj_cat.set_method_save(to_save);
            obj_cat.construct_validate();

            $("#submit").click(function(){
                obj_cat.to_import();
            });

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
