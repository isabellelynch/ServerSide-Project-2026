<?php
require_once(ROOT . "/include-for-functions/day-mapper.php");
require_once(ROOT . "/Schedule/schedule-handling.php");
require_once(ROOT . "/Schedule/semesters.php");

$schedule = generateSchedule();

global $days, $times, $semesters;

$sem = $semesters[$_SESSION['semester']];

?>
<div id = 'schedule-table-container'>
<table id = "ScheduleTable">
    <thead>
        <tr>
            <th colspan = "6">
                <form id = 'change-room' action = "" method = "POST">
                    <div>
                        Room <?php echo $_SESSION['room']; ?>
                        <button name = 'previous-room' id = 'previous-room'><</button>
                        <button name = 'next-room' id = 'next-room'>></button>
                    </div>
                    <div>
                        <?php echo $sem['name']; ?> Semester
                        <button name = 'previous-sem'><</button>
                        <button name = 'next-sem'>></button>
                        <input type = 'hidden' name = 'semester-number' value = "<?php echo $sem['number']; ?>">
                    </div>
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
                    <td class = 'class-slot' data-id = "<?php echo htmlspecialchars($class['id']); ?>">
                    <p id = "ClassSubject"><strong><?php echo htmlspecialchars($class['class']); ?></strong></p>
                    <br>
                    <p id = "ClassTutor"><?php echo htmlspecialchars($class['tutor']); ?></p>
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
