jQuery(document).ready(function($) {
    // Search functionality
    $('#plugin-search-input').on('keyup', function(e) {
        if (e.keyCode === 13) {
            performSearch();
        }
    });

    $('#search-button').on('click', performSearch);

    function performSearch() {
        var query = $('#plugin-search-input').val();
        
        if (!query) {
            showError('Please enter a search term');
            return;
        }

        showLoader();

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'search_wordpress_plugin',
                query: query,
                nonce: wpnull_vars.nonce
            },
            success: function(response) {
                hideLoader();
                if (response.success) {
                    displayResults(response.data);
                } else {
                    showError(response.data);
                }
            },
            error: function() {
                hideLoader();
                showError('An error occurred while searching');
            }
        });
    }

    function showLoader() {
        $('#search-results').html('<div class="loader"></div>');
    }

    function hideLoader() {
        $('.loader').remove();
    }

    function showError(message) {
        $('#search-results').html('<div class="error">' + message + '</div>');
    }

    function displayResults(results) {
        // Results display logic
    }
}); 