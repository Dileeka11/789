$(document).ready(function () {
    //save
    // application 01
    $(document).on("click", ".submit-basic-details", function (e) {
        e.preventDefault();
        if ($("#fedaration").val() == "" && !$("#fedaration").val()) {
            swal({
                title: "Error!",
                text: "Please select district fedaration name",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
            return false;
        } else if (
                $("#tournament-name").val() == "" &&
                !$("#tournament-name").val()
                ) {
            swal({
                title: "Error!",
                text: "Please enter tournament name",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
            return false;
        } else if ($("#location").val() == "" && !$("#location").val()) {
            swal({
                title: "Error!",
                text: "Please enter location",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
            return false;
        } else if (
                $("#number-of-participation-countries").val() == "" &&
                !$("#number-of-participation-countries").val()
                ) {
            swal({
                title: "Error!",
                text: "Please enter number of participation countries",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
            return false;
        } else if (
                $("#tournament-duration").val() == "" &&
                !$("#tournament-duration").val()
                ) {
            swal({
                title: "Error!",
                text: "Please enter tournament duration",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
            return false;
        } else if ($("#arrival-date").val() == "" && !$("#arrival-date").val()) {
            swal({
                title: "Error!",
                text: "Please select arrival date",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
            return false;
        } else if (
                $("#departure-date").val() == "" &&
                !$("#departure-date").val()
                ) {
            swal({
                title: "Error!",
                text: "Please select departure date",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
            return false;
        } else {
            //start preloarder
            $(".someBlock").preloader();
            var formData = new FormData($("#application-form-01")[0]); //grab all form data
            formData.append("application", "application_01");
            $.ajax({
                url: "ajax/php/save-application.php",
                type: "POST",
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (result) {
                    window.setTimeout(function () {
                        $(".someBlock").preloader("remove");
                        if (result.status === "success") {
                            // swal({
                            //   title: "success!",
                            //   text: "Your data saved successfully !",
                            //   type: "success",
                            //   timer: 2000,
                            //   showConfirmButton: false,
                            // });
                            window.location.href = "application-02.php?id=" + result.id;
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
    });
    // application 02
    $(document).on("click", ".add-row", function (e) {
        let count = $(".member_count").val();
        let new_count = parseInt(count) + 1;
        let html = "";

        html += '<div class="row" id="row-' + new_count + '">';
        html += '<div class="mb-3 col-lg-3">';
        html += '<label class="form-label" for="name">Member Name </label>';
        html +=
                '<input type="text" name="member_name_' +
                new_count +
                '" class="form-control member_name_' +
                new_count +
                '" placeholder="Enter member name" />';
        html += "</div>";
        html += '<div class="mb-3 col-lg-3">';
        html +=
                '<label class="form-label" for="position_' +
                new_count +
                '">Member Position</label>';
        html +=
                '<input type="text" name="position_' +
                new_count +
                '" class="form-control position_' +
                new_count +
                '" placeholder="Enter member position" />';
        html += "</div>";
        html += '<div class="mb-3 col-lg-2">';
        html +=
                '<label class="form-label" for="passport_no_' +
                new_count +
                '">Passport Number</label>';
        html +=
                '<input type="text" name="passport_no_' +
                new_count +
                '" class="form-control passport_no_' +
                new_count +
                '" placeholder="Enter passport number" />';
        html += "</div>";
        html += '<div class="mb-3 col-lg-3">';
        html += '<label class="form-label" for="resume">Passport Copy</label>';
        html +=
                '<input type="file" class="form-control file-upload" row_id="' +
                new_count +
                '">';
        html +=
                '<input type="hidden" class="file-name-' +
                new_count +
                '" name="file_name_' +
                new_count +
                '">';
        html += "</div>";
        html += '<div class="col-lg-1 align-self-center">';
        html += '<div class="d-grid">';
        html +=
                '<input type="button" class="btn btn-sm btn-danger delete_row" value="Delete" row_id="' +
                new_count +
                '" />';
        html += "</div>";
        html += "</div>";
        html += "</div>";

        $(".member-section").append(html);
        $(".member_count").val(new_count);
    });
    $(document).on("click", ".delete_row", function (e) {
        let row_id = $(this).attr("row_id");
        $("#row-" + row_id).empty();
    });

    $(document).on("change", ".file-upload", function () {
        let currentElement = $(this);
        let row_id = $(this).attr("row_id");
        if (this.files && this.files[0]) {
            //start preloarder
            $(".someBlock").preloader();
            let formData = new FormData();
            formData.append("file", this.files[0]);
            formData.append("_token", "{{ csrf_token() }}");
            formData.append("directory", "members/passports/");
            $.ajax({
                url: "ajax/php/upload-file.php",
                data: formData,
                method: "POST",
                async: false,
                cache: false,
                contentType: false,
                enctype: "multipart/form-data",
                processData: false,
                dataType: "json",
                success: function (response) {
                    window.setTimeout(function () {
                        $(".someBlock").preloader("remove");
                        if (response.status == "success") {
                            $(".file-name-" + row_id).val(response.fileName);
                            swal({
                                title: "success!",
                                text: "File uploaded successfully..!",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                        } else {
                            $(".file-name-" + row_id).val();
                            swal({
                                title: "Error!",
                                text: "There was an error. Please try again.",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                        }
                    }, 2000);
                },
                error: function (response) {
                    console.log("fileUpload ajax error", response);
                    currentElement.parent().find(".file-name").val("");
                    swal({
                        title: "Error!",
                        text: "There was an error. Please try again.",
                        type: "error",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                },
            });
        }
    });

    $(document).on("click", ".submit-member-details", function (e) {
        e.preventDefault();
        let count = $(".member_count").val();
        let i = 1;
        for (i = 1; i <= count; i++) {
            let nth1 = nth(i);
            if ($(".member_name_" + i).val() == "" && !$(".member_name_" + i).val()) {
                swal({
                    title: "Error!",
                    text: "Please enter " + i + nth1 + " member name",
                    type: "error",
                    timer: 3000,
                    showConfirmButton: false,
                });
                return false;
            } else if (
                    $(".position_" + i).val() == "" &&
                    !$(".position_" + i).val()
                    ) {
                swal({
                    title: "Error!",
                    text: "Please enter " + i + nth1 + " member position",
                    type: "error",
                    timer: 3000,
                    showConfirmButton: false,
                });
                return false;
            } else if (
                    $(".passport_no_" + i).val() == "" &&
                    !$(".passport_no_" + i).val()
                    ) {
                swal({
                    title: "Error!",
                    text: "Please enter " + i + nth1 + " member passport number",
                    type: "error",
                    timer: 3000,
                    showConfirmButton: false,
                });
                return false;
            } else if (
                    $(".file-name-" + i).val() == "" &&
                    !$(".file-name-" + i).val()
                    ) {
                swal({
                    title: "Error!",
                    text: "Please select " + i + nth1 + " member passport copy",
                    type: "error",
                    timer: 3000,
                    showConfirmButton: false,
                });
                return false;
            }
        }
        //start preloarder
        $(".someBlock").preloader();
        var formData = new FormData($("#application-form-02")[0]); //grab all form data
        formData.append("application", "application_02");
        $.ajax({
            url: "ajax/php/save-application.php",
            type: "POST",
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (result) {
                window.setTimeout(function () {
                    $(".someBlock").preloader("remove");
                    if (result.status === "success") {
                        // swal({
                        //   title: "success!",
                        //   text: "Your data saved successfully !",
                        //   type: "success",
                        //   timer: 2000,
                        //   showConfirmButton: false,
                        // });
                        window.location.href = "application-03.php?id=" + result.id;
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
    });
    //application 03
    $(document).on("change", ".doc-upload", function () {
        let currentElement = $(this);
        let doc_id = $(this).attr("doc_id");
        if (this.files && this.files[0]) {
            //start preloarder
            $(".someBlock").preloader();
            let formData = new FormData();
            formData.append("file", this.files[0]);
            formData.append("_token", "{{ csrf_token() }}");
            formData.append("directory", "documentations/");
            $.ajax({
                url: "ajax/php/upload-file.php",
                data: formData,
                method: "POST",
                async: false,
                cache: false,
                contentType: false,
                enctype: "multipart/form-data",
                processData: false,
                dataType: "json",
                success: function (response) {
                    window.setTimeout(function () {
                        $(".someBlock").preloader("remove");
                        if (response.status == "success") {
                            $(".file-name-" + doc_id).val(response.fileName);
                            swal({
                                title: "success!",
                                text: "File uploaded successfully..!",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                        } else {
                            $(".file-name-" + doc_id).val();
                            swal({
                                title: "Error!",
                                text: "There was an error. Please try again.",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                        }
                    }, 2000);
                },
                error: function (response) {
                    console.log("fileUpload ajax error", response);
                    currentElement.parent().find(".file-name").val("");
                    swal({
                        title: "Error!",
                        text: "There was an error. Please try again.",
                        type: "error",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                },
            });
        }
    });

    $(document).on("click", ".submit-documents", function (e) {
        e.preventDefault();
        let count = $(".doc_count").val();
        let i = 1;
        for (i = 1; i <= count; i++) {
            let nth1 = nth(i);
            if ($(".doc_" + i).val() == "" && !$(".doc_" + i).val()) {
                swal({
                    title: "Error!",
                    text: "Please select " + $(".doc_title_" + i).val() + " document",
                    type: "error",
                    timer: 3000,
                    showConfirmButton: false,
                });
                return false;
            }
        }
        //start preloarder
        $(".someBlock").preloader();
        var formData = new FormData($("#application-form-03")[0]); //grab all form data
        formData.append("application", "application_03");
        $.ajax({
            url: "ajax/php/save-application.php",
            type: "POST",
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (result) {
                window.setTimeout(function () {
                    $(".someBlock").preloader("remove");
                    if (result.status === "success") {
                        // swal({
                        //   title: "success!",
                        //   text: "Your data saved successfully !",
                        //   type: "success",
                        //   timer: 2000,
                        //   showConfirmButton: false,
                        // });
                        window.location.href = "application-04.php?id=" + result.id;
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
    });


    $(document).on("click", ".is_check", function (e) {
        e.preventDefault();

        let app_id = $(".app-id").val();
        let grant_amount = $("#grant_amount").val();
        let name = $(this).attr('data-id');


        //start preloarder
        $(".someBlock").preloader();

        $.ajax({
            url: "ajax/php/resend-is-check.php",

            type: "POST",
            data: {
                app_id,
                application: "government_check",
                name,
                grant_amount

            },
            dataType: "JSON",

            success: function (result) {
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
                }, 2000);
            },
        });


    });


    //complete application
    $(document).on("click", ".complete-application", function (e) {
        e.preventDefault();
        let app_id = $(".app-id").val();
        Swal.fire({
            title: "Are you sure?",
            text: "You will not be able to update this application after completing it!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, finish it!",
        }).then(function (result) {
            console.log(result);
            if (result.isConfirmed) {
                //start preloarder
                $(".someBlock").preloader();
                $.ajax({
                    url: "ajax/php/save-application.php",
                    type: "POST",
                    data: {
                        app_id,
                        application: "application_04",
                    },
                    dataType: "json",
                    success: function (result) {
                        window.setTimeout(function () {
                            $(".someBlock").preloader("remove");
                            if (result.status === "success") {
                                Swal.fire({
                                    title: "Success!",
                                    text: "Your application was submitted successfully !",
                                    icon: "success",
                                    timer: 2000,
                                    showConfirmButton: false,
                                });
                                window.setTimeout(function () {
                                    window.location.href = "index.php";
                                }, 2000);
                            } else if (result.status === "error") {
                                Swal.fire({
                                    title: "Error!",
                                    text: "Something went wrong",
                                    icon: "error",
                                    timer: 2000,
                                    showConfirmButton: false,
                                });
                            }
                        }, 2000);
                    },
                });
            }
        });
    });
    $(document).on("click", ".re-apply-application", function (e) {
        e.preventDefault();
        let app_id = $(".app-id").val();
        Swal.fire({
            title: "Are you sure?",
            text: "You will not be able to update this application after re applying it!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, re-apply it!",
        }).then(function (result) {
            console.log(result);
            if (result.isConfirmed) {
                //start preloarder
                $(".someBlock").preloader();
                $.ajax({
                    url: "ajax/php/save-application.php",
                    type: "POST",
                    data: {
                        app_id,
                        application: "REAPPLY",
                    },
                    dataType: "json",
                    success: function (result) {
                        window.setTimeout(function () {
                            $(".someBlock").preloader("remove");
                            if (result.status === "success") {
                                Swal.fire({
                                    title: "Success!",
                                    text: "Your application was re-applied successfully !",
                                    icon: "success",
                                    timer: 2000,
                                    showConfirmButton: false,
                                });
                                window.setTimeout(function () {
                                    window.location.href = "index.php";
                                }, 2000);
                            } else if (result.status === "error") {
                                Swal.fire({
                                    title: "Error!",
                                    text: "Something went wrong",
                                    icon: "error",
                                    timer: 2000,
                                    showConfirmButton: false,
                                });
                            }
                        }, 2000);
                    },
                });
            }
        });
    });

    //update
    // application 01
    $(document).on("click", ".update-basic-details", function (e) {
        e.preventDefault();
        let app_id = $(this).attr("app_id");
        if ($("#fedaration").val() == "" && !$("#fedaration").val()) {
            swal({
                title: "Error!",
                text: "Please select district fedaration name",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
            return false;
        } else if (
                $("#tournament-name").val() == "" &&
                !$("#tournament-name").val()
                ) {
            swal({
                title: "Error!",
                text: "Please enter tournament name",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
            return false;
        } else if ($("#location").val() == "" && !$("#location").val()) {
            swal({
                title: "Error!",
                text: "Please enter location",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
            return false;
        } else if (
                $("#number-of-participation-countries").val() == "" &&
                !$("#number-of-participation-countries").val()
                ) {
            swal({
                title: "Error!",
                text: "Please enter number of participation countries",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
            return false;
        } else if (
                $("#tournament-duration").val() == "" &&
                !$("#tournament-duration").val()
                ) {
            swal({
                title: "Error!",
                text: "Please enter tournament duration",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
            return false;
        } else if ($("#arrival-date").val() == "" && !$("#arrival-date").val()) {
            swal({
                title: "Error!",
                text: "Please select arrival date",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
            return false;
        } else if (
                $("#departure-date").val() == "" &&
                !$("#departure-date").val()
                ) {
            swal({
                title: "Error!",
                text: "Please select departure date",
                type: "error",
                timer: 3000,
                showConfirmButton: false,
            });
            return false;
        } else {
            //start preloarder
            $(".someBlock").preloader();
            var formData = new FormData($("#application-form-01")[0]); //grab all form data
            formData.append("application", "application_01");
            formData.append("app_id", app_id);
            $.ajax({
                url: "ajax/php/update-application.php",
                type: "POST",
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (result) {
                    window.setTimeout(function () {
                        $(".someBlock").preloader("remove");
                        if (result.status === "success") {
                            // swal({
                            //   title: "success!",
                            //   text: "Your data saved successfully !",
                            //   type: "success",
                            //   timer: 2000,
                            //   showConfirmButton: false,
                            // });
                            window.location.href = "application-02.php?id=" + result.id;
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
    });
    // application 02
    $(document).on("click", ".update-member-details", function (e) {
        e.preventDefault();
        let count = $(".member_count").val();
        let i = 1;
        for (i = 1; i <= count; i++) {
            let nth1 = nth(i);
            if ($(".member_name_" + i).val() == "" && !$(".member_name_" + i).val()) {
                swal({
                    title: "Error!",
                    text: "Please enter " + i + nth1 + " member name",
                    type: "error",
                    timer: 3000,
                    showConfirmButton: false,
                });
                return false;
            } else if (
                    $(".position_" + i).val() == "" &&
                    !$(".position_" + i).val()
                    ) {
                swal({
                    title: "Error!",
                    text: "Please enter " + i + nth1 + " member position",
                    type: "error",
                    timer: 3000,
                    showConfirmButton: false,
                });
                return false;
            } else if (
                    $(".passport_no_" + i).val() == "" &&
                    !$(".passport_no_" + i).val()
                    ) {
                swal({
                    title: "Error!",
                    text: "Please enter " + i + nth1 + " member passport number",
                    type: "error",
                    timer: 3000,
                    showConfirmButton: false,
                });
                return false;
            } else if (
                    $(".file-name-" + i).val() == "" &&
                    !$(".file-name-" + i).val()
                    ) {
                swal({
                    title: "Error!",
                    text: "Please select " + i + nth1 + " member passport copy",
                    type: "error",
                    timer: 3000,
                    showConfirmButton: false,
                });
                return false;
            }
        }
        //start preloarder
        $(".someBlock").preloader();
        var formData = new FormData($("#application-form-02")[0]); //grab all form data
        formData.append("application", "application_02");
        $.ajax({
            url: "ajax/php/update-application.php",
            type: "POST",
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (result) {
                window.setTimeout(function () {
                    $(".someBlock").preloader("remove");
                    if (result.status === "success") {
                        // swal({
                        //   title: "success!",
                        //   text: "Your data saved successfully !",
                        //   type: "success",
                        //   timer: 2000,
                        //   showConfirmButton: false,
                        // });
                        window.location.href = "application-03.php?id=" + result.id;
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
    });




    //application 03
    $(document).on("click", ".update-documents", function (e) {
        e.preventDefault();
        let count = $(".doc_count").val();
        let i = 1;
        for (i = 1; i <= count; i++) {
            let nth1 = nth(i);
            if ($(".doc_" + i).val() == "" && !$(".doc_" + i).val()) {
                swal({
                    title: "Error!",
                    text: "Please select " + $(".doc_title_" + i).val() + " document",
                    type: "error",
                    timer: 3000,
                    showConfirmButton: false,
                });
                return false;
            }
        }
        //start preloarder
        $(".someBlock").preloader();
        var formData = new FormData($("#application-form-03")[0]); //grab all form data
        formData.append("application", "application_03");
        $.ajax({
            url: "ajax/php/update-application.php",
            type: "POST",
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (result) {
                window.setTimeout(function () {
                    $(".someBlock").preloader("remove");
                    if (result.status === "success") {
                        // swal({
                        //   title: "success!",
                        //   text: "Your data saved successfully !",
                        //   type: "success",
                        //   timer: 2000,
                        //   showConfirmButton: false,
                        // });
                        window.location.href = "application-04.php?id=" + result.id;
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
    });
});
const nth = function (d) {
    const dString = String(d);
    const last = +dString.slice(-2);
    if (last > 3 && last < 21)
        return "th";
    switch (last % 10) {
        case 1:
            return "st";
        case 2:
            return "nd";
        case 3:
            return "rd";
        default:
            return "th";
    }
};
