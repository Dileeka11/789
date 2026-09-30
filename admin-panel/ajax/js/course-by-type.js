

$(document).ready(function () {

//get course by course type
    $('#type').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var type = $(this).val();

        $('#course-bar').empty();
        $.ajax({
            url: "ajax/php/course-by-type.php",
            type: "POST",
            data: {
                type: type,
                action: 'GET_COURSE_BY_TYPE'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                //remove preloarder
                $('.someBlock').preloader('remove');

                var html = '<option value="" > - Select your course - </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.courseid   + '">';
                    html += data.cname+' / Level - '+data.level + ' / Months - '+data.durationm;
                    html += '</option>';
                });

                $('#course-bar').empty();
                $('#course-bar').append(html);
            }
        });
    });     
    
    
});

