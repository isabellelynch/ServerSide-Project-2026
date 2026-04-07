<div class = "panel">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
            <div class="table-toolbar">
                    <input class="search-input" 
                        type="text" 
                        placeholder="Search Subjects…" 
                        id = "table-filter">
        </div>


        <table id = 'ViewAllTable' class="data-table">
            <thead>
                <tr>
                    <th>Subject Code</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

    <?php 
    require_once("../database-interactions/general.php");
    $table = getCurrentPage();
    $result = SelectAll($table);

    foreach($result as $row):
    ?>
        <tr> 
            <td><?php echo $row["SubjectCode"]; ?></td>
            <td><?php echo $row["Description"]; ?></td>
            <td>
                <div class = "action-btns">
                    <button class="delete-btn" 
                            type = "button" 
                            data-code = <?php echo $row["SubjectCode"]; ?>
                            data-surname = <?php echo $row["Description"]; ?>
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