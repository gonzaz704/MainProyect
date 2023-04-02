	/*
	 * Pais_Catalog.js
	 * version: 0.0.1 (23/08/2018)
	 *
	 *
	 */

    "use strict";

	function Pais_Catalog (lang_path, mod_path) {
    
        Catalog.call(this, lang_path, mod_path);

        this.maxlength_desc = 100;

    }

    Pais_Catalog.prototype = new Catalog();


    Pais_Catalog.prototype.to_list = function () {

    	this.set_dt_strbutton_add('<div class="table-tools-actions"><button type="button" class="btn btn-success" style="margin-left:12px" id="btn_add">Agregar</button></div>');

        this.set_init_dt();

        this.construct_validate();

    };

    Pais_Catalog.prototype.set_init_dt = function () {

    	var config_dt   = { 
                        "sDom": "<'row'<'col-md-6'l <'toolbar'>><'col-md-6'f>r>t<'row'<'col-md-12'p i>>",
                        "oTableTools": {
                                        "aButtons": [{
                                                "sExtends":    "collection",
                                                "sButtonText": "<i class='fa fa-cloud-download'></i>",
                                                "aButtons":    [ "csv", "xls", "pdf", "copy"]
                                                }]
                                        },
                        "aoColumns": [
                                        { "sTitle": "Nacionalidad", "mData": "nacionalidad"  },
                                        { "sTitle": "Nombre", "mData": "nombre" },
                                        { "sTitle": "Activo", "mData": "activo" },
                                        { "sTitle": "Acciones" }
                                    ],
                        "aoColumnDefs": [
                                            { "bSortable": false, "aTargets": [ 3 ] },
                                            {
                                                "mRender": function ( data, type, row ) {
                                                        if(type === 'display'){
                                                            return obj_cat.get_links('obj_cat',row.id);
                                                        }else
                                                            return '';
                                                    },
                                                "aTargets": [ 3 ]
                                            },
                                            {
                                                "mRender": function ( data, type, row ) {
                                                        if(type === 'display'){
                                                            return Number(data) ? 'Activo' : 'Inactivo';
                                                        }else
                                                            return '';
                                                    },
                                                "aTargets": [ 2 ]
                                            }
                                        ],
                        "aaSorting": [[ 0, "asc" ]],
                        "oLanguage": {
                                        "sLengthMenu": "_MENU_ ",
                                        "sInfo": "Mostrando <b>_START_ para _END_</b> de _TOTAL_ registro(s)"
                                    },
                        "bProcessing": true,
                        "bServerSide": true,
                        "ajax": this.mod_path,
        };

        this.init_dt(config_dt);

    };


    Pais_Catalog.prototype.to_add = function () {
        
        $('#tittle_modal').html('Agregar País');

        this.clean_ctrls(["id_catalog", "nacionalidad", "nombre"]);

        $("#"+this.win_mdl_catalog).modal("show");

        $('#nacionalidad').focus();

    };

    Pais_Catalog.prototype.trigger_save = function () {

        this.recargar_tabla();
        $("#"+this.win_mdl_catalog).modal("hide");
        this.reset_form();
        
    };

    Pais_Catalog.prototype.prepare_editar = function(datos){
            
        this.reset_form();

        if ( Object.keys(datos).length ) {

            $('#tittle_modal').html('Editar País');

                    
            $('#id_catalog').val(datos.id);
            $('#nacionalidad').val(datos.nacionalidad);
            $('#nombre').val(datos.nombre);

            if(parseInt(datos.activo)===1)
                $('#activo').prop('checked', true);
            else
                $('#activo').prop('checked', false);

            $("#"+this.win_mdl_catalog).modal("show");

            $('#nacionalidad').focus();    
        }
        
    };


    