<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="wrap">
    <h1>Plugin Settings</h1>
    <form method="post" action="options.php">
        <?php settings_fields('wpnull-settings'); ?>
        <table class="form-table">
            <!-- Settings fields will go here -->
        </table>
    </form>
</div> 