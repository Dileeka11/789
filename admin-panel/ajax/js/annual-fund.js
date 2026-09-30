jQuery(document).ready(function () {

    // Function to handle both create and update for annual_fund
    function handleAnnualFundAction(actionType) {
        // Start error messages
        if (!$('#year').val() || $('#year').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the year.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });

        } else if (!$('#type').val() || $('#type').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the fund type.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });

        } else if (!$('#amount').val() || $('#amount').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the amount.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });

        } else if (!$('#datetime').val() || $('#datetime').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter the date and time.",
                type: 'error',
                timer: 3000,
                showConfirmButton: false
            });

        } else {
            // Start preloader
            $('.someBlock').preloader();
            
            // Grab all form data
            var formData = new FormData($('#form-data')[0]);

            // Set URL and action type based on whether it's create or update
            var url = "ajax/php/annual-fund.php";  // Change to your actual server-side URL
            formData.append('action', actionType);

            // If it's an update, include the ID in the form data
            if (actionType === 'update') {
                formData.append('id', $('#id').val());  // Assuming you have an ID field for the update
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (result) {
                    // Remove preloader
                    $('.someBlock').preloader('remove');

                    if (result.status === 'success') {
                        swal({
                            title: "Success!",
                            text: "Your data has been saved successfully!",
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
                            text: "Something went wrong.",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }
            });
        }
        return false;
    }

    // Handle create action
    $("#create").click(function (event) {
        event.preventDefault();
        handleAnnualFundAction('create');  // Call the function with 'create' action
    });

    // Handle update action
    $("#update").click(function (event) {
        event.preventDefault();
        handleAnnualFundAction('update');  // Call the function with 'update' action
    });


document.getElementById('amount').addEventListener('input', function () {
    let amount = parseFloat(this.value.replace(/,/g, '')); // Remove commas
    if (!isNaN(amount)) {
        this.value = amount.toLocaleString(); // Format and add commas
    }
});


});
