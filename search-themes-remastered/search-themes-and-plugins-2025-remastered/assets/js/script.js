// Front-end functionality
jQuery(document).ready(function($) {
    // Initialize tooltips
    $('.wpnull-tooltip').tooltip();
    
    // Handle download buttons
    $('.wpnull-download').on('click', function(e) {
        e.preventDefault();
        // Download logic would go here
    });
}); 