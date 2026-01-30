//detection
var ss_oas = document.getElementsByTagName("head")[0].getElementsByTagName("script"); var s_oas;
for (var i =0;i<ss_oas.length;i++){if (ss_oas[i].src && ss_oas[i].src.match(/oas\.js(\#.*)?$/)) {s_oas = ss_oas[i]; break;}}

var l = s_oas.src.match(/\#.*l=([a-z]{2})/i); 
var p = s_oas.src.match(/\#.*p=([\w,]*)/i); 

//configuration
var OAS_version =  (navigator.userAgent.indexOf('Mozilla/3') != -1)?10:11;
var OAS_url = (document.location.protocol=='https:')?'https://rmf.accorhotels.com/RealMedia/ads/':'http://rmf.accorhotels.com/RealMedia/ads/';
var OAS_listpos = (p)?p[1]:'Top,Left,Left1,Left2,Left3,Left4,Left5,Left6,Middle,Right,BottomLeft,BottomRight,Bottom';
var OAS_query = '?langue='+((l)?l[1]:'GB');
if (getCookie("sourceid") != null) OAS_query = OAS_query + '?sourceid=' +getCookie("sourceid");
if(document.location.protocol=='https:'){
	var OAS_sitepage = new String(window.top.location.href).slice(8).split('?')[0];
}
else{
	var OAS_sitepage = new String(window.top.location.href).slice(7).split('?')[0];
}
OAS_sitepage = OAS_sitepage.split('#')[0];
var OAS_rn = new String (Math.random()); OAS_rns = OAS_rn.substring (2, 11);

// cas particulier des pages partenaires
var oas_partenaires_pattern = new RegExp("www.accorhotels.com/[a-z]{2}/partenaires","g");
if (oas_partenaires_pattern.test(OAS_sitepage)) OAS_sitepage = OAS_sitepage.replace(new RegExp("www.accorhotels.com","g"), "www.accorhotels_partenaires.com");

// cas particulier des fh : suppression du nom commercial.
OAS_sitepage = OAS_sitepage.replace(/(.+)\/([a-z]{2})\/hotel-(\d{4})-[^\/]*\/(.+).shtml/, "$1/$2/hotel-$3/$4.shtml");

function OAS_NORMAL(pos) { 
 document.write('<A HREF="' + OAS_url + 'click_nx.ads/' + OAS_sitepage + '/1' + OAS_rns + '@' + OAS_listpos + '!' + pos +OAS_query + '" TARGET=_top>');
 document.write('<IMG SRC="' + OAS_url + 'adstream_nx.ads/' + OAS_sitepage + '/1' + OAS_rns + '@' + OAS_listpos + '!' + pos +OAS_query + '" BORDER=0></A>');
}

if (OAS_version >= 11)
	document.write('<SCRIPT LANGUAGE=JavaScript1.1 SRC="' + OAS_url + 'adstream_mjx.ads/' + OAS_sitepage + '/1' + OAS_rns + '@' + OAS_listpos +OAS_query + '"><\/SCRIPT>');

document.write('');

function OAS_AD(pos) { if (OAS_version >= 11) OAS_RICH(pos); else  OAS_NORMAL(pos); }

function getCookie(name){
	var start = document.cookie.indexOf( name + "=" );
	var len = start + name.length + 1;
	if ( ( !start ) && ( name != document.cookie.substring( 0, name.length ) ) ){return null;}
	if ( start == -1 ) return null;
	var end = document.cookie.indexOf( ";", len );
	if ( end == -1 ) end = document.cookie.length;
	return unescape( document.cookie.substring( len, end ) );
}