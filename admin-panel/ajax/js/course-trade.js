jQuery(document).ready(function () {


    //---------- Start course request ---------
    $("#create").click(function (event) {
        event.preventDefault();

        //-- ** Start Error Messages
        if (!$('#trade_name').val() || $('#trade_name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter course trade name.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });

        } else if (!$('#trade_code').val() || $('#trade_code').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter trade code.",
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
                url: "ajax/php/course-trade.php",
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

        //-- ** Start Error Messages
        if (!$('#trade_name').val() || $('#trade_name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter course trade name.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });

        } else if (!$('#trade_code').val() || $('#trade_code').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter trade code.",
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
                url: "ajax/php/course-trade.php",
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

 