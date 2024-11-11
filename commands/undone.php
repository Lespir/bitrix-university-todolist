<?php

function undoneCommand(array $arguments): void
{
    $todos = getTodosOrFail();

    $todos = mapTodos($todos, $arguments, static function ($todo) {
        return array_merge($todo,
            [
                'completed' => false,
                'update_at' => time(),
                'completed_at' => null,
            ]);
    });

    storeTodos($todos);
}