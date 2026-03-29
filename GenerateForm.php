<?php 
    require_once("include-for-functions/DatabaseActions.php");
    global $details;
?>
<div class="modal-overlay" id="modalOverlay">

    <div class="modal">

        <div class="modal-head">
            <div>
                <h3 id="modalTitle"><?php echo $details['form-title']; ?></h3>
                <p id="modalSub"><?php echo $details['form-subtitle']; ?></p>
            </div>

            <button class = "modal-x">X</button>
        </div>


        <form class="modal-form" id = "common-form">
            <?php require_once($details['form-body']); ?>

            <div class="modal-footer">
                <button class="btn-ghost" id = "cancel-form-btn">Cancel</button>
                <button class="btn-primary"><?php echo $details['form-btn']; ?></button>
            </div>

        </form>
    </div>
</div>


<div class="toast" id="toast">
  <strong id="toastTitle">✅ Booking Saved</strong>
  <span id="toastMsg">The session has been added to the calendar.</span>
</div>