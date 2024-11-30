<?php

function reportCommand(array $arguments = []): void
{
    $allTodos = prepareReportData();

    $totalDays = count($allTodos);
    $totalTasksCount = array_reduce($allTodos, static fn($prev, $todos) => $prev + count($todos), 0);
    $totalCompletedTasksCount = array_reduce($allTodos, static function ($prev, $todos) {
        $completed = array_filter($todos, static fn($todo) => $todo['completed']);
        return $prev + count($completed);
    }, 0);

    $dailyTaskCount = array_map(static function ($todos) {
        return count($todos);
    }, $allTodos);
    $maxTasksCount = max($dailyTaskCount);
    $minTasksCount = min($dailyTaskCount);

    $averageTasksCount = 0;
    $averageCompletedTasksCount = 0;

    if ($totalDays > 0)
    {
        $averageTasksCount = floor($totalTasksCount / $totalDays);
        $averageCompletedTasksCount = floor($totalCompletedTasksCount / $totalDays);
    }

    $report = [
        "Total days: $totalDays",
        "Total tasks: $totalTasksCount",
        "Total completed tasks: $totalCompletedTasksCount",
        "Min in a day: $minTasksCount",
        "Max in a day: $maxTasksCount",
        "Average tasks per day: $averageTasksCount",
        "Average completed tasks per day: $averageCompletedTasksCount",
    ];

    echo implode(PHP_EOL, $report) . PHP_EOL;
}

function prepareReportData(): array
{
    $files = scandir(ROOT . '/data');

    $allTodos = [];

    foreach ($files as $file)
    {
        if (!preg_match("/^\d{4}-\d{2}-\d{2}\.txt$/", $file))
        {
            continue;
        }

        $content = file_get_contents(ROOT . "/data/$file");
        $todos = unserialize($content, ['allowed_classes' => false,]);

        $todos = is_array($todos) ? $todos : [];

        [$date] = explode('.', $file);
        $allTodos[$date] = $todos;
    }
    return $allTodos;
}