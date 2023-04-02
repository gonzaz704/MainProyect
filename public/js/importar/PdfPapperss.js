	/*
	 * PdfPapperss.js
	 * version: 0.0.2 (01/09/2018)
	 *
	 *
	 */


	'use strict';
	function PdfPapperss(lang_path, mod_path) {

		Catalog.call(this, lang_path, mod_path);

		this.frm_import = "frmimportpdf";
		this.tag_alertas = 'alertas';

	}

	PdfPapperss.prototype = new Catalog();

	PdfPapperss.prototype.get_form = function () {

		var filedata = null;

		if($("#pdf").length)
			if($("#pdf")[0].files.length)
				filedata = $("#pdf")[0].files[0];

		var form = new FormData();

		if(filedata!=null){
	    	form.append("pdffile",filedata);
	   	}
	   	var items = $("#"+this.frm_import).serializeArray();
	   	for(var item in items){
	   		form.append(items[item]["name"],items[item]["value"]);
	   	}

	   	return form;

	};

	PdfPapperss.prototype.import = function () {

		var form = this.get_form();

		var resp = null;
	    $.ajax({
			type: 'POST',
			headers: {
	   			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
	    	url: $("#"+this.frm_import).attr("action"),
	    	data: form,
	    	cache: false,
	    	contentType : false,
	    	processData: false,
	    	async:false,
	    	success: function (response){

				resp = JSON.parse(response);

	    	},
			error: function (jqXhr, textStatus, errorMessage) { // error callback
	    		resp = { message:errorMessage, status:400, data:"" };
			}
		});

		return resp;

	};


	PdfPapperss.prototype.to_import = function () {


		if($("#pdf").length)
			if( $("#pdf")[0].files.length <= 0 )
				return this.put_mje('Debe seleccionar un archivo de tipo PDF para importar.','danger');

		waitingDialog.show("Leyendo archivo pdf, favor de esperar");

		var response = this.import();

		if ( response.status != undefined && response.message != undefined && response.data != undefined ){

			waitingDialog.hide();
			if (response.status != 200 && response.message.length )
				this.put_mje(response.message,'danger');
			else if (response.status == 200){

				this.prepare_editar(response.data);

			}else
				this.put_mje('Hubo un error al realizar la operación','danger');
		}else{
			waitingDialog.hide();
			this.put_mje('No hay datos de respuesta.','warning');
		}

	};


	PdfPapperss.prototype.reset_form_pdf = function () {

		document.getElementById(this.frm_import).reset();

	};


	PdfPapperss.prototype.trigger_save = function () {

        $("#"+this.win_mdl_catalog).modal("hide");
        this.reset_form();
        this.reset_form_pdf();

    };

    PdfPapperss.prototype.prepare_editar = function(datos){

        this.reset_form();

        if ( Object.keys(datos).length ) {

            $('#tittle_modal').html('Secciones del Papper');

            $('#titulo').val(datos.tittle);

            $('#abstract').val(datos.abstract);

            $('#conclusiones_1').val(datos.conclusiones_1);
            $('#conclusiones_2').val(datos.conclusiones_2);


            $("#"+this.win_mdl_catalog).modal("show");

            $('#tittle_modal').focus();
        }

    };
