<?php

$firstName = '';
$lastName  = '';
$email     = '';

$errors = [
    'firstNameError' => '',
    'lastNameError'  => '',
    'emailError'     => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $firstName = trim($_POST['firstName']);
    $lastName  = trim($_POST['lastName']);
    $email     = trim($_POST['email']);

    $valid = true;

    if (empty($firstName)) {
        $errors['firstNameError'] = 'الرجاء إدخال الاسم الأول';
        $valid = false;
    }

    if (empty($lastName)) {
        $errors['lastNameError'] = 'الرجاء إدخال الاسم الأخير';
        $valid = false;
    }

    if (empty($email)) {
        $errors['emailError'] = 'الرجاء إدخال البريد الإلكتروني';
        $valid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['emailError'] = 'صيغة البريد الإلكتروني غير صحيحة';
        $valid = false;
    }

    if ($valid) {
        $stmt = mysqli_prepare($conn, "INSERT INTO participants (firstName, lastName, email) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'sss', $firstName, $lastName, $email);

        if (mysqli_stmt_execute($stmt)) {
           
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
           
            $errors['emailError'] = 'هذا البريد الإلكتروني مسجل مسبقًا';
        }

        mysqli_stmt_close($stmt);
    }
}
?>