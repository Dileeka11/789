jQuery(document).ready(function () {
    //---------- Start course request ---------
    $("#create").click(function (event) {
        event.preventDefault();

        //-- ** Start Error Messages
        if (!$("#center_name").val() || $("#center_name").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter center name.",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#center_name").val() || $("#center_name").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter center name.",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#province_id").val() || $("#province_id").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select province name.",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#district_id").val() || $("#district_id").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select district name.",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });

        } else {
            //start preloarder
            $(".someBlock").preloader();
            //grab all form data

            var formData = new FormData($("#form-data")[0]); //grab all form data

            $.ajax({
                url: "ajax/php/center.php",
                type: "POST",
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (result) {
                    //remove preloarder
                    $(".someBlock").preloader("remove");

                    if (result.status === "success") {
                        swal({
                            title: "success!",
                            text: "Your data saved successfully !",
                            type: "success",
                            timer: 2000,
                            showConfirmButton: false,
                        });
                        window.setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else if (result.status === "error") {
                        swal({
                            title: "Error!",
                            text: "Something went wrong",
                            type: "error",
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    }
                },
            });
        }
        return false;
    });

    //---------- Start course request ---------
    $("#update").click(function (event) {
        event.preventDefault();

        //-- ** Start Error Messages
        if (!$("#coursetrade").val() || $("#coursetrade").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select course trade.",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#cname").val() || $("#cname").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter course name.",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#courseid").val() || $("#courseid").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter course id.",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#level").val() || $("#level").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select course level.",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#fullpart").val() || $("#fullpart").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select course type",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#durationm").val() || $("#durationm").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select course duration.",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#nvqnon").val() || $("#nvqnon").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the course fee.",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#module-name-1").val() || $("#module-name-1").val().length === 0 || !$("#module-code-1").val() || $("#module-code-1").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter at least one module.",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else {
            //start preloarder
            $(".someBlock").preloader();
            //grab all form data

            var formData = new FormData($("#form-data")[0]); //grab all form data

            $.ajax({
                url: "ajax/php/course.php",
                type: "POST",
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (result) {
                    //remove preloarder
                    $(".someBlock").preloader("remove");

                    if (result.status === "success") {
                        swal({
                            title: "success!",
                            text: "Your data saved successfully !",
                            type: "success",
                            timer: 2000,
                            showConfirmButton: false,
                        });
                        window.setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else if (result.status === "error") {
                        swal({
                            title: "Error!",
                            text: "Something went wrong",
                            type: "error",
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    }
                },
            });
        }
        return false;
    });

   
});
