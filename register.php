<?php
    include("connection.php");
    function isSafePassword($password) {
        // Check if the password is at least 8 characters long
        if (strlen($password) < 8) {
            echo '<script>
                        window.location.href="index2.php";
                        alert("Register Fail. Password must at least 8 char long")
                    </script>';
            return false;
        }
    
        // Check if the password contains at least one uppercase letter
        if (!preg_match('/[A-Z]/', $password)) {
            echo '<script>
                        window.location.href="index2.php";
                        alert("Register Fail. Password must contains at least one uppercase letter")
                    </script>';
            return false;
        }
    
        // Check if the password contains at least one lowercase letter
        if (!preg_match('/[a-z]/', $password)) {
            echo '<script>
                        window.location.href="index2.php";
                        alert("Register Fail. Password must contains at least one lowercase letter")
                    </script>';
            return false;
        }
    
        // Check if the password contains at least one digit
        if (!preg_match('/\d/', $password)) {
            echo '<script>
                        window.location.href="index2.php";
                        alert("Register Fail. Password must contains at least one digit")
                    </script>';
            return false;
        }
    
        // Check if the password contains at least one special character
        if (!preg_match('/[!@#$%^&*()-=_+{};:,.<>?]/', $password)) {
            echo '<script>
                        window.location.href="index2.php";
                        alert("Register Fail. Password must contains at least one special character")
                    </script>';
            return false;
        }
    
        // If all the conditions are met, the password is considered safe
        return true;
    }
if(isset($_POST['submit'])){
    $username = htmlspecialchars($_POST['user']);
    $password = htmlspecialchars($_POST['pass']);
    $email = htmlspecialchars($_POST['email']);

    
    // $username = $_POST['user'];
    // $password = $_POST['pass'];
    // $email = $_POST['email'];
    if($username!="" && $password!="" && $email!="" && isSafePassword($password)){

    $salt = bin2hex(random_bytes('16'));
    $newsalt = $password . $salt;
    $hash = hash('sha256',$newsalt);

    //AES encryption

    $encryptionKey = openssl_random_pseudo_bytes(32);
    //store the AES key into different database
    $sql2 = "INSERT INTO aeskey (username, encryption_key) VALUES (?, ?)";
    if($stmt2 = mysqli_prepare($conn, $sql2)){
        mysqli_stmt_bind_param($stmt2, "ss",$username, $encryptionKey);
        mysqli_stmt_execute($stmt2);
        echo "Successfully save AES key";
    } else {
        echo "ERROR: Could not save aes key : ".mysqli_error($conn);
    }
    mysqli_stmt_close($stmt2);

    $username= openssl_encrypt($username, 'AES-256-CBC', $encryptionKey, OPENSSL_RAW_DATA);
    $email = openssl_encrypt($email, 'AES-256-CBC', $encryptionKey, OPENSSL_RAW_DATA);
    //AES end
    
    //This line is for protection again sql injection:
    $sql = "INSERT into `user` (username, password, salt, email)
            VALUES(?,?,?,?)";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "ssss", $username, $hash, $salt, $email);
        mysqli_stmt_execute($stmt);
        echo "<div class='form'>
        <h3>You are registered successfully.</h3><br/>
        <p class='link'>Click here to <a href='index.php'>Login</a></p>
        </div>";
    }else{
        echo "ERROR: Could not register : ".mysqli_error($conn);
        echo "<div class='form'>
                  <h3>Error to register.</h3><br/>
                  <p class='link'>Click here to <a href='index2.php'>registration</a> again.</p>
                  </div>";
    }
    mysqli_stmt_close($stmt);
    }
    else{
        echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='index2.php'>registration</a> again.</p>
                  </div>";
    }
} 
?>