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
        text: "Please enter atleast your MIS No or NIC No.",
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
              var html = "";
              $.each(result.results, function (index, details) {
                  if(index !=0) {
                     html += "<hr style'height: 2px;color: black;'>"; 
                  }
                  if (details.status === "success") {
                html += "<table>";
                html += "<tr>";
                html += "<th>Student ID:</th>";
                html += '<td id="student-no">' + details.student.id + "</td>";
                html += "</tr>";
                html += "<tr>";
                html += "<th>Name:</th>";
                html +=
                  '<td id="student-name">' +
                  details.student.fname +
                  " " +
                  details.student.lname +
                  "</td>";
                html += "</tr>";
                html += "<tr>";
                html += "<th>Course ID:</th>";
                html +=
                  '<td id="course-id">' + details.course.courseid + "</td>";
                html += "</tr>";
                html += "<tr>";
                html += "<th>Course Name:</th>";
                html += '<td id="course-name">' + details.course.cname + "</td>";
                html += "</tr>";
                html += "<tr>";
                html += "<th>Year:</th>";
                html += '<td id="exam-year">' + details.exam_year + "</td>";
                html += "</tr>";

                if (details.exam == "") {
                  if (details.student_exam.practical_grade != "") {
                    html += '<tr class="practical-mark-section">';
                    html += "<th>Practical Test:</th>";
                    html +=
                      '<td id="practical-grade">' +
                        ((details.student_exam.practical_grade!='' && details.student_exam.practical_grade!=null) ?details.student_exam.practical_grade:"AB") + "</td>";
                    html += "</tr>";
                  }
                  if (details.student_exam.essay_grade != "" && details.student_exam.mcq_grade != "") {
                    html += '<tr class="theory-mark-section">';
                    html += "<th>Theory Test:</th>";
                    html +=
                      '<td id="theory-grade">' +
                        ((details.student_exam.essay_grade=='Repeat' || details.student_exam.mcq_grade=='Repeat') ?'Repeat':details.student_exam.mcq_grade) + "</td>";
                    html += "</tr>";
                  } else if (details.student_exam.mcq_grade != "") {
                    html += '<tr class="mcq-mark-section">';
                    html += "<th>MCQ Test:</th>";
                    html +=
                      '<td id="mcq-grade">' + ((details.student_exam.mcq_grade!='' && details.student_exam.mcq_grade!=null) ?details.student_exam.mcq_grade:"AB") + "</td>";
                    html += "</tr>";
                  }
                   
                  html += "<tr>";
                  html += "<th>Final Grade:</th>";
                  html +=
                    '<td id="grade">' + (details.student_exam.grade!=''?details.student_exam.grade:'Repeat') + "</td>";
                  html += "</tr>";
                } else {
                  if (details.exam.is_had_practical == 1) {
                    html += '<tr class="practical-mark-section">';
                    html += "<th>Practical Test:</th>";
                    html +=
                      '<td id="practical-grade">' +
                        ((details.student_exam.practical_grade!='' && details.student_exam.practical_grade!=null) ?details.student_exam.practical_grade:"AB") + "</td>";
                    html += "</tr>";
                  }
                  if (details.exam.type == 3) {
                    html += '<tr class="theory-mark-section">';
                    html += "<th>Theory Test:</th>";
                    html +=
                      '<td id="theory-grade">' + details.theory_status + '</td>';
                    html += "</tr>";
                  } else if (details.exam.type == 2) {
                    html += '<tr class="theory-mark-section">';
                    html += "<th>Theory Test:</th>";
                    html +=
                      '<td id="theory-grade">' + details.theory_status + '</td>';
                    html += "</tr>";
                  } else if (details.exam.type == 1) {
                    html += '<tr class="mcq-mark-section">';
                    html += "<th>MCQ Test:</th>";
                    html +=
                      '<td id="theory-grade">' + details.theory_status + '</td>';
                    html += "</tr>";
                  }
                  if (details.exam.is_had_practical == 1) {
                    if (details.exam.type == 3) {
                      if (
                        details.student_exam.mcq_grade != null &&
                        details.student_exam.essay_grade != null &&
                        details.student_exam.practical_grade != null
                      ) {
                       
                        html += "<tr>";
                        html += "<th>Final Grade:</th>";
                        html +=
                          '<td id="grade">' +
                          (details.student_exam.grade!=''?details.student_exam.grade:'Repeat') +
                          "</td>";
                        html += "</tr>";
                      } else {
                         
                        html += "<tr>";
                        html += "<th>Final Grade:</th>";
                        html +=
                          '<td id="grade">' +
                          (details.student_exam.grade!=''?details.student_exam.grade:'Repeat') +
                          "</td>";
                        html += "</tr>";
                      }
                    } else if (details.exam.type == 2) {
                      if (
                        details.student_exam.essay_grade != null &&
                        details.student_exam.practical_grade != null
                      ) {
                    
                        html += "<tr>";
                        html += "<th>Final Grade:</th>";
                        html +=
                          '<td id="grade">' +
                          (details.student_exam.grade!=''?details.student_exam.grade:'Repeat') +
                          "</td>";
                        html += "</tr>";
                      } else {
                         
                        html += "<tr>";
                        html += "<th>Final Grade:</th>";
                        html += '<td id="grade"> - </td>';
                        html += "</tr>";
                      }
                    } else if (details.exam.type == 1) {
                      if (
                        details.student_exam.mcq_grade != null &&
                        details.student_exam.practical_grade != null
                      ) {
                       
                        html += "<tr>";
                        html += "<th>Final Grade:</th>";
                        html +=
                          '<td id="grade">' +
                          (details.student_exam.grade!=''?details.student_exam.grade:'Repeat') +
                          "</td>";
                        html += "</tr>";
                      } else {
                     
                        html += "<tr>";
                        html += "<th>Final Grade:</th>";
                        html += '<td id="grade"> - </td>';
                        html += "</tr>";
                      }
                    }
                  } else {
                    if (details.exam.type == 3) {
                      if (
                        details.student_exam.mcq_grade != null &&
                        details.student_exam.essay_grade != null
                      ) {
                        
                        html += "<tr>";
                        html += "<th>Final Grade:</th>";
                        html +=
                          '<td id="grade">' +
                          (details.student_exam.grade!=''?details.student_exam.grade:'Repeat') +
                          "</td>";
                        html += "</tr>";
                      } else {
                       
                        html += "<tr>";
                        html += "<th>Final Grade:</th>";
                        html += '<td id="grade"> - </td>';
                        html += "</tr>";
                      }
                    } else if (details.exam.type == 2) {
                      if (details.student_exam.essay_grade != null) {
                        
                        html += "<tr>";
                        html += "<th>Final Grade:</th>";
                        html +=
                          '<td id="grade">' +
                          (details.student_exam.grade!=''?details.student_exam.grade:'Repeat') +
                          "</td>";
                        html += "</tr>";
                      } else {
                         
                        html += "<tr>";
                        html += "<th>Final Grade:</th>";
                        html += '<td id="grade"> - </td>';
                        html += "</tr>";
                      }
                    } else if (details.exam.type == 1) {
                      if (details.student_exam.mcq_grade != null) {
                        
                        html += "<tr>";
                        html += "<th>Final Grade:</th>";
                        html +=
                          '<td id="grade">' +
                          (details.student_exam.grade!=''?details.student_exam.grade:'Repeat') +
                          "</td>";
                        html += "</tr>";
                      } else {
                        
                        html += "<tr>";
                        html += "<th>Final Grade:</th>";
                        html += '<td id="grade"> - </td>';
                        html += "</tr>";
                      }
                    }
                  }
                }

                html += "</table>";
              }else if (details.status === "error") {
              swal({
                title: "Error!",
                text: details.msg,
                type: "error",
                timer: 5000,
                showConfirmButton: false,
              });
            }
              });
 
              $(".result-section").removeClass('hidden');
              $(".result-section").empty();
              $(".result-section").append(html);
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
