<?php
/**
 * @link: http://www.Awcore.com/dev
 */
    //connect to the database
    session_start();
    include_once ('conf.php');
    include_once ('pagin.php');

  	$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
  	$limit = 12;
  	$startpoint = ($page * $limit) - $limit;

    if (isset($_SESSION['id']) && !empty($_SESSION['id'])){$tb = $_SESSION['id'];} else {$tb = 'tbukhari1';} //get and save table name
		if (isset($_POST['q'])){$_SESSION['q'] = $_POST['q'];}  //get and save text to search...
		//if (isset($_SESSION['cradio']) && empty($_SESSION['cradio'])){$_SESSION['cradio']='hindo';}

		if (!empty($_SESSION['q']))
    {
			if (!empty($_SESSION['cradio'])){$kt = $_SESSION['cradio'];}else {$kt='hindo';}
			$cr = trim($_SESSION['q']); //get text to search from session...
      $cr = str_replace(' ', '%', $cr);
      //to make pagination
      /*
      $statement = "shoutbox WHERE (name LIKE '%$search%' OR foo LIKE '%$search%' OR bar LIKE '%$search%' OR baz LIKE '%$search%')"
      col = `uarab``harab``hindo``bab``kitab``sumber``no`
      */
      $statement = "`$tb` WHERE (no LIKE '$cr' OR kitab LIKE '%$cr%' OR bab LIKE '%$cr%' OR hindo LIKE '%$cr%' OR harab LIKE '%$cr%' OR uarab LIKE '%$cr%') ORDER BY no ASC ";
      #$statement = "`$tb` where `$kt` LIKE '%$cr%' ORDER BY no ASC ";
      #$statement = "`$tb` where `$kt` LIKE '%$cr%' ORDER BY no ASC "; # ORIGINAL

      //$statement = "`$tb` where `$kt` LIKE '%$cr%' OR `$kt` LIKE '%$cr1%' ORDER BY no ASC ";
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Pagination</title>
	<!--<meta http-equiv="content-type" content="text/html; charset=utf-8" />-->
  <link href="img-conf/menu-isi.css" rel="stylesheet" type="text/css" />
	<link href="img-conf/pagination.css" rel="stylesheet" type="text/css" /><!--pagination-css-->
	<link href="img-conf/grey.css" rel="stylesheet" type="text/css" /><!--pagination-css-->
	<script src="img-conf/caribox.js"></script>
  <link href="img-conf/cari.css" rel="stylesheet" type="text/css" />
<!--==============FUNGSI WARNA BARIS TABEL I============================-->
</head>
<body>
<name="top">
      <?php

        echo "<div class=jd>$statement</div>";

        $total = hitungdata($tb,$cr);
        echo "<div class=jd>Imam ".gtba($tb).", Ditemukan <b>$total</b> Hadits untuk kata <b>".$_SESSION['q']."</b></div>";

        if (!empty($_SESSION['q'])){
        echo '<div class="pgn">'.pagination($statement,$limit,$page).'</div>';
            //show records
            $i = ($limit * $page) - $limit;
            $sqlstr= "SELECT * FROM {$statement} LIMIT {$startpoint} , {$limit}";
            $query = mysqli_query($link,$sqlstr);
            while ($row = mysqli_fetch_assoc($query)) {
              //--------------------------
              $i = $i+1;
              $cr = str_replace('%', ' ', $cr);
              $acr = explode(' ', $cr);
              $jm=count($acr);
              //-----------------------------------------------------
              $fl1 = $row['no'];
              $fl2 = $row['kitab'];
              $fl3 = $row['bab'];
              $fl4 = $row['hindo'];
              $fl5 = $row['harab'];
              $fl6 = $row['uarab'];
              //-----------------------------------------------------
              for ($x = 0; $x < $jm; $x++)
              {
                  $fl1 = str_ireplace($acr[$x], cc($acr[$x]), $fl1);
                  $fl2 = str_ireplace($acr[$x], cc($acr[$x]), $fl2);
                  $fl3 = str_ireplace($acr[$x], cc($acr[$x]), $fl3);
                  $fl4 = str_ireplace($acr[$x], cc($acr[$x]), $fl4);
                  $fl5 = str_ireplace($acr[$x], cc($acr[$x]), $fl5);
                  $fl6 = str_ireplace($acr[$x], cc($acr[$x]), $fl6);
              }
              ?>
            <a onclick="RDisplay('<?php echo $row['no'];?>');">
              <div class="record round" id="C<?php echo $row['no'];?>" >
  	            <table width="100%" border="0">
      						<tr>
      							<td class="no"> <?php echo $i;?></td>
      							<td class="sub"><?php echo $row['sumber'];?></td>
      							<td class="noh">No.<?php echo $fl1;?></td>
      							<td class="ktb"><?php echo $fl2;?></td>
      							<td class="bab"><?php echo $fl3;?></td>
      							<td class="icon"><img id="X<?php echo $row['no'];?>" src="img-conf/min.png" /></td>
      						</tr>
  					    </table>
              </div>
            </a>
            <?php
              echo'<div id="'.$row['no'].'" style="display:block" class="hrow"><table  border="0">'; # kontent langsung terbuka
              #echo'<div id="'.$row['no'].'" style="display:none" class="hrow"><table><tr>'; # kontent tersembunyi click untuk buka
              echo '<tr><td rowspan="2" class="tindo">'.$fl4.'</td><td class="tarab">'.$fl5.'</td></tr>';
    					//echo '<td class="tindo">'.$fl4.'</td><td class="tarab">'.$row['harab'].'</td>';
              echo '<tr><td class="tuarab">';
              echo '----------------------------------------<br>'.$fl6.'</td></tr>';
     					echo '</table>';
 			 		    echo '</div>';
            }
          }	// end of while ($row...
          #echo '<div class="pgn">'.pagination($statement,$limit,$page).'</div>';
          ?>
  <!--<iframe src="temp.php" name="temp" frameBorder="1" id="temp" style="display:none"></iframe>-->
<a href="#top"><div class="top">Kembali</div></a>
<?php
  echo '<div class="pgn">'.pagination($statement,$limit,$page).'</div>';
  echo "<div class=jd>Imam ".gtba($tb).", Ditemukan <b>$total</b> Hadits untuk kata <b>".$_SESSION['q']."</b></div>";
?>
</body>
</html>
