<?php 
    global $form;
?>
<div class="modal-overlay" id="modalOverlay">
    <div class="modal">
        <div class="modal-head">
            <div>
                <h3 id="modalTitle"></h3>
                <p id="modalSub"></p>
            </div>
            <button id = "modal-x" type = "button">X</button>
        </div>
        <form class="modal-form" id = "common-form" method = "POST" action = "">
            <?php 
                foreach($form as $f){
                    require_once($f);
                }
             ?>
            <div class="modal-footer">
                <button class="btn-ghost" id = "cancel-form-btn">Cancel</button>
                <button type = "submit" class="btn-primary" 
                        name = "save-btn" id = "save-btn"></button>
            </div>
        <input type = "hidden" name = "activeForm" id = "activeForm" value = "">
        </form>
    </div>
</div>

<div class="toast" id="toast">
    <strong id="toastTitle">
        <?php 
            global $msgtitle;
            if($msgtitle !== ""){ 
                echo $msgtitle;
            }
        ?>
    </strong>
    <span id="toastBody" class = "toast-msg">
        <?php 
            global $msg;
            if($msg !== ""){ 
                echo $msg;
            }
        ?>
    </span>
</div>