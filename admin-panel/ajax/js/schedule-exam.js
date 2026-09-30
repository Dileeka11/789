jQuery(document).ready(function () {
  //---------- Start Create Data ---------
  $("#create").click(function (event) {
    event.preventDefault();

    //-- ** Start Error Messages
    if (!$("#course_id").val() || $("#course_id").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Select course.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#type").val() || $("#type").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Select exam type.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#exam_category").val() || $("#exam_category").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Select exam category.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#year").val() || $("#year").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select year.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#batch").val() || $("#batch").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select batch.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#start_date").val() || $("#start_date").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Select exam start date.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#time").val() || $("#time").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Select exam start time.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#duration").val() || $("#duration").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Select exam time duration.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (
      !$("#number_of_question").val() ||
      $("#number_of_question").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please enter the number of questions.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else {
      //start preloarder
      $(".someBlock").preloader();
      //grab all form data

      var formData = new FormData($("#form-data")[0]); //grab all form data

      $.ajax({
        url: "ajax/php/schedule-exam.php",
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (result) {
          //remove preloarder
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
    }
    return false;
  });
  //---------- End Create Data ---------

  //---------- Start Create Data ---------
  $("#update").click(function (event) {
    event.preventDefault();

    //-- ** Start Error Messages
    if (!$("#course_id").val() || $("#course_id").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select course.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#year").val() || $("#year").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select year.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#batch").val() || $("#batch").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select batch.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#start_date").val() || $("#start_date").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Select exam start date.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#time").val() || $("#time").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Select exam start time.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#duration").val() || $("#duration").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Select exam time duration.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (
      !$("#number_of_question").val() ||
      $("#number_of_question").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please enter the number of questions.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else {
      //start preloarder
      $(".someBlock").preloader();
      //grab all form data

      var formData = new FormData($("#form-data")[0]); //grab all form data

      $.ajax({
        url: "ajax/php/schedule-exam.php",
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (result) {
          //remove preloarder
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
    }
    return false;
  });
  //---------- End Create Data ---------
  
  $(document).on("click", ".released-result", function () {
    var id = $(this).attr("data-id");
    var status = $(this).attr("exam-status");

    swal(
      {
        title: "Are you sure?",
        text:
          status == 1
            ? "Do you want to hold the exam results?"
            : "Do you want to release the exam results?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText:
          status == 1 ? "Yes, hold results!" : "Yes, release results!",
        closeOnConfirm: false,
      },
      function () {
        $.ajax({
          url: "ajax/php/schedule-exam.php",
          type: "POST",
          data: { id: id, status: status, option: "updateresult" },
          dataType: "JSON",
          success: function (jsonStr) {
            if (jsonStr.status) {
              swal({
                title: status == 1 ? "Withheld!" : "Released!",
                text:
                  status == 1
                    ? "Results have been withheld."
                    : "Results have been released.",
                type: "success",
                timer: 2000,
                showConfirmButton: false,
              });
              setTimeout(() => {
                location.reload();
              }, 2000);
            }
          },
        });
      }
    );
  });
  
 
  //practical Mark update
   $(document).on("click", ".practical_mark_update", function () {

      var id = $(this).attr("data-id");

        swal({
            title: "Practical Mark?",
            text: "If you want to update Student Practical Mark.!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#898a95",
            confirmButtonText: "Yes, Updated.!",
            closeOnConfirm: false
        },
                function () {
                    $.ajax({
                        url: "ajax/php/schedule-exam.php",
                        type: "POST",
                        data: {
                            course: id,  
                            option: "updatepractical" 
                        },
                        dataType: "JSON",
                        success: function (jsonStr) {
                            if (jsonStr.status) {
                                swal({
                                    title: "Updated!",
                                    text: "Practical Mark Updated Successfully .!",
                                    type: "success",
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                               window.location.reload();
                            }
                        }
                    });
                }
        );
    });
   
   //MCQ mark update 
   $(document).on("click", ".mcq_mark_update", function () {

      var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "If you want to update student MCQ Mark.!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2b5d8a",
            confirmButtonText: "Yes, Updated.!",
            closeOnConfirm: false
        },
                function () {
                    $.ajax({
                        url: "ajax/php/schedule-exam.php",
                        type: "POST",
                        data: {
                            course: id,  
                            option: "updatemcq" 
                        },
                        dataType: "JSON",
                        success: function (jsonStr) {
                            if (jsonStr.status) {
                                swal({
                                    title: "Updated!",
                                    text: "Student MCQ Mark Updated Successfully .!",
                                    type: "success",
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                               window.location.reload();
                            }
                        }
                    });
                }
        );
    });
 
 
    
   //DELETE aditional Question
   $(document).on("click", "#delete-mcq", function () {

      var student_id = $(this).attr("stu_id");
     var exam_id = $(this).attr("exam_id");
 
 
 
        swal({
            title: "Are you sure?",
            text: "This file cannot be recover.!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2b5d8a",
            confirmButtonText: "Yes, Delete!",
            closeOnConfirm: false
        },
                function () {
                    $.ajax({
                        url: "ajax/php/schedule-exam.php",
                        type: "POST",
                        data: {
                            exam_id: exam_id,  
                            id: student_id,  
                            
                            option: "aditional_mcq" 
                        },
                        dataType: "JSON",
                        success: function (jsonStr) {
                            if (jsonStr.status) {
                                swal({
                                    title: "Updated!",
                                    text: "Deleted Successfully.!",
                                    type: "success",
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                               window.location.reload();
                            }
                        }
                    });
                }
        );
    });
 
  
  
  $(document).on("change", "#is_manual", function () {
    var course = $("#course_id").val();
    var year = $("#year").val();
    var batch = $("#batch").val();
    if ($(this).val() == 1) {
      $(".assign-student-section").removeClass("hidden");
      $.ajax({
        url: "ajax/php/schedule-exam.php",
        type: "POST",
        data: {
          course,
          year,
          batch,
          option: "GETASSIGNSTUDENTS",
        },
        dataType: "JSON",
        success: function (jsonStr) {
          if (jsonStr.status == "success") {
            let html = "<option value=''>--Please Select--</option>";
            $.each(jsonStr.students, function (index, student) {
              html +=
                "<option value='" + student.id + "'>" + student.id + ' - ' + student.fname + ' ' + student.lname + "</option>";
            });
            $('#assign-students').empty();
            $('#assign-students').append(html);
          }
        },
      });
    } else {
      $(".assign-student-section").addClass("hidden");
    }
  });
});
