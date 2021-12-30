<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="register background">
    <div class="col-table-1">
        <form action="register-lead.php" method="POST" class="modal-content">
            <div class="container">
                <h1>Register Leads</h1>
                <p>Please fill in this form to register your leads.</p>
                <hr>
                <input type="hidden" value="1" name="signup">
                <label for="name"><b>Name<span class="asterics">*</span></b></label>
                <input type="text" placeholder="Enter first name" name="name" required>

                <label for="phone"><b>Phone<span class="asterics">*</span></b></label>
                <input type="text" placeholder="Enter phone number" name="phone" required>

                <label for="email"><b>Email<span class="asterics">*</span></b></label>
                <input type="text" placeholder="Enter email" name="email" required>

                <label for="companyName"><b>Product</b></label>
                <input list="product" type="text" name="product" autocomplete="off" required>
                <datalist id="product">
                    <option value="Home Loan" />
                    <option value="LAP"/>
                    <option value="Personal loan"/>
                    <option value="Auto loan"/>
                    <option value="Buisness loan"/>
                </datalist>

                <div class="clearfix">
                    <button type="submit" class="signupbtn">Register</button>
                </div>

            </div>
        </form>
    </div>
    <div class="col-table-2">
            <?php
            
                include 'connection.php';
                $sql = "SELECT name, product, status from leads";
                $result = $conn->query($sql); 
                // $numrows=mysqli_num_rows($sql);
                if ($result->rowCount() > 0) {
                    ?>
                 <div class="table__leads">
                    <table id="leads">
                        <tr>
                            <th>Name</th>
                            <th>Lead</th>
                            <th>Status</th>
                    </tr>
                    <!-- // output data of each row -->
                    <?php
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr><td>" . $row["name"]. "</td><td> " . $row["product"]. "</td><td>" . $row["status"]. "</td></tr>";
                    }
                    ?>
                    </table>
                </div>
                <?php
                } else {
                             echo "0 results";
                         }
                ?>
    </div>

<?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];  
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $product = $_POST['product'];

$format = "/^[0-9]{10}+$/";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

	echo '<script>
	alert("Please Enter Correct Email");
	window.location.href = "http://localhost/project%201/register-lead.html";
	</script>';

    }

    elseif ( preg_match($format, $phone) === 0) {

		echo '<script>
		alert("Please Enter Correct Phone Number");
		window.location.href = "http://localhost/project%201/register-lead.html";
		</script>';
	
    }

    else{
   
    include 'connection.php';
    if(isset($_POST['signup'])){
          $statement = $conn->prepare('INSERT INTO leads (name, phone, email, product )
              VALUES ( :name, :phone, :email, :product)');
    
    $x = $statement->execute([
    
    'name' => $_POST['name'], 
    'phone' => $_POST['phone'],
    'email' => $_POST['email'],
    'product' => $_POST['product'],
    ]);
    // print_r($x);
    // die();
    if($x){
        echo '<script>
		alert("Lead added successfully");
		window.location.href = "http://localhost/project%201/register-lead.php";
		</script>';
    }
    
    }

    }
}
?>