jQuery(document).ready(function () {
  //---------- Start course request ---------
  $("#create").click(function (event) {
    event.preventDefault();

    //-- ** Start Error Messages
    if (!$("#coursetrade").val() || $("#coursetrade").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select course trade.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#cname").val() || $("#cname").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please enter course name.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#level").val() || $("#level").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select course level.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#fullpart").val() || $("#fullpart").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select course type",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#durationm").val() || $("#durationm").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select course duration.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#nvqnon").val() || $("#nvqnon").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please enter the course fee.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#qu_count").val() || $("#qu_count").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please enter the exam paper question count.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#module-name-1").val() || $("#module-name-1").val().length === 0 || !$("#module-code-1").val() || $("#module-code-1").val().length === 0) {
        swal({
          title: "Error!",
          text: "Please enter at least one module.",
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
        url: "ajax/php/course.php",
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "JSON",
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

  //---------- Start course request ---------
  $("#update").click(function (event) {
    event.preventDefault();

    //-- ** Start Error Messages
    if (!$("#coursetrade").val() || $("#coursetrade").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select course trade.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#cname").val() || $("#cname").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please enter course name.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#courseid").val() || $("#courseid").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please enter course id.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#level").val() || $("#level").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select course level.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#fullpart").val() || $("#fullpart").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select course type",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#durationm").val() || $("#durationm").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select course duration.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#nvqnon").val() || $("#nvqnon").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please enter the course fee.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#qu_count").val() || $("#qu_count").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please enter the exam paper question count.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else if (!$("#module-name-1").val() || $("#module-name-1").val().length === 0 || !$("#module-code-1").val() || $("#module-code-1").val().length === 0) {
        swal({
          title: "Error!",
          text: "Please enter at least one module.",
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
        url: "ajax/php/course.php",
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "JSON",
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

  //----------- course report in student details -----
  $(document).on("click", "#btn-report-1", function (e) {
    e.preventDefault();

    if (!$("#course").val() || $("#course").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select course.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else if (
      !$("#course_year").val() ||
      $("#course_year").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please select year.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (
      !$("#course_batch").val() ||
      $("#course_batch").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please select batch.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else {
      $("#report-form").attr("action", "final-results-by-center-student.php");
      $("#report-form").submit();
    }
  });


 //----------- student Practical Mark Report -----
  $(document).on("click", "#btn-report-practical-mark", function (e) {
    e.preventDefault();

    if (!$("#course").val() || $("#course").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select course.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else if (
      !$("#year").val() ||
      $("#year").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please select year.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (
      !$("#batch").val() ||
      $("#batch").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please select batch.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else {
      $("#report-form").attr("action", "practical-mark-report-pdf.php");
      $("#report-form").submit();
    }
  });
  
  
  //----------- attendance report in student details -----
  $(document).on("click", "#btn-report-attendance", function (e) {
    e.preventDefault();

    if (!$("#course").val() || $("#course").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select course.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else if (
      !$("#course_year").val() ||
      $("#course_year").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please select year.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (
      !$("#course_batch").val() ||
      $("#course_batch").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please select batch.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else {
      $("#report-form").attr("action", "final-attendance-student-result.php");
      $("#report-form").submit();
    }
  });
  
  
  //----------- practical mark sheet student details -----
  $(document).on("click", "#btn-report-practical-sheet", function (e) {
    e.preventDefault();

    if (!$("#course").val() || $("#course").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select course.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else if (
      !$("#course_year").val() ||
      $("#course_year").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please select year.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (
      !$("#course_batch").val() ||
      $("#course_batch").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please select batch.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else {
      $("#report-form").attr("action", "print-practical-mark-sheet.php");
      $("#report-form").submit();
    }
  });

   //----------- Drop out details  -----
  $(document).on("click", "#btn-report-drop-out", function (e) {
    e.preventDefault();

    if (!$("#course").val() || $("#course").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select course.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else if (
      !$("#course_year").val() ||
      $("#course_year").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please select year.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (
      !$("#course_batch").val() ||
      $("#course_batch").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please select batch.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else {
      $("#report-form").attr("action", "final-results-by-center-student-drop-out.php");
      $("#report-form").submit();
    }
  });
  
  
    //----------- Exam Student Final Report PDF  -----
  $(document).on("click", "#btn-report-exam-stdents", function (e) {
    e.preventDefault();

    if (!$("#year").val() || $("#year").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select year.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else if (
      !$("#batch").val() ||
      $("#batch").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please select batch.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else if (
      !$("#center_id").val() ||
      $("#center_id").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please select center .",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    } else {
      $("#report-form").attr("action", "center-exam-report-print.php");
      $("#report-form").submit();
    }
  });
  
  
  
  //---------- Start course request ---------
  $("#assign-courses").click(function (event) {
    event.preventDefault();

    //-- ** Start Error Messages

    //-- ** Start Error Messages
    if (!$("#course_id").val() || $("#course_id").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select course name.",
        type: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    
      
    }else {
      //start preloarder
      $(".someBlock").preloader();
      //grab all form data

      var formData = new FormData($("#form-data")[0]); //grab all form data

      $.ajax({
        url: "ajax/php/course.php",
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "JSON",
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
  
  

  $(document).ready(function () {
    $("#add-row").click(function () {
      let row_count = $("#row-count").val();
      let new_count = parseInt(row_count) + 1;

      let html = "";
      html += '<div class="mb-3 row">';
      html +=
        '<label for="example-url-input" class="col-md-2 col-form-label">Module ' +
        new_count +
        " </label>";
      html +=
        '<label for="example-url-input" class="col-md-1 col-form-label">Module</label>';
      html += '<div class="col-md-4 mt-2">';
      html += ' <div class="form-check">';
      html +=
        '<input class="form-control" type="text" placeholder="Enter module name" name="module_name_' +
        new_count +
        '" id="module-name-' +
        new_count +
        '" value="">';
      html += "</div>";
      html += "</div>";
      html +=
        '<label for="example-url-input" class="col-md-1 col-form-label">Code</label>';
      html += '<div class="col-md-4 mt-2">';
      html += '<div class="form-check">';
      html +=
        '<input class="form-control" type="text" placeholder="Enter module code" name="module_code_' +
        new_count +
        '" id="module-code-' +
        new_count +
        '" value="">';
      html += "</div>";
      html += " </div>";
      html += "</div>";

      $("#row-count").val(new_count);
      $(".module-section").append(html);
    });
  });
  
 
//add courses to non nvq level
 $(document).on("click", ".add-favorite", function () {
       

    var id = $(this).attr("data-id");
     
    swal(
      {
        title: "Are you sure?",
        text: 
            "Do you want to add this course to favorites?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, add this!",
        closeOnConfirm: false,
      },
      function () {
        $.ajax({
          url: "ajax/php/update-favorite.php",
          type: "POST",
          data: { id: id,  },
          dataType: "JSON",
          success: function (jsonStr) {
            if (jsonStr.status) {
              swal({
                title:  "Done!" ,
                text:    "Add to favorite List..",
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
 
 
});
