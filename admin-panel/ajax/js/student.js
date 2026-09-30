$("document").ready(function () {
    $("#create").click(function (event) {
        event.preventDefault();
        //-- ** Start Error Messages
        if (!$("#nic").val() || $("#nic").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter nic number.",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });update
        } else if (!$("#fname").val() || $("#fname").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter first name..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
      
        } else if (!$("#courseid").val() || $("#courseid").val().length === 0) {
            swal({
                title: "Error!",
                text: "Please select course..!",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
        } else if (!$("#centercode").val() || $("#centercode").val().length === 0) {
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

            var formData = new FormData($("#form-data")[0]); //grab all form data
            

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
          
        // } else if (!$("#mobile_number").val() || $("#mobile_number").val().length === 0) {
        //     swal({
        //         title: "Error!",
        //         text: "Please select mobile number..!",
        //         type: "error",
        //         timer: 2000,
        //         showConfirmButton: false,
        //     });
       
        // } else if (!$("#gn_id").val() || $("#gn_id").val().length === 0) {
        //     swal({
        //         title: "Error!",
        //         text: "Please select Gn Division..!",
        //         type: "error",
        //         timer: 2000,
        //         showConfirmButton: false,
        //     });
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
                                // window.location.href = "manage-students-by-course.php?id=" + $("#course").val();
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
     
     //---------- Start Edit Data ---------
     $("#update_center").click(function (event) {
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
          
        // } else if (!$("#mobile_number").val() || $("#mobile_number").val().length === 0) {
        //     swal({
        //         title: "Error!",
        //         text: "Please select mobile number..!",
        //         type: "error",
        //         timer: 2000,
        //         showConfirmButton: false,
        //     });
       
        // } else if (!$("#gn_id").val() || $("#gn_id").val().length === 0) {
        //     swal({
        //         title: "Error!",
        //         text: "Please select Gn Division..!",
        //         type: "error",
        //         timer: 2000,
        //         showConfirmButton: false,
        //     });
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
                                // window.location.href = "manage-students-by-center-course.php?id=" + $("#course").val();
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
    
    //get drop out students
    $(document).on("click", ".drop_to_students", function () {

        var id = $(this).attr("data-id");

        swal({
            title: "Are you sure?",
            text: "If you want to dropout this student in this course.!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d30e0e",
            confirmButtonText: "Yes, Dropout Now!",
            closeOnConfirm: false
        },
                function () {
                    $.ajax({
                        url: "ajax/php/dropout.php",
                        type: "POST",
                        data: {
                            id: id,
                            option: "dropout"
                        },
                        dataType: "JSON",
                        success: function (jsonStr) {
                            if (jsonStr.status) {
                                swal({
                                    title: "Approved!",
                                    text: "This student was dropout now.!",
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
    
    
  //student payments
  $("#payment").click(function (event) {
        event.preventDefault();


        if (!$('#amount').val() || $('#amount').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please Enter payment amount.",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });

        } else {
//preloarder start
            $('.someBlock').preloader();
            //grab all form data  

            var formData = new FormData($("#form-data")[0]);
            $.ajax({
                url: "ajax/php/student.php",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (result) {
//remove preloarder
                    $('.someBlock').preloader('remove');
                    if (result.status === 'success') {
                        swal({
                            title: "success!",
                            text: "Your data saved successfully !",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        window.setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else if (result.status === 'error') {

                        swal({
                            title: "Error!",
                            text: "Something went wrong",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }
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
});
