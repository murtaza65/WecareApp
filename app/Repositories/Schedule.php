<?php
namespace App\Repositories;

class Schedule
{
    public function __construct()
    {
    }

    public function schedule()
    {
        # code...

        $days     = $this->daysOfWeek();
        $hours    = $this->hoursOfDay();
        $schedule = [];
        foreach ($days as $day) {
            $daySchedule = [
                "day"   => $day,
                "hours" => $hours,
            ];

            array_push($schedule, $daySchedule);
        }

        return $schedule;
    }

    public function daysOfWeek()
    {
        # code...
        $days = [
            "Mon", "Tue", "Wed", "Thur", "Fri", "Sat",
        ];
        return $days;
    }

    public function hoursOfDay()
    {
        # code...
        $minutes = [
            "00",
            "30",
        ];

        $hours = [];
        for ($i = 8; $i < 18; $i++) {

            foreach ($minutes as $minute) {
                $hour = $i . ":" . $minute;
                array_push($hours, $hour);
            }
        }

        return $hours;
    }
}
