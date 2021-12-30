<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
$phone = $_POST['phone'];
$psw = $_POST['psw'];
$confirm_psw = $_POST['confirm-psw'];


$format = "/^[0-9]{10}+$/";

    if ( preg_match($format, $phone) === 0) {

		echo '<script>
		alert("Please Enter Correct Phone Number");
		window.location.href = "http://localhost/project%201/login-form.html";
		</script>';
	
    }

    elseif( $psw !== $confirm_psw) { 
        echo '<script>
		alert("Passwords do not match. Please enter correct password.");
		window.location.href = "http://localhost/project%201/login-form.html";
		</script>';
    }
	else{

		include 'connection.php';
		if(isset($_POST['login'])){
			  $statement = $conn->prepare('INSERT INTO login_form (phone, psw )
				  VALUES ( :phone, :psw)');
		
		$x = $statement->execute([
		
		'phone' => $_POST['phone'],
		'psw'=>$_POST['psw']	
		]);

		if($x){

		echo '<script>
		alert("Password has been set successfully.");
		window.location.href = "http://localhost/project%201/user-login.html";
		</script>';
		}
		}

	}
}

?>