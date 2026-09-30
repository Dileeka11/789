$(document).ready(function () {
    
    function handleAnnualFundAction(actionType) {
        if (!$('#year').val()) {
            showSwalError("Please enter the year.");
        } else if (!$('#fund_type').val()) {
            showSwalError("Please enter the fund type.");
        } else if (!$('#league_type').val()) {
            showSwalError("Please enter the league type.");
        } else if (!$('#amount').val()) {
            showSwalError("Please enter the amount.");
        } else if (!$('#datetime').val()) {
            showSwalError("Please enter the date and time.");
        } else {
            $('.someBlock').preloader();
            var formData = new FormData($('#form-data')[0]);
            var url = "ajax/php/league-fund-amount.php";
            formData.append('action', actionType);

            if (actionType === 'update') {
                formData.append('id', $('#id').val());
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (result) {
                    $('.someBlock').preloader('remove');
                    if (result.status === 'success') {
                        swal({
                            title: "Success!",
                            text: "Your data has been saved successfully!",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        setTimeout(function () {
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

    function showSwalError(message) {
        swal({
            title: "Error!",
            text: message,
            type: 'error',
            timer: 3000,
            showConfirmButton: false
        });
    }

    $("#create").click(function (event) {
        event.preventDefault();
        handleAnnualFundAction('create');   
    });

    $("#update").click(function (event) {
        event.preventDefault();
        handleAnnualFundAction('update');   
    });

    var responseAmount = null;

    $('#fund_type').change(function () {
        var fundTypeId = $(this).val();
        fetchAvailableFunds(fundTypeId);
    });

    function fetchAvailableFunds(fundTypeId) {
        if (fundTypeId) {
            $.ajax({
                url: 'ajax/php/get-fund-type.php',
                type: 'POST',
                data: { action: "get_amount", fund_type_id: fundTypeId },
                dataType: 'JSON',
                success: function (response) {
                    handleAvailableFundsResponse(response);
                }
            });
        } else {
            resetFields();
        }
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

    function resetFields(message = '') {
        responseAmount = null;
        $('#available_fund').val('0').prop('readonly', true);
        $('#amount').val('').prop('readonly', true);
        $('#amount-message').text(message).css('color', 'red');
        $('#create').prop('disabled', true);
    }

    $('#amount').keyup(function () {
        var enteredAmount = parseFloat($(this).val()) || 0;
        validateEnteredAmount(enteredAmount);
    });

    function validateEnteredAmount(enteredAmount) {
        if (responseAmount !== null && enteredAmount > responseAmount) {
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

});
