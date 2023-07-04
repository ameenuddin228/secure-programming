<?php
session_start();
include("connection.php");
if(isset($_POST['submit'])){
    $newpassword = $_POST['pass'];
    $username = $_SESSION['username'];
    //Fetch salt value from the database.
    $sql = "SELECT * FROM user WHERE username = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $user, $pass, $saltnum, $email);
        
        if(mysqli_stmt_fetch($stmt) && $newpassword!="") {
            $aftersalt = $newpassword . $saltnum;
            $hash = hash('sha256', $aftersalt);
        } 
        mysqli_stmt_close($stmt);
    }
    //end fetch 
    if($newpassword!=""){

        $sql = "UPDATE user SET password = ? WHERE username = ?";

        
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, 'ss', $hash, $username);
            mysqli_stmt_execute($stmt);
            echo "<div class='form'>
            <h3>You have change password successfully.</h3><br/>
            <p class='link'>Click here to <a href='index.php'>Login</a></p>
            </div>";
        }else{
            echo "ERROR: Could not change password : ".mysqli_error($conn);
            echo "<div class='form'>
                      <h3>Error to change password.</h3><br/>
                      <p class='link'>Click here to <a href='index.php'>Login</a></p>
                      </div>";
        }
        mysqli_stmt_close($stmt);


    } else {
        echo '<script>alert("Required fields are missing.")</script>';
    }

}
session_destroy();
?>

<!DOCTYPE html>
<html>
<body>

<?php
// Echo session variables that were set on previous page
echo "User email is " . $_SESSION['email'] . ".<br>";
echo "User username is " . $_SESSION['username'] . ".";
echo "<br>Session ID is  " . session_id() . ".";
?>

</body>
</html>