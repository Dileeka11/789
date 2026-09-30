jQuery(document).ready(function () {
  $("#create").click(function (event) {
    event.preventDefault();

    if ($("#title").val() == "" && !$("#title").val()) {
      swal({
        title: "Error!",
        text: "Please enter the exam title..",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
      return false;
    } else if ($("#essay_paper").val() == "" && !$("#essay_paper").val()) {
      swal({
        title: "Error!",
        text: "Please attach paper (English)..",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
      return false;
      
    } else {
      //start preloarder
      $(".someBlock").preloader();
      var formData = new FormData($("#form-data")[0]); //grab all form data

      $.ajax({
        url: "ajax/php/theory-exam.php",
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (result) {
          window.setTimeout(function () {
            $(".someBlock").preloader("remove");

            if (result.status === "success") {
              swal({
                title: "success!",
                text: "Your data saved successfully !",
                type: "success",
                timer: 2000,
                showConfirmButton: false,
              });
              window.location.reload();
            } else if (result.status === "error") {
              swal({
                title: "Error!",
                text: "Something went wrong",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
              });
            }
          }, 2000);
        },
      });
    }
  });

 
  
});
