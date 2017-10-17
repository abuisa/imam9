<body bgcolor="white">
<?php
	if (isset($_POST['q'])){
		$_SESSION['q'] = $_POST['q'];
		$cr = $_POST['q'];}
		echo '<br>';
		
		echo 'Hasil SESSION CR :'.$_SESSION['q'].'<br>';
		echo 'Hasil POST CR :'.$_POST['q'].'<br>';
		echo 'Hasil $CR :'.$cr.'<br>';
		
		
?>		</body>