<!DOCTYPE html>
<html>
<meta charset="utf-8" />
<?php
  session_start();
  	header('Content-Type: text/html; charset=utf-8');
    include_once ('conf.php');
    include_once ('pagin.php');
    $tb0 ="quran_text";
    $tb1 ="tbukhari1";
    $tb2 ="tmuslim2";
    $tb3 ="tabudaud3";
    $tb4 ="ttirmidzi4";
    $tb5 ="tnasai5";
    $tb6 ="tibnumajah6";
    $tb7 ="tahmad7";
    $tb8 ="tmalik8";
    $tb9 ="tdarimi9";

?>

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
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    //==================================

    //=====HIDE RIGH MENU AND SHOW=======q=='search...' || q==""
</script>
<!--<div class="home"><b><a href="temp.php?cc=quran" target="vdua">C-Cache</a></b></div>-->

<div class="fbox" border="1">
  <form method="POST" action="newcari.php" >
    <input type="text" SIZE="40" name="car">
    <!--<input type="text" SIZE="40" name="car" placeholder="Search..." required>-->
    <input type="submit" name="bcari" value="Cari" class="button">
  </form>

</div>
<!--====START TAB AND TAB CONTENT============-->
<br>
<div class="home"><b><a href="myhadits9.php?id=quran">Kembali ke Halaman Utama</a></b></div>
<br><br>
<div class="taball">
  <?php

      if (isset($_POST["q"])){$_SESSION["q"] = $_POST["q"];}
      if ((isset($_POST["car"])) && (!empty($_POST["car"])))
      {$_SESSION["q"] = $_POST["car"];}
      if (isset($_POST["bcari"]) || (!empty($_SESSION["q"])))
      {
        if ($_SESSION["q"] !== NULL){$cr = $_SESSION["q"];}
        $cr = str_replace(' ', '%', $cr);

        $jd1=hitungdata($tb1,$cr);
        $jd2=hitungdata($tb2,$cr);
        $jd3=hitungdata($tb3,$cr);
        $jd4=hitungdata($tb4,$cr);
        $jd5=hitungdata($tb5,$cr);
        $jd6=hitungdata($tb6,$cr);
        $jd7=hitungdata($tb7,$cr);
        $jd8=hitungdata($tb8,$cr);
        $jd9=hitungdata($tb9,$cr);
        $jd0=hitungdataquran($tb0,$cr);

        $jdt=0;
        for ($c=0; $c<=9; $c++){
          $tbl= ${'jd'.$c};
          $jdt = $jdt+$tbl;
    			if ($tbl >= 1)
          {
            $tbx=${'tb'.$c};
            $_SESSION['tbif'] = $tbx;
            break;
          }
    		}
        ?>

        <ul class="tab">
          <?php
            if ((!empty($jd0)) && ($jd0 >= 1)){
            ?>
            <li><a href="newcaritemp.php?tb=quran_text"  target="vsatu" class="tablinks" onclick="openCity(event, 'quran_text')">Al-Quran - [<?php echo $jd0;?>]</a></li>
            <?php
            }
            if ($jd1 >= 1){
            ?>
            <li><a href="newcaritemp.php?tb=tbukhari1"  target="vsatu" class="tablinks" onclick="openCity(event, 'tbukhari1')">Bukhari - [<?php echo $jd1;?>]</a></li>
            <?php
            }
            if ($jd2 >= 1){
            ?>
            <li><a href="newcaritemp.php?tb=tmuslim2"  target="vsatu" class="tablinks" onclick="openCity(event, 'tmuslim2')">Muslim - [<?php echo $jd2;?>]</a></li>
            <?php
            }
            if ($jd3 >= 1){
            ?>
            <li><a href="newcaritemp.php?tb=tabudaud3"  target="vsatu" class="tablinks" onclick="openCity(event, 'tabudaud3')">Abu Daud - [<?php echo $jd3;?>]</a></li>
            <?php
            }
            if ($jd4 >= 1){
            ?>
            <li><a href="newcaritemp.php?tb=ttirmidzi4"  target="vsatu" class="tablinks" onclick="openCity(event, 'ttirmidzi4')">Tirmidzi - [<?php echo $jd4;?>]</a></li>
            <?php
            }
            if ($jd5 >= 1){
            ?>
            <li><a href="newcaritemp.php?tb=tnasai5"  target="vsatu" class="tablinks" onclick="openCity(event, 'tnasai5')">Nasai - [<?php echo $jd5;?>]</a></li>
            <?php
            }
            if ($jd6 >= 1){
            ?>
            <li><a href="newcaritemp.php?tb=tibnumajah6"  target="vsatu" class="tablinks" onclick="openCity(event, 'tibnumajah6')">Ibnu Majah - [<?php echo $jd6;?>]</a></li>
            <?php
            }
            if ($jd7 >= 1){
            ?>
            <li><a href="newcaritemp.php?tb=tahmad7"  target="vsatu" class="tablinks" onclick="openCity(event, 'tahmad7')">Ahmad - [<?php echo $jd7;?>]</a></li>
            <?php
            }
            if ($jd8 >= 1){
            ?>
            <li><a href="newcaritemp.php?tb=tmalik8"  target="vsatu" class="tablinks" onclick="openCity(event, 'tmalik8')">Malik - [<?php echo $jd8;?>]</a></li>
            <?php
            }
            if ($jd9 >= 1){
            ?>
            <li><a href="newcaritemp.php?tb=tdarimi9"  target="vsatu" class="tablinks" onclick="openCity(event, 'tdarimi9')">Darimi - [<?php echo $jd9;?>]</a></li>
            <?php
            }
            ?>
        </ul>

    <?php

      if ($jdt >= 1) {
        $lnk = $_SESSION['tbif'];
        echo '<iframe src="newcaritemp.php?tb='.$lnk.'" name="vsatu" class="ifcari">';

        echo '</iframe>';
      }else {
        echo '<div class=notf id="qdiv" style="display:block">';
        echo "<br><center><h1>$jdt Data Found <b>$cr</b></h1></center><br>";
        #echo "<div class=notf><center><h1>Not Found <b>$cr</b></h1></center></div>";
        echo '</div>';
      }
}else {
  echo "<br><center><h1>Tidak Ada Data yang DiCari </h1></center>";
  #echo "<center><h1>Waktu Tunggu Habis 0:0</h1></center><br>";
}
echo '</div>';

?>

</body>
</html>
