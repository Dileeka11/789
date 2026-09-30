$("document").ready(function () {
    
    $("#create").click(function (event) {
        event.preventDefault();
        //-- ** Start Error Messages
        if (!$("#full_name_1").val() || $("#full_name_1").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter nomination full name.",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#full_name_2").val() || $("#full_name_2").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter nomination name..!",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#address").val() || $("#address").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter nomination address..!",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        
        } else if (!$("#nic").val() || $("#nic").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter nomination national Id number..!",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#nic_2").val() || $("#nic_2").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter nomination national Id number..!",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#mobile_number").val() || $("#mobile_number").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter nomination mobile number..!",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#province_id").val() || $("#province_id").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select Province..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#district_id").val() || $("#district_id").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter district..!",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#divisional_id").val() || $("#divisional_id").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select your divisional Secretariat ..!",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#birth_date").val() || $("#birth_date").val().length === 0) {
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
                url: "ajax/php/youth-member.php",
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
                                window.location.reload();
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
    
      $("#instructor").click(function (event) {
        event.preventDefault();
        //-- ** Start Error Messages
        if (!$("#full_name").val() || $("#full_name").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter full name.",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#mobile_number").val() || $("#mobile_number").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter mobile number.",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#email").val() || $("#email").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your emaill address..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        }else if (!$("#course_type").val() || $("#course_type").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select course Type..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        }else if (!$("#duration").val() || $("#duration").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select course duration..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#course-bar").val() || $("#course-bar").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select course bar..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
       
        } else if (!$("#center_id").val() || $("#center_id").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select center name..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#password").val() || $("#password").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter password..!",
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
                                text: "Your data updated successfully !",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                            window.setTimeout(function () {
                                window.location.href = "instructor-success.php";
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
    
});
