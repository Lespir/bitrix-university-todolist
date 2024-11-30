<?php

function getUserByLogin(string $login): ?array
{
    $userList = getUserList();
    $userIndex = array_search($login, array_column($userList, 'login'), true);
    if ($userIndex === false)
    {
        return null;
    }

    return $userList[$userIndex];
}

function getUserList(): array
{
    return [
        [
            'id' => 1,
            'login' => 'Slowpoke',
            'password' => '$2y$10$w4ldihsrAAyFYT2hV5RJbuvfFwJcfNkn0IgoXn7yoo.Dmr9MY97xC',
        ],
    ];
}
