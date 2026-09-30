$(document).ready(function () {


//---------- Start course request ---------
    $("#create").click(function (event) {
    event.preventDefault();
    //-- ** Start Error Messages
    if (!$('#course-bar').val() || $('#course-bar').val().length === 0) {
        swal({
            title: "Error!",
            text: "Please select course name.",
            type: 'error',
            timer: 3000,
            showConfirmButton: false
        });
    } else if (!$('#year').val() || $('#year').val().length === 0) {
        swal({
            title: "Error!",
            text: "Please select course year.",
            type: 'error',
            timer: 3000,
            showConfirmButton: false
        });
    } else if (!$('#batch').val() || $('#batch').val().length === 0) {
        swal({
            title: "Error!",
            text: "Please select course batch.",
            type: 'error',
            timer: 3000,
            showConfirmButton: false
        });
    } else if (!$('#num_students').val() || $('#num_students').val().length === 0) {
        swal({
            title: "Error!",
            text: "Please select number of students.",
            type: 'error',
            timer: 3000,
            showConfirmButton: false
        });
    } else if (!$('#teaching_days').val() || $('#teaching_days').val().length === 0) {
        swal({
            title: "Error!",
            text: "Please select teaching days.",
            type: 'error',
            timer: 3000,
            showConfirmButton: false
        });
    } else if (!$('#course_fee').val() || $('#course_fee').val().length === 0) {
        swal({
            title: "Error!",
            text: "Please enter the course fee.",
            type: 'error',
            timer: 3000,
            showConfirmButton: false
        });
    } else if (/[,\.]/.test($('#course_fee').val()) || parseInt($('#course_fee').val()) === 0) {
        swal({
            title: "Error!",
            text: "Course fee cannot contain commas, periods, or be zero.",
            type: 'error',
            timer: 3000,
            showConfirmButton: false
        });
    } else if (!$('#dg_approvel').val() || $('#dg_approvel').val().length === 0) {
        swal({
            title: "Error!",
            text: "Please select DG Approvel.",
            type: 'error',
            timer: 3000,
            showConfirmButton: false
        });
    } else {

        //start preloader
        $('.someBlock').preloader();

        //grab all form data  
        var formData = new FormData($('#form-data')[0]); //grab all form data  
        formData.append("create", "TRUE");
        $.ajax({
            url: "ajax/php/course-requests.php",
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function (result) {
                //remove preloader
                $('.someBlock').preloader('remove');
                if (result.status === 'success') {
                    swal({
                        title: "Success!",
                        text: "Your data saved successfully!",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    window.setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                } else if (result.status === 'error') {
                    swal({
                        title: "Error!",
                        text: "Something went wrong.",
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            }
        });
    }
    return false;
});

    //---------- Start course request ---------
    $("#update").click(function (event) {
        event.preventDefault();
        //-- ** Start Error Messages
        if (!$('#num_students').val() || $('#num_students').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select number of students.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });
        } else if (!$('#teaching_days').val() || $('#teaching_days').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select teaching days.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });
        } else if (!$('#year').val() || $('#year').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select course year.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });
        } else if (!$('#batch').val() || $('#batch').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select course batch.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });
        } else if (!$('#course_fee').val() || $('#course_fee').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the course fee.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });
        } else if (!$('#dg_approvel').val() || $('#dg_approvel').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select DG Approvel.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });
        } else {

//start preloarder
            $('.someBlock').preloader();
            //grab all form data  

            var formData = new FormData($('#form-data')[0]); //grab all form data  


            $.ajax({
                url: "ajax/php/course-requests.php",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (result) {
                    //remove preloarder
                    $('.someBlock').preloader('remove');
                    if (result.status === 'success') {
                        swal({
                            title: "success!",
                            text: "Your data saved successfully !",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        window.setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else if (result.status === 'error') {
                        swal({
                            title: "Error!",
                            text: "Something went wrong",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }
            });
        }
        return false;
    });
    //get course approved 
    $(document).on("click", ".approved_course", function () {

        var id = $(this).attr("data-id");
       
        swal({
            title: "Are you sure?",
            text: "If you want to approved this course request now.!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2b8a68",
            confirmButtonText: "Yes, Approved it!",
            closeOnConfirm: false
        },
                function () {
                    alert(id);
                    $.ajax({
            url: "ajax/php/course-request-decision.php",
            type: "POST",
            data: {
                id: id,
                action: 'approved'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                if (jsonStr.status) {
                                swal({
                                    title: "Approved!",
                                    text: "This Course Request was Approved now.!",
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

$(document).on('click','.open-modal',function() {
    let id = $(this).attr('request-id');
    $('#request-id').val(id);
});

    //get course approved 
       $(document).on("click", ".reject_course", function () {
 
        var id = $('#request-id').val();
        
        
        // if (!$('.description').val() || $('.description').val().length === 0) {
        //     swal({
        //         title: "Error!",
        //         text: "Please enter course reject reason.",
        //         type: 'error',
        //         timer: 3000,
        //         showConfirmButton: false
        //     }); 
        // } else {
 $('#exampleModalCenter'+id).modal({
            backdrop: 'static',
            keyboard: false
        });
            var description = $('#description').val();
            swal({
                title: "Are you sure?",
                text: "If you want to reject this course request now.!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#a52d2d",
                confirmButtonText: "Yes, Rejected it!",
                closeOnConfirm: false
            },
                    function () {
                        $.ajax({
                            url: "ajax/php/course-request-decision.php",
                            type: "POST",
                            data: {
                                description: description,
                                id: id,
                                action: "rejected"
                            },
                            dataType: "JSON",
                            success: function (jsonStr) {
                                if (jsonStr.status) {
                                    swal({
                                        title: "Rejected!",
                                        text: "This Course Request was Rejected now.!",
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
        // }
    });
    
      //get course request by year
    $('#course_batch').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

          var batch = $(this).val();
        var center_id = $("#center").val();
        var year = $("#course_year").val();

        $('#course').empty();
        $.ajax({
            url: "ajax/php/course-by-type.php",
            type: "POST",
            data: {
                year: year,
                batch: batch,
                center_id: center_id,
                action: 'GET_COURSE_BY_YEAR'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                //remove preloarder
                $('.someBlock').preloader('remove');

                var html = '<option value="" > - Select your course - </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.courseid   + '">';
                    html += '<span class="text-danger"> ('+data.courseid+ ') </span> - '+data.cname+' / Level - '+data.level + ' / Months - '+data.durationm;
                    html += '</option>';
                });

                $('#course').empty();
                $('#course').append(html);
            }
        });
    });  
    
    
});