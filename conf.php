<?php
include 'conn.php';
#===========================
//---PESAN ALERT JAVASCRIPT ON PHP--------
global $a, $b;
function pesan($p) {
	echo '<script language="javascript">';
	echo 'alert("'.$p.'")';

	echo '</script>';
	}
function ca($x) {
		global $a, $b;
		if ($x == "A"){
			$a = '1';
			$b = '';
		}else {
			$a = '1';
			$b = '1';
		}
	}
function cico($n1,$n2) {
	if(cek($n1,$n2) == '0') {
		return array('ueye22x.png', 'uok22.png');
	}
	elseif(cek($n1,$n2) == '11') {
		return array('eye22.png', 'uok22.png');
	}
	else {
		return array('eye22.png', 'ok22.png');
	}
}
function cek($n1,$n2) {
	global $link;
  #$sqlnya="SELECT no,sum,dil,dis FROM tket WHERE no = '$n1' AND sum = '$n2' LIMIT 1";
  $sqlnya='SELECT no,sum,dil,dis FROM tket WHERE no = '.$n1.' AND sum = "'.$n2.'" LIMIT 1';
	$result = mysqli_query($link,$sqlnya);
	$row = mysqli_fetch_assoc($result);
	$num_rows = mysqli_num_rows($result);
	if($num_rows > 0)
	{			//return($num_rows.' *** '.$row['dil'].' *** '.$row['dil']);
					return($num_rows.$row['dil'].$row['dis']);
	}
	else {	return('0');}
}
//===INPUT FUNGSI LIHAT DAN BOOKMARK====
function ibook($n1,$n2,$x) {
	global $link;
	$tgl = strftime("%F#%T");
	if (cek($n1,$n2) == '0')
	{
		global $a, $b;
		ca($x);
		$order = "INSERT INTO tket (no, sum, dil, dis, tgl) VALUES ('$n1','$n2','$a','$b','$tgl')";
		$result = mysqli_query($link, $order);
		if($result){
			echo pesan('Input data is succeed');
		} else{
			echo pesan('Input data is fail');
		}
	}
	else
	{
		//if (cek($n1,$n2) == '11' & $x == 'A')
		if ($x == 'A')
		{
			echo pesan('Hadist yang sudah dilihat tidak dapat Diubah !');
		}
		else
		{
			if ($x == 'B' & cek($n1,$n2) == '111')	{
				ubook($n1,$n2,'A');
			} else {
				ubook($n1,$n2,$x);
			}
		}
	}

}
function ubook($n1,$n2,$x) {
 	konek();
 	global $a, $b;
	ca($x);
	$sql ="UPDATE tket SET dil = '$a', dis = '$b' WHERE no = '$n1' AND sum = '$n2'" ;
	$result = mysql_query($sql);
	if($result){
		echo pesan('Input data is succeed');
	} else{
		echo pesan('Input data is fail');
	}
}
function cc($cx){
  return('<label class="cr">'.$cx.'</label>');
}
function cr_color($cr){
  $cr = str_replace('%', ' ', $cr);
  $str_arr = explode(' ', $cr);
  $jm=count($str_arr);
  //echo 'Hasil  2 : '.$str_arr[1].', Jumlah :'.$jm.'<br>';
  if ($jm == 2)  {
    return array('<label class="cr">'.$str_arr[1].'</label>', '<label class="cr">'.$str_arr[2].'</label>');
  }
  elseif ($jm == 3)  {
    return array('<label class="cr">'.$str_arr[1].'</label>', '<label class="cr">'.$str_arr[2].'</label>', '<label class="cr">'.$str_arr[3].'</label>');
  }
  else  {
    return array('<label class="cr">'.$str_arr[1].'</label>', '<label class="cr">'.$str_arr[2].'</label>', '<label class="cr">'.$str_arr[3].'</label>', '<label class="cr">'.$str_arr[4].'</label>');
  }

}
//=======================================================================
//===FUNCTION GET TABLE NAME=====
function gtba($tb) {
	if ($tb == 'tbukhari1') 	{ return("Bukhari");}
	if ($tb == 'tmuslim2') 		{ return("Muslim");}
	if ($tb == 'tabudaud3')		{ return("Abu Daud");}
	if ($tb == 'ttirmidzi4') 	{ return("Tirmidzi");}
	if ($tb == 'tnasai5') 		{ return("Nasai");}
	if ($tb == 'tibnumajah6')	{ return("Ibnu Majah");}
	if ($tb == 'tahmad7') 		{ return("Ahmad");}
	if ($tb == 'tmalik8') 		{ return("Malik");}
	if ($tb == 'tdarimi9') 		{ return("Ad Darimi");}
  if ($tb == 'quran_text') 		{ return("Al-Quran");}
}
//---------------------------
function gtbb($tb) {
	if ($tb == "Bukhari") 		{ return('tbukhari1');}
	if ($tb == "Muslim") 		  { return('tmuslim2');}
	if ($tb == "Abu Daud")		{ return('tabudaud3');}
	if ($tb == "Tirmidzi") 	 	{ return('ttirmidzi4');}
	if ($tb == "Nasai") 		  { return('tnasai5');}
	if ($tb == "Ibnu Majah")	{ return('tibnumajah6');}
	if ($tb == "Ahmad") 			{ return('tahmad7');}
	if ($tb == "Malik") 			{ return('tmalik8');}
	if ($tb == "Ad Darimi") 	{ return('tdarimi9');}
  if ($tb == "Al-Quran") 		{ return("quran_text");}
}

//===ISI====GET-HADITS-in-BAB===========
	function getisibab($tb,$kt,$bb) {
  global $link;
	$kt = str_replace('?', '"', $kt);
	$bb = str_replace('?', '', $bb);
	$bb = str_replace('!', '"', $bb);
	$bb=addslashes($bb);
	echo '<div id="isif">';
	if ($tb != '')
	{
		#$sql = "SELECT no,sumber,bab, hindo, harab FROM $tb WHERE kitab = '$kt' AND bab LIKE '$bb%' ORDER BY no ASC ";
    $sql = "SELECT * FROM $tb WHERE kitab = '$kt' AND bab LIKE '$bb%' ORDER BY no ASC ";
		$buka=mysqli_query($link,$sql);
		$c=0;
		while($hasil=mysqli_fetch_row($buka)){
				$c=$c+1;
        echo'<div id="isi-tr" onclick="catat(`H`,`'.$tb.'`,`'.$c.'`,`'.$hasil[0].'`,`Hadits : Browsing`)">';
        echo'<table border="0"><tr><td colspan="2" class="record round">
            '.$c. '. [ '.$hasil[0].' ] --> '.$hasil[1].' --> '.$hasil[2].' --> '.$hasil[3].'</td></tr>';
				echo'<tr>
				<td class="tindo">'.$hasil[4].'</td>
				<td class="tarab">'.$hasil[5].'</td></tr><tr><td colspan="2">';
				#</tr></table></div>';
        echo boknote($tb,$hasil[0],$hasil[8],$hasil[7],$hasil[8]).'</td></tr></table></div>';
			}
		}
		echo "</div>";
	}
//===ISI====GET-ISI-HADITS-in-TABLE===========
function getisikitab($tb,$kt) {
global $link;
$kt = str_replace('?', '"', $kt);
echo '<div id="isif">';
if ($tb != '')
{
	#$sql = "SELECT no, sumber, kitab, hindo, harab, bok, note FROM $tb WHERE kitab = '$kt' ORDER BY no ASC ";
  $sql = "SELECT * FROM $tb WHERE kitab = '$kt' ORDER BY no ASC ";
	$buka=mysqli_query($link,$sql);
	$c=0;
	while($hasil=mysqli_fetch_row($buka))
  {
			$c=$c+1;
			echo'<div id="isi-tr" onclick="catat(`H`,`'.$tb.'`,`'.$c.'`,`'.$hasil[0].'`,`Hadits : Browsing`)">
          <table border="0"><tr><td colspan="2" class="record round">
          '.$c. '. [ '.$hasil[0].' ] --> '.$hasil[1].' --> '.$hasil[2].'</td></tr>';
      echo'<tr>
			<td class="tindo">'.$hasil[4].'</td>
			<td class="tarab">'.$hasil[5].'</td></tr><tr><td colspan="2">';
      echo boknote($tb,$hasil[0],$hasil[8],$hasil[7],$hasil[8]).'</td></tr></table></div>';
		}
	}
	echo "</div>";
}
//===MENU====GET-BAB-in-TABLE===========
function getbab($tb,$kt,$nk) {
global $link;
$kt = $kt=addslashes($kt);
echo '<div id="menubab">';
if ($tb != '')
{
	$sql = "SELECT DISTINCT bab FROM $tb WHERE kitab = '$kt' ORDER BY bab ASC ";
	$buka=mysqli_query($link,$sql);
	$c=0;
	while($hasil=mysqli_fetch_row($buka))
  {
			$c=$c+1;
			$kt = str_replace('"', '?', $kt);
			$bb = str_replace('"', '!', $hasil[0]);
			$bb = str_replace('+G703', '', $bb);
      #echo '<input type="hidden" name="tb" value="'.$tb.'"/>';
			echo'<a href="isi.php?b='.$bb.'&k='.$kt.'&t='.$tb.'" target="vsatu" onclick="catat(`H`,`'.$tb.'`,`'.$nk.'`,`'.$c.'`,`BAB : Browsing`)">
      <table id="bab-tr" onclick="togge(this)"><tr><td>'.$hasil[0].'</td>
			<td class="nm">'.$c.'</td></tr></table></a>';
	}
}
	echo "</div>";
}
//===MENU==GET-KITAB-IN-TABLE==========
function getkitab($tb) {
  global $link;
  echo '<div id="menukitab">';
	if ($tb != '')
	{
		$sql = "SELECT DISTINCT kitab	FROM $tb ORDER BY kitab ASC ";
		$buka=mysqli_query($link,$sql);
		$c=0;
			while($hasil=mysqli_fetch_row($buka)){
				$c=$c+1;
				$kt = str_replace('"', '?', $hasil[0]);
				$kt = $kt=addslashes($kt);
        #echo $fl3.'<a name=qq onclick="ReverseDisplay(`'.$fl2.'`);catat(`Q`,`'.namasurah($fl1).'`,`'.$fl2.'`,`'.$ket.'`)">';

				echo '<a href="isi.php?k='.$kt.'&t='.$tb.'" target="vsatu">
              <table id="kitab-tr" onclick="togge(this);ReverseDisplay(`'.$c.'`);catat(`H`,`'.$tb.'`,`'.$c.'`,`'.$c.'`,`Kitab : Browsing`)">
              <tr><td class="nm">'.$c.  '.</td>
				      <td id="kitab-td">'.$hasil[0].'</td></tr></table></a>';
				echo'<div id="'.$c.'" style="display:none">';
						echo getbab($tb,$hasil[0],$c);
    		echo'</div>';
			}
		}
		echo "</div>";
}
/*
===MENU==CARI-KITAB-IN-TABLE =============================
==========================================================ON
*/

//==REMOVE-SAKAL-FROM-ARABFONT==========
function delsakalquran($tb){
  global $link;
  if ($tb != '')
  {
    $sql = "SELECT no, uarab FROM $tb";
    $buka=mysqli_query($link,$sql);
    $c=0;
    while($hasil=mysqli_fetch_row($buka))
    {
        $c=$c+1;
        $huarab=json_encode($hasil[1]);
        //Remove honorific sign
        $hf1	="\u0610"; //ARABIC SIGN SALLALLAHOU ALAYHE WA SALLAM
        $hf2	="\u0611"; //ARABIC SIGN ALAYHE ASSALLAM
        $hf3	="\u0612"; //ARABIC SIGN RAHMATULLAH ALAYHE
        $hf4	="\u0613"; //ARABIC SIGN RADI ALLAHOU ANHU
        $hf5	="\u0614"; //ARABIC SIGN TAKHALLUS
        //Remove koranic anotation
        $hf6	="\u0615"; //ARABIC SMALL HIGH TAH
        $hf7	="\u0616"; //ARABIC SMALL HIGH LIGATURE ALEF WITH LAM WITH YEH
        $hf8	="\u0617"; //ARABIC SMALL HIGH ZAIN
        $hf9	="\u0618"; //ARABIC SMALL FATHA
        $hf10	="\u0619"; //ARABIC SMALL DAMMA
        $hf11	="\u061A"; //ARABIC SMALL KASRA
        $hf12	="\u06D6"; //ARABIC SMALL HIGH LIGATURE SAD WITH LAM WITH ALEF MAKSURA
        $hf13	="\u06D7"; //ARABIC SMALL HIGH LIGATURE QAF WITH LAM WITH ALEF MAKSURA
        $hf14	="\u06D8"; //ARABIC SMALL HIGH MEEM INITIAL FORM
        $hf15	="\u06D9"; //ARABIC SMALL HIGH LAM ALEF
        $hf16	="\u06DA"; //ARABIC SMALL HIGH JEEM
        $hf17	="\u06DB"; //ARABIC SMALL HIGH THREE DOTS
        $hf18	="\u06DC"; //ARABIC SMALL HIGH SEEN
        $hf19	="\u06DD"; //ARABIC END OF AYAH
        $hf20	="\u06DE"; //ARABIC START OF RUB EL HIZB
        $hf21	="\u06DF"; //ARABIC SMALL HIGH ROUNDED ZERO
        $hf22	="\u06E0"; //ARABIC SMALL HIGH UPRIGHT RECTANGULAR ZERO
        $hf23	="\u06E1"; //ARABIC SMALL HIGH DOTLESS HEAD OF KHAH
        $hf24	="\u06E2"; //ARABIC SMALL HIGH MEEM ISOLATED FORM
        $hf25	="\u06E3"; //ARABIC SMALL LOW SEEN
        $hf26	="\u06E4"; //ARABIC SMALL HIGH MADDA
        $hf27	="\u06E5"; //ARABIC SMALL WAW
        $hf28	="\u06E6"; //ARABIC SMALL YEH
        $hf29	="\u06E7"; //ARABIC SMALL HIGH YEH
        $hf30	="\u06E8"; //ARABIC SMALL HIGH NOON
        $hf31	="\u06E9"; //ARABIC PLACE OF SAJDAH
        $hf32	="\u06EA"; //ARABIC EMPTY CENTRE LOW STOP
        $hf33	="\u06EB"; //ARABIC EMPTY CENTRE HIGH STOP
        $hf34	="\u06EC"; //ARABIC ROUNDED HIGH STOP WITH FILLED CENTRE
        $hf35	="\u06ED"; //ARABIC SMALL LOW MEEM
        //Remove tatweel
        $hf36	="\u0640";
#--------------------
        $hf37="\u0656";//ARABIC SUBSCRIPT ALEF
        $hf38="\u0657";//ARABIC INVERTED DAMMA
        $hf39="\u0658";//ARABIC MARK NOON GHUNNA
        $hf40="\u0659";//ARABIC ZWARAKAY
        $hf41="\u065A";//ARABIC VOWEL SIGN SMALL V ABOVE
        $hf42="\u065B";//ARABIC VOWEL SIGN INVERTED SMALL V ABOVE
        $hf43="\u065C";//ARABIC VOWEL SIGN DOT BELOW
        $hf44="\u065D";//ARABIC REVERSED DAMMA
        $hf45="\u065E";//ARABIC FATHA WITH TWO DOTS
        $hf46="\u065F";//ARABIC WAVY HAMZA BELOW
        $hf47="\u0670";//ARABIC LETTER SUPERSCRIPT ALEF
#------------------------
        $hf48="\u064e"; //Fathah
        $hf49="\u0650"; //Kasrah
        $hf50="\u064f"; //Dummah
        $hf51="\u064C"; //dummatain
        $hf52="\u064D"; //Kasratain
        $hf53="\u064B"; //Fathahtain
        $hf54="\u0651"; //Tasdid
        $hf55="\u0652"; //Sukun
        $hf56="\u0653";//ARABIC MADDAH ABOVE
        $hf57="\u0654";//ARABIC HAMZA ABOVE
        $hf58="\u0655";//ARABIC HAMZA BELOW
        $hf59="\u08F0";//FATHATAIN
        $hf60="\u08F1";//DOMMATAIN
        $hf61="\u08F2";//KASRATAIN
#-------------------------
        $huarab = str_replace("\u0622", '\u0627', $huarab);
        #$huarab = str_replace("\u0623", '\u0627', $huarab);
        #$huarab = str_replace("\u0625", '\u0627', $huarab);
        for ($i = 1; $i <= 61; $i++) {
            $hfx= ${'hf'.$i};
            $huarab = str_replace($hfx, '', $huarab);
        }
        $huarab=json_decode($huarab);
        delsakal2($tb,$hasil[0],$huarab);
    }
    echo "<H3>SUKSES UPDATE $c DATA dari TABEL $tb</H3>";
  }
}

function delsakalstr($tb) {
  global $link;
  if ($tb != '')
  {
    $huarab=json_encode($tb);
    #--------------------
    $hf1="\u0656";//ARABIC SUBSCRIPT ALEF
    $hf2="\u0657";//ARABIC INVERTED DAMMA
    $hf3="\u0658";//ARABIC MARK NOON GHUNNA
    $hf4="\u0659";//ARABIC ZWARAKAY
    $hf5="\u065A";//ARABIC VOWEL SIGN SMALL V ABOVE
    $hf6="\u065B";//ARABIC VOWEL SIGN INVERTED SMALL V ABOVE
    $hf7="\u065C";//ARABIC VOWEL SIGN DOT BELOW
    $hf8="\u065D";//ARABIC REVERSED DAMMA
    $hf9="\u065E";//ARABIC FATHA WITH TWO DOTS
    $hf10="\u065F";//ARABIC WAVY HAMZA BELOW
    $hf11="\u0670";//ARABIC LETTER SUPERSCRIPT ALEF
    #------------------------
    $hf12="\u064e"; //Fathah
    $hf13="\u0650"; //Kasrah
    $hf14="\u064f"; //Dummah
    $hf15="\u064C"; //dummatain
    $hf16="\u064D"; //Kasratain
    $hf17="\u064B"; //Fathahtain
    $hf18="\u0651"; //Tasdid
    $hf19="\u0652"; //Sukun
    $hf20="\u0653";//ARABIC MADDAH ABOVE
    $hf21="\u0654";//ARABIC HAMZA ABOVE
    $hf22="\u0655";//ARABIC HAMZA BELOW
    $hf23="\u08F0";//FATHATAIN
    $hf24="\u08F1";//DOMMATAIN
    $hf25="\u08F2";//KASRATAIN
    #-------------------------
    $huarab = str_replace("\u0622", '\u0627', $huarab); //ALIF TANDA TO ALIF POLOS
    #$huarab = str_replace("\u0623", '\u0627', $huarab); //ALIF HAMZA DIATAS TO ALIF POLOS
    #$huarab = str_replace("\u0625", '\u0627', $huarab); //ALIF HAMZA DIBAWAH TO ALIF POLOS
    for ($i = 1; $i <= 25; $i++) {
        $hfx= ${'hf'.$i};
        #echo $hfx;
        $huarab = str_replace($hfx, '', $huarab);
    }
    $huarab=json_decode($huarab);
    echo '=====================================';
    echo "<H4>Data Before : $tb";
    echo "<br>Data After : $huarab</h4>";
    echo '=====================================';
    #echo "<H3>SUKSES UPDATE  DATA dari TABEL $tb</H3>";
  }
}

function delsakal1($tb) {
  global $link;
  if ($tb != '')
  {
    $sql = "SELECT no, uarab FROM $tb";
    $buka=mysqli_query($link,$sql);
    $c=0;
    while($hasil=mysqli_fetch_row($buka))
    {
        $c=$c+1;
        $huarab=json_encode($hasil[1]);
#--------------------
        $hf1="\u0656";//ARABIC SUBSCRIPT ALEF
        $hf2="\u0657";//ARABIC INVERTED DAMMA
        $hf3="\u0658";//ARABIC MARK NOON GHUNNA
        $hf4="\u0659";//ARABIC ZWARAKAY
        $hf5="\u065A";//ARABIC VOWEL SIGN SMALL V ABOVE
        $hf6="\u065B";//ARABIC VOWEL SIGN INVERTED SMALL V ABOVE
        $hf7="\u065C";//ARABIC VOWEL SIGN DOT BELOW
        $hf8="\u065D";//ARABIC REVERSED DAMMA
        $hf9="\u065E";//ARABIC FATHA WITH TWO DOTS
        $hf10="\u065F";//ARABIC WAVY HAMZA BELOW
        $hf11="\u0670";//ARABIC LETTER SUPERSCRIPT ALEF
#------------------------
        $hf12="\u064e"; //Fathah
        $hf13="\u0650"; //Kasrah
        $hf14="\u064f"; //Dummah
        $hf15="\u064C"; //dummatain
        $hf16="\u064D"; //Kasratain
        $hf17="\u064B"; //Fathahtain
        $hf18="\u0651"; //Tasdid
        $hf19="\u0652"; //Sukun
        $hf20="\u0653";//ARABIC MADDAH ABOVE
        $hf21="\u0654";//ARABIC HAMZA ABOVE
        $hf22="\u0655";//ARABIC HAMZA BELOW
        $hf23="\u08F0";//FATHATAIN
        $hf24="\u08F1";//DOMMATAIN
        $hf25="\u08F2";//KASRATAIN
#-------------------------
        $huarab = str_replace("\u0622", '\u0627', $huarab);
        #$huarab = str_replace("\u0623", '\u0627', $huarab);
        #$huarab = str_replace("\u0625", '\u0627', $huarab);
        for ($i = 1; $i <= 25; $i++) {
            $hfx= ${'hf'.$i};
            $huarab = str_replace($hfx, '', $huarab);
        }
        $huarab=json_decode($huarab);
        delsakal2($tb,$hasil[0],$huarab);
    }
    echo "<H3>SUKSES UPDATE $c DATA dari TABEL $tb</H3>";
  }
}
#======================
function delsakal2($tb,$ino,$hu) {
  global $link;
  $sql ="UPDATE $tb SET uarab = '$hu' WHERE no = '$ino'" ;
	$result = mysqli_query($link, $sql);
}

function delsakalall(){
  delsakal1("tbukhari1");
  delsakal1("tmuslim2");
  delsakal1("tabudaud3");
  delsakal1("ttirmidzi4");
  delsakal1("tnasai5");
  delsakal1("tibnumajah6");
  delsakal1("tahmad7");
  delsakal1("tmalik8");
  delsakal1("tdarimi9");
  echo "<H3>HAPUS tanda Sakal di SEMUA TABEL SUKSESSS....!</H3>";
}
#========PERBAIKI-TEXT-ARAB-YG-SALAH===============
function repairtext($t,$f,$a,$b){
  global $link;
  $sql="UPDATE  $t SET $f = REPLACE($f, '$a', '$b')";
  $buka=mysqli_query($link,$sql);
  if ($buka){
    echo "<H3>Suksess REPLACE --$a-- with --$b-- !</H3>";
  }else {
    echo "<H3>FAIL REPLACE !</H3>";
  }
}
function repairtextall($f,$a,$b){
  global $link;
  $tb1 ="tbukhari1";
  $tb2 ="tmuslim2";
  $tb3 ="tabudaud3";
  $tb4 ="ttirmidzi4";
  $tb5 ="tnasai5";
  $tb6 ="tibnumajah6";
  $tb7 ="tahmad7";
  $tb8 ="tmalik8";
  $tb9 ="tdarimi9";
  for ($i = 1; $i <= 9; $i++) {
      $tbx= ${'tb'.$i};
      $sql="UPDATE  $tbx SET $f = REPLACE($f, '$a', '$b')";
      $buka=mysqli_query($link,$sql);
  }
  echo "<H3>Suksess REPLACE --$a-- with --$b-- ALL Table !</H3>";
}
function tambahkolom(){
  global $link;
  $sqlt1 ="ALTER TABLE tbukhari1 ADD uarab longtext NOT NULL";
  $sqlt2 ="ALTER TABLE tmuslim2 ADD uarab longtext NOT NULL";
  $sqlt3 ="ALTER TABLE tabudaud3 ADD uarab longtext NOT NULL";
  $sqlt4 ="ALTER TABLE ttirmidzi4 ADD uarab longtext NOT NULL";
  $sqlt5 ="ALTER TABLE tnasai5 ADD uarab longtext NOT NULL";
  $sqlt6 ="ALTER TABLE tibnumajah6 ADD uarab longtext NOT NULL";
  $sqlt7 ="ALTER TABLE tahmad7 ADD uarab longtext NOT NULL";
  $sqlt8 ="ALTER TABLE tmalik8 ADD uarab longtext NOT NULL";
  $sqlt9 ="ALTER TABLE tdarimi9 ADD uarab longtext NOT NULL";
  for ($i = 1; $i <= 9; $i++) {
      $sqlx= ${'sqlt'.$i};
      mysqli_query($link, $sqlx);
  }
}
//--SET BOOKMARK------
function setbookmarknote($kod,$tb,$no,$dat){
  global $link;

  if ($kod == "B"){
    if (is_numeric($tb))
    {
      $tbx = "quran_text";
      $sr  = $tb; #sura
      $ay  = $no; #aya
      $sql="UPDATE  $tbx SET bok = '$kod' WHERE sura = '$sr' AND aya = '$ay'";
    }else {
      $sql="UPDATE  $tb SET bok = '$kod' WHERE no = '$no'";
    }
  }else {
    if (is_numeric($tb))
    {
      $tbx = "quran_text";
      $sr  = $tb; #sura
      $ay  = $no; #aya
      $sql="UPDATE  $tbx SET note = '$dat' WHERE sura = '$sr' AND aya = '$ay'";
    }else {
    $sql="UPDATE  $tb SET note = '$dat' WHERE no = '$no'";
    }
  }
  #echo "<h3>Hasil : kode='$kod', $sql</h3>";
  $buka=mysqli_query($link,$sql);
  if ($buka){
    echo "<H3>Suksess SAVED = $sql !</H3>";
  }else {
    echo "<H3>FAIL REPLACE !</H3>";
  }
}
function savelog($im,$noa,$nob,$dat){
  global $link;
  #INSERT INTO `h9log`(`no`, `imam`, `ket`) VALUES ("222","muslim","browsing")
  $sql = "INSERT INTO `h9log` (`sumber`,`noa`,`nob`,`ket`) VALUES ('$im','$noa','$nob','$dat')";
  #echo "<h3>Hasil : kode='$kod', $sql</h3>";
  $buka=mysqli_query($link,$sql);
  if ($buka){
    echo "<H3>Suksess SAVED LOG !</H3>";
  }else {
    echo "<H3>FAIL REPLACE !</H3>";
  }
}
//---LATIHAN TAMBAH 2 KOLOM PADA SEMUA TABLE----
#--Fungsi ini berhasil dan sukses tampa ERROR--
#--Jangan diaktifkan atau di-Call,
#--karena akan menhapus daftar BOOKMARK dan CATATAN ANDA !---
function tambahkolomdua(){
  global $link;
  //---TAMBAH-KOLOM-BOOKMARK----
  $sqlt1 ="ALTER TABLE tbukhari1 ADD bok varchar(1)";
  $sqlt2 ="ALTER TABLE tmuslim2 ADD bok varchar(1)";
  $sqlt3 ="ALTER TABLE tabudaud3 ADD bok varchar(1)";
  $sqlt4 ="ALTER TABLE ttirmidzi4 ADD bok varchar(1)";
  $sqlt5 ="ALTER TABLE tnasai5 ADD bok varchar(1)";
  $sqlt6 ="ALTER TABLE tibnumajah6 ADD bok varchar(1)";
  $sqlt7 ="ALTER TABLE tahmad7 ADD bok varchar(1)";
  $sqlt8 ="ALTER TABLE tmalik8 ADD bok varchar(1)";
  $sqlt9 ="ALTER TABLE tdarimi9 ADD bok varchar(1)";
  $sqlt10 ="ALTER TABLE quran_text ADD bok varchar(1)";
  //---TAMBAH-KOLOM-NOTAKU-CATATAN
  $sqlt11 ="ALTER TABLE tbukhari1 ADD note TEXT";
  $sqlt12 ="ALTER TABLE tmuslim2 ADD note TEXT";
  $sqlt13 ="ALTER TABLE tabudaud3 ADD note TEXT";
  $sqlt14 ="ALTER TABLE ttirmidzi4 ADD note TEXT";
  $sqlt15 ="ALTER TABLE tnasai5 ADD note TEXT";
  $sqlt16 ="ALTER TABLE tibnumajah6 ADD note TEXT";
  $sqlt17 ="ALTER TABLE tahmad7 ADD note TEXT";
  $sqlt18 ="ALTER TABLE tmalik8 ADD note TEXT";
  $sqlt19 ="ALTER TABLE tdarimi9 ADD note TEXT";
  $sqlt20 ="ALTER TABLE quran_text ADD note TEXT";

  for ($i = 1; $i <= 20; $i++) {
      $sqlx= ${'sqlt'.$i};
      mysqli_query($link, $sqlx);
  }
  echo "<h1>SUKSES TAMBAH KOLOM --BOK-- dan --NOTE-- !</h1>";
}
//---END LATIHAN TAMBAH 2 KOLOM TABEL
function kopikolomall(){
  global $link;
  #$sql1 ="UPDATE tbukhari1 SET uarab = harab";
	$sql1 ="UPDATE tbukhari1 SET uarab = harab";
	$sql2 ="UPDATE tmuslim2 SET uarab = harab";
	$sql3 ="UPDATE tabudaud3 SET uarab = harab";
	$sql4 ="UPDATE ttirmidzi4 SET uarab = harab";
	$sql5 ="UPDATE tnasai5 SET uarab = harab";
	$sql6 ="UPDATE tibnumajah6 SET uarab = harab";
	$sql7 ="UPDATE tahmad7 SET uarab = harab";
	$sql8 ="UPDATE tmalik8 SET uarab = harab";
	$sql9 ="UPDATE tdarimi9 SET uarab = harab"; # OK
  for ($i = 1; $i <= 9; $i++) {
      $sqlx= ${'sql'.$i};
      mysqli_query($link, $sqlx);
  }
  #mysqli_query($link,$sql1);
}
function kopikolom($t){
  global $link;
  $sql ="UPDATE $t SET uarab = harab";
  $buka=mysqli_query($link,$sql);
  if ($buka){
    echo "<H3>Suksess KOPY COLUMN from TABLE --$t--!</H3>";
  }else {
    echo "<H3>FAIL REPLACE !</H3>";
  }
}
function hapuskolom(){
  global $link;
  $sqlt1 ="ALTER TABLE tbukhari1 DROP COLUMN uarab";
  $sqlt2 ="ALTER TABLE tmuslim2 DROP COLUMN uarab";
  $sqlt3 ="ALTER TABLE tabudaud3 DROP COLUMN uarab";
  $sqlt4 ="ALTER TABLE ttirmidzi4 DROP COLUMN uarab";
  $sqlt5 ="ALTER TABLE tnasai5 DROP COLUMN uarab";
  $sqlt6 ="ALTER TABLE tibnumajah6 DROP COLUMN uarab";
  $sqlt7 ="ALTER TABLE tahmad7 DROP COLUMN uarab";
  $sqlt8 ="ALTER TABLE tmalik8 DROP COLUMN uarab";
  $sqlt9 ="ALTER TABLE tdarimi9 DROP COLUMN uarab";
  for ($i = 1; $i <= 9; $i++) {
      $sqlx= ${'sqlt'.$i};
      mysqli_query($link, $sqlx);
  }
}
#ALTER TABLE tbl_Country DROP COLUMN IsDeleted;
#====BELOW-IS-INI-FILE-READ-WRITE====
function put_ini_file($config, $file, $has_section = false, $write_to_file = true){
 $fileContent = '';
 if(!empty($config)){
  foreach($config as $i=>$v){
   if($has_section){
    $fileContent .= "[".$i."]\n\r" . put_ini_file($v, $file, false, false);
    }
   else{
    if(is_array($v)){
     foreach($v as $t=>$m){
      $fileContent .= $i."[".$t."] = ".(is_numeric($m) ? $m : '"'.$m.'"') . "\n\r";
      }
     }
    else $fileContent .= $i . " = " . (is_numeric($v) ? $v : '"'.$v.'"') . "\n\r";
    }
   }
  }
 if($write_to_file && strlen($fileContent)) return file_put_contents($file, $fileContent, LOCK_EX);
 else return $fileContent;
 }
#====END-OF-INI-FILE-READ-WRITE====
#==HITUNG JUMLAH DATA YANG DICARI PER TABEL ========
function hitungdata($tb,$cr){
  if (!empty($tb) && !empty($cr)){
    global $link;
    $st = "`$tb` WHERE (no LIKE '$cr' OR kitab LIKE '%$cr%' OR bab LIKE '%$cr%' OR hindo LIKE '%$cr%' OR harab LIKE '%$cr%' OR uarab LIKE '%$cr%') ORDER BY no ASC ";
    $query = "SELECT COUNT(*) as `num` FROM {$st}";
    $sql = mysqli_query($link,$query);
    $row = mysqli_fetch_array($sql);
    #if ((!empty($row['num'])) || ($row['num'] >= 1))
    if ($row['num'] === NULL)
    {
      return 0;
    }else {
      return $row['num'];
      #return "Imam <b>".$tb."</b>, Ditemukan <b>".$row['num']."</b> Hadits";
    }
  }
}
#---FUNGSI UNTUK CETAK DATA DALAM TAB PER TABLE-
function boknote($tb,$no,$dat,$imgb,$imgn){

  echo '<table class="boknot" border="0"><tr><td><div class="bkdiv">';
  if ($imgb != "B"){
    $imgb = "bintanga.png";
    echo '<div class="bkdivrow"><a href="temp.php?kd=B&tb='.$tb.'&no='.$no.'" target="vdua"> <img src="ico/'.$imgb.'">Bookmark </a></div>';
  }else {
    $imgb = "bintangb.png";
    echo '<div class="bkdivrow"><img src="ico/'.$imgb.'">Bookmark </a></div>';
  }

  if (($imgn != NULL) || ($imgn != "")){
    $imgn = "noteb.png";
    echo '<div class="bkdivrow"><div onclick="ReverseDisplay(`N'.$no.'`);"> <img src="ico/'.$imgn.'">Catatan  </div></div>';
  }
   else{
     $imgn = "notea.png";
     echo '<div class="bkdivrow"><div onclick="ReverseDisplay(`NB'.$no.'`);"> <img src="ico/'.$imgn.'">Catatan  </div></div>';
   }
  #echo '<div class="bkdivrow"><a href="temp.php?kd=N&tb='.$tb.'&no='.$no.'&dat='.$dat.'" target="vdua" onclick="ReverseDisplay(`B'.$no.'`);"> <img src="ico/'.$imgn.'">Catatan  </a></div>';
  #echo '<div class="bkdivrow"> <img src="ico/mataa.png"> '.$imgn.','.$imgb.','.$dat.','.$no.','.$tb.': Terakhir dilihat </div>';
  echo '</div>';
  #-----DIV FOR SET CATATAN dan SHOW CATATAN-------

  #------- DIV UNTUK BOOKMARK--------
  echo '<div class="bokm" role="alert" style="display:none" id="N'.$no.'">
        <div >'.$dat.'</div></div>';
#------ DIV UNTUK CATATAN-----------
  echo ' <div class="bokm" style="display:none;" id="NB'.$no.'">
          <div class="catatan">
          <form method="GET" action="temp.php" target="vdua">
              <input type="submit" name="btn" value=" Save " />
              <input type="hidden" name="kd" value="N"/>
              <input type="hidden" name="tb" value="'.$tb.'"/>
              <input type="hidden" name="no" value="'.$no.'"/>
              <textarea name="dat" cols="50" rows="3" class="teksm"></textarea>
          </form></div></div>';
  #-----END-DIV FOR SET CATATAN dan SHOW CATATAN-------
  echo '</td> </tr></table>';
}
function cetakdatacari($tb,$cr){
  global $link;
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $limit = 12;
    $startpoint = ($page * $limit) - $limit;

    $pn=basename($_SERVER['PHP_SELF']);
    #$cr = trim($_SESSION['q']); //get text to search from session...
    $cra = $cr;
    $cr = str_replace(' ', '%', $cr);
    #$cra = str_replace('%', ' ', $cr);
    $statement = "`$tb` WHERE (no LIKE '$cr' OR kitab LIKE '%$cr%' OR bab LIKE '%$cr%' OR hindo LIKE '%$cr%' OR harab LIKE '%$cr%' OR uarab LIKE '%$cr%') ORDER BY no ASC ";
    $total = hitungdata($tb,$cr);
    if (empty($total)) {$total="data kosong";exit;}
    echo "<div class=jd>Imam <b>".gtba($tb)."</b>, Ditemukan <b>$total</b> Hadits untuk kata <b class=tuarab>".$cra."</b></div>";

    echo '<div class="pgn">'.pagination($statement,$limit,$page).'</div>';
      //show records
    $i = ($limit * $page) - $limit;
    $sql = "SELECT * FROM {$statement} LIMIT {$startpoint} , {$limit}";
    $query = mysqli_query($link, $sql);
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
      #$fl6 = $row['uarab'];
      $fl7 = $row['bok'];
      $fl8 = $row['note'];

      //-----------------------------------------------------
      for ($x = 0; $x < $jm; $x++)
      {
          $fl1 = str_ireplace($acr[$x], cc($acr[$x]), $fl1);
          $fl2 = str_ireplace($acr[$x], cc($acr[$x]), $fl2);
          $fl3 = str_ireplace($acr[$x], cc($acr[$x]), $fl3);
          $fl4 = str_ireplace($acr[$x], cc($acr[$x]), $fl4);
          $fl5 = str_ireplace($acr[$x], cc($acr[$x]), $fl5);
          #$fl6 = str_ireplace($acr[$x], cc($acr[$x]), $fl6);
      }
      echo'
      <a onclick="RDisplay('.$row['no'].');">
      <div class="record round" id="C'.$row['no'].'" onclick="catat(`HC`,`'.$tb.'`,`'.$i.'`,`'.$row['no'].'`,`'.$cra.'`)">
        <table width="100%" border="0">
      <tr>
        <td class="no"> '.$i.'</td>
        <td class="sub"> '.$row['sumber'].'</td>
        <td class="noh">No.'.$fl1.'</td>
        <td class="ktb">'.$fl2.'</td>
        <td class="bab"> '.$fl3.'</td>
        <td class="icon"><img id="X'.$row['no'].'" src="img-conf/min.png" /></td>
      </tr>
      </table>
      </div></a>';
      #echo '<div id="'.$row['no'].'" style="display:block" class="hrow"><table>'; # kontent langsung terbuka
      echo '<div id="'.$row['no'].'" style="display:none" class="hrow"><table border="0">'; # kontent tersembunyi click untuk buka
      #echo '<tr><td rowspan="2" class="tindo">'.$fl4.'</td><td class="tarab">'.$fl5.'</td></tr>';
      echo '<tr><td class="tindo">'.$fl4.'</td><td class="tarab">'.$fl5.'</td></tr>';
      //echo '<td class="tindo">'.$fl4.'</td><td class="tarab">'.$row['harab'].'</td>';
      echo '<tr><td colspan="2" class="tuarab">';
      #echo boknote('1','`'.$fl2.'`').'</td></tr>';
      echo boknote($tb,$row['no'],$fl8,$fl7,$fl8).'</td></tr>';
      #echo boknote("$fl1").'</td></tr>';
      echo '</table>';
      echo '</div>';
    }
  echo '<a href="#top"><div class="top">Kembali</div></a>';
}
#---DIBAWAH-FUNGSI2-UNTUK-PRINTOUT-ALQURAN----
#---====================================================
function nosurah($s){
  for ($i=1; $i<=114; $i++){
    $ns=namasurah($i);
    if ($s == $ns)
    {
      return $i;
      break;
    }
  }
}
function namasurah($i){
  $nsurah = array ("No Surah",
                    "Al-Faatihah",
                    "Al-Baqarah",
                    "Ali Imran",
                    "An-Nisaa",
                    "Al-Maaidah",
                    "Al-Anam",
                    "Al-Araaf",
                    "Al-Anfaal",
                    "At-Taubah",
                    "Yunus",
                    "Huud",
                    "Yusuf",
                    "Ar-Rad",
                    "Ibrahim",
                    "Al-Hijr",
                    "An-Nahl",
                    "Al-Israa",
                    "Al-Kahfi",
                    "Maryam",
                    "Thaahaa",
                    "Al-Anbiyaa",
                    "Al-Hajj",
                    "Al-Muminuun",
                    "An-Nuur",
                    "Al-Furqaan",
                    "Asy-Syuaraa",
                    "An-Naml",
                    "Al-Qashash",
                    "Al-Ankabuut",
                    "Ar-Ruum",
                    "Luqman",
                    "As-Sajdah",
                    "Al-Ahzab",
                    "Saba",
                    "Faathir",
                    "Yaasiin",
                    "Ash-Shaaffat",
                    "Shaad",
                    "Az-Zumar",
                    "Al-Mumin",
                    "Fushshilat",
                    "Asy-Syuura",
                    "Az-Zukhruf",
                    "Ad-Dukhaan",
                    "Al-Jaatsiyah",
                    "Al-Ahqaaf",
                    "Muhammad",
                    "Al-Fath",
                    "Al-Hujuraat",
                    "Qaaf",
                    "Adz-Dzariyaat",
                    "Ath-Thuur",
                    "An-Najm",
                    "Al-Qamar",
                    "Ar-Rahmaan",
                    "Al-Waaqiah",
                    "Al-Hadiid",
                    "Al-Mujaadilah",
                    "Al-Hasyr",
                    "Al-Mumtahanah",
                    "Ash-Shaff",
                    "Al-Jumuah",
                    "Al-Munaafiquun",
                    "At-Taghaabun",
                    "Ath-Thalaaq",
                    "At-Tahriim",
                    "Al-Mulk",
                    "Al-Qalam",
                    "Al-Haaqqah",
                    "Al-Maaarij",
                    "Nuh",
                    "Al-Jin",
                    "Al-Muzzammil",
                    "Al-Muddatstsir",
                    "Al-Qiyaamah",
                    "Al-Insaan",
                    "Al-Mursalaat",
                    "An-Naba",
                    "An-Naziat",
                    "Abasa",
                    "At-Takwiir",
                    "Al-Infithaar",
                    "Al-Muthaffifiin",
                    "Al-Insyiqaaq",
                    "Al-Buruuj",
                    "Ath-Thaariq",
                    "Al-Alaa",
                    "Al-Ghaasyiyah",
                    "Al-Fajr",
                    "Al-Balad",
                    "Asy-Syams",
                    "Al-Lail",
                    "Adh-Dhuhaa",
                    "Alam Nasyrah",
                    "At-Tiin",
                    "Al-Alaq",
                    "Al-Qadr",
                    "Al-Bayyinah",
                    "Al-Zalzalah",
                    "Al-Aadiyaat",
                    "Al-Qaariah",
                    "At-Takaatsur",
                    "Al-Ashr",
                    "Al-Humazah",
                    "Al-Fiil",
                    "Quraisy",
                    "Al-Maauun",
                    "Al-Kautsar",
                    "Al-Kaafiruun",
                    "An-Nashr",
                    "Al-Lahab",
                    "Al-Ikhlash",
                    "Al-Falaq",
                    "An-Naas");
        if (!empty($i)){
        return $nsurah[$i];}
}
function cetaksurahlist(){
  $sr1	=' 1</TD><TD class="qsura">Al-Faatihah	</TD><TD class="qno">	7</TD><TD class="qsura">Makkiyyah ';
  $sr2	=' 2</TD><TD class="qsura">Al-Baqarah	</TD><TD class="qno">	286</TD><TD class="qsura">Madaniyyah ';
  $sr3	=' 3</TD><TD class="qsura">Ali Imran	</TD><TD class="qno">	200</TD><TD class="qsura">Madaniyyah ';
  $sr4	=' 4</TD><TD class="qsura">An-Nisaa</TD><TD class="qno">	176</TD><TD class="qsura">Madaniyyah ';
  $sr5	=' 5</TD><TD class="qsura">Al-Maa`idah	</TD><TD class="qno">	120</TD><TD class="qsura">Madaniyyah ';
  $sr6	=' 6</TD><TD class="qsura">Al-Anam	</TD><TD class="qno">	165</TD><TD class="qsura">Makkiyyah ';
  $sr7	=' 7</TD><TD class="qsura">Al-Araaf	</TD><TD class="qno">	206</TD><TD class="qsura">Makkiyyah ';
  $sr8	=' 8</TD><TD class="qsura">Al-Anfaal	</TD><TD class="qno">	75</TD><TD class="qsura">Madaniyyah ';
  $sr9	=' 9</TD><TD class="qsura">At-Taubah	</TD><TD class="qno">	129</TD><TD class="qsura">Madaniyyah ';
  $sr10	=' 10</TD><TD class="qsura">Yunus	</TD><TD class="qno">	109</TD><TD class="qsura">Makkiyyah ';
  $sr11	=' 11</TD><TD class="qsura">Huud	</TD><TD class="qno">	123</TD><TD class="qsura">Makkiyyah ';
  $sr12	=' 12</TD><TD class="qsura">Yusuf	</TD><TD class="qno">	111</TD><TD class="qsura">Makkiyyah ';
  $sr13	=' 13</TD><TD class="qsura">Ar-Rad	</TD><TD class="qno">	43</TD><TD class="qsura">Madaniyyah ';
  $sr14	=' 14</TD><TD class="qsura">Ibrahim	</TD><TD class="qno">	52</TD><TD class="qsura">Makkiyyah ';
  $sr15	=' 15</TD><TD class="qsura">Al-Hijr	</TD><TD class="qno">	99</TD><TD class="qsura">Makkiyyah ';
  $sr16	=' 16</TD><TD class="qsura">An-Nahl	</TD><TD class="qno">	128</TD><TD class="qsura">Makkiyyah ';
  $sr17	=' 17</TD><TD class="qsura">Al-Israa	</TD><TD class="qno">	111</TD><TD class="qsura">Makkiyyah ';
  $sr18	=' 18</TD><TD class="qsura">Al-Kahfi	</TD><TD class="qno">	110</TD><TD class="qsura">Makkiyyah ';
  $sr19	=' 19</TD><TD class="qsura">Maryam	</TD><TD class="qno">	98</TD><TD class="qsura">Makkiyyah ';
  $sr20	=' 20</TD><TD class="qsura">Thaahaa	</TD><TD class="qno">	135</TD><TD class="qsura">Makkiyyah ';
  $sr21	=' 21</TD><TD class="qsura">Al-Anbiyaa	</TD><TD class="qno">	112</TD><TD class="qsura">Makkiyyah ';
  $sr22	=' 22</TD><TD class="qsura">Al-Hajj	</TD><TD class="qno">	78</TD><TD class="qsura">Madaniyyah ';
  $sr23	=' 23</TD><TD class="qsura">Al-Muminuun	</TD><TD class="qno">	118</TD><TD class="qsura">Makkiyyah ';
  $sr24	=' 24</TD><TD class="qsura">An-Nuur	</TD><TD class="qno">	64</TD><TD class="qsura">Madaniyyah ';
  $sr25	=' 25</TD><TD class="qsura">Al-Furqaan	</TD><TD class="qno">	77</TD><TD class="qsura">Makkiyyah ';
  $sr26	=' 26</TD><TD class="qsura">Asy-Syuaraa	</TD><TD class="qno">	227</TD><TD class="qsura">Makkiyyah ';
  $sr27	=' 27</TD><TD class="qsura">An-Naml	</TD><TD class="qno">	93</TD><TD class="qsura">Makkiyyah ';
  $sr28	=' 28</TD><TD class="qsura">Al-Qashash	</TD><TD class="qno">	88</TD><TD class="qsura">Makkiyyah ';
  $sr29	=' 29</TD><TD class="qsura">Al-Ankabuut	</TD><TD class="qno">	69</TD><TD class="qsura">Makkiyyah ';
  $sr30	=' 30</TD><TD class="qsura">Ar-Ruum	</TD><TD class="qno">	60</TD><TD class="qsura">Makkiyyah ';
  $sr31	=' 31</TD><TD class="qsura">Luqman	</TD><TD class="qno">	34</TD><TD class="qsura">Makkiyyah ';
  $sr32	=' 32</TD><TD class="qsura">As-Sajdah	</TD><TD class="qno">	30</TD><TD class="qsura">Makkiyyah ';
  $sr33	=' 33</TD><TD class="qsura">Al-Ahzab	</TD><TD class="qno">	73</TD><TD class="qsura">Madaniyyah ';
  $sr34	=' 34</TD><TD class="qsura">Saba	</TD><TD class="qno">	54</TD><TD class="qsura">Makkiyyah ';
  $sr35	=' 35</TD><TD class="qsura">Faathir	</TD><TD class="qno">	45</TD><TD class="qsura">Makkiyyah ';
  $sr36	=' 36</TD><TD class="qsura">Yaasiin	</TD><TD class="qno">	83</TD><TD class="qsura">Makkiyyah ';
  $sr37	=' 37</TD><TD class="qsura">Ash-Shaaffat	</TD><TD class="qno">	182</TD><TD class="qsura">Makkiyyah ';
  $sr38	=' 38</TD><TD class="qsura">Shaad	</TD><TD class="qno">	88</TD><TD class="qsura">Makkiyyah ';
  $sr39	=' 39</TD><TD class="qsura">Az-Zumar	</TD><TD class="qno">	75</TD><TD class="qsura">Makkiyyah ';
  $sr40	=' 40</TD><TD class="qsura">Al-Mumin	</TD><TD class="qno">	85</TD><TD class="qsura">Makkiyyah ';
  $sr41	=' 41</TD><TD class="qsura">Fushshilat	</TD><TD class="qno">	54</TD><TD class="qsura">Makkiyyah ';
  $sr42	=' 42</TD><TD class="qsura">Asy-Syuura	</TD><TD class="qno">	53</TD><TD class="qsura">Makkiyyah ';
  $sr43	=' 43</TD><TD class="qsura">Az-Zukhruf	</TD><TD class="qno">	89</TD><TD class="qsura">Makkiyyah ';
  $sr44	=' 44</TD><TD class="qsura">Ad-Dukhaan	</TD><TD class="qno">	59</TD><TD class="qsura">Makkiyyah ';
  $sr45	=' 45</TD><TD class="qsura">Al-Jaatsiyah	</TD><TD class="qno">	37</TD><TD class="qsura">Makkiyyah ';
  $sr46	=' 46</TD><TD class="qsura">Al-Ahqaaf	</TD><TD class="qno">	35</TD><TD class="qsura">Makkiyyah ';
  $sr47	=' 47</TD><TD class="qsura">Muhammad	</TD><TD class="qno">	38</TD><TD class="qsura">Madaniyyah ';
  $sr48	=' 48</TD><TD class="qsura">Al-Fath	</TD><TD class="qno">	29</TD><TD class="qsura">Madaniyyah ';
  $sr49	=' 49</TD><TD class="qsura">Al-Hujuraat	</TD><TD class="qno">	18</TD><TD class="qsura">Madaniyyah ';
  $sr50	=' 50</TD><TD class="qsura">Qaaf	</TD><TD class="qno">	45</TD><TD class="qsura">Makkiyyah ';
  $sr51	=' 51</TD><TD class="qsura">Adz-Dzariyaat	</TD><TD class="qno">	60</TD><TD class="qsura">Makkiyyah ';
  $sr52	=' 52</TD><TD class="qsura">Ath-Thuur	</TD><TD class="qno">	49</TD><TD class="qsura">Makkiyyah ';
  $sr53	=' 53</TD><TD class="qsura">An-Najm	</TD><TD class="qno">	62</TD><TD class="qsura">Makkiyyah ';
  $sr54	=' 54</TD><TD class="qsura">Al-Qamar	</TD><TD class="qno">	55</TD><TD class="qsura">Makkiyyah ';
  $sr55	=' 55</TD><TD class="qsura">Ar-Rahmaan	</TD><TD class="qno">	78</TD><TD class="qsura">Madaniyyah ';
  $sr56	=' 56</TD><TD class="qsura">Al-Waaqiah	</TD><TD class="qno">	96</TD><TD class="qsura">Makkiyyah ';
  $sr57	=' 57</TD><TD class="qsura">Al-Hadiid	</TD><TD class="qno">	29</TD><TD class="qsura">Madaniyyah ';
  $sr58	=' 58</TD><TD class="qsura">Al-Mujaadilah	</TD><TD class="qno">	22</TD><TD class="qsura">Madaniyyah ';
  $sr59	=' 59</TD><TD class="qsura">Al-Hasyr	</TD><TD class="qno">	24</TD><TD class="qsura">Madaniyyah ';
  $sr60	=' 60</TD><TD class="qsura">Al-Mumtahanah	</TD><TD class="qno">	13</TD><TD class="qsura">Madaniyyah ';
  $sr61	=' 61</TD><TD class="qsura">Ash-Shaff	</TD><TD class="qno">	14</TD><TD class="qsura">Madaniyyah ';
  $sr62	=' 62</TD><TD class="qsura">Al-Jumuah	</TD><TD class="qno">	11</TD><TD class="qsura">Madaniyyah ';
  $sr63	=' 63</TD><TD class="qsura">Al-Munaafiquun	</TD><TD class="qno">	11</TD><TD class="qsura">Madaniyyah ';
  $sr64	=' 64</TD><TD class="qsura">At-Taghaabun	</TD><TD class="qno">	18</TD><TD class="qsura">Madaniyyah ';
  $sr65	=' 65</TD><TD class="qsura">Ath-Thalaaq	</TD><TD class="qno">	12</TD><TD class="qsura">Madaniyyah ';
  $sr66	=' 66</TD><TD class="qsura">At-Tahriim	</TD><TD class="qno">	12</TD><TD class="qsura">Madaniyyah ';
  $sr67	=' 67</TD><TD class="qsura">Al-Mulk	</TD><TD class="qno">	30</TD><TD class="qsura">Makkiyyah ';
  $sr68	=' 68</TD><TD class="qsura">Al-Qalam	</TD><TD class="qno">	52</TD><TD class="qsura">Makkiyyah ';
  $sr69	=' 69</TD><TD class="qsura">Al-Haaqqah	</TD><TD class="qno">	52</TD><TD class="qsura">Makkiyyah ';
  $sr70	=' 70</TD><TD class="qsura">Al-Maaarij	</TD><TD class="qno">	44</TD><TD class="qsura">Makkiyyah ';
  $sr71	=' 71</TD><TD class="qsura">Nuh	</TD><TD class="qno">	28</TD><TD class="qsura">Makkiyyah ';
  $sr72	=' 72</TD><TD class="qsura">Al-Jin	</TD><TD class="qno">	28</TD><TD class="qsura">Makkiyyah ';
  $sr73	=' 73</TD><TD class="qsura">Al-Muzzammil	</TD><TD class="qno">	20</TD><TD class="qsura">Makkiyyah ';
  $sr74	=' 74</TD><TD class="qsura">Al-Muddatstsir	</TD><TD class="qno">	56</TD><TD class="qsura">Makkiyyah ';
  $sr75	=' 75</TD><TD class="qsura">Al-Qiyaamah	</TD><TD class="qno">	40</TD><TD class="qsura">Makkiyyah ';
  $sr76	=' 76</TD><TD class="qsura">Al-Insaan	</TD><TD class="qno">	31</TD><TD class="qsura">Madaniyyah ';
  $sr77	=' 77</TD><TD class="qsura">Al-Mursalaat	</TD><TD class="qno">	50</TD><TD class="qsura">Makkiyyah ';
  $sr78	=' 78</TD><TD class="qsura">An-Naba	</TD><TD class="qno">	40</TD><TD class="qsura">Makkiyyah ';
  $sr79	=' 79</TD><TD class="qsura">An-Naziat	</TD><TD class="qno">	46</TD><TD class="qsura">Makkiyyah ';
  $sr80	=' 80</TD><TD class="qsura">Abasa	</TD><TD class="qno">	42</TD><TD class="qsura">Makkiyyah ';
  $sr81	=' 81</TD><TD class="qsura">At-Takwiir	</TD><TD class="qno">	29</TD><TD class="qsura">Makkiyyah ';
  $sr82	=' 82</TD><TD class="qsura">Al-Infithaar	</TD><TD class="qno">	19</TD><TD class="qsura">Makkiyyah ';
  $sr83	=' 83</TD><TD class="qsura">Al-Muthaffifiin	</TD><TD class="qno">	36</TD><TD class="qsura">Makkiyyah ';
  $sr84	=' 84</TD><TD class="qsura">Al-Insyiqaaq	</TD><TD class="qno">	25</TD><TD class="qsura">Makkiyyah ';
  $sr85	=' 85</TD><TD class="qsura">Al-Buruuj	</TD><TD class="qno">	22</TD><TD class="qsura">Makkiyyah ';
  $sr86	=' 86</TD><TD class="qsura">Ath-Thaariq	</TD><TD class="qno">	17</TD><TD class="qsura">Makkiyyah ';
  $sr87	=' 87</TD><TD class="qsura">Al-Alaa	</TD><TD class="qno">	19</TD><TD class="qsura">Makkiyyah ';
  $sr88	=' 88</TD><TD class="qsura">Al-Ghaasyiyah	</TD><TD class="qno">	26</TD><TD class="qsura">Makkiyyah ';
  $sr89	=' 89</TD><TD class="qsura">Al-Fajr	</TD><TD class="qno">	30</TD><TD class="qsura">Makkiyyah ';
  $sr90	=' 90</TD><TD class="qsura">Al-Balad	</TD><TD class="qno">	20</TD><TD class="qsura">Makkiyyah ';
  $sr91	=' 91</TD><TD class="qsura">Asy-Syams	</TD><TD class="qno">	15</TD><TD class="qsura">Makkiyyah ';
  $sr92	=' 92</TD><TD class="qsura">Al-Lail	</TD><TD class="qno">	21</TD><TD class="qsura">Makkiyyah ';
  $sr93	=' 93</TD><TD class="qsura">Adh-Dhuhaa	</TD><TD class="qno">	11</TD><TD class="qsura">Makkiyyah ';
  $sr94	=' 94</TD><TD class="qsura">Alam Nasyrah	</TD><TD class="qno">	8</TD><TD class="qsura">Makkiyyah ';
  $sr95	=' 95</TD><TD class="qsura">At-Tiin	</TD><TD class="qno">	8</TD><TD class="qsura">Makkiyyah ';
  $sr96	=' 96</TD><TD class="qsura">Al-Alaq	</TD><TD class="qno">	19</TD><TD class="qsura">Makkiyyah ';
  $sr97	=' 97</TD><TD class="qsura">Al-Qadr	</TD><TD class="qno">	5</TD><TD class="qsura">Makkiyyah ';
  $sr98	=' 98</TD><TD class="qsura">Al-Bayyinah	</TD><TD class="qno">	8</TD><TD class="qsura">Madaniyyah ';
  $sr99	=' 99</TD><TD class="qsura">Al-Zalzalah	</TD><TD class="qno">	8</TD><TD class="qsura">Madaniyyah ';
  $sr100	=' 100</TD><TD class="qsura">Al-Aadiyaat	</TD><TD class="qno">	11</TD><TD class="qsura">Makkiyyah ';
  $sr101	=' 101</TD><TD class="qsura">Al-Qaariah	</TD><TD class="qno">	11</TD><TD class="qsura">Makkiyyah ';
  $sr102	=' 102</TD><TD class="qsura">At-Takaatsur	</TD><TD class="qno">	8</TD><TD class="qsura">Makkiyyah ';
  $sr103	=' 103</TD><TD class="qsura">Al-Ashr	</TD><TD class="qno">	3</TD><TD class="qsura">Makkiyyah ';
  $sr104	=' 104</TD><TD class="qsura">Al-Humazah	</TD><TD class="qno">	9</TD><TD class="qsura">Makkiyyah ';
  $sr105	=' 105</TD><TD class="qsura">Al-Fiil	</TD><TD class="qno">	5</TD><TD class="qsura">Makkiyyah ';
  $sr106	=' 106</TD><TD class="qsura">Quraisy	</TD><TD class="qno">	4</TD><TD class="qsura">Makkiyyah ';
  $sr107	=' 107</TD><TD class="qsura">Al-Maauun	</TD><TD class="qno">	7</TD><TD class="qsura">Makkiyyah ';
  $sr108	=' 108</TD><TD class="qsura">Al-Kautsar	</TD><TD class="qno">	3</TD><TD class="qsura">Makkiyyah ';
  $sr109	=' 109</TD><TD class="qsura">Al-Kaafiruun	</TD><TD class="qno">	6</TD><TD class="qsura">Makkiyyah ';
  $sr110	=' 110</TD><TD class="qsura">An-Nashr	</TD><TD class="qno">	3</TD><TD class="qsura">Madaniyyah ';
  $sr111	=' 111</TD><TD class="qsura">Al-Lahab	</TD><TD class="qno">	5</TD><TD class="qsura">Makkiyyah ';
  $sr112	=' 112</TD><TD class="qsura">Al-Ikhlash	</TD><TD class="qno">	4</TD><TD class="qsura">Makkiyyah ';
  $sr113	=' 113</TD><TD class="qsura">Al-Falaq	</TD><TD class="qno">	5</TD><TD class="qsura">Makkiyyah ';
  $sr114	=' 114</TD><TD class="qsura">An-Naas	</TD><TD class="qno">	6</TD><TD class="qsura">Makkiyyah ';
  echo '<div id="menukitab">';

  for ($i = 1; $i <= 114; $i++) {
      $hfx= ${'sr'.$i};
      echo'<a href="isi.php?sura='.$i.'" target="vsatu" onclick="catat(`Q`,`quran_text`,`'.$i.'`,`'.$i.'`,`Surah : Browsing`);">';
      #<table id="kitab-tr" onclick="togge(this);ReverseDisplay(`'.$i.'`);catat(`Q`,`'.$i.'`,`quran_text`,`Surah Browsing`);">
      echo'<table id="kitab-tr" onclick="togge(this);ReverseDisplay(`'.$i.'`)">
      <tr><td id="kitab-td" class="qno">'.$hfx.'</td></tr></table></a>';
    }
    echo "</div>";
}

function hitungdataquran($tb,$cr){
  global $link;
  $st = "`$tb` WHERE (sura LIKE '$cr' OR aya LIKE '%$cr%' OR text LIKE '%$cr%' OR indo LIKE '%$cr%' OR uarab LIKE '%$cr%') ORDER BY sura AND aya ASC ";
  $query = "SELECT COUNT(*) as `num` FROM {$st}";
  $sql = mysqli_query($link,$query);
  $row = mysqli_fetch_array($sql);

  #is_null($result['column'])
  #$result['column'] === NULL
  if ($row['num'] === NULL)
  {
    return 0;
  }
  #if ((!empty($row['num'])) || ($row['num'] >= 1))
  else{
    return $row['num'];
    #return "Imam <b>".$tb."</b>, Ditemukan <b>".$row['num']."</b> Hadits";
  }
}

function quranpersurat($tb,$surahno){
  global $link;
  echo '<div id="qdiv" style="display:block">';
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $limit = 30;
    $startpoint = ($page * $limit) - $limit;

    $statement = "`$tb` WHERE sura = '$surahno' ORDER BY sura AND aya ASC ";

    echo '<div class="pgn">'.pagination($statement,$limit,$page).'</div>';
    echo '<div id="x" style="display:block" class="hrow">'; # kontent langsung terbuka
    echo '<table border="0"><tr><td class="qarab">';

    $i = ($limit * $page) - $limit;
    $sql = "SELECT * FROM {$statement} LIMIT {$startpoint} , {$limit}";
    $query = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
      //--------------------------
      $i = $i+1;
      //-----------------------------------------------------
      $fl0 = $row['no'];
      $fl1 = $row['sura'];
      $fl2 = $row['aya'];
      $fl3 = $row['text'];
      $fl4 = $row['indo'];
      $fl5 = $row['bok'];
      $fl6 = $row['note'];
      $ket = "Ayat : Browsing";
      $ap = "";
      //-----------------------------------------------------
      #echo $fl3.'  <a href="#" onclick="RDisplay('.$fl0.')">
      #echo $fl3."<a name=qq onclick=ReverseDisplay('$fl2');>";
      echo $fl3.'<a name=qq onclick="ReverseDisplay(`'.$fl2.'`);catat(`Q`,`quran_text`,`'.$fl1.'`,`'.$fl2.'`,`'.$ket.'`)">';
      echo '<b class="cr">['.$fl2.']</b></a> ';
      echo '<div class="box" role="alert" style="display:none" id="'.$fl2.'">
            <div class="isibox"><b>['.$fl2.']</b> - '.$fl4;
            echo boknote($row['sura'],$row['aya'],$fl6,$fl5,$fl6);
      echo '</div></div>';
    }
    echo '</td></tr></table>';
    echo '</div>';
    echo '<a href="#top"><div class="top">Kembali</div></a>';
  echo '</div>';
}
function cetakdataqurancari($tb,$cr){
  global $link;
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $limit = 12;
    $startpoint = ($page * $limit) - $limit;

    #$cr = trim($_SESSION['q']); //get text to search from session...
    $cra = $cr;
    $cr = str_replace(' ', '%', $cr);
    #$cra = str_replace('%', ' ', $cr);
    $statement = "`$tb` WHERE (sura LIKE '$cr' OR aya LIKE '%$cr%' OR text LIKE '%$cr%' OR indo LIKE '%$cr%' OR uarab LIKE '%$cr%') ORDER BY sura AND aya ASC ";

    $total = hitungdataquran($tb,$cr);
    if (empty($total)) {$total="data kosong";exit;}
    echo "<div class=jd>Al-Quran, Ditemukan <b>$total</b> Ayat untuk kata <b class=tuarab>".$cra."</b></div>";

    echo '<div class="pgn">'.pagination($statement,$limit,$page).'</div>';
      //show records
    $i = ($limit * $page) - $limit;
    $sql = "SELECT * FROM {$statement} LIMIT {$startpoint} , {$limit}";
    $query = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
      //--------------------------
      $i = $i+1;
      $cr = str_replace('%', ' ', $cr);
      $acr = explode(' ', $cr);
      $jm=count($acr);
      //-----------------------------------------------------
      $fl0 = $row['no'];
      $fl1 = $row['sura'];
      $fl2 = $row['aya'];
      $fl3 = $row['text'];
      $fl4 = $row['indo'];
      $fl5 = $row['bok'];
      $fl6 = $row['note'];
      $ap = "";
      //-----------------------------------------------------
      for ($x = 0; $x < $jm; $x++)
      {
          $fl0 = str_ireplace($acr[$x], cc($acr[$x]), $fl0);
          $fl1 = str_ireplace($acr[$x], cc($acr[$x]), $fl1);
          $fl2 = str_ireplace($acr[$x], cc($acr[$x]), $fl2);
          $fl3 = str_ireplace($acr[$x], cc($acr[$x]), $fl3);
          $fl4 = str_ireplace($acr[$x], cc($acr[$x]), $fl4);
      }
      echo'
      <a onclick="RDisplay('.$fl0.')">
      <div class="record round" id="C'.$fl0.'" onclick="catat(`QC`,`'.$tb.'`,`'.$row['sura'].'`,`'.$row['aya'].'`,`'.$cra.'`)">
        <table width="100%" border="0">
      <tr>
        <td class="no"> '.$i.'</td>
        <td class="ktb">'.$fl1.'. '.namasurah($fl1).'</td>
        <td class="ktb">Ayat : '.$fl2.'</td>
        <td class="icon"><img id="X'.$fl0.'" src="img-conf/min.png" /></td>
      </tr>
      </table>
      </div></a>';
      #echo '<div id="'.$row['no'].'" style="display:block" class="hrow"><table>'; # kontent langsung terbuka
      echo '<div id="'.$fl0.'" style="display:none" class="hrow"><table>'; # kontent tersembunyi click untuk buka
      echo '<tr><td class="tindo">'.$fl4.'</td><td class="tarab">'.$fl3.'</td></tr>';
      //echo '<td class="tindo">'.$fl4.'</td><td class="tarab">'.$row['harab'].'</td>';
      echo '<tr><td colspan="2" class="tuarab">';
      #echo boknote($tb,$row['no'],$fl8,$fl7,$fl8).'</td></tr>';

      echo boknote($row['sura'],$row['aya'],$fl1,$fl5,$fl6).'</td></tr>';
      echo '</table>';
      echo '</div>';
    }
  echo '<a href="#top"><div class="top">Kembali</div></a>';
}
?>
