<?php

function doneCommand(array $arguments): void
{
    $todos = getTodosOrFail();

    $now = time();

    $todos = mapTodos($todos, $arguments, static function ($todo) use ($now) {
        return array_merge($todo,
            [
                'completed' => true,
                'update_at' => $now,
                'completed_at' => $now,
            ]);
    });

    storeTodos($todos);
}