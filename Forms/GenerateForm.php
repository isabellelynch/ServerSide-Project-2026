<?php 
    $details = getDetails();
?>
<div class="modal-overlay" id="modalOverlay">

    <div class="modal">

        <div class="modal-head">
            <div>
                <h3 id="modalTitle"><?php echo $details['form-title']; ?></h3>
                <p id="modalSub"><?php echo $details['form-subtitle']; ?></p>
            </div>

            <button id = "modal-x" type = "button">X</button>
        </div>


        <form class="modal-form" id = "common-form" method = "POST" action = "">
            <?php require_once($details['form-body']); ?>
            <div class="modal-footer">
                <button class="btn-ghost" id = "cancel-form-btn">Cancel</button>
                <button type = "submit" class="btn-primary" name = "save-btn"><?php echo $details['form-btn']; ?></button>
            </div>
        </form>
    </div>
</div>

<div class="toast" id="toast">
  <strong id="toastTitle">✅ Booking Saved</strong>
  <span id="toastMsg">The session has been added to the calendar.</span>
</div>