<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Edit-H9Imam-RM-Sakal</title>
	 <link href="rsakal.css" rel="stylesheet" type="text/css" />
<!--	###----DIV TAB MENU JS dan CSS dibawah ini----##-->
<script src="../img-conf/caribox.js"></script>
<link rel="stylesheet" href="../img-conf/caribox.css" type="text/css" />
<style>
.boknot{
  width: 100%;
  /*height: 86%;*/
	position: sticky;
  background-color: green;
}
</style>
</head>

<body style="font-family:Arial;" bgcolor="#CACFD2" >
<!--===========Div Cari Box Kanan pojok atas=====================-->

<?php
include '../conf.php';
global $link;
?>
<h2>Hapus Sakal Dari teks arab Hadist-9-IMAM </h2>
<form method="POST" action="remove-sakal.php" >
  <table>
   <tr>
   <td>FIND </td><td><input class="tarab" type="text" name="t1" /></td></tr>
   <tr>
   <td>REPLACE</td><td> <input class="tarab" type="text" name="t2" /></td></tr>
   <tr>
   <td> </td>
	 <td>
		 <select name="tbl">
			 <option value="">Pilih --TABEL--</option>
			 <option value="all">ALL Table </option>
			 <option value="tbukhari1">Bukhari 1</option>
			 <option value="tmuslim2">Muslim 2</option>
			 <option value="tabudaud3">Abu Daud 3</option>
			 <option value="ttirmidzi4">Tirmidzi 4</option>
			 <option value="tnasai5">Nasai 5</option>
			 <option value="tibnumajah6">Ibnu Majah 6</option>
			 <option value="tahmad7">Ahmad 7</option>
			 <option value="tmalik8">Malik 8</option>
			 <option value="tdarimi9">Darimi 9</option>
		 </select>&nbsp;&nbsp;
		 <select name="fld">
			 <option value="">Pilih --FIELD COLUMN--</option>
			 <option value="bab">BAB</option>
			 <option value="hindo">Hadist Terjemahan</option>
			 <option value="harab">Hadist Arabic</option>
			 <!--<option value="uarab">Hadist Arabic no Sakal</option>-->
		 </select>
	  </td></tr>
		<tr><td></td><td> <input type="submit" name="rta" value="REPLACE STRING --FIND-- with --REPLACE--" />
			<input type="submit" name="ecd" value="ENCODING STRING --FIND--" />
		</td></tr>
 </table>

   <hr>
  <table>
     <tr><td><input type="submit" name="i1" value="HAPUS tanda Sakal di Tabel IMAM BUKHARI 1" /></td></tr>
     <tr><td><input type="submit" name="i2" value="HAPUS tanda Sakal di Tabel IMAM MUSLIM 2" /></td></tr>
     <tr><td><input type="submit" name="i3" value="HAPUS tanda Sakal di Tabel IMAM ABUDAUD 3" /></td></tr>
     <tr><td><input type="submit" name="i4" value="HAPUS tanda Sakal di Tabel IMAM TIRMIDZI 4" /></td></tr>
     <tr><td><input type="submit" name="i5" value="HAPUS tanda Sakal di Tabel IMAM NASAI 5" /></td></tr>
     <tr><td><input type="submit" name="i6" value="HAPUS tanda Sakal di Tabel IMAM IBNUMAJAH 6" /></td></tr>
     <tr><td><input type="submit" name="i7" value="HAPUS tanda Sakal di Tabel IMAM AHMAD 7" /></td></tr>
     <tr><td><input type="submit" name="i8" value="HAPUS tanda Sakal di Tabel IMAM MALIK 8" /></td></tr>
     <tr><td><input type="submit" name="i9" value="HAPUS tanda Sakal di Tabel IMAM DARIMI 9" /></td></tr>
     <tr><td><input type="submit" name="ix" value="HAPUS tanda Sakal di SEMUA TABEL" /></td></tr>
 </table>
<hr><input type="submit" name="tkolom" value="TAMBAH Kolom uarab For ALL Table" /><br>
<hr><input type="submit" name="ckolom" value="COPY Kolom harab to uarab For ALL Table" /><br>
<hr><input type="submit" name="hkolom" value="HAPUS Kolom harab From ALL Table" /><br>
<br>
<hr>
</form>

<?php
  if (isset($_POST["i1"])){  delsakal1("tbukhari1");
  }elseif(isset($_POST["i2"])){  delsakal1("tmuslim2");
  }elseif(isset($_POST["i3"])){  delsakal1("tabudaud3");
  }elseif(isset($_POST["i4"])){  delsakal1("ttirmidzi4");
  }elseif(isset($_POST["i5"])){  delsakal1("tnasai5");
  }elseif(isset($_POST["i6"])){  delsakal1("tibnumajah6");
  }elseif(isset($_POST["i7"])){  delsakal1("tahmad7");
  }elseif(isset($_POST["i8"])){  delsakal1("tmalik8");
  }elseif(isset($_POST["i9"])){  delsakal1("tdarimi9");
  }elseif(isset($_POST["ix"])){
    delsakalall();
    #echo "<H3>HAPUS tanda Sakal di SEMUA TABEL SUKSESSS....[--NON-AKTIF--]</H3>";
    echo "<H3>HAPUS tanda Sakal di SEMUA TABEL SUKSESSS....!</H3>";
  }elseif (isset($_POST["tkolom"])){
    #tambahkolom();#HAPUS PAGAR UNTUK AKTIFKAN FUNGSI TAMBAH KOLOM.. Hati-Hati !
    echo "<H3>TAMBAH KOLOM --uarab-- SUKSESSS....[--NON-AKTIF--]</H3>";
    echo "aktifkan harus lewat kode..";
  }elseif (isset($_POST["ckolom"])){
    #kopikolomall(); #HAPUS PAGAR UNTUK AKTIFKAN FUNGSI COPY KOLOM.. Hati-Hati !
    echo "<H3>COPY KOLOM --harab-to-uarab-- SUKSESSS....[--NON-AKTIF--]</H3>";
    echo "aktifkan harus lewat kode..";
  }elseif (isset($_POST["hkolom"])){
    #hapuskolom(); #HAPUS PAGAR UNTUK AKTIFKAN FUNGSI HAPUS KOLOM.. Hati-Hati !
    echo "<H3>HAPUS KOLOM --uarab-- SUKSESSS....[--NON-AKTIF--]</H3>";
    echo "aktifkan harus lewat kode..";
  }elseif (isset($_POST["rta"])){
    $ra =$_POST["t1"];
    $rb =$_POST["t2"];
		$tbl=$_POST["tbl"];
		$fld=$_POST["fld"];
    #$tgl = strftime("%F#%T");
		if (!empty($ra) & !empty($rb) & !empty($tbl) & !empty($fld))
		{
			if (!empty($tbl) & $tbl == "all"){
				repairtextall($fld,$ra,$rb);
				kopikolomall();
				delsakalall();
			}else {
				repairtext($tbl,$fld,$ra,$rb);
				kopikolom($tbl);
				delsakal1($tbl);
			}
		}else {
			echo "<h3>LENGKAPI DATA !</h3>";
		}
  }elseif(isset($_POST["ecd"])){
		echo'<div class="fontarab">';
		$ra=$_POST["t1"];
		$rb=$_POST["t2"];
		$pn=basename($_SERVER['PHP_SELF']);
		delsakalstr($ra);
		echo "Nama Surah : ".namasurah($ra)."<br>";
		echo "NOMOR Surah : ".nosurah($rb)."<br>";
		echo "Nama Halaman : ".$pn."<br>";

		echo '<hr>';
		echo  "and a ", 1, 2, 3;   // comma-separated without parentheses
		echo ("and a 123");        // just one parameter with parentheses
		echo "<br>";
		$ra ? print "true" : print "false";

		echo'</div>';
		//-----TES FUNCTION write hadits to file ------------
		
		# $ra = file name : string diambil dari --FIND-- box 
		# $rb = String yang akan ditulis ke file : diambil dari --REPLACE-- box  
		# Sementara di nonaktifkan 
		# wtof($ra,$rb);
		
	}else {
		 echo "NOTHING CLICK....";
  }

?>
<hr>
<!--##############################################-->
<a href=# name=qq onclick=ReverseDisplay('x')>TES Show X</a>

<div class="box" role="alert" style="display:none" id="x">
	<div class="isibox"><a href="#" onclick="HideContent('x')"  class="tutup">
		<img src="../img-conf/close3.png" alt="" class="tutup"></a>
		<?php
		$tdata =base64_encode()

		?>
		asfasdfasdfasdfasfasdfasdfdfasdf
	</div>
</div> <!-- cd-popup -->
<!--===END--TOOLS DIALOGBOX PILIH PENCARIAN=====================-->

<!--##############################################-->
</body>
</html>
