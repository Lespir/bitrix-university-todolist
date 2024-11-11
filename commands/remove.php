<?php

function removeCommand(array $arguments): void
{
    $todos = getTodosOrFail();

    $todos = mapTodos($todos, $arguments, static fn($todo) => null);

    storeTodos($todos);
}