<?php if (!defined('ABSPATH')) exit; ?>

<div class="wrap wpnull-dashboard">
    <h1>WordPress Plugin & Theme Manager</h1>
    
    <div class="wpnull-stats-grid">
        <div class="stat-box">
            <h3>Available Updates</h3>
            <div class="stat-number">23</div>
            <div class="stat-footer">Last checked: <?php echo date('Y-m-d H:i'); ?></div>
        </div>
        
        <div class="stat-box">
            <h3>Premium Features</h3>
            <div class="stat-number">All Activated</div>
            <div class="stat-footer">Valid until: 2025-12-31</div>
        </div>
    </div>

    <div class="wpnull-search-box">
        <input type="text" id="plugin-search" placeholder="Search plugins or themes...">
        <button class="button button-primary">Search</button>
    </div>

    <div class="wpnull-results" style="display:none;">
        <!-- Results will be loaded here -->
    </div>
</div> 