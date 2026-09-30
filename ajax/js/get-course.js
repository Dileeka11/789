

$(document).ready(function () {

//get course by course type
    $('.change_details').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var type = $('#course_type').val();
        var duration = $('#duration').val();

        $('#course-bar').empty();

        $.ajax({
            url: "ajax/php/get-course.php",
            type: "POST",
            data: {
                type: type,
                duration: duration,
                action: 'GET_COURSE_NAME'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                //remove preloarder
                $('.someBlock').preloader('remove');

              
                var html = '<option value="" > - Select your course - </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.courseid   + '">';
                    html += data.courseid +' - '+ data.cname+' | Level - '+data.level + ' | Months - '+data.durationm;
                    html += '</option>';
                });

                $('#course-bar').empty();
                $('#course-bar').append(html);
            }
        });
    });


});

