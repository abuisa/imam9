<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<?php
	session_start();
	header('Content-Type: text/html; charset=utf-8');
	include 'conf.php';
	if (isset($_GET['cr'])){
		$_SESSION['cr'] = $_GET['cr'];
		$cr = $_GET['cr'];
	}
	if (isset($_GET['id'])){
		$_SESSION['id'] = $_GET['id'];
		$id=$_GET['id'];
	}
	function cbok($v) {
		if (!empty($_SESSION['cradio'])){
		if ($_SESSION['cradio'] == $v){return('checked="checked"');}else {return("");}}
	}
	function cbok1($a) {
		if (!empty($_SESSION['imam9'])){
		if ($_SESSION['imam9'] == $a){return('checked="checked"');}else {return("");}}
	}
?>
<title>Kitab-Hadits-9-Imam</title>

	 <link href="img-conf/menu-isi.css" rel="stylesheet" type="text/css" />
	 <link href="img-conf/newcari.css" rel="stylesheet" type="text/css" />
	<!--###----DIV TAB MENU JS dan CSS dibawah ini----##-->
    <script src="img-conf/tabcontent.js" type="text/javascript"></script>
    <link href="img-conf/tabcontent.css" rel="stylesheet" type="text/css" />
<!--###----Cari BOX JS dan CSS dibawah ini----##-->
   <script src="img-conf/caribox.js"></script>
	<link rel="stylesheet" href="img-conf/caribox.css" type="text/css" />
<!--###----Cari BOX JS dan CSS dibawah ini----##-->
<!--==============FUNGSI WARNA BARIS TABEL I============================-->
	<script type="text/javascript">
		var prevRow = null;
		var prevColor = null;
		function togge(it) {
		  if (prevRow != null)
			{prevRow.style.backgroundColor = prevColor;}
		  prevRow = it;
		  prevColor = it.style.backgroundColor;
		  if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == ""))
			{
				it.style.backgroundColor = "hsla(255, 100%, 100%, 0.0)";
				it.style.color="white";}
		  else{
			it.style.backgroundColor = "";}
		}
		//=========disable action on tools click========================
		function catat(kd,t,a,b,k) {
			document.getElementById("vdua").src = "temp.php?kd="+kd+"&tb="+t+"&noa="+a+"&nob="+b+"&k="+k;
			//return alert('Halo = '+kd+', Halo = '+a+', dan Halo = '+b+', dan Halo = '+k);
			//window.location.href="temp.php?no="+b;
			//$('#vdua').load("temp.php?no="+b);
		}
		function tes(){
			alert('TES');
		}
	</script>

<!--===============END FUNGSI WARNA BARIS TABEL I========================-->
<style>
	.hid{
	  visibility: hidden;
	}
	.hidx{
	  border: 1px;
	  background-color: red;
	  height: 50%;
	  width: 50%;
		top: 50%;
	}
</style>
</head>
<?php
	$_SESSION['warnabg'] = "#8B5969";
	#echo '<body style="font-family:Arial;" bgcolor="black"> '; # Hitam
	#echo '<body style="font-family:Arial;" bgcolor="#8B0000"> '; # Merah Marun
	#echo '<body style="font-family:Arial;" bgcolor="#660000"> '; # Merah Marun --ok--
	#echo '<body style="font-family:Arial;" bgcolor="#8B7D7B"> '; # GREY
	#echo '<body style="font-family:Arial;" bgcolor="#2F4F4F"> '; # BIRU TUA MUDA --ok--
	#echo '<body style="font-family:Arial;" bgcolor="#525C65"> '; # BIRU GREY --ok--
	#echo '<body style="font-family:Arial;" bgcolor="#8B5969"> '; # PINK TUA- Warna CEKWEK
	echo '<body style="font-family:Arial;" bgcolor="'.$_SESSION['warnabg'].'"> '; # PINK TUA- Warna CEKWEK
?>

<!--===========Div Cari Box Kanan pojok atas=====================-->
	<div class="SearchTextBox">
     	<div class="searchbox">
      <form name="myForm" onsubmit="return validateForm()"  action="newcari.php" method="POST">
			<input name="q" id="q" maxlength="80" alt="search" class="inputbox" value="search..." onblur="if(this.value=='') this.value='search...';" onfocus="if(this.value=='search...') this.value='';" type="text">
      	<input class="btn-search" onclick="if(document.getElementById('q').value!='' &amp;&amp; document.getElementById('q').value!='search...') search_submit();" href src="img-conf/edit-find.png" type="image">&nbsp;
         <input name="qq" class="btn-search" onclick="ReverseDisplay('x');tes()" src="img-conf/tols.png" type="image">
      	</form>
      </div>
	</div>
<!--===========END Div Cari Box Kanan pojok atas=====================-->
<!--===========DIV Tab Menu=====================-->
    <div style="width: 96%; margin: 0 auto; padding: 10px 0 40px;">
        <ul class="tabs" data-persist="true">
						<li><a href="#quran" onclick="getx('quran')">Al-Quran</a></li>
            <li><a href="#view1" onclick="getx('tbukhari1')">Bukhari</a></li>
            <li><a href="#view2" onclick="getx('tmuslim2')">Muslim</a></li>
            <li><a href="#view3" onclick="getx('tabudaud3')">Abudaud</a></li>
            <li><a href="#view4" onclick="getx('ttirmidzi4')">Tirmidzi</a></li>
            <li><a href="#view5" onclick="getx('tnasai5')">Nasai</a></li>
            <li><a href="#view6" onclick="getx('tibnumajah6')">Ibnumajah</a></li>
            <li><a href="#view7" onclick="getx('tahmad7')">Ahmad</a></li>
            <li><a href="#view8" onclick="getx('tmalik8')">Malik</a></li>
            <li><a href="#view9" onclick="getx('tdarimi9')">Darimi</a></li>
            <!--<li><a href="#view0" onclick="Hidemenu('rmenu','vsatu')">to Search</a></li>-->
        </ul>
        <div class="tabcontents">
					<div id="rmenu">
						<?php
						if (isset($id) ){
							if($id=="quran"){
							?>
        			<div id="hdkitab">Nama Surah</div>
            	<div class="dmenu">
							<?php
									#echo "<h1>Quran</h1>";
									cetaksurahlist();
								}else {
									?>
									<div id="hdkitab">KITAB dan BAB</div>
		            	<div class="dmenu">
									<?php
									unset($_SESSION["sr"]); //--UNTUK-RESET-VAR-KIRIMIMAN-DARI-QURAN-PAGE
									                        //--KALAU-TIDAK-DIRESET-NUMPUK-HADITS-NYAMBUNG-DENGAN-QURAN
									getkitab($id);

								}
							}else{
								echo '<div id="hdkitab">Nama Surah</div>';
								echo '<div class="dmenu">';
								cetaksurahlist();
							}
							echo '<iframe name="vdua" id="vdua" src="temp.php" background-color="red" class="hid"></iframe>';

							?>
            	</div>
            	</div>
					<?php
						if (!empty($_SESSION['id'])){
							$sid=$_SESSION['id'];
							if ($sid=="quran"){
								$lnk='isi.php?sura=1';
							}else{
								$lnk='isi.php';
							}
							echo '<iframe src="'.$lnk.'" name="vsatu" frameborder="1" id="vsatu">	</iframe>';
						}#else{
						$alr = "$_SERVER[REQUEST_URI]";
						if ((empty($_SESSION['id'])) || ($alr=="/H9X/myhadits9.php")){
							$lnk='isi.php?sura=1';
							#if ($alr=="/H9X/myhadits9.php"){
							echo '<iframe src="'.$lnk.'" name="vsatu" frameborder="1" id="vsatu">	</iframe>';
							#}

						}

					?>
					<!--<iframe src="" name="vsatu" frameborder="1" id="vsatu">	</iframe>-->

					<a id="view1"> </a>					<a id="view2"> </a>
					<a id="view3"> </a>					<a id="view4"> </a>
					<a id="view5"> </a>					<a id="view6"> </a>
					<a id="view7"> </a>					<a id="view8"> </a>
					<a id="view9"> </a>					<a id="quran"> </a>
        </div>
    </div>
<!--===TOOLS DIALOGBOX PILIH PENCARIAN=====================-->
<div class="boxconf" role="alert" style="display:none" id="x">
	<div class="isibox"><a href="#" onclick="HideContent('x')"  class="tutup">
		<img src="img-conf/close3.png" alt="" class="tutup"></a>
		<form action="#" method="post">
		<input type="radio" name="check" value="no" <?php echo cbok("no");?> > <label>Cari Berdasarkan NO Hadits</label><br/>
		<input type="radio" name="check" value="kitab" <?php echo cbok('kitab');?> ><label>Cari Berdasarkan KITAB Hadits</label><br/>
		<input type="radio" name="check" value="bab" <?php echo cbok('bab');?> ><label>Cari Berdasarkan BAB Hadits</label><br/>
		<input type="radio" name="check" value="hindo" <?php echo cbok('hindo');?> ><label>Cari Berdasarkan TERJEMAHAN Hadits</label><br/>
		<input type="radio" name="check" value="uarab" <?php echo cbok('uarab');?> ><label>Cari Berdasarkan TEKS ARAB Hadits</label><br/>
		<hr>
		<input type="checkbox" name="check9" value="all" <?php echo cbok1('all');?> ><label>Cari di SEMUA 9 Sumber</label><br/>
		<br>
		<input onclick="rfs()" type="submit" name="submit" value="Apply"/>
		<input type="submit" name="delle" value="DESTROY"/>
		<input type="submit" onclick="rfs()" value="Refresh">
		</form>
		<?php
		$pn=basename($_SERVER['PHP_SELF']);
		$alr = "$_SERVER[REQUEST_URI]";
		$al = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$ids=$_SESSION['id'];
		#if($_SESSION['id'] === NULL ){exit;} else {$ids=$_SESSION['id'];}
		echo "<br>";
		echo "ID : ".$ids."<br>";
		echo "LNK : $lnk<br>";
		echo "Page : $pn<br>";
		echo "URL : $al<br>";
		echo "URL : $alr<br>";

		//-------------------------------------------------------
			if(isset($_POST['submit'])){
				if(!empty($_POST['check'])){$_SESSION['cradio'] 	= $_POST['check'];} else {$_SESSION['cradio']='hindo';}
				if(!empty($_POST['check9'])){$_SESSION['imam9'] 	= $_POST['check9'];} else {$_SESSION['imam9']=null;}
				}
			if(isset($_POST['delle'])){
				echo'Hapus SESSION........<br>';
				session_destroy();
	    	session_unset();
			}
		?>
	</div>
</div> <!-- cd-popup -->
<!--===END--TOOLS DIALOGBOX PILIH PENCARIAN=====================-->

</body>
</html>
