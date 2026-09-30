jQuery(document).ready(function () {

    // Function to handle both create and update for annual_fund
    function handlePaymentFundAction(actionType) {
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
        } else if (!$('#description').val().trim()) {
                 swal({
                 title: "Error!",
                 text: "Please enter the description.",
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
            var url = "ajax/php/payment-fund.php";  // Change to your actual server-side URL
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
        handlePaymentFundAction('create');  // Call the function with 'create' action
    });

    // Handle update action
    $("#update").click(function (event) {
        event.preventDefault();
        handlePaymentFundAction('update');  // Call the function with 'update' action
    });

     var responseAmount = 0; // Global variable to store available funds

$('#league_type, #type').change(function () {
    var leagueTypeId = $('#league_type').val();
    var fundType = $('#type').val(); 

    if (leagueTypeId && fundType) {
        fetchAvailableFunds(leagueTypeId, fundType);
    } else {
        resetFields();
    }
});

function fetchAvailableFunds(leagueTypeId, fundType) {
    $.ajax({
        url: 'ajax/php/payment-fund.php',
        type: 'POST',
        data: { action: "get_amount", league_type_id: leagueTypeId, fund_type: fundType },
        dataType: 'JSON',
        success: function (response) { 
            handleAvailableFundsResponse(response);
        },
        error: function () {
            resetFields('Error fetching data');
        }
    });
}

function handleAvailableFundsResponse(response) {
    if (response.status === 'success') {
        responseAmount = parseFloat(response.amount);
        $('#available_fund').val(responseAmount).prop('readonly', true);
        $('#amount').prop('readonly', false).val('');
        $('#amount-message').text('');
        $('#create').prop('disabled', false);
    } else {
        resetFields('No funds available');
    }
}

$('#amount').keyup(function () {
    var enteredAmount = parseFloat($(this).val()) || 0;
    validateEnteredAmount(enteredAmount);
});

function validateEnteredAmount(enteredAmount) {
    if (responseAmount !== 0 && enteredAmount > responseAmount) {
        showErrorMessage();
    } else {
        clearErrorMessage();
    }
}

function showErrorMessage() {
    $('#amount-message').text('Entered amount cannot be greater than available funds').css('color', 'red');
    $('#amount').css('border-color', 'red');
    $('#create').prop('disabled', true);
}

function clearErrorMessage() {
    $('#amount-message').text('');
    $('#amount').css('border-color', '');
    $('#create').prop('disabled', false);
}

function resetFields(message = '') {
    responseAmount = 0;
    $('#available_fund').val('').prop('readonly', true);
    $('#amount').val('').prop('readonly', true);
    $('#amount-message').text(message).css('color', 'red');
    $('#create').prop('disabled', true);
}

    
    
});
