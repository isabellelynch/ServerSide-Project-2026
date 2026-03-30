<?php
    include_once("include-for-functions/DatabaseActions.php");
    $rev = GetYearlyRevenueDifference();
        if($rev === 0){
            $result = "No change on last year.";
        }
        else{
            $result = ((GetYearlyRevenueDifference() > 0)?"Up ":"Down " ). "$rev on last year.";
        }
      

    $stats = [
        [
            'heading' => "This Years Revenue",
            'value' => $rev,
            'sub' => $result
        ],
        [
            'heading' => "Bookings This Year",
            'value' => GetThisYearsBookings(),
            'sub' => "Bookings made so far in " . date("Y")
        ],
        [
            'heading' => "Active Tutors",
            'value' => GetActive("Tutors"),
            'sub' => "All available for bookings"
        ],
        [
            'heading' => "Active Students",
            'value' => GetActive("Students"),
            'sub' => "All actively participating in classes"
        ]
    ]
?>
<div class="stats-row">
    <?php
        foreach($stats as $s):
    ?>
    <div class="stat-card">
        <div class="stat-label"><?php echo $s['heading']; ?></div>
        <div class="stat-value"><?php echo $s['value']; ?></div>
        <div class="stat-sub"><?php echo $s['sub']; ?></div>
    </div>
    <?php endforeach; ?>
</div>