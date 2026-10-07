$(document).ready(function () {
  $(".answer_review_section").addClass("hidden");

  let remainingTime = parseInt($("#remaining-time").val());
  if (isNaN(remainingTime) || remainingTime <= 0) {
    // Exam time already over: submit immediately instead of running the timer.
    submitQuiz(2);
    swal({
      title: "Alert",
      text: "Time Over!",
      showCancelButton: false,
      showConfirmButton: false,
      timer: 1000,
    });
  } else {
    $("#countdown").timeTo(remainingTime, function () {
      submitQuiz(2);
      swal({
        title: "Alert",
        text: "Time Over!",
        showCancelButton: false,
        showConfirmButton: false,
        timer: 1000,
      });
    });
  }

  let first_qu = $("#first_qu").val();
  updateQuestion(first_qu);

  $(".next-btn").click(function () {
    if ($('input[name="option"]:checked').is(":checked")) {
      let current_qu = $("#current_id").val();
      var selected_choice = $('input[name="option"]:checked').val();
      updateAnswer(current_qu, selected_choice);
    }

    let qu_id = $(this).attr("next_qu_id");
    updateQuestion(qu_id);
  });
  $(".prev-btn").click(function () {
    $(".answer_review_section").addClass("hidden");
    if ($('input[name="option"]:checked').is(":checked")) {
      let current_qu = $("#current_id").val();
      var selected_choice = $('input[name="option"]:checked').val();
      updateAnswer(current_qu, selected_choice);
    }

    let qu_id = $(this).attr("prev_qu_id");
    updateQuestion(qu_id);
  });
  $(".qu-count-small-box").click(function () {
    if ($(this).attr("qu-type") == "fill_blanks") {
      let current_qu = $("#current_id").val();
      var selected_choice = $(".fill_blanks").val();
      updateAnswer(current_qu, selected_choice);
    } else if ($(this).attr("qu-type") == "matching") {
      let current_qu = $("#current_id").val();
      var selected_choice = [];
      $(".matching-option")
        .find(":selected")
        .each(function (i) {
          selected_choice[i] = [$(this).attr("option_id"), $(this).val()];
        });
      console.log(selected_choice);
      updateAnswer(current_qu, selected_choice);
    } else {
      if ($('input[name="option"]:checked').is(":checked")) {
        let current_qu = $("#current_id").val();
        var selected_choice = $('input[name="option"]:checked').val();
        updateAnswer(current_qu, selected_choice);
      }
    }
    let qu_id = $(this).attr("qu-no");
    updateQuestion(qu_id);
  });

  $("#submit").click(function () {
    submitQuiz(1);
    // swal({
    //   title: "Are you sure?",
    //   text: "Are you want to submit quiz?",
    //   showCancelButton: true,
    //   confirmButtonText: "Yes, submit!",
    // }).then(function(isConfirm) {
    //   alert(isConfirm);
    //   if (isConfirm) {
    //     submitQuiz(1);
    //   }
    // });
  });
});

function updateQuestion(id) {
  let lang = $("#lang").val();
  $.ajax({
    url: "ajax/php/mcq-exam.php",
    data: {
      id,
      action: "GETQUESTION",
    },
    method: "POST",
    success: function (response) {
      console.log(response);
      $(".qu_no").text(response.current_sort + ". ");
      $("#current_id").val(response.current_qu);
      var html = "";
      for (let i = 1; i <= 4; i++) {
        let columnName = "";
        if (lang == "english" || lang == "") {
          columnName = "answer_" + i;
        } else {
          columnName = "answer_" + i + "_" + lang;
        }
        let imageColumnName = "image_answer_" + i;

        html += '<div class="form-check mb-3">';
        html +=
          '<input type="radio"  name="option" class="form-check-input choice option" id="option_' +
          i +
          '" value="' +
          i +
          '">';
        html +=
          '<label class="form-check-label option_a" for="option_' + i + '">';
        if (response.question[columnName] != null) {
          html += response.question[columnName];
        }

        html += "</label>";
        if (response.question[imageColumnName]) {
          html += '<div class="option_image_section">';
          html +=
            '<img src="../../../nc_assets/uploads/questions/options/' +
            response.question[imageColumnName] +
            '" alt="Exam" style="margin-bottom:20px">';

          html += "</div>";
        }
        html += "</div>";
      }
      $(".next-btn").attr("qu-type", "radio");
      $(".prev-btn").attr("qu-type", "radio");
      $(".qu-count-small-box").attr("qu-type", "radio");
      $("#submit").attr("qu-type", "radio");

      $(".question_choice_section").empty();
      $(".question_choice_section").append(html);

      if (lang == "english" || lang == "") {
        $(".qu_title").html(response.question.question);
      } else {
        let columnNamequ = "question_" + lang;
        $(".qu_title").html(response.question[columnNamequ]);
      }
      // $(".qu_title").html(response.question.question);

      // alert(current_qu);
      if (
        response.question.image_name != "" &&
        response.question.image_name != null
      ) {
        let filename = response.question.image_name;
        const arr = filename.split(".");

        var html =
          '<img src="../../../nc_assets/uploads/questions/' +
          response.question.image_name +
          '" alt="Eduforworld.com" style="margin-bottom:20px">';

        $(".question_image_section").empty();
        $(".question_image_section").append(html);
      } else {
        $(".question_image_section").empty();
      }

      if (response.prev_qu == "") {
        $(".prev-btn").addClass("hidden");
      } else {
        $(".prev-btn").removeClass("hidden");
        $(".prev-btn").attr("prev_qu_id", response.prev_qu);
      }
      if (response.next_qu == "") {
        $(".next-btn").addClass("hidden");
      } else {
        $(".next-btn").removeClass("hidden");
        $(".next-btn").attr("next_qu_id", response.next_qu);
      }
      if (response.answers != null) {
        $("#option_" + response.answers).prop("checked", true);
        $("#qu_" + response.current_sort).addClass("answered");
      } else {
        $(".option").prop("checked", false);
      }
      let no_of_questions = $("#no_of_questions").val();
      if (response.current_sort == no_of_questions) {
        $("#submit").removeClass("hidden");
      } else {
        $("#submit").addClass("hidden");
      }
      $(response.all_ques).each(function (index, qu) {
        if (qu.answer != null) {
          $("#qu_" + qu.sort).addClass("answered");
        }
      });
    },
  });
}

function updateAnswer(current_qu, selected_choice) {
  $.ajax({
    url: "ajax/php/mcq-exam.php",
    data: {
      current_qu,
      selected_choice,
      action: "UPDATEANSWER",
    },
    method: "POST",
    success: function (response) {
      $("#qu_" + response.current_sort).addClass("answered");
    },
  });
}

function submitQuiz(submit_type) {
  let exam_id = $("#exam").val();
  let lang = $("#lang").val();
  if ($('input[name="option"]:checked').is(":checked")) {
    let current_qu = $("#current_id").val();
    var selected_choice = $('input[name="option"]:checked').val();
    updateAnswer(current_qu, selected_choice);
  }
  //start preloarder
  $(".someBlock").preloader();

  setTimeout(() => {
    $.ajax({
      url: "ajax/php/mcq-exam.php",
      method: "POST",
      data: {
        exam_id,
        submit_type,
        lang,
        action: "SUBMITEXAM",
      },
      success: function (response) {
        //remove preloarder
        $(".someBlock").preloader("remove");
        if (response.status == "error1") {
          swal({
            title: "Error",
            text: "Please answer every questions.!",
            showCancelButton: false,
            showConfirmButton: false,
            timer: 3000,
          });
        } else if (response.status == "error") {
          swal({
            title: "Error",
            text: "Something went wrong!",
            showCancelButton: false,
            showConfirmButton: false,
            timer: 3000,
          });
        } else {
          swal({
            title: "Success",
            text: "Your quiz has been submitted successfully!",
            showCancelButton: false,
            showConfirmButton: false,
            timer: 3000,
          });
          setTimeout(() => {
            window.location.replace(response.redirect);
          }, 3000);
        }
      },
    });
  }, 2000);
}
