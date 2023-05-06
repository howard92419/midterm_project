<?php
//登入頁面

// Start the session
session_name('homework');
session_start();

?>


<html>
<head>
    <title>Login </title>
</head>
<body>

    <form name="form1" method="post" action="check.php" >
    請輸入學號: <br> <input name="MyHead">

    <br>

    <form name="form2" method="post" action="check.php" >
    請輸入密碼: <br> <input name="password">

    <br>
    <br>
    <input type="submit" value="登入">
    </form>

</body>


