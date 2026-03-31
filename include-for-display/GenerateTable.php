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
            <th>Email</th>
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
            <td hidden><?php echo $row[$currentID]; ?></td>
            <td class="avatar-chip"> 
                <div class="avatar-sm"><?php echo substr($row["FirstName"],0,1); ?></div>
                <?php echo $row["FirstName"] . " " . $row["Surname"]; ?>
            </td>
            <td><?php echo $row["Email"]; ?></td>
            <td><?php echo $row["PhoneNo"]; ?></td>
            
            <td>
                <a href = "FormHandling.php?action=SetToInactive&id=<?php echo $currentID; ?>">
                    <?php echo $status; ?>
                </a>
            </td>
            <td>
                <div class = "action-btns">
                    <button class="edit-btn" 
                            type = "button"
                            data-id = <?php echo $currentID; ?>
                            data-firstname = <?php echo $row["FirstName"]; ?>
                            data-surname = <?php echo $row["Surname"]; ?>
                            data-email = <?php echo $row["Email"]; ?>
                            data-phone = <?php echo $row["PhoneNo"]; ?>>
                        <i class="fa-solid fa-pen"></i>
                    </button>
                    <button class="delete-btn" 
                            type = "button" 
                            data-id = <?php echo $currentID; ?>
                            data-firstname = <?php echo $row["FirstName"]; ?>
                            data-surname = <?php echo $row["Surname"]; ?>
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
