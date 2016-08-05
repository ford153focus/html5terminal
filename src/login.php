<!DOCTYPE html>
<html>
<head>
	<title>Remote Console</title>
	<meta content="text/html" charset="utf-8">
</head>
<body>
<?php if ((isset($_POST["pw"])) && ($_POST["pw"] != $password)): ?><p>wrong password</p><?php endif; ?>
<form action="<?= $_SERVER['REQUEST_URI'] ?>" method=post>
	<input type="text" name="password" placeholder="password" autofocus>
	<input type="submit">
</form>
</body>
</html>