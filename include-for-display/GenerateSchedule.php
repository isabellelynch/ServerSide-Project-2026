<?php

include_once("include-for-functions/DatabaseActions.php");
include_once("include-for-functions/DayMapper.php");

$schedule = [];

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rooms'])){
    $room = $_POST['rooms'];

    $result = SelectAllClasses($room);

    while ($row = $result->fetch()) {
        $day = $row['Day'];
        $time = $row['Time'];

        $schedule[$day][$time] = [
            'class' => $row['Description'],
            'tutor' => $row['FirstName'] . " " . $row['Surname']
        ];
    }

}
$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
$times = [
    '09:00','10:00','11:00','12:00',
    '13:00','14:00','15:00','16:00', '17:00'
];
?>
<div id = 'schedule-table-container'>
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
                
                    
                        <?php 
                            $dayNum = GetDayNum($day);
                            $timeNum = substr($time, 0, strpos($time, ':'));
                            $class = $schedule[$dayNum][$timeNum]??null; 
                    
                        if ($class) :
                        ?> 
                            <td class = 'class-slot' >
                            <strong><?php echo htmlspecialchars($class['class']); ?></strong>
                            <br>
                            <?php echo htmlspecialchars($class['tutor']); ?>
                            <br>
                        <?php
                        else:
                        ?>
                            <td>
                        <?php
                            endif;
                        ?>

                </td>
            <?php endforeach; ?>

        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
                        </div>
