<?php 
    global $page, $formHandlers;
    foreach($formHandlers as $fh){
        require_once($fh);
    }
?>
<div class="modal-overlay" id="modalOverlay" >
    <div class="modal">
        <div class="modal-head">
            <div>
                <h3 id="modalTitle"></h3>
                <p id="modalSub"></p>
            </div>
            <button id = "modal-x" type = "button">X</button>
        </div>
        <form class="modal-form " id = "common-form" method = "POST" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <?php 
                global $form;
                foreach($form as $f){
                    require_once($f);
                }
             ?>
        <div class="modal-footer">
            <button class="btn-ghost" id = "cancel-form-btn">Cancel</button>
            <button type = "submit" class="btn-primary" 
                    name = "save-btn" id = "save-btn"></button>
        </div>
        <input type = "hidden" name = "activeForm" id = "activeForm" value = "<?php echo $_POST['activeForm']??''; ?>">
    </form>
    </div>
</div>
<?php if(isset($_SESSION['msg']) && isset($_SESSION['msgtitle'])):?>
<div  id="toast" class="toast show">
    <strong id="toastTitle"><?php echo $_SESSION['msgtitle']; ?></strong>
    <span id="toastBody" class = "toast-msg"><?php echo $_SESSION['msg']; ?></span>
</div>
<?php 
    endif; 
    unset($_SESSION['msg'], $_SESSION['msgtitle']);
?>