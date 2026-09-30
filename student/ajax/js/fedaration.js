jQuery(document).ready(function () {

 
    
    
    //---------- Start Create Data ---------
    $("#create").click(function (event) {
        event.preventDefault();

        //-- ** Start Error Messages
        if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter fadaration name.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });
        }  else if (!$('#address').val() || $('#address').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter address..!",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });
        }else if (!$('#mobile_number').val() || $('#mobile_number').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter mobile number..!",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });
        } else if (!$('#office_number').val() || $('#office_number').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter office number..!",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });
        } else if (!$('#email').val() || $('#email').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter email address..!",
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
                url: "ajax/php/fedaration.php",
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
    //---------- Start Edit Data ---------
    $("#update").click(function (event) {
        event.preventDefault();
        //-- ** Start Error Messages
        if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter fadaration name.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });
        }  else if (!$('#address').val() || $('#address').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter address..!",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });
        }else if (!$('#mobile_number').val() || $('#mobile_number').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter mobile number..!",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });
        } else if (!$('#office_number').val() || $('#office_number').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter office number..!",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });
        } else if (!$('#email').val() || $('#email').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter email address..!",
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
                url: "ajax/php/fedaration.php",
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
                            text: "Your data updated successfully !",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false,
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
    
    //---------- End Update Data ---------
   

});