
function search_submit(){
	q=document.getElementById("q").value;
	q = q.replace(/ /gi,"-");
	if(q=='search...' || q=="") return false;
		document.getElementById("vsatu").src = "cari.php";
	return false;
}

function search_submit_input(e) {
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;

	if(keycode==13){
		search_submit();
	}
}

//document.getElementById("q").onkeypress=search_submit_input;
//========Tambaah FUngsi===============
function getq() {
	b=document.getElementById("q").value;
	alert ('hasil-X :'+b)
}

function getx(b) {
	//document.getElementById(b).contentWindow.location.reload();
	window.location.href="myhadits9.php?id="+b;
}
var ax;
function gg1(a) {
     //if (document.getElementById(a).src == "img-conf/ico/ueye22.png") {
     if (ax == "1") {
         document.getElementById(a).src = "img-conf/ico/eye22.png";
         ax = "0"; }
     else {
         document.getElementById(a).src = "img-conf/ico/ueye22x.png";
         ax = "1"; }
}
var ab;
function gg2(b) {
     if (ab == "1") {
         document.getElementById(b).src = "img-conf/ico/ok22.png";
         ab = "0"; }
     else {
         document.getElementById(b).src = "img-conf/ico/uok22.png";
         ab = "1"; }
	}

function rfs() {
	window.location.reload(true);
	//document.getElementById('vsatu').contentWindow.location.reload();

}
//===================
var a,b ;
function ps(c,d) {
	a = c;
	b = d;
	alert(c,'adalah : '+d);
	}
function gt() {
		alert ("Nama 1 :"+a+", Nama 2 :"+b);
		document.getElementById("mydiv").innerHTML = "Nama 1 :"+a+", Nama 2 :"+b;
	}
//====Tambaah FUngsi Show-Hide Sub Rows===============
function HideContent(d) {
document.getElementById(d).style.display = "none";
}
function ShowContent(d) {
document.getElementById(d).style.display = "block";
}
function ReverseDisplay(d) {
if(document.getElementById(d).style.display == "none") {
document.getElementById(d).style.display = "block"; }
else {document.getElementById(d).style.display = "none"; }
}
//----hide on search------------------
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
//=====HIDE RIGH MENU AND SHOW=======q=='search...' || q==""
function Hidemenu(d,e) {
document.getElementById(d).style.display = "none";
document.getElementById(e).style.width = "96%";
document.getElementById(e).style.left = "2%";
document.getElementById(e).src = "cari.php"; //cuma dipakai di tab all
}
//===========
function validateForm() {
    var x = document.forms["myForm"]["q"].value;
	    if (x == null || x == "" || x=='search...') {
	        //alert("Cari apa..?, Silahkan di-Isi..!");
	        return false;
	    }
	    else {
	    	Hidemenu('rmenu','vsatu');
	    	}
}
//====Chang Image OnClik Eye and CheckBookMark==
