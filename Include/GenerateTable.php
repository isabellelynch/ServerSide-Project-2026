<?php
    require_once('DatabaseActions.php');
    
    $ID = (basename($_SERVER['PHP_SELF']) === 'Students.php')?'StudentID':'TutorID';
    
?>
    <table id = 'table'>
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
        <td><button type = 'submit' class = 'edit' data-id = "<?php echo $currentID; ?>">Edit</button></td>
        </tr>
        
    <?php } ?>

    </tbody>
    </table>

<?php
    require_once('DatabaseActions.php');
    
    $ID = (basename($_SERVER['PHP_SELF']) === 'Students.php')?'StudentID':'TutorID';
    
?>
    <table id = 'table'>
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
        <td><button type = 'submit' class = 'edit' data-id = "<?php echo $currentID; ?>">Edit</button></td>
        </tr>
        
    <?php } ?>

    </tbody>
    </table>
