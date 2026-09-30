jQuery(document).ready(function () {

 
    //---------- Start Create Data ---------
    $("#create_conditions").click(function (event) {
        event.preventDefault();

        //-- ** Start Error Messages
        if (!$('#conditions').val() || $('#conditions').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter condition  .",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });

        } else {

            //start preloarder
            $('.someBlock').preloader();
            //grab all form data  

            var formData = new FormData($('#form-data')[0]); //grab all form data  
            formData.append("create", "TRUE");

            $.ajax({
                url: "ajax/php/conditions.php",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
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
                            window.location.reload()
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
    //---------- End Create Data ---------
    //------------------------------------

   
 
    //---------- Start Create Data ---------
    $("#update_conditions").click(function (event) {
        event.preventDefault();

        //-- ** Start Error Messages
        if (!$('#conditions').val() || $('#conditions').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter condition  .",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });

        } else {

            //start preloarder
            $('.someBlock').preloader();
            //grab all form data  

            var formData = new FormData($('#form-data')[0]); //grab all form data  
            formData.append("create", "TRUE");

            $.ajax({
                url: "ajax/php/conditions-update.php",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
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
                            window.location.reload()
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
    //---------- End Create Data ---------
    //------------------------------------

   
    


});