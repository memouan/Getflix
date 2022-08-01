<?php
require_once('./config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>User Registration</title>
</head>

<body>
    <div>
        <?php
        if (isset($_POST['create'])) {
            $firstname                = $_POST['firstName'];
            $lastname                 = $_POST['lastName'];
            $username                = $_POST['userName'];
            $email                       = $_POST['email'];
            $password                = $_POST['password'];
            $confirmpassword    = $_POST['confirmPass'];

            $sql = 'INSERT INTO users (firstname, lastname, username, email, password, confirmpassword) VALUES (:first, :last, :user, :email, :pwd, :pwd2)';
            $stmtinsert = $db->prepare($sql);
            $result = $stmtinsert->execute([
                ':first' => $firstname,
                ':last' => $lastname,
                ':user' => $username,
                ':email' => $email,
                ':pwd' => $password,
                ':pwd2' => $confirmpassword
            ]);
            if ($result) {
                echo "User created successfully.";
            } else {
                echo "Error creating user.";
            }
        }
        ?>
    </div>
    <div>
        <form action="./signup.php" method="POST">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <h1>Registration</h1>
                        <!-- <p>Please fill in this form to create an account.</p> -->
                        <hr class="mb-3">
                        <label for="firstName"></label>
                        <input class="form-controll" type="text" name="firstName" placeholder="First Name" required>

                        <label for="lastName"></label>
                        <input class="form-controll" type="text" name="lastName" placeholder="Last Name" required>

                        <label for="userName"></label>
                        <input class="form-controll" type="text" name="userName" placeholder="User name" required>

                        <label for="email"></label>
                        <input class="form-controll" type="email" name="email" placeholder="Email" required>

                        <label for="password"></label>
                        <input class="form-controll" type="password" name="password" placeholder="password" required>

                        <label for="confirmPass"></label>
                        <input class="form-controll" type="password" name="confirmPass" placeholder="confirm Password" required>

                        <hr class="mb-3">
                        <input class="btn btn-primary" type="submit" name="create" value="Sign Up">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>