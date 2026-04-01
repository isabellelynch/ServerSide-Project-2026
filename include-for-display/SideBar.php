
<?php 
  $nav = [
    [
      'section' => "Main",
      'items' => [
          [
            "item" => "Dashboard",
            "link" => "index.php"
          ]
        ]
    ],
    [
      'section' => "Manage",
      'items' => [
        [
          "item" => "Tutors",
          "link" => "Tutors.php"
        ],
        [
          "item" => "Students",
          "link" => "Students.php"
        ],
        [
          "item" => "Subjects & Schedules",
          "link" => "Schedules.php"
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
                <a href = "<?php echo $ni['link']; ?>" 
                   class = "no-link-styling 
                            nav-item 
                            <?php echo (basename($_SERVER['PHP_SELF']) === $ni['link'])?" active":""; ?>">
                    <?php echo $ni['item']; ?>
                </a>
        <?php
              endforeach;
        endforeach;
        ?>
  </nav>

  <div class="sidebar-footer">
    <p>
      <strong>Admin User</strong>admin@grindschool.ie
    </p>
  </div>
</aside>

    

