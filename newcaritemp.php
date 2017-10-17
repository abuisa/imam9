<?php
  session_start();
    include_once ('conf.php');
    include_once ('pagin.php');
?>
    <!DOCTYPE html>
    <html>
        <script src="img-conf/caribox.js"></script>

        <link href="img-conf/menu-isi.css" rel="stylesheet" type="text/css" />
        <link href="img-conf/newcari.css" rel="stylesheet" type="text/css" />
        <link href="img-conf/pagination.css" rel="stylesheet" type="text/css" /><!--pagination-css-->
        <link href="img-conf/grey.css" rel="stylesheet" type="text/css" /><!--pagination-css-->
    <title>Kitab-Hadits-9-Imam</title>
    <?php
        if (!empty($_SESSION['warnabg'])){
          echo '<body style="font-family:Arial;" bgcolor="'.$_SESSION['warnabg'].'"> '; # PINK TUA- Warna CEKWEK
        }else { echo '<body style="font-family:Arial;" bgcolor="grey"> '; # PINK TUA- Warna CEKWEK
        }
    ?>
    <script>
        function RDisplay(d) {
            if(document.getElementById(d).style.display == "none") {
            document.getElementById("X"+d).src = "img-conf/min.png";
            document.getElementById("C"+d).style.borderBottom ="0px solid #B6B6B6";
            //document.getElementById("C"+d).style.borderLeft = "1px solid #B6B6B6";
            document.getElementById(d).style.display = "block"; }
            else {
            document.getElementById("X"+d).src = "img-conf/plus.png";
            document.getElementById("C"+d).style.borderBottom ="1px solid #B6B6B6";
            //document.getElementById("C"+d).style.borderLeft = "0px solid #B6B6B6";
            document.getElementById(d).style.display = "none"; }
        }
        //=====tidak dipakai==""
        function catat(kd,t,a,b,k) {
          //return alert('Halo '+a+', dan Halo'+b)
          document.getElementById("vdua").src = "temp.php?kd="+kd+"&tb="+t+"&noa="+a+"&nob="+b+"&k="+k;
        	//window.location.href="temp.php?no="+b;
          //$('#vdua').load("temp.php?no="+b);
        }
        //=======TANTAI BOOKMARK DAN BUAT CATANAN================

    </script>
    <!--====START TAB AND TAB CONTENT============-->
    <?php

    if ((!isset($_SESSION['q'])) && (empty($_SESSION['q']))){
        echo "<br><center><h1>Tidak Ada Data yang Ditampilkan</h1></center>";
        echo "<center><h1>Waktu Tunggu Habis 0:0</h1></center><br>";
      }else{
    #if ($_SESSION['q'] != NULL){
      $cr=$_SESSION['q'];
      if (isset($_GET["tb"])){$_SESSION['tb'] = $_GET["tb"];}
      $tb = $_SESSION['tb'];
      $dt = $_SESSION['tbif'];

      #echo "<h1>Data TB : $cr</h1>";
      #echo "<h1>Data TB : $tb</h1>";
      #echo "<h1>Data DT : $dt</h1>";
      if (isset($dt)) {
        if ($tb=="quran_text")
        {
          cetakdataqurancari($tb,$cr);
        }else {
          cetakdatacari($tb,$cr);
        }
      }
    }
    echo '<iframe name="vdua" id="vdua" src="temp.php" background-color="red" class="hid"></iframe>';

     ?>
    </body>
    </html>
