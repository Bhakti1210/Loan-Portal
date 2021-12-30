<?php
//  echo "<pre>";
//      print_r($_POST);
//      die();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
$phone = $_POST['phone'];
$psw = $_POST['psw'];


$format = "/^[0-9]{10}+$/";

    if ( preg_match($format, $phone) === 0) {

		echo '<script>
		alert("Please Enter Correct Phone Number");
		window.location.href = "http://localhost/project%201/login-form.html";
		</script>';
	
    }

	else{

		include 'connection.php';
		if(isset($_POST['user-login'])){
            $sql = "SELECT psw from login_form where phone = '$phone'";
			$result = $conn->query($sql);
			$row = $result->fetch(PDO::FETCH_ASSOC);
			if ($result->rowCount() > 0) {
        
		

		// if($password != $psw){

		// echo '<script>
		// alert("Password not found.");
		// window.location.href = "http://localhost/project%201/user-login.html";
		// </script>';
		// }
        // else{
        //     echo '<script>
		//     window.location.href = "http://localhost/project%201/register-lead.html";
		//     </script>';
        // }

		}

	    }

    }

?>