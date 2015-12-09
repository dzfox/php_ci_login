<form action="" method="POST">
	<?php echo 'Username:<br>'.$provera['1']['username'].'<br>';
	      echo 'Password:<br>'.$provera['1']['password'].'<br>';
		  echo $provera['1']['remember'].'Zapamti me<br>';?>
	<input type="submit" name="login[sub]" value="Log in">
</form>
<?php echo $provera['0'];