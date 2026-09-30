$("document").ready(function () {
  //---------- Start Create Data ---------
  $("#create").click(function (event) {
    event.preventDefault();

    if (!$("#centercode").val() || $("#centercode").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Select Training Center.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (!$("#course_name").val() || $("#course_name").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Enter Course Name..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (
      !$("#instructor_name").val() ||
      $("#instructor_name").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please Enter Instructor Name..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (
      !$("#instructor_tel").val() ||
      $("#instructor_tel").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please Enter Instructor Tel. No..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else {
      //start preloader
      $(".someBlock").preloader();
      //grab all form data
      var formData = new FormData($("#form-data")[0]);

      $.ajax({
        url: "ajax/php/non-nvq-instructor.php",
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
              window.setTimeout(function () {
                window.location.reload();
              }, 2000);
            } else {
              swal({
                title: "Error!",
                text: "Something went wrong",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
              });
            }
          }, 1500);
        },
      });
    }
    return false;
  });
  //---------- End Create Data ---------

  //---------- Update Active/Inactive Status ---------
  $("#non-nvq-table").on("click", ".update-status", function () {
    var id = $(this).attr("data-id");
    var status = $(this).attr("status");

    swal(
      {
        title: "Are you sure?",
        text:
          "Do you want to set this record " +
          (status == 1 ? "Active" : "Inactive") +
          "!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText:
          "Yes, set " + (status == 1 ? "Active" : "Inactive") + "!",
        closeOnConfirm: false,
      },
      function () {
        $.ajax({
          url: "ajax/php/non-nvq-instructor.php",
          type: "POST",
          data: { id: id, status: status, option: "UPDATESTATUS" },
          dataType: "JSON",
          success: function (jsonStr) {
            if (jsonStr.status) {
              swal({
                title: "Updated!",
                text: "Status has been updated.",
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

  //---------- Update End Date inline ---------
  $("#non-nvq-table").on("change", ".update-end-date", function () {
    var id = $(this).attr("data-id");
    var end_date = $(this).val();

    $.ajax({
      url: "ajax/php/non-nvq-instructor.php",
      type: "POST",
      data: { id: id, end_date: end_date, option: "UPDATEENDDATE" },
      dataType: "JSON",
      success: function (jsonStr) {
        if (jsonStr.status) {
          swal({
            title: "Updated!",
            text: "End date has been updated.",
            type: "success",
            timer: 1500,
            showConfirmButton: false,
          });
        }
      },
    });
  });
});
