$("document").ready(function () {

    $("#create").click(function (event) {
        event.preventDefault();
        //-- ** Start Error Messages
        if (!$("#full_name").val() || $("#full_name").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your full name.",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#address").val() || $("#address").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your address..!",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#nic").val() || $("#nic").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your national Id number..!",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#mobile_number").val() || $("#mobile_number").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your mobile number..!",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#province_id").val() || $("#province_id").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select center..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#district_id").val() || $("#district_id").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your district..!",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#divisional_id").val() || $("#divisional_id").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select your divisional secture..!",
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
                url: "ajax/php/applications.php",
                type: "POST",
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (result) {
                    //remove preloarder

                    window.setTimeout(function () {
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
                                window.location.replace('success.php');
                            }, 4000);
                        } else if (result.status === "error") {
                            swal({
                                title: "Error!",
                                text: "Something went wrong",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                        }
                    }, 2000);
                },
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
        if (!$("#nic").val() || $("#nic").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter NIC number.",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#fname").val() || $("#fname").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter first name.",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#lname").val() || $("#lname").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter last name..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#course").val() || $("#course").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select course..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#center").val() || $("#center").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select center..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#year").val() || $("#year").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select year..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });

        } else if (!$("#batch").val() || $("#batch").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select batch..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else {
            //start preloarder
            $(".someBlock").preloader();
            //grab all form data
            var formData = new FormData($("#form-data")[0]);
            $.ajax({
                url: "ajax/php/student.php",
                type: "POST",
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (result) {
                    //remove preloarder
                    window.setTimeout(function () {
                        $(".someBlock").preloader("remove");
                        if (result.status === "success") {
                            swal({
                                title: "success!",
                                text: "Your data updated successfully !",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                            window.setTimeout(function () {
                                window.location.href = "manage-students-by-course.php?id=" + $("#course").val();
                            }, 4000);
                        } else if (result.status === "error") {
                            swal({
                                title: "Error!",
                                text: "Something went wrong",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                        }
                    }, 2000);
                },
            });
        }
        return false;
    });

    $("#type").change(function () {
        var type = $(this).val();

        if (type == "3") {
            $("#center_name_section").removeClass("hidden");
        } else {
            $("#center_name_section").addClass("hidden");
        }
    });


    //get course approved 
    $(document).on("click", ".attend_to_students", function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "If you want to register this student now.!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2b8a68",
            confirmButtonText: "Yes, Registered.!",
            closeOnConfirm: false
        },
                function () {
                    $.ajax({
                        url: "ajax/php/applications.php",
                        type: "POST",
                        data: {
                            id: id,
                            option: "applied_to_students"
                        },
                        dataType: "JSON",
                        success: function (jsonStr) {
                            
                            
                            if (jsonStr.status) {
                                swal({
                                    title: "Approved!",
                                    text: "This student registered now successfully .!",
                                    type: "success",
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                               window.location.href = "manage-student-payments.php?id=" + jsonStr.id;
                            }
                        }
                    });
                }
        );
    });
    
    //open or close request
    $(document).on("click", ".course-request-open-close", function () {

        var id = $(this).attr("data-id");
        
        if(id == 1){
            $var = 'Open Request';
        }else{
             $var = 'Close Request';
        }
        
        swal(
                {
                    title: "Are you sure?",
                    text: "If you want to "+$var + " Now ..!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, "+$var + " Now.!",
                    closeOnConfirm: false,
                },
                function () {
                    $.ajax({
                        url: "ajax/php/custome.php",
                        type: "POST",
                        data: {id: id, action: "REQUEST_OPEN_OR_CLOSE"},
                        dataType: "JSON",
                        success: function (jsonStr) {
                            if (jsonStr.status) {
                                swal({
                                    title: "Accept!",
                                    text: "Your course request has been "+$var + " Now..",
                                    type: "success",
                                    timer: 2000,
                                    showConfirmButton: false,
                                });

                                
                            }
                        },
                    });
                }
        );
    });


});
