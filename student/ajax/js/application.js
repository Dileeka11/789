$(document).ready(function () {
    // approve application
    $(document).on("click", ".approve-application", function (e) {
        e.preventDefault();
        let app_id = $(".app-id").val();
        Swal.fire({
            title: "Are you sure?",
            text: "Are you want to approve this application?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, approve it!",
        }).then(function (result) {
            console.log(result);
            if (result.isConfirmed) {
                $.ajax({
                    url: "ajax/php/applications.php",
                    type: "POST",
                    data: {
                        app_id,
                        action: "APPROVE",
                    },
                    dataType: "json",
                    success: function (result) {
                        if (result.status === "success") {
                            Swal.fire({
                                title: "Success!",
                                text: "Application has been approved successfully !",
                                icon: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                            window.setTimeout(function () {
                                window.location.href = "all-applications.php";
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
                    },
                });
            }
        });
    });
    // reject application
    $(document).on("click", ".reject-application", function (e) {
        e.preventDefault();
        let app_id = $(".app-id").val();
        Swal.fire({
            title: "Are you sure?",
            text: "Are you want to reject this application?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, reject it!",
        }).then(function (result) {
            console.log(result);
            if (result.isConfirmed) {
                $.ajax({
                    url: "ajax/php/applications.php",
                    type: "POST",
                    data: {
                        app_id,
                        action: "REJECT",
                    },
                    dataType: "json",
                    success: function (result) {
                        if (result.status === "success") {
                            Swal.fire({
                                title: "Success!",
                                text: "Application has been rejected !",
                                icon: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                            window.setTimeout(function () {
                                window.location.href = "all-applications.php";
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
                    },
                });
            }
        });
    });
    // reject member passport copy
    $(document).on("click", ".reject-member-passport", function (e) {
        e.preventDefault();
        let app_id = $(".app-id").val();
        let member_id = $(this).attr('member_id');
        Swal.fire({
            title: "Are you sure?",
            text: "Are you want to reject this passport copy?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, reject it!",
        }).then(function (result) {
            console.log(result);
            if (result.isConfirmed) {
                $.ajax({
                    url: "ajax/php/applications.php",
                    type: "POST",
                    data: {
                        app_id,
                        member_id,
                        action: "REJECTMEMBERPASSPORTCOPY",
                    },
                    dataType: "json",
                    success: function (result) {
                        if (result.status === "success") {
                            Swal.fire({
                                title: "Success!",
                                text: "Member passport copy has been rejected !",
                                icon: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                            window.setTimeout(function () {
                                location.reload();
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
                    },
                });
            }
        });
    });
    // reject document
    $(document).on("click", ".reject-document", function (e) {
        e.preventDefault();
        let app_id = $(".app-id").val();
        let doc_id = $(this).attr('doc_id');
        Swal.fire({
            title: "Are you sure?",
            text: "Are you want to reject this document?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, reject it!",
        }).then(function (result) {
            console.log(result);
            if (result.isConfirmed) {
                $.ajax({
                    url: "ajax/php/applications.php",
                    type: "POST",
                    data: {
                        app_id,
                        doc_id,
                        action: "REJECTDOCUMENT",
                    },
                    dataType: "json",
                    success: function (result) {
                        if (result.status === "success") {
                            Swal.fire({
                                title: "Success!",
                                text: "Document has been rejected !",
                                icon: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            });
                            window.setTimeout(function () {
                                location.reload();
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
                    },
                });
            }
        });
    });





    $('input[type="checkbox"]').click(function () {
        if ($(this).is(':checked')) {
            let app_id = $(".app-id").val();
            let id = $(this).attr('data-id');


            //start preloarder
            $(".someBlock").preloader();

            $.ajax({
                url: "ajax/php/check-condition.php",

                type: "POST",
                data: {
                    app_id,
                    id

                },
                dataType: "JSON",

                success: function (result) {
                    window.setTimeout(function () {
                        $(".someBlock").preloader("remove");
                        if (result.status === "success") {
                            Swal.fire({
                                title: "Success!",
                                text: "Your data saved successfully !",
                                icon: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            });

                            window.setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        } else if (result.status === "error") {
                            Swal.fire({
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
        } else {
            let app_id = $(".app-id").val();
            let id = $(this).attr('id_con');


            //start preloarder
            $(".someBlock").preloader();

            $.ajax({
                url: "ajax/php/check-condition-update.php",

                type: "POST",
                data: {
                    app_id,
                    id

                },
                dataType: "JSON",

                success: function (result) {
                    window.setTimeout(function () {
                        $(".someBlock").preloader("remove");
                        if (result.status === "success") {
                            Swal.fire({
                                title: "Success!",
                                text: "Your data saved successfully !",
                                icon: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            });

                            window.setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        } else if (result.status === "error") {
                            Swal.fire({
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



});

