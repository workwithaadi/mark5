<?php

   $fname=$_POST['fname'];
   $lname=$_POST['lname'];
   $email=$_POST['email'];
   $phone=$_POST['phone'];
   $passw=$_POST['password'];
   $confirmpassword=$_POST['confirmpassword'];

  echo "link";
  
  if(!empty($fname) || !empty($lname) || !empty($email) || !empty($phone) ||!empty($passw) ||!empty($confirmpassword))
   {
      
     
      $host="localhost";
        $dbusername="root";
        $dbpassword="";
        $dbname="foodjunction";

        $conn = mysqli_connect("$host","$dbusername","$dbpassword","$dbname");

        if(!$conn)
        {
            echo " Error in connection";
        }
        
        $sql1 ="SELECT * FROM users where email='$email'";
        $row=mysqli_query($conn , $sql1);
        if(mysqli_num_rows($row) >0)
           {
            include '../html/emailerror.html';
            
            }
          elseif($passw != $confirmpassword)
             {
              include '../html/Passworderror.html';
             }

         else
             {
              $sql1= "CREATE TABLE users
              (
               id int NOT NULL AUTO_INCREMENT,
              fname varchar(50),
              lname varchar(50),
              email varchar(50),
              phone varchar(50),
              passw varchar(50),
              confirmpassword varchar(50),
              PRIMARY KEY (ID)
              )";           
                mysqli_query($conn , $sql1);
                 $sql = "INSERT INTO users(fname,lname,email,phone,passw,confirmpassword) VALUES('$fname','$lname','$email','$phone','$passw','$confirmpassword')";
            
                   mysqli_query($conn , $sql);
           
                   include '../html/register.html';
           
              }
        
    }
    else
    {
    echo "All field are Required";
    die();
   }
 
?>