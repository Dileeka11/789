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
        } else if (!$("#birth_date").val() || $("#birth_date").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter your birth date..!",
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
                text: "Please select your provincer..!",
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
        } else if (!$("#gn_id").val() || $("#gn_id").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select your Gn division..!",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
        } else if (!$("#still_member").val() || $("#divisional_id").val().length === 0) {
            swal({
                title: "Error!",
                text: "are you still smart youth club member..!",
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
                url: "ajax/php/smart-youth.php",
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
    
     
    
});
