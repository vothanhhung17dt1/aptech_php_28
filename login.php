<?php


$conn = mysqli_connect ('localhost', 'root', '', 'users_data') or die ('Không thể kết nối tới database');
mysqli_set_charset($conn, 'UTF8');


session_start();
if (isset($_SESSION['username'])){
unset($_SESSION['username']);
}


if (isset($_POST['login'])) {

$username = addslashes($_POST['username']);
$password = addslashes($_POST['password']);

if (!$username || !$password) {
echo "Nhập đầy đủ thông tin <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}




$query = "SELECT username, password FROM users WHERE username='$username'";

$result = mysqli_query($conn, $query) or die( mysqli_error($conn));

$row = mysqli_fetch_array($result);


if ($password != $row['password']) {
echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
exit;
}


$_SESSION['username'] = $username;
echo "Xin chào <b>" .$username . "</b>. Bạn đã đăng nhập thành công. <a href=''>Thoát</a>";
die();
$connect->close();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="style.css"/>
</head>
<body>
<form action='<?php ($_SERVER['PHP_SELF'])?>' class="dangnhap" method='POST'>
Tên đăng nhập : <input type='text' name='username' />
Mật khẩu : <input type='password' name='password' />
<input type='submit' class="button" name="login" value='Đăng nhập' />
<form>
<p>Bạn chưa có tài khoản? <a href='register.php'>Đăng ký ngay</a></p><br/>
</body>
</html>