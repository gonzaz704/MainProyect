'use strict';
function ProfileWizard() {
	
	this.stepNumber = 0;
	this.frm_followings = "frm_followings";
	this.body_followings = "body_followings";
	this.route_images = "";
	this.route_profile = "";

}

ProfileWizard.prototype.start = function () {

	this.create();
	this.observ_links();

};

ProfileWizard.prototype.set_route_img = function (route_images) {

	this.route_images = route_images;

};

ProfileWizard.prototype.set_route_profile = function (route_profile) {

	this.route_profile = route_profile;

};

ProfileWizard.prototype.create = function () {
  var self = this;

  // Smart Wizard
  $("#smartwizard").smartWizard({
    selected: 0,
    theme: "arrows",
    transitionEffect: "fade",
    showStepURLhash: true,

    useURLhash: true,
    lang: {
      next: "Siguiente",
      previous: "Anterior",
      finish: "Finish",
    },
    includeFinishButton: true,
  });

  $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
	  self.stepNumber = stepNumber;
  	if (stepNumber === 2) {
      self.set_body_followings();
    }
  });
};

ProfileWizard.prototype.get_frm = function () {

	var frm = null;
	if( this.stepNumber == 0 ){

		frm = $("#frm_personal");
		
	}else if( this.stepNumber == 1 ){

		frm = $("#frm_intereses");

	}else if (this.stepNumber == 2){
		frm = $("#frm_followings");
	}

	return frm;

};

ProfileWizard.prototype.get_followings_posible = function () {

	var resp = null;
    $.ajax({
      type: "POST",
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: $("#body_followings").data("url"),
      data: {},
      cache: false,
      contentType: false,
      processData: false,
      async: false,
      success: function (response) {
        resp = JSON.parse(response);
      },
      error: function (jqXhr, textStatus, errorMessage) {
        // error callback
        resp = { msg: errorMessage, error: true };
      },
    });

	return resp;

};

ProfileWizard.prototype.set_body_followings = function (frm) {

	var resp = this.get_followings_posible();
	const container = $("#" + this.body_followings);
	container.empty();

	if(resp["error"] != undefined){
		if( resp["error"] == false ){
			if( resp["data"] != undefined ){
				const results = resp["data"];
				results.map((result) => {
					container.append(`
						<div class="col-sm-4">
							<div class="card" align="center">
								<div class="card-block" style="padding:20px;">
									<h4 class="card-subtitle">
									${result.name}
									</h4>
									<img  src="${result.foto ? result.foto : '/images/no-avatar.png'}" height="250px" width="250">
									<br>
									<span>Papers : ${result.papers_count}</span>
									</br>
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="${result.id}" name="followings[]">
									</div>
								</div>
							</div>
						</div>
					`);
				});
				 
				var len = results.length;
				if(len === 0){
					const content = `<div class="col-sm-12">
						<div class="card" align="center">
							<div class="card-block">
								<h4 class="card-subtitle">No Users Found with similar Interest</h4>
								<a href="/">Go to Dashboard</a>
							</div>
						</div>
						</div>`;
                    container.html(content);
				}
			}
		}
	}
};


ProfileWizard.prototype.get_form = function (frm) {

	var imgdata = null;
	if( this.stepNumber == 0 ){
		if($("#foto").length)
			if($("#foto")[0].files.length)
				imgdata = $("#foto")[0].files[0];
	}

	var form = new FormData();

	if(imgdata!=null){
    	form.append("foto",imgdata);
   	}
   	var items = frm.serializeArray();
   	for(var item in items){
   		form.append(items[item]["name"],items[item]["value"]);
   	}

   	return form;

};

ProfileWizard.prototype.to_save = function () {

	var frm = this.get_frm();
	var form = this.get_form(frm);
	var resp = null;
    $.ajax({
		type: 'POST',
		headers: {
   			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
    	url: frm.attr("action"),
    	data: form,
    	cache: false,
    	contentType : false,
    	processData: false,
    	async:false,
    	success: function (response){

			resp = JSON.parse(response);

    	},
		error: function (jqXhr, textStatus, errorMessage) { // error callback 
    		resp = { msg:errorMessage, error:true };
		}
	});

	return resp;

};

ProfileWizard.prototype.observ_links = function () {

	var self = this;

	$("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
		
		var pass = true;

		if( "forward" == stepDirection){

  			var resp = self.to_save();
  			if( resp!= undefined && resp != null ){

  				if( resp.error ){
  					alert(resp.msg);
  					pass = false;
  				}
  			}else{
  				alert('Error: no se obtuvo respuesta del guardado');
  				pass = false;
  			}
  			
  		}

  		return pass;

	});

};

