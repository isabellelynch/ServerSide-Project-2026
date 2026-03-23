<?php 
    $page = basename($_SERVER['PHP_SELF']);
    $pages = [
        ['name' =>'Dashboard', 'children' => []],

        ['name' =>'Tutors', 'children' => [
            ['file' => 'AddTutor.php', 'label' => 'Add Tutor'],
            ['file' => 'ViewTutors.php', 'label' => 'View Tutors']
        ]],

        ['name' =>'Students', 'children' => [
            ['file' => 'Students.php', 'label' => 'Students Home'],
            ['file' => 'AddStudent.php', 'label' => 'Add Student'],
            ['file' => 'ViewStudents.php', 'label' => 'View Students']
        ]],

        ['name' =>'Classes', 'children' => [
            ['file' => 'Classes.php', 'label' => 'Classes Home']
        ]],
        ['name' =>'Schedule', 'children' => []]
    ];

?>
<aside>
        <div>
            <div id = "logo">
                <img src = "books.png">
                <div>
                    <h2>GrindsHub</h2>
                    <p>Admin Portal</p>
                </div>
            </div>

    <nav>
        <?php foreach ($pages as $p): ?>

                <div class = "nav-item">
                
                <a href = "" class = "toggle"><?php echo $p['name']; ?></a>

                <?php
                if (!empty($p['children'])):
                    ?>
                    <div class="dropdown">
                    
                    <?php foreach ($p['children'] as $child): ?>
                        <a href="<?php echo $child['file']; ?>" class="">
                            <?php echo $child['label']; ?>
                        </a>
                    <?php endforeach; ?>

                    </div>
                <?php endif; ?>

                </div>
            <?php endforeach; ?>
    </nav>
        </div>
        <div id = "sidebar-footer">
            Leaving Cert Grinds
        </div>
    </aside>
    

