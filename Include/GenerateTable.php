<?php
    require_once('DatabaseActions.php');
    
    $ID = (basename($_SERVER['PHP_SELF']) === 'Students.php')?'StudentID':'TutorID';
    
?>
    <table id = 'ViewAllTable'>
    <thead>
        <tr>
            <th><?php echo $ID; ?></th>
            <th>First Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Phone No.</th>
            <th>Status</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>

    <?php 

    $result = SelectAll();

    while ($row=$result->fetch())
        {
            $status = ($row["Status"]==='A')?'Active':'Inactive';
            $currentID = $row[$ID];
    ?>
        <tr> 
        <td> <?php echo $currentID; ?></td>
        <td> <?php echo $row["FirstName"]; ?></td>
        <td> <?php echo $row["Surname"]; ?></td>
        <td> <?php echo $row["Email"]; ?></td>
        <td> <?php echo $row["PhoneNo"]; ?></td>
        <td><a href = "FormHandling.php?action=SetToInactive&id=<?php echo $currentID; ?>"><?php echo $status; ?></a></td>
        <td>
            <button class="edit" 
                data-mode="edit" 
                data-id="<?php echo $currentID; ?>"
                data-firstname="<?php echo htmlspecialchars($row['FirstName']); ?>"
                data-surname="<?php echo htmlspecialchars($row['Surname']); ?>"
                data-email="<?php echo htmlspecialchars($row['Email']); ?>"
                data-phone="<?php echo htmlspecialchars($row['PhoneNo']); ?>">
                Edit
            </button>
        </td>
        </tr>
        
    <?php } ?>

    </tbody>
    </table>


