<?php
//  echo "<pre>";
//      print_r($_POST);
//      die();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 		require_once 'PHPMailer/src/Exception.php';
        require_once 'PHPMailer/src/PHPMailer.php';
        require_once 'PHPMailer/src/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

$fname = $_POST['fname'];
$lname = $_POST['lname'];    
$phone = $_POST['phone'];
$email = $_POST['email'];
$cname = $_POST['cname'];


$format = "/^[0-9]{10}+$/";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

	echo '<script>
	alert("Please Enter Correct Email");
	window.location.href = "https://loanportal.cognilements.com/";
	</script>';

    }

    elseif ( preg_match($format, $phone) === 0) {

		echo '<script>
		alert("Please Enter Correct Phone Number");
		window.location.href = "https://loanportal.cognilements.com/";
		</script>';
	
    }

    else{
   
    include 'connection.php';
    if(isset($_POST['signup'])){
          $statement = $conn->prepare('INSERT INTO signup (fname, lname, phone, email, cname )
              VALUES ( :fname, :lname, :phone, :email, :cname)');
    
    $x = $statement->execute([
    
    'fname' => $_POST['fname'],
    'lname' => $_POST['lname'],    
    'phone' => $_POST['phone'],
    'email' => $_POST['email'],
    'cname' => $_POST['cname'],
    ]);
    // print_r($x);
    // die();
    if($x){
        $mail = new PHPMailer(true);
            //Server settings
            $mail->SMTPDebug = 2;                      
            $mail->isSMTP();                                  
            $mail->Host       = 'smtp.googlemail.com';        
            $mail->SMTPAuth   = true;                         
            $mail->Username   = 'expsloan@gmail.com';
            $mail->Password   = 'loan@123';                 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = 465;                                   
        
            //Recipients
            $mail->setFrom('cognilements@gmail.com');
            $mail->addAddress($email);     //Add a recipient
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Thank you for registration !';
            $mail->Body    = '<p>Hey'.' '. $fname .', </p><p>Thank you for registering with us. Please click the below link to set the password.</p><p><a href="https://loanportal.cognilements.com/login.html">https://loanportal.cognilements.com/login.html</a><p/>';
            if(!$mail->send()) {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
            
            } else {
                      echo "<script>
                      alert ('Thank you for registering with us. Please check you registered email.');
                      window.location.href = 'https://loanportal.cognilements.com/';
                      </script>";
        
            }
    }
    
    }

    }
}
?>