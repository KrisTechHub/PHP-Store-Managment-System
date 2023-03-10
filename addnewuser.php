<?php
    require_once('storeclass.php');
    $store->addNewUser();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nitz' Store | MyStore</title>
</head>
<body>
    <h1>Add new Customer/User</h1>

    <div class="container">
        <div class="form-container">
            <form action="" method="post">
                <div class="form-input">
                    <label>Email</label>
                    <input type="email" name="email" id="email">
                </div>

                <div class="form-input">
                    <label>Password</label>
                    <input type="password" name="password" id="password">
                </div>

                <div class="form-input">
                    <label>First Name</label>
                    <input type="text" name="fname" id="fname">
                </div>

                <div class="form-input">
                    <label>Last Name</label>
                    <input type="text" name="lname" id="lname">
                </div>

                <div class="form-input">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile" id="mobile">
                </div>

                <div class="form-input">
                    <label>Address</label>
                    <input type="text" name="address" id="address">
                </div>
                
                <button type="submit" name="add">Create new account</button>
            </form>
        </div>
    </div>
    
</body>
</html>