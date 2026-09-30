

$(document).ready(function () {
    $(document).on('change', '#fedaration', function () {
        //$('.someBlock').preloader();
        //grab all form data  

        var fedaration = $('#fedaration').val();

        $('.append_details').empty();

        $.ajax({
            url: "ajax/php/get-fedaration.php",
            type: "POST",
            data: {
                fedaration: fedaration,
                action: 'GET_FEDARATION'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                //remove preloarder
              //  $('.someBlock').preloader('remove');
   
                
                $('#address').val(jsonStr.address);
                $('#mobile_number').val(jsonStr.mobile_number);
                $('#office_number').val(jsonStr.office_number);
                $('#email').val(jsonStr.email);
            }
        });
    });
});

