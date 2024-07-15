<?php

$conn = mysqli_connect("localhost","root","","dbapis");
if(!$conn)
{
    echo "failed".mysqli_error($conn);
}
?>
