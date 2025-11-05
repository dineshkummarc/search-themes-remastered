// Theme handling functionality
(function($) {
    'use strict';
    
    var ThemeManager = {
        init: function() {
            this.bindEvents();
            this.setupGrid();
        },
        
        bindEvents: function() {
            $('.theme-card').on('click', this.showDetails);
        }
    };
    
    $(document).ready(function() {
        ThemeManager.init();
    });
})(jQuery); 