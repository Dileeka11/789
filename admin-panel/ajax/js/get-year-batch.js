

$(document).ready(function () {

//get course by course type
    $('#year').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var id = $(this).val();

        $('#batch').empty();
        $.ajax({
            url: "ajax/php/get-year-batch.php",
            type: "POST",
            data: {
                id: id,
                action: 'GET_BATCH_BY_YEAR'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                //remove preloarder
                $('.someBlock').preloader('remove');

                var html = '<option value="" > - Select your district - </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.id   + '">';
                    html += data.name;
                    html += '</option>';
                });

                $('#batch').empty();
                $('#batch').append(html);
            }
        });
    });     
    
    
});

