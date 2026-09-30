

$(document).ready(function () {

//get course by course type
    $("#type").change(function () {
        var type = $(this).val();

        if (type == "1") {
            $("#position_bar").removeClass("hidden");
            $("#send_divisions").addClass("hidden");

        } else if (type == "2") {
            $("#send_divisions").removeClass("hidden");
            $("#position_bar").addClass("hidden");
        } else {
            $("#position_bar").removeClass("hidden");
           $("#send_divisions").removeClass("hidden");
        }
    });


});

