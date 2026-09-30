$(document).ready(function () {
    
     function updateLiveCount() {
        $.ajax({
            url: 'ajax/php/get-live-count.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.live_count !== undefined) {
                    $('#student_live_count').text(response.live_count);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching live count:", error);
            }
        });
    }

    // Update live count every 5 seconds
    setInterval(updateLiveCount, 5000);

    // Initial load
    $(document).ready(function() {
        updateLiveCount();
    });
    
});