$(document).ready(function () {


    $(document).on("click", ".action", function () {

        var id = $(this).attr("data-id");
        var exam_id = $(this).attr("exam_id");
 
        swal(
                {
                    title: "Are you sure?",
                    text: "Do you want to active or inactive this action  .!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, do it!",
                    closeOnConfirm: false,
                },
                function () {
                    $.ajax({
                        url: "ajax/php/action-panel.php",
                        type: "POST",
                        data: {
                            id: id,  
                            exam_id:exam_id,
                        },
                        dataType: "JSON",
                        success: function (jsonStr) {
                            if (jsonStr.status) {
                                swal({
                                    title: "Done!",
                                    text: "This active panel was success..",
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
