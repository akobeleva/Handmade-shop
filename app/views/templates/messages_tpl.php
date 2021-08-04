<?php
if (isset($msg_error)): ?>
    <div style="color: red; "> <?php echo array_shift($msg_error)?></div>
<?php endif;?>
<?php
if (isset($msg_success)): ?>
    <div> <?php echo array_shift($msg_success)?></div>
<?php endif;?>

