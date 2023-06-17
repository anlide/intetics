<?php
error_reporting(E_ALL);

include 'database.php';
include 'Sender/ISender.php';
include 'Sender/Sender.php';
include 'Sender/Email.php';
include 'Sender/SMS.php';
include 'kernel.php';
include 'Controller.php';
include 'Model.php';

try {
    session_start();
    database::connect();

    $kernel = new \Kernel\Kernel();
    $kernel->route();

    print $kernel;
} catch (\Exception $exception) {
    error_log('Error: ' . $exception->getMessage());
    print $exception->getMessage();
}
