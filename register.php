<?php
include 'db/db.php';
mysqli_query($con,"CREATE DATABASE eventribe");
mysqli_select_db($con,'eventribe');
if (mysqli_query($con,"CREATE TABLE pradyut (
    ID int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    uname varchar(255),
    email varchar(255),
    whatsapp int(10),
    phone int(10),
    city_name varchar(255),
    state_name varchar(255),
    age varchar(10),
    slot varchar(10),
    screenshot varchar(255)
)")) {
    # code...
echo "pradyut";
}
$uname = $_POST['name'];
$email = $_POST['email'];
$whatsapp = $_POST['whatsapp'];
$phone = $_POST['phone'];
$city_name = $_POST['city'];
$state_name = $_POST['state'];
$age = $_POST['age'];
$time = $_POST['time'];
// $screenshot = $_POST['screenshot'];
$work = $_POST['post'];

$email = stripcslashes($email);
$email = mysqli_real_escape_string($con,$email);

// $username = stripcslashes($username);
// $username = mysqli_real_escape_string($con,$username);

$result = mysqli_query($con,"select * from pradyut where email = '$email'") or die("failed to query database".mysqli_error());
$row = mysqli_fetch_array($result);

if($row['email'] == $email) {
    echo '<script type ="text/javascript"> alert("This email is already registered \n Please try with a different email");window.location= "SignUp.php"</script>';
    die();
}elseif (($row['email'] !== $email)) {

        echo "<pre>", print_r($_FILES['screenshot']['name']),"</pre>";
        $profileImageName = $uname . '_' . $_FILES['screenshot']['name'];
        echo 'fffffffffffffffffffffffffffffffffffffff  '.$profileImageName;

        $path = 'assets/events/pradyut/'. $uname .'/screenshot/';
        if (!file_exists($path)) {
            mkdir($path, 0777,true);
        }else{
            $files = glob($path.'/*'); 
            foreach($files as $file){ 
                if(is_file($file)) 
            unlink($file); 
        }
} 
    

         $target = 'assets/events/pradyut/'.$uname.'/screenshot/'. $profileImageName;
                 
        
        move_uploaded_file($_FILES['profileImage']['tmp_name'], $target);

        
        echo $path;
        echo '  ';
        // echo $target;
    //         mysqli_query($con,"update rentwebusers set profile = '$profileImageName', phone='$phone' where username = '$username'") or die("failed to query database".mysqli_error());
    // echo '<script type ="text/javascript"> alert("Profile Updated Successfully");window.location= "seller.php"</script>';






    // code...
   $query = mysqli_query($con," insert into pradyut (uname, email, whatsapp, phone, city_name, state_name, age, slot, screenshot) 
values ('$uname', '$email', '$whatsapp', '$phone', '$city_name', '$state_name', '$age', '$time', '$profileImageName')");
  
echo '<script type ="text/javascript"> alert("Registered Successfully");</script>';

}else {
    // code...
    echo '<script type ="text/javascript"> alert("Something went wrong !! Please try again");window.location= "register.html"</script>';
}
 ?>