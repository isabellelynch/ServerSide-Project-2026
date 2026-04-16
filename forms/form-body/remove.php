<?php
    $remove = $_SESSION['other-form']??false;
?>
<div id = "remove" class = "<?php echo ($remove === true)?'showthisform':'dontshow'; ?>">
    <p id = "remove-msg"></p>
    <input type="hidden" name = "remove-id" value = "">
</div> 