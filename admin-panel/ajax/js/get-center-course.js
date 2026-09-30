

$(document).ready(function () {

//get course by course type
    $('#center').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var id = $(this).val();

        $('#course').empty();
        $.ajax({
            url: "ajax/php/get-center-course.php",
            type: "POST",
            data: {
                id: id,
                action: 'GET_COURSE_BY_CENTER'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                //remove preloarder
                $('.someBlock').preloader('remove');

               var html = '<option value="" > - Select your center course - </option>';
                $.each(jsonStr, function (i, data) {
                    
                    if (data.fullpart == 1) {

                        var type = 'Full Time';
                    } else if (data.fullpart == 2) {
                        var type = 'Part Time';
                    } else {
                        var type = 'Short Time';

                    }


                    html += '<option value="' + data.courseid + '">';
                    html += data.courseid + ' - ' + data.cname + ' / Type - ' + type + ' / Level - ' + data.level + ' / Months - ' + data.durationm;
                    html += '</option>';
                     
                });

                $('#course').empty();
                $('#course').append(html);
            }
        });
    });     
    


//get year
    $('#course_year').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var id = $("#center").val();

        $('#course').empty();
        $.ajax({
            url: "ajax/php/get-center-course.php",
            type: "POST",
            data: {
                id: id,
                action: 'GET_COURSE_BY_CENTER'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                //remove preloarder
                $('.someBlock').preloader('remove');

               var html = '<option value="" > - Select your center course - </option>';
                $.each(jsonStr, function (i, data) {
                    
                    if (data.fullpart == 1) {

                        var type = 'Full Time';
                    } else if (data.fullpart == 2) {
                        var type = 'Part Time';
                    } else {
                        var type = 'Short Time';

                    }


                    html += '<option value="' + data.courseid + '">';
                    html += data.courseid + ' - ' + data.cname + ' / Type - ' + type + ' / Level - ' + data.level + ' / Months - ' + data.durationm;
                    html += '</option>';
                    
                    
                });

                $('#course').empty();
                $('#course').append(html);
            }
        });
    }); 
    
    
});

