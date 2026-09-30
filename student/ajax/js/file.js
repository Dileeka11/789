$(document).ready(function () {
 
    var myDropzone = new Dropzone(".dropzone", {
        url: "ajax/php/file_upload.php",
        paramName: "file",
        maxFilesize: 30,
        parallelUploads: 10,
        maxFiles: 10,
        acceptedFiles: "application/pdf",
        autoProcessQueue: false
    });

 
    //---------- Start Create Data ---------
    $("#startUpload").click(function (event) {

        event.preventDefault();
        //-- ** Start Error Messages
        if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter name..!",
                type: 'error',
                timer: 1500,
                showConfirmButton: false
            });
            //-- ** End Error Messages
        } else if (!$('#number').val() || $('#number').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter Number..!",
                type: 'error',
                timer: 1500,
                showConfirmButton: false
            });
            //-- ** End Error Messages
        }else if (!$('#type').val() || $('#type').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Select the Document Type..!",
                type: 'error',
                timer: 1500,
                showConfirmButton: false
            });
            //-- ** End Error Messages
        } else {
//            //start preloarder
//            $('.someBlock').preloader();
            //grab all form data  
            var formData = new FormData($('#form-data')[0]); //grab all form data  
            formData.append("create", "TRUE");
            $.ajax({
                url: "ajax/php/file.php",
                type: "POST",
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (result) {
//                    //remove preloarder
//                    $('.someBlock').preloader('remove');

                    if (result.status === 'success') {

                        myDropzone.on("sending", function (file, xhr, formData) {
                            formData.append("unit_id", result.last_id);
                        });

                        myDropzone.processQueue();
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
    });
    //---------- End Create Data ---------
    //------------------------------------
    //---------- Start Edit Data ---------
 
});