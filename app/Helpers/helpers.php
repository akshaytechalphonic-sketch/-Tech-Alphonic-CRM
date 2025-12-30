<?php

use Carbon\Carbon;
use App\Models\OfficeLeadFollowups;

function changeTimeto12($time)
{
    return Carbon::createFromFormat('H:i', $time)->format('h:i A');
}
function countHours($start_time, $end_time)
{
    $start = Carbon::createFromFormat('H:i', $start_time);
    $end = Carbon::createFromFormat('H:i', $end_time);

    $diff = $start->diff($end);
    $hours = $diff->h;
    $minutes = $diff->i;


    return "$hours hour $minutes min";
}
function countDaysWithoutSundays($month, $year)
{
    $daysWithoutSundays = 0;
    $totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    for ($day = 1; $day <= $totalDays; $day++) {
        $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
        if (date('w', strtotime($date)) != 0) { // Exclude Sundays (0 = Sunday)
            $daysWithoutSundays++;
        }
    }

    return $daysWithoutSundays;
}
function office_leads_notification()
{
    $now = Carbon::now();
    $followups = OfficeLeadFollowups::with('employee')
        ->where('date', date('Y-m-d'))
        ->where('time', '>', $now->toTimeString())
        ->where('active', 1)
        ->get();
    return $followups;
}
