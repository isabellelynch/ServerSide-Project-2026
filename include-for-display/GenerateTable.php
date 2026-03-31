<?php
    require_once("include-for-functions/DatabaseActions.php");
    
    $_SESSION['current_page'] = basename($_SERVER['PHP_SELF']);
    $table = str_replace(".php", "", $_SESSION['current_page']);
?>
<div class = "panel">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<div class="table-toolbar">
        <input class="search-input" 
               type="text" 
               placeholder="Search students…" 
               id = "table-filter">
</div>


    <table id = 'ViewAllTable' class="data-table">
    <thead>
        <tr>
            <th><?php echo $table; ?></th>
            <th>Phone No.</th>
            <th>Status</th>
            <th style = "text-align:right">Actions</th>
        </tr>
    </thead>
    <tbody>

    <?php 

    $result = SelectAll(str_replace(".php", "", $_SESSION['current_page']));

    foreach($result as $row):
            $status = ($row["Status"]==='A')?'Active':'Inactive';
            $currentID = $row[str_replace("s", "ID", $table)];
    ?>
        <tr> 
            <td hidden><?php echo $currentID; ?></td>
            <td> 
                <div class="avatar-chip">
                    <div class="avatar-sm"><?php echo substr($row["FirstName"],0,1); ?></div>
                    <div>
                        <div style="font-weight:700"><?php echo $row["FirstName"]; ?></div>
                        <div style="font-size:0.74rem;color:var(--br-tan)"><?php echo $row["Email"]; ?></div>
                    </div>
                </div>
                
            </td>
            <td> <?php echo $row["PhoneNo"]; ?></td>
            <td>
                <a href = "FormHandling.php?action=SetToInactive&id=<?php echo $currentID; ?>">
                    <?php echo $status; ?>
                </a>
            </td>
            <td>
                <div class="action-btns">
                    <button class="btn-icon">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                    <button class="btn-icon del">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
        
    <?php endforeach; ?>

    </tbody>
    </table>

</div>
