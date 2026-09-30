$("document").ready(function () {

// get drop out student details
   $('.all_change').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var batch = $("#course_batch").val()
        var center_id = $("#center").val();
        var year = $("#course_year").val();
        var course_name = $("#course").val();

         
        $.ajax({
            url: "ajax/php/report.php",
            type: "POST",
            data: {
                year: year,
                batch: batch,
                course_id: course_name,
                center_id: center_id,
                action: 'GET_DROP_OUT_DETAILS'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                //remove preloarder
                $('.someBlock').preloader('remove');

                var html = '';
                $.each(jsonStr, function (i, data) {
                    i++
                   
                    
                    
                    html += '<tr>';
                    html += '<td>';
                    html += i;
                    html += '</td>';
                    html += '<td>';
                    html += data.id;
                    html += '</td>';
                    html += '<td>';
                    html += data.nic;
                    html += '</td>';
                    html += '<td>';
                    html += data.fname+' '+data.lname;
                    html += '</td>'; 
                    
                    html += '<td>';
                    html += data.drop_out_date;
                    html += '</td>';
                    html += '</tr>';
                });

                $('#course_table').empty();
                $('#course_table').append(html);
            }
        });
    });     
    
     // center course details
$('.center_course').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var batch = $("#course_batch").val()
        var center_id = $("#center").val();
        var year = $("#course_year").val();
 
         
        $.ajax({
            url: "ajax/php/report.php",
            type: "POST",
            data: {
                year: year,
                batch: batch,
                center_id: center_id,
                action: 'GET_COURSE_BY_CENTERS'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                //remove preloarder
                $('.someBlock').preloader('remove');

                var html = '';
                $.each(jsonStr, function (i, data) {
                    i++
                   
                   var app =+ data.count_app;
                   
                    
                    html += '<tr>';
                    html += '<td>';
                    html += i;
                    html += '</td>';
                    html += '<td>';
                    html += data.courseid  +' - '+ data.cname;
                    html += '</td>';
                    html += '<td>';
                    html += app;
                    html += '</td>';
                    html += '<td>';
                    html += 'sdsdssdse3e';
                    html += '</td>'; 
                     html += '<td>';
                    html += 'sdsdssdse3e';
                    html += '</td>';
                    html += '<td>';
                    html += 'scsds';
                    html += '</td>';
                    html += '</tr>';
                });

                $('#course_table').empty();
                $('#course_table').append(html);
            }
        });
}); 
    
    
    
// get student details
   $('.all_change_student').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var batch = $("#course_batch").val()
        var center_id = $("#center").val();
        var year = $("#course_year").val();
        var course_id = $("#course").val();

        
        
        $.ajax({
            url: "ajax/php/report.php",
            type: "POST",
            data: {
                year: year,
                batch: batch,
                course_id: course_id,
                center_id: center_id,
                action: 'GET_STUDENT_DETAILS'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                //remove preloarder
                $('.someBlock').preloader('remove');

                var html = '';
                $.each(jsonStr, function (i, data) {
                    i++
                    html += '<tr>';
                    html += '<td>';
                    html += i;
                    html += '</td>';
                    html += '<td>';
                    html += data.id;
                    html += '</td>';
                    html += '<td>';
                    html += data.nic;
                    html += '</td>';
                    html += '<td>';
                    html += data.fname+' '+data.lname;
                    html += '</td>';
                    
                    
                    html += '</tr>';
                });

                $('#course_table').empty();
                $('#course_table').append(html);
            }
        });
    });     
 
 //Drop out students details
   $('.drop_out_student').change(function () {
 
        $('.someBlock').preloader();
        //grab all form data  

        var batch = $("#course_batch").val()
        var center_id = $("#center").val();
        var year = $("#course_year").val();
        var course_id = $("#course").val();

        
        
        $.ajax({
            url: "ajax/php/report.php",
            type: "POST",
            data: {
                year: year,
                batch: batch,
                course_id: course_id,
                center_id: center_id,
                action: 'GET_DROP_OUT_DETAILS'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                //remove preloarder
                $('.someBlock').preloader('remove');

                var html = '';
                $.each(jsonStr, function (i, data) {
                    i++
                    html += '<tr>';
                    html += '<td>';
                    html += i;
                    html += '</td>';
                    html += '<td>';
                    html += data.id;
                    html += '</td>';
                    html += '<td>';
                    html += data.nic;
                    html += '</td>';
                    html += '<td>';
                    html += data.fname+' '+data.lname;
                    html += '</td>';
                    html += '<td>';
                    html += data.drop_out_date;
                    html += '</td>';
                    
                    html += '</tr>';
                });

                $('#course_table').empty();
                $('#course_table').append(html);
            }
        });
    });     
 

   // get drop out student details
   $('.all_change_Mark').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var batch = $("#batch").val();
        var center_id = $("#center").val();
        var year = $("#year").val();
        var course_name = $("#course").val();

         
        $.ajax({
            url: "ajax/php/report.php",
            type: "POST",
            data: {
                year: year,
                batch: batch,
                course_id: course_name,
                center_id: center_id,
                action: 'GET_PRACTICAL_MARK'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                //remove preloarder
                $('.someBlock').preloader('remove');

                var html = '';
                $.each(jsonStr, function (i, data) {
                    i++
                   
                    
                    
                    html += '<tr>';
                    html += '<td>';
                    html += i;
                    html += '</td>';
                    html += '<td>';
                    html += data.id;
                    html += '</td>';
                    html += '<td>';
                    html += data.fname+' '+data.lname;
                    html += '</td>'; 
                    
                    html += '<td>';
                    html += data.nic;
                    html += '</td>';
                    html += '<td>';
                    html += data.practical_mark;
                    html += '</td>'; 
                    html += '</tr>';
                });

                $('#course_table').empty();
                $('#course_table').append(html);
            }
        });
    });     
   
   
   

   // get student payments
   $('.all_student_payments').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var batch = $("#batch").val();
        var center_id = $("#center").val();
        var year = $("#year").val();
        var course_name = $("#course").val();

         
        $.ajax({
            url: "ajax/php/report.php",
            type: "POST",
            data: {
                year: year,
                batch: batch,
                course_id: course_name,
                center_id: center_id,
                action: 'GET_PRACTICAL_MARK'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                //remove preloarder
                $('.someBlock').preloader('remove');

                var html = '';
                $.each(jsonStr, function (i, data) {
                    i++
                   
                    
                    
                    html += '<tr>';
                    html += '<td>';
                    html += i;
                    html += '</td>';
                    html += '<td>';
                    html += data.id;
                    html += '</td>';
                    html += '<td>';
                    html += data.fname+' '+data.lname;
                    html += '</td>'; 
                    
                    html += '<td>';
                    html += data.nic;
                    html += '</td>';
                    html += '<td>';
                    html += data.practical_mark;
                    html += '</td>'; 
                    html += '</tr>';
                });

                $('#course_table').empty();
                $('#course_table').append(html);
            }
        });
    });     
    

//get sutudent exam report by center vise
  $('.center_exam_student_report').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var batch = $("#batch").val();
        var center_id = $("#center_id").val();
         var year = $("#year").val();
       
 

         
        $.ajax({
            url: "ajax/php/report.php",
            type: "POST",
            data: {
                 year: year,
                 batch: batch,
                 center_id: center_id,
                action: 'GET_CENTER_EXAM_FINAL'
            },
            dataType: "JSON",
            success: function (jsonStr) {
 
                //remove preloarder
                $('.someBlock').preloader('remove');
 

                $('#exam_table').empty();
                $('#exam_table').append(jsonStr);
            }
        });
    });     
    
    //get final exam student details report
    
$('.final_exam_student_report').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var batch = $("#batch").val();
        var center_id = $("#center_id").val();
         var year = $("#year").val();
       
 

         
        $.ajax({
            url: "ajax/php/report.php",
            type: "POST",
            data: {
                 year: year,
                 batch: batch,
                 center_id: center_id,
                action: 'GET_EXAM_FINAL_MARK_REPORT'
            },
            dataType: "JSON",
            success: function (jsonStr) {
 
                //remove preloarder
                $('.someBlock').preloader('remove');
 

                $('#exam_table').empty();
                $('#exam_table').append(jsonStr);
            }
        });
    });     
    
    
 $('.final_exam_student_check').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var batch = $("#batch").val();
        var center_id = $("#center_id").val();
         var year = $("#year").val();
           var course_id = $("#course_id").val();
       
 

         
        $.ajax({
            url: "ajax/php/report.php",
            type: "POST",
            data: {
                 year: year,
                 batch: batch,
                 center_id: center_id,
                 course_id:course_id,
                action: 'GET_EXAM_FINAL_MARK_CHECK'
            },
            dataType: "JSON",
           success: function (data) {
    $('.someBlock').preloader('remove');
    
    // Clear table first
$('#exam_table').empty();

// Add table headers
$('#exam_table').append(`
    <thead>
        <tr style="background-color:#e0e0e0; font-weight:bold;">
            <th>MIS No</th>
            <th>Student Name</th>
            <th>Course ID</th>
            <th>Practical</th>
            <th>MCQ</th>
            <th>Essay</th>
            <th>Total / Grade</th>
            <th> Action </th>
        </tr>
    </thead>
    <tbody id="exam_table_body"></tbody>
`);

// Append student rows to tbody
$.each(data, function (i, student) {
    // Check if grade is 'Repeat'
    var rowClass = student.grade === 'Repeat' ? 'background-color:#f8d7da;' : '';

    $('#exam_table_body').append(`
        <tr style="${rowClass}">
            <td>${student.mis_no}</td>
            <td>${student.fname} ${student.lname}</td>
            <td>${student.course_id}</td>
            <td>${student.practical_marks} - ${student.practical_grade}</td>
            <td>${student.mcq_marks} - ${student.mcq_grade}</td>
            <td>${student.essay_marks} - ${student.essay_grade}</td>
            <td>${student.full_marks} - ${student.grade}</td>
           <td> <a target="_blank" href="view-students-results.php?id=${student.exam_student_id}"> View </a> </td>

        </tr>
    `);
});

// Add a total row at the end
$('#exam_table_body').append(`
    <tr style="font-weight:bold; background-color:#f0f0f0;">
        <td colspan="7" class="text-center">
            Total Students: ${data.length}
        </td>
    </tr>
`);


}




        });
    });     
    
     
     
     // Filter table on keyup
$('#exam_table_search').on('keyup', function() {
    var value = $(this).val().toLowerCase();

    $('#exam_table tbody tr').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});
  
    
    //get request courses by centers selected
  $('.center_course_report').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var batch = $("#batch").val();
        var center_id = $("#center_id").val();
         var year = $("#year").val();
       
 

         
        $.ajax({
            url: "ajax/php/report.php",
            type: "POST",
            data: {
                 year: year,
                 batch: batch,
                 center_id: center_id,
                action: 'GET_COURSES_BY_CENTER'
            },
            dataType: "JSON",
            success: function (jsonStr) { 
                
  //remove preloarder
                $('.someBlock').preloader('remove');

                var html = '';
                $.each(jsonStr, function (i, data) {
                    i++
                   
                    
                    
                    html += '<tr>';
                    html += '<td>';
                    html += i;
                    html += '</td>';
                    html += '<td>';
                    html += data.id;
                    html += '</td>';
                    html += '<td>';
                    html += data.cname;
                    html += '</td>'; 
                      
                     html += '<td>';
                    html += data.cname;
                    html += '</td>'; 
                     html += '<td>';
                    html += '';
                    html += '</td>'; 
                    html += '</tr>';
                });

                $('#exam_table').empty();
                $('#exam_table').append(jsonStr);
            }
        });
    }); 
    
    
  
   $('.center_exam_student_report_by_course').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var batch = $("#batch").val();
        var center_id = $("#center").val();
        var year = $("#year").val();
        var course_name = $("#course").val();

         
        $.ajax({
            url: "ajax/php/report.php",
            type: "POST",
            data: {
                year: year,
                batch: batch,
                course_id: course_name,
                center_id: center_id,
                action: 'GET_FINAL_MARK'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                //remove preloarder
                $('.someBlock').preloader('remove');

                var html = '';
                $.each(jsonStr, function (i, data) {
                    i++
                   
                    
                    
                    html += '<tr>';
                    html += '<td>';
                    html += i;
                    html += '</td>';
                    html += '<td>';
                    html += data.id;
                    html += '</td>';
                    html += '<td>';
                    html += data.fname+' '+data.lname;
                    html += '</td>'; 
                    
                    html += '<td>';
                    html += data.nic;
                    html += '</td>';
                    html += '<td>';
                    html += data.practical_mark;
                    html += '</td>'; 
                     html += '<td>';
                    html += data.full_marks;
                    html += '</td>'; 
                     html += '<td>';
                    html += data.grade;
                    html += '</td>'; 
                    html += '</tr>';
                });

                $('#course_table').empty();
                $('#course_table').append(html);
            }
        });
    });     
   
    $('.course-request-report').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var batch = $("#course_batch").val()
        var center_id = $("#center").val();
        var year = $("#course_year").val(); 

         
        $.ajax({
            url: "ajax/php/report.php",
            type: "POST",
            data: {
                year: year,
                batch: batch, 
                center_id: center_id,
                action: 'GET_COURSE_REQUEST_DETAILS'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                

                var html = '';
              $.each(jsonStr, function (i, data) {
    i++;
    
        var courseFeeFormatted = 'Rs. ' + parseFloat(data.course_fee).toLocaleString('en-LK', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
      var statusText = '';
    if (data.status == '1') {
        statusText = '<span style="color: green; font-weight: bold;">Approved</span>';
    } else if (data.status == '2') {
        statusText = '<span style="color: red; font-weight: bold;">Rejected</span>';
    } else {
        statusText = '<span style="color: gray;">Pending</span>';
    }

    html += '<tr>';
    html += '<td>' + i + '</td>';
html += '<td>' + data.course_id + ' - ' + data.course_name + '</td>';
    html += '<td>' + data.year + '</td>';
    html += '<td>' + data.batch + '</td>';
    html += '<td>' + data.center_name + '</td>';
    html += '<td>' + data.all_student + '</td>'; 
        html += '<td>' + courseFeeFormatted + '</td>';
    html += '<td>' + data.teaching_days + '</td>'; 
    html += '<td>' + data.request_date + '</td>';
    html += '<td>' + statusText  + '</td>';
    html += '</tr>';
});


                $('#course_table').empty();
                $('#course_table').append(html);
                //remove preloarder
                $('.someBlock').preloader('remove');
            }
        });
    });     
    
    
   //----------- student Practical Mark Report -----
  $(document).on("click", "#btn-report-final-mark", function (e) {
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
      $("#report-form").attr("action", "center-final-mark-report-pdf.php");
      $("#report-form").submit();
    }
  });
  
    $(document).on("click", "#btn-report-1", function (e) {
    e.preventDefault();

    if (!$("#course_year").val() || $("#course_year").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please select course year.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      return false;
    }  else{
      $("#report-form").attr("action", "print-course-request.php");
      $("#report-form").submit();
    }
  });
   
});