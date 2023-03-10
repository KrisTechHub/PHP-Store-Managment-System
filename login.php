<?php

require_once('storeclass.php');
$store->login();


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
    <div class="container">
        <div class="form-container">
            <form action="" method="post">
                <div class="form-input">
                    <label>Email</label>
                    <input type="email" name="email" id="email" autocomplete="off">
                </div>

                <div class="form-input">
                    <label>Password</label>
                    <input type="password" name="password" id="password">
                </div>

                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>

