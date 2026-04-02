<?php
    $days = ["Monday","Tuesday","Wednesday","Thursday","Friday"];
    $times = range(9, 17);

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
?>