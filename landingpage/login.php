<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #d01c1c;
        }

        .textbox {
            display: flex;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h1>Login</h1>
        <?php
        require_once('./config.php');
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $respons = $db->query($sql);

            $result = $respons->fetchAll(PDO::FETCH_ASSOC);


            if (count($result) > 0) {
                echo "<div class='alert alert-success'>Login Successful</div>";
            } else {
                echo "<div class='alert alert-danger'>User Or Password Are not correct</div>";
            }
        }
        ?>
        <form action="../index.php" method="POST">
            <div class="textbox">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Username" name="username">
            </div>
            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Password" name="password">
            </div>
            <input type="submit" class="btn" name="login" value="Login">
        </form>
        <a href="/get/Getflix/landingpage/signup.php" target="_blank">Register</a>
        <a href="/get/Getflix/reset password/requestReset.php" target="_blank">Forgot Password</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
