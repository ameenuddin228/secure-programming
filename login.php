<?php
    session_start();
    if (!isset($_SESSION['session_id'])) {
        $session_id = bin2hex(random_bytes(16));
        $_SESSION['session_id'] = $session_id;
    } else {
        $session_id = $_SESSION['session_id'];
    }
    session_id($session_id);
    include("connection.php");
    if(isset($_POST['submit'])){
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $encryptionKey = '';

    $sql2 = "select * FROM aeskey WHERE username = ?";
    if($stmt2 = mysqli_prepare($conn, $sql2)){
        $stmt2 = $conn->prepare($sql2);
        if($stmt2 == true){
            $username = $_POST['user'];
            $stmt2->bind_param('s',$username);
            if($stmt2->execute()){
                $stmt2->bind_result($user, $Key);
                $stmt2->fetch();
                $_SESSION['encryptionKey'] = $Key;
            }
        }
    } else{
        echo "ERROR: Could not fetch aes key : ".mysqli_error($conn);
    }
    $encryptionKey = $_SESSION['encryptionKey'];
    $username= openssl_encrypt($username, 'AES-256-CBC', $encryptionKey, OPENSSL_RAW_DATA);

    //This is code for protection again sql injection:
    $sql = "select * FROM user WHERE username = ?";

    if($stmt = mysqli_prepare($conn, $sql)){
        $stmt = $conn->prepare($sql);

        if($stmt == true){
            $username = $_POST['user'];
            $stmt->bind_param('s', $username);

            if($stmt->execute()){
                $stmt->bind_result($user, $pass, $saltnum, $email);
                $stmt->fetch();

                $user = openssl_decrypt($user, 'AES-256-CBC', $encryptionKey, OPENSSL_RAW_DATA);
                $aftersalt = $password.$saltnum;
                $hash = hash('sha256',$aftersalt);
                if($hash == $pass){
                    session_regenerate_id(true);
                    header("Location:homepage.php");
                    $_SESSION['username'] = $user;
                    $_SESSION['password'] = $pass;
                    $_SESSION['saltnum'] = $salt;
                } else{
                    echo '<script>
                        window.location.href="index.php";
                        alert("Login failed. Invalid username or password")
                    </script>';
                }
            }
        }
    }else{
        echo "ERROR: Could not register : ".mysqli_error($conn);
    }
    }
?>