(function ($) {
  $(document).ready(function () {
    let maxField = 10; // Maximum number of fields allowed
    let addButton = $(".summary-conclusiones__addnew button"); //Add button selector
    let wrapper = $(".summary-conclusiones"); //Input field wrapper

    var x = 4; //Initial field counter is 1

    // Once add button is clicked
    $(addButton).click(function () {
      let fieldHTML = `
        <div class="form-group">
          <label for="ruta_grafico">Conclusion ${x}</label>
          <input type="text" class="form-control" id="ruta_conclusiones" name="conclusiones_${x}" required>
        </div>
      `;

      //New input field html
      // Check maximum number of input fields
      if (x < maxField) {
        x++; //Increment field counter
        $(wrapper).append(fieldHTML); //Add field html
      }
    });

    // // Once remove button is clicked
    // $(wrapper).on("click", ".remove_button", function (e) {
    //   e.preventDefault();
    //   $(this).parent("div").remove(); //Remove field html
    //   x--; //Decrement field counter
    // });

    $(".expandable-container").on("click", function ($event) {
      // Toggle aria-expanded property of span element
      let $span_elem = $(this).find("span");
      let expanded = $span_elem.attr("aria-expanded") === "true";
      $span_elem.attr("aria-expanded", !expanded);

      $(this).find("a").toggleClass("content-collapsed");
    });
  });
})(jQuery);
