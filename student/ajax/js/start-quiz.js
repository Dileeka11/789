$(document).ready(function () {
  //save
  $(document).on("click", "#start-quiz", function (e) {
    let student_id = $(this).attr("student-id");
    let exam_id = $(this).attr("exam-id");
    e.preventDefault();
    if (student_id == "") {
      swal({
        title: "Error!",
        text: "You do not have permission to do a quiz. Please try again later.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
      return false;
    } else if (exam_id == "") {
      swal({
        title: "Error!",
        text: "You do not have any assigned exam. Please try again later.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
      return false;
    } else if (
      $(".exam_language").length > 0 &&
      $(".exam_language:checked").length == 0
    ) {
      swal({
        title: "Error!",
        text: "Please select your language.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
      return false;
    } else {
      //start preloarder
         $(".someBlock").preloader();
      let language = "";
      if ($(".exam_language").length > 0) {
        language = $(".exam_language:checked").val();
      } else if ($(".exam_language1").val != '') {
        language = $(".exam_language1").val();
      }
      $.ajax({
        url: "ajax/php/start-quiz-1.php",
        type: "POST",
        data: {
          student_id,
          exam_id,
          language,
        },
        dataType: "json",
        success: function (result) {
          window.setTimeout(function () {
            $(".someBlock").preloader("remove");
            if (result.status === "success") {
              window.location.href =
                "index.php?id=" + exam_id + "&lang=" + language;
            } else if (result.status === "written-exam") {
              window.location.href = result.redirect;
            } else if (result.status === "error") {
              swal({
                title: "Error!",
                text: result.msg,
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
  $(document).on("click", "#start-written-exam", function (e) {
    let student_id = $(this).attr("student-id");
    let exam_id = $(this).attr("exam-id");
    e.preventDefault();
    if (student_id == "") {
      swal({
        title: "Error!",
        text: "You do not have permission to do a quiz. Please try again later.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
      return false;
    } else if (exam_id == "") {
      swal({
        title: "Error!",
        text: "You do not have any assigned exam. Please try again later.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
      return false;
    } else if (
      $(".exam_language").length > 0 &&
      $(".exam_language:checked").length == 0
    ) {
      swal({
        title: "Error!",
        text: "Please select your language.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
      return false;
    } else {
      //start preloarder
      //   $(".someBlock").preloader();

      let language = "";
      if ($(".exam_language").length > 0) {
        language = $(".exam_language:checked").val();
      }
      $.ajax({
        url: "ajax/php/start-written-exam.php",
        type: "POST",
        data: {
          student_id,
          exam_id,
        },
        dataType: "json",
        success: function (result) {
          window.setTimeout(function () {
            // $(".someBlock").preloader("remove");
            if (result.status === "success") {
              window.location.href =
                "written-exam.php?id=" + exam_id + "&lang=" + language;
            } else if (result.status === "error") {
              swal({
                title: "Error!",
                text: result.msg,
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
