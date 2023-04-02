	/*
	 * NAcademico_Catalog.js
	 * version: 0.0.1 (23/08/2018)
	 *
	 *
	 */

    "use strict";

	function NAcademico_Catalog (lang_path, mod_path) {
    
        Catalog.call(this, lang_path, mod_path);

        this.maxlength_desc = 100;

    }

    NAcademico_Catalog.prototype = new Catalog();


    NAcademico_Catalog.prototype.to_list = function () {

    	this.set_dt_strbutton_add('<div class="table-tools-actions"><button type="button" class="btn btn-success" style="margin-left:12px" id="btn_add">Agregar</button></div>');

        this.set_init_dt();

        this.construct_validate();

    };

    NAcademico_Catalog.prototype.set_init_dt = function () {

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
                                        { "sTitle": "Nombre", "mData": "nombre"  },
                                        { "sTitle": "Descripci&oacute;n", "mData": "descripcion" },
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

        this.reset_ctrl_maxlength();

    };


    NAcademico_Catalog.prototype.to_add = function () {
        
        $('#tittle_modal').html('Agregar Nivel Académico');

        this.clean_ctrls(["id_catalog", "nombre", "descripcion"]);

        this.reset_ctrl_maxlength();

        $("#"+this.win_mdl_catalog).modal("show");

        $('#nombre').focus();

    };

    NAcademico_Catalog.prototype.trigger_save = function () {

        this.recargar_tabla();
        $("#"+this.win_mdl_catalog).modal("hide");
        this.reset_form();
        
    };

    NAcademico_Catalog.prototype.prepare_editar = function(datos){
            
        this.reset_form();

        if ( Object.keys(datos).length ) {

            $('#tittle_modal').html('Editar Nivel Académico');

            this.reset_ctrl_maxlength();
                    
            $('#id_catalog').val(datos.id);
            $('#nombre').val(datos.nombre);
            $('#descripcion').val(datos.descripcion ? datos.descripcion : '');

            if(parseInt(datos.activo)===1)
                $('#activo').prop('checked', true);
            else
                $('#activo').prop('checked', false);

            $("#"+this.win_mdl_catalog).modal("show");

            $('#nombre').focus();    
        }
        
    };


    NAcademico_Catalog.prototype.reset_ctrl_maxlength = function(){

        $('#max-length-element').html(this.maxlength_desc);
        
        $('#descripcion').restrictLength( $('#max-length-element') );

    };



    