$("document").ready(function () {
  $("#create").click(function (event) {
    event.preventDefault();
    //-- ** Start Error Messages
    if (!$("#year").val() || $("#year").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select year.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (!$("#batch").val() || $("#batch").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select batch..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (!$("#batch_start_date").val() || $("#batch_start_date").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please enter batch Start date..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (!$("#batch_end_date").val() || $("#batch_end_date").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please enter batch end date..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else {
      //start preloarder
      $(".someBlock").preloader();
      //grab all form data

      var formData = new FormData($("#form-data")[0]); //grab all form data

      $.ajax({
        url: "ajax/php/exam-period.php",
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (result) {
          //remove preloarder

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
              window.setTimeout(function () {
                window.location.reload();
              }, 4000);
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
    return false;
  });
  //---------- End Create Data ---------
  //------------------------------------
  //---------- Start Edit Data ---------
  $("#update").click(function (event) {
    event.preventDefault();
    //-- ** Start Error Messages
    if (!$("#year").val() || $("#year").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select year.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (!$("#batch").val() || $("#batch").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select batch..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (!$("#batch_start_date").val() || $("#batch_start_date").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please enter batch Start date..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (!$("#batch_end_date").val() || $("#batch_end_date").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please enter batch end date..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else {
      //start preloarder
      $(".someBlock").preloader();
      //grab all form data
      var formData = new FormData($("#form-data")[0]);
      $.ajax({
        url: "ajax/php/exam-period.php",
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (result) {
          //remove preloarder
          window.setTimeout(function () {
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
                window.location.href = "create-exam-period.php";
              }, 4000);
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
    return false;
  });
});
