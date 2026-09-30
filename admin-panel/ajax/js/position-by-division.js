

$(document).ready(function () {

//get course by course type
    $('#division').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var type = $(this).val();

        $('#position-bar').empty();
        $.ajax({
            url: "ajax/php/position-by-division.php",
            type: "POST",
            data: {
                type: type,
                action: 'GET_All_POSITION_BY_DIVISION'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                //remove preloarder
                $('.someBlock').preloader('remove');

                var html = '<option value="" > - Select position - </option>';
                $.each(jsonStr, function (i, data) {
                    html += '<option value="' + data.id   + '">';
                    html += data.name ;
                    html += '</option>';
                });

                $('#position-bar').empty();
                $('#position-bar').append(html);
            }
        });
    });     
    

//get course by course type
    $('#position-bar').change(function () {

        $('.someBlock').preloader();
        //grab all form data  

        var type = $(this).val();
 
        $.ajax({
            url: "ajax/php/position-by-division.php",
            type: "POST",
            data: {
                type: type,
                action: 'GET_POSITION_DETAILSN'
            },
            dataType: "JSON",
            success: function (jsonStr) {

                //remove preloarder
                $('.someBlock').preloader('remove');
 
                $('#name').val(jsonStr.name);
                $('#username').val(jsonStr.name);
                $('#email').val(jsonStr.email);
                $('#phone').val(jsonStr.phone);
            }
        });
    });     
    
    
    //position change 
    $(document).on("click", ".hold_position", function () {

        var id = $(this).attr("data-id");
 
        swal(
                {
                    title: "Are you sure?",
                    text: "You want to deactivate this member in your devision.!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, Deactivate it!",
                    closeOnConfirm: false,
                },
                function () {
                    $.ajax({
                        url: "ajax/php/position-by-division.php",
                        type: "POST",
                        data: {
                            id: id,
                            action: 'HOLD_POSITION'
                        },
                        dataType: "JSON",
                        success: function (jsonStr) {
                            if (jsonStr.status) {
                                swal({
                                    title: "Deactivate!",
                                    text: "Your division member deactivate now..!",
                                    type: "success",
                                    timer: 2000,
                                    showConfirmButton: false,
                                });

                                $("#div" + id).remove();
                                window.location.reload();
                            }
                        },
                    });
                }
        );
    });
});

