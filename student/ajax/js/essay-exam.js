$(document).ready(function () {
  let remainingTime = parseInt($("#remaining-time").val());
  if (isNaN(remainingTime) || remainingTime <= 0) {
    // Exam time already over: submit immediately instead of running the timer.
    submitQuiz();
    swal({
      title: "Alert",
      text: "Time Over!",
      showCancelButton: false,
      showConfirmButton: false,
      timer: 1000,
    });
  } else {
    $("#countdown").timeTo(remainingTime, function () {
      submitQuiz();
      swal({
        title: "Alert",
        text: "Time Over!",
        showCancelButton: false,
        showConfirmButton: false,
        timer: 1000,
      });
    });
  }
  $("#submit").click(function () {
    submitQuiz();
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
function submitQuiz() {
  let exam_id = $("#exam").val();

  //start preloarder
  $(".someBlock").preloader();
  setTimeout(() => {
    $.ajax({
      url: "ajax/php/essay-exam.php",
      method: "POST",
      data: {
        exam_id,
        action: "SUBMITEXAM",
      },
      success: function (response) {
        //remove preloarder
        $(".someBlock").preloader("remove");
        if (response.status == "error") {
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
            text: "Your exam has been submitted successfully!",
            showCancelButton: false,
            showConfirmButton: false,
            timer: 3000,
          });
          setTimeout(() => {
            window.location.replace("success.php");
          }, 3000);
        }
      },
    });
  }, 2000);
}
