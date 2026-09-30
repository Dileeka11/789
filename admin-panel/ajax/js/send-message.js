jQuery(document).ready(function () {


    //---------- Start course request ---------
    $("#create").click(function (event) {
        event.preventDefault();
        tinymce.triggerSave();

        //-- ** Start Error Messages
        if (!$('#message').val() || $('#message').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your message.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });

        } else {

            //start preloarder
            $('.someBlock').preloader();
            //grab all form data  

            var formData = new FormData($('#form-data')[0]);

            $.ajax({
                url: "ajax/php/send-message.php",
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

    //---------- Start course request ---------
    $("#update").click(function (event) {
        event.preventDefault();
        tinymce.triggerSave();

        //-- ** Start Error Messages
        if (!$('#message').val() || $('#message').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your message.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });

        } else {

            //start preloarder
            $('.someBlock').preloader();
            //grab all form data  

            var formData = new FormData($('#form-data')[0]);

            $.ajax({
                url: "ajax/php/send-message.php",
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



    


});

 