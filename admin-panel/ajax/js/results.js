$(document).ready(function () {
    $('#show-results-student').click(function () {
        let studentId = $('#student_id').val().trim();

        if (studentId === '') {
            swal("Error!", "Please enter your MIS number.", "error");
            return;
        }

        $.ajax({
            url: 'ajax/php/search-student.php',
            type: 'POST',
            data: { student_id: studentId },
            dataType: 'json',
            beforeSend: function () {
                $('.result-section').html('<p class="text-center mt-3">Loading results...</p>');
            },
            success: function (response) {
                if (response.status === 'success') {
                    let html = `
                        <h5 class="text-center">Student Details</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered mt-4 w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th>MIS NO</th>
                                        <th>Full Name</th>
                                        <th>NIC</th>
                                        <th>Course Name</th>
                                        <th>Year</th>
                                        <th>Batch</th>
                                    </tr>
                                </thead>
                                <tbody>
                    `;

                    response.data.forEach(student => {
                        html += `
                            <tr>
                                <td>${student.mis_number}</td>
                                <td>${student.full_name}</td>
                                <td>${student.nic}</td>
                                <td>${student.course} - ${student.course_name}</td>
                                <td>${student.year}</td>
                                <td>${student.batch}</td>
                            </tr>
                        `;
                    });

                    html += `
                                </tbody>
                            </table>
                        </div>
                        <p class="text-center mt-3 mb-0">
                            Please note that this online result is provisional and should not be used as an official confirmation or a certification.
                        </p>
                        <p class="text-center mt-1">
                            &copy; ${new Date().getFullYear()} - National Youth Services Council - Sri Lanka
                        </p>
                    `;

                    $('.result-section').html(html);
                } else {
                    $('.result-section').html(`<p class="text-center text-danger">${response.message}</p>`);
                }
            },
            error: function () {
                $('.result-section').html('<p class="text-center text-danger">Error occurred while fetching data.</p>');
            }
        });
    });

    $('#reset').click(function () {
        $('#student_id').val('');
        $('.result-section').html('');
    });
});


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

     let student_id = $("#student_id").val().trim();
    let certificate_id = $("#certificate").val().trim();

    
        
        
      //start preloarder
      $(".someBlock").preloader();
      $.ajax({
        url: "ajax/php/results.php",
        type: "POST",
        data: {
          student_id,
          certificate_id,
        },
        dataType: "json",
        success: function (result) {
          window.setTimeout(function () {
            $(".someBlock").preloader("remove");
            
            
            if (result.status === "success") {
                
         
             
              $("#student-no").text(result.student.id);
              $("#is_exam").text(result.is_exam);
              
              
              $("#year-batch").text(result.student.year+ " - "+result.student.batch); 
              $("#exam_participant_year_batch").text(result.exam_year);
              $("#student-name").text(result.student.fname + " " + result.student.lname);
              $("#course-id").text(result.course.courseid);
               $("#course-name").text(result.course.cname); 
              $("#center-name").text(result.center); 
              $("#grade").text(result.student_exam.grade);
              $("#practical-mark").text(result.student_exam.practical_marks+" - "+result.student_exam.practical_grade);
             
 
               
             
             
               $("#exam_participant_year_batch").text(result.exam_participant_year_batch);
              $("#certificate_no").text(result.student.certificate_no);
              $("#mcq-grade").text(result.student_exam.mcq_marks+" - "+result.student_exam.mcq_grade);
              $("#theory-grade").text(result.student_exam.essay_marks+" - "+result.student_exam.essay_grade);
              $("#avarage").text(result.student_exam.full_marks);
   
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
     
  });
});
