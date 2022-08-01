<?php

include_once('./connection.php');

function test_input($data) {
	
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$username = test_input($_POST["username"]);
	$password = test_input($_POST["password"]);

    $sql = "SELECT * FROM adminlogin WHERE username = :username AND password = :password";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetchAll( PDO::FETCH_ASSOC );

	$stmt->execute();
	$users = $stmt->fetchAll();

    if ($stmt->execute()) {
        $users = $stmt->fetchAll();
        if (count($users) > 0) {
            echo "Login successful";
        } else {
            echo "Login failed";
        }
    } else {
        echo "Login failed";
    }

	
	foreach($users as $user) {
		
		if(($user['username'] == $username) &&
			($user['password'] == $password)) {
				header("location: adminpage.php");
		}
		else {
			echo "<script language='javascript'>";
			echo "alert('WRONG INFORMATION')";
			echo "</script>";
			die();
		}
	}



}
