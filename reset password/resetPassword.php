<?php
include('./config.php');

if (!isset($_GET["code"])) {

    exit("can't find page");

}

$code = $_GET["code"];

$email = $_GET["email"];

$reponse = $db->query('SELECT * from resetpasswords WHERE Code = "' . $code . '"');

$messages = $reponse->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['password'])) {

        $pw = $_POST['password'];

        $pw = md5($pw);

        $data = [
        'password' => $pw,
        'email' => $email
        ];

        $sql = "UPDATE users SET password = :password  WHERE email = :email";
        $stmt = $db->prepare($sql);
        $stmt->execute($data);

        $sql = 'DELETE from resetpasswords WHERE Email = :email';
        $del = $db->prepare($sql);
        $del->bindValue(':email', $email);
        $count = $del->execute();

        if ($count) {
        echo "Password updated successfully.";
        } else {
        echo "Error updating password.";
        }
    }

?>

<form method="POST">
    <input type="password" name="password" placeholder="New Password">
    <br>
    <input type="submit" name="submit" value="Update Password">
</form>