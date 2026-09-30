jQuery(document).ready(function () {
  //---------- Start Create Data ---------
  $(".dataTables_wrapper").on("click", ".edit_essay_marks", function () {
    let exam_student_id = $(this).attr("exam_student_id");
    $("#essay_marks_section_" + exam_student_id).addClass("hidden");
    $("#essay_marks_caption_" + exam_student_id).removeClass("hidden");
    $("#essay_marks_" + exam_student_id).removeClass("hidden");
  });
  $(".dataTables_wrapper").on(
    "keypress",
    ".essay_marks_input",
    function (event) {
      // $(".essay_marks_input").keypress(function (event) {
      if (event.which === 13) {
        event.preventDefault();
        let marks = $(this).val();
        let exam_student_id = $(this).attr("exam_student_id");

        //start preloarder
        $(".someBlock").preloader();
        $.ajax({
          url: "ajax/php/exam-students.php",
          type: "POST",
          data: {
            marks,
            exam_student_id,
            action: "UPDATEMARKS",
          },
          dataType: "json",
          success: function (result) {
            window.setTimeout(function () {
              $(".someBlock").preloader("remove");
              if (result.status === "success") {
                location.reload();
              } else if (result.status === "error") {
                swal({
                  title: "Error!",
                  text: "There was an error.",
                  type: "error",
                  timer: 2000,
                  showConfirmButton: false,
                });
              }
            }, 2000);
          },
        });
      }
    }
  );
  $("#DataTables_Table_0").on("click", ".edit_mcq_marks", function () {
    let exam_student_id = $(this).attr("exam_student_id");
    $("#DataTables_Table_0 #mcq_marks_section_" + exam_student_id).addClass(
      "hidden"
    );
    $("#DataTables_Table_0 #mcq_marks_caption_" + exam_student_id).removeClass(
      "hidden"
    );
    $("#DataTables_Table_0 #mcq_marks_" + exam_student_id).removeClass(
      "hidden"
    );
  });
  $(".dataTables_wrapper").on("keypress", ".mcq_marks_input", function (event) {
    // $(".essay_marks_input").keypress(function (event) {
    if (event.which === 13) {
      event.preventDefault();
      let marks = $(this).val();
      let exam_student_id = $(this).attr("exam_student_id");

      //start preloarder
      $(".someBlock").preloader();
      setTimeout(() => {
        $.ajax({
          url: "ajax/php/exam-students.php",
          type: "POST",
          data: {
            marks,
            exam_student_id,
            action: "UPDATEMCQMARKS",
          },
          dataType: "json",
          success: function (result) {
            window.setTimeout(function () {
              $(".someBlock").preloader("remove");
              if (result.status === "success") {
                location.reload();
              } else if (result.status === "error") {
                swal({
                  title: "Error!",
                  text: "There was an error.",
                  type: "error",
                  timer: 2000,
                  showConfirmButton: false,
                });
              }
            }, 2000);
          },
        });
      }, 1000);
    }
  });
  $("#DataTables_Table_0").on("click", ".edit_practical_marks", function () {
    let exam_student_id = $(this).attr("exam_student_id");
    $(
      "#DataTables_Table_0 #practical_marks_section_" + exam_student_id
    ).addClass("hidden");
    $(
      "#DataTables_Table_0 #practical_marks_caption_" + exam_student_id
    ).removeClass("hidden");
    $("#DataTables_Table_0 #practical_marks_" + exam_student_id).removeClass(
      "hidden"
    );
  });
  $("#DataTables_Table_0").on("click", ".edit_certificate_no", function () {
    let student_id = $(this).attr("student_id");
    $("#DataTables_Table_0 #certificate_no_section_" + student_id).addClass(
      "hidden"
    );
    $("#DataTables_Table_0 #certificate_no_caption_" + student_id).removeClass(
      "hidden"
    );
    $("#DataTables_Table_0 #certificate_no_" + student_id).removeClass(
      "hidden"
    );
  });
  $(".dataTables_wrapper").on(
    "keypress",
    ".practical_marks_input",
    function (event) {
      // $(".essay_marks_input").keypress(function (event) {
      if (event.which === 13) {
        event.preventDefault();
        let marks = $(this).val();
        let exam_student_id = $(this).attr("exam_student_id");

        //start preloarder
        $(".someBlock").preloader();
        $.ajax({
          url: "ajax/php/exam-students.php",
          type: "POST",
          data: {
            marks,
            exam_student_id,
            action: "UPDATEPRACTICALMARKS",
          },
          dataType: "json",
          success: function (result) {
            window.setTimeout(function () {
              $(".someBlock").preloader("remove");
              if (result.status === "success") {
                location.reload();
              } else if (result.status === "error") {
                swal({
                  title: "Error!",
                  text: "There was an error.",
                  type: "error",
                  timer: 2000,
                  showConfirmButton: false,
                });
              }
            }, 2000);
          },
        });
      }
    }
  );
  $(".dataTables_wrapper").on(
    "keypress",
    ".certificate_no_input",
    function (event) {
      // $(".essay_marks_input").keypress(function (event) {
      if (event.which === 13) {
        event.preventDefault();
        let certificate_no = $(this).val();
        let student_id = $(this).attr("student_id");

        //start preloarder
        $(".someBlock").preloader();
        $.ajax({
          url: "ajax/php/exam-students.php",
          type: "POST",
          data: {
            certificate_no,
            student_id,
            action: "UPDATECERTIFICATENO",
          },
          dataType: "json",
          success: function (result) {
            window.setTimeout(function () {
              $(".someBlock").preloader("remove");
              if (result.status === "success") {
                location.reload();
              } else if (result.status === "error") {
                swal({
                  title: "Error!",
                  text: "There was an error.",
                  type: "error",
                  timer: 2000,
                  showConfirmButton: false,
                });
              } else if (result.status === "duplicate-no") {
                swal({
                  title: "Error!",
                  text: "This certificate no already exists.",
                  type: "error",
                  timer: 2000,
                  showConfirmButton: false,
                });
              }
            }, 2000);
          },
        });
      }
    }
  );

  $(document).on("click", "#btn-report-3", function (e) {
    e.preventDefault();
    if (!$("#center").val() || $("#center").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select center.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else if (!$("#year").val() || $("#year").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select year.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else if (!$("#batch").val() || $("#batch").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select batch.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else {
      $("#report-form").attr(
        "action",
        "final-results-by-center-without-sign.php"
      );
      $("#report-form").submit();
    }
  });

  $(document).on("click", "#btn-report-1", function (e) {
    e.preventDefault();
    if (!$("#center").val() || $("#center").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select center.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else if (!$("#year").val() || $("#year").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select year.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else if (!$("#batch").val() || $("#batch").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select batch.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else {
      $("#report-form").attr("action", "final-results-by-center.php");
      $("#report-form").submit();
    }
  });

  $(document).on("click", "#btn-report-2", function (e) {
    e.preventDefault();
    if (!$("#center").val() || $("#center").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select center.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else if (!$("#year").val() || $("#year").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select year.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else if (!$("#batch").val() || $("#batch").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select batch.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else {
      $("#report-form").attr("action", "certificate-issue-students.php");
      $("#report-form").submit();
    }
  });
  $(document).on("click", "#btn-print-certificate", function (e) {
    e.preventDefault();
    if (!$("#center").val() || $("#center").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select center.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else if (!$("#year").val() || $("#year").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select year.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else if (!$("#batch").val() || $("#batch").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select batch.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else {
      $(".bs-example-modal-xl").modal("show");
      // $("#report-form").attr("action", "certificate-print.php");
      // $("#report-form").submit();
    }
  });
  $(document).on("click", "#btn-print-certificate-students", function (e) {
    e.preventDefault();
    if (!$("#center").val() || $("#center").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select center.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else if (!$("#year").val() || $("#year").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select year.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else if (!$("#batch").val() || $("#batch").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select batch.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else {
      $("#report-form").attr("action", "certificate-issue-student-list.php");
      $("#report-form").submit();
    }
  });
  $(document).on("change", ".issue_date", function () {
    var issue_date = $(this).val();
    $("#issue-date").val(issue_date);
  });
  $(document).on("click", "#save-submit-btn", function (e) {
    e.preventDefault();
    $(".bs-example-modal-xl").modal("hide");
    $("#report-form").attr("action", "certificate-print.php");
    $("#report-form").submit();
  });

  $(document).on("click", ".view-certificate-no-modal", function (e) {
    e.preventDefault();
    let stu_id = $(this).attr("stu_id");
    let exam_id = $(this).attr("exam_id");
    let year = $(this).attr("year");
    let batch = $(this).attr("batch");

    $.ajax({
      url: "ajax/php/exam-students.php",
      type: "POST",
      data: {
        year,
        batch,
        action: "CHECKAVAILABLECERTIFICATECOUNT",
      },
      dataType: "json",
      success: function (result) {
        $(".someBlock").preloader("remove");
        if (result.status === "exceed") {
          swal({
            title: "Error!",
            text: "You cannot print any more certificates. The maximum limit has been reached.",
            type: "error",
            showConfirmButton: true,
          });
          return false;
        } else {
          $("#student-no").val(stu_id);
          $("#exam-id").val(exam_id);
          $(".bs-example-modal-xl").modal("show");
        }
      },
    });
  });

  $(document).on("click", "#certificate-no-save-btn", function (e) {
    e.preventDefault();
    let stu_id = $("#student-no").val();
    let exam_id = $("#exam-id").val();
    let certificate_no = $("#certificate-no").val();
    if (certificate_no != "") {
      $.ajax({
        url: "ajax/php/exam-students.php",
        type: "POST",
        data: {
          certificate_no,
          student_id: stu_id,
          action: "UPDATECERTIFICATENO",
        },
        dataType: "json",
        success: function (result) {
          window.setTimeout(function () {
            $(".someBlock").preloader("remove");
            if (result.status === "success") {
              window.open(
                "print-student-certificate.php?id=" +
                  stu_id +
                  "&exam_id=" +
                  exam_id,
                "_blank"
              );
              $(".bs-example-modal-xl").modal("hide");
              $(".print-btn-" + stu_id).addClass("hidden");
            } else if (result.status === "error") {
              swal({
                title: "Error!",
                text: "There was an error.",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
              });
            } else if (result.status === "duplicate-no") {
              swal({
                title: "Error!",
                text: "This certificate no already exists.",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
              });
            }
          }, 2000);
        },
      });
    } else {
      swal({
        title: "Error!",
        text: "Please enter certificate no.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    }
  });
  
  
  
  
   $(document).on("click", "#certificate_report", function (e) {
    e.preventDefault();
    if (!$("#center").val() || $("#center").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select center.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else if (!$("#year").val() || $("#year").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select year.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else if (!$("#batch").val() || $("#batch").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select batch.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else {
      $("#report-form").attr("action", "certificate-number-sheet.php");
      $("#report-form").submit();
    }
  });
  
  
  
  
  
  $(document).on("click", ".add-note-btn", function (event) {
    event.preventDefault();

    var exam_id = $(this).data("exam-id"); // Get student ID from button
    var note = $("#note_" + exam_id).val().trim(); // Get the corresponding textarea value

    if (!note || note.length === 0) {
        swal({
            title: "Error!",
            text: "Please enter your note.",
            icon: "error",
            timer: 3000,
            showConfirmButton: false,
        });
        return;
    }

    $(".someBlock").preloader(); // Start Preloader

    $.ajax({
        url: "ajax/php/exam-students.php",
        type: "POST",
        data: {
            action: "update-note", // Define action
            exam_id: exam_id,
            note: note
        },
        dataType: "json",
        success: function (result) {
            $(".someBlock").preloader("remove"); // Remove Preloader

            if (result.status === "success") {
                swal({
                    title: "Success!",
                    text: "Your note has been updated successfully!",
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false,
                });

                setTimeout(function () {
                    location.reload();
                }, 2000);
            } else {
                swal({
                    title: "Error!",
                    text: "Something went wrong",
                    icon: "error",
                    timer: 2000,
                    showConfirmButton: false,
                });
            }
        },
        error: function () {
            $(".someBlock").preloader("remove");
            swal({
                title: "Error!",
                text: "Could not connect to the server.",
                icon: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        }
    });
});

  
  
});
