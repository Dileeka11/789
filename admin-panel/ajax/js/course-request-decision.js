$(document).ready(function () {

//get course approved 
    $(document).on("click", ".approved_course", function () {

        var id = $(this).attr("data-id");
       
        swal({
            title: "Are you sure?",
            text: "If you want to approved this course request now.!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2b8a68",
            confirmButtonText: "Yes, Approved it!",
            closeOnConfirm: false
        },
                function () {
                    $.ajax({
            url: "ajax/php/course-request-decision.php",
            type: "POST",
            data: {
                id: id,
                action: 'approved'
            },
            dataType: "JSON",
            success: function (jsonStr) {
                if (jsonStr.status) {
                                swal({
                                    title: "Approved!",
                                    text: "This Course Request was Approved now.!",
                                    type: "success",
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                                window.location.reload();
                            }
            }
        });
                                    }
        );
    });
});