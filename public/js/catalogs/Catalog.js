/*
 * Catalogo.js
 * version: 0.0.1 (2/05/2018)
 *
 *
 */

    "use strict";

    function Catalog(lang_path, mod_path) {
        // lang of datatable
        this.lang_path = lang_path;
        this.mod_path = mod_path;


        this.dt = null;
        this.dt_name = "mitabla";
        this.dt_config = {};
        this.method_list_ajax = "ajax_list";


        this.dt_strbutton_add = "";
        this.dt_name_add = "btn_add";



        this.win_mdl_catalog = "mdl_catalog"
        this.sfrm_catalog = "frm_crear_actualizar";
        this.method_save = "save";
        this.tag_alertas = 'alertas';

        this.method_get_record = "get_record";
        this.method_delete = "del_record";


        this.obj_class_tree = null;
        this.ident_item = 0;


    };

    Catalog.prototype.throw_err = function (mge) {
        throw { 
                name:        "System Error", 
                level:       "Show Stopper", 
                message:     mge, 
                toString:    function(){return this.name + ": " + this.message;}
        };
    }; 

    /**
     * for list data
     */

    Catalog.prototype.init_dt = function (config) {

        if(!Object.keys(config).length)
            this.throw_err("No contiene parámetros de configuración para el listado de datos")

        var self = this;

        this.dt = $("#"+this.dt_name).DataTable(config);

        this.configuration_dt();

    };

    
    Catalog.prototype.set_init_dt = function () {};

    Catalog.prototype.set_method_list_ajax = function (name) {

        this.method_list_ajax = name;

    };

    Catalog.prototype.set_dt_name_add = function (name) {

        this.dt_name_add = name;

    };

    Catalog.prototype.set_dt_strbutton_add = function (str_button) {

        this.dt_strbutton_add = str_button;

    };    


    Catalog.prototype.configuration_dt = function () {

        $("select[name='"+this.dt_name+"_length']").select2();

        if(!this.dt_strbutton_add.length)
            this.dt_strbutton_add = '<div class="table-tools-actions"><button type="button" class="btn btn-success" style="margin-left:12px" id="btn_add">Agregar</button></div>';


        $("div.toolbar").html(this.dt_strbutton_add);

        var self = this;
        $('#'+this.dt_name_add).on( "click",function() {
            self.to_add();
        });

    };

    Catalog.prototype.recargar_tabla = function(){

        this.dt.destroy();
        $('#'+this.dt_name+" tbody").empty();
        this.set_init_dt();

    };

    Catalog.prototype.to_list = function(){};

    Catalog.prototype.get_links = function(str_instance,data){

        var enlace = $('<a>').attr('onclick', 'js:'+str_instance+'.listado_editar('+data+')').attr('style', 'cursor: pointer;color:#ffffff').text('Editar').wrap('<div></div>').parent().html();

        var link = $('<span>').attr('class', 'btn btn-primary').html(enlace).wrap('<div></div>').parent().html();

        enlace = $('<a>').attr('onclick', 'js:'+str_instance+'.listado_eliminar('+data+')').attr('style', 'cursor: pointer;color:#ffffff').text('Eliminar').wrap('<div></div>').parent().html();

        link += " " + $('<span>').attr('class', 'btn btn-warning').html(enlace).wrap('<div></div>').parent().html();

        return link;

    };


    Catalog.prototype.listado_editar = function (iddata) {

        var self = this;

        var method = self.method_get_record.replace('num_param',iddata);

        $.ajax({
            url : method,
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : "get",
            data : {"info_id":iddata},
            async: false,
            success : function(data) {

                try{

                    var response = JSON.parse(data);

                    if ( response.status != undefined && response.message != undefined && response.data != undefined )

                        if (response.status != 200 && response.message.length )
                            self.put_mje(response.message,'danger');
                        else if (response.status == 200){

                            self.prepare_editar(response.data);

                        }else
                            self.put_mje('Hubo un error al realizar la operación','danger');
                    else{
                        self.put_mje('No hay datos de respuesta.','warning');
                    }

                }catch (e) {

                    self.put_mje('No hay datos de respuesta.','warning');
                        
                }

            },
            error: function(e) {
                console.log(e);
            }
        });

    };

    Catalog.prototype.listado_eliminar = function (data) {

        var self = this;

        var method = self.method_delete.replace('num_param',data);

        if (confirm("¿Desea eliminar el registro?")){
            $.ajax({
                url : method,
                type : "delete",
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {"info_id":data},
                async: false,
                success : function(data) {

                    try{

                        var response = JSON.parse(data);

                        if ( response.status != undefined && response.message != undefined )

                            if (response.status != 200 && response.message.length )
                                self.put_mje(response.message,'danger');
                            else if (response.status == 200){
                                self.put_mje(response.message,'success');
                                self.recargar_tabla();

                            }else
                                self.put_mje('No hay datos de respuesta.','warning');

                    }catch (e) {

                        self.put_mje('No hay datos de respuesta.','warning');
                        
                    }

                    },
                    error: function(e) {
                        console.log(e);
                    }
            });
        }

    };


    /**
     * for entry data
     */

    Catalog.prototype.clean_ctrls = function (arr_ctrols) {

        var len = arr_ctrols.length;
        for(var i=0;i < len; i++)
            if($("#"+arr_ctrols[i]))
                $("#"+arr_ctrols[i]).val('');

    };

    Catalog.prototype.set_win_mdl_catalog = function (name) {

        this.win_mdl_catalog = name;

    };

    Catalog.prototype.set_sfrm_catalog = function (name) {

        this.sfrm_catalog = name;

    };

    Catalog.prototype.set_method_save = function (name) {

        this.method_save = name;

    };

    Catalog.prototype.set_method_get_record = function (name) {

        this.method_get_record = name;

    };

    Catalog.prototype.set_method_delete = function (name) {

        this.method_delete = name;

    };

    

    

    

    Catalog.prototype.to_add = function () {};


    Catalog.prototype.construct_validate = function () {

        var self = this;

        $.validate({
            form : '#'+self.sfrm_catalog,

            modules : 'security',
            onError : function($form) {
                alert('Hay elementos que debe cuidar para poder procesar.');
            },
            onSuccess : function($form) {
                $.ajax({
                    url : self.method_save,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type : "post",
                    data : $('#'+self.sfrm_catalog).serialize(),
                    async: false,
                    success : function(data) {

                        try{

                            var response = JSON.parse(data);

                            if ( response.status != undefined && response.message != undefined )

                                if (response.status != 200 && response.message.length )
                                    self.put_mje(response.message,'danger');
                                else if (response.status == 200){
                                    self.put_mje(response.message,'success');
                                    self.trigger_save();

                                }
                        }catch (e) {

                            self.put_mje(e.message,'warning');

                        }
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });

                return false;
            },
            onElementValidate : function(valid, $el, $form, errorMess) {
            }
        });

    };

    Catalog.prototype.trigger_save = function () {};

    Catalog.prototype.put_mje = function (mje,tipo) {

        var html_base = '<div class="alert alert-'+tipo+'"> ';
        html_base += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        html_base += mje + ' </div>';
        
        $('#'+this.tag_alertas).html(html_base);
    
    };


    Catalog.prototype.prepare_editar = function(data){};

    Catalog.prototype.reset_form = function(){

        document.getElementById(this.sfrm_catalog).reset();

    };







    Catalog.prototype.get_item_sel_tree = function () {

        var nodeitem = null
        if(zTree == null || zTree == undefined)
            return nodeitem;

        var nodes = zTree.getSelectedNodes();
        if (nodes && nodes.length>0) {
            if (nodes[0].children && nodes[0].children.length > 0) {
                nodeitem = null;
            }else{
                nodeitem = nodes[0];
            }
        }

        return nodeitem;

    };

    Catalog.prototype.set_obj_class_tree = function (obj) {

        this.obj_class_tree = obj;

    }
