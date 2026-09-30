$(document).ready(function () {
  var rightSideAccordionIds = [];

  rightSideAccordionIds = JSON.parse($("#selected-questions").val());
  $(document).on("click", "#left .add-btn", function () {
    let qu_count = $("#qu-count").val();
    let module_id = $(this).attr("module-id");
    
    if (rightSideAccordionIds.length < qu_count) {
      var accordionContent = $(this).closest(".accordion-item").detach();
      $(this).text("Remove");
      $(this)
        .closest(".accordion-collapse")
        .attr("data-bs-parent", "#accordionExample-r-" + module_id);
      accordionContent.appendTo("#right #accordionExample-r-" + module_id);
      $(".empty-data-text-r-" + module_id).addClass("hidden");
      var module_qu_count = $(
        "#accordionExample-l-" + module_id + " .accordion-item"
      ).length;
      if (module_qu_count == 0) {
        $(".empty-data-text-l-" + module_id).removeClass("hidden");
      }
      
      rightSideAccordionIds.push($(this).attr("row-id"));
      $("#selected-questions").val(JSON.stringify(rightSideAccordionIds));
      $(".paper-qu-count").text(rightSideAccordionIds.length);
    } else {
      swal({
        title: "Error!",
        text: "You can't add any more questions to the paper.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    }
  });

  $(document).on("click", "#right .add-btn", function () {
    let module_id = $(this).attr("module-id");
    var accordionContent = $(this).closest(".accordion-item").detach();
    $(this).text("Add");
    $(this)
      .closest(".accordion-collapse")
      .attr("data-bs-parent", "#accordionExample-l-" + module_id);
    accordionContent.appendTo("#left #accordionExample-l-" + module_id);
    $(".empty-data-text-l-" + module_id).addClass("hidden");
    var module_qu_count = $(
      "#accordionExample-r-" + module_id + " .accordion-item"
    ).length;
    if (module_qu_count == 0) {
      $(".empty-data-text-r-" + module_id).removeClass("hidden");
    }
    var accordionId = $(this).attr("row-id");
    rightSideAccordionIds = rightSideAccordionIds.filter(function (id) {
      return id !== accordionId;
    });
    $("#selected-questions").val(JSON.stringify(rightSideAccordionIds));
    $(".paper-qu-count").text(rightSideAccordionIds.length);
  });
  $(document).on("click", "#update-paper", function () {
    let qu_count = $("#qu-count").val();
    let exam_period_id = $("#exam-period-id").val();
    let course_id = $("#course-id").val();
    let paper_id = $("#paper-id").val();
    let selected_questions = JSON.parse($("#selected-questions").val());
    if (selected_questions.length < qu_count) {
      swal({
        title: "Error!",
        text: "You must select " + qu_count + " questions for the paper",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else {
      //start preloarder
      $(".someBlock").preloader();
      $.ajax({
        url: "ajax/php/qu-paper.php",
        type: "POST",
        data: {
          qu_count,
          paper_id,
          exam_period_id,
          course_id,
          selected_questions,
          action: "UPDATE_PAPER",
        },
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
                window.location.href =
                  "manage-instructor-courses.php?id=" + exam_period_id;
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
  });
  $(document).on("click", "#submit-saved-paper", function () {
    let qu_count = $("#qu-count").val();
    let exam_period_id = $("#exam-period-id").val();
    let course_id = $("#course-id").val();
    let paper_id = $("#paper-id").val();
    let selected_questions = JSON.parse($("#selected-questions").val());
    if (selected_questions.length < qu_count) {
      swal({
        title: "Error!",
        text: "You must select " + qu_count + " questions for the paper",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else {
      //start preloarder
      $(".someBlock").preloader();
      $.ajax({
        url: "ajax/php/qu-paper.php",
        type: "POST",
        data: {
          qu_count,
          paper_id,
          exam_period_id,
          course_id,
          selected_questions,
          action: "SUBMIT_SAVED_PAPER",
        },
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
                window.location.href =
                  "manage-instructor-courses.php?id=" + exam_period_id;
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
  });
  $(document).on("click", "#update-saved-paper", function () {
    let qu_count = $("#qu-count").val();
    let exam_period_id = $("#exam-period-id").val();
    let course_id = $("#course-id").val();
    let paper_id = $("#paper-id").val();
    let selected_questions = JSON.parse($("#selected-questions").val());
    // if (selected_questions.length < qu_count) {
    //   swal({
    //     title: "Error!",
    //     text: "You must select " + qu_count + " questions for the paper",
    //     type: "error",
    //     timer: 2000,
    //     showConfirmButton: false,
    //   });
    //   return false;
    // } else {
    //start preloarder
    $(".someBlock").preloader();
    $.ajax({
      url: "ajax/php/qu-paper.php",
      type: "POST",
      data: {
        qu_count,
        paper_id,
        exam_period_id,
        course_id,
        selected_questions,
        action: "UPDATE_SAVED_PAPER",
      },
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
              window.location.href =
                "manage-instructor-courses.php?id=" + exam_period_id;
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
    // }
  });
});
