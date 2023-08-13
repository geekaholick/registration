<?php
$con = mysqli_connect('localhost', 'root', '', 'uscdcism');
if(mysqli_connect_error())
{
    echo "Database connection error!";
    exit;
}