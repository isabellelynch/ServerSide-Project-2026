<?php

include_once("DatabaseActions.php");
// Fetch all classes
$result = SelectAll();

// Build a structured array: $schedule[day][time] = class info
$schedule = [];

while ($row = $result->fetch()) {
    $day = $row['Day'];
    $time = $row['Time'];

    $schedule[$day][$time] = [
        'class' => $row['ClassID'],
        'tutor' => $row['TutorID'],
        'room'  => $row['RoomNo']
    ];
}


$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
$times = [
    '9:00','10:00','11:00','12:00',
    '13:00','14:00','15:00','16:00', '17:00'
];
?>

<table id = "ScheduleTable">
    <thead>
        <tr>
            <th>Time</th>
            <?php foreach ($days as $day): ?>
                <th><?php echo $day; ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>

    <?php foreach ($times as $time): ?>
        <tr>
            <td class = "time"><?php echo $time; ?></td>

            <?php foreach ($days as $day): ?>
                <td>
                    
                        <?php 
                            $dayNum = GetDayNum($day);
                            $timeNum = substr($time, 0, strpos($time, ':'));
                            $class = $schedule[$dayNum][$timeNum]??null; 
                    
                        if ($class) {
                            echo "<strong>" . htmlspecialchars($class['class']) . "</strong><br>";
                            echo htmlspecialchars($class['tutor']) . "<br>";
                            echo "Room: " . htmlspecialchars($class['room']);
                        } 
                        else {
                            echo "-";
                        }?>

                </td>
            <?php endforeach; ?>

        </tr>
    <?php endforeach; ?>

    </tbody>
</table>

<?php 

function GetDay($day){
    return match ($day) {
                    1 => 'Monday',
                    2 => 'Tuesday',
                    3 => 'Wednesday',
                    4 => 'Thursday',
                    5 => 'Friday',
                    default => 'Invalid'
                };
}

function GetDayNum($day){
    return match ($day) {
                    'Monday' => 1,
                    'Tuesday' => 2,
                    'Wednesday' => 3,
                    'Thursday' => 4, 
                    'Friday' => 5
                };
}