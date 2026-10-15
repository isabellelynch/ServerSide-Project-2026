<?php
    require_once(ROOT . "/database-interactions/tutors.php");
    require_once(ROOT . "/database-interactions/subjects.php");
    require_once(ROOT . "/database-interactions/general.php");

    $table = getCurrentPage();
?>

<div class = "content-header">
    <h2><?php echo $table; ?></h2>
    <p><?php echo ($table === "Students")?"All enrolled students":"All employed tutors"; ?></p>
</div>
<div class = "panel">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<div class="table-toolbar">
        <input class="search-input" 
               type="text" 
               placeholder="Search <?php echo $table; ?>…" 
               id = "table-filter">
</div>


    <table id = 'ViewAllTable' class="data-table">
    <thead>
        <tr>
            <th><?php echo $table; ?></th>
            <th>Email</th>
            <th>Phone No.</th>
            <?php if($table === "Tutors"): ?>
                <th>Subject</th>
                <th>Rate (€)</th>
            <?php endif; ?>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

    <?php 

    $result = SelectAll($table) ?? [];

    foreach($result as $row):
            $status = ($row["Status"]==='A')?'Active':'Inactive';
            $currentID = $row[substr($table, 0, -1) . "ID"];
            $e = fn($v) => htmlspecialchars((string)$v);
            if($table === "Tutors"){
                $subject = getTutorSubjectDetails($currentID);
            }
    ?>
        <tr> 
            <td hidden data-id = "<?php echo $currentID; ?>"></td>
            <td class="avatar-chip"> 
                <div class="avatar-sm"><?php echo $e(mb_substr($row["FirstName"],0,1)); ?></div>
                <?php echo $e($row["FirstName"] . " " . $row["Surname"]); ?>
            </td>
            <td><?php echo $e($row["Email"]); ?></td>
            <td><?php echo $e($row["PhoneNo"]); ?></td>
            <?php if($table === "Tutors"): ?>
                <td><?php echo $e($subject['Description'] ?? '—'); ?></td>
                <td>€<?php echo GetTutorRate($row["RateCode"]); ?></td>
            <?php endif; ?>
            <td>
                <a href = "?action=SetToInactive&id=<?php echo $currentID; ?>"
                   class = "status-link status-<?php echo strtolower($status); ?>"
                   title = "Click to set to <?php echo ($status === 'Active') ? 'Inactive' : 'Active'; ?>">
                    <?php echo $status; ?>
                </a>
            </td>
            <td>
                <div class = "action-btns">
                    <button class="edit-btn" 
                            type = "button"
                            aria-label = "Edit <?php echo $e($row["FirstName"] . " " . $row["Surname"]); ?>"
                            data-id = "<?php echo $currentID; ?>"
                            data-firstname = "<?php echo $e($row["FirstName"]); ?>"
                            data-surname = "<?php echo $e($row["Surname"]); ?>"
                            data-email = "<?php echo $e($row["Email"]); ?>"
                            data-phone = "<?php echo $e($row["PhoneNo"]); ?>"
                            <?php if($table === "Tutors"): ?>
                                data-rate = "<?php echo $e($row["RateCode"]); ?>"
                                data-subject = "<?php echo $e($row["SubjectCode"]); ?>"
                            <?php endif; ?>
                            >
                        <i class="fa-solid fa-pen"></i>
                    </button>
                    <button class="delete-btn" 
                            type = "button" 
                            aria-label = "Remove <?php echo $e($row["FirstName"] . " " . $row["Surname"]); ?>"
                            data-id = "<?php echo $currentID; ?>"
                            data-name = "<?php echo $e($row["FirstName"] . " " . $row["Surname"]); ?>"
                            >
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
        
    <?php endforeach; ?>

    </tbody>
    </table>

</div>
