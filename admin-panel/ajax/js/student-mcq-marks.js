$("document").ready(function () {
  $("#update-mcq-marks").click(function (event) {
    event.preventDefault();
    let stu_id = $(this).attr("stu_id");
    let exam_id = $(this).attr("exam_id");
    let exam_stu_id = $(this).attr("exam_stu_id");
    //start preloarder
    $(".someBlock").preloader();

    $.ajax({
      url: "ajax/php/student-mcq-marks.php",
      type: "POST",
      data: {
        stu_id,
        exam_id,
        exam_stu_id,
        action: "UPDATE",
      },
      dataType: "json",
      success: function (result) {

        window.setTimeout(function () {
          //remove preloarder
          $(".someBlock").preloader("remove");
          if (result.status === "success") {
            swal({
              title: "success!",
              text: "Your data saved successfully !",
              type: "success",
              timer: 3000,
              showConfirmButton: false,
            });
            window.setTimeout(function () {
              window.location.reload();
            }, 3000);
          } else if (result.status === "error") {
            swal({
              title: "Error!",
              text: "Something went wrong",
              type: "error",
              timer: 3000,
              showConfirmButton: false,
            });
          }
        }, 2000);
      },
    });
  });
  // ------------Update correct answer ----------------
  $(".update-correct-answer").click(function (event) {
    event.preventDefault();
    let stu_id = $(this).attr("stu_id");
    let exam_id = $(this).attr("exam_id");
    let exam_stu_id = $(this).attr("exam_stu_id");
    let exam_stu_qu_id = $(this).attr("exam_stu_qu_id");
    //start preloarder
    $(".someBlock").preloader();

    $.ajax({
      url: "ajax/php/student-mcq-marks.php",
      type: "POST",
      data: {
        stu_id,
        exam_id,
        exam_stu_id,
        exam_stu_qu_id,
        action: "UPDATECORRECTANSWER",
      },
      dataType: "json",
      success: function (result) {

        window.setTimeout(function () {
          //remove preloarder
          $(".someBlock").preloader("remove");
          if (result.status === "success") {
            swal({
              title: "success!",
              text: "Correct answer updated successfully.!",
              type: "success",
              timer: 3000,
              showConfirmButton: false,
            });
            window.setTimeout(function () {
              window.location.reload();
            }, 3000);
          } else if (result.status === "error") {
            swal({
              title: "Error!",
              text: "Something went wrong",
              type: "error",
              timer: 3000,
              showConfirmButton: false,
            });
          }
        }, 2000);
      },
    });
  });
  //---------- End Create Data ---------
});
