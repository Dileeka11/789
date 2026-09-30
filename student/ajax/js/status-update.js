$(document).ready(function () {


    $(".save-data").click(function (event) {

        event.preventDefault();
       
        var id = $(this).attr("dataId");
        //start preloarder

        //grab all form data  
        var formData = new FormData($('#form-data-' + id)[0]);
        formData.append("update", "TRUE");
//            formData.append("id", id);
        $.ajax({
            url: "ajax/php/file.php",
            type: "POST",
            data: formData,
            async: false,
            dataType: 'json',
            success: function (result) {
                //remove preloarder
 
                swal({
                    title: "Success!",
                    text: "Your changes saved successfully!...",
                    type: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }, function () {
                    window.location.reload();
                });
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});