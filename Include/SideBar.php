<?php 
    $page = basename($_SERVER['PHP_SELF']);
    $pages = [
        ['file' => 'Dashboard.php', 'label' => 'Dashboard', 'children' => []],

        ['file' => 'Tutors.php', 'label' => 'Tutors', 'children' => [
            ['file' => 'AddTutor.php', 'label' => 'Add Tutor'],
            ['file' => 'ViewTutors.php', 'label' => 'View Tutors']
        ]],

        ['file' => 'Students.php', 'label' => 'Students', 'children' => [
            ['file' => 'AddStudent.php', 'label' => 'Add Student'],
            ['file' => 'ViewStudents.php', 'label' => 'View Students']
        ]],

        ['file' => 'Classes.php', 'label' => 'Classes', 'children' => []],
        ['file' => 'Schedule.php', 'label' => 'Schedule', 'children' => []]
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
        <?php 
            foreach ($pages as $p):
                $isActive = ($page == $p['file']);

                foreach ($p['children'] as $child) {
                    if ($page == $child['file']) {
                        $isActive = true;
                    }
                }
        ?>

                <div class = "nav-item">
                
                <a href="<?php echo $p['file'] ?>" 
                class="<?php echo ($isActive ? 'active' : '') ?> toggle">
                <?php echo $p['label'] ?></a>

                <?php
                if (!empty($p['children'])):
                    ?>
                    <div class="dropdown">
                    
                    <?php foreach ($p['children'] as $child): ?>
                        <a href="<?php echo $child['file']; ?>" 
                        class="<?php echo ($page == $child['file']) ? 'active' : ''; ?>">
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
    

