<?php
error_reporting(E_ALL);

include 'Sender/ISender.php';
include 'Sender/Sender.php';
include 'Sender/Email.php';
include 'Sender/SMS.php';
include 'kernel.php';
include 'Controller.php';
include 'Model.php';

try {
    $kernel = new \Kernel\Kernel();
    $kernel->route();

    print $kernel;
} catch (\Exception $exception) {
    error_log('Error: '.$exception->getMessage());
    print $exception->getMessage();
}
