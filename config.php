<?php

$conn = mysqli_connect("localhost", "root", "", "agro");

if (!$conn) {
    echo "Connection Failed";
}