<?php

include 'config.php';

$firstname = $lastname = $email = $phone = $password1 = $password2 = '';
$error = array('firstname' => '', 'lastname' => '', 'email' => '', 'phone' => '', 'password1' => '', 'password2' => '');

if (isset($_POST['submit'])) {

    if (empty(trim($_POST['firstname']))) {
        $error['firstname'] = "Field required";
    } else {
        $firstname = $_POST['firstname'];

        if (!preg_match('/^[a-zA-Z]+$/', $firstname)) {
            $error['firstname'] = "Invalid Input";
        }
    }

    if (empty(trim($_POST['lastname']))) {
        $error['lastname'] = "Field required";
    } else {
        $lastname = $_POST['lastname'];

        if (!preg_match('/^[a-zA-Z]+$/', $lastname)) {
            $error['lastname'] = "Invalid Input";
        }
    }

    if (empty(trim($_POST['email']))) {
        $error['email'] = "Field required";
    } else {
        $email = $_POST['email'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "Invalid email address";
        } else {
            $sql = "SELECT * FROM signup WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $error['email'] = "Email already exist";
            }
        }
    }

    if (empty(trim($_POST['phone']))) {
        $error['phone'] = "Field required";
    } else {
        $phone = $_POST['phone'];

        if (!preg_match('/^[+][2][3][4][0-9]{10}$/', $phone)) {
            $error['phone'] = "Invalid phone number";
        }
    }

    if (empty(trim($_POST['password1']))) {
        $error['password1'] = "Field Required";
    } else {
        $password1 = $_POST['password1'];

        if (!preg_match('/^[a-zA-Z||0-9||#$^+_?.]{8,}$/', $password1)) {
            $error['password1'] = "Password should be atleast 8 characters";
        } else {
            if (!preg_match('/(?=.*[A-Z])/', $password1)) {
                $error['password1'] = "Password should contain atleast 1 Uppercase";
            } else {
                if (!preg_match('/(?=.*[a-z])/', $password1)) {
                    $error['password1'] = "Password should contain atleast 1 Lowercase";
                } else {
                    if (!preg_match('/(?=.*[0-9])/', $password1)) {
                        $error['password1'] = "Password should contain atleast 1 digit";
                    } else {
                        if (!preg_match('/(?=.*[#$^+_?.])/', $password1)) {
                            $error['password1'] = "Password should contain atleast one of #$^+_?.";
                        }
                    }
                }
            }
        }
    }

    if (empty(trim($_POST['password2']))) {
        $error['password2'] = "Field required";
    } else {
        $password2 = $_POST['password2'];

        if ($password1 != $password2) {
            $error['password2'] = "Passwords don't match";
        }
    }


    if (!array_filter($error)) {
        $firstname = mysqli_real_escape_string($conn, $firstname);
        $lastname = mysqli_real_escape_string($conn, $lastname);
        $email = mysqli_real_escape_string($conn, $email);
        $phone = mysqli_real_escape_string($conn, $phone);
        $password = mysqli_real_escape_string($conn, $password1);

        $sql = "INSERT INTO signup (firstname, lastname, email, phone, password) VALUES ('$firstname', '$lastname',
        '$email', '$phone', '$password')";
        $result = mysqli_query($conn, $sql);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
</head>

<body>
    <section id="form-container">
        <div class="form-container">
            <form action="signup.php" class="signup-form" method="POST">
                <div class="form-header">
                    <h2>Sign Up</h2>
                </div>
                <div class="form-content">
                    <div class="details">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>" class="form-input" id="firstname" placeholder="Firstname">
                        <div class="error"><?php echo $error['firstname']; ?></div>
                    </div>
                    <div class="details">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>" class="form-input" id="lastname" placeholder="Lastname">
                        <div class="error"><?php echo $error['lastname']; ?></div>
                    </div>
                    <div class="details">
                        <label for="email">Email Address</label>
                        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" class="form-input" id="email" placeholder="Email">
                        <div class="error"><?php echo $error['email']; ?></div>
                    </div>
                    <div class="details">
                        <label for="phone">Phone No</label>
                        <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" class="form-input" id="phone" placeholder="Phone number">
                        <div class="error"><?php echo $error['phone']; ?></div>
                    </div>
                    <div class="details">
                        <label for="password1">Password</label>
                        <input type="password" name="password1" value="<?php echo htmlspecialchars($password1); ?>" class="form-input" id="password1" placeholder="Password">
                        <img src="imgs/eye.png" alt="" class="eye-open active">
                        <img src="imgs/hidden.png" alt="" class="eye-close active">
                        <div class="error"><?php echo $error['password1']; ?></div>
                    </div>
                    <div class="details">
                        <label for="password2">Confirm Password</label>
                        <input type="password" name="password2" value="<?php echo htmlspecialchars($password2); ?>" class="form-input" id="password2" placeholder="Confirm Password">
                        <img src="imgs/eye.png" alt="" class="eye-open active">
                        <img src="imgs/hidden.png" name="password2" alt="" class="eye-close active">
                        <div class="error"><?php echo $error['password2']; ?></div>
                    </div>
                </div>
                <div class="submit-btn-container">
                    <input type="submit" name="submit" class="submit-btn" value="Sign Up">
                </div>
            </form>
        </div>
    </section>

    <script src="signup.js"></script>
</body>

</html>