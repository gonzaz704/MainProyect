/**
 * Created by jmauricio on 9/24/17.
 */

$(document).ready(function () {
  // country selector

  const value = $("#country").attr("value");
  $("#country").val(value);
  $(".tag-selector").select2({ tags: true });
  $("#newsDataModal").on("show.bs.modal", function (e) {
    const trigger = $(e.relatedTarget);
    const url = trigger.data("route");
    $.get(url).then(function (res) {
      $("#newsDataModal").find(".modal-body").empty().append(res);
      $(".tag-selector").select2({
        dropdownParent: $("#newsDataModal"),
      });
      CKEDITOR.replace("editor", {
        toolbar: [
          { name: "document", items: ["Source", "-", "-"] },
          {
            name: "clipboard",
            items: [
              "Cut",
              "Copy",
              "Paste",
              "PasteText",
              "PasteFromWord",
              "-",
              "Undo",
              "Redo",
            ],
          },
          {
            name: "forms",
            items: [
              "Form",
              "Checkbox",
              "Radio",
              "TextField",
              "Textarea",
              "Select",
              "Button",
            ],
          },
          "/",
          {
            name: "basicstyles",
            items: [
              "Bold",
              "Italic",
              "Underline",
              "Strike",
              "Subscript",
              "Superscript",
              "-",
              "CopyFormatting",
              "RemoveFormat",
            ],
          },
          {
            name: "paragraph",
            items: [
              "NumberedList",
              "BulletedList",
              "-",
              "Outdent",
              "Indent",
              "-",
              "Blockquote",
              "CreateDiv",
              "-",
              "JustifyLeft",
              "JustifyCenter",
              "JustifyRight",
              "JustifyBlock",
              "-",
            ],
          },
          { name: "links", items: ["Link", "Unlink"] },
          {
            name: "insert",
            items: ["Table", "HorizontalRule", "PageBreak"],
          },
          "/",
          {
            name: "styles",
            items: ["Styles", "Format", "Font", "FontSize"],
          },
          { name: "colors", items: ["TextColor", "BGColor"] },
          { name: "tools", items: ["Maximize", "ShowBlocks"] },
        ],
      });
    });
  });

  $(document).on("click", "#confirmBtn", function (e) {
    e.preventDefault();
    $("#popupform").submit();
  });

  $(document).on(
    "submit",
    "#newsDataModal form:not('#papers-filter')",
    function (e) {
		e.preventDefault();
		let topics = $(".topics").val();
		let charts = $('select[name="charts[]"]').val();
		let papers = $('select[name="papers[]"]').val();
		console.log(topics)

		if(topics==null){
			alert('Please select at least one topic!');
			return false;
		}
      
		if(charts==null && papers==null){
			alert('Please select at least one chart or a paper!');
			return false;
		}
      //let btnEl = $(this).find('button[type="submit"]');
      let btnEl = $(this).find("#confirmBtn");
      let btntxt = btnEl.text();
      //$(this).find('button[type="submit"]').addClass("disabled").attr("disabled", "disabled").text('Loading....');
      $(this)
        .find("#confirmBtn")
        .addClass("disabled")
        .attr("disabled", "disabled")
        .text("Loading....");
      const url = $(this).attr("action");
      const data = new FormData($(this)[0]);
      const method = $(this).attr("method");
      $.ajax({
        url: url,
        method: method,
        data: data,
        processData: false,
        contentType: false,
      }).then(function (res) {
        window.location.reload();
      });
    }
  );

  $(".news-data-slider").owlCarousel({
    loop: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 3,
        nav: true,
      },
    },
  });
  if ($("[data-slug]").length > 0) {
    $("[data-slug]").on("blur", function (e) {
      const text = $(this).val();
      const slug = text
        .toString()
        .toLowerCase()
        .replace(/\s+/g, "-") // Replace spaces with -
        .replace(/[^\w\-]+/g, "") // Remove all non-word chars
        .replace(/\-\-+/g, "-") // Replace multiple - with single -
        .replace(/^-+/, "") // Trim - from start of text
        .replace(/-+$/, ""); // Trim - from end of text
      $("[name=slug]").val(slug);
    });
  }

  $(document).on("submit", "#papers-filter", function (e) {
    e.preventDefault();
    const btn = $(this).find('button[type="submit"]');

    btn.addClass("disabled").attr("disabled", "disabled").text("Loading....");
    const data = new FormData($(this)[0]);
    const method = $(this).attr("method");
    const url = $(this).attr("action");
    $.ajax({
      url: url,
      method: method,
      data: data,
      processData: false,
      contentType: false,
    }).then(function (res) {
      btn.removeClass("disabled").prop("disabled", false).text("Filter");

      const papers = res.data;
      const conatiner = $("#news-data-papers");
      conatiner.empty();
      res.data.map((item) => {
        conatiner.append(`<option value=${item.id}>${item.titulo} </option>`);
      });
    });
  });

  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });

  $(document).on("click", "#chart-filter", function (e) {
    e.preventDefault();
    const btn = $(this).find('button[type="button"]');

    btn.addClass("disabled").attr("disabled", "disabled").text("Loading....");
    const method = "POST";
    const url = "charts/filter";
    let country = $("#country").val();
    let user_id = $("select[name=user_id]").val();
    let tags = $("#chart_tags").val();
	if(country==''){
		alert('This field is required!');
		return false;
	}
	if(country==''){
		alert('This field is required!');
		return false;
	}
    $.ajax({
      url: url,
      method: method,
      dataType: "json",
      data: {
        country: country,
        user_id: user_id,
        tags: tags,
      },
    }).then(function (res) {
      btn.removeClass("disabled").prop("disabled", false).text("Filter");

      const charts = res.data;
      const conatiner = $("#news-data-charts");
      conatiner.empty();
      res.data.map((item) => {
        conatiner.append(`<option value=${item.id}>${item.title} </option>`);
      });
    });
  });

  $(".overlay").on("click", function (e) {
    $("#foto").trigger("click");
  });
  $("#foto").on("change", function (e) {
    file = e.target.files[0];
    console.log(file);
    $("#avatar-changer").attr("src", URL.createObjectURL(file));
  });

  $(".notification_dropdown_read").on("click", function () {
    $.get("/notifications/read").then((res) => {
      $(this).find("a span.tag").text(res);
    });
  });
  $("#newsDataModal ").on("change", ".tag-selector", function () {
    const container = $(this);
    const url = $(this).data("url");
    let selected = $(this).val();
    if (!selected) {
      selected = [];
    }
    $.get(`${url}?selected=${selected.toString()}`).then((res) => {
      const len = Object.keys(res).length;
      if (len > 0) {
        container.empty();
        $("#newsDataModal .tag-helper").text("");
      } else {
        $("#newsDataModal .tag-helper").text("No Papers found with this tag");
      }

      for (var key of Object.keys(res)) {
        let select = "";
        if (selected.includes(key)) {
          select = "selected";
        }
        container.append(`<option value=${key} ${select}>${res[key]}</option>`);
      }
      container.select2();
    });
  });
});
