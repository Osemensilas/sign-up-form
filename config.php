<?php

$conn = mysqli_connect('Localhost', 'root', '', 'test');


if (!$conn) {
    echo 'Error in connection' . mysqli_connect_error();
}
