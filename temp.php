<?php
session_start();
include 'conf.php';
#-------------------------------
#echo "<h2>TESS</h2>";
#--------------------------------
      if ((isset($_GET['kd'])) && isset($_GET['k']))
      {
        $kd  = $_GET['kd'];
        $tb  = gtba($_GET['tb']);
        $noa  = $_GET['noa'];
        $nob  = $_GET['nob'];
        $k   = $_GET['k'];
        /*
        if (is_numeric($_GET['noa']))
        {
          $noa  = $_GET['noa'];
        }else {
          $noa  = "tes-NOA";
        }
        */
        if (($kd == "QC") || ($kd == "HC")) # Save-Log- CARI- Quran dan Hadits : FIX-OK.
        {
          $ket = "Cari : ".$k;
          savelog($tb,$noa,$nob,$ket);
          echo '<h3>Hasil KD :'.$kd.' # TB :'.$tb.' # NOa :'.$noa.' # NOb :'.$nob.' # '.$ket.'</h3>';
        }
        if ($kd == "Q") # OK-FIX-: AyatBrowsing & SurahBrowsing
        {
          $ket = $k;
          savelog($tb,$noa,$nob,$ket);
          echo '<h3>Hasil KD X :'.$kd.' # TB :'.$tb.' # NOa :'.$noa.' # NOb :'.$nob.' # '.$ket.'</h3>';
        }
        if ($kd == "H") # Hadits FIX
        {
          $ket = $k;
          savelog($tb,$noa,$nob,$ket);
          echo '<h3>Hasil KD :'.$kd.' # TB :'.$tb.' # NOa :'.$noa.' # NOb :'.$nob.' # '.$k.'</h3>';
        }
      }
      if (isset($_GET['btn'])){
        $kd  = $_GET['kd'];
        $tb  = $_GET['tb'];
        $no  = $_GET['no'];
        $dat  = $_GET['dat'];
        if ((!empty($dat)) && ($kd == "N")) {
          #//echo '<hr><h2>xNOTE---CLICK, Hasil KD :'.$kd.'</h2>';
          setbookmarknote($kd,$tb,$no,$dat);
        }else {
          echo '<h3>NOTE---CLICK, KOSONG data </h3>';
        }
      }
      if ((isset($_GET['kd'])) && ($_GET['kd'] == "B")){
        $kd  = $_GET['kd'];
        $tb  = $_GET['tb'];
        $no  = $_GET['no'];
        $dat = "";
        if ($kd == "B") {
          #echo '<hr><h3>BOOKMARK---CLICK, Hasil KD :'.$kd.'</h3>';
          echo '<h3>BOOKMARK---CLICK, Hasil KD :'.$kd.', TB : '.$tb.'</h3>';
          setbookmarknote($kd,$tb,$no,$dat);
        }else {
          echo '<h3>BOOKMARK---CLICK, KOSONG data </h3>';
        }
      }

?>
