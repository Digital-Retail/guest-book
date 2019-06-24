<?php
$status = <<<"EOT"
<div class="info alert alert-info">
				Запись успешно сохранена!
			</div>
EOT;
if(!empty($_POST['author']) && !empty($_POST['message']) ) {
$author=htmlspecialchars($_POST['author']);
$message=htmlspecialchars($_POST['message']);
$post= createPost($author, $message);
file_put_contents('base.txt', $post, FILE_APPEND);	
header('Location:/?write=Okey');
exit;
}
function createPost($author,$message) {
$time=date("F j, Y, H:i:s");
$post = <<<"EOT"
<div class='note'>
				<p>
					<span class='date'>$time</span>
					<span class='name'>Автор: {$author}</span>
				</p>
				<p>
				{$message}
				</p>
			</div>	
EOT;


	return $post;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">  
		<title>Гостевая книга</title>
		<link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div id="wrapper">
			<h1>Гостевая книга</h1>
			<?php
				if(!empty($_GET['write']) && $_GET['write']==="Okey")
				echo $status;
			?>
				<div id="form">
				<form action="" method="POST">
					<p><input required class="form-control" autocomplete="off" name="author" placeholder="Ваше имя"></p>
					<p><textarea required class="form-control" name="message" placeholder="Ваш отзыв"></textarea></p>
					<p><input type="submit" class="btn btn-info btn-block" value="Сохранить"></p>
				</form>
			</div>

		<?php echo file_get_contents("base.txt"); ?>
		
		
		</div>
</body>
</html>