<?php 
    $form = match(getCurrentPage()){
        "index" => [ROOT . "/forms/form-body/booking-for-student.php",ROOT . "/forms/form-body/new-class.php"],
        "Students" => [ROOT . "/forms/form-body/update-student.html",ROOT . "/forms/form-body/remove-student.html"],
        "Tutors" => [ROOT . "/forms/form-body/update-student.html",ROOT . "/forms/form-body/remove-student.html"]
    }
    
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
        </form>
    </div>
</div>

<div class="toast" id="toast">
  <strong id="toastTitle"></strong>
  <span id="error" class = "toast-msg"><?php if(isset($_SESSION['error'])){ echo $_SESSION['error']; } ?></span>
  <span id="sucess" class = "toast-msg"><?php if(isset($success)){ echo $sucess; } ?></span>
</div>