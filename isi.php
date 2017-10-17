<?php
session_start();
 header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
    <link href="img-conf/pagination.css" rel="stylesheet" type="text/css" /><!--pagination-css-->
    <link href="img-conf/grey.css" rel="stylesheet" type="text/css" /><!--pagination-css-->
    <link href="img-conf/menu-isi.css" rel="stylesheet" type="text/css" />
    <link href="img-conf/newcari.css" rel="stylesheet" type="text/css" />

    <!--//==================================-->
    <script src="img-conf/caribox.js"></script>
    <style>
      .hid{
        visibility: hidden;
      }
      .hidx{
        border: 1px;
        background-color: red;
        height: 10%;
        width: 50%;
      }
    </style>
    <script>
    function catat(kd,t,a,b,k) {
			document.getElementById("vdua").src = "temp.php?kd="+kd+"&tb="+t+"&noa="+a+"&nob="+b+"&k="+k;
			//return alert('Halo = '+kd+', Halo = '+a+', dan Halo = '+b+', dan Halo = '+k);
		}
    </script>
</head>
<body>
<?php
	include 'conf.php';
  include_once ('pagin.php');

	if (isset($_GET['b']) && isset($_GET['k']) && isset($_GET['t']))
	{
		$bb=$_GET["b"];
		$kt=$_GET["k"];
		$tb=$_GET["t"];
		echo getisibab($tb,$kt,$bb);
    #unset($_SESSION["sr"]); //--UNTUK-RESET-VAR-KIRIMIMAN-DARI-QURAN-PAGE
                            //--KALAU-TIDAK-DIRESET-NUMPUK-HADITS-NYAMBUNG-DENGAN-QURAN
	}
	if (isset($_GET['k']) && isset($_GET['t']) && empty($_GET['b']))
	{
		$kt=$_GET["k"];
		$tb=$_GET["t"];
		echo getisikitab($tb,$kt);
    #unset($_SESSION["sr"]); //--UNTUK-RESET-VAR-KIRIMIMAN-DARI-QURAN-PAGE
                            //--KALAU-TIDAK-DIRESET-NUMPUK-HADITS-NYAMBUNG-DENGAN-QURAN
	}
  #---CETAK-ALQURAN
  if (isset($_GET['sura'])){$_SESSION["sr"] = $_GET['sura'];}
  if ((isset($_GET['sura'])) || (!empty($_SESSION["sr"])))
  {
    $sno = $_SESSION["sr"];
    quranpersurat("quran_text",$sno);
  }
  echo '<iframe name="vdua" id="vdua" src="temp.php" background-color="red" class="hid"></iframe>';

?>

</body>
</html>
