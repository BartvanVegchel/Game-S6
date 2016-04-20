<?php
if(isset($_POST['signup']))
    {
    $fullname=mysqli_real_escape_string(htmlspecialchars(trim($_POST['fullname'])));
    $email=mysqli_real_escape_string(htmlspecialchars(trim($_POST['email'])));
    $password=mysqli_real_escape_string(htmlspecialchars(trim($_POST['password'])));
    $login=mysqli_num_rows(mysqli_query("select * from `users` where `email`='$email'"));
    if($login!=0)
    {
    echo "exist";
    }
    else
    {
    $date=date("d-m-y h:i:s");
    $q=mysqli_query("insert into `phonegap_login` (`reg_date`,`fullname`,`email`,`password`) values ('$date','$fullname','$email','$password')");
    if($q)
    {
    echo "success";
    }
    else
    {
    echo "failed";
    }
    }
    echo mysqli_error();
    }
?>