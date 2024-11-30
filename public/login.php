<?php

require_once __DIR__ . "/../boot.php";

$title = option('APP_NAME', 'Todolist');
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $login = $_POST["login"];
    $password = $_POST["password"];

    $error = 'Invalid login or password';
    $user = getUserByLogin($login);

    if (!$user)
    {
        $errors[] = $error;
    }
    else
    {
        $isPasswordCorrect = password_verify($password, $user['password']);
        if (!$isPasswordCorrect)
        {
            $errors[] = $error;
        }

        if (empty($errors))
        {
            session_start();
            $_SESSION['USER'] = $user;
            redirect('index.php');
            exit();
        }
    }
}

echo view('layout', [
    'title' => $title . ' :: Login',
    'content' => view('pages/login', [
        'errors' => $errors,
    ]),
]);
