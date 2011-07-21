var curr_ver = "";
var cv_war = "";
var cv_dlnk = "http://sourceforge.net/projects/hybridauth/files/hybridauth-1.1.1-beta.zip/download";
var cv_elnk = "http://hauth.sx33.net/examples/";
var include_p = 1;
var include_ga = 1; 

window.onload = function() {  
	uibid('cv_dlnk', "" ); 
	uibid('cv_war', "You can download <a href=\"" + cv_dlnk + "\" target=\"_blank\"><b style='color:blue'>HybridAuth 1.1.1 <b style=\"color:red\">beta</b></b></a> at SourceForge.net.<br><br>A stable version is under active development and will be released soon - Lord willing.<br /><br /><div style=\"text-align:center;\"><a href=\"" + cv_dlnk + "\" target=\"_blank\"><img style=\"border:0 none !important;\" src=\"downloadbutt.gif\"></b> <a href=\"" + cv_elnk + "\" target=\"_blank\"><img style=\"border:0 none !important;\" src=\"demobutt.gif\"></b></div>" );
};

function uibid(i,v,l) { 
	if(document.getElementById(i)&&!l) document.getElementById(i).innerHTML = v;
	if(document.getElementById(i)&&l) document.getElementById(i).href = v; 
}; 
