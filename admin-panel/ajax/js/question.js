$(document).ready(function () {
  $("#create").click(function (event) {
    event.preventDefault();
    tinymce.triggerSave();
    if (!$("#module").val() && $("#module").length) {
      swal({
        title: "Error!",
        text: "Please select a module.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
      return false;
    } else if (!$("#question").val() && $("#question").length) {
      swal({
        title: "Error!",
        text: "Please enter question (English).",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
      return false;
    } else if (!$("#question_sinhala").val() && $("#question_sinhala").length) {
      swal({
        title: "Error!",
        text: "Please enter question (Sinhala).",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#question_tamil").val() && $("#question_tamil").length) {
      swal({
        title: "Error!",
        text: "Please enter question (Tamil).",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (
      !$("#correct_answer").val() ||
      $("#correct_answer").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please enter correct answer..!",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else {
      //start preloarder
      $(".someBlock").preloader();
      //grab all form data
      var formData = new FormData($("#form-data")[0]); //grab all form data
      $.ajax({
        url: "ajax/php/question.php",
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (result) {
          //remove preloarder
          $(".someBlock").preloader("remove");
          if (result.status === "success") {
            swal({
              title: "success!",
              text: "Your data saved successfully !",
              type: "success",
              timer: 2000,
              showConfirmButton: false,
            });
            window.setTimeout(function () {
              window.location.reload();
            }, 2000);
          } else if (result.status === "error") {
            swal({
              title: "Error!",
              text: "Something went wrong",
              type: "error",
              timer: 2000,
              showConfirmButton: false,
            });
          }
        },
      });
    }
    return false;
  });
  //---------- End Create Data ---------
  //------------------------------------
  //---------- Start Edit Data ---------
  $("#update").click(function (event) {
    event.preventDefault();
    tinymce.triggerSave();
    //-- ** Start Error Messages
    //-- ** Start Error Messages
    if (!$("#module").val() && $("#module").length) {
      swal({
        title: "Error!",
        text: "Please select a module.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
      return false;
    } else if (!$("#question").val() && $("#question").length) {
      swal({
        title: "Error!",
        text: "Please enter question (English).",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
      return false;
    } else if (!$("#question_sinhala").val() && $("#question_sinhala").length) {
      swal({
        title: "Error!",
        text: "Please enter question (Sinhala).",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#question_tamil").val() && $("#question_tamil").length) {
      swal({
        title: "Error!",
        text: "Please enter question (Tamil).",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (
      !$("#correct_answer").val() ||
      $("#correct_answer").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please Enter Correct answer  ..!",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else {
      //start preloarder
      $(".someBlock").preloader();
      //grab all form data
      var formData = new FormData($("#form-data")[0]);
      $.ajax({
        url: "ajax/php/question.php",
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (result) {
          //remove preloarder
          $(".someBlock").preloader("remove");
          if (result.status === "success") {
            swal({
              title: "success!",
              text: "Your data updated successfully !",
              type: "success",
              timer: 2000,
              showConfirmButton: false,
            });
            window.setTimeout(function () {
              window.location.reload();
            }, 2000);
          } else if (result.status === "error") {
            swal({
              title: "Error!",
              text: "Something went wrong",
              type: "error",
              timer: 2000,
              showConfirmButton: false,
            });
          }
        },
      });
    }
    return false;
  });
});
