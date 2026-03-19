<?php 
    $page = basename($_SERVER['PHP_SELF']);
    $pages = ['Dashboard.php', 'Tutors.php', 'Students.php', 'Classes.php','Schedule.php'];
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
            foreach($pages as $p)
            {
                echo '<a';
                if ($page == $p){ echo ' class = "active"';}
                echo ' href="' . $p . '">'. str_replace(".php", "", $p) . '</a>';
            }
        ?>
    </nav>
        </div>
        <div id = "sidebar-footer">
            Leaving Cert Grinds
        </div>
    </aside>
    

