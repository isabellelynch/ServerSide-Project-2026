<?php
    require_once("../include-for-functions/DatabaseActions.php");

    global $details;
    $table = $details['table'];

    //link in Students table to go from active to inactive
    if (isset($_GET['action']) && $_GET['action'] === 'SetToInactive') 
    {
        $id = $_GET['id'];
        try 
        {
            UpdateStatus($table,$id);
            header("Location:$table.php" );
            exit();
        }
        catch (PDOException $e) 
        { 
            $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
        }
    }

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
                <th>Rate (€)</th>
            <?php endif; ?>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

    <?php 

    $result = SelectAll($table);

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
            <?php if($table === "Tutors"): ?>
                <td>€<?php echo GetTutorRate($row["RateCode"]); ?></td>
            <?php endif; ?>
            <td>
                <a href = "?action=SetToInactive&id=<?php echo $currentID; ?>">
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
