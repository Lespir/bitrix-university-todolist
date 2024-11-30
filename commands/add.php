<?php

function addCommand(array $arguments): void
{
    $title = array_shift($arguments);

    $todo = createTodo($title);

    addTodo($todo);
}