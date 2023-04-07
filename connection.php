<?php
$con = mysqli_connect('localhost', 'root', '', 'usccmpc');
if(mysqli_connect_error())
{
    echo "Database connection error!";
    exit;
}