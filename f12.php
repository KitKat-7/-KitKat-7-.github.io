<?php 

$showAlert = false; 
$showError = false; 
$exists=false;

if($_SERVER["REQUEST_METHOD"] == "POST") {
include "dbconn.php";


$username = $_POST['username'];
$uid       = $_POST['uid'];
$mailid = $_POST['mailid'];
$password   = $_POST['password'];
$password2   = $_POST['password2'];

$sql = "Select * from register where username='$username'";
    
    $result = mysqli_query($conn, $sql);
    
    $num = mysqli_num_rows($result); 
// This sql query is use to check if
// the username is already present 
// or not in our Database

if($num == 0) {
    if(($password == $password2) && $exists==false) {

        $hash = password_hash($password, 
                            PASSWORD_DEFAULT);
// Password Hashing is used here.            

$sql = "INSERT Into register ( username , uid , mailid , password ) values('$username','$uid','$mailid','$password')";

        $result = mysqli_query($conn,$sql);

        if ($result) {
            $showAlert = true; 
        }
    } 
    else { 
        $showError = "Passwords do not match"; 
    }      
}

if($num>0) 
   {
      $exists="Username not available"; 
   }
}




if($showAlert) {
    
    echo ' <div class="alert alert-success 
        alert-dismissible fade show" role="alert">

        <strong>Success!</strong> Your account is 
        now created and you can login. 
        <button type="button" class="close"
            data-dismiss="alert" aria-label="Close"> 
            <span aria-hidden="true">×</span> 
        </button> 
    </div> '; 
}

if($showError) {

    echo ' <div class="alert alert-danger 
        alert-dismissible fade show" role="alert"> 
    <strong>Error!</strong> '. $showError.'

   <button type="button" class="close" 
        data-dismiss="alert aria-label="Close">
        <span aria-hidden="true">×</span> 
   </button> 
 </div> '; 
}
    
if($exists) {
    echo ' <div class="alert alert-danger 
        alert-dismissible fade show" role="alert">

    <strong>Error!</strong> '. $exists.'
    <button type="button" class="close" 
        data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">×</span> 
    </button>
   </div> '; 
}

?>