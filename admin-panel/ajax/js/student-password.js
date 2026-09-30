$(document).ready(function () {
  $("#update-password").click(function (event) {
    event.preventDefault();
 

    //start preloarder
    // $(".someBlock").preloader();
    $.ajax({
      url: "ajax/php/student-password.php",
      type: "POST",
      data: {
        action: "UPDATEPASSWORD",
      },
      dataType: "json",
      success: function (result) {
        //remove preloarder
        // $(".someBlock").preloader("remove");
        if (result.status === "success") {
          swal({
            title: "success!",
            text: "Student's password updated successfully !",
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
  });
});
