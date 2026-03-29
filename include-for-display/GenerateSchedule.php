<?php
include_once("include-for-functions/DayMapper.php");
require_once("ScheduleHandling.php");
global $days, $times, $schedule;

?>
<div id = 'schedule-table-container'>
<table id = "ScheduleTable">
    <thead>
        <tr>
            <th colspan = "6">
                Room <?php echo $_SESSION['room']; ?>
                <form id = 'change-room' action = "" method = "POST">
                    <button name = 'previous-room'><</button>
                    <button name = 'next-room'>></button>
                </form>
            </th>
        </tr>
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
            <td class = "time"><?php echo str_pad($time, 2, '0', STR_PAD_LEFT) . ":00"; ?></td>
            
            <?php foreach ($days as $day): 
                $d = GetDayNum($day);
                $class = $schedule[$d][$time]??null; 
                if ($class) : ?> 
                    <td class = 'class-slot' >
                    <strong><?php echo htmlspecialchars($class['class']); ?></strong>
                    <br>
                    <p><?php echo htmlspecialchars($class['tutor']); ?></p>
                    <p style = "text-align:right"><?php echo htmlspecialchars($class['enrollment']) . "/" . htmlspecialchars($class['capacity']); ?></p>
                    <br>
                    </td>
                <?php else: ?>
                    <td></td>
                <?php endif; ?>
            
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
</div>
