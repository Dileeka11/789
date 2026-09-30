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
    } else if (!$("#courses").val() || $("#courses").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Enter Atleast One Course..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (!$("#center").val() || $("#center").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Enter Center..!",
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

      $.ajax({
        url: "ajax/php/instructor.php",
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
    } else if (!$("#courses").val() || $("#courses").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Enter Atleast One Course..!",
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
        url: "ajax/php/instructor.php",
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
                window.location.href = "create-instructors.php";
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
  $('#students-table').on("click", ".update-instructor-status", function () {
    var id = $(this).attr("data-id");
    var status = $(this).attr("status");

    swal(
      {
        title: "Are you sure?",
        text:
          "Are you want to " +
          (status == 1 ? "Unblock" : "Block") +
          " this instructor!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, " + (status == 1 ? "Unblock" : "Block") + "!",
        closeOnConfirm: false,
      },
      function () {
        $.ajax({
          url: "ajax/php/instructor.php",
          type: "POST",
          data: { id: id,status: status, option: "UPDATESTATUS" },
          dataType: "JSON",
          success: function (jsonStr) {
            if (jsonStr.status) {
              swal({
                title: (status == 1 ? "Unblocked!" : "Blocked!"),
                text: " Instructor has been " + (status == 1 ? "unblocked" : "blocked"),
                type: "success",
                timer: 2000,
                showConfirmButton: false,
              });

              window.location.reload();
            }
          },
        });
      }
    );
  });
});
