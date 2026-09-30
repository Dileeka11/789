$(document).ready(function () {
  //save
  $(document).on("click", "#reset", function (e) {
    $("#student_id").val("");
    location.reload();
  });
  $(document).on("click", "#show-results", function (e) {
    e.preventDefault();

    $(".practical-mark-section").removeClass("hidden");
    $(".mcq-mark-section").removeClass("hidden");
    $(".theory-mark-section").removeClass("hidden");

    let student_id = $("#student_id").val();
    let nic_no = $("#nic_no").val();
    if (student_id == "" && nic_no == "") {
      swal({
        title: "Error!",
        text: "Please enter atleast your Student ID or NIC No.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
      return false;
    } else {
      //start preloarder
      $(".someBlock").preloader();
      $.ajax({
        url: "ajax/php/results.php",
        type: "POST",
        data: {
          student_id,
          nic_no,
        },
        dataType: "json",
        success: function (result) {
          window.setTimeout(function () {
            $(".someBlock").preloader("remove");
            if (result.status === "success") {
              $("#student-no").text(result.student.id);
              $("#student-name").text(
                result.student.fname + " " + result.student.lname
              );
              $("#course-id").text(result.course.courseid);
              $("#course-name").text(result.course.cname);
              // $("#course-trade").text(result.course.coursetrade);
              // $("#course-level").text(result.course.level);
              $("#exam-year").text(result.exam_year);

              if (result.exam == "") {
                if (result.student_exam.practical_grade != "") {
                  $("#practical-grade").text(
                    result.student_exam.practical_grade ?? "-"
                  );
                } else {
                  $(".practical-mark-section").addClass("hidden");
                }
                if (result.student_exam.essay_grade != "") {
                  $(".mcq-mark-section").addClass("hidden");
                  $("#theory-grade").text(
                    result.student_exam.essay_grade ?? "-"
                  );
                } else if (result.student_exam.mcq_grade != "") {
                  $(".theory-mark-section").addClass("hidden");
                  $("#mcq-grade").text(result.student_exam.mcq_grade ?? "-");
                }
                $("#avarage").text(result.student_exam.full_marks);
                $("#grade").text(result.student_exam.grade);
              } else {
                if (result.exam.is_had_practical == 1) {
                  $("#practical-grade").text(
                    result.student_exam.practical_grade ?? "-"
                  );
                } else {
                  $(".practical-mark-section").addClass("hidden");
                }
                if (result.exam.type == 3) {
                  $(".mcq-mark-section").addClass("hidden");
                  $("#theory-grade").text(
                    result.student_exam.essay_grade ?? "-"
                  );
                } else if (result.exam.type == 2) {
                  $(".mcq-mark-section").addClass("hidden");
                  $("#theory-grade").text(
                    result.student_exam.essay_grade ?? "-"
                  );
                } else if (result.exam.type == 1) {
                  $(".theory-mark-section").addClass("hidden");
                  $("#mcq-grade").text(result.student_exam.mcq_grade ?? "-");
                }
                if (result.exam.is_had_practical == 1) {
                  if (result.exam.type == 3) {
                    if (
                      result.student_exam.mcq_grade != null &&
                      result.student_exam.essay_grade != null &&
                      result.student_exam.practical_grade != null
                    ) {
                      $("#avarage").text(result.student_exam.full_marks);
                      $("#grade").text(result.student_exam.grade);
                    } else {
                      $("#avarage").text("-");
                      $("#grade").text("-");
                    }
                  } else if (result.exam.type == 2) {
                    if (
                      result.student_exam.essay_grade != null &&
                      result.student_exam.practical_grade != null
                    ) {
                      $("#avarage").text(result.student_exam.full_marks);
                      $("#grade").text(result.student_exam.grade);
                    } else {
                      $("#avarage").text("-");
                      $("#grade").text("-");
                    }
                  } else if (result.exam.type == 1) {
                    if (
                      result.student_exam.mcq_grade != null &&
                      result.student_exam.practical_grade != null
                    ) {
                      $("#avarage").text(result.student_exam.full_marks);
                      $("#grade").text(result.student_exam.grade);
                    } else {
                      $("#avarage").text("-");
                      $("#grade").text("-");
                    }
                  }
                } else {
                  if (result.exam.type == 3) {
                    if (
                      result.student_exam.mcq_grade != null &&
                      result.student_exam.essay_grade != null
                    ) {
                      $("#avarage").text(result.student_exam.full_marks);
                      $("#grade").text(result.student_exam.grade);
                    } else {
                      $("#avarage").text("-");
                      $("#grade").text("-");
                    }
                  } else if (result.exam.type == 2) {
                    if (result.student_exam.essay_grade != null) {
                      $("#avarage").text(result.student_exam.full_marks);
                      $("#grade").text(result.student_exam.grade);
                    } else {
                      $("#avarage").text("-");
                      $("#grade").text("-");
                    }
                  } else if (result.exam.type == 1) {
                    if (result.student_exam.mcq_grade != null) {
                      $("#avarage").text(result.student_exam.full_marks);
                      $("#grade").text(result.student_exam.grade);
                    } else {
                      $("#avarage").text("-");
                      $("#grade").text("-");
                    }
                  }
                }
              }

              $(".result-section").removeClass("hidden");
            } else if (result.status === "error") {
              swal({
                title: "Error!",
                text: result.msg,
                type: "error",
                timer: 5000,
                showConfirmButton: false,
              });
            }
          }, 2000);
        },
      });
    }
  });
});
