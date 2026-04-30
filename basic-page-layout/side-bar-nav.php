
<?php 
  $nav = [
    [
      'section' => "Main",
      'items' => [
          [
            "item" => "Dashboard",
            "link" => "Dashboard/Dashboard.php",
            "file" => "Dashboard.php"
          ]
        ]
    ],
    [
      'section' => "Manage",
      'items' => [
        [
          "item" => "Tutors",
          "link" => "Tutors/Tutors.php",
          "file" => "Tutors.php"
        ],
        [
          "item" => "Students",
          "link" => "Students/Students.php",
          "file" => "Students.php"
        ],
        [
          "item" => "Schedule",
          "link" => "Schedule/Schedule.php",
          "file" => "Schedule.php"
        ],
        [
          "item" => "Subjects",
          "link" => "Subjects/Subjects.php",
          "file" => "Subjects.php"
        ]
      ]
    ]

  ]
?>

<aside>

  <div class="sidebar-logo">
    <h1>Grinds<span>School</span></h1>
    <p>Management</p>
  </div>

  <nav>
      <?php
        foreach($nav as $n):
      ?>
        <div class="nav-section"><?php echo $n['section']; ?></div>
            <?php 
              foreach($n['items'] as $ni): 
            ?>
                <a href = "<?php echo "../" . $ni['link']; ?>" 
                   class = "no-link-styling 
                            nav-item 
                            <?php echo (basename($_SERVER['PHP_SELF']) === $ni['file'])?" active":""; ?>">
                    <?php echo $ni['item']; ?>
                </a>
        <?php
              endforeach;
        endforeach;
        ?>
  </nav>

  <div class="sidebar-footer">
    <p>
      <strong>
        <?php echo $_SESSION['name']??"Admin Member"; ?>
      </strong>
      <?php echo $_SESSION['email']??"admin@grindsschool.com"; ?>
    </p>
  </div>
</aside>

    

