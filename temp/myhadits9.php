<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include 'conf.php';
	if (isset($_GET['cr'])){$_SESSION['cr'] = $_GET['cr'];}
	if (isset($_GET['id'])){
		$_SESSION['id'] = $_GET['id'];
		$id=$_GET['id'];
	}
?>
<title>Kitab-Hadits-9-Imam</title>
	 <link href="img-conf/menu-isi.css" rel="stylesheet" type="text/css" />
<!--	###----DIV TAB MENU JS dan CSS dibawah ini----##-->
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
				it.style.color="white";
			}
		  else
			{
				it.style.backgroundColor = "";
			}
		}
		//=========disable action on tools click========================
	</script>	
<!--===============END FUNGSI WARNA BARIS TABEL I========================-->
</head>

<body style="font-family:Arial;" background="img-conf/bgpage2.jpg">
<!--===========Div Cari Box Kanan pojok atas=====================-->
	<div class="SearchTextBox">	
     	<div class="searchbox">
      	<form name="myForm" onsubmit="return validateForm()"  action="pagination/index.php" method="POST" target="vsatu">
			<input name="q" id="q" maxlength="80" alt="search" class="inputbox" value="search..." onblur="if(this.value=='') this.value='search...';" onfocus="if(this.value=='search...') this.value='';" type="text">
      	<input class="btn-search" onclick="if(document.getElementById('q').value!='' &amp;&amp; document.getElementById('q').value!='search...') search_submit();" href src="img-conf/edit-find.png" type="image">&nbsp;
         <input name="qq" class="btn-search" onclick="ReverseDisplay('x')" src="img-conf/tols.png" type="image">
      	</form>
      </div>
	</div>
<!--===========END Div Cari Box Kanan pojok atas=====================-->

<!--===========DIV Tab Menu=====================-->
    <div style="width: 96%; margin: 0 auto; padding: 10px 0 40px;">
        <ul class="tabs" data-persist="true">
            <li><a href="#view1" onclick="getx('tbukhari1')">Bukhari</a></li>
            <li><a href="#view2" onclick="getx('tmuslim2')">Muslim</a></li>
            <li><a href="#view3" onclick="getx('tabudaud3')">Abudaud</a></li>
            <li><a href="#view4" onclick="getx('ttirmidzi4')">Tirmidzi</a></li>
            <li><a href="#view5" onclick="getx('tnasai5')">Nasai</a></li>
            <li><a href="#view6" onclick="getx('tibnumajah6','')">Ibnumajah</a></li>            
            <li><a href="#view7" onclick="getx('tahmad7')">Ahmad</a></li>
            <li><a href="#view8" onclick="getx('tmalik8')">Malik</a></li>
            <li><a href="#view9" onclick="getx('tdarimi9')">Darimi</a></li> 
            <li><a href="#view0" onclick="Hidemenu('rmenu','vsatu')">ALL</a></li>      
        </ul>
        
        <div class="tabcontents">
					<div id="rmenu">
        			<div id="hdkitab">KITAB dan BAB</div>
            	<div class="dmenu">
            	
	  					<?php
							if (isset($id) ){
									getkitab($id);}

						?>					
            	</div>
            	</div>
					<?php
					if (isset($id)){$lnk='isi.php';}
					else {$lnk='pagination/index.php';}
					?>

              	<iframe src="<?=$lnk;?>" name="vsatu" frameBorder="0" id="vsatu">							
					</iframe>      
	     		<a id="view1"> </a>            
            <a id="view2"> </a>            
            <a id="view3"> </a>
            <a id="view4"> </a>
            <a id="view5"> </a>
            <a id="view6"> </a>    
            <a id="view7"> </a>
            <a id="view8"> </a>
            <a id="view9"> </a>     
            <a id="view0"> </a>                             
        </div>
    </div>
<!--===TOOLS DIALOGBOX PILIH PENCARIAN=====================-->
<div class="box" role="alert" style="display:none" id="x">

	<div class="isibox"><a href="#" onclick="HideContent('x')"  class="tutup"><img src="img-conf/close3.png" alt="" class="tutup"></a>
		<form action="#" method="post">
		<input type="checkbox" name="check_list[]" value="no" <?php echo cbok('no');?> > <label>Cari Berdasarkan NO Hadits</label><br/>
		<input type="checkbox" name="check_list[]" value="kitab" <?php echo cbok('kitab');?> ><label>Cari Berdasarkan KITAB Hadits</label><br/>
		<input type="checkbox" name="check_list[]" value="bab"><label>Cari Berdasarkan BAB Hadits</label><br/>
		<input type="checkbox" name="check_list[]" value="hindo"><label>Cari Berdasarkan TERJEMAHAN Hadits</label><br/>
		<input type="checkbox" name="check_list[]" value="harab"><label>Cari Berdasarkan TEKS ARAB Hadits</label><br/>
		<hr>
		<input type="checkbox" name="check_list[]" value="all"><label>Cari di SEMUA 9 Sumber</label><br/>
		<br>
		<input type="submit" name="submit" value="Apply"/>
		<input type="submit" name="delle" value="DESTROY"/>
		</form>
		<?php

		//-------------------------------------------------------
		if(isset($_POST['submit'])){//to run PHP script on submit
			if(!empty($_POST['check_list'])){
				$_SESSION['pil']=null;
		// Loop to store and display values of individual checked checkbox.
				foreach($_POST['check_list'] as $selected){
       			 $_SESSION['pil'][] = array($selected);
					// echo $selected."</br>";
				}
			}
		}
		if(isset($_POST['delle'])){
			echo'Hapus SESSION..............<br>';
			session_destroy();
			$_SESSION['pil']=null;	
		}

		echo '<hr>CBOK :'.cbok('0').'<br>';
		if (!empty($_SESSION['pil'][0][0])){echo 'Session NO :'.$_SESSION['pil'][0][0].'<br>';}
		if (!empty($_SESSION['pil'][1][0])){echo 'Session KITAB :'.$_SESSION['pil'][1][0].'<br>';}
		if (!empty($_SESSION['pil'][2][0])){echo 'Session BAB :'.$_SESSION['pil'][2][0].'<br><hr>';}
	 	if (!empty($_SESSION['pil'][0][0])){
	 		foreach($_SESSION["pil"] as $key => $val)
	    	{ 
        		echo 'Hasil :'.$val[0].'<br>';
	    	}
    	}

			echo '<hr>ID Hadits : '.$_SESSION['id'];
		?>
	
	</div>
	
</div> <!-- cd-popup -->
<!--===END--TOOLS DIALOGBOX PILIH PENCARIAN=====================--> 
</body>
</html>