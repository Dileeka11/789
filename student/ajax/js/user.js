$("document").ready(function () {
  $("#create").click(function (event) {
    event.preventDefault();
    //-- ** Start Error Messages
    if (!$("#name").val() || $("#name").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Enter name.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (!$("#username").val() || $("#username").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Enter Username..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (!$("#type").val() || $("#type").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Select User Type..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (
      $("#type").val() == 2 &&
      ($("#fedaration_name").val().length === 0 || !$("#fedaration_name").val())
    ) {
      swal({
        title: "Error!",
        text: "Please Select Fedaration Name..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (!$("#email").val() || $("#email").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Enter Email..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (!$("#phone").val() || $("#phone").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Enter Phone Number..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (!$("#password").val() || $("#password").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Enter Password..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else {
      //start preloarder
      $(".someBlock").preloader();
      //grab all form data

      var formData = new FormData($("#form-data")[0]); //grab all form data
      formData.append("create", "TRUE");

      $.ajax({
        url: "ajax/php/user.php",
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
    if (!$("#name").val() || $("#name").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Enter name.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (!$("#username").val() || $("#username").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Enter Username..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (!$("#type").val() || $("#type").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Enter type..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (
      $("#type").val() == 2 &&
      ($("#fedaration_name").val().length === 0 || !$("#fedaration_name").val())
    ) {
      swal({
        title: "Error!",
        text: "Please Select Fedaration Name..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (!$("#email").val() || $("#email").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Enter email..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (!$("#phone").val() || $("#phone").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Enter Phone..!",
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
        url: "ajax/php/user.php",
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
                window.location.href = "create-users.php";
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
  $("#type").change(function () {
    var type = $(this).val();
    if (type == "2") {
      $("#fedaration_name_section").removeClass("hidden");
    } else {
      $("#fedaration_name_section").addClass("hidden");
    }
  });
});
