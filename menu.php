<?php

$time = isset($_GET['date']) ? strtotime($_GET['date']) : time();
if ($time === false)
{
    $time = time();
}

$secondsInDay = 86400;
$dayBefore = date("Y-m-d", $time - $secondsInDay);
$dayAfter = date("Y-m-d", $time + $secondsInDay);

return [
    ['url' => '/?date=' . $dayBefore, 'text' => '&minus; day'],
    ['url' => '/?date=' . $dayAfter, 'text' => '&plus; day'],
    ['url' => '/', 'text' => 'Today'],
    ['url' => '/report.php', 'text' => 'Reporting'],
];