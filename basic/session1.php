<?php
    session_start();

    $username = $_POST['username'];

    // echo $userName;
    $_SESSION['uName'] = $username;

?>

<form action="session1.php" method="post">
        Username: <input type="text" name="username" >
        <input type="submit" value="OK">
</form>