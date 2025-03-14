<?php
/** Adminer - Compact database management
* @link https://www.adminer.org/
* @author Jakub Vrana, https://www.vrana.cz/
* @copyright 2007 Jakub Vrana
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 4.8.4
*/function
adminer_errors($Ec,$Gc){return!!preg_match('~^(Trying to access array offset on( value of type)? null|Undefined array key)~',$Gc);}error_reporting(6135);set_error_handler('adminer_errors',E_WARNING);$cd=!preg_match('~^(unsafe_raw)?$~',ini_get("filter.default"));if($cd||ini_get("filter.default_flags")){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$X){$Ki=filter_input_array(constant("INPUT$X"),FILTER_UNSAFE_RAW);if($Ki)$$X=$Ki;}}if(function_exists("mb_internal_encoding"))mb_internal_encoding("8bit");function
connection(){global$f;return$f;}function
adminer(){global$b;return$b;}function
version(){global$ia;return$ia;}function
idf_unescape($t){if(!preg_match('~^[`\'"[]~',$t))return$t;$te=substr($t,-1);return
str_replace($te.$te,$te,substr($t,1,-1));}function
escape_string($X){return
substr(q($X),1,-1);}function
number($X){return
preg_replace('~[^0-9]+~','',$X);}function
number_type(){return'((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';}function
remove_slashes($wg,$cd=false){if(function_exists("get_magic_quotes_gpc")&&get_magic_quotes_gpc()){while(list($x,$X)=each($wg)){foreach($X
as$le=>$W){unset($wg[$x][$le]);if(is_array($W)){$wg[$x][stripslashes($le)]=$W;$wg[]=&$wg[$x][stripslashes($le)];}else$wg[$x][stripslashes($le)]=($cd?$W:stripslashes($W));}}}}function
bracket_escape($t,$Na=false){static$wi=array(':'=>':1',']'=>':2','['=>':3','"'=>':4');return
strtr($t,($Na?array_flip($wi):$wi));}function
min_version($bj,$Ge="",$g=null){global$f;if(!$g)$g=$f;$ph=$g->server_info;if($Ge&&preg_match('~([\d.]+)-MariaDB~',$ph,$B)){$ph=$B[1];$bj=$Ge;}return(version_compare($ph,$bj)>=0);}function
charset($f){return(min_version("5.5.3",0,$f)?"utf8mb4":"utf8");}function
script($_h,$vi="\n"){return"<script".nonce().">$_h</script>$vi";}function
script_src($Pi){return"<script src='".h($Pi)."'".nonce()."></script>\n";}function
nonce(){return' nonce="'.get_nonce().'"';}function
target_blank(){return' target="_blank" rel="noreferrer noopener"';}function
h($P){return
str_replace("\0","&#0;",htmlspecialchars($P,ENT_QUOTES,'utf-8'));}function
nl_br($P){return
str_replace("\n","<br>",$P);}function
checkbox($C,$Y,$db,$qe="",$xf="",$hb="",$re=""){$I="<input type='checkbox' name='$C' value='".h($Y)."'".($db?" checked":"").($re?" aria-labelledby='$re'":"").">".($xf?script("qsl('input').onclick = function () { $xf };",""):"");return($qe!=""||$hb?"<label".($hb?" class='$hb'":"").">$I".h($qe)."</label>":$I);}function
optionlist($D,$ih=null,$Ti=false){$I="";foreach($D
as$le=>$W){$Df=array($le=>$W);if(is_array($W)){$I.='<optgroup label="'.h($le).'">';$Df=$W;}foreach($Df
as$x=>$X)$I.='<option'.($Ti||is_string($x)?' value="'.h($x).'"':'').(($Ti||is_string($x)?(string)$x:$X)===$ih?' selected':'').'>'.h($X);if(is_array($W))$I.='</optgroup>';}return$I;}function
html_select($C,$D,$Y="",$wf=true,$re=""){if($wf)return"<select name='".h($C)."'".($re?" aria-labelledby='$re'":"").">".optionlist($D,$Y)."</select>".(is_string($wf)?script("qsl('select').onchange = function () { $wf };",""):"");$I="";foreach($D
as$x=>$X)$I.="<label><input type='radio' name='".h($C)."' value='".h($x)."'".($x==$Y?" checked":"").">".h($X)."</label>";return$I;}function
select_input($Ia,$D,$Y="",$wf="",$ig=""){$ai=($D?"select":"input");return"<$ai$Ia".($D?"><option value=''>$ig".optionlist($D,$Y,true)."</select>":" size='10' value='".h($Y)."' placeholder='$ig'>").($wf?script("qsl('$ai').onchange = $wf;",""):"");}function
confirm($Qe="",$jh="qsl('input')"){return
script("$jh.onclick = function () { return confirm('".($Qe?js_escape($Qe):'Êtes-vous certain(e) ?')."'); };","");}function
print_fieldset($s,$ye,$ej=false){echo"<fieldset><legend>","<a href='#fieldset-$s'>$ye</a>",script("qsl('a').onclick = partial(toggle, 'fieldset-$s');",""),"</legend>","<div id='fieldset-$s'".($ej?"":" class='hidden'").">\n";}function
generate_linksbar($_){$Be="<p class='links'>";foreach($_
as$x=>$z){if($x!==key(array_keys($_)))$Be.="<span class='separator'>|</span>";$Be.=$z;}$Be.="</p>";return$Be;}function
bold($Ua,$hb=""){return($Ua?" class='active $hb'":($hb?" class='$hb'":""));}function
odd($I=' class="odd"'){static$r=0;if(!$I)$r=-1;return($r++%2?$I:'');}function
js_escape($P){return
addcslashes($P,"\r\n'\\/");}function
json_row($x,$X=null){static$dd=true;if($dd)echo"{";if($x!=""){echo($dd?"":",")."\n\t\"".addcslashes($x,"\r\n\t\"\\/").'": '.($X!==null?'"'.addcslashes($X,"\r\n\"\\/").'"':'null');$dd=false;}else{echo"\n}\n";$dd=true;}}function
ini_bool($Yd){$X=ini_get($Yd);return(preg_match('~^(on|true|yes)$~i',$X)||(int)$X);}function
sid(){static$I;if($I===null)$I=(SID&&!($_COOKIE&&ini_bool("session.use_cookies")));return$I;}function
set_password($aj,$M,$V,$F){$_SESSION["pwds"][$aj][$M][$V]=($_COOKIE["adminer_key"]&&is_string($F)?array(encrypt_string($F,$_COOKIE["adminer_key"])):$F);}function
get_password(){$I=get_session("pwds");if(is_array($I))$I=($_COOKIE["adminer_key"]?decrypt_string($I[0],$_COOKIE["adminer_key"]):false);return$I;}function
q($P){global$f;return$f->quote($P);}function
get_vals($G,$d=0){global$f;$I=array();$H=$f->query($G);if(is_object($H)){while($J=$H->fetch_row())$I[]=$J[$d];}return$I;}function
get_key_vals($G,$g=null,$sh=true){global$f;if(!is_object($g))$g=$f;$I=array();$H=$g->query($G);if(is_object($H)){while($J=$H->fetch_row()){if($sh)$I[$J[0]]=$J[1];else$I[]=$J[0];}}return$I;}function
get_rows($G,$g=null,$l="<p class='error'>"){global$f;$yb=(is_object($g)?$g:$f);$I=array();$H=$yb->query($G);if(is_object($H)){while($J=$H->fetch_assoc())$I[]=$J;}elseif(!$H&&!is_object($g)&&$l&&defined("PAGE_HEADER"))echo$l.error()."\n";return$I;}function
unique_array($J,$v){foreach($v
as$u){if(preg_match("~PRIMARY|UNIQUE~",$u["type"])){$I=array();foreach($u["columns"]as$x){if(!isset($J[$x]))continue
2;$I[$x]=$J[$x];}return$I;}}}function
escape_key($x){if(preg_match('(^([\w(]+)('.str_replace("_",".*",preg_quote(idf_escape("_"))).')([ \w)]+)$)',$x,$B))return$B[1].idf_escape(idf_unescape($B[2])).$B[3];return
idf_escape($x);}function
where($Z,$n=array()){global$f,$w;$I=array();foreach((array)$Z["where"]as$x=>$X){$x=bracket_escape($x,1);$d=escape_key($x);$I[]=$d.($w=="sql"&&is_numeric($X)&&preg_match('~\.~',$X)?" LIKE ".q($X):($w=="mssql"?" LIKE ".q(preg_replace('~[_%[]~','[\0]',$X)):" = ".unconvert_field($n[$x],q($X))));if($w=="sql"&&preg_match('~char|text~',$n[$x]["type"]??null)&&preg_match("~[^ -@]~",$X))$I[]="$d = ".q($X)." COLLATE ".charset($f)."_bin";}foreach((array)$Z["null"]as$x)$I[]=escape_key($x)." IS NULL";return
implode(" AND ",$I);}function
where_check($X,$n=array()){parse_str($X,$bb);remove_slashes(array(&$bb));return
where($bb,$n);}function
where_link($r,$d,$Y,$zf="="){return"&where%5B$r%5D%5Bcol%5D=".urlencode($d)."&where%5B$r%5D%5Bop%5D=".urlencode(($Y!==null?$zf:"IS NULL"))."&where%5B$r%5D%5Bval%5D=".urlencode($Y);}function
convert_fields($e,$n,$L=array()){$I="";foreach($e
as$x=>$X){if($L&&!in_array(idf_escape($x),$L))continue;$Ga=convert_field($n[$x]);if($Ga)$I.=", $Ga AS ".idf_escape($x);}return$I;}function
cookie($C,$Y,$Ae=2592000){global$ba;return
header("Set-Cookie: $C=".urlencode($Y).($Ae?"; expires=".gmdate("D, d M Y H:i:s",time()+$Ae)." GMT":"")."; path=".preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]).($ba?"; secure":"")."; HttpOnly; SameSite=lax",false);}function
restart_session(){if(!ini_bool("session.use_cookies"))session_start();}function
stop_session($jd=false){$Si=ini_bool("session.use_cookies");if(!$Si||$jd){session_write_close();if($Si&&@ini_set("session.use_cookies",false)===false)session_start();}}function&get_session($x){return$_SESSION[$x][DRIVER][SERVER][$_GET["username"]];}function
set_session($x,$X){$_SESSION[$x][DRIVER][SERVER][$_GET["username"]]=$X;}function
auth_url($aj,$M,$V,$j=null){global$mc;preg_match('~([^?]*)\??(.*)~',remove_from_uri(implode("|",array_keys($mc))."|username|".($j!==null?"db|":"").session_name()),$B);return"$B[1]?".(sid()?SID."&":"").($aj!="server"||$M!=""?urlencode($aj)."=".urlencode($M)."&":"")."username=".urlencode($V).($j!=""?"&db=".urlencode($j):"").($B[2]?"&$B[2]":"");}function
is_ajax(){return($_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest");}function
redirect($A,$Qe=null){if($Qe!==null){restart_session();$_SESSION["messages"][preg_replace('~^[^?]*~','',($A!==null?$A:$_SERVER["REQUEST_URI"]))][]=$Qe;}if($A!==null){if($A=="")$A=".";header("Location: $A");exit;}}function
query_redirect($G,$A,$Qe,$Fg=true,$Lc=true,$Vc=false,$ii=""){global$f,$l,$b;if($Lc){$Hh=microtime(true);$Vc=!$f->query($G);$ii=format_time($Hh);}$Ch="";if($G)$Ch=$b->messageQuery($G,$ii,$Vc);if($Vc){$l=error().$Ch.script("messagesPrint();");return
false;}if($Fg)redirect($A,$Qe.$Ch);return
true;}function
queries($G){global$f;static$_g=array();static$Hh;if(!$Hh)$Hh=microtime(true);if($G===null)return
array(implode("\n",$_g),format_time($Hh));$_g[]=(preg_match('~;$~',$G)?"DELIMITER ;;\n$G;\nDELIMITER ":$G).";";return$f->query($G);}function
apply_queries($G,$S,$Hc='table'){foreach($S
as$Q){if(!queries("$G ".$Hc($Q)))return
false;}return
true;}function
queries_redirect($A,$Qe,$Fg){list($_g,$ii)=queries(null);return
query_redirect($_g,$A,$Qe,$Fg,false,!$Fg,$ii);}function
format_time($Hh){return
sprintf('%.3f s',max(0,microtime(true)-$Hh));}function
relative_uri(){return
str_replace(":","%3a",preg_replace('~^[^?]*/([^?]*)~','\1',$_SERVER["REQUEST_URI"]));}function
remove_from_uri($Tf=""){return
substr(preg_replace("~(?<=[?&])($Tf".(SID?"":"|".session_name()).")=[^&]*&~",'',relative_uri()."&"),0,-1);}function
pagination($E,$Ob){return" ".($E==$Ob?$E+1:'<a href="'.h(remove_from_uri("page").($E?"&page=$E".($_GET["next"]?"&next=".urlencode($_GET["next"]):""):"")).'">'.($E+1)."</a>");}function
get_file($x,$Xb=false){$bd=$_FILES[$x];if(!$bd)return
null;foreach($bd
as$x=>$X)$bd[$x]=(array)$X;$I='';foreach($bd["error"]as$x=>$l){if($l)return$l;$C=$bd["name"][$x];$qi=$bd["tmp_name"][$x];$Cb=file_get_contents($Xb&&preg_match('~\.gz$~',$C)?"compress.zlib://$qi":$qi);if($Xb){$Hh=substr($Cb,0,3);if(function_exists("iconv")&&preg_match("~^\xFE\xFF|^\xFF\xFE~",$Hh,$Lg))$Cb=iconv("utf-16","utf-8",$Cb);elseif($Hh=="\xEF\xBB\xBF")$Cb=substr($Cb,3);$I.=$Cb."\n\n";}else$I.=$Cb;}return$I;}function
upload_error($l){$Ne=($l==UPLOAD_ERR_INI_SIZE?ini_get("upload_max_filesize"):0);return($l?'Impossible d\'importer le fichier.'.($Ne?" ".sprintf('La taille maximale des fichiers est de %sB.',$Ne):""):'Le fichier est introuvable.');}function
repeat_pattern($fg,$ze){return
str_repeat("$fg{0,65535}",$ze/65535)."$fg{0,".($ze%65535)."}";}function
is_utf8($X){return(preg_match('~~u',$X)&&!preg_match('~[\0-\x8\xB\xC\xE-\x1F]~',$X));}function
shorten_utf8($P,$ze=80,$Oh=""){if(!preg_match("(^(".repeat_pattern("[\t\r\n -\x{10FFFF}]",$ze).")($)?)u",$P,$B))preg_match("(^(".repeat_pattern("[\t\r\n -~]",$ze).")($)?)",$P,$B);return
h($B[1]).$Oh.(isset($B[2])?"":"<i>…</i>");}function
format_number($X){return
strtr(number_format($X,0,".",','),preg_split('~~u','0123456789',-1,PREG_SPLIT_NO_EMPTY));}function
friendly_url($X){return
preg_replace('~[^a-z0-9_]~i','-',$X);}function
hidden_fields($wg,$Nd=array(),$og=''){$I=false;foreach($wg
as$x=>$X){if(!in_array($x,$Nd)){if(is_array($X))hidden_fields($X,array(),$x);else{$I=true;echo'<input type="hidden" name="'.h($og?$og."[$x]":$x).'" value="'.h($X).'">';}}}return$I;}function
hidden_fields_get(){echo(sid()?'<input type="hidden" name="'.session_name().'" value="'.h(session_id()).'">':''),(SERVER!==null?'<input type="hidden" name="'.DRIVER.'" value="'.h(SERVER).'">':""),'<input type="hidden" name="username" value="'.h($_GET["username"]).'">';}function
table_status1($Q,$Wc=false){$I=table_status($Q,$Wc);return($I?$I:array("Name"=>$Q));}function
column_foreign_keys($Q){global$b;$I=array();foreach($b->foreignKeys($Q)as$p){foreach($p["source"]as$X)$I[$X][]=$p;}return$I;}function
enum_input($T,$Ia,$m,$Y,$Ac=null){global$b;preg_match_all("~'((?:[^']|'')*)'~",$m["length"],$Ie);$I=($Ac!==null?"<label><input type='$T'$Ia value='$Ac'".((is_array($Y)?in_array($Ac,$Y):$Y===0)?" checked":"")."><i>".'vide'."</i></label>":"");foreach($Ie[1]as$r=>$X){$X=stripcslashes(str_replace("''","'",$X));$db=(is_int($Y)?$Y==$r+1:(is_array($Y)?in_array($r+1,$Y):$Y===$X));$I.=" <label><input type='$T'$Ia value='".($r+1)."'".($db?' checked':'').'>'.h($b->editVal($X,$m)).'</label>';}return$I;}function
input($m,$Y,$q){global$U,$b,$w;$C=h(bracket_escape($m["field"]));echo"<td class='function'>";if(is_array($Y)&&!$q){$Ea=array($Y);if(version_compare(PHP_VERSION,5.4)>=0)$Ea[]=JSON_PRETTY_PRINT;$Y=call_user_func_array('json_encode',$Ea);$q="json";}$Pg=($w=="mssql"&&$m["auto_increment"]);if($Pg&&!$_POST["save"])$q=null;$sd=(isset($_GET["select"])||$Pg?array("orig"=>'original'):array())+$b->editFunctions($m);$Ia=" name='fields[$C]'";if($m["type"]=="enum")echo
h($sd[""])."<td>".$b->editInput($_GET["edit"],$m,$Ia,$Y);else{$Cd=(in_array($q,$sd)||isset($sd[$q]));echo(count($sd)>1?"<select name='function[$C]'>".optionlist($sd,$q===null||$Cd?$q:"")."</select>".on_help("getTarget(event).value.replace(/^SQL\$/, '')",1).script("qsl('select').onchange = functionChange;",""):h(reset($sd))).'<td>';$ae=$b->editInput($_GET["edit"],$m,$Ia,$Y);if($ae!="")echo$ae;elseif(preg_match('~bool~',$m["type"]))echo"<input type='hidden'$Ia value='0'>"."<input type='checkbox'".(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?" checked='checked'":"")."$Ia value='1'>";elseif($m["type"]=="set"){preg_match_all("~'((?:[^']|'')*)'~",$m["length"],$Ie);foreach($Ie[1]as$r=>$X){$X=stripcslashes(str_replace("''","'",$X));$db=(is_int($Y)?($Y>>$r)&1:in_array($X,explode(",",$Y),true));echo" <label><input type='checkbox' name='fields[$C][$r]' value='".(1<<$r)."'".($db?' checked':'').">".h($b->editVal($X,$m)).'</label>';}}elseif(preg_match('~blob|bytea|raw|file~',$m["type"])&&ini_bool("file_uploads"))echo"<input type='file' name='fields-$C'>";elseif(($gi=preg_match('~text|lob|memo~i',$m["type"]))||preg_match("~\n~",$Y)){if($gi&&$w!="sqlite")$Ia.=" cols='50' rows='12'";else{$K=min(12,substr_count($Y,"\n")+1);$Ia.=" cols='30' rows='$K'".($K==1?" style='height: 1.2em;'":"");}echo"<textarea$Ia>".h($Y).'</textarea>';}elseif($q=="json"||preg_match('~^jsonb?$~',$m["type"]))echo"<textarea$Ia cols='50' rows='12' class='jush-js'>".h($Y).'</textarea>';else{$Pe=(!preg_match('~int~',$m["type"])&&preg_match('~^(\d+)(,(\d+))?$~',$m["length"],$B)?((preg_match("~binary~",$m["type"])?2:1)*$B[1]+($B[3]?1:0)+($B[2]&&!$m["unsigned"]?1:0)):($U[$m["type"]]?$U[$m["type"]]+($m["unsigned"]?0:1):0));if($w=='sql'&&min_version(5.6)&&preg_match('~time~',$m["type"]))$Pe+=7;echo"<input".((!$Cd||$q==="")&&preg_match('~(?<!o)int(?!er)~',$m["type"])&&!preg_match('~\[\]~',$m["full_type"])?" type='number'":"")." value='".h($Y)."'".($Pe?" data-maxlength='$Pe'":"").(preg_match('~char|binary~',$m["type"])&&$Pe>20?" size='40'":"")."$Ia>";}echo$b->editHint($_GET["edit"],$m,$Y);$dd=0;foreach($sd
as$x=>$X){if($x===""||!$X)break;$dd++;}if($dd)echo
script("mixin(qsl('td'), {onchange: partial(skipOriginal, $dd), oninput: function () { this.onchange(); }});");}}function
process_input($m){global$b,$k;$t=bracket_escape($m["field"]);$q=$_POST["function"][$t]??null;$Y=$_POST["fields"][$t];if($m["type"]=="enum"){if($Y==-1)return
false;if($Y=="")return"NULL";return+$Y;}if($m["auto_increment"]&&$Y=="")return
null;if($q=="orig")return(preg_match('~^CURRENT_TIMESTAMP~i',$m["on_update"])?idf_escape($m["field"]):false);if($q=="NULL")return"NULL";if($m["type"]=="set")return
array_sum((array)$Y);if($q=="json"){$q="";$Y=json_decode($Y,true);if(!is_array($Y))return
false;return$Y;}if(preg_match('~blob|bytea|raw|file~',$m["type"])&&ini_bool("file_uploads")){$bd=get_file("fields-$t");if(!is_string($bd))return
false;return$k->quoteBinary($bd);}return$b->processInput($m,$Y,$q);}function
fields_from_edit(){global$k;$I=array();foreach((array)$_POST["field_keys"]as$x=>$X){if($X!=""){$X=bracket_escape($X);$_POST["function"][$X]=$_POST["field_funs"][$x];$_POST["fields"][$X]=$_POST["field_vals"][$x];}}foreach((array)$_POST["fields"]as$x=>$X){$C=bracket_escape($x,1);$I[$C]=array("field"=>$C,"privileges"=>array("insert"=>1,"update"=>1),"null"=>1,"auto_increment"=>($x==$k->primary),);}return$I;}function
search_tables(){global$b,$f;$_GET["where"][0]["val"]=$_POST["query"];$lh="<ul>\n";foreach(table_status('',true)as$Q=>$R){$C=$b->tableName($R);if(isset($R["Engine"])&&$C!=""&&(!$_POST["tables"]||in_array($Q,$_POST["tables"]))){$H=$f->query("SELECT".limit("1 FROM ".table($Q)," WHERE ".implode(" AND ",$b->selectSearchProcess(fields($Q),array())),1));if(!$H||$H->fetch_row()){$sg="<a href='".h(ME."select=".urlencode($Q)."&where[0][op]=".urlencode($_GET["where"][0]["op"])."&where[0][val]=".urlencode($_GET["where"][0]["val"]))."'>$C</a>";echo"$lh<li>".($H?$sg:"<p class='error'>$sg: ".error())."\n";$lh="";}}}echo($lh?"<p class='message'>".'Aucune table.':"</ul>")."\n";}function
dump_headers($Ld,$Ye=false){global$b;$I=$b->dumpHeaders($Ld,$Ye);$Pf=$_POST["output"];if($Pf!="text")header("Content-Disposition: attachment; filename=".$b->dumpFilename($Ld).".$I".($Pf!="file"&&preg_match('~^[0-9a-z]+$~',$Pf)?".$Pf":""));session_write_close();ob_flush();flush();return$I;}function
dump_csv($J){foreach($J
as$x=>$X){if(preg_match('~["\n,;\t]|^0|\.\d*0$~',$X)||$X==="")$J[$x]='"'.str_replace('"','""',$X).'"';}echo
implode(($_POST["format"]=="csv"?",":($_POST["format"]=="tsv"?"\t":";")),$J)."\r\n";}function
apply_sql_function($q,$d){return($q?($q=="unixepoch"?"DATETIME($d, '$q')":($q=="count distinct"?"COUNT(DISTINCT ":strtoupper("$q("))."$d)"):$d);}function
get_temp_dir(){$I=ini_get("upload_tmp_dir");if(!$I){if(function_exists('sys_get_temp_dir'))$I=sys_get_temp_dir();else{$o=@tempnam("","");if(!$o)return
false;$I=dirname($o);unlink($o);}}return$I;}function
file_open_lock($o){$qd=@fopen($o,"r+");if(!$qd){$qd=@fopen($o,"w");if(!$qd)return;chmod($o,0660);}flock($qd,LOCK_EX);return$qd;}function
file_write_unlock($qd,$Qb){rewind($qd);fwrite($qd,$Qb);ftruncate($qd,strlen($Qb));flock($qd,LOCK_UN);fclose($qd);}function
password_file($h){$o=get_temp_dir()."/adminer.key";$I=@file_get_contents($o);if($I||!$h)return$I;$qd=@fopen($o,"w");if($qd){chmod($o,0660);$I=rand_string();fwrite($qd,$I);fclose($qd);}return$I;}function
rand_string(){return
md5(uniqid(mt_rand(),true));}function
select_value($X,$z,$m,$hi){global$b;if(is_array($X)){$I="";foreach($X
as$le=>$W)$I.="<tr>".($X!=array_values($X)?"<th>".h($le):"")."<td>".select_value($W,$z,$m,$hi);return"<table cellspacing='0'>$I</table>";}if(!$z)$z=$b->selectLink($X,$m);if($z===null){if(is_mail($X))$z="mailto:$X";if(is_url($X))$z=$X;}$I=$b->editVal($X,$m);if($I!==null){if(!is_utf8($I))$I="\0";elseif($hi!=""&&is_shortable($m))$I=shorten_utf8($I,max(0,+$hi));else$I=h($I);}return$b->selectVal($I,$z,$m,$X);}function
is_mail($yc){$Ha='[-a-z0-9!#$%&\'*+/=?^_`{|}~]';$lc='[[:alnum:]](?:[-[:alnum:]]{0,61}[[:alnum:]])';$fg="$Ha+(?:\\.$Ha+)*@(?:$lc?\\.)+$lc";return
is_string($yc)&&preg_match("(^$fg(?:,\\s*$fg)*\$)i",$yc);}function
is_url($P){return(bool)preg_match('~^
			https?://                 # scheme
			(?:
				# IPv6 in square brackets
				\[(?:
					(?:[[:xdigit:]]{1,4}:){7}[[:xdigit:]]{1,4} |             # 1:2:3:4:5:6:7:8
					(?:[[:xdigit:]]{1,4}:){1,7}: |                           # 1::                             1:2:3:4:5:6:7::
					(?:[[:xdigit:]]{1,4}:){1,6}:[[:xdigit:]]{1,4} |          # 1::8            1:2:3:4:5:6::8  1:2:3:4:5:6::8
					(?:[[:xdigit:]]{1,4}:){1,5}(?::[[:xdigit:]]{1,4}){1,2} | # 1::7:8          1:2:3:4:5::7:8  1:2:3:4:5::8
					(?:[[:xdigit:]]{1,4}:){1,4}(?::[[:xdigit:]]{1,4}){1,3} | # 1::6:7:8        1:2:3:4::6:7:8  1:2:3:4::8
					(?:[[:xdigit:]]{1,4}:){1,3}(?::[[:xdigit:]]{1,4}){1,4} | # 1::5:6:7:8      1:2:3::5:6:7:8  1:2:3::8
					(?:[[:xdigit:]]{1,4}:){1,2}(?::[[:xdigit:]]{1,4}){1,5} | # 1::4:5:6:7:8    1:2::4:5:6:7:8  1:2::8
					[[:xdigit:]]{1,4}:(?::[[:xdigit:]]{1,4}){1,6} |          # 1::3:4:5:6:7:8  1::3:4:5:6:7:8  1::8
					:(?::[[:xdigit:]]{1,4}){1,7} |                           # ::2:3:4:5:6:7:8 ::2:3:4:5:6:7:8 ::8
					fe80:(?::[[:xdigit:]]{0,4}){0,4}%[[:alnum:]]+ |          # fe80::7:8%eth0  fe80::7:8%1     (link-local IPv6 addresses with zone index)
					::(?:ffff(?::0{1,4})?:)?
						(?:(?:25[0-5]|(?:2[0-4]|1?[0-9])?[0-9])\.){3}
						(?:25[0-5]|(?:2[0-4]|1?[0-9])?[0-9])
						(?<!\b0\.0\.0\.0) |                                  # ::255.255.255.255  ::ffff:255.255.255.255 ::ffff:0:255.255.255.255  (IPv4-mapped IPv6 addresses and IPv4-translated addresses)
					(?:[[:xdigit:]]{1,4}:){1,4}:
						(?:(?:25[0-5]|(?:2[0-4]|1?[0-9])?[0-9])\.){3}
						(?:25[0-5]|(?:2[0-4]|1?[0-9])?[0-9])
						(?<!\b0\.0\.0\.0)                                    # 2001:db8:3:4::192.0.2.33  64:ff9b::192.0.2.33 (IPv4-Embedded IPv6 Address)
				)\] |
				# IPv4
				(?:(?:25[0-5]|(?:2[0-4]|1?[0-9])?[0-9])\.){3}
					(?:25[0-5]|(?:2[0-4]|1?[0-9])?[0-9])
					(?<!\b0\.0\.0\.0) |                                      # 0.0.0.0 excluded for URLs
				# domain
				[_[:alnum:]](?:[-_[:alnum:]]{0,61}[_[:alnum:]])?
					(?:\.[_[:alnum:]](?:[-_[:alnum:]]{0,61}[_[:alnum:]])?)*
			)                         # host
			(?::(?:[1-9]\d{0,3})?\d)? # port
			(?:/[^\s?\#]*)?           # path
			(?:\?[^\s\#]*)?           # query
			(?:\#\S*)?                # fragment
			$~xi',$P);}function
is_shortable($m){return
preg_match('~char|text|json|lob|geometry|point|linestring|polygon|string|bytea~',$m["type"]??null);}function
count_rows($Q,$Z,$ge,$wd){global$w;$G=" FROM ".table($Q).($Z?" WHERE ".implode(" AND ",$Z):"");return($ge&&($w=="sql"||count($wd)==1)?"SELECT COUNT(DISTINCT ".implode(", ",$wd).")$G":"SELECT COUNT(*)".($ge?" FROM (SELECT 1$G GROUP BY ".implode(", ",$wd).") x":$G));}function
slow_query($G){global$b,$si,$k;$j=$b->database();$ji=$b->queryTimeout();$xh=$k->slowQuery($G,$ji);if(!$xh&&support("kill")&&is_object($g=connect())&&($j==""||$g->select_db($j))){$oe=$g->result(connection_id());echo'<script',nonce(),'>
var timeout = setTimeout(function () {
	ajax(\'',js_escape(ME),'script=kill\', function () {
	}, \'kill=',$oe,'&token=',$si,'\');
}, ',1000*$ji,');
</script>
';}else$g=null;ob_flush();flush();$I=@get_key_vals(($xh?$xh:$G),$g,false);if($g){echo
script("clearTimeout(timeout);");ob_flush();flush();}return$I;}function
get_token(){$Cg=rand(1,1e6);return($Cg^$_SESSION["token"]).":$Cg";}function
verify_token(){list($si,$Cg)=explode(":",$_POST["token"]);return($Cg^$_SESSION["token"])==$si;}function
lzw_decompress($Ra){$ic=256;$Sa=8;$jb=array();$Rg=0;$Sg=0;for($r=0;$r<strlen($Ra);$r++){$Rg=($Rg<<8)+ord($Ra[$r]);$Sg+=8;if($Sg>=$Sa){$Sg-=$Sa;$jb[]=$Rg>>$Sg;$Rg&=(1<<$Sg)-1;$ic++;if($ic>>$Sa)$Sa++;}}$hc=range("\0","\xFF");$I="";foreach($jb
as$r=>$ib){$xc=$hc[$ib];if(!isset($xc))$xc=$pj.$pj[0];$I.=$xc;if($r)$hc[]=$pj.$xc[0];$pj=$xc;}return$I;}function
on_help($rb,$uh=0){return
script("mixin(qsl('select, input'), {onmouseover: function (event) { helpMouseover.call(this, event, $rb, $uh) }, onmouseout: helpMouseout});","");}function
edit_form($Q,$n,$J,$Ni){global$b,$w,$si,$l;$Th=$b->tableName(table_status1($Q,true));page_header(($Ni?'Modifier':'Insérer'),$l,array("select"=>array($Q,$Th)),$Th);$b->editRowPrint($Q,$n,$J,$Ni);if($J===false)echo"<p class='error'>".'Aucun résultat.'."\n";echo'<form action="" method="post" enctype="multipart/form-data" id="form">
';if(!$n)echo"<p class='error'>".'Vous n\'avez pas les droits pour mettre à jour cette table.'."\n";else{echo"<table cellspacing='0' class='layout'>".script("qsl('table').onkeydown = editingKeydown;");foreach($n
as$C=>$m){echo"<tr><th>".$b->fieldName($m);$Yb=$_GET["set"][bracket_escape($C)]??null;if($Yb===null){$Yb=$m["default"];if($m["type"]=="bit"&&preg_match("~^b'([01]*)'\$~",$Yb,$Lg))$Yb=$Lg[1];}$Y=($J!==null?($J[$C]!=""&&$w=="sql"&&preg_match("~enum|set~",$m["type"])?(is_array($J[$C])?array_sum($J[$C]):+$J[$C]):(is_bool($J[$C])?+$J[$C]:$J[$C])):(!$Ni&&$m["auto_increment"]?"":(isset($_GET["select"])?false:$Yb)));if(!$_POST["save"]&&is_string($Y))$Y=$b->editVal($Y,$m);$id=null;if(isset($_POST["function"][$C]))$id=(string)$_POST["function"][$C];$q=($_POST["save"]?$id:($Ni&&preg_match('~^CURRENT_TIMESTAMP~i',$m["on_update"])?"now":($Y===false?null:($Y!==null?'':'NULL'))));if(!$_POST&&!$Ni&&$Y==$m["default"]&&preg_match('~^[\w.]+\(~',$Y))$q="SQL";if(preg_match("~time~",$m["type"])&&preg_match('~^CURRENT_TIMESTAMP~i',$Y)){$Y="";$q="now";}input($m,$Y,$q);echo"\n";}if(!support("table"))echo"<tr>"."<th><input name='field_keys[]'>".script("qsl('input').oninput = fieldChange;")."<td class='function'>".html_select("field_funs[]",$b->editFunctions(array("null"=>isset($_GET["select"]))))."<td><input name='field_vals[]'>"."\n";echo"</table>\n";}echo"<p>\n";if($n){echo"<input type='submit' value='".'Enregistrer'."'>\n";if(!isset($_GET["select"])){echo"<input type='submit' name='insert' value='".($Ni?'Enr. et continuer édition':'Enr. et insérer prochain')."' title='Ctrl+Shift+Enter'>\n",($Ni?script("qsl('input').onclick = function () { return !ajaxForm(this.form, '".'Enregistrement'."…', this); };"):"");}}echo($Ni?"<input type='submit' name='delete' value='".'Effacer'."'>".confirm()."\n":($_POST||!$n?"":script("focus(qsa('td', qs('#form'))[1].firstChild);")));if(isset($_GET["select"]))hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo'<input type="hidden" name="referer" value="',h(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"]),'">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="',$si,'">
</form>
';}if(isset($_GET["file"])){if($_SERVER["HTTP_IF_MODIFIED_SINCE"]){header("HTTP/1.1 304 Not Modified");exit;}header("Expires: ".gmdate("D, d M Y H:i:s",time()+365*24*60*60)." GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: immutable");if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");echo
lzw_decompress("\0\0\0` ��\0X\0Z\0\0C��>�� \r�9�\0�9\$�M'�JeR�d�]/�LfS9��m7�I[m���|:��(����nNiT�e6�+y<^�e(�,�E���Y\$�L\$u���D�K���}>�o�[������`*�������qJ������s5�ͅ�����m�rY<������+w�|�9��˷��M2}�_땢��\\\"��V\n�+��Mt����B��K�*3y�pl5���I`��V)�O��Ws��{O��I�A���s�۹��㉥��N&���c�O}~hH��@G��z���Jy�G��Cc��N���J��Ъ`귊�FC�{вU@�i>��YJ���E��iNR�(�9��A%�!���CQ�^�y�a�����t����:&��۝�Y�����G����H�/\ng��x��s�~��@�%�y8��ZU�EO�a�c��@:��\n�;G��>9�i�}�@p,����6�&���c ���F�ő^�%aR�AQ�h�I�ZԵ9z\\�š`V��5�Z����jo�T����������9!��^����O�)1�2���l����.I��~^��Q�t꒦u��s��I;Ol��B���\$�Q��9��q��	�\\e�Ts��ęU�q2H���֥J'�(E���v��T!ѐ%EQFP��v\\�o��'Jt���GI�I�D\"e����3-�	�o���j�&8E@uTIC�TUP�y3ڶ�>L^�j�����bK��#q��D�8�ʒ\\M�dq�l��\\�y^��]9���������4�hNk�_����g�^�GQ�1�)�PQ8��e�M��U�sոbRh�a��&]O5VUз-d�2��3����\\U���@kWg�+˷'�gZ��ٖE)KJ��|�qP���=�ҟ�O`[%w�O�g�N�M��Pc�S	������C!����p�������d����S��#�!�K�L=��}ߠt�p�4!����/k���6�uN��d�U2�8�X�DX��H�D��vOb4I�N<�+�q*?7W�M�!��X��,d���XN(�Ж=�����0�K�v��ǘ��25F����� #\$a&L�Sd\r����(З��FHИ�ᖒ߱2:'M��>��RX�cq���)�xd��Cp�\rah'�\0h�DȠ��`��l&&B8B�m.�rAeI�Q�2�@�)�. ��n������`���|�ًF<䤳��Z�J�[a(��KoP\"4D?T�R���gL���JU_#���8%��u\$���A���SʆK��JA�8��f����17��M]J�&1=��afK�<w�\$���	�MI�TT���H&�30�?��6ls�\$D�U���\$�Th��I�����[5*M�d�bD��P�L��s��F\0�'AJp�-\rG3�_k��]�|m��%`�_,�8����s��E<2r�!�;��|*�TT��Q-�t�ق�`<�Gl����J�i9���G�L�K�a����K{\n=M�+�1h��/��:�W\\[����q\\��Ka�le�ݲ�u�)�v-~5UL?�E�D��[1�\\V�6���6gĽf�Ϊ��8��Io�]��h[ݒ��� ��R)���!�Ι�����˕���W[��5��K��'�?�}��;�i�i����]�3�l�Fc�cL�|���^�5�;*����Ǹ�Q�博�&�<�Yu/��rٗ\n�-x�8'\r���1���)#n9���Vx%�YdI�\ntI�*��ȳs~m�7.�ǌ�RjX�+^P�eR�ײ��:J�e9�{�#';죥u�2��Rj]M��F��Z�Vj�]�����Z�Zk]m��Ʋ");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("\n��C���o6�C����(\"#H��a1���#y��d��1٘�n:�#(�b.\rDc)��a7E����l�ñ��i1Ύs����54��f�4�ngsI��hM��д�i:`�,��]�����Y��t�L0hD*B0\rF&3��x���s���'��[Ʉtv4��S%��0XL���W5���)�Y��f��\r^�=~9g0�\\@���r�Q�Nn�^��yN�j{�o�p�C%�ʋ�GS��Zh��5Z�|>:��'���b{�J)Ɠєt1�*uS=^���2*�8t(�0R,�8�j:�x����@9�\n�@�1\nJ��#��4��BR�J�����FƋ��>#�����J����`Ha�a�hbC0\r�4A�r�&���\nB��54�\$>�+Q�A2Do�MEL�\"��4�8��=��s5D�LW7��J��G��f�*��*Hj���E����K��1��6�ڸ�,��o�L�t�J�A�\\�\$Q�|�9-H@�0�\nxt�V��(��o�����.+�ܮ����;1D��8e*��c\rT䍣��B2܍�z��\n�83=���K�t��ƻ��u�(���km�ׅ����.���G;�+:�2)��c�n<�s��5�:�6���\n�ԡ)_�\\�6���YL�\"VV`c\$L����;��k&���\$�?�XAW�U��4��8���	�B�ޡ�ڮ���z�����*��[O�24�<?{3�6%;V���V�:\\A�䎈	x�np�x��F�<�[x����oW.����U[��Ãsd7��r���F�&	���b�Ò����]t*7ji�=�dZֹ�Yy�4�:�i���e&����P�g\\1C0�:����;��;ٹ�5�C�n��à\\܎#��ܳ���4{^����g�7u�6�NJ6O��C#�{�!�?f��xw!�7�0���JJL�48�dp�L�����ày��p�C[��.����AltPQ'�z���l�=N7���@m\n/���cTc�]t��הxia�D+p�P���p�x�ׅ�UJ%�����Da���`@^���O����E�c)�Ň@@�A'��)�h�Ub��!�AƸڠ�T~���P�\\*��9Gi��};`�ˠh\r1��Z�lx��9H�I)�Aj�R�WI9!#̆��[�ys�Zb��-���-�q؇h7➀LjQ���ʻ\"#lU`��ׄ^Ar�\r�ff�V.�Q���snh�Gg�N�����@e��%?���\$ᰂ�I����;T\0`�]���B\r�8�[��r2��`\rҢ\rCKeF2ٺ�\r'[t����()����,��M)ڸ� Se=*��N@+�9�%Pi����n�:�܋T}�ԎM��C\r�Nt���g%VÕ]��V6Hʒ�l��?Մ_V�hee,3�ھF� n�����%^k�a���M)��_��a-�N��B�-���v�����)r�J�1�N��Uly�\0�#Y�M˵����Y`�E�M��֭\"�UH-_�������� #���ܹ�E\"��\rv42���FL�8�wZ0]5Sw.���!�0ʴQ�͏3E|�%}����A��C�0t�Lk3��Pj/���kb�N�`Q����Q7�x�����_�僧��B�<�A�8��@%>�\n��x[�&\r�fy� ��!S��L�sV��G(�¹�	�B\$�a�[��F\\A�8G�&r;���or�>�b��i�RZMm��,���d�\"�<��;��\"�Q���?1�uV�~G,\0�գ�0c��`��I��ϣE��PR^fBhU���uɔ��3��CH�(& �i�:\rt�.�W&5}��U�mߗpQ���Ni�`\ndi#(1Q�K����Ғ��\n�I,�Yf`�����'�(�p7�`��q�\rt\0����U��\rs���r:ħ0و;A��,��v0�p��\r�BPcr��R��^m�.���o\n=��\\9��%F��7��Z���V�#����0|Y�ygf��?/\"���a�Mܿ����H�n�Ь�D�d����j���l\0��n�Axs�����P(3}d#u`�'����p@[[���T*`Z?\\�!��>��˄��vl����}��z�����f3�;� �!(6��/&A\08\0��\0r\r�p4��{�TT/������!\r�u��A�t�H��8JU��`r��9`���j\r��-H\"Ճ��A��TH �?����� }�q�A�3��l�~�a�~�2I^���`Z�\0004� �̓eP��&\0p`n��8�p��d���%�f\0s��O��`hD0\0�p,��� i\$����\\\0mO�[ nD�&��`aP\\�p2�.�0/0��P0\n�bV�D���d��&�����&�j�d�\"ioB0\$�&\0a��GJ& @���&O7@i\$%��\n�0/�bd�o��.\r�ro<�\rP��^��Q\n��	�o`���/�\r�^P}O6@n�������D ��d��@���0����	�^���s\0#\0�\$��zIQj��o���c�0�M�0O���C [0��@�Q�@�`p�f�/�P�,A�Np|�PNF�:�������o��l@��p��P��o@I`c	\$��p�/��%\0�Hњ��pu��P�!�h�+�\"��A�\$�\"a�_����'/?U�6��DّCq� fdiP\n%�u�Q�\0�e@p�p�#q�\0���\$�o�\np�DB���\0ϓ\0��0��^�P\"oB�0Z�O����1	�a*�%�V���j�҄����?/-!���B��,�W\"ϑP\nP�E��F�k�/p_\r�c+/\$�S/7+/4�_L�q���'�`D2%ύų#��\r nב�7p1#p�7�`��O0�\$o-!2�Pѽ'�&02�	�N�v/��1\$��io�5�\nO� ip�<���23�Q�D1���</��1-�W\r�CҍS�ٓ\n��	\0����\r�؄�J��d���r��P#�����(J�^�n��A N�4\$�(���?\"CtH\r�*�\"�1ep���tox\r|�9ӰA� ���\rADtKB�@���\0OCor�sG`�/�k�����ԍE�,�@O(�K��F���,���R�+0���A��!/�P��\0�%��#s���}PP�;\rET�E�6\r@�*�h�UK�0�1uI�8�@^�:`�p�R\0���'�� T@b\"UaU�����dhi1�SR��+�K	O�tmJGT�G�E��\0q��q�\n�����/��j�Q�\0R��A�3�s.��N�a\\��@��\n��*1/\"a�[/��ϛ0N����ك<����aR�0QUa/�-P\\Hoap-%/�\ns���kU�Ѽ��	���\\�#]6M!T�fr^\r*%PIZ��oKQ�\"VE95�2�S�\$i+6���O�HѶZ��O'Z�p2�U� �M0<��,��Y1�[��U�i96-�P�R�8p\r3?7��O'cҳ`r;ӝ``�%�31���A4�%�Wh��Yq�oG��7oa,�[Q�7o��� sk�_�gi�i,��r�O�i��j1CqI��\0/�!��ғ]�^TP�H��w�M!w��mQ�01�+��mR},�����O?+T���5pN��K^���Sf��hssv�k71�f/5cg�\0�n@��1zҴ�\0koPI#\0i'�E{�G��Z\r��V�xR�`0#!/�\nq��c!1�g?�2�n�Oj����@pД�@j\r�<�9O�q�~�@e0�!3P#����?YqلҸ�5�/?\0/��6tIu���s c�Di7���n���W�\$�UmA3k�R?u�\0r�}W�t�_bct�ō2�3p�0����1r�����;b�V�v�6;%1����7/�)�(�]1W��'��Q�U�1� ���v0\0g�����tAD�A�WBt�W��X\"aXu9I�<5CC�T��EE�KATE4!W�6) �Rc���cR\$�k�cL3:�#T4���'�s��O���c���V/��\0�3\"T�4���j)�P��P�%�r;��oLՏJT�\$�r�nt�6��N��e9��5�+#�a2\r'�MPo����9U�UmQ��X�{Y ۛqu��\0g��&Z���O�������-[����IZ:�:?S�A�\0��ڂ�` D\"���B����m�*��ePS���j��`J�X�\"�ɍK�FY�>0�nz���\r:���\0004�3,b,f�(���hޚ���L�G���3�I�CG��.X�.����,���7.j�{\$]�m�r�m�V.��Ξ��\0N��*�������vu����X��H`zON�/V��^� ��dɨ�D\0Ƙ�hI�\"��˨pi�ERV��c�9�.�O-�.��k������\0D�ϻ�aE��[���HL��\"�b�[�C�j�;�E�F9�����Q�\"��E��|���[�2{�M\0D	�F�i�\0h	\0`[痠E��\n�s������\r��0nsid�C��I�����@eŶ#e�Riv�ŜK��n�\\-�|;������7`qH`E���܇�����B�ɚC�Ӯܢ�9�|���|��z�^'p	�c8-	b��ҕIP!G*�@�%���:�@�C[�	�+�; �\0�i��(�,�L��C!��1�[H��P��V�[W`�{d��K��)�X�\\���i����k������=d�.Е{�C������כ�񛿶��<�ɿ-I;��Խ���7\"Q�?���#�ٛ�9��jE�-�%ۃ��<����<����-�\\)�ͣ����Y���`\r�����IN�!�lHp�I8!�d��]�ܽ���ٔ���<�yẉ����f	��/��j‘	g�ɵ�<�-DǛ��>葱\r���N]�{юq��d2]1�t�HFi����[C�c��L��\$_��]Ӯ�{k��t�]K��y��՛�����i�{�\$��S�i� ��=��������o���f{��Ֆ[��ݜ�ݠ��!]�A=�����4e�=�#��F������;׾���ĉ��¿���ܜ��+ȓv��ƜM��n�s�NH�q��w��\\�V�?E�<>	�!��'=����|R�w��d�6�ϊ��\rw���I?���_yɾ!�)f�w˞3����匥w�~�F�#�ɅxWt��1�(ɇRe�r�W���!���I���[�ʤp���)��K1@Hf���I��:Q S	�r;5��nbkqTʒ�����; ����� o���*�@r&��Glq<\0�.�w6����V���ckBh�H(��jOC7y�C(mp�V\n*1#����n�<�[B�R��9�2�E���@&��F�(�\n?J͐�[��AR�Wa����ػ���v8�W�f#P��:��k�{�d`����a'���t�����#�tB�mC�����Xdr+sP,Adhw�b?�`�`b[ʡ\\+HXD90���Ö]C���Y�\$/Xk`�/�\"�5��|Q`�Q��\r��j\\'C�B?�����U��ҏ�,��F��4�><�a��goA,(�M�Nr�Hke�I�,T���*��}òp8���oPi�� ������yp�\\��'?9�I��&�JN�ه�:͏<���.�c0�1� 3hB�*a�����Ezkh���L����mSԝ8��:��Ym˩�vꗯ����{	^�^���U�QI{H�[�����!\"��ە��^���N�{�x�4��;!��|�������}��|����nŵ��v�b���9ݎ<������9q���aY��`�c�8�;�o�\0f�1\$��o@5�`��} �7��@h��� �+�((wq4i��6�x=ѣq;���'9�Q�d#��� ſ�N���iyq%>��/��ãb�7ډ\r���C��l��FT��qTa���xˀ��/���N��t��_�^e�\"�6<1�S��Ƽ<G_+AWc��h��=�x����������L}��G�C�8�{�Po�,��>9[�]٘h@PÇ=���4H��~B\$���N&4���ѰPD,� ��\0�����V�@��rj���\$�>�:D\$	_Z�#���r;����z��4�'��|A �H�API�}�Dq�*�J�8p\n� EQ����8\n��  \$m`)���W�0�ZI&�ji��2J���²�[Q\n~���b�����@xk�X��rQAzb�\$�+ 	\"��搐D��\niC�>\nҊ�4��)���T�{�d��Q�h�`{���&oBr��,��B(��JjF���ād�!\\jZQAO��+�2�T��,��C��n�|Sbr'���@6�| �m((vú+YvK~]��P@��.�sN_��\0��\0��_aޗ���03�������w��0��L\"a�,y��U�wL_��(Ðy�L(����0��8v��F�`[.Y~L(} o�D��jP7�B^�\r�L���%��\n�f�<2\0�4)�M3sG ��L���Mi�?�_�r٘Lj_�B-�k�Zm����j8���2͘5�R�4ڞY�BJk3b�Be�1͖ٙl�<���f�0��B9��!]��/��TG+*�ʐIq\nܞS�0�@�.���B��(��CI��sӛ^��.���2tR�L�g;:��͘\r���<���̲e�E��K��jt���f�:9�ξu��D�g7<I�M�(<�t��9rN�<�ʙtˀ�79�L ��_��c��1y��g����>��O����Vg�:�O6z3�,x�@�1b�M��_��\0&�0�\n��b@s�gN��˚�\0eD�H+?�KPr��xnF�U����c�E�|ب#3Вp�@�j��g-�yuhW?���(\0g�T�he:�~�t=����B�6��Ȕ1���D��P�aT8�u�Cj)K���Z�Xch�D�#��8�X��Fy�˼`�-�\\� ���Q&h�_�|ӃNiЖ<�sa-��f��2�N�E�-��H�>`0��k-{�8�*Ip�C�nt\$���h�7B��V\\�5#|�(yD�MK��T��E�9I٢\rB��9\\��C����S\n�%fgJ�,к�t7 �+DuJ�6�r~�a��.'`G�P�zn��m-�7�^�>��o�5f��ཕ|=!P�W�xT⽐`)���QW��\np�(�|Z��*?�pс�\r@k�O!.��3a��q]\n�'\nm�=Ah��)��p���aU�9�N���ҝs��hgڕHa�5x/ ");}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("f:��gCI��\n8��3)��7���81��x:\nOg#)��r7\n\"��`�|2�gSi�H)N�S��\r��\"0��@�)�`(\$s6O!��V/=��' T4�=��iS��6IO�G#�X�VC��s��Z1.�hp8,�[�H�~Cz���2�l�c3���s���I�b�4\n�F8T��I���U*fz��r0�E����y���f�Y.:��I��(�c��΋!�_l��^�^(��N{S��)r�q�Y��l٦3�3�\n�+G���y���i���xV3w�uh�^r����a۔���c��\r���(.��Ch�<\r)�ѣ�`�7���43'm5���\n�P�:2�P����q ���C�}ī�����38�B�0�hR��r(�0��b\\0�Hr44��B�!�p�\$�rZZ�2܉.Ƀ(\\�5�|\nC(�\"��P���.��N�RT�Γ��>�HN��8HP�\\�7Jp~���2%��OC�1�.��C8·H��*�j����S(�/��6KU����<2�pOI���`���ⳈdO�H��5�-��4��pX25-Ң�ۈ�z7��\"(�P�\\32:]U����߅!]�<�A�ۤ���iڰ�l\r�\0v��#J8��wm��ɤ�<�ɠ��%m;p#�`X�D���iZ��N0����9��占��`��v0�C�9���8a�^��M�4���Ł\r�|�7�zF[\n��(�7��v���IĈ2�,9��Ì�#��ȨDW���R;��P�'�������m���3샂�\n�\0u�3����9�Cw��2��f�p{�и�/�	o4�ax�/� \\.��=NJ�G@��YE�9��a��߉mg[�ӹ��=z���{��4\0�1�CH�:�>����X�>�~]\0d�w�����s�!�:�%��9�~�a\n��j0�X�uS���6��dI�V3�̼r`A�D�@��x9'�A@\\T�a3((�\nP�`�o{e�9��=	`�\"����	�[B{!�:�x?�)'|f�8���C ?���Pu��|�@�xR;�U\0(�.5��joN)�/97L�A#8�eA��CA0&#����wKդRG����Za��H�	�U��ݑ�pR�b`W���ްJ\n�!�MD�xkV�nO�(#���yN#�h���\"@�1�\0Ɖ#8L2�\\r�Q\0r\r��`��Y��vb+��1�Hl�`��%�z�.�� �M �5l��N�b\$��2�TxH����`XH�S�W�mb)�'>'z�P�!�и�@?V��=�8\n�+�da�0��7;��ɹ���*�~�W�wܕR��*�T8CҮ]�Xn���'I2�n\$��p4�J�tX��<���>�yK)qi%Ű4>�V\n��H{�J����j��1}�6���JS�P�C��a2�\"��}�s(���ڙ�^���m*�D9ͩ��ɸu�:�A�y����T��˩L͜:+p�^��V�JG��ff���5��%�y	�ܞ����Y��[댝��[�\$EUYZ�u��J��dA��6�[-CHl���)ʃm�=G�f���c�l���R�V���xU U�XR��\$i�j�˻G	�2����[T�'\n5s��FY��h��i\0�X�%_��!�����\r��E���44����l�tm����93l���S�{�S������*g8��\$�\"k�HO)�J��bʵ�p�%\\��P��s�#��)���B:a�i���� Z^����\nk�����v2����F��P��J���ʘnB��,��ܧf���X�5�pB�`�oo����I�!=8�)�c�a��H㨬���b(���JG�aʏ��\"��B�F ��T��{��R��p*�e~2�^ �>v>����%�^1�3�w�CX=�!�g�T�e=9�p>��5;��u����+�����hM�WZA\r�ė�\\M\\�3gМ��[Y�v�qX[�b�)�2�\r��W��L+Ŋ���ez����A|e�d9A�e���\\ap.�@_��긳�~cp��%-��Z�W[�QI�7��E5��u�Ȕ[6%PCio����[1A4��KD�\$�i.	?V�{�/��_y]��@��^��q&#�\0�O<���/�����q\"�檭\\W���UH��y��Wtj���V��{�n�V��f�+μt��,�Ċ^g:�L�Ui����ݻ�e*ǏW���/-�%��嬍\"8C^��&(E\\6�����ZN�9y��s�v��^/B��0�RZ����O\0��;`N� &Q���;�P2�Β+����=M��t�Z472�hLW����o�K'�&��� z�H��ܧ��j��?\nRDG*�Ӊ�-�#�<����I����,P��,Z;h���\0�#����N�M>I`�(E���4\r�T]\"��V��\0�XQ�j~ bR`M���N-�RSN,�\"�0��	�d�~�����y\r��\r@�`�Q-\\s\n.P��)���]��\0�p�\r��]�T�����*}\rp�#����-�jE���mp!ɨf@�@�W�<cmX��v��	�z|KJm\0�@��W��������X\0��Kl<��!�N���*���G�E��C�Z���o��B��z��Т��\r�x����Ge����H�N�H(gj񂰯�\0x���o���K@�1�1lD�\$Р��`����Dv V�� bS�гH`��2��p�n�.�q��Q�J���+��*f�Mp���\r ��/D*��\"��w\$o2��[Q��F��`M�|�1�R�h�o'&�5#%j���>��j�M�گ��t��@&rpGdD�btsR�\$r�!�N�2�qo����{*,D�ɯbrM����`�.Q��q���D%ј�G	!�J���-����+�EDE`{0�䧩0DE�#���p(7��#2�ܳb�d���73M���&�ysH�\"74r�L�9-f*܋�/r�����R�Ř�R��Bn*ij�@�n�B茴�\\FI�X%x f\$�9J}9�a�0qsnF���H�|@���E3};)k7�|H����KK5���SdvR�@� �� �(� �\r����&����*Ja@fp��+J�k�,�w _?\"X\r�N��3'5&�t%�;A�8Lrn���?E�Q�\0%�NSka��8\0Ю�<��DU�G��F8VTDWe7`�����H�t����H��n ��GJl;HTjN`��@H�Ds���[t���Ύ((�H��ex��m7v�yIҾ#T�=��>(�)�\$_ԧO�OQ�-e�(*GKd�K�����t��`DV!C�8���s�D��i<)3��B���KU;8S��ZB�(��.�G����D�c�,��E�uT�p�dl�7J���3�8�D�K�\nbtNS�HUt#�{VluV��ZuF\r@�`��]6�Zǌ�ǀ][��\\\rf(0�S��S�4�3�D��'��W�:S��c:����ǅ��b)�f�����Ģ#��w5�v�s�,��r�w6&����\\m0�\0ڜ\n�J��v6�6Kd�)cu&���R�37N�S�X��5>DU�Z�:���Z'rT�7S�k_G[Ĩ�\$KU��\\�x��<m5�#�[E��\\ɞ��0W��J*.\ro�]�#��C�*��5k��g��|��<���-u��S��O7TS�^���h�o�sp f��֍8�I\\��#����8��_R{pe'2�=��S@�[�:�e8ҕ�d3�5�]r�֪��ֈ�&D�e\$�n�W[3�^���v�TԖ�w)vܭ���X0cmasZ �xm��׌�בPy�yz:��^2�b᎗9���U�qo �of>�\";�K|3yVh��l����	0N�o.�����%���@OGvJ��7M(�A���,��\"[\0��/, %����Ī���σ*��2x}˦�����g��A�!�,��,��ǖ�:&\r,�3_-�ԇl�H�o�8vwSj)V)�(��N��S�XH�XM�XC�x�'/A�XZ^��|f҃i,����ʸ�g؎��[���ڭ��@QbLxJ�����\0��j�S �Z��	�VB�\"��Ћc<Т�tP5u��P\r�ܬ����m��\"�y�B��C������M�n��w�^��1� ��N�j�x.���/*n�tI�\"�2���\"��=r���\$:kwba.�1>3h(K�om�5;�2g�|B\"i�D�\rg�B�X%����r��V�\0n�\\�F�M��m\0~\\�͞���������4`�.�*\0�@�'9��� ��� d�	�{�6�瞠�\n��P놾I���n˛��Y��[�VXm^o�Ԣ��?g���<��P�@N��/K�s�D���e�P\0x�Ǥg�}[�sG俥����S5��u���%�%E���@���/���O�Ze{��LY)�)���B�R`�	�\n�����QCL��yh7�8�3\0˲\0�6�!�N�\"�\$�[�h�@�a������Z��Zd\"\\\"���Vg�9�[)��hN`��m�L��-�՟��fЍ�d �oX�h\"�kӸ�s�J���\"m��2�N2T.����u���ǜy�p�'�c)(�ݦ������[ɶ[�`�g;�SZ�Jz�K��&�jZ�Op���	�ɧ@˪Z�Jz�(Ӯ�@{����8\0_�Ł��\n3����/|u�0K��:�I��V��:YņEm�R�f�n��4f�o�w���1��r�N���2sb0�ق<�d������/�e���Gf���ZXɌ<I��<��,b\r�ǖ�K\r��J��\"H���+q�-w��P,�\$߫%U����,՘@�ӮLiT0K2yiĳ=|\\9wā�2�B���5\n�\r��ef���J]��ѳ�WG��yb'H���Q�\\��\n@�� �s#p��8P���}�}j\r�o���`\rE R�MMHJ�W �nt��\r�*No���C�MC���B�\"�_�H�k�R��N#]�d<.��\\X�e&_G�_��n%��9�ƛ�m�4�\\Veg��1��'a������o�\r5�p|[\0М@�h �t�P�bgӦ|)������l��{)��~��|��̙קsz1vt�FF)�X�A4y/�g�!g�hN�q��h�_j̏���k+�`�0�wo��SkW~,��~��P<3�h�����~�~DXE�	\"ɺ��kR�b�\$��B�I�!IYx��F%FTg�6�-X/�\"�Rmd��kXQ�`�FS���?V�7Uв�p�&��إ�sx@o��|��?MW�`�i�����HBC�9꥚�e�;���3�;HP\"L�5	��#���^��S�,����5`�#\"Nɢ��B,\$���o�&������n�;xZ-�]�>���q1 h�e:�\0\r�[\"���*�bw�&����6�Vr����\n�>�󹑭@�S��Ț��܋�>,�43�Y���\r*�=|�Rڍ0��9�il��!SL����\$��`dN �d�����%�2�5���2��(�V������BA ]�E ���x*�	dF�3���8�	{f(^����>�H&Mf�^M��ҙ�\0]�B�����\r	��U�����*���n���Pt���`'?\n�|,`:���{���x=��8��nHrFƧ�Z�psO\n|�	QN���,�O\\)�+\n���� �.�)��\nhY�0�,_�\\�n/\$�CۄX\nP(\n�`X,�͹��MpҬ��+�+@��ƌ8�V�5y�N@��'�#�dH��\0X���=	�k�V�� ��	��BA�P�ѝ��\r(��Y��dh~��q�b	���6����AR\0X���g�|���\r`�\\�8�H�.�� NJ���q�2�\r�ԉ2�[P� �C�J�	�V�'���K�[�����H@�K�Mt��T ��	�V��=!�%'� \n�V@��!S�~�ug���DWmɗ��Z�R-�kbr� ��iƬ=���08A�d�L�����YRS��!�\"rx�Y�C�\0�CF����^�{xȐ�Ÿ������\r\"��K��=;A��\0t �L���\"ו�Eѧ�X#\n��Ƶ/�|��<CW�t^��4�v�6�R\"�te�d)��^f6���l.��&��`G5�%RJ�MIB���#��9�T���-���D\"F�Xڍ1�����~ߪJ�.-jb�`�{�h�X�'��Q�HtzV��2G��!��|K*��#Gխ��~c��H1\n%�`�d3����bYx���nIȕ`Ƿ�y�I�LhB\0�=�l!A�zS��\r�MH�b\$�E6F�~I�ȵ^����aK���O�j*a�*�ϓt��0-2�\r|2�@�~��N���F6�Ě('`\"CPE\$�ep7��R^�@��&�/\$�Rz\r\\vL���?m��\"6����-��\n`q\$���@�I�!҄C움�'	9jK�v����(�6��\$�?[�5�ʒ#��D�C%)7Ŧ܂r�5��N�*A��̎2�쩘<Bc-I�R�8^��!QV]CFBS�/�zc�&�@yI\$��35�Ո�l��.HlK1� s�\"���5�\rҶ���\$�)�k�QjJ܀E�.�7�v^\"� �Rn%�=\n�t�o�8�^68@ħɦQ �M��xK8`0%�T3 ����i�qɠ�:��E��\\�d2��I�>p��\r�8�Y���i��]�UE��d��`��ԧ^#2���dE�b\0c�L/Y�!�O�T���ĸ˦���� ��eh���\n`j�ypxB`ð+�@4T؀ig����o\0��^P���SRum�ҏ�(��gߙܥ�;5y�̴9�,�Q�4�J��9q�'X�ݼP#�	���q8�?�%�4&��q.Yͤ:q�����)v�5�!��!ȅ�k8�ʀ� �{���\$I�KخQґٖж��'t�0~�K���Y��cH) |+&Z\"�@\nB �DE{�#eHL\"V���\"���y1 ����j)9ب��6�i�Y�>��s�-h�Ѓϱ�\0^m�d���9iz#'E��A@)�aX �Q0:F�0⷟C�Un���[b��ʳ��+iHL9c�v�-�!P��F�+d(K\"����b���d��Ƅ�@���_�C� %|�;Pxu�oxs��wD�\"GG�c����oV�\"<�@2�}�k�p�%��\r� \"\0G	\"\$����4�����C�x�J��\0�a��y����@���\n{C�k��Mt�4�S�# ��Ȱ�U�ph�xd������qc�Z\nG�(�>Æ\0���� �� �L�k��\$�>`@L��Ǔ;�6A-��Z�\$y��, @Z~V5�r�B�y� `\$�+��?I[RT ?���]�,;R�\r���e)�(�.5P%T����S��� ����5���\n'킦�U�>��[�:��N�r��A��sJ��Q03���?0�T,%CU5D��;�)QVP��ŕ&�6�hB�\\��H�VX0>�XA1��[�I0ؘ�ZDWR4��kI��,�æRzE�'Q;���`-�4��x����k��ťb��t��Tx`\$A(ܗM�-��S�L�e\"��D�a�1T\"�-u�1��6�4yQq�f\$Ɵ�l�|��(	��/���V���u�Qk�Y�X��&.��U�8�\"	j%fm�e�`syl%�<ڞ�TARMPK�� 3τ�K1�������`e)���Q�D@7cN�HpOVah �� �P�J�Np�Ğ\n�3+��0��gꐫ�@��Q�L-SH����<fM'%t�Ic\\�-��Q2��u�Rj��er�s����+D���P��&�{��_�u�*��Wt��'��itaW�S�OT��t�D[�����-�Jk��\$��-�%�����~bZz�%6 �C��� E�(���,�aw�I�][�VƉBҭv7��\n��Ȥ����q�M��[b�.��WҨN�_Y�d�V�(�,�\\l�b�'�pL�����dNtd��Ƣ�/13� L��Fx2���A�p�����~���1*�(3 �T91�B\0��y\$�a\\9�?h�����j5Qؕ4l��Go:-`�p��O�D��bw��]qRv=&�K@@ԯj\"H�AMd;zG@�KZ쑔��YqT�rC��䁧�le��jE�Z���Y1���tP*8�_��n[8]\$����M8V��?.P�E�jC�\0�	�IX@� \"�\0P��\n�R��d���v�YL3(\0�:��)�m�i��i��	94-;PT�m8��v�*�D����C�`\0��a��a����V��\\�� tA��N�p\0_	\"\0�Û��Uӡ,IɝH��������-�l�m�>۪\$e�[p�ڎ�*`Q)S�k��S`:Tb�;n+���v	�w�<v��\r��O���2Yۈ,��o=ʜD�t 8Q��P���av��f��~�}�W�#�e�L( )'#����r�\0���'�	�B�1G,�)TJ�:I�`�h'���Bd9�YP�*���(\0/��W\r���\0W{0>]���F(cK*�Y��T5��F��Zއx�0��=p��[��+�+O��.�݀�V��*QF�o)��Z��-�AQ��s�\\>�?�>�d�=t��g1Z2�L��6\\�҈x��2�X+5ˀΊ�2&n��I��\\��;���;�]i��\n�ƔBBN)�@�=�x���)��Kp��n2�]	o�ǩ�`AK�^�	�p+g��V�A���۵�W�GH�s�>!�اtv�4���	��3\\��	`nK]���,!�AS�|��B�se`1�'Db�`bd���#�6p�.aym\$=���pXw��eufV�݌�U�H���������%#�̽\rm(�]�\0L�F8�r�E]���\n2���u7i�fX�u&&pJ���W����Q斡 /'��6�R����.cx�ŅrUsE�̎���2_�U��N��G\0\\�-�Q�p<W�3OEN��!W����db2�M��,��{ty\0�g\"�ڮ�F�(>�e��%@K�\n���a��V�rö)���3��U&�zB�,8�\0-���\$���TWrl�R��Y�Qcp��k���Z�!_f!�_ ��(��2ð����Q�B2ٚ�*����5\".4'�=����a�,���*h[]�臅m��T]J����;\"ݳ��^��P*��n>0e�N�w�̵r��_���W�Z\"8��+J`���R�D�8b׷��Ӫ�X�.�:U�\$jdB�\0��ApR�sqP-��./F5`U�BV�F����s�z�3\"�����2��^���`05\0�&E*h��r�4`j`e��{C���0A\r��M/L[�s2�����Q�B�f���I�M�sv�A*�(�!�2�c�\0�/�p�s�,�'� y��O\r���E�؛Ed�2�q\\�����P�r��>�J𣮕���i>U��}ɾô'��_ 'Gꐓ�ü��f�����t�\n�����J�J�y��P�۠����TKU1�4�2GL+�Wv�d?�-���^A���]9���CI�6N�ă!A�#/��\n�hb,��a��]��`�: ������������k�q��`�\"�d@�4c�4����*���I���35���F��[m*a��F\n9VXWDX\\��A����߫L7Ri�؊����.�:mBD�B�3]�A�L���j���?#be�Ѐ�XSɌ��Ye\"�hm4k�d�c3��Q��L���3�M<C}�鮀'����y���~Fվ�?����;���B\"F��o�_�\"ղŮ�yȭ��M8����L^�Z��j#B��z�.t��N���BiȯP.C�k\r~��þ-�(a\"�A�%cc\0B'4���A��)�#G&�=ڣ�I���A�\r�Me���@3��5���x}�\r�c��	&�8���ScZ�E�_�nUJ�I~g9�3���\\'�N�K�Z�a��\n��g\$I�����<�\0�%fK������k�r�Fgߐ3&mI�;R����Y!@o���N�!��12 &�=��Θ����p*{h�Pv٨�f�M�.	c�B;�um��;p~�E߸:�D���ǋM��#�6�67���4J��4���Kđ�v��4b��Q�������3�B�w+�2[V��?&-sɞ�����w%�g�GU^wiuCH��Z�\0��;r�գ���6��#9\r�N�`�Ԟ�|aضHM�:���[��X��^���x��	�)v1`1�e6�lu<#���;7�cH�g.n�J�m�Ǩ��^7�`/�-���~ME�M�ngu`p	D	�S]�g�����L�����v������qao(����o����?��w�vx7����p�!0���J ��t��f�!���oi��On��+�e���_���y�ْ	�Ħ�w��~\$�W�oQ�\$�>�#un-F�i��w�-���\0��.���5�A�K�5/��dC�8����f��h��k�Z��Jb�ؘ���z��Q���p��V�q�\0R'�	�M���2��Jp>(�B��\0�t6I9�1s�~H�\"+g�P����q��-8]��y�2{S���a�\rn)k{hf)��F���2�L3�SQg|�GZ�L�֧J���>�H�>X?U\\��		�Œ��~��	�%�\"�5��ݖ��f�-�8�B,v�0�93���(��\\8� ��g�}P@3�Nei���U�H���F�֑<	���{�F��'��A)q�#S=p7r@���DN��	��Ck��}�E5�z0�����3J�+\0X^��6�G|��P�g��Ħ�P8�˻�\n�v�|(N�G�R>i������ �Z/�/�@��p>[��wfv^N�^N����X�4L���o��}�IZ����E��y��z{S+�����xA��% ��\\2T�e@ݫU�����־�������|h7/��fgD�&W�f�^���}Y@��8�4����H�t��7��ٝ=���fϺ��z��y��J�c�E�2�d�t�������|��:��X���{k���q��\\C�0�*Y)�~�kk\\�m�*(�9.{򱽋b�Tw�?:M�i�����Ŭ9�-�Z����E���8�3ɬ��\"�z=��!�5��.@'\\�m������0��WjF�N�\\������i��dA��8e>��j`0>�ºU�f�m ܛ=*f�#d�,Qm�A`�0�:��>�|BW�&\n�Ķ�	�Om3���#ŻV,����dwS*���O����b\$��;HbYS����G����Og�21��%JJI�3事\$�%���a��C�S�L��';k�\$����X�O%\$�	�1�q������f2��!�@c�XZ�!�Aw��=�Yfx��}�#1��ˎ�cמ1P�ٕ�?a���D@�d�����p��&>��2rJh�']`_*�\\@<\0����v�	�c|��z#�����zyq���&�;|���o���Y4�gHB�;s�|���mh?\$	�D(\0D��M���d�Q�Y_�x�J(!!O��C��h�7�S��;W��kK�g�=AP��X�m�R�JW�?��7�~�����G��K�\$�c��\$���}7f������Rg4�g����Q��w�Xch\"�����O����|y�&RFUO.����B�K�q��CU��G/��~���%�Q��n���tWX:�֐�v\"���*�p{2'�2(��9ڦH`hq�e;�#�@�~	�.�!:����H�Q���BT\$~�y�\n_�-'��&�@_6�&C�\"����	;4#?l3܍_��o�'e�<����Ȳ���\"/��'X\0f�Q�#�0nn�5#�6�vHS^8'`L����M���8V/SR~�����p�?���D��{�/�ڇh-o�-����A|����\0k���	�'I���d�*��~C�_:���� '����\0�M(Y��1��`+�������VAS塓�4����^H��ǎ�VY9�C҇�>�� p�����9jCx�\0���Z��\0�	:�Z�Z���.Hg�̄!��J`�ʂ�:�V�\$pmȃJx\0�V��%� f�	m�@̮�Jĩ��(�]#�� 	�{���o�H��2R��Lz:�A�|y0��\"4�R�T�/?�8����HRq!X&A`�!MA\"l��L �?��&�\0�����&�'h{,\\�!�AVR)(���PY��Os��'��yB�Ü�������!<�o�>���\0\\���^����Z4Mh~0E5�F\0��a�zJ���2HAb� ����d�4����Pˏ�RU��v2�Jb��0-�b���\r��A�:��p�v�h�s�[#�Pt�������@�8P�A�zQ�4�^R< ��#�;ps���y\$[�FS(9�k6��p_PVA���Bm{*0h� `A�6)���4\0�!Y����d	�@�Y��HB����.24Pl��n'\n|l)��A��N(9!�U��0RD#�t�|*5po�Ң�J<T�1Y��B,\n,nAA�;!\0���\$м�\"V|-��A�Vz2P��p�\0�>���vh]0u�\$���(ZL0kd	,1���!�D� �VJ��'@��̩`�5dPͻXE�nՆ��QP1@�l\r�ˉ�\r��2)�,�.0����:��p��X���Wk؀V�PM\0W2�ɝC������a�:���\0P`C�z��\r�JH-��<\na���( ��u��ga!&�\0001/�i<%�ȸڦh�D��̩XS�-�<AH~����i:,Ȱa�Tk�D\nG�b 1!.X:`�R�L.\0�k�r ���H[-S�L�\$�0�VH�����\\yk���OI�n�\0���*�BV��.DX�H�#X���[B��Lk���0��N0���c&!J��5G��詰< -���� �0��	�S�8#�!	Ԉ3�\$�	HH���3`N��U�0�p �{��xr������?PATOnr�*�[�%��dK�a�d�J�I�V\$y���į�[D������C�#�	BXT��E2��\0004\0ua��?�C�-Ņ���R�N\0N��L�b±,-�U8}Cčh��f����@�|	jxx%��D|��|���R.�[k6Dʀ�*�'\0�de�(");}elseif($_GET["file"]=="jush.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("v0��F����==��FS	��_6MƳ���r:�E�CI��o:�C��Xc��\r�؄J(:=�E���a28�x�?�'�i�SANN���xs�NB��Vl0���S	��Ul�(D|҄��P��>�E�㩶yHch��-3Eb�� �b��pE�p�9.����~\n�?Kb�iw|�`��d.�x8EN��!��2��3���\r���Y���y6GFmY�8o7\n\r�0��\0�Dbc�!�Q7Шd8���~��N)�Eг`�Ns��`�S)�O���/�<�x�9�o�����3n��2�!r�:;�+�9�CȨ���\n<�`��b�\\�?�`�4\r#`�<�Be�B#�N ��\r.D`��j�4���p�ar��㢺�>�8�\$�c��1�c���c����{n7����A�N�RLi\r1���!�(�j´�+��62�X�8+����.\r����!x���h�'��6S�\0R����O�\n��1(W0���7q��:N�E:68n+��մ5_(�s�\r��/m�6P�@�EQ���9\n�V-���\"�.:�J��8we�q�|؇�X�]��Y X�e�zW�� �7��Z1��hQf��u�j�4Z{p\\AU�J<��k��@�ɍ��@�}&���L7U�wuYh��2��@�u� P�7�A�h����3Û��XEͅZ�]�l�@Mplv�)� ��HW���y>�Y�-�Y��/�������hC�[*��F�#~�!�`�\r#0P�C˝�f������\\���^�%B<�\\�f�ޱ�����&/�O��L\\jF��jZ�1�\\:ƴ>�N��XaF�A�������f�h{\"s\n�64������?�8�^p�\"띰�ȸ\\�e(�P�N��q[g��r�&�}Ph���W��*��r_s�P�h���\n���om������#���.�\0@�pdW �\$Һ�Q۽Tl0� ��HdH�)��ۏ��)P���H�g��U����B�e\r�t:��\0)\"�t�,�����[�(D�O\nR8!�Ƭ֚��lA�V��4�h��Sq<��@}���gK�]���]�=90��'����wA<����a�~��W��D|A���2�X�U2��yŊ��=�p)�\0P	�s��n�3�r�f\0�F���v��G��I@�%���+��_I`����\r.��N���KI�[�ʖSJ���aUf�Sz���M��%��\"Q|9��Bc�a�q\0�8�#�<a��:z1Uf��>�Z�l������e5#U@iUG��n�%Ұs���;gxL�pP�?B��Q�\\�b��龒Q�=7�:��ݡQ�\r:�t�:y(� �\n�d)���\n�X;����CaA�\r���P�GH�!���@�9\n\nAl~H���V\ns��ի�Ư�bBr���������3�\r�P�%�ф\r}b/�Α\$�5�P�C�\"w�B_��U�gAt��夅�^Q��U���j���Bvh졄4�)��+�)<�j^�<L��4U*���Bg�����*n�ʖ�-����	9O\$��طzyM�3�\\9���.o�����E(i������7	tߚ�-&�\nj!\r��y�y�D1g���]��yR�7\"������~����)TZ0E9M�YZtXe!�f�@�{Ȭyl	8�;���R{��8�Į�e�+UL�'�F�1���8PE5-	�_!�7��[2�J��;�HR��ǹ�8p痲݇@��0,ծpsK0\r�4��\$sJ���4�DZ��I��'\$cL�R��MpY&����i�z3G�zҚJ%��P�-��[�/x�T�{p��z�C�v���:�V'�\\��KJa��M�&���Ӿ\"�e�o^Q+h^��iT��1�OR�l�,5[ݘ\$��)��jLƁU`�S�`Z^�|��r�=��n登��TU	1Hyk��t+\0v�D�\r	<��ƙ��jG���t�*3%k�YܲT*�|\"C��lhE�(�\r�8r��{��0����D�_��.6и�;����rBj�O'ۜ���>\$��`^6��9�#����4X��mh8:��c��0��;�/ԉ����;�\\'(��t�'+�����̷�^�]��N�v��#�,�v���O�i�ϖ�>��<S�A\\�\\��!�3*tl`�u�\0p'�7�P�9�bs�{�v�{��7�\"{��r�a�(�^��E����g��/���U�9g���/��`�\nL\n�)���(A�a�\" ���	�&�P��@O\n師0�(M&�FJ'�! �0�<�H�������*�|��*�OZ�m*n/b�/�������.��o\0��dn�)����i�:R���P2�m�\0/v�OX���Fʳψ���\"�����0�0�����0b��gj��\$�n�0}�	�@�=MƂ0n�P�/p�ot������.�̽�g\0�)o�\n0���\rF����b�i��o}\n�̯�	NQ�'�x�Fa�J���L������\r��\r����0��'��d	oep��4D��ʐ�q(~�� �\r�E��pr�QVFH�l��Kj���N&�j!�H`�_bh\r1���n!�Ɏ�z�����\\��\r���`V_k��\"\\ׂ'V��\0ʾ`AC������V�`\r%�����\r����k@N����B�횙� �!�\n�\0Z�6�\$d��,%�%la�H�\n�#�S\$!\$@��2���I\$r�{!��J�2H�ZM\\��hb,�'||cj~g�r�`�ļ�\$���+�A1�E���� <�L��\$�Y%-FD��d�L焳��\n@�bVf�;2_(��L�п��<%@ڜ,\"�d��N�er�\0�`��Z��4�'ld9-�#`��Ŗ����j6�ƣ�v���N�͐f��@܆�&�B\$�(�Z&���278I ��P\rk\\���2`�\rdLb@E��2`P( B'�����0�&��{���:��dB�1�^؉*\r\0c<K�|�5sZ�`���O3�5=@�5�C>@�W*	=\0N<g�6s67Sm7u?	{<&L�.3~D��\rŚ�x��),r�in�/��O\0o{0k�]3>m��1\0�I@�9T34+ԙ@e�GFMC�\rE3�Etm!�#1�D @�H(��n ��<g,V`R]@����3Cr7s~�GI�i@\0v��5\rV�'������P��\r�\$<b�%(�Dd��PW����b�fO �x\0�} ��lb�&�vj4�LS��ִԶ5&dsF M�4��\".H�M0�1uL�\"��/J`�{�����xǐYu*\"U.I53Q�3Q��J��g��5�s���&jь��u�٭ЪGQMTmGB�tl-c�*��\r��Z7���*hs/RUV����B�Nˈ�����Ԋ�i�Lk�.���t�龩�rYi���-S��3�\\�T�OM^�G>�ZQj���\"���i��MsS�S\$Ib	f���u����:�SB|i��Y¦��8	v�#�D�4`��.��^�H�M�_ռ�u��U�z`Z�J	e��@Ce��a�\"m�b�6ԯJR���T�?ԣXMZ��І��p����Qv�j�jV�{���C�\r��7�Tʞ� ��5{P��]�\r�?Q�AA������2񾠓V)Ji��-N99f�l Jm��;u�@�<F�Ѡ�e�j��Ħ�I�<+CW@�����Z�l�1�<2�iF�7`KG�~L&+N��YtWH飑w	����l��s'g��q+L�zbiz���Ţ�.Њ�zW�� �zd�W����(�y)v�E4,\0�\"d��\$B�{��!)1U�5bp#�}m=��@�w�	P\0�\r�����`O|���	�ɍ����Y��JՂ�E��Ou�_�\n`F`�}M�.#1��f�*�ա��  �z�uc���� xf�8kZR�s2ʂ-���Z2�+�ʷ�(�sU�cD�ѷ���X!��u�&-vP�ر\0'L�X �L����o	��>�Վ�\r@�P�\rxF��E��ȭ�%����=5N֜��?�7�N�Å�w�`�hX�98 �����q��z��d%6̂t�/������L��l��,�Ka�N~�����,�'�ǀM\rf9�w��!x��x[�ϑ�G�8;�xA��-I�&5\$�D\$���%��xѬ���´���]����&o�-3�9�L��z���y6�;u�zZ ��8�_�ɐx\0D?�X7����y�OY.#3�8��ǀ�e�Q�=؀*��G�wm ���Y�����]YOY�F���)�z#\$e��)�/�z?�z;����^��F�Zg�����������`^�e����#�������?��e��M��3u�偃0�>�\"?��@חXv�\"������*Ԣ\r6v~��OV~�&ר�^g���đٞ�'��f6:-Z~��O6;zx��;&!�+{9M�ٳd� \r,9���W��ݭ:�\r�ٜ��@睂+��]��-�[g��ۇ[s�[i��i�q��y��x�+�|7�{7�|w�}����E��W��Wk�|J؁��xm��q xwyj���#��e��(�������ߞþ��� {��ڏ�y���M���@��ɂ��Y�(g͚-��������J(���@�;�y�#S���Y��p@�%�s��o�9;�������+��	�;����ZNٯº��� k�V��u�[�x��|q��ON?���	�`u��6�|�|X����س|O�x!�:���ϗY]�����c���\r�h�9n�������8'������\rS.1��USȸ��X��+��z]ɵ��?����C�\r��\\����\$�`��)U�|ˤ|Ѩx'՜����<�̙e�|�ͳ����L���M�y�(ۧ�l�к�O]{Ѿ�FD���}�yu��Ē�,XL\\�x��;U��Wt�v��\\OxWJ9Ȓ�R5�WiMi[�K��f(\0�dĚ�迩�\r�M����7�;��������6�KʦI�\r���xv\r�V3���ɱ.��R������|��^2�^0߾\$�Q��[�D��ܣ�>1'^X~t�1\"6L���+��A��e�����I��~����@����pM>�m<��SK��-H���T76�SMfg�=��GPʰ�P�\r��>�����2Sb\$�C[���(�)��%Q#G`u��Gwp\rk�Ke�zhj��zi(��rO�������T=�7���~�4\"ef�~�d���V�Z���U�-�b'V�J�Z7���)T��8.<�RM�\$�����'�by�\n5����_��w����U�`ei޿J�b�g�u�S��?��`���+��� M�g�7`���\0�_�-���_��?�F�\0����X���[��J�8&~D#��{P���4ܗ��\"�\0��������@ғ��\0F ?*��^��w�О:���u��3xK�^�w���߯�y[Ԟ(���#�/zr_�g��?�\0?�1wMR&M���?�St�T]ݴG�:I����)��B�� v����1�<�t��6�:�W{���x:=��ޚ��:�!!\0x�����q&��0}z\"]��o�z���j�w�����6��J�P۞[\\ }��`S�\0�qHM�/7B��P���]FT��8S5�/I�\r�\n ��O�0aQ\n�>�2�j�;=ڬ�dA=�p�VL)X�\n¦`e\$�TƦQJ��k�7�*O�� .����ġ�\r���\$#p�WT>!��v|��}�נ.%��,;�������f*?�焘��\0��pD��! ��#:MRc��B/06���	7@\0V�vg����hZ\nR\"@��F	����+ʚ�E�I�\n8&2�bX�PĬ�ͤ=h[���+�ʉ\r:��F�\0:*��\r}#��!\"�c;hŦ/0��ޒ�Ej�����]�Z�����\0�@iW_���h�;�V��Rb��P%!��b]SB����Ul	����r��\r�-\0��\"�Q=�Ih����	 F���L��FxR�э@�\0*�j5���k\0�0'�	@El�O���H�Cx�@\"G41�`ϼP(G91��\0��\"f:Qʍ�@�`'�>7�Ȏ�d�����R41�>�rI�H�Gt\n�R�H	��bҏ��71���f�h)D��8�B`���(�V<Q�8c? 2���E�4j\0�9��\r�͐�@�\0'F�D��,�!��H�=�*��E�(���?Ѫ&xd_H�ǢE�6�~�u��G\0R�X��Z~P'U=���@����l+A�\n�h�IiƔ���PG�Z`\$�P������.�;�E�\0�}� ��Q�����%���jA�W�إ\$�!��3r1� {Ӊ%i=IfK�!�e\$���8�0!�h#\\�HF|�i8�tl\$���l����l�i*(�G���L	 �\$��x�.�q\"�Wzs{8d`&�W��\0&E����15�jW�b��ć��V�R����-#{\0�Xi���g*��7�VF3�`妏�p@��#7�	�0��[Ү���[�éh˖\\�o{���T���]��Ŧᑀ8l`f@�reh��\n��W2�*@\0�`K(�L�̷\0vT��\0�c'L����:�� 0��@L1�T0b��h�W�|\\�-���DN��\ns3��\"����`Ǣ�肒�2��&��\r�U+�^��R�eS�n�i0�u˚b	J����2s��p�s^n<���♱�Fl�a�\0���\0�mA2�`|؟6	��nr���\0Dټ��7�&m�ߧ-)���\\���݌\n=���;*���b��蓈�T��y7c��|o�/����:���t�P�<��Y:��K�&C��'G/�@��Q�*�8�v�/��&���W�6p.\0�u3����Bq:(eOP�p	�駲���\r���0�(ac>�N�|��	�t��\n6v�_��e�;y���6f���gQ;y�β[S�	��g�ǰ�O�ud�dH�H�=�Z\r�'���qC*�)����g��E�O�� \"��!k�('�`�\nkhT��*�s��5R�E�a\n#�!1�����\0�;��S�iȼ@(�l���I� �v\r�nj~��63��Έ�I:h����\n.��2pl�9Bt�0\$b��p+�ǀ*�tJ����s�JQ8;4P(��ҧѶ!��.Ppk@�)6�5��!�(��\n+��{`=��H,Ɂ\\Ѵ�4�\"[�C���1���-���luo��4�[���E�%�\"��w] �(� ʏTe��)�K�A�E={ \n�`;?���-�G�5I���.%�����q%E���s���gF��s	�����K�G��n4i/,�i0�u�x)73�Szg���V[��h�Dp'�L<TM��jP*o�≴�\nH���\n�4�M-W�N�A/@�8mH��Rp�t�p�V�=h*0��	�1;\0uG��T6�@s�\0)�6��ƣT�\\�(\"���U,�C:��5i�K�l���ۧ�E*�\"�r����.@jR�J�Q��/��L@�SZ���P�)(jj�J������L*���\0���\r�-��Q*�Qڜg��9�~P@���H���\n-e�\0�Qw%^ ET�< 2H�@޴�e�\0� e#;��I�T�l���+A+C*�Y���h/�D\\�!鬚8�»3�AЙ��E��E�/}0t�J|���1Qm��n%(�p��!\n��±U�)\rsEX���5u%B- ��w]�*��E�)<+��qyV�@�mFH ���BN#�]�YQ1��:��V#�\$������<&�X������x��t�@]G��Զ��j)-@�q��L\nc�I�Y?qC�\r�v(@��X\0Ov�<�R�3X���Q�J����9�9�lxCuīd�� vT�Zkl\r�J��\\o�&?�o6E�q������\r���'3��ɪ�J�6�'Y@�6�FZ50�V�T�y���C`\0��VS!���&�6�6���rD�f`ꛨJvqz���F�����@�ݵ��҅Z.\$kXkJ�\\�\"�\"�֝i��:�E���\roX�\0>P��P�mi]\0�����aV��=���I6�����jK3���Z�Q�m�E���b�0:�32�V4N6����!�l�^ڦ�@h�hU��>:�	��E�>j�����0g�\\|�Sh�7y�ބ�\$��,5aė7&��:[WX4��q� ���J���ׂ�c8!�H���VD�Ď�+�D�:����9,DUa!�X\$��Я�ڋG�܌�B�t9-+o�t��L��}ĭ�qK��x6&��%x��tR�����\"�π�R�IWA`c���}l6��~�*�0vk�p���6��8z+�q�X��w*�E��IN�����*qPKFO\0�,�(��|�����k *YF5���;�<6�@�QU�\"��\rb�OAXÎv��v�)H��o`ST�pbj1+ŋ�e��� ʀQx8@�����5\\Q�,���ĉN��ޘb#Y�H��p1����kB�8N�o�X3,#Uک�'�\"�销�eeH#z��q^rG[��:�\r�m�ng����5��V�]��-(�W�0���~kh\\��Z��`��l����k �o�j�W�!�.�hF���[t�A�w�e�M૫��3!����nK_SF�j���-S�[r�̀w��0^�h�f�-����?���X�5�/������IY �V7�a�d �8�bq��b�n\n1YR�vT���,�+!����N�T��2I�߷�����������K`K\"�����O)\nY��4!}K�^����D@��na�\$@� ��\$A��j����\\�D[=�	bHp�SOAG�ho!F@l�U��`Xn\$\\�͈_��˘`���HB��]�2���\"z0i1�\\�����w�.�fy޻K)����� p�0���X�S>1	*,]��\r\"���<cQ��\$t��q��.��	<��+t,�]L�!�{�g���X��\$��6v����� ����%G�H������E����X��*��0ۊ)q�nC�)I���\"�����툳�`�KF����@�d�5��A��p�{�\\���pɾN�r�'�S(+5�Њ+�\"�Ā�U0�iː����!nM��brK���6ú�r���|a����@�x|��ka�9WR4\"?�5��p�ۓ��k�rĘ����ߒ����7Hp��5�YpW���G#�rʶAWD+`��=�\"�}�@H�\\�p���Ѐ�ߋ�)C3�!�sO:)��_F/\r4���<A��\nn�/T�3f7P1�6����OYлϲ���q��;�؁���a�XtS<��9�nws�x@1Ξxs�?��3Ş@���54��o�ȃ0����pR\0���������yq��L&S^:��Q�>\\4OIn��Z�n��v�3�3�+P��L(�������.x�\$�«C��Cn�A�k�c:L�6���r�w���h����nr�Z��=�=j�ђ���6}M�G�u~�3���bg4���s6s�Q��#:�3g~v3���<�+�<���a}ϧ=�e�8�'n)ӞcC�z��4L=h��{i����J�^~��wg�D�jL���^����=6ΧN�Ӕ����\\��D���N���E�?h�:S�*>��+�u�hh҅�W�E1j�x����t�'�t�[��wS���9��T��[�,�j�v����t��A#T���枂9��j�K-��ޠ���Y�i�Qe?��4Ӟ���_Wz����@JkWY�h��pu����j|z4���	�i��m�	�O5�\0>�|�9�ז��轠��gVy��u���=}gs_���V�sծ{�k�@r�^���(�w����H'��a�=i��N�4����_{�6�tϨ��ϗe�[�h-��Ul?J��0O\0^�Hl�\0.��Z������xu���\"<	�/7���� ���i:��\nǠ���;��!�3���_0�`�\0H`���2\0��H�#h�[�P<��עg����m@~�(��\0ߵk�Y�v���#>���\nz\n�@�Q�\n(�G��\n����'k����5�n�5ۨ�@_`Ї_l�1���wp�P�w���\0��c��oEl{�ݾ�7����o0����Ibϝ�n�z����﷛� ���{�8�w�=��|�/y�3a�߼#xq����@��ka�!�\08d�m��R[wvǋRGp8���v�\$Z���m��t��������������ǽ����u�o�p�`2��m|;#x�m�n�~;��V�E�������3O�\r�,~o�w[��N��}�� �cly��O����;��?�~�^j\"�Wz�:�'xW��.�	�u�(��Ý�q��<g��v�hWq��\\;ߟ8��)M\\��5vڷx=h�i�b-���|b���py�DЕHh\rce��y7�p��x��G�@D=� ����1��!4Ra\r�9�!\0'�Y����@>iS>����o��o��fsO 9�.����\"�F��l��20��E!Q���ːD9d�BW4��\0��y`RoF>F�a��0�����0	�2�<�I�P'�\\���I�\0\$��\n R�aU�.�sЄ��\"���1І�e�Y砢�Z�q��1�|��#�G!�P�P\0|�H�Fnp>W�:��`YP%�ď�\n�a8��P>�����`]��4�`<�r\0�Î������z�4����8�����4�`m�h:�Ϊ�HD���j�+p>*����8�ՠ0�8�A��:���с�]w�ú�z>9\n+�������:����ii�PoG0���1��)�Z�ږ�n�����eR֖��g�M�����gs�LC�r�8Ѐ�!�����3R)��0�0��s�I��J�VPpK\n|9e[���ˑ��D0����z4ϑ�o������,N8n��s�#{蓷z3�>�BS�\";�e5VD0���[\$7z0������=8�	T 3���Q�'R������n��L�yŋ��'�\0o��,��\0:[}(���|���X�>xvqW�?tB�E1wG;�!�݋5΀|�0��JI@��#���uņI��\\p8�!'�]߮��l-�l�S�B��,ӗ���]��1�ԕH��N�8%%�	��/�;�FGS���h�\\ل�c�t����2|�W�\$t��<�h�O��+#�B�aN1��{��y�w���2�\\Z&)�d�b'��,Xxm�~�H��@:d	>=-��lK��܏�J�\0���́�@�rϥ�@\"�(A����Z�7�h>����\\����#>���\0��Xr�Y��Yxŝ�q=:��Թ�\rl�o�m�gb��������D_�Tx�C���0.��y��R]�_���Z�ǻW�I��G��	Mɪ(��|@\0SO��s� {��@k}��FXS�b8��=��_����l�\0�=�g��{�H��yG���� s�_�J\$hk�F�q������d4ω����'���>vϏ��!_7�Vq��@1z�uSe��jKdyu���S�.�2�\"�{��K���?�s��˦h��R�d��`:y����Gھ\nQ�����ow��'��hS��>���L�X}��e���G��@9��퟈�W�|��Ϲ�@�_��uZ=��,���!}���\0�I@��#��\"�'�Y`��\\?��p��,G����ל_��'�G����	�T��#�o��H\r��\"���o�}��?��O鼔7�|'���=8�M��Q�y�a�H�?��߮� ���\0���bUd�67���I O����\"-�2_�0�\r�?�������hO׿�t\0\0002�~�° 4���K,��oh��	Pc���z`@��\"�����H; ,=��'S�.b��S����Cc���욌�R,~��X�@ '��8Z0�&�(np<pȣ�32(��.@R3��@^\r�+�@�,���\$	ϟ��E���t�B,���⪀ʰh\r�><6]#���;��C�.Ҏ����8�P�3��;@��L,+>���p(#�-�f1�z���,8�ߠ��ƐP�:9����R�۳����)e\0ڢR��!�\nr{��e����GA@*��n�D��6��������N�\r�R���8QK�0��颽��>PN���IQ=r<�;&��f�NGJ;�UA�����A�P�&������`�����);��!�s\0���p�p\r�����n(��@�%&	S�dY����uC�,��8O�#�����o���R�v,��#�|7�\"Cp����B�`�j�X3�~R�@��v�����9B#���@\n�0�>T�����-�5��/�=� ���E����\n��d\"!�;��p*n��Z�\08/�jX�\r��>F	Pϐe>��O��L����O0�\0�)�k���㦃[	��ϳ���'L��	����1 1\0��C�1T�`����Rʐz�Ě����p��������< .�>�5��\0���>� Bnˊ<\"he�>к�î��s�!�H�{ܐ�!\r�\r�\"��|��>R�1d���\"U@�D6����3���>o\r����v�L:K�2�+�0쾁�>��\0�� ���B�{!r*H��y;�`8\0��د��d����\r�0���2A����?��+�\0�Å\0A����wS��l����\r[ԡ�6�co�=����0�z/J+�ꆌ�W[��~C0��e�30HQP�DPY�}�4#YD���p)	�|�@���&�-��/F�	�T�	����aH5�#��H.�A>��0;.���Y�ġ	�*�D2�=3�	pBnuDw\n�!�z�C�Q \0��HQ4D�*��7\0�J��%ıp�uD�(�O=!�>�u,7��1��TM��+�3�1:\"P�����RQ?���P���+�11= �M\$Z��lT7�,Nq%E!�S�2�&��U*>GDS&����ozh8881\\:��Z0h���T �C+#ʱA%��D!\0�����XDA�3\0�!\\�#�h���9b��T�!d�����Y�j2��S����\nA+ͽ��H�wD`�(AB*��+%�E��X.ˠB�#��ȿ��&��Xe�Eo�\"��|�r��8�W�2�@8Da�|�������N�h����J8[�۳����W�z�{Z\"L\0�\0��Ȇ8�x�۶X@�� �E����h;�af��1��;n��hZ3�E����0|� 옑��A���t�B,~�W�8^�Ǡ׃��<2/	�8�+��۔���O+�%P#ή\n?�߉?��e˔�O\\]�7(#��D۾�(!c)�N����MF�E�#DX�g�)�0�A�\0�:�rB��``  ��Q��H>!\rB��\0��V%ce�HFH��m2�B�2I����`#���D>���n\n:L���9C���0��\0��x(ޏ�(\n����L�\"G�\n@���`[���\ni'\0��)������y)&��(p\0�N�	�\"��N:8��.\r!��'4|ל~����ʀ���\"�c��Dlt����0c��5kQQר+�Z��Gk�!F��c�4��Rx@�&>z=��\$(?���(\n쀨>�	�ҵ���Cqی��t-}�G,t�GW �xq�Hf�b\0�\0z���T9zwЅ�Dmn'�ccb�H\0z���3�!����� H��Hz׀�Iy\",�-�\0�\"<�2���'�#H`�d-�#cl�jĞ`��i(�_���dgȎ�ǂ*�j\r�\0�>� 6���6�2�kj�<�Cq��9�Đ��I\r\$C�AI\$x\r�H��7�8 ܀Z�pZrR����_�U\0�l\r��IR�Xi\0<����r�~�x�S��%��^�%j@^��T3�3ɀGH�z��&\$�(��q\0��f&8+�\rɗ%�2hC�x���I��lbɀ�(h�S�Y&��B������`�f��x�v�n.L+��/\"=I�0�d�\$4�7r����A���(4�2gJ(D��=F�����(����-'Ġ�XG�2�9Z=���,��r`);x\"��8;��>�&�����',�@��2�pl���:0�lI��\rr�JD���������hA�z22p�`O2h��8H��Ąwt�BF���g`7���2{�,Kl���߰%C%�om���������+X����41򹸎\n�2p��	ZB!�=V�ܨ�Ȁ�+H6���*��\0�k���%<� �K',3�r�I�;��8\0Z�+Eܭ�`������+l����W+�Yҵ-t��f�b�Q��_-Ӏޅ�+�� 95�LjJ.Gʩ,\\��ԅ.\$�2�J�\\�-��1�-c���ˇ.l�f�xBqK�,d��ˀ�8�A�Ko-��������3K��r��/|����/\\�r���,��HϤ�!�Y�1�0�@�.�&|����+��J\0�0P3J�-ZQ�	�\r&����\n�L�*���j�ĉ|�����#Ծ�\"˺���A��/���8�)1#�7\$\"�6\n>\n���7L�1���h9�\0�B�Z�d�#�b:\0+A���22��'̕\nt���̜�O��2lʳ.L��HC\0��2���+L�\\��r�Kk+���˳.ꌒ�;(Dƀ���1s����d�s9�����P4�쌜��@�.���A��nhJ�1�3�K�0��3J\$\0��2�Lk3��Q�;3��n\0\0�,�sI�@��u/VA�1���UM�<�Le4D�2��V�% �Ap\nȬ2��35���A-��T�u5�3�۹1+fL~�\n���	��->�� �ҡM�4XL�S��dٲ�͟*\\�@ͨ��Y�k����SDM�5 Xf����D�s���Us%	�̱p+K�6��/���ݒ�8X�ނ=K�6pH����%�3�ͫ7l�I�K0���L��D��u���`��P\r��SO͙&(;�L@��ψN>S��2��8(���`J�E��r�F	2��SE��M��M��\$q�E��\$�ã/I\$\\���ID�\"��\n䱺�w.t�S	���ђP��#\nW��-\0Cҵ�:j�R��^S���8;d�`���5Ԫ�aʖ��E��+(Xr�M�;��3�;���B,��*1&����2X�S���)<� �L9;�RSN����gIs+��ӰK�<��s�LY-Z�:A<���OO*��2v�W7��+|���˻<T���9�h����y\$<��#ρ;����v�\$��O�\0� �,Hk��-���Ϛ\r����ϣ;���O�>�����7>��3@O{.4�pO�?T�b���.�.~O�4��S���>1SS��*4�Pȣ�>�����3�\0�W�>��2��><���P?4��@��t\nN����A�xp��%=P@��C�@�R�˟?x��\n���0N�w�O?�TJC@��#�	.d���M��t�&=�\\�4��A��:L����\$���N��:��\r��I'���A�rግ;\r�/��C���B�Ӯ�i>L��7:9�����|�C\$��)�����z@�tl�:>��C�\n�Bi0G��,\0�FD%p)�o\0����\n>��`)QZI�KG�%M\0#\0�D���Q.H�'\$�E\n �\$ܐ%4I�D�3o�:L�\$��m ��0�	�B�\\(����8��通�h��D��C�sDX4TK���{��x�`\n�,��\nE��:�p\n�'��>��o\0���tI��` -\0�D��/��KP�`/���H�\$\n=���>��U�FP0���UG}4B\$?E����%�T�WD} *�H0�T�\0t������\"!o\0�E�7��R.���tfRFu!ԐD�\n�\0�F-4V�QH�%4��0uN\0�D�QRuE�	)��I\n�&Q�m�)ǚ�m �#\\����D��(\$̓x4��WFM&ԜR5H�%q��[F�+���IF \nT�R3D�L�o���y4TQ/E��[ў<�t^��F��)Q��+4�Q�I�#���IF�'TiѪX��!ѱF�*�nR�>�5�p��Km+�s��������I���R�E�+ԩ��M\0��(R�?�+HҀ�J�\"T�D���\$���	4wQ�}Tz\0�G�8|�x���R��6�R�	4XR6\n�4y�mN��Q�NM�&R�H&�2Q/�7#�қ�{�'�ҍ,|����\n�	.�\0�>�{�o#1D�;��?U��ҕJ�9�*����j����F�N��щJ� #�~%-?C���L�3�@EP�{`>Q�Ȕ��%O�)4�R%I�@��%,�\"���I�<�����\$ԉTP>�\n�\0QP5D��kOF�TY�<�o�Q�=T�\0��x	5�D�,�0?�i�?x�  �mE}>�|����[��\0����&RL���H�S9�G�I��1䀖��M4V�H�oT-S�)Q�G�F [��TQRjN��#x]N(�U�8\nuU\n?5,TmԞ?����?��@�U\n�u-��R�9��U/S \nU3�IESt�QYJu.�Q��F�o\$&���i	��KPC�6�>�5�G\0uR��u)U'R�0�Ѐ�DuIU�J@	��:�V8*�Rf%&�\\�R��MU9R��fUAU[T�UQSe[��\0�KeZUa��Uh��mS<���,R�s�`&Tj@��G�!\\x�^�0>��\0&��p�΂Q�Q�)T�U�Ps�@%\0�W�	`\$��(1�Q?�\$C�Qp\n�O�J��X�#��V7X�u;�!YB��S�c��+V����#MU�W�H��U�R�ǅU-+��VmY}\\���OK�M��\$�S�eToV���HT��!!<{�R��ZA5�R�!=3U��(�{@*Ratz\0)Q�P5H؏���հ�N5+���P�[��9�V%\"����\n����G�SL�����9�����l����\rV�ؤ�[�ou�UIY�R_T�Y�p5O֧\\�q`�U�[�Bu'Uw\\mRU�ԭ\\Es5�K\\���V�\\�S�{�AZ%O��\$��F���>�5E�WVm`��Wd]& \$�Ό����!R�Z}ԅ]}v5���ZUg��Q^y` �!^=F��R�^�v�U�Kex@+��r5�#�@?=�u�Γs���ץY�N�sS!^c�5�\$.�u`��\0�XE~1�9��J�UZ�@�#1_[�4J�2�\n�\$VI�4n�\0�?�4a�R�!U~)&��B>t�R�I�0��_EkTUS��|��Uk_�8�&��E��(‘?�@���J�5���JU�BQT}HV��j��Qx\ne�VsU=���V�N�4ղؗ\\x����R34�G�D\":	KQ�>�[�\r�Y_�#!�#][j<6خX	���c���#KL}>`'\0��5�X�cU�[\0��(���Wt|t�R]p�/�]H2I�QO��1�S�Qj�Z����H���m���)d�^SXCY\r�tu@J�p��%��M������?�UQ�\n�=R�ar:ԿE���-G�\0\$��d���]�meh*��Q�Wt��c��`��A�Y=S\r���	m-���=Mw�H�]J�\"䴏������f�\"�{#9Te����M�c��N�I����D������U�6��g��2��ݝ�e�a�L��Q&&uT�X�51Y�>����S�֊Q#�I���j�\0����W�P��?ub5FU�Ln�)V5R�@��\$!%o��P��'��E�U��P�-����B�p\n�F\$�S4�t�UF|{�q�ȓ0���Umjs�������\$�ڛj��c�ڐ��֫��aZI5X��j�26��&>v��\n\r)2�_k�G��TJ��eQ-c�Z�VM�ֽ�z>�]�a�c��c��`t��H��j�6��+k�M�\0�>���##3l=�'���^6�\0�èv�Z9Se��\"���bΡ�B>�)�/T�=�9\0�`P�\$\0�]�/0ڪ��䵏�k-�6��{k���[�F\r|�SѿJ��MQ�D=�/�WX���V�a�'���a�to��l冶�Xj}C@\"�KP����om�3\0#HV���v��~�{���?gx	n|[�?U��[r�h��G�`�3#Gk%L��\0�I�`C�D��	 \"\0��ŧ��#cN�6�ڹf���zێ�;Ѥ�eeF�7�/N\r:��Q�G�9	\$��I�ռ��]��T��WGs��dW�M�I����f�Bc�ۤ����!#cnu&(�S�_�w��Sf�&T�Z:��0C�S�LN`ܳYj=��>Ų��Z!=�rV]g��	ӣr���Xl��-.�U�'uJuJ\0�s�J�'W%���\\>?�B��V�j4���J}I/-ҝrRL�S�3\0,Rgqӭ��Tf>�1��\0�_���\\V8��Z�t��c耆�<^\\�ll�j\0���T�]C��w�ΓzI��ZwN���pVW�jv�Y�>�2�	o\$|U�W�L%{toX3_���R�J5~6\"��Zl}�`�kc����eR=^UԎ��1�ѽw7e�d��v��b�=��\0�f��,��m�)��Gp��-Ӽ�)9L���>|�� \"�@���5�`�:��\0�,��t@��x���l�J���b�6������a��A\0ػAR�[A���0\$qo�A��S��@���<@�y��\"as.����V^��讥^�����\0��H���[H@�bK����)z�\r����=��^�z�B\0�����N�o<̇t<�x�\0ڬ0*R��I{��^�E�:�{KՐ�1E�0��Y����/��c��\"\0��4���F�7'���\n�0��`U�T��?MP���l��4��r(	��Z�|���&��t\"I����L�w+�m}����Wi\r>�U__u��63�y[�8�T-��V�}�x��_~�%�7��{jM�o_�E�����~]�P\$�J�CaXG�9�\0007Ń5�A#�\0.���\r˴��_������%����\n�\r#<M�x�J���|��2�\0��;o�^a+F���笀Lk��;�_���#��M\\����pr@��õ�����OR���~z��A�NE�Y�O	(1N׉�R��8��C�����n?O)��1�A�Do\0�\r�Ǣ?�kJ��\"�,�OF��a����-b�6]PS�)ƙ�5xC�=@j����L�����L�:\"胻Ί�l#���B�k��������@��N��:�>�|B����9�	���:N��\$��S� �CB:j6����ΉJk��uK�_�W�͢ØI�=@Tv��\n0^o�\\�Ӡ?/��&u�.��_��\r��C��+��c�~�J�b�6���e\0�y�ѡ\0wx�h��8j%S���VH@N'�\\ۯ��N�`n\r��u�n�K�qU�B�+�f>G��\r���=@G���d���\n�)��FO� hʷ��ÈfC�ɅX|��I�]��3auy�Ui^�9y�\no^rt\r8��͇#����N	V��Y�;�c*�%V�<��#�h9r�\rxc�v(\ra���(xja�`g�0�V̼���Q��x(���glհ{��gh`sW<Kj�'�;)�Gnq\$�p�+�Ɍ_��d��^& ���D�x�!b�v�!EjPV�'����(�=�b�\r�\"�b��L�\0���bt�\n>J���1;�����ۈ�4^s�Q�p`�fr`7���x��E<l���	8s��'PT��ֺ�˃��z_�T[>��:��`�1.���;7�@��[��>��6!�*\$`��\0���`,�������@����?�m�>�>\0�LCǸ�R��n��/+�`;C����\0�*�<F���+���q M���;1�K\n�:b�3j1��l�:c>�Y���h���ގ�#�;���3ֺ�8�5�:�\\��\0XH���a�����M1�\\�L[YC��vN��\0+\0��t#�\$�����!@*�l��	F�dhd���F���&��Ƙf�)=��0��4�x\0004ED�6K��䢣���\0�nN�];q�4sj-�=-8���\0�sǨ���D�f5p4����J�^���'Ӕ[��H^�NR F�Kw�z�� ��E����gF|!�c���o�db����x�\0�-��6�,E��_���3u�p ��/�wz�(��ex�Ra�H�Y�ce��5�9d\0�0@2@Ґ�Y�fey��Y�cMו�h����[�ez\rv\\0�e���\\�cʃ��[�ue��NY`��ۖ�]9h姗~^Yqe���]�qe_|6!���u�`�f��J�{�7��M{�Yه��j�e��C��S6\0DuasFL}�\$ȇ�(��Mb���Ƥ,0Buί���т2�gxFљ{�a�n:i\rPj�e��r�r��G�BY��M+q��iY�d˙�`0��,>6�fo�0���o�� �Xf����\0�V�L!��f��l��6� �/��1e��\0�>kbf�\r�!�uf�<%�(r˛�a&	����Y��!���mBg=@��\r�; \r�5phI�9bm�\$BYˋ���g�x�#�@QEO��m9���0\"���!�t���ˉ��Ї�O* ���\0��>%�\$�o�rN&s9�f��4���g��~jM�f�wy�g�y�\\`X1y5x����^z�_,& k���|����1x��A�6� \n�o蔻�&x��gg�{r�?緛�-����|t�3�����}gHgK�9����J�<C�C��1��9�7��g����h6!0H���cdy�f��DA;��9�T���0��\0�p�����!� 6^�.�S²?���E(P�Έ .���5��h���EPJv��.���+�\$�5��>P+�?~��g�6\r��h��p�z(�W��`��\"y���:�FadŬ�6:��f��i\0����A;�e�����^��w�f� >y�����`-\r����\0�hr\r�r�8i\"_�	����9�CI��fXˈ2���\"�Ţ����h�L~�\"���%V�:!%��xy�izyg�vx�]���}qg����Zi��|��`�+ _�g�����٣������譞6PA�ʀ\$�=�9�����h��|p��������!��.�!�����i�^���iˢ�8zVC����Z\"����(�����9�U)��!DgU\0�j��?`��4�LTo@�B����N�a�{�r�:\n̟�E��8æ&=�E�*Z:\n?��g���̊��h��.����N�5(�S�h��i2�*c�f�@����7��z\"�|��rP�.ǀ�L8T'��k���:(�q2&��ED�2~���ر�����9���v���8������@��^X=X`��qZ��Q�֮`9j�5^���@竸�n�qv����3����(I6�j�dT���\\� ��3�,��h�k�3�(�3���P�u�V�|\0阮U�k;��JQ���.��	:J\r��1��n�BI\r\0ɬh@��?�N�\nsh���\"��;�r~7O�\$��(�5�R���	�ʽj����FYF��ܔ��~�x޾�f��\"�vۓo��˨��º#��a�����P���<��h�-3麝/G�x����n�i@\"�G�?��,�Zp�xX`v�4X������[�I��7�åXc	��!�b�}�j�_��9�5qti�6f������ٞ5���Fƹ�iѱ�pX'�2��r���0�ƺ��D,#G�U2��؏�I��\rl(�� �챣��=�A�a�쩳-8�dbS����4~���H;���0�6��b��{��޺R���s3z�����N�ބ��`�ˆ+���4<�^a�y���	}r���y������k�&4@��?~���cE����@�LS@���z^�qqN��</H�j^sC�`��sbgGy����^\n�N�\n:G�N}�c\n���� +���=�p�1��N�TB[d������Ћ��ܹ�`�n�oj;�jěwh����c9��p̡[y4���05�͋N��+ο��`Xda��/zn*�P�����#t�赸~�9W�	�V��~=�#��n)����	2��;�j:��J�k�C�!>x��5��==�2���.��|�'���[��'�;��v�������������;:SA	�&�[�me���n������˵���<��6ma�=Y.神��:g����腀����;�I߻x�[��I�J\0�~�zaY������wT\\`��V\n�~P)�zJ�������Q@��[�{rʉ�D�B�v��|i-�E��K�;^n�{���:Nh;���2��ƀp�Ѵ6����罘9�9����X�hQ�~���iA�@D �j���}�ozLV���ѳ~���	8B?�#F}F�Td����e��zc��F���g�7Η���� 6�#.E£����£��S�.J3��5��Kɥ�J���;���n5��:yS��C�voս.�{��	d\\0�?W\0!)�'����Eg�;�+��\0�Y�Nt�bp+��c�����\0�B=\"�c�T�:B������c��������P�I��D��V0��!ROl�O�N~aF�|%�ߺ�����)O��	�W�o����Q�w��:ٟl�0h@:���օ8�Q�&�[�n�F��p,�æ�@��JT�w�9��(���<�{�ƐO\r�	���ڂ\$m�/HnP\$o^�U��\"���{Ė�<.���n�q8\r�\0;�n������硟�+�޳3��n{�D\$7�,Ez7\0��l!{��8��x҂�.s8�PA�Fx�r����Qۮ���1̅�p+@�d��9OP5�lK�/�����\\m����s�q���v�Q�/���	�!���z�7�o��Eǆ�:q�V�5�?G�HO��O�\$�l��+�,�\r;�����~�Ač錳�{�`7|��Ă���r'��Ji\rc+�|�#+<&қ�<W,��>��^�P�&n�Jh�e�%d������C�i�zX�A�'D�>��Έ�Ek���@�B�w(�.��\n99A�hN�c�kN��d`���p`��%2���3H��b2&�<�9�R(���t�TH�	�z��'�� �o���>4?�\rZ�w�ӂ��4�`��Ї鍆��N���Ӏ�'-I����0(S�r�w,�����K�r��'-2Hlo-�U����_�'W#'/��H֟���j6�̉�����ȫ��\0�<������j1�E�Q�T�T���r�Bcm�16�͈g٫:w6ͯ�h@1�I:������2�p�L/����w�:�ő���K<��E<��J�76Ӏ�s�.̲sZ��/\$�AsEyϜ�r�r:w?Չ�!�?���Ǚ�Z��M�9�՝\0��1?ARͦ%�7>�M�ARr}s��r)\\t-8=����ЎU��,WOCsՆ��#w�5��ERlM*�D��1��>]��gK��V�\n�\\���s�܇8͹seͧ9��so�~����w4x�����f@���D��9����6��\0	@.���@�9\0�C;K��y+�J��٥��u<\\�`�c{Ӌ�E�>�y��J=l����/�-�7����Z46�uC5��P�Ω�RV�������ʳlV��aNx�`մ?U�7(HP�}jV�J�zNQJ�S����s-gQ!a�V�_SwR�O�3am�ZXwZ�o�'�wa���O�oZ���!�[\n<�Z��O�Ҷ'��Omo�[��a�=Q��>�:��T�\n����\0�=��m�j��AT�R�bu(�I���:��\$v�W�����u�S�\\V8��v�\\���g!Mж�u��_�&�is�\\C�R�VM�]tX�T7\\UoT��o_ԯݛS?a�l�S�-LutZGe���i`	}XZ�i}Q�yW[i��T��Yo���(ZE\\�}nٍi�f��ڋ��W�d�%T�pu3u�T�f5)v��]�UR3VEY]�X�\n�^��VqS�S�}X�iGf��v>�S��v�JMQ��vڕ�����\\�g]�QYE��ݵ#1V�l5U�EK]��\0���S��U?\\�BwS�U�7���mZ�V5\\��Wf��է[�eUr�{G\\��U��,�����W�[]x��V�j5mT�V�j�~u7�\0�V�U��'t��w?ms�����5V��vݏq}����u-Uq�]ݗc]�W���]Tt:�f�M�k���e]�[-p}^�I[�XD���Y�V�d���O]	seN����Z�WY�[�t��V?�3�ǵ�M���ݙ`��t^w�d�:qT�L�@@>]�j\rF�qv��-Lv�G�Kwi�LwIPMo��ǹMgv���[��Uss��~	���w:B�A���NE�{�!-��d���o\0��}&����hX��A��5�%٣fzL�H�5d�� Y�_%�v�ә!m��]������%������=B�>E [#^}�hYF�a���>{�gS���p[�F���Da�6n�����x9��8L�I㈫N�a=�S�@�bPk�.��N��H��l\0��:���2#�Θ;��v�O}�9ik]	&�{�� �����2|a��&�������Q��������)��oف�Ǹ:�&.\0�5q\0J�L��64hy�3�ޢ���a�ރ��Iz��O�����ﮈ\"�yB�ʳ{�3�%�5r(m������x.7r�b%���^�e�M���2�\0x��!�b}.��Y6\$qS��\"^|xE����a�������Xǡ5�9��'T�R	�c9���W�1���AΔP��؏h6'�o�-���p��T(\nn\r�Ő��1���R�RUg�������x��Pe#��*��kT<�<�>b;��\0�����gL�.�<k�Zv������z���8~��y7�Y��ȁ��7w��Odn�>�<���E�3��wS�ۆ�@��� o�W�1����Һ�z�e�޽��1��z�\0f=��c㊤g��{��>n�p\0���Α:H�Bn�6F��B�r�W=��C>M.1~@3�G�9�8�q<S�|�Y�8QP��`L[���qz�۫P���N�<{_-ٮ�d�O��d-�NB7��4��B�N��.V���9ƨ�Q�3��{IcP\$���h��<R yy��?��G��:n�����g����;Ah!����&��+>�ˀ�;M�ˌ�	������6S�N��ڌ=#����`�T�#+�n�;��r,�����X|#��\r�#���?\n�D>�|V�S����eϗ~J�m99��\ns�{S|r],~�˹��� �q�I�?\"|w���%|�j�\0rE�,kSn�����qƕ�d8B.��1����\"��/|���؃]�������E�Ϝ�N�l����x��I��� Ic�Ÿ.|\$8D��F������P�K��3��\\j��xU��C/��җ�A{������e�����������ܾ�����\rp�U\n�՟Wlo­Y�{����`]'���s���/|�o����3���r��}��;��[�n��������O�M7���ߣؼq��q(��_l�q�s�N��y������;�i�g�t����:�����ՙ�qk�����{���?z��������Mȗ�o��'�j������c�y�߄���g��gk�w��f8�Vc�7fA��Y���+Kx�=�gKAk�T,95rd�+�G����ٯ����[��%��A�w柞�����7���ଅ�%��{�m��8%_��m��q��V�˨_���%�!�E���i�~���h��~��C�߭~���%�������_�������rLkD�y����~�?p1O!?��v�\\��Pm�\"��<������E�6� �E��V����zk����9�z����~�/��պ��!Q�>��O��Nm��3r�� F��l���e;�M�߷���Ͻ�_a��!~C��f����b}3� K�f���. 	��}.����DX	i5�|��?��=\0��?�?��?��@��Õ��fu~a�^��n��y�Q;�q�����)�s�S�,\"G�\nu%��U�Y�AKl\n��B�I�86VCcO\0�`}.x���,-N�@~��T�G����'��d�J�����y1�zl��æf�g����AB�a�!��M\\<�gʃ�z4ƿ��@/��C�Â�@�	�Qq���)��x��/�.7inD�#=��� *79c�F���d2(��.�V��3����\$g`�A᧋rl|�m����b��/�qE���ô!�bU@��9i�;pp�d���פ=�1�y�x�x�	�=�v=��(v��s_��Bo�ɂ�ց#�K\r n����\\�# �f�PX�u-3&�	��J&,F�(9��v�0�&@khZ�y�g�Cԋ�z ��Á�hi=�s9T�� eT>g��3�d�tF��2b&:��\0�P���B��-�Q��8~�LS�M���ڷcg���Th'�f(���\$�.E���VL����A�I���ߌ���r���g�\r���0�����T��1P`1�d�����\r�4���=6@F���� F���=�ɂ6�A���>�N�AV�	���(\$�A/������;����?�g�f^	�\n�&�KO��n�{]���g˛�8�c��ў���Ϸ�����\n��7L����t:�Ѡ�hF�VO\r��J�)b�(\"OB�m�	o��\$]T�SH�Z^��K����w�\\[A9('�لcۑ���b0���� K�����srB�x\n�*Ba�z6o�\ry&tX1p'���^�M��<�Cg�`�4�8GH��zd?gX��.@,�7w��۞:+�TiUX16��L��s�:�\r�L�6�����f�r\r`�t��67~g�x�gH9�J��O=-\$�4?r٪4����O���:��z��{��D`����21�F�ܵ��(D�M��;����&����́��ڭ��U>�I�6��c���߸@\r/�/��ԕ��_H��\n7z�� ������7�a�ɻ[9D�'����}B��O�R��ݟ�B#s��]z!(D���@L^��	��x��@o��u�O����D���!�e`\na�k>�0`����-*���8E�Z6=f��%����c㛰�K=���F�\r���Sh�yN�[v*v�\r���@�#߸퉁�Ah*�L\$���A�A\\�����%�*	��p�\r*==8�\$W�\r� [��Jx0y��Z�+&Y�HA~A\n,\\(��p�!F����<6S�&IP`6Xz�+�df�\r��J£���i�s�+�&5��/rE���M^\$R(R�Q��Ew3��lH*m\0Bq�a��r��LB����Q��z6~l���B��\rI®G��XٸXVbs�mB�H�����c�_K�\$p�-:8��Nj:�х��-#�F�	\0�aiB�s\\�)�<.�!��\\��N��bIw8�͹t���PjW�`���y\0��&0�i?���Ҕ:�Ia)=��C�,a&�M�apƃ\$�I�IFc���\0!���Y�xa)~�C1�P�ZL3T�j�C\0y����`�\\�W��\\t\$�2�\n�+a�\0aKb���\n��]�C@��?I\r�HヮKs%�N����^���9CL/��=%ۨ�h��:?&P��EY�>5���n[Gْ�%V��*�w<����gJ�]�*�wd�]�B�5^�֢�OQ>%�s{�ԅ畫;�W����z�Gi���*��Rn��G9�E����,(u*��Ւ×��X�s��R���:�5�;��)�R���N���vK�(�R��M���b����_�{�F<<3�:%��HV�YS\n�%L+{�o.>Z(�Qk���N�!��,�:rH}nR�NkI		��[���ӧg��֤;mYҳ�g�%�9V~-J_��g�����\\�ɮ�Q\n��!�t�\\UY-tZn��d:B��ʽ�*�]')t���w���ɫ[BUm*�r4�ؖ�*yv���vZ�չ+GH��Zn�P�܅|\nT� %#\\�AX\0}5b+w�r�Xwܲ1u��%Cg=I��v`�cr�e�0`..<���h�+�H̝^\\j�yF��%�]�B�\0��r��+�>�%Zx�� �%C.����`Vn�1KS���k\r���X|��[�;�6H	U@�D:޻Mj	Ε��?��]ڤ��b�A+��G�\0thxb��L`���64Mޛ��Y#�hfD=e��w=�c�+H��:�.%��^\$�DZrAzj�fLl�7�o�����\0��-���Ed�މyz'V ��Ӟ�W�	Z��K�+�d(A�fy�P?�xR�^h���'���A\0���:p\r�d(V�����d�t	S�FcHȟ��]r�r�CHY	X_�/f���ͽ 4 7e�6D�{,�����<<Z^��j\"	�\n+ƀM�Y9��A�(<Pl�lp	�,>Ѐ�{E9�&�Gh�h{(���Agg8�(@�jT�n�g�Z��Ű�J����x�����@ic��Ջ�(p�'oJ0MnĀ�&���\r'\0Ց��\rq�F�4���)��cL���_�oJ�}5��c�o���|6�m�}Q���4Q��b����[�x�m( �&�@�;�+򘥮��f|I����R�48� {	`���k`u�r`��W㸱`\"��)fI\n��;�8Zj���g�~��AΈ�!j��%��T��E\\�\r3E�j�j��FXZ	��Ay�kH��Xd��gCQ�����΀�0�d����������t�	��zk�`@\0001\0n����H��\0�4\0g&.�\0���\0O(��P@\r��E�\0l\0��X��\r��E��8�x���@�ԋ�\0��^���z@E���\0�.�^��Qq\"�����Y��D_p&���3\0mZ.Pp�\r�Eϋ��s��v\"����0�`��w���,���_�`\rc���/�]x�q���3\0q�.p��q���\0002�_�i���ъ��E�\0a�1�b��wJ \0l\0�1,`��1y\0�9#?0T^��q��\$F6���/\$d�����FD�yJ0b��\0	��W��\0�.�c�{c E�\0s�3l]@\rb�F�\"\0�2�`����\"�7���/�\0������a	^04e��Q{c<�ь�j/_��ѐc\0001��*28BA��\0000�xƔiؾ1��F�5�0ljH���\"�F�30\\_��q�\0�f��T�l_0т�BEČ#3�]���s�ƽ���64_X�1�\0ƽ����d`��`\r�S�_JMV/f����1\0005I6tf���4F����34f����F-���6�d��\"��4�k��\$h�±�#E�̌�\0�6�_01�c@F���/d]X�Q�#G\n���5�g�q��EF\n�m\\�Dn��q��YFv�1/4`��q���4�=�8b�q|�\0004���3�mX�1��e��\0��.�\\��Q�cI�	��.7�\\x�`\"��\0i^3�(籒��\"�Ev4l_��q��\$F���oȾ�\r#UE䍩^9�t�������.�\0�3|r��1�\0����69l^x�ѼPF-�]\n0�v��Qy\"�G��2,sx�Qq#�F+�\0�/Di��q}���8�[6,j��\0cm�o��N5�eh�Qv��GL��H<T_�Q��?Fɋ�..\$f���y�E��C2�l��1s#�E�D�loh�Ѳ�j����8�e�ű�b�F!���9�`x�q�����C�7�hx�٣�Ŏ��7�^x���K<�h���	,u�鱑�G)��;lu��#�Eߎ��<�k���b���\0sR.�w�ֱ�#z�~�w�2|x(����\0001�'�:�v�\0001��G挿�?|`������� .2�X��#�G��8K�@<z�1��ƹ�\"9|j�����	G��/�6�q�����G��s�7�/\0001�b��ߍ��:|�8�Q�#~F��W�4�g���#<F\r�� �2��X�Q�#�Fv�k�7�x�1�#��Ǝ��@�rh�����F���Z;�f��rc�y��!\r	�_x�1�\"�H1���0Tw�ٲc\rF�1 \n8d�X�r���Ԍ��2Db���{d4H��rA<~��1�dBHI�[J?������q�~�k�0�t���#�F\r�#�0\\h��\r�G����Ett���c7�U��!�=D_���cN�\0�y�6a��� Fg��!v1�q��1��KǇ���@�e��ѳcGo��\n/���Ʋ�E��\"�3t`���#cH���<�c��q���F�%�?Tb蹱�d)��� r0����qc�E���>3\$tyQң���E�Cl`9)�VFH�MJ7�f���\$HHQ�� ;�ri�7#F��-F�H�Q�#\0G��!�1�^��&4�vG&��7�g�ృ\$\0G�\rr/�d�R�(��s6@���'RA�Ǭ������&�����g\0k z=�|Hٱ������^J�]��sd��,�\$�1����<cqǦ���J�_���b�G��QvJ���ر��H5��F�p��Ic��[���@�r���vH�%��3D����c<I\$�M.d��r1c=F���.4�c��2b�G.��!�L|{X�ѳ�{I��NF�dx�qsc��ݍ�#�E�a)��#�G����J�m�.��\$=Gh�AN=�s��ŤE͑G�G\\a1�0��H���F.tg8�ä[����Idn���8�F����.T����F3�E�6riq��sF���6�x�r���L�=nFT��od��>�-�3�|�2\$�0��= �:�xc�H�I\"NP\$b��Q�\$F�� �DĂ�����}F�%�?�(����G�3\$�O\$^x�2T������0���R���#�D�:��E�|i/2��XG����8���-�\$H�v���=d�� ��`���:lax�����I���:�X�RJ����R�mx�J#\nGG�9!N���{cI���&�I���R=��I\r��&j:�8��g#�H��'3�_x��b��H}��>7����c��ُ\"&K<x��2���H���\"6@db�뱭e;�)�!�.�]�/�d���m*f6,v��ɪ����L��(q��AI8�7d�9Ttc����UL�X��%H��I*z:�|IXqs��-�B���q^(�R��aq(~e���9J�U�+-eq*nT��>�\$�ѫer��α�p\n�ռ�\$es+�V��I���b��eq:�#]�cc�7r\n�f,gY��TC�%��	�}�\0���\\*�EWP�a�:�E�,&W��p)���xl�M���3\0t\0�/Iip�D'\0	k\$T��F��]f��dM�ȀK\$���H(@�ɔ��(�z�nWҤ�_�Mݔ*�\0�e�lF�^H	W*B���ZPe��֘��R/�dRRʅ\0Ku�,yH)�\"S�XI'��Z�=�L�R�3����\n�'�[k��6@;}R���I����_�)�w�[�� �\n���n����ʓbBr�l,\$v����԰����H����\\���s*����.Qt�B��d�b���@�?3�S�`a@�K�\\.����~�f���)����,?|&ӶK���Z9.�X�+S��|����\0Pʼ��E���e�/�\0V��^K�\0\n-	:��Sز)ת�0j�9TX��B���K\"�ů��²,2�'�2����P,�x���p���Kꗪ����\"�D�#TV��D��1�Ao;ؕ�/9TH%V`WJ<9��aeʰ�K/V^/�Q���\nB�Z\"9���XүM~\$�5����\$0d�I�U���2�^X\n�*�E7I\nV3���+�a��Ii��N�KK�g0�a���z*�V���#bJyMҦe��Z� �V���`����U1�C��.\rF��-j�&LU�p�9s�鹊+Q&1��Rm��ӱgZ���	,.XryZ첰0���3�2�A1�ւ�e�N������(?Al ��,N�ue��\$|r��_%��E05E}�\$���X2�%�Z�e �\n\";<9a�h㶥�a]���8���*�u����L����dR��0����+�Qm.�,G����M��_�2�e�dB��ݸ,�S�2��>U���԰�4vl�~e2��2�eĵ�Yg2nf�=��\$�%��ٖ�Ffa�)����fTƶ�G���g2�W,[����X>)t�A]���R*�&Z��6j2|��\0��(�p	�9� ��uҪ�?��`n��-lZn�!H9����zL��9VLϹy��ݢZ�JhR��g�EfL�U��~`4�Y���x)\$B�QR#ÕS������,6i#�Y��,;C��r��i�&�X��]��\nw54�K�x�\n*&��T���W�������+SлqNc�y��IW��\0W5c��ɫ��&+����Vr�)����Kg����?� ����|�gR���hR�%K��)Z#�5�,ֵ�k�漻`��l:��LsC�[M�UB�6ld�ѓJ������1nl:���j���Lߖ�\0�h� *)�p/��ާ5\\�<9��V��/��ޫ�hT�dj��rMbx\n�]R��W�R� MaU�3=��`0�o��,Z���l��}��m�월�l����mL�S6�\\�tΙ���L���\\�%�J���K��7oѩ��ef�M���oC�Y��v慭NV�4=R��sJ������*h���hn��-m��4��4�y��H�M��|��is�U=����A\$ڭ�i�ϙ������>����p�p��Qf������q,��5s�UL���8}ݬ�٪���#�XH�����I����9U�8�c:�I���f����7�kl�5}��f�LY���N2ް�}&�	i���c,�I�3���R��6r�؉�3b��͍��6>lXY��f�L�)+�S,ى�*�el���U\"ed��\"Z��ږ�6�ZD�E9��%�΂�Y9rmt�E��'.M�[4��^��ɷ�;M�w�5���9���a��v+70l����d%��<��3�_<�lN���(�v+7YRl΅Ӫ]�.��4�I��)��=փN�T�]۹'U^�?�S���7�XC�ũӨ�1�u�9�E�ߙ�k�L;���Nh���S�qNXk;1[����LgpV�B�1_����gs����;�Rl��E���N�T�8�w,���s��1�Pxr�q���3���(��;�Z��	yӾ'{O	_���r�ȪMg|�I��92eL���f�O\rY��nk��u���SN�v9Vk�	�3ǧ.̛v9zyd�)����N�Y�&s\$���jd'6͔�Q<�V��)�e�+���:�ج�Yjt���p�u<��ʖ��3�]qM��Y:9X�S��gI�Ý*�m���C����v�G���R@�֯�jT�=��:�e���(\0_Vn�,?p�	3�'Π���������\r�����|\"�i��gT�n��P皤�\nӔ�q,�Sf�.Y��Q A��A�,Z��eS���sE���\r��v�T��Q�Z�\"p�I�s�UAϛ\0��vZ�}�r��K�tf�P�f9疮�{��^J���ς�������\n0%��NGګ*~l�D.���Ke��6�[,�%����O՘�-�~쵕����j��RO;��@	˨en�b_�%sK�Ŝ����Y����Y�0���L�W���jr�Ր��φ��!B����Pv��fwګ�����M�R2�2�z�4r�h;�#M@�}�\0�|��M�\0�=ځ=��f�-!�6p��g[P4��������C�[5:��\r�Ct��àu@�ۺ<��if��Nu��n[�!u8j{&9Ku�FQlR�i�(�C��A�䮙s4��\0Y��;f�B<�{�嘼R_I�~��6��|MWTA�]4�e@J�e�P|[���r5*���OΠ�Bt�)��%�-\0P�j�m	u�s�}И��Bi^��*��z�0YK.�`[�Y�2��Ы�|�XB�����(?З�.\$�l���,��X�D��\n��j�OD�->_<���֝��\0�������s�h\\����ea\\�\0��e䑙Y�`���7U�\"e��CYT���zt:V9P�_���a�ЕF�;݀\0M�����2�e��HC���Z�?�V��'����}c�Y�a�脬��?Qh8	�0�Q�CM`����6��,���J�eZ�Z\"G�W��u��u\r�>49�K���I%L����V9����։��Z�{VEO�X;�����o�agP�\$\n�RX@}!-Si��R���qz�	��ITH.���\nk\n��\ndϮ�T����>�\n���?�E�`��5D+f�?#z��IZ�7T[��Qs#�D���\$���P���I�	�3��*�:�9YI��H���H��X�0�D�!u7J��m��YB}E������简��r�8Q��\n}'P�S�	Q���������\$��`R�)^��(O�P\0�aK����m�3��\$H.��X�����)�V��`���9 �.�Y��18���eU��`X�9���	����\\Lc�j�IE N鍫��6�W�D�XB�	Z�:�|Ϥ:	E-P-�&���)����*���l�)P�u��y|R���Lh�.p���_*�QA��@ �?,Ƨ�Y��)t�ч�<��P*���j�VuQ�:2\0�L�?J����,TPHL���E%���\0��yP(Y�JZ���TH�X\r	�Q4�hO�;\\�vV�#��T�Ww��\\`��Oҡ��?�JR2��=�F��]����I5TMjI�9�,(ƤDv|t�)��Wy-�]z��e���a,pQ6\$�I-g=%�S�W#�TP�ܐ��)�T&]���X15j��B8���V�ӥ\n�em y���h�*������d�4ς�bd!0��gR�J\\� �Mt��1R\n\n���x�����.�_��u�+Ƽ�;���*4�θ)]�\\�l�(m\"�Q�nT���(*\0�`�1H�@2	6h��Y�c���H_���f�?��a��7=KKde�t�H��2\0/\0�62@b~��`�\0.��\0�v�) !~��JPĝT������������O�{t��\0005���/ீ\r���J^��0�a!�)�8�%KޘPP4��~�H����������\r+�Lb��/24)���GK�e0�e��S1�B�	-0jf���S�wLΙ�i�d ����L��\r1�h�ȩ�S ��MJJ�ht�)��+?L��e5n���|FH��MN��5�j�ɩ�SH��L���4�=T���D��Mn��6Zm@I@S`�)'���7f�z��Sz�x~OU1k����SF��MOU4�p�٣2\0000���7�6�k�#xSl�'K�7�7\nl���xSu�LR7�7�st��xS}�GM7�8*qt�#xS��OM\"7�8�u��)�ӏ\0����9�r�)�Sr��2��;���)��7��Nj�m/�x��ӿ�sNڞ:jy4���S��gO:1�=\ncT���Sͧ����;�{��Sȧ/ORH\r=�tT��Iݧ�O���\\zx4��S�M���>j|T�i�S���O�����~��\$l���O����}t��٧�O��z��*�%�]PP���vU\"��ݧ�K��@\no�j�H�;P�>��1���Fd�P.5Bظ��\r��3�uB�<�L#�<�QPE�Cʁu*\n�ۨyPN��l���\r�6��?K��mBZi�j�H��O2�}1J����M�_M��mD����&�K��Q6��Fzv���6ӹ��Qj��;j��j)�*����mEʌ�9Fd��Qv5eG�ɵd�Ԅ�EM\0+�D�\"j)SD�QҤpZf��Ƃ�mR&��H��U�ہ%�{Rv0m0z��䧟Lƥ@��'���ER�?eJ�>�ԝ��M���I����YT���R�/�Bʕ.�UT��YRΡ�L:�jNԅ��R���L��5ji&,��O�mJD�5,�9����Q����1�hTf��N����ޥQ�'��7��Lih��\rcjԝ��Sz�u��\0n�Ժ�g���9�@c��\rT�%L��A�fT��MT9uQ\n��)��U��S��uD:���j�U	��ƨ�Pږq�*�EڪKSb�l\\ڤ�F���ŪGTz�gJ��H�SF�	\"��Q:�1����;���RꦵL*~EߪoTҦ\\z������:���]Sꕱ����B��U�^J�uR*kE��	��T�Qt��R�g2��Uj��V\$��_��S��mPH�U\\��T��[Uʫ5Jhٵ\\��Up�����V�7a_*����=R�>\0I*����V��X:hU8j�T�KZ��\\:��)j�T��8��	�WZ�Ub��J8�R�=Y�UV�U��R��\\:��-j��ѫiV.��[z��Ҫ��-�{T���Z��uoj�U��3 ��[���>����E �%\\���h#bՅ��WZ�-\\���C�����W>��]ںg4#����KTr��Zʤwj��\$��z�-Rj��tj�U*��W��tp\n�4����'�N�M����xU��X32[x�+���\$B�US*��q�UͪqXZ�}S���x���@�-W\n5�XZ�Յ���J��U2�=\\����F+��V�0]XX�U����0����-VJ��+�/�����Zʮ5sj��D��U޲%b�ɵ������V�%Y�^u@d�բ��W�愔�ŲRk&���YR��\\�ŒRk�Y�cV�O-\\��	kd���KoX��K��/�9�]��V�O-U�<��@��嬥Vγ[����6U�����=e�ϵo�4TݭY�0�eH�դ�\r��9����6�(󮝕+��7�yb�rI �|�\0�:Fz���\n��|��s<�R�%J���]��F�3����j�Σ�Y��Z��^<5�X�IJ��M`�nO\\�B&�r���s��Q�uz��x���	�T���Vw�J5�g	�?v�qF4�9�ӝ����6�zj����OV��\r�u�=�@ʒfT͚����y��	�֫pKaXU9�m����\n�ekMo��5\nhT��ꦦ�V���v���:��s���\\p>��L�:��)�O=nk}j�S��&�֮��~���y��e��ܚ�Zֵ�)j���t�VR�V��s�r�:+a�o��,!T�l�Uϕ�*n��5��\\�U�dv+�M\\�)]B�|�J���l;4��5�pL��ӵئ7Li�[~bmt��Se�\"���B��v��d��@ͧS�4)ؒ�Z���\$)��5ic!������Ό���\\R�*�SD���w\$�9�tS�\n�Gf�Pԛ��ʸ����*�	K���D�Vy��5�uȦJב�\\��C��\$��W,�M\\������5�����k^�V�s��5�k�ֻ�M^��{�u��ϤwFQ��J�H�gWN�k8�����ʉ+�����1br���˕���V�X�]�dL�j�YT��v��6�twy˕�k����vx=�5�h������8�]����˷x\"c|�ufU����\0�ҧ5�jȩ}�Pkn̚Rl��f٪�+���ۣ��>c4��W+T�Do����q���SX���b}}�hn�&<�?�/3��-áh���qn���	�p�%)S�yP\r��͵�m-�f�5���[�\\�=�T�}�y )��Yd�ؤ46#Y>�3��נ�m��\n09h;�4���0��+�a�e\nȃİȞ!�����)�@�x�x}�\$����AF��Ñ�0N� R�	���ӄ�iܥ��U�?���b5�!+׭\0G���w{��Ӥ��lI �)�w-4;p8��ؤ;@\r\n\r���N5�ƅF\\ӹhgPE il0��X�%�)\n��Lk��^���2��<5F��d�I�<�F�j�bM�d'�	�ƲD��Bma������OY�Xgg�8��ZV�%mf��%�F�-�,�\n���a��F�wf��s���0G乑�Z�\n	1�;J��1�\"iP�B�y�C�����t�zӉ���;l�4��ҡ��J��mLX�+lᘪ�{�8�\"�\n�V�����(�\$Y\0�d\\݆6�D9B�H�d%���1����6f �\"�T�J��`/��>�C=�c�쨱��?e!�k*�3l~���i��,�A��z/d���Mo���ڲn�\"ɽ������zTr}eٌ{M�aC�7�fiT����/6W���P����8�Fa`��5��M�f2V]�['}cn4]h���e���Z�ŧ\r��2���XllGa`(����(����\0�����_�lO��f&f�1c8�D{�Q��	S6�p\0�Y�����\0\r�q�3m&*f�;�p�6r^c�ϳ��`ɵ&z�n^ڱ�;D��S�oj^�=�L'g�5���&���Ef&���|\nK 6?bX*�.fψE���~&9�!��d�k@�v\"F�G�x\\�=�E�7�XP2[:��\0�׎��X~��7���X6�4���(�\";B�\n��X��hy��&�Dֈ�Z�l\nKC�������p���`mS�	2�U�;G���8��{��-��WBm��\$F��\r�l&B�Y2\r��mA�ő�w�Z�6�RВ��%d�����_��T�5�``Ba��G��c�XK�\r��\0��gN��\\���;N����s^\n��u����ѲVwz�U�F\"\0T-�,^��\0�����2 /� ����EW�/\0¼��ľ�4;\"�K-NZ���McλRVNe�Z�wj�6��a��ÿ���KV�lN?���jt2���T/[�N���j|0t% #�����\0��`��5F<����X@\nӢ���ZF\\-m���cd2�p5G�v'B�'�7{k�*'�L�A�Z|I�k�\n-.C�6����k�-����S����k�]��_\$��+G�נ[^���z]k��8�\\��F|��?B���^��B��̎|��@����B��zP�W/R?[!bB��k��Ѡ'	(�e:xf�r�7\r_��q�Ma�\0#��7|�Q&\0Ɂ@)���1�뮆LA[Pt�\0���`�6�\\e���zx��S݀vՈπU:�ڱ�T����ϗ>f�\nq�l��+K(|�\\��ѠG��U؋��@(�*�iS�%F�\rR\$��C��L����;�d��ļg�-\$m?�lhʝ��3?P�Y�\0");}else{header("Content-Type: image/gif");switch($_GET["file"]){case"plus.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0!�����M��*)�o��) q��e���#��L�\0;";break;case"cross.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0#�����#\na�Fo~y�.�_wa��1�J�G�L�6]\0\0;";break;case"up.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0 �����MQN\n�}��a8�y�aŶ�\0��\0;";break;case"down.gif":echo"GIF89a\0\0�\0001���\0\0����\0\0\0!�\0\0\0,\0\0\0\0\0\0 �����M��*)�[W�\\��L&ٜƶ�\0��\0;";break;case"arrow.gif":echo"GIF89a\0\n\0�\0\0������!�\0\0\0,\0\0\0\0\0\n\0\0�i������Ӳ޻\0\0;";break;}}exit;}if($_GET["script"]=="version"){$qd=file_open_lock(get_temp_dir()."/adminer.version");if($qd)file_write_unlock($qd,serialize(array("version"=>$_POST["version"])));exit;}global$b,$f,$k,$mc,$uc,$Dc,$l,$sd,$zd,$ba,$Zd,$w,$ca,$se,$vf,$hg,$Lh,$Dd,$si,$yi,$U,$Mi,$ia;if(!$_SERVER["REQUEST_URI"])$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"];if(!strpos($_SERVER["REQUEST_URI"],'?')&&$_SERVER["QUERY_STRING"]!="")$_SERVER["REQUEST_URI"].="?$_SERVER[QUERY_STRING]";if($_SERVER["HTTP_X_FORWARDED_PREFIX"])$_SERVER["REQUEST_URI"]=$_SERVER["HTTP_X_FORWARDED_PREFIX"].$_SERVER["REQUEST_URI"];$ba=($_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off"))||ini_bool("session.cookie_secure");@ini_set("session.use_trans_sid",false);if(!defined("SID")){session_cache_limiter("");session_name("adminer_sid");$Uf=array(0,preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]),"",$ba);if(version_compare(PHP_VERSION,'5.2.0')>=0)$Uf[]=true;call_user_func_array('session_set_cookie_params',$Uf);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE),$cd);if(function_exists("get_magic_quotes_runtime")&&get_magic_quotes_runtime())set_magic_quotes_runtime(false);@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode",false);@ini_set("precision",15);function
get_lang(){return'fr';}function
lang($xi,$kf=null){if(is_array($xi)){$kg=($kf==1?0:(!$kf?0:1));$xi=$xi[$kg];}$xi=str_replace("%d","%s",$xi);$kf=format_number($kf);return
sprintf($xi,$kf);}if(extension_loaded('pdo')){class
Min_PDO{var$_result,$server_info,$affected_rows,$errno,$error,$pdo;function
__construct(){global$b;$kg=array_search("SQL",$b->operators);if($kg!==false)unset($b->operators[$kg]);}function
dsn($rc,$V,$F,$D=array()){$D[PDO::ATTR_ERRMODE]=PDO::ERRMODE_SILENT;$D[PDO::ATTR_STATEMENT_CLASS]=array('Min_PDOStatement');try{$this->pdo=new
PDO($rc,$V,$F,$D);}catch(Exception$Jc){auth_error(h($Jc->getMessage()));}$this->server_info=@$this->pdo->getAttribute(PDO::ATTR_SERVER_VERSION);}function
quote($P){return$this->pdo->quote($P);}function
query($G,$Gi=false){$H=$this->pdo->query($G);$this->error="";if(!$H){list(,$this->errno,$this->error)=$this->pdo->errorInfo();if(!$this->error)$this->error='Erreur inconnue';return
false;}$this->store_result($H);return$H;}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result($H=null){if(!$H){$H=$this->_result;if(!$H)return
false;}if($H->columnCount()){$H->num_rows=$H->rowCount();return$H;}$this->affected_rows=$H->rowCount();return
true;}function
next_result(){if(!$this->_result)return
false;$this->_result->_offset=0;return@$this->_result->nextRowset();}function
result($G,$m=0){$H=$this->query($G);if(!$H)return
false;$J=$H->fetch();return$J[$m];}}class
Min_PDOStatement
extends
PDOStatement{var$_offset=0,$num_rows;function
fetch_assoc(){return$this->fetch(PDO::FETCH_ASSOC);}function
fetch_row(){return$this->fetch(PDO::FETCH_NUM);}function
fetch_field(){$J=(object)$this->getColumnMeta($this->_offset++);$J->orgtable=$J->table;$J->orgname=$J->name;$J->charsetnr=(in_array("blob",(array)$J->flags)?63:0);return$J;}}}$mc=array();function
add_driver($s,$C){global$mc;$mc[$s]=$C;}function
get_driver($s){global$mc;return$mc[$s];}class
Min_SQL{var$_conn;function
__construct($f){$this->_conn=$f;}function
select($Q,$L,$Z,$wd,$Ef=array(),$y=1,$E=0,$sg=false){global$b,$w;$ge=(count($wd)<count($L));$G=$b->selectQueryBuild($L,$Z,$wd,$Ef,$y,$E);if(!$G)$G="SELECT".limit(($_GET["page"]!="last"&&$y!=""&&$wd&&$ge&&$w=="sql"?"SQL_CALC_FOUND_ROWS ":"").implode(", ",$L)."\nFROM ".table($Q),($Z?"\nWHERE ".implode(" AND ",$Z):"").($wd&&$ge?"\nGROUP BY ".implode(", ",$wd):"").($Ef?"\nORDER BY ".implode(", ",$Ef):""),($y!=""?+$y:null),($E?$y*$E:0),"\n");$Hh=microtime(true);$I=$this->_conn->query($G);if($sg)echo$b->selectQuery($G,$Hh,!$I);return$I;}function
delete($Q,$Ag,$y=0){$G="FROM ".table($Q);return
queries("DELETE".($y?limit1($Q,$G,$Ag):" $G$Ag"));}function
update($Q,$N,$Ag,$y=0,$mh="\n"){$Yi=array();foreach($N
as$x=>$X)$Yi[]="$x = $X";$G=table($Q)." SET$mh".implode(",$mh",$Yi);return
queries("UPDATE".($y?limit1($Q,$G,$Ag,$mh):" $G$Ag"));}function
insert($Q,$N){return
queries("INSERT INTO ".table($Q).($N?" (".implode(", ",array_keys($N)).")\nVALUES (".implode(", ",$N).")":" DEFAULT VALUES"));}function
insertUpdate($Q,$K,$qg){return
false;}function
begin(){return
queries("BEGIN");}function
commit(){return
queries("COMMIT");}function
rollback(){return
queries("ROLLBACK");}function
slowQuery($G,$ji){}function
convertSearch($t,$X,$m){return$t;}function
value($X,$m){return(method_exists($this->_conn,'value')?$this->_conn->value($X,$m):(is_resource($X)?stream_get_contents($X):$X));}function
quoteBinary($ch){return
q($ch);}function
warnings(){return'';}function
tableHelp($C){}}$mc["sqlite"]="SQLite 3";$mc["sqlite2"]="SQLite 2";if(isset($_GET["sqlite"])||isset($_GET["sqlite2"])){define("DRIVER",(isset($_GET["sqlite"])?"sqlite":"sqlite2"));if(class_exists(isset($_GET["sqlite"])?"SQLite3":"SQLiteDatabase")){if(isset($_GET["sqlite"])){class
Min_SQLite{var$extension="SQLite3",$server_info,$affected_rows,$errno,$error,$_link;function
__construct($o){$this->_link=new
SQLite3($o);$bj=$this->_link->version();$this->server_info=$bj["versionString"];}function
query($G){$H=@$this->_link->query($G);$this->error="";if(!$H){$this->errno=$this->_link->lastErrorCode();$this->error=$this->_link->lastErrorMsg();return
false;}elseif($H->numColumns())return
new
Min_Result($H);$this->affected_rows=$this->_link->changes();return
true;}function
quote($P){return(is_utf8($P)?"'".$this->_link->escapeString($P)."'":"x'".reset(unpack('H*',$P))."'");}function
store_result(){return$this->_result;}function
result($G,$m=0){$H=$this->query($G);if(!is_object($H))return
false;$J=$H->_result->fetchArray();return$J[$m];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($H){$this->_result=$H;}function
fetch_assoc(){return$this->_result->fetchArray(SQLITE3_ASSOC);}function
fetch_row(){return$this->_result->fetchArray(SQLITE3_NUM);}function
fetch_field(){$d=$this->_offset++;$T=$this->_result->columnType($d);return(object)array("name"=>$this->_result->columnName($d),"type"=>$T,"charsetnr"=>($T==SQLITE3_BLOB?63:0),);}function
__desctruct(){return$this->_result->finalize();}}}else{class
Min_SQLite{var$extension="SQLite",$server_info,$affected_rows,$error,$_link;function
__construct($o){$this->server_info=sqlite_libversion();$this->_link=new
SQLiteDatabase($o);}function
query($G,$Gi=false){$Ve=($Gi?"unbufferedQuery":"query");$H=@$this->_link->$Ve($G,SQLITE_BOTH,$l);$this->error="";if(!$H){$this->error=$l;return
false;}elseif($H===true){$this->affected_rows=$this->changes();return
true;}return
new
Min_Result($H);}function
quote($P){return"'".sqlite_escape_string($P)."'";}function
store_result(){return$this->_result;}function
result($G,$m=0){$H=$this->query($G);if(!is_object($H))return
false;$J=$H->_result->fetch();return$J[$m];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($H){$this->_result=$H;if(method_exists($H,'numRows'))$this->num_rows=$H->numRows();}function
fetch_assoc(){$J=$this->_result->fetch(SQLITE_ASSOC);if(!$J)return
false;$I=array();foreach($J
as$x=>$X)$I[idf_unescape($x)]=$X;return$I;}function
fetch_row(){return$this->_result->fetch(SQLITE_NUM);}function
fetch_field(){$C=$this->_result->fieldName($this->_offset++);$fg='(\[.*]|"(?:[^"]|"")*"|(.+))';if(preg_match("~^($fg\\.)?$fg\$~",$C,$B)){$Q=($B[3]!=""?$B[3]:idf_unescape($B[2]));$C=($B[5]!=""?$B[5]:idf_unescape($B[4]));}return(object)array("name"=>$C,"orgname"=>$C,"orgtable"=>$Q,);}}}}elseif(extension_loaded("pdo_sqlite")){class
Min_SQLite
extends
Min_PDO{var$extension="PDO_SQLite";function
__construct($o){$this->dsn(DRIVER.":$o","","");}}}if(class_exists("Min_SQLite")){class
Min_DB
extends
Min_SQLite{function
__construct(){parent::__construct(":memory:");$this->query("PRAGMA foreign_keys = 1");}function
select_db($o){if(is_readable($o)&&$this->query("ATTACH ".$this->quote(preg_match("~(^[/\\\\]|:)~",$o)?$o:dirname($_SERVER["SCRIPT_FILENAME"])."/$o")." AS a")){parent::__construct($o);$this->query("PRAGMA foreign_keys = 1");$this->query("PRAGMA busy_timeout = 500");return
true;}return
false;}function
multi_query($G){return$this->_result=$this->query($G);}function
next_result(){return
false;}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$K,$qg){$Yi=array();foreach($K
as$N)$Yi[]="(".implode(", ",$N).")";return
queries("REPLACE INTO ".table($Q)." (".implode(", ",array_keys(reset($K))).") VALUES\n".implode(",\n",$Yi));}function
tableHelp($C){if($C=="sqlite_sequence")return"fileformat2.html#seqtab";if($C=="sqlite_master")return"fileformat2.html#$C";}}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
connect(){global$b;list(,,$F)=$b->credentials();if($F!="")return'La base de données ne support pas les mots de passe';return
new
Min_DB;}function
get_databases(){return
array();}function
limit($G,$Z,$y,$nf=0,$mh=" "){return" $G$Z".($y!==null?$mh."LIMIT $y".($nf?" OFFSET $nf":""):"");}function
limit1($Q,$G,$Z,$mh="\n"){global$f;return(preg_match('~^INTO~',$G)||$f->result("SELECT sqlite_compileoption_used('ENABLE_UPDATE_DELETE_LIMIT')")?limit($G,$Z,1,0,$mh):" $G WHERE rowid = (SELECT rowid FROM ".table($Q).$Z.$mh."LIMIT 1)");}function
db_collation($j,$nb){global$f;return$f->result("PRAGMA encoding");}function
engines(){return
array();}function
logged_user(){return
get_current_user();}function
tables_list(){return
get_key_vals("SELECT name, type FROM sqlite_master WHERE type IN ('table', 'view') ORDER BY (name = 'sqlite_sequence'), name");}function
count_tables($i){return
array();}function
table_status($C=""){global$f;$I=array();foreach(get_rows("SELECT name AS Name, type AS Engine, 'rowid' AS Oid, '' AS Auto_increment FROM sqlite_master WHERE type IN ('table', 'view') ".($C!=""?"AND name = ".q($C):"ORDER BY name"))as$J){$J["Rows"]=$f->result("SELECT COUNT(*) FROM ".idf_escape($J["Name"]));$I[$J["Name"]]=$J;}foreach(get_rows("SELECT * FROM sqlite_sequence",null,"")as$J)$I[$J["name"]]["Auto_increment"]=$J["seq"];return($C!=""?$I[$C]:$I);}function
is_view($R){return$R["Engine"]=="view";}function
fk_support($R){global$f;return!$f->result("SELECT sqlite_compileoption_used('OMIT_FOREIGN_KEY')");}function
fields($Q){global$f;$I=array();$qg="";foreach(get_rows("PRAGMA table_info(".table($Q).")")as$J){$C=$J["name"];$T=strtolower($J["type"]);$Yb=$J["dflt_value"];$I[$C]=array("field"=>$C,"type"=>(preg_match('~int~i',$T)?"integer":(preg_match('~char|clob|text~i',$T)?"text":(preg_match('~blob~i',$T)?"blob":(preg_match('~real|floa|doub~i',$T)?"real":"numeric")))),"full_type"=>$T,"default"=>(preg_match("~'(.*)'~",$Yb,$B)?str_replace("''","'",$B[1]):($Yb=="NULL"?null:$Yb)),"null"=>!$J["notnull"],"privileges"=>array("select"=>1,"insert"=>1,"update"=>1),"primary"=>$J["pk"],);if($J["pk"]){if($qg!="")$I[$qg]["auto_increment"]=false;elseif(preg_match('~^integer$~i',$T))$I[$C]["auto_increment"]=true;$qg=$C;}}$Ch=$f->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($Q));preg_match_all('~(("[^"]*+")+|[a-z0-9_]+)\s+text\s+COLLATE\s+(\'[^\']+\'|\S+)~i',$Ch,$Ie,PREG_SET_ORDER);foreach($Ie
as$B){$C=str_replace('""','"',preg_replace('~^"|"$~','',$B[1]));if($I[$C])$I[$C]["collation"]=trim($B[3],"'");}return$I;}function
indexes($Q,$g=null){global$f;if(!is_object($g))$g=$f;$I=array();$Ch=$g->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($Q));if(preg_match('~\bPRIMARY\s+KEY\s*\((([^)"]+|"[^"]*"|`[^`]*`)++)~i',$Ch,$B)){$I[""]=array("type"=>"PRIMARY","columns"=>array(),"lengths"=>array(),"descs"=>array());preg_match_all('~((("[^"]*+")+|(?:`[^`]*+`)+)|(\S+))(\s+(ASC|DESC))?(,\s*|$)~i',$B[1],$Ie,PREG_SET_ORDER);foreach($Ie
as$B){$I[""]["columns"][]=idf_unescape($B[2]).$B[4];$I[""]["descs"][]=(preg_match('~DESC~i',$B[5])?'1':null);}}if(!$I){foreach(fields($Q)as$C=>$m){if($m["primary"])$I[""]=array("type"=>"PRIMARY","columns"=>array($C),"lengths"=>array(),"descs"=>array(null));}}$Fh=get_key_vals("SELECT name, sql FROM sqlite_master WHERE type = 'index' AND tbl_name = ".q($Q),$g);foreach(get_rows("PRAGMA index_list(".table($Q).")",$g)as$J){$C=$J["name"];$u=array("type"=>($J["unique"]?"UNIQUE":"INDEX"));$u["lengths"]=array();$u["descs"]=array();foreach(get_rows("PRAGMA index_info(".idf_escape($C).")",$g)as$bh){$u["columns"][]=$bh["name"];$u["descs"][]=null;}if(preg_match('~^CREATE( UNIQUE)? INDEX '.preg_quote(idf_escape($C).' ON '.idf_escape($Q),'~').' \((.*)\)$~i',$Fh[$C],$Lg)){preg_match_all('/("[^"]*+")+( DESC)?/',$Lg[2],$Ie);foreach($Ie[2]as$x=>$X){if($X)$u["descs"][$x]='1';}}if(!$I[""]||$u["type"]!="UNIQUE"||$u["columns"]!=$I[""]["columns"]||$u["descs"]!=$I[""]["descs"]||!preg_match("~^sqlite_~",$C))$I[$C]=$u;}return$I;}function
foreign_keys($Q){$I=array();foreach(get_rows("PRAGMA foreign_key_list(".table($Q).")")as$J){$p=&$I[$J["id"]];if(!$p)$p=$J;$p["source"][]=$J["from"];$p["target"][]=$J["to"];}return$I;}function
view($C){global$f;return
array("select"=>preg_replace('~^(?:[^`"[]+|`[^`]*`|"[^"]*")* AS\s+~iU','',$f->result("SELECT sql FROM sqlite_master WHERE name = ".q($C))));}function
collations(){return(isset($_GET["create"])?get_vals("PRAGMA collation_list",1):array());}function
information_schema($j){return
false;}function
error(){global$f;return
h($f->error);}function
check_sqlite_name($C){global$f;$Sc="db|sdb|sqlite";if(!preg_match("~^[^\\0]*\\.($Sc)\$~",$C)){$f->error=sprintf('Veuillez utiliser l\'une des extensions %s.',str_replace("|",", ",$Sc));return
false;}return
true;}function
create_database($j,$mb){global$f;if(file_exists($j)){$f->error='Le fichier existe.';return
false;}if(!check_sqlite_name($j))return
false;try{$z=new
Min_SQLite($j);}catch(Exception$Jc){$f->error=$Jc->getMessage();return
false;}$z->query('PRAGMA encoding = "UTF-8"');$z->query('CREATE TABLE adminer (i)');$z->query('DROP TABLE adminer');return
true;}function
drop_databases($i){global$f;$f->__construct(":memory:");foreach($i
as$j){if(!@unlink($j)){$f->error='Le fichier existe.';return
false;}}return
true;}function
rename_database($C,$mb){global$f;if(!check_sqlite_name($C))return
false;$f->__construct(":memory:");$f->error='Le fichier existe.';return@rename(DB,$C);}function
auto_increment(){return" PRIMARY KEY".(DRIVER=="sqlite"?" AUTOINCREMENT":"");}function
alter_table($Q,$C,$n,$kd,$tb,$Bc,$mb,$La,$Zf){global$f;$Ri=($Q==""||$kd);foreach($n
as$m){if($m[0]!=""||!$m[1]||$m[2]){$Ri=true;break;}}$c=array();$Nf=array();foreach($n
as$m){if($m[1]){$c[]=($Ri?$m[1]:"ADD ".implode($m[1]));if($m[0]!="")$Nf[$m[0]]=$m[1][0];}}if(!$Ri){foreach($c
as$X){if(!queries("ALTER TABLE ".table($Q)." $X"))return
false;}if($Q!=$C&&!queries("ALTER TABLE ".table($Q)." RENAME TO ".table($C)))return
false;}elseif(!recreate_table($Q,$C,$c,$Nf,$kd,$La))return
false;if($La){queries("BEGIN");queries("UPDATE sqlite_sequence SET seq = $La WHERE name = ".q($C));if(!$f->affected_rows)queries("INSERT INTO sqlite_sequence (name, seq) VALUES (".q($C).", $La)");queries("COMMIT");}return
true;}function
recreate_table($Q,$C,$n,$Nf,$kd,$La,$v=array()){global$f;if($Q!=""){if(!$n){foreach(fields($Q)as$x=>$m){if($v)$m["auto_increment"]=0;$n[]=process_field($m,$m);$Nf[$x]=idf_escape($x);}}$rg=false;foreach($n
as$m){if($m[6])$rg=true;}$pc=array();foreach($v
as$x=>$X){if($X[2]=="DROP"){$pc[$X[1]]=true;unset($v[$x]);}}foreach(indexes($Q)as$me=>$u){$e=array();foreach($u["columns"]as$x=>$d){if(!$Nf[$d])continue
2;$e[]=$Nf[$d].($u["descs"][$x]?" DESC":"");}if(!$pc[$me]){if($u["type"]!="PRIMARY"||!$rg)$v[]=array($u["type"],$me,$e);}}foreach($v
as$x=>$X){if($X[0]=="PRIMARY"){unset($v[$x]);$kd[]="  PRIMARY KEY (".implode(", ",$X[2]).")";}}foreach(foreign_keys($Q)as$me=>$p){foreach($p["source"]as$x=>$d){if(!$Nf[$d])continue
2;$p["source"][$x]=idf_unescape($Nf[$d]);}if(!isset($kd[" $me"]))$kd[]=" ".format_foreign_key($p);}queries("BEGIN");}foreach($n
as$x=>$m)$n[$x]="  ".implode($m);$n=array_merge($n,array_filter($kd));$di=($Q==$C?"adminer_$C":$C);if(!queries("CREATE TABLE ".table($di)." (\n".implode(",\n",$n)."\n)"))return
false;if($Q!=""){if($Nf&&!queries("INSERT INTO ".table($di)." (".implode(", ",$Nf).") SELECT ".implode(", ",array_map('idf_escape',array_keys($Nf)))." FROM ".table($Q)))return
false;$Di=array();foreach(triggers($Q)as$Bi=>$ki){$Ai=trigger($Bi);$Di[]="CREATE TRIGGER ".idf_escape($Bi)." ".implode(" ",$ki)." ON ".table($C)."\n$Ai[Statement]";}$La=$La?0:$f->result("SELECT seq FROM sqlite_sequence WHERE name = ".q($Q));if(!queries("DROP TABLE ".table($Q))||($Q==$C&&!queries("ALTER TABLE ".table($di)." RENAME TO ".table($C)))||!alter_indexes($C,$v))return
false;if($La)queries("UPDATE sqlite_sequence SET seq = $La WHERE name = ".q($C));foreach($Di
as$Ai){if(!queries($Ai))return
false;}queries("COMMIT");}return
true;}function
index_sql($Q,$T,$C,$e){return"CREATE $T ".($T!="INDEX"?"INDEX ":"").idf_escape($C!=""?$C:uniqid($Q."_"))." ON ".table($Q)." $e";}function
alter_indexes($Q,$c){foreach($c
as$qg){if($qg[0]=="PRIMARY")return
recreate_table($Q,$Q,array(),array(),array(),0,$c);}foreach(array_reverse($c)as$X){if(!queries($X[2]=="DROP"?"DROP INDEX ".idf_escape($X[1]):index_sql($Q,$X[0],$X[1],"(".implode(", ",$X[2]).")")))return
false;}return
true;}function
truncate_tables($S){return
apply_queries("DELETE FROM",$S);}function
drop_views($dj){return
apply_queries("DROP VIEW",$dj);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
move_tables($S,$dj,$bi){return
false;}function
trigger($C){global$f;if($C=="")return
array("Statement"=>"BEGIN\n\t;\nEND");$t='(?:[^`"\s]+|`[^`]*`|"[^"]*")+';$Ci=trigger_options();preg_match("~^CREATE\\s+TRIGGER\\s*$t\\s*(".implode("|",$Ci["Timing"]).")\\s+([a-z]+)(?:\\s+OF\\s+($t))?\\s+ON\\s*$t\\s*(?:FOR\\s+EACH\\s+ROW\\s)?(.*)~is",$f->result("SELECT sql FROM sqlite_master WHERE type = 'trigger' AND name = ".q($C)),$B);$mf=$B[3];return
array("Timing"=>strtoupper($B[1]),"Event"=>strtoupper($B[2]).($mf?" OF":""),"Of"=>idf_unescape($mf),"Trigger"=>$C,"Statement"=>$B[4],);}function
triggers($Q){$I=array();$Ci=trigger_options();foreach(get_rows("SELECT * FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($Q))as$J){preg_match('~^CREATE\s+TRIGGER\s*(?:[^`"\s]+|`[^`]*`|"[^"]*")+\s*('.implode("|",$Ci["Timing"]).')\s*(.*?)\s+ON\b~i',$J["sql"],$B);$I[$J["name"]]=array($B[1],$B[2]);}return$I;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
begin(){return
queries("BEGIN");}function
last_id(){global$f;return$f->result("SELECT LAST_INSERT_ROWID()");}function
explain($f,$G){return$f->query("EXPLAIN QUERY PLAN $G");}function
found_rows($R,$Z){}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($fh){return
true;}function
create_sql($Q,$La,$Mh){global$f;$I=$f->result("SELECT sql FROM sqlite_master WHERE type IN ('table', 'view') AND name = ".q($Q));foreach(indexes($Q)as$C=>$u){if($C=='')continue;$I.=";\n\n".index_sql($Q,$u['type'],$C,"(".implode(", ",array_map('idf_escape',$u['columns'])).")");}return$I;}function
truncate_sql($Q){return"DELETE FROM ".table($Q);}function
use_sql($Sb){}function
trigger_sql($Q){return
implode(get_vals("SELECT sql || ';;\n' FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($Q)));}function
show_variables(){global$f;$I=array();foreach(array("auto_vacuum","cache_size","count_changes","default_cache_size","empty_result_callbacks","encoding","foreign_keys","full_column_names","fullfsync","journal_mode","journal_size_limit","legacy_file_format","locking_mode","page_size","max_page_count","read_uncommitted","recursive_triggers","reverse_unordered_selects","secure_delete","short_column_names","synchronous","temp_store","temp_store_directory","schema_version","integrity_check","quick_check")as$x)$I[$x]=$f->result("PRAGMA $x");return$I;}function
show_status(){$I=array();foreach(get_vals("PRAGMA compile_options")as$Cf){list($x,$X)=explode("=",$Cf,2);$I[$x]=$X;}return$I;}function
convert_field($m){}function
unconvert_field($m,$I){return$I;}function
support($Xc){return
preg_match('~^(columns|database|drop_col|dump|indexes|descidx|move_col|sql|status|table|trigger|variables|view|view_trigger)$~',$Xc);}function
driver_config(){$U=array("integer"=>0,"real"=>0,"numeric"=>0,"text"=>0,"blob"=>0);return
array('possible_drivers'=>array((isset($_GET["sqlite"])?"SQLite3":"SQLite"),"PDO_SQLite"),'jush'=>"sqlite",'types'=>$U,'structured_types'=>array_keys($U),'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL"),'functions'=>array("distinct","hex","length","lower","round","unixepoch","upper"),'grouping'=>array("avg","count","count distinct","group_concat","max","min","sum"),'edit_functions'=>array(array(),array("integer|real|numeric"=>"+/-","text"=>"||",)),);}}$mc["pgsql"]="PostgreSQL";if(isset($_GET["pgsql"])){define("DRIVER","pgsql");if(extension_loaded("pgsql")){class
Min_DB{var$extension="PgSQL",$_link,$_result,$_string,$_database=true,$server_info,$affected_rows,$error,$timeout;function
_error($Ec,$l){if(ini_bool("html_errors"))$l=html_entity_decode(strip_tags($l));$l=preg_replace('~^[^:]*: ~','',$l);$this->error=$l;}function
connect($M,$V,$F){global$b;$j=$b->database();set_error_handler(array($this,'_error'));$this->_string="host='".str_replace(":","' port='",addcslashes($M,"'\\"))."' user='".addcslashes($V,"'\\")."' password='".addcslashes($F,"'\\")."'";$this->_link=@pg_connect("$this->_string dbname='".($j!=""?addcslashes($j,"'\\"):"postgres")."'",PGSQL_CONNECT_FORCE_NEW);if(!$this->_link&&$j!=""){$this->_database=false;$this->_link=@pg_connect("$this->_string dbname='postgres'",PGSQL_CONNECT_FORCE_NEW);}restore_error_handler();if($this->_link){$bj=pg_version($this->_link);$this->server_info=$bj["server"];pg_set_client_encoding($this->_link,"UTF8");}return(bool)$this->_link;}function
quote($P){return"'".pg_escape_string($this->_link,$P)."'";}function
value($X,$m){return($m["type"]=="bytea"&&$X!==null?pg_unescape_bytea($X):$X);}function
quoteBinary($P){return"'".pg_escape_bytea($this->_link,$P)."'";}function
select_db($Sb){global$b;if($Sb==$b->database())return$this->_database;$I=@pg_connect("$this->_string dbname='".addcslashes($Sb,"'\\")."'",PGSQL_CONNECT_FORCE_NEW);if($I)$this->_link=$I;return$I;}function
close(){$this->_link=@pg_connect("$this->_string dbname='postgres'");}function
query($G,$Gi=false){$H=@pg_query($this->_link,$G);$this->error="";if(!$H){$this->error=pg_last_error($this->_link);$I=false;}elseif(!pg_num_fields($H)){$this->affected_rows=pg_affected_rows($H);$I=true;}else$I=new
Min_Result($H);if($this->timeout){$this->timeout=0;$this->query("RESET statement_timeout");}return$I;}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$m=0){$H=$this->query($G);if(!$H||!$H->num_rows)return
false;return
pg_fetch_result($H->_result,0,$m);}function
warnings(){return
h(pg_last_notice($this->_link));}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($H){$this->_result=$H;$this->num_rows=pg_num_rows($H);}function
fetch_assoc(){return
pg_fetch_assoc($this->_result);}function
fetch_row(){return
pg_fetch_row($this->_result);}function
fetch_field(){$d=$this->_offset++;$I=new
stdClass;if(function_exists('pg_field_table'))$I->orgtable=pg_field_table($this->_result,$d);$I->name=pg_field_name($this->_result,$d);$I->orgname=$I->name;$I->type=pg_field_type($this->_result,$d);$I->charsetnr=($I->type=="bytea"?63:0);return$I;}function
__destruct(){pg_free_result($this->_result);}}}elseif(extension_loaded("pdo_pgsql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_PgSQL",$timeout;function
connect($M,$V,$F){global$b;$j=$b->database();$this->dsn("pgsql:host='".str_replace(":","' port='",addcslashes($M,"'\\"))."' client_encoding=utf8 dbname='".($j!=""?addcslashes($j,"'\\"):"postgres")."'",$V,$F);return
true;}function
select_db($Sb){global$b;return($b->database()==$Sb);}function
quoteBinary($ch){return
q($ch);}function
query($G,$Gi=false){$I=parent::query($G,$Gi);if($this->timeout){$this->timeout=0;parent::query("RESET statement_timeout");}return$I;}function
warnings(){return'';}function
close(){}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$K,$qg){global$f;foreach($K
as$N){$Ni=array();$Z=array();foreach($N
as$x=>$X){$Ni[]="$x = $X";if(isset($qg[idf_unescape($x)]))$Z[]="$x = $X";}if(!(($Z&&queries("UPDATE ".table($Q)." SET ".implode(", ",$Ni)." WHERE ".implode(" AND ",$Z))&&$f->affected_rows)||queries("INSERT INTO ".table($Q)." (".implode(", ",array_keys($N)).") VALUES (".implode(", ",$N).")")))return
false;}return
true;}function
slowQuery($G,$ji){$this->_conn->query("SET statement_timeout = ".(1000*$ji));$this->_conn->timeout=1000*$ji;return$G;}function
convertSearch($t,$X,$m){return(preg_match('~char|text'.(!preg_match('~LIKE~',$X["op"])?'|date|time(stamp)?|boolean|uuid|'.number_type():'').'~',$m["type"])?$t:"CAST($t AS text)");}function
quoteBinary($ch){return$this->_conn->quoteBinary($ch);}function
warnings(){return$this->_conn->warnings();}function
tableHelp($C){$_=array("information_schema"=>"infoschema","pg_catalog"=>"catalog",);$z=$_[$_GET["ns"]];if($z)return"$z-".str_replace("_","-",$C).".html";}}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
connect(){global$b,$U,$Lh;$f=new
Min_DB;$Lb=$b->credentials();if($f->connect($Lb[0],$Lb[1],$Lb[2])){if(min_version(9,0,$f)){$f->query("SET application_name = 'Adminer'");if(min_version(9.2,0,$f)){$Lh['Chaînes'][]="json";$U["json"]=4294967295;if(min_version(9.4,0,$f)){$Lh['Chaînes'][]="jsonb";$U["jsonb"]=4294967295;}}}return$f;}return$f->error;}function
get_databases(){return
get_vals("SELECT datname FROM pg_database WHERE has_database_privilege(datname, 'CONNECT') ORDER BY datname");}function
limit($G,$Z,$y,$nf=0,$mh=" "){return" $G$Z".($y!==null?$mh."LIMIT $y".($nf?" OFFSET $nf":""):"");}function
limit1($Q,$G,$Z,$mh="\n"){return(preg_match('~^INTO~',$G)?limit($G,$Z,1,0,$mh):" $G".(is_view(table_status1($Q))?$Z:$mh."WHERE ctid = (SELECT ctid FROM ".table($Q).$Z.$mh."LIMIT 1)"));}function
db_collation($j,$nb){global$f;return$f->result("SELECT datcollate FROM pg_database WHERE datname = ".q($j));}function
engines(){return
array();}function
logged_user(){global$f;return$f->result("SELECT user");}function
tables_list(){$G="SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = current_schema()";if(support('materializedview'))$G.="
UNION ALL
SELECT matviewname, 'MATERIALIZED VIEW'
FROM pg_matviews
WHERE schemaname = current_schema()";$G.="
ORDER BY 1";return
get_key_vals($G);}function
count_tables($i){return
array();}function
table_status($C=""){$I=array();foreach(get_rows("SELECT c.relname AS \"Name\", CASE c.relkind WHEN 'r' THEN 'table' WHEN 'm' THEN 'materialized view' ELSE 'view' END AS \"Engine\", pg_relation_size(c.oid) AS \"Data_length\", pg_total_relation_size(c.oid) - pg_relation_size(c.oid) AS \"Index_length\", obj_description(c.oid, 'pg_class') AS \"Comment\", ".(min_version(12)?"''":"CASE WHEN c.relhasoids THEN 'oid' ELSE '' END")." AS \"Oid\", c.reltuples as \"Rows\", n.nspname
FROM pg_class c
JOIN pg_namespace n ON(n.nspname = current_schema() AND n.oid = c.relnamespace)
WHERE relkind IN ('r', 'm', 'v', 'f', 'p')
".($C!=""?"AND relname = ".q($C):"ORDER BY relname"))as$J)$I[$J["Name"]]=$J;return($C!=""?$I[$C]:$I);}function
is_view($R){return
in_array($R["Engine"],array("view","materialized view"));}function
fk_support($R){return
true;}function
fields($Q){$I=array();$Ca=array('timestamp without time zone'=>'timestamp','timestamp with time zone'=>'timestamptz',);foreach(get_rows("SELECT a.attname AS field, format_type(a.atttypid, a.atttypmod) AS full_type, pg_get_expr(d.adbin, d.adrelid) AS default, a.attnotnull::int, col_description(c.oid, a.attnum) AS comment".(min_version(10)?", a.attidentity":"")."
FROM pg_class c
JOIN pg_namespace n ON c.relnamespace = n.oid
JOIN pg_attribute a ON c.oid = a.attrelid
LEFT JOIN pg_attrdef d ON c.oid = d.adrelid AND a.attnum = d.adnum
WHERE c.relname = ".q($Q)."
AND n.nspname = current_schema()
AND NOT a.attisdropped
AND a.attnum > 0
ORDER BY a.attnum")as$J){preg_match('~([^([]+)(\((.*)\))?([a-z ]+)?((\[[0-9]*])*)$~',$J["full_type"],$B);list(,$T,$ze,$J["length"],$xa,$Fa)=$B;$J["length"].=$Fa;$cb=$T.$xa;if(isset($Ca[$cb])){$J["type"]=$Ca[$cb];$J["full_type"]=$J["type"].$ze.$Fa;}else{$J["type"]=$T;$J["full_type"]=$J["type"].$ze.$xa.$Fa;}if(in_array($J['attidentity'],array('a','d')))$J['default']='GENERATED '.($J['attidentity']=='d'?'BY DEFAULT':'ALWAYS').' AS IDENTITY';$J["null"]=!$J["attnotnull"];$J["auto_increment"]=$J['attidentity']||preg_match('~^nextval\(~i',$J["default"]);$J["privileges"]=array("insert"=>1,"select"=>1,"update"=>1);if(preg_match('~(.+)::[^,)]+(.*)~',$J["default"],$B))$J["default"]=($B[1]=="NULL"?null:idf_unescape($B[1]).$B[2]);$I[$J["field"]]=$J;}return$I;}function
indexes($Q,$g=null){global$f;if(!is_object($g))$g=$f;$I=array();$Uh=$g->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($Q));$e=get_key_vals("SELECT attnum, attname FROM pg_attribute WHERE attrelid = $Uh AND attnum > 0",$g);foreach(get_rows("SELECT relname, indisunique::int, indisprimary::int, indkey, indoption, (indpred IS NOT NULL)::int as indispartial FROM pg_index i, pg_class ci WHERE i.indrelid = $Uh AND ci.oid = i.indexrelid",$g)as$J){$Mg=$J["relname"];$I[$Mg]["type"]=($J["indispartial"]?"INDEX":($J["indisprimary"]?"PRIMARY":($J["indisunique"]?"UNIQUE":"INDEX")));$I[$Mg]["columns"]=array();foreach(explode(" ",$J["indkey"])as$Vd)$I[$Mg]["columns"][]=$e[$Vd];$I[$Mg]["descs"]=array();foreach(explode(" ",$J["indoption"])as$Wd)$I[$Mg]["descs"][]=($Wd&1?'1':null);$I[$Mg]["lengths"]=array();}return$I;}function
foreign_keys($Q){global$vf;$I=array();foreach(get_rows("SELECT conname, condeferrable::int AS deferrable, pg_get_constraintdef(oid) AS definition
FROM pg_constraint
WHERE conrelid = (SELECT pc.oid FROM pg_class AS pc INNER JOIN pg_namespace AS pn ON (pn.oid = pc.relnamespace) WHERE pc.relname = ".q($Q)." AND pn.nspname = current_schema())
AND contype = 'f'::char
ORDER BY conkey, conname")as$J){if(preg_match('~FOREIGN KEY\s*\((.+)\)\s*REFERENCES (.+)\((.+)\)(.*)$~iA',$J['definition'],$B)){$J['source']=array_map('idf_unescape',array_map('trim',explode(',',$B[1])));if(preg_match('~^(("([^"]|"")+"|[^"]+)\.)?"?("([^"]|"")+"|[^"]+)$~',$B[2],$He)){$J['ns']=idf_unescape($He[2]);$J['table']=idf_unescape($He[4]);}$J['target']=array_map('idf_unescape',array_map('trim',explode(',',$B[3])));$J['on_delete']=(preg_match("~ON DELETE ($vf)~",$B[4],$He)?$He[1]:'NO ACTION');$J['on_update']=(preg_match("~ON UPDATE ($vf)~",$B[4],$He)?$He[1]:'NO ACTION');$I[$J['conname']]=$J;}}return$I;}function
constraints($Q){global$vf;$I=array();foreach(get_rows("SELECT conname, consrc
FROM pg_catalog.pg_constraint
INNER JOIN pg_catalog.pg_namespace ON pg_constraint.connamespace = pg_namespace.oid
INNER JOIN pg_catalog.pg_class ON pg_constraint.conrelid = pg_class.oid AND pg_constraint.connamespace = pg_class.relnamespace
WHERE pg_constraint.contype = 'c'
AND conrelid != 0 -- handle only CONSTRAINTs here, not TYPES
AND nspname = current_schema()
AND relname = ".q($Q)."
ORDER BY connamespace, conname")as$J)$I[$J['conname']]=$J['consrc'];return$I;}function
view($C){global$f;return
array("select"=>trim($f->result("SELECT pg_get_viewdef(".$f->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($C)).")")));}function
collations(){return
array();}function
information_schema($j){return($j=="information_schema");}function
error(){global$f;$I=h($f->error);if(preg_match('~^(.*\n)?([^\n]*)\n( *)\^(\n.*)?$~s',$I,$B))$I=$B[1].preg_replace('~((?:[^&]|&[^;]*;){'.strlen($B[3]).'})(.*)~','\1<b>\2</b>',$B[2]).$B[4];return
nl_br($I);}function
create_database($j,$mb){return
queries("CREATE DATABASE ".idf_escape($j).($mb?" ENCODING ".idf_escape($mb):""));}function
drop_databases($i){global$f;$f->close();return
apply_queries("DROP DATABASE",$i,'idf_escape');}function
rename_database($C,$mb){return
queries("ALTER DATABASE ".idf_escape(DB)." RENAME TO ".idf_escape($C));}function
auto_increment(){return"";}function
alter_table($Q,$C,$n,$kd,$tb,$Bc,$mb,$La,$Zf){$c=array();$_g=array();if($Q!=""&&$Q!=$C)$_g[]="ALTER TABLE ".table($Q)." RENAME TO ".table($C);foreach($n
as$m){$d=idf_escape($m[0]);$X=$m[1];if(!$X)$c[]="DROP $d";else{$Xi=$X[5];unset($X[5]);if($m[0]==""){if(isset($X[6]))$X[1]=($X[1]==" bigint"?" big":($X[1]==" smallint"?" small":" "))."serial";$c[]=($Q!=""?"ADD ":"  ").implode($X);if(isset($X[6]))$c[]=($Q!=""?"ADD":" ")." PRIMARY KEY ($X[0])";}else{if($d!=$X[0])$_g[]="ALTER TABLE ".table($C)." RENAME $d TO $X[0]";$c[]="ALTER $d TYPE$X[1]";if(!$X[6]){$c[]="ALTER $d ".($X[3]?"SET$X[3]":"DROP DEFAULT");$c[]="ALTER $d ".($X[2]==" NULL"?"DROP NOT":"SET").$X[2];}}if($m[0]!=""||$Xi!="")$_g[]="COMMENT ON COLUMN ".table($C).".$X[0] IS ".($Xi!=""?substr($Xi,9):"''");}}$c=array_merge($c,$kd);if($Q=="")array_unshift($_g,"CREATE TABLE ".table($C)." (\n".implode(",\n",$c)."\n)");elseif($c)array_unshift($_g,"ALTER TABLE ".table($Q)."\n".implode(",\n",$c));if($tb!==null)$_g[]="COMMENT ON TABLE ".table($C)." IS ".q($tb);if($La!=""){}foreach($_g
as$G){if(!queries($G))return
false;}return
true;}function
alter_indexes($Q,$c){$h=array();$nc=array();$_g=array();foreach($c
as$X){if($X[0]!="INDEX")$h[]=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");elseif($X[2]=="DROP")$nc[]=idf_escape($X[1]);else$_g[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q)." (".implode(", ",$X[2]).")";}if($h)array_unshift($_g,"ALTER TABLE ".table($Q).implode(",",$h));if($nc)array_unshift($_g,"DROP INDEX ".implode(", ",$nc));foreach($_g
as$G){if(!queries($G))return
false;}return
true;}function
truncate_tables($S){return
queries("TRUNCATE ".implode(", ",array_map('table',$S)));return
true;}function
drop_views($dj){return
drop_tables($dj);}function
drop_tables($S){foreach($S
as$Q){$O=table_status($Q);if(!queries("DROP ".strtoupper($O["Engine"])." ".table($Q)))return
false;}return
true;}function
move_tables($S,$dj,$bi){foreach(array_merge($S,$dj)as$Q){$O=table_status($Q);if(!queries("ALTER ".strtoupper($O["Engine"])." ".table($Q)." SET SCHEMA ".idf_escape($bi)))return
false;}return
true;}function
trigger($C,$Q){if($C=="")return
array("Statement"=>"EXECUTE PROCEDURE ()");$e=array();$Z="WHERE trigger_schema = current_schema() AND event_object_table = ".q($Q)." AND trigger_name = ".q($C);foreach(get_rows("SELECT * FROM information_schema.triggered_update_columns $Z")as$J)$e[]=$J["event_object_column"];$I=array();foreach(get_rows('SELECT trigger_name AS "Trigger", action_timing AS "Timing", event_manipulation AS "Event", \'FOR EACH \' || action_orientation AS "Type", action_statement AS "Statement" FROM information_schema.triggers '."$Z ORDER BY event_manipulation DESC")as$J){if($e&&$J["Event"]=="UPDATE")$J["Event"].=" OF";$J["Of"]=implode(", ",$e);if($I)$J["Event"].=" OR $I[Event]";$I=$J;}return$I;}function
triggers($Q){$I=array();foreach(get_rows("SELECT * FROM information_schema.triggers WHERE trigger_schema = current_schema() AND event_object_table = ".q($Q))as$J){$Ai=trigger($J["trigger_name"],$Q);$I[$Ai["Trigger"]]=array($Ai["Timing"],$Ai["Event"]);}return$I;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE","INSERT OR UPDATE","INSERT OR UPDATE OF","DELETE OR INSERT","DELETE OR UPDATE","DELETE OR UPDATE OF","DELETE OR INSERT OR UPDATE","DELETE OR INSERT OR UPDATE OF"),"Type"=>array("FOR EACH ROW","FOR EACH STATEMENT"),);}function
routine($C,$T){$K=get_rows('SELECT routine_definition AS definition, LOWER(external_language) AS language, *
FROM information_schema.routines
WHERE routine_schema = current_schema() AND specific_name = '.q($C));$I=$K[0];$I["returns"]=array("type"=>$I["type_udt_name"]);$I["fields"]=get_rows('SELECT parameter_name AS field, data_type AS type, character_maximum_length AS length, parameter_mode AS inout
FROM information_schema.parameters
WHERE specific_schema = current_schema() AND specific_name = '.q($C).'
ORDER BY ordinal_position');return$I;}function
routines(){return
get_rows('SELECT specific_name AS "SPECIFIC_NAME", routine_type AS "ROUTINE_TYPE", routine_name AS "ROUTINE_NAME", type_udt_name AS "DTD_IDENTIFIER"
FROM information_schema.routines
WHERE routine_schema = current_schema()
ORDER BY SPECIFIC_NAME');}function
routine_languages(){return
get_vals("SELECT LOWER(lanname) FROM pg_catalog.pg_language");}function
routine_id($C,$J){$I=array();foreach($J["fields"]as$m)$I[]=$m["type"];return
idf_escape($C)."(".implode(", ",$I).")";}function
last_id(){return
0;}function
explain($f,$G){return$f->query("EXPLAIN $G");}function
found_rows($R,$Z){global$f;if(preg_match("~ rows=([0-9]+)~",$f->result("EXPLAIN SELECT * FROM ".idf_escape($R["Name"]).($Z?" WHERE ".implode(" AND ",$Z):"")),$Lg))return$Lg[1];return
false;}function
types(){return
get_vals("SELECT typname
FROM pg_type
WHERE typnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema())
AND typtype IN ('b','d','e')
AND typelem = 0");}function
schemas(){return
get_vals("SELECT nspname FROM pg_namespace ORDER BY nspname");}function
get_schema(){global$f;return$f->result("SELECT current_schema()");}function
set_schema($eh,$g=null){global$f,$U,$Lh;if(!$g)$g=$f;$I=$g->query("SET search_path TO ".idf_escape($eh));foreach(types()as$T){if(!isset($U[$T])){$U[$T]=0;$Lh['Types utilisateur'][]=$T;}}return$I;}function
foreign_keys_sql($Q){$I="";$O=table_status($Q);$gd=foreign_keys($Q);ksort($gd);foreach($gd
as$fd=>$ed)$I.="ALTER TABLE ONLY ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." ADD CONSTRAINT ".idf_escape($fd)." $ed[definition] ".($ed['deferrable']?'DEFERRABLE':'NOT DEFERRABLE').";\n";return($I?"$I\n":$I);}function
create_sql($Q,$La,$Mh){global$f;$I='';$Ug=array();$oh=array();$O=table_status($Q);if(is_view($O)){$cj=view($Q);return
rtrim("CREATE VIEW ".idf_escape($Q)." AS $cj[select]",";");}$n=fields($Q);$v=indexes($Q);ksort($v);$Bb=constraints($Q);if(!$O||empty($n))return
false;$I="CREATE TABLE ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." (\n    ";foreach($n
as$Zc=>$m){$Wf=idf_escape($m['field']).' '.$m['full_type'].default_value($m).($m['attnotnull']?" NOT NULL":"");$Ug[]=$Wf;if(preg_match('~nextval\(\'([^\']+)\'\)~',$m['default'],$Ie)){$nh=$Ie[1];$Bh=reset(get_rows(min_version(10)?"SELECT *, cache_size AS cache_value FROM pg_sequences WHERE schemaname = current_schema() AND sequencename = ".q($nh):"SELECT * FROM $nh"));$oh[]=($Mh=="DROP+CREATE"?"DROP SEQUENCE IF EXISTS $nh;\n":"")."CREATE SEQUENCE $nh INCREMENT $Bh[increment_by] MINVALUE $Bh[min_value] MAXVALUE $Bh[max_value]".($La&&$Bh['last_value']?" START $Bh[last_value]":"")." CACHE $Bh[cache_value];";}}if(!empty($oh))$I=implode("\n\n",$oh)."\n\n$I";foreach($v
as$Qd=>$u){switch($u['type']){case'UNIQUE':$Ug[]="CONSTRAINT ".idf_escape($Qd)." UNIQUE (".implode(', ',array_map('idf_escape',$u['columns'])).")";break;case'PRIMARY':$Ug[]="CONSTRAINT ".idf_escape($Qd)." PRIMARY KEY (".implode(', ',array_map('idf_escape',$u['columns'])).")";break;}}foreach($Bb
as$zb=>$Ab)$Ug[]="CONSTRAINT ".idf_escape($zb)." CHECK $Ab";$I.=implode(",\n    ",$Ug)."\n) WITH (oids = ".($O['Oid']?'true':'false').");";foreach($v
as$Qd=>$u){if($u['type']=='INDEX'){$e=array();foreach($u['columns']as$x=>$X)$e[]=idf_escape($X).($u['descs'][$x]?" DESC":"");$I.="\n\nCREATE INDEX ".idf_escape($Qd)." ON ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." USING btree (".implode(', ',$e).");";}}if($O['Comment'])$I.="\n\nCOMMENT ON TABLE ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." IS ".q($O['Comment']).";";foreach($n
as$Zc=>$m){if($m['comment'])$I.="\n\nCOMMENT ON COLUMN ".idf_escape($O['nspname']).".".idf_escape($O['Name']).".".idf_escape($Zc)." IS ".q($m['comment']).";";}return
rtrim($I,';');}function
truncate_sql($Q){return"TRUNCATE ".table($Q);}function
trigger_sql($Q){$O=table_status($Q);$I="";foreach(triggers($Q)as$_i=>$zi){$Ai=trigger($_i,$O['Name']);$I.="\nCREATE TRIGGER ".idf_escape($Ai['Trigger'])." $Ai[Timing] $Ai[Event] ON ".idf_escape($O["nspname"]).".".idf_escape($O['Name'])." $Ai[Type] $Ai[Statement];;\n";}return$I;}function
use_sql($Sb){return"\connect ".idf_escape($Sb);}function
show_variables(){return
get_key_vals("SHOW ALL");}function
process_list(){return
get_rows("SELECT * FROM pg_stat_activity ORDER BY ".(min_version(9.2)?"pid":"procpid"));}function
show_status(){}function
convert_field($m){}function
unconvert_field($m,$I){return$I;}function
support($Xc){return
preg_match('~^(database|table|columns|sql|indexes|descidx|comment|view|'.(min_version(9.3)?'materializedview|':'').'scheme|routine|processlist|sequence|trigger|type|variables|drop_col|kill|dump)$~',$Xc);}function
kill_process($X){return
queries("SELECT pg_terminate_backend(".number($X).")");}function
connection_id(){return"SELECT pg_backend_pid()";}function
max_connections(){global$f;return$f->result("SHOW max_connections");}function
driver_config(){$U=array();$Lh=array();foreach(array('Nombres'=>array("smallint"=>5,"integer"=>10,"bigint"=>19,"boolean"=>1,"numeric"=>0,"real"=>7,"double precision"=>16,"money"=>20),'Date et heure'=>array("date"=>13,"time"=>17,"timestamp"=>20,"timestamptz"=>21,"interval"=>0),'Chaînes'=>array("character"=>0,"character varying"=>0,"text"=>0,"tsquery"=>0,"tsvector"=>0,"uuid"=>0,"xml"=>0),'Binaires'=>array("bit"=>0,"bit varying"=>0,"bytea"=>0),'Réseau'=>array("cidr"=>43,"inet"=>43,"macaddr"=>17,"txid_snapshot"=>0),'Géométrie'=>array("box"=>0,"circle"=>0,"line"=>0,"lseg"=>0,"path"=>0,"point"=>0,"polygon"=>0),)as$x=>$X){$U+=$X;$Lh[$x]=array_keys($X);}return
array('possible_drivers'=>array("PgSQL","PDO_PgSQL"),'jush'=>"pgsql",'types'=>$U,'structured_types'=>$Lh,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","~","~*","!~","!~*","LIKE","LIKE %%","ILIKE","ILIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL"),'operator_regexp'=>'~*','functions'=>array("char_length","distinct","lower","round","to_hex","to_timestamp","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("char"=>"md5","date|time"=>"now",),array(number_type()=>"+/-","date|time"=>"+ interval/- interval","char|text"=>"||",)),);}}$mc["oracle"]="Oracle (beta)";if(isset($_GET["oracle"])){define("DRIVER","oracle");if(extension_loaded("oci8")){class
Min_DB{var$extension="oci8",$_link,$_result,$server_info,$affected_rows,$errno,$error;var$_current_db;function
_error($Ec,$l){if(ini_bool("html_errors"))$l=html_entity_decode(strip_tags($l));$l=preg_replace('~^[^:]*: ~','',$l);$this->error=$l;}function
connect($M,$V,$F){$this->_link=@oci_new_connect($V,$F,$M,"AL32UTF8");if($this->_link){$this->server_info=oci_server_version($this->_link);return
true;}$l=oci_error();$this->error=$l["message"];return
false;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($Sb){$this->_current_db=$Sb;return
true;}function
query($G,$Gi=false){$H=oci_parse($this->_link,$G);$this->error="";if(!$H){$l=oci_error($this->_link);$this->errno=$l["code"];$this->error=$l["message"];return
false;}set_error_handler(array($this,'_error'));$I=@oci_execute($H);restore_error_handler();if($I){if(oci_num_fields($H))return
new
Min_Result($H);$this->affected_rows=oci_num_rows($H);oci_free_statement($H);}return$I;}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$m=1){$H=$this->query($G);if(!is_object($H)||!oci_fetch($H->_result))return
false;return
oci_result($H->_result,$m);}}class
Min_Result{var$_result,$_offset=1,$num_rows;function
__construct($H){$this->_result=$H;}function
_convert($J){foreach((array)$J
as$x=>$X){if(is_a($X,'OCI-Lob'))$J[$x]=$X->load();}return$J;}function
fetch_assoc(){return$this->_convert(oci_fetch_assoc($this->_result));}function
fetch_row(){return$this->_convert(oci_fetch_row($this->_result));}function
fetch_field(){$d=$this->_offset++;$I=new
stdClass;$I->name=oci_field_name($this->_result,$d);$I->orgname=$I->name;$I->type=oci_field_type($this->_result,$d);$I->charsetnr=(preg_match("~raw|blob|bfile~",$I->type)?63:0);return$I;}function
__destruct(){oci_free_statement($this->_result);}}}elseif(extension_loaded("pdo_oci")){class
Min_DB
extends
Min_PDO{var$extension="PDO_OCI";var$_current_db;function
connect($M,$V,$F){$this->dsn("oci:dbname=//$M;charset=AL32UTF8",$V,$F);return
true;}function
select_db($Sb){$this->_current_db=$Sb;return
true;}}}class
Min_Driver
extends
Min_SQL{function
begin(){return
true;}function
insertUpdate($Q,$K,$qg){global$f;foreach($K
as$N){$Ni=array();$Z=array();foreach($N
as$x=>$X){$Ni[]="$x = $X";if(isset($qg[idf_unescape($x)]))$Z[]="$x = $X";}if(!(($Z&&queries("UPDATE ".table($Q)." SET ".implode(", ",$Ni)." WHERE ".implode(" AND ",$Z))&&$f->affected_rows)||queries("INSERT INTO ".table($Q)." (".implode(", ",array_keys($N)).") VALUES (".implode(", ",$N).")")))return
false;}return
true;}}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
connect(){global$b;$f=new
Min_DB;$Lb=$b->credentials();if($f->connect($Lb[0],$Lb[1],$Lb[2]))return$f;return$f->error;}function
get_databases(){return
get_vals("SELECT tablespace_name FROM user_tablespaces ORDER BY 1");}function
limit($G,$Z,$y,$nf=0,$mh=" "){return($nf?" * FROM (SELECT t.*, rownum AS rnum FROM (SELECT $G$Z) t WHERE rownum <= ".($y+$nf).") WHERE rnum > $nf":($y!==null?" * FROM (SELECT $G$Z) WHERE rownum <= ".($y+$nf):" $G$Z"));}function
limit1($Q,$G,$Z,$mh="\n"){return" $G$Z";}function
db_collation($j,$nb){global$f;return$f->result("SELECT value FROM nls_database_parameters WHERE parameter = 'NLS_CHARACTERSET'");}function
engines(){return
array();}function
logged_user(){global$f;return$f->result("SELECT USER FROM DUAL");}function
get_current_db(){global$f;$j=$f->_current_db?$f->_current_db:DB;unset($f->_current_db);return$j;}function
where_owner($og,$Qf="owner"){if(!$_GET["ns"])return'';return"$og$Qf = sys_context('USERENV', 'CURRENT_SCHEMA')";}function
views_table($e){$Qf=where_owner('');return"(SELECT $e FROM all_views WHERE ".($Qf?$Qf:"rownum < 0").")";}function
tables_list(){$cj=views_table("view_name");$Qf=where_owner(" AND ");return
get_key_vals("SELECT table_name, 'table' FROM all_tables WHERE tablespace_name = ".q(DB)."$Qf
UNION SELECT view_name, 'view' FROM $cj
ORDER BY 1");}function
count_tables($i){global$f;$I=array();foreach($i
as$j)$I[$j]=$f->result("SELECT COUNT(*) FROM all_tables WHERE tablespace_name = ".q($j));return$I;}function
table_status($C=""){$I=array();$gh=q($C);$j=get_current_db();$cj=views_table("view_name");$Qf=where_owner(" AND ");foreach(get_rows('SELECT table_name "Name", \'table\' "Engine", avg_row_len * num_rows "Data_length", num_rows "Rows" FROM all_tables WHERE tablespace_name = '.q($j).$Qf.($C!=""?" AND table_name = $gh":"")."
UNION SELECT view_name, 'view', 0, 0 FROM $cj".($C!=""?" WHERE view_name = $gh":"")."
ORDER BY 1")as$J){if($C!="")return$J;$I[$J["Name"]]=$J;}return$I;}function
is_view($R){return$R["Engine"]=="view";}function
fk_support($R){return
true;}function
fields($Q){$I=array();$Qf=where_owner(" AND ");foreach(get_rows("SELECT * FROM all_tab_columns WHERE table_name = ".q($Q)."$Qf ORDER BY column_id")as$J){$T=$J["DATA_TYPE"];$ze="$J[DATA_PRECISION],$J[DATA_SCALE]";if($ze==",")$ze=$J["CHAR_COL_DECL_LENGTH"];$I[$J["COLUMN_NAME"]]=array("field"=>$J["COLUMN_NAME"],"full_type"=>$T.($ze?"($ze)":""),"type"=>strtolower($T),"length"=>$ze,"default"=>$J["DATA_DEFAULT"],"null"=>($J["NULLABLE"]=="Y"),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);}return$I;}function
indexes($Q,$g=null){$I=array();$Qf=where_owner(" AND ","aic.table_owner");foreach(get_rows("SELECT aic.*, ac.constraint_type, atc.data_default
FROM all_ind_columns aic
LEFT JOIN all_constraints ac ON aic.index_name = ac.constraint_name AND aic.table_name = ac.table_name AND aic.index_owner = ac.owner
LEFT JOIN all_tab_cols atc ON aic.column_name = atc.column_name AND aic.table_name = atc.table_name AND aic.index_owner = atc.owner
WHERE aic.table_name = ".q($Q)."$Qf
ORDER BY ac.constraint_type, aic.column_position",$g)as$J){$Qd=$J["INDEX_NAME"];$qb=$J["DATA_DEFAULT"];$qb=($qb?trim($qb,'"'):$J["COLUMN_NAME"]);$I[$Qd]["type"]=($J["CONSTRAINT_TYPE"]=="P"?"PRIMARY":($J["CONSTRAINT_TYPE"]=="U"?"UNIQUE":"INDEX"));$I[$Qd]["columns"][]=$qb;$I[$Qd]["lengths"][]=($J["CHAR_LENGTH"]&&$J["CHAR_LENGTH"]!=$J["COLUMN_LENGTH"]?$J["CHAR_LENGTH"]:null);$I[$Qd]["descs"][]=($J["DESCEND"]&&$J["DESCEND"]=="DESC"?'1':null);}return$I;}function
view($C){$cj=views_table("view_name, text");$K=get_rows('SELECT text "select" FROM '.$cj.' WHERE view_name = '.q($C));return
reset($K);}function
collations(){return
array();}function
information_schema($j){return
false;}function
error(){global$f;return
h($f->error);}function
explain($f,$G){$f->query("EXPLAIN PLAN FOR $G");return$f->query("SELECT * FROM plan_table");}function
found_rows($R,$Z){}function
auto_increment(){return"";}function
alter_table($Q,$C,$n,$kd,$tb,$Bc,$mb,$La,$Zf){$c=$nc=array();$Kf=($Q?fields($Q):array());foreach($n
as$m){$X=$m[1];if($X&&$m[0]!=""&&idf_escape($m[0])!=$X[0])queries("ALTER TABLE ".table($Q)." RENAME COLUMN ".idf_escape($m[0])." TO $X[0]");$Jf=$Kf[$m[0]];if($X&&$Jf){$pf=process_field($Jf,$Jf);if($X[2]==$pf[2])$X[2]="";}if($X)$c[]=($Q!=""?($m[0]!=""?"MODIFY (":"ADD ("):"  ").implode($X).($Q!=""?")":"");else$nc[]=idf_escape($m[0]);}if($Q=="")return
queries("CREATE TABLE ".table($C)." (\n".implode(",\n",$c)."\n)");return(!$c||queries("ALTER TABLE ".table($Q)."\n".implode("\n",$c)))&&(!$nc||queries("ALTER TABLE ".table($Q)." DROP (".implode(", ",$nc).")"))&&($Q==$C||queries("ALTER TABLE ".table($Q)." RENAME TO ".table($C)));}function
alter_indexes($Q,$c){$nc=array();$_g=array();foreach($c
as$X){if($X[0]!="INDEX"){$X[2]=preg_replace('~ DESC$~','',$X[2]);$h=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");array_unshift($_g,"ALTER TABLE ".table($Q).$h);}elseif($X[2]=="DROP")$nc[]=idf_escape($X[1]);else$_g[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q)." (".implode(", ",$X[2]).")";}if($nc)array_unshift($_g,"DROP INDEX ".implode(", ",$nc));foreach($_g
as$G){if(!queries($G))return
false;}return
true;}function
foreign_keys($Q){$I=array();$G="SELECT c_list.CONSTRAINT_NAME as NAME,
c_src.COLUMN_NAME as SRC_COLUMN,
c_dest.OWNER as DEST_DB,
c_dest.TABLE_NAME as DEST_TABLE,
c_dest.COLUMN_NAME as DEST_COLUMN,
c_list.DELETE_RULE as ON_DELETE
FROM ALL_CONSTRAINTS c_list, ALL_CONS_COLUMNS c_src, ALL_CONS_COLUMNS c_dest
WHERE c_list.CONSTRAINT_NAME = c_src.CONSTRAINT_NAME
AND c_list.R_CONSTRAINT_NAME = c_dest.CONSTRAINT_NAME
AND c_list.CONSTRAINT_TYPE = 'R'
AND c_src.TABLE_NAME = ".q($Q);foreach(get_rows($G)as$J)$I[$J['NAME']]=array("db"=>$J['DEST_DB'],"table"=>$J['DEST_TABLE'],"source"=>array($J['SRC_COLUMN']),"target"=>array($J['DEST_COLUMN']),"on_delete"=>$J['ON_DELETE'],"on_update"=>null,);return$I;}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($dj){return
apply_queries("DROP VIEW",$dj);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
last_id(){return
0;}function
schemas(){$I=get_vals("SELECT DISTINCT owner FROM dba_segments WHERE owner IN (SELECT username FROM dba_users WHERE default_tablespace NOT IN ('SYSTEM','SYSAUX')) ORDER BY 1");return($I?$I:get_vals("SELECT DISTINCT owner FROM all_tables WHERE tablespace_name = ".q(DB)." ORDER BY 1"));}function
get_schema(){global$f;return$f->result("SELECT sys_context('USERENV', 'SESSION_USER') FROM dual");}function
set_schema($fh,$g=null){global$f;if(!$g)$g=$f;return$g->query("ALTER SESSION SET CURRENT_SCHEMA = ".idf_escape($fh));}function
show_variables(){return
get_key_vals('SELECT name, display_value FROM v$parameter');}function
process_list(){return
get_rows('SELECT sess.process AS "process", sess.username AS "user", sess.schemaname AS "schema", sess.status AS "status", sess.wait_class AS "wait_class", sess.seconds_in_wait AS "seconds_in_wait", sql.sql_text AS "sql_text", sess.machine AS "machine", sess.port AS "port"
FROM v$session sess LEFT OUTER JOIN v$sql sql
ON sql.sql_id = sess.sql_id
WHERE sess.type = \'USER\'
ORDER BY PROCESS
');}function
show_status(){$K=get_rows('SELECT * FROM v$instance');return
reset($K);}function
convert_field($m){}function
unconvert_field($m,$I){return$I;}function
support($Xc){return
preg_match('~^(columns|database|drop_col|indexes|descidx|processlist|scheme|sql|status|table|variables|view)$~',$Xc);}function
driver_config(){$U=array();$Lh=array();foreach(array('Nombres'=>array("number"=>38,"binary_float"=>12,"binary_double"=>21),'Date et heure'=>array("date"=>10,"timestamp"=>29,"interval year"=>12,"interval day"=>28),'Chaînes'=>array("char"=>2000,"varchar2"=>4000,"nchar"=>2000,"nvarchar2"=>4000,"clob"=>4294967295,"nclob"=>4294967295),'Binaires'=>array("raw"=>2000,"long raw"=>2147483648,"blob"=>4294967295,"bfile"=>4294967296),)as$x=>$X){$U+=$X;$Lh[$x]=array_keys($X);}return
array('possible_drivers'=>array("OCI8","PDO_OCI"),'jush'=>"oracle",'types'=>$U,'structured_types'=>$Lh,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL"),'functions'=>array("distinct","length","lower","round","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("date"=>"current_date","timestamp"=>"current_timestamp",),array("number|float|double"=>"+/-","date|timestamp"=>"+ interval/- interval","char|clob"=>"||",)),);}}$mc["mssql"]="MS SQL (beta)";if(isset($_GET["mssql"])){define("DRIVER","mssql");if(extension_loaded("sqlsrv")){class
Min_DB{var$extension="sqlsrv",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_get_error(){$this->error="";foreach(sqlsrv_errors()as$l){$this->errno=$l["code"];$this->error.="$l[message]\n";}$this->error=rtrim($this->error);}function
connect($M,$V,$F){global$b;$j=$b->database();$_b=array("UID"=>$V,"PWD"=>$F,"CharacterSet"=>"UTF-8");if($j!="")$_b["Database"]=$j;$this->_link=@sqlsrv_connect(preg_replace('~:~',',',$M),$_b);if($this->_link){$Xd=sqlsrv_server_info($this->_link);$this->server_info=$Xd['SQLServerVersion'];}else$this->_get_error();return(bool)$this->_link;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($Sb){return$this->query("USE ".idf_escape($Sb));}function
query($G,$Gi=false){$H=sqlsrv_query($this->_link,$G);$this->error="";if(!$H){$this->_get_error();return
false;}return$this->store_result($H);}function
multi_query($G){$this->_result=sqlsrv_query($this->_link,$G);$this->error="";if(!$this->_result){$this->_get_error();return
false;}return
true;}function
store_result($H=null){if(!$H)$H=$this->_result;if(!$H)return
false;if(sqlsrv_field_metadata($H))return
new
Min_Result($H);$this->affected_rows=sqlsrv_rows_affected($H);return
true;}function
next_result(){return$this->_result?sqlsrv_next_result($this->_result):null;}function
result($G,$m=0){$H=$this->query($G);if(!is_object($H))return
false;$J=$H->fetch_row();return$J[$m];}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($H){$this->_result=$H;}function
_convert($J){foreach((array)$J
as$x=>$X){if(is_a($X,'DateTime'))$J[$x]=$X->format("Y-m-d H:i:s");}return$J;}function
fetch_assoc(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_ASSOC));}function
fetch_row(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_NUMERIC));}function
fetch_field(){if(!$this->_fields)$this->_fields=sqlsrv_field_metadata($this->_result);$m=$this->_fields[$this->_offset++];$I=new
stdClass;$I->name=$m["Name"];$I->orgname=$m["Name"];$I->type=($m["Type"]==1?254:0);return$I;}function
seek($nf){for($r=0;$r<$nf;$r++)sqlsrv_fetch($this->_result);}function
__destruct(){sqlsrv_free_stmt($this->_result);}}}elseif(extension_loaded("mssql")){class
Min_DB{var$extension="MSSQL",$_link,$_result,$server_info,$affected_rows,$error;function
connect($M,$V,$F){$this->_link=@mssql_connect($M,$V,$F);if($this->_link){$H=$this->query("SELECT SERVERPROPERTY('ProductLevel'), SERVERPROPERTY('Edition')");if($H){$J=$H->fetch_row();$this->server_info=$this->result("sp_server_info 2",2)." [$J[0]] $J[1]";}}else$this->error=mssql_get_last_message();return(bool)$this->_link;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($Sb){return
mssql_select_db($Sb);}function
query($G,$Gi=false){$H=@mssql_query($G,$this->_link);$this->error="";if(!$H){$this->error=mssql_get_last_message();return
false;}if($H===true){$this->affected_rows=mssql_rows_affected($this->_link);return
true;}return
new
Min_Result($H);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
mssql_next_result($this->_result->_result);}function
result($G,$m=0){$H=$this->query($G);if(!is_object($H))return
false;return
mssql_result($H->_result,0,$m);}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($H){$this->_result=$H;$this->num_rows=mssql_num_rows($H);}function
fetch_assoc(){return
mssql_fetch_assoc($this->_result);}function
fetch_row(){return
mssql_fetch_row($this->_result);}function
num_rows(){return
mssql_num_rows($this->_result);}function
fetch_field(){$I=mssql_fetch_field($this->_result);$I->orgtable=$I->table;$I->orgname=$I->name;return$I;}function
seek($nf){mssql_data_seek($this->_result,$nf);}function
__destruct(){mssql_free_result($this->_result);}}}elseif(extension_loaded("pdo_dblib")){class
Min_DB
extends
Min_PDO{var$extension="PDO_DBLIB";function
connect($M,$V,$F){$this->dsn("dblib:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$M)),$V,$F);return
true;}function
select_db($Sb){return$this->query("USE ".idf_escape($Sb));}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$K,$qg){foreach($K
as$N){$Ni=array();$Z=array();foreach($N
as$x=>$X){$Ni[]="$x = $X";if(isset($qg[idf_unescape($x)]))$Z[]="$x = $X";}if(!queries("MERGE ".table($Q)." USING (VALUES(".implode(", ",$N).")) AS source (c".implode(", c",range(1,count($N))).") ON ".implode(" AND ",$Z)." WHEN MATCHED THEN UPDATE SET ".implode(", ",$Ni)." WHEN NOT MATCHED THEN INSERT (".implode(", ",array_keys($N)).") VALUES (".implode(", ",$N).");"))return
false;}return
true;}function
begin(){return
queries("BEGIN TRANSACTION");}}function
idf_escape($t){return"[".str_replace("]","]]",$t)."]";}function
table($t){return($_GET["ns"]!=""?idf_escape($_GET["ns"]).".":"").idf_escape($t);}function
connect(){global$b;$f=new
Min_DB;$Lb=$b->credentials();if($f->connect($Lb[0],$Lb[1],$Lb[2]))return$f;return$f->error;}function
get_databases(){return
get_vals("SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb')");}function
limit($G,$Z,$y,$nf=0,$mh=" "){return($y!==null?" TOP (".($y+$nf).")":"")." $G$Z";}function
limit1($Q,$G,$Z,$mh="\n"){return
limit($G,$Z,1,0,$mh);}function
db_collation($j,$nb){global$f;return$f->result("SELECT collation_name FROM sys.databases WHERE name = ".q($j));}function
engines(){return
array();}function
logged_user(){global$f;return$f->result("SELECT SUSER_NAME()");}function
tables_list(){return
get_key_vals("SELECT name, type_desc FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ORDER BY name");}function
count_tables($i){global$f;$I=array();foreach($i
as$j){$f->select_db($j);$I[$j]=$f->result("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES");}return$I;}function
table_status($C=""){$I=array();foreach(get_rows("SELECT ao.name AS Name, ao.type_desc AS Engine, (SELECT value FROM fn_listextendedproperty(default, 'SCHEMA', schema_name(schema_id), 'TABLE', ao.name, null, null)) AS Comment FROM sys.all_objects AS ao WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ".($C!=""?"AND name = ".q($C):"ORDER BY name"))as$J){if($C!="")return$J;$I[$J["Name"]]=$J;}return$I;}function
is_view($R){return$R["Engine"]=="VIEW";}function
fk_support($R){return
true;}function
fields($Q){$vb=get_key_vals("SELECT objname, cast(value as varchar(max)) FROM fn_listextendedproperty('MS_DESCRIPTION', 'schema', ".q(get_schema()).", 'table', ".q($Q).", 'column', NULL)");$I=array();foreach(get_rows("SELECT c.max_length, c.precision, c.scale, c.name, c.is_nullable, c.is_identity, c.collation_name, t.name type, CAST(d.definition as text) [default]
FROM sys.all_columns c
JOIN sys.all_objects o ON c.object_id = o.object_id
JOIN sys.types t ON c.user_type_id = t.user_type_id
LEFT JOIN sys.default_constraints d ON c.default_object_id = d.parent_column_id
WHERE o.schema_id = SCHEMA_ID(".q(get_schema()).") AND o.type IN ('S', 'U', 'V') AND o.name = ".q($Q))as$J){$T=$J["type"];$ze=(preg_match("~char|binary~",$T)?$J["max_length"]:($T=="decimal"?"$J[precision],$J[scale]":""));$I[$J["name"]]=array("field"=>$J["name"],"full_type"=>$T.($ze?"($ze)":""),"type"=>$T,"length"=>$ze,"default"=>$J["default"],"null"=>$J["is_nullable"],"auto_increment"=>$J["is_identity"],"collation"=>$J["collation_name"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"primary"=>$J["is_identity"],"comment"=>$vb[$J["name"]],);}return$I;}function
indexes($Q,$g=null){$I=array();foreach(get_rows("SELECT i.name, key_ordinal, is_unique, is_primary_key, c.name AS column_name, is_descending_key
FROM sys.indexes i
INNER JOIN sys.index_columns ic ON i.object_id = ic.object_id AND i.index_id = ic.index_id
INNER JOIN sys.columns c ON ic.object_id = c.object_id AND ic.column_id = c.column_id
WHERE OBJECT_NAME(i.object_id) = ".q($Q),$g)as$J){$C=$J["name"];$I[$C]["type"]=($J["is_primary_key"]?"PRIMARY":($J["is_unique"]?"UNIQUE":"INDEX"));$I[$C]["lengths"]=array();$I[$C]["columns"][$J["key_ordinal"]]=$J["column_name"];$I[$C]["descs"][$J["key_ordinal"]]=($J["is_descending_key"]?'1':null);}return$I;}function
view($C){global$f;return
array("select"=>preg_replace('~^(?:[^[]|\[[^]]*])*\s+AS\s+~isU','',$f->result("SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = SCHEMA_NAME() AND TABLE_NAME = ".q($C))));}function
collations(){$I=array();foreach(get_vals("SELECT name FROM fn_helpcollations()")as$mb)$I[preg_replace('~_.*~','',$mb)][]=$mb;return$I;}function
information_schema($j){return
false;}function
error(){global$f;return
nl_br(h(preg_replace('~^(\[[^]]*])+~m','',$f->error)));}function
create_database($j,$mb){return
queries("CREATE DATABASE ".idf_escape($j).(preg_match('~^[a-z0-9_]+$~i',$mb)?" COLLATE $mb":""));}function
drop_databases($i){return
queries("DROP DATABASE ".implode(", ",array_map('idf_escape',$i)));}function
rename_database($C,$mb){if(preg_match('~^[a-z0-9_]+$~i',$mb))queries("ALTER DATABASE ".idf_escape(DB)." COLLATE $mb");queries("ALTER DATABASE ".idf_escape(DB)." MODIFY NAME = ".idf_escape($C));return
true;}function
auto_increment(){return" IDENTITY".($_POST["Auto_increment"]!=""?"(".number($_POST["Auto_increment"]).",1)":"")." PRIMARY KEY";}function
alter_table($Q,$C,$n,$kd,$tb,$Bc,$mb,$La,$Zf){$c=array();$vb=array();foreach($n
as$m){$d=idf_escape($m[0]);$X=$m[1];if(!$X)$c["DROP"][]=" COLUMN $d";else{$X[1]=preg_replace("~( COLLATE )'(\\w+)'~",'\1\2',$X[1]);$vb[$m[0]]=$X[5];unset($X[5]);if($m[0]=="")$c["ADD"][]="\n  ".implode("",$X).($Q==""?substr($kd[$X[0]],16+strlen($X[0])):"");else{unset($X[6]);if($d!=$X[0])queries("EXEC sp_rename ".q(table($Q).".$d").", ".q(idf_unescape($X[0])).", 'COLUMN'");$c["ALTER COLUMN ".implode("",$X)][]="";}}}if($Q=="")return
queries("CREATE TABLE ".table($C)." (".implode(",",(array)$c["ADD"])."\n)");if($Q!=$C)queries("EXEC sp_rename ".q(table($Q)).", ".q($C));if($kd)$c[""]=$kd;foreach($c
as$x=>$X){if(!queries("ALTER TABLE ".idf_escape($C)." $x".implode(",",$X)))return
false;}foreach($vb
as$x=>$X){$tb=substr($X,9);queries("EXEC sp_dropextendedproperty @name = N'MS_Description', @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table', @level1name = ".q($C).", @level2type = N'Column', @level2name = ".q($x));queries("EXEC sp_addextendedproperty @name = N'MS_Description', @value = ".$tb.", @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table', @level1name = ".q($C).", @level2type = N'Column', @level2name = ".q($x));}return
true;}function
alter_indexes($Q,$c){$u=array();$nc=array();foreach($c
as$X){if($X[2]=="DROP"){if($X[0]=="PRIMARY")$nc[]=idf_escape($X[1]);else$u[]=idf_escape($X[1])." ON ".table($Q);}elseif(!queries(($X[0]!="PRIMARY"?"CREATE $X[0] ".($X[0]!="INDEX"?"INDEX ":"").idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q):"ALTER TABLE ".table($Q)." ADD PRIMARY KEY")." (".implode(", ",$X[2]).")"))return
false;}return(!$u||queries("DROP INDEX ".implode(", ",$u)))&&(!$nc||queries("ALTER TABLE ".table($Q)." DROP ".implode(", ",$nc)));}function
last_id(){global$f;return$f->result("SELECT SCOPE_IDENTITY()");}function
explain($f,$G){$f->query("SET SHOWPLAN_ALL ON");$I=$f->query($G);$f->query("SET SHOWPLAN_ALL OFF");return$I;}function
found_rows($R,$Z){}function
foreign_keys($Q){$I=array();foreach(get_rows("EXEC sp_fkeys @fktable_name = ".q($Q))as$J){$p=&$I[$J["FK_NAME"]];$p["db"]=$J["PKTABLE_QUALIFIER"];$p["table"]=$J["PKTABLE_NAME"];$p["source"][]=$J["FKCOLUMN_NAME"];$p["target"][]=$J["PKCOLUMN_NAME"];}return$I;}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($dj){return
queries("DROP VIEW ".implode(", ",array_map('table',$dj)));}function
drop_tables($S){return
queries("DROP TABLE ".implode(", ",array_map('table',$S)));}function
move_tables($S,$dj,$bi){return
apply_queries("ALTER SCHEMA ".idf_escape($bi)." TRANSFER",array_merge($S,$dj));}function
trigger($C){if($C=="")return
array();$K=get_rows("SELECT s.name [Trigger],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(s.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(s.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing],
c.text
FROM sysobjects s
JOIN syscomments c ON s.id = c.id
WHERE s.xtype = 'TR' AND s.name = ".q($C));$I=reset($K);if($I)$I["Statement"]=preg_replace('~^.+\s+AS\s+~isU','',$I["text"]);return$I;}function
triggers($Q){$I=array();foreach(get_rows("SELECT sys1.name,
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing]
FROM sysobjects sys1
JOIN sysobjects sys2 ON sys1.parent_obj = sys2.id
WHERE sys1.xtype = 'TR' AND sys2.name = ".q($Q))as$J)$I[$J["name"]]=array($J["Timing"],$J["Event"]);return$I;}function
trigger_options(){return
array("Timing"=>array("AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("AS"),);}function
schemas(){return
get_vals("SELECT name FROM sys.schemas");}function
get_schema(){global$f;if($_GET["ns"]!="")return$_GET["ns"];return$f->result("SELECT SCHEMA_NAME()");}function
set_schema($eh){return
true;}function
use_sql($Sb){return"USE ".idf_escape($Sb);}function
show_variables(){return
array();}function
show_status(){return
array();}function
convert_field($m){}function
unconvert_field($m,$I){return$I;}function
support($Xc){return
preg_match('~^(comment|columns|database|drop_col|indexes|descidx|scheme|sql|table|trigger|view|view_trigger)$~',$Xc);}function
driver_config(){$U=array();$Lh=array();foreach(array('Nombres'=>array("tinyint"=>3,"smallint"=>5,"int"=>10,"bigint"=>20,"bit"=>1,"decimal"=>0,"real"=>12,"float"=>53,"smallmoney"=>10,"money"=>20),'Date et heure'=>array("date"=>10,"smalldatetime"=>19,"datetime"=>19,"datetime2"=>19,"time"=>8,"datetimeoffset"=>10),'Chaînes'=>array("char"=>8000,"varchar"=>8000,"text"=>2147483647,"nchar"=>4000,"nvarchar"=>4000,"ntext"=>1073741823),'Binaires'=>array("binary"=>8000,"varbinary"=>8000,"image"=>2147483647),)as$x=>$X){$U+=$X;$Lh[$x]=array_keys($X);}return
array('possible_drivers'=>array("SQLSRV","MSSQL","PDO_DBLIB"),'jush'=>"mssql",'types'=>$U,'structured_types'=>$Lh,'unsigned'=>array(),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL"),'functions'=>array("distinct","len","lower","round","upper"),'grouping'=>array("avg","count","count distinct","max","min","sum"),'edit_functions'=>array(array("date|time"=>"getdate",),array("int|decimal|real|float|money|datetime"=>"+/-","char|text"=>"+",)),);}}$mc["mongo"]="MongoDB (alpha)";if(isset($_GET["mongo"])){define("DRIVER","mongo");if(class_exists('MongoDB')){class
Min_DB{var$extension="Mongo",$server_info=MongoClient::VERSION,$error,$last_id,$_link,$_db;function
connect($Oi,$D){try{$this->_link=new
MongoClient($Oi,$D);if($D["password"]!=""){$D["password"]="";try{new
MongoClient($Oi,$D);$this->error='La base de données ne support pas les mots de passe';}catch(Exception$tc){}}}catch(Exception$tc){$this->error=$tc->getMessage();}}function
query($G){return
false;}function
select_db($Sb){try{$this->_db=$this->_link->selectDB($Sb);return
true;}catch(Exception$Jc){$this->error=$Jc->getMessage();return
false;}}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($H){foreach($H
as$je){$J=array();foreach($je
as$x=>$X){if(is_a($X,'MongoBinData'))$this->_charset[$x]=63;$J[$x]=(is_a($X,'MongoId')?"ObjectId(\"$X\")":(is_a($X,'MongoDate')?gmdate("Y-m-d H:i:s",$X->sec)." GMT":(is_a($X,'MongoBinData')?$X->bin:(is_a($X,'MongoRegex')?"$X":(is_object($X)?get_class($X):$X)))));}$this->_rows[]=$J;foreach($J
as$x=>$X){if(!isset($this->_rows[0][$x]))$this->_rows[0][$x]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$J=current($this->_rows);if(!$J)return$J;$I=array();foreach($this->_rows[0]as$x=>$X)$I[$x]=$J[$x];next($this->_rows);return$I;}function
fetch_row(){$I=$this->fetch_assoc();if(!$I)return$I;return
array_values($I);}function
fetch_field(){$ne=array_keys($this->_rows[0]);$C=$ne[$this->_offset++];return(object)array('name'=>$C,'charsetnr'=>$this->_charset[$C],);}}class
Min_Driver
extends
Min_SQL{public$qg="_id";function
select($Q,$L,$Z,$wd,$Ef=array(),$y=1,$E=0,$sg=false){$L=($L==array("*")?array():array_fill_keys($L,true));$zh=array();foreach($Ef
as$X){$X=preg_replace('~ DESC$~','',$X,1,$Hb);$zh[$X]=($Hb?-1:1);}return
new
Min_Result($this->_conn->_db->selectCollection($Q)->find(array(),$L)->sort($zh)->limit($y!=""?+$y:0)->skip($E*$y));}function
insert($Q,$N){try{$I=$this->_conn->_db->selectCollection($Q)->insert($N);$this->_conn->errno=$I['code'];$this->_conn->error=$I['err'];$this->_conn->last_id=$N['_id'];return!$I['err'];}catch(Exception$Jc){$this->_conn->error=$Jc->getMessage();return
false;}}}function
get_databases($hd){global$f;$I=array();$Wb=$f->_link->listDBs();foreach($Wb['databases']as$j)$I[]=$j['name'];return$I;}function
count_tables($i){global$f;$I=array();foreach($i
as$j)$I[$j]=count($f->_link->selectDB($j)->getCollectionNames(true));return$I;}function
tables_list(){global$f;return
array_fill_keys($f->_db->getCollectionNames(true),'table');}function
drop_databases($i){global$f;foreach($i
as$j){$Qg=$f->_link->selectDB($j)->drop();if(!$Qg['ok'])return
false;}return
true;}function
indexes($Q,$g=null){global$f;$I=array();foreach($f->_db->selectCollection($Q)->getIndexInfo()as$u){$gc=array();foreach($u["key"]as$d=>$T)$gc[]=($T==-1?'1':null);$I[$u["name"]]=array("type"=>($u["name"]=="_id_"?"PRIMARY":($u["unique"]?"UNIQUE":"INDEX")),"columns"=>array_keys($u["key"]),"lengths"=>array(),"descs"=>$gc,);}return$I;}function
fields($Q){return
fields_from_edit();}function
found_rows($R,$Z){global$f;return$f->_db->selectCollection($_GET["select"])->count($Z);}$Af=array("=");$_f=null;}elseif(class_exists('MongoDB\Driver\Manager')){class
Min_DB{var$extension="MongoDB",$server_info=MONGODB_VERSION,$affected_rows,$error,$last_id;var$_link;var$_db,$_db_name;function
connect($Oi,$D){$hb='MongoDB\Driver\Manager';$this->_link=new$hb($Oi,$D);$this->executeCommand('admin',array('ping'=>1));}function
executeCommand($j,$rb){$hb='MongoDB\Driver\Command';try{return$this->_link->executeCommand($j,new$hb($rb));}catch(Exception$tc){$this->error=$tc->getMessage();return
array();}}function
executeBulkWrite($cf,$Xa,$Ib){try{$Tg=$this->_link->executeBulkWrite($cf,$Xa);$this->affected_rows=$Tg->$Ib();return
true;}catch(Exception$tc){$this->error=$tc->getMessage();return
false;}}function
query($G){return
false;}function
select_db($Sb){$this->_db_name=$Sb;return
true;}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($H){foreach($H
as$je){$J=array();foreach($je
as$x=>$X){if(is_a($X,'MongoDB\BSON\Binary'))$this->_charset[$x]=63;$J[$x]=(is_a($X,'MongoDB\BSON\ObjectID')?'MongoDB\BSON\ObjectID("'."$X\")":(is_a($X,'MongoDB\BSON\UTCDatetime')?$X->toDateTime()->format('Y-m-d H:i:s'):(is_a($X,'MongoDB\BSON\Binary')?$X->getData():(is_a($X,'MongoDB\BSON\Regex')?"$X":(is_object($X)||is_array($X)?json_encode($X,256):$X)))));}$this->_rows[]=$J;foreach($J
as$x=>$X){if(!isset($this->_rows[0][$x]))$this->_rows[0][$x]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$J=current($this->_rows);if(!$J)return$J;$I=array();foreach($this->_rows[0]as$x=>$X)$I[$x]=$J[$x];next($this->_rows);return$I;}function
fetch_row(){$I=$this->fetch_assoc();if(!$I)return$I;return
array_values($I);}function
fetch_field(){$ne=array_keys($this->_rows[0]);$C=$ne[$this->_offset++];return(object)array('name'=>$C,'charsetnr'=>$this->_charset[$C],);}}class
Min_Driver
extends
Min_SQL{public$qg="_id";function
select($Q,$L,$Z,$wd,$Ef=array(),$y=1,$E=0,$sg=false){global$f;$L=($L==array("*")?array():array_fill_keys($L,1));if(count($L)&&!isset($L['_id']))$L['_id']=0;$Z=where_to_query($Z);$zh=array();foreach($Ef
as$X){$X=preg_replace('~ DESC$~','',$X,1,$Hb);$zh[$X]=($Hb?-1:1);}if(isset($_GET['limit'])&&is_numeric($_GET['limit'])&&$_GET['limit']>0)$y=$_GET['limit'];$y=min(200,max(1,(int)$y));$wh=$E*$y;$hb='MongoDB\Driver\Query';try{return
new
Min_Result($f->_link->executeQuery("$f->_db_name.$Q",new$hb($Z,array('projection'=>$L,'limit'=>$y,'skip'=>$wh,'sort'=>$zh))));}catch(Exception$tc){$f->error=$tc->getMessage();return
false;}}function
update($Q,$N,$Ag,$y=0,$mh="\n"){global$f;$j=$f->_db_name;$Z=sql_query_where_parser($Ag);$hb='MongoDB\Driver\BulkWrite';$Xa=new$hb(array());if(isset($N['_id']))unset($N['_id']);$Ng=array();foreach($N
as$x=>$Y){if($Y=='NULL'){$Ng[$x]=1;unset($N[$x]);}}$Ni=array('$set'=>$N);if(count($Ng))$Ni['$unset']=$Ng;$Xa->update($Z,$Ni,array('upsert'=>false));return$f->executeBulkWrite("$j.$Q",$Xa,'getModifiedCount');}function
delete($Q,$Ag,$y=0){global$f;$j=$f->_db_name;$Z=sql_query_where_parser($Ag);$hb='MongoDB\Driver\BulkWrite';$Xa=new$hb(array());$Xa->delete($Z,array('limit'=>$y));return$f->executeBulkWrite("$j.$Q",$Xa,'getDeletedCount');}function
insert($Q,$N){global$f;$j=$f->_db_name;$hb='MongoDB\Driver\BulkWrite';$Xa=new$hb(array());if($N['_id']=='')unset($N['_id']);$Xa->insert($N);return$f->executeBulkWrite("$j.$Q",$Xa,'getInsertedCount');}}function
get_databases($hd){global$f;$I=array();foreach($f->executeCommand('admin',array('listDatabases'=>1))as$Wb){foreach($Wb->databases
as$j)$I[]=$j->name;}return$I;}function
count_tables($i){$I=array();return$I;}function
tables_list(){global$f;$ob=array();foreach($f->executeCommand($f->_db_name,array('listCollections'=>1))as$H)$ob[$H->name]='table';return$ob;}function
drop_databases($i){return
false;}function
indexes($Q,$g=null){global$f;$I=array();foreach($f->executeCommand($f->_db_name,array('listIndexes'=>$Q))as$u){$gc=array();$e=array();foreach(get_object_vars($u->key)as$d=>$T){$gc[]=($T==-1?'1':null);$e[]=$d;}$I[$u->name]=array("type"=>($u->name=="_id_"?"PRIMARY":(isset($u->unique)?"UNIQUE":"INDEX")),"columns"=>$e,"lengths"=>array(),"descs"=>$gc,);}return$I;}function
fields($Q){global$k;$n=fields_from_edit();if(!$n){$H=$k->select($Q,array("*"),null,null,array(),10);if($H){while($J=$H->fetch_assoc()){foreach($J
as$x=>$X){$J[$x]=null;$n[$x]=array("field"=>$x,"type"=>"string","null"=>($x!=$k->primary),"auto_increment"=>($x==$k->primary),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1,),);}}}}return$n;}function
found_rows($R,$Z){global$f;$Z=where_to_query($Z);$ri=$f->executeCommand($f->_db_name,array('count'=>$R['Name'],'query'=>$Z))->toArray();return$ri[0]->n;}function
sql_query_where_parser($Ag){$Ag=preg_replace('~^\sWHERE \(?\(?(.+?)\)?\)?$~','\1',$Ag);$nj=explode(' AND ',$Ag);$oj=explode(') OR (',$Ag);$Z=array();foreach($nj
as$lj)$Z[]=trim($lj);if(count($oj)==1)$oj=array();elseif(count($oj)>1)$Z=array();return
where_to_query($Z,$oj);}function
where_to_query($jj=array(),$kj=array()){global$b;$Qb=array();foreach(array('and'=>$jj,'or'=>$kj)as$T=>$Z){if(is_array($Z)){foreach($Z
as$Pc){list($kb,$yf,$X)=explode(" ",$Pc,3);if($kb=="_id"&&preg_match('~^(MongoDB\\\\BSON\\\\ObjectID)\("(.+)"\)$~',$X,$B)){list(,$hb,$X)=$B;$X=new$hb($X);}if(!in_array($yf,$b->operators))continue;if(preg_match('~^\(f\)(.+)~',$yf,$B)){$X=(float)$X;$yf=$B[1];}elseif(preg_match('~^\(date\)(.+)~',$yf,$B)){$Tb=new
DateTime($X);$hb='MongoDB\BSON\UTCDatetime';$X=new$hb($Tb->getTimestamp()*1000);$yf=$B[1];}switch($yf){case'=':$yf='$eq';break;case'!=':$yf='$ne';break;case'>':$yf='$gt';break;case'<':$yf='$lt';break;case'>=':$yf='$gte';break;case'<=':$yf='$lte';break;case'regex':$yf='$regex';break;default:continue
2;}if($T=='and')$Qb['$and'][]=array($kb=>array($yf=>$X));elseif($T=='or')$Qb['$or'][]=array($kb=>array($yf=>$X));}}}return$Qb;}$Af=array("=","!=",">","<",">=","<=","regex","(f)=","(f)!=","(f)>","(f)<","(f)>=","(f)<=","(date)=","(date)!=","(date)>","(date)<","(date)>=","(date)<=",);$_f='regex';}function
table($t){return$t;}function
idf_escape($t){return$t;}function
table_status($C="",$Wc=false){$I=array();foreach(tables_list()as$Q=>$T){$I[$Q]=array("Name"=>$Q);if($C==$Q)return$I[$Q];}return$I;}function
create_database($j,$mb){return
true;}function
last_id(){global$f;return$f->last_id;}function
error(){global$f;return
h($f->error);}function
collations(){return
array();}function
logged_user(){global$b;$Lb=$b->credentials();return$Lb[1];}function
connect(){global$b;$f=new
Min_DB;list($M,$V,$F)=$b->credentials();$D=array();if($V.$F!=""){$D["username"]=$V;$D["password"]=$F;}$j=$b->database();if($j!="")$D["db"]=$j;if(($Ka=getenv("MONGO_AUTH_SOURCE")))$D["authSource"]=$Ka;$f->connect("mongodb://$M",$D);if($f->error)return$f->error;return$f;}function
alter_indexes($Q,$c){global$f;foreach($c
as$X){list($T,$C,$N)=$X;if($N=="DROP")$I=$f->_db->command(array("deleteIndexes"=>$Q,"index"=>$C));else{$e=array();foreach($N
as$d){$d=preg_replace('~ DESC$~','',$d,1,$Hb);$e[$d]=($Hb?-1:1);}$I=$f->_db->selectCollection($Q)->ensureIndex($e,array("unique"=>($T=="UNIQUE"),"name"=>$C,));}if($I['errmsg']){$f->error=$I['errmsg'];return
false;}}return
true;}function
support($Xc){return
preg_match("~database|indexes|descidx~",$Xc);}function
db_collation($j,$nb){}function
information_schema(){}function
is_view($R){}function
convert_field($m){}function
unconvert_field($m,$I){return$I;}function
foreign_keys($Q){return
array();}function
fk_support($R){}function
engines(){return
array();}function
alter_table($Q,$C,$n,$kd,$tb,$Bc,$mb,$La,$Zf){global$f;if($Q==""){$f->_db->createCollection($C);return
true;}}function
drop_tables($S){global$f;foreach($S
as$Q){$Qg=$f->_db->selectCollection($Q)->drop();if(!$Qg['ok'])return
false;}return
true;}function
truncate_tables($S){global$f;foreach($S
as$Q){$Qg=$f->_db->selectCollection($Q)->remove();if(!$Qg['ok'])return
false;}return
true;}function
driver_config(){global$Af,$_f;return
array('possible_drivers'=>array("mongo","mongodb"),'jush'=>"mongo",'operators'=>$Af,'operator_regexp'=>$_f,'functions'=>array(),'grouping'=>array(),'edit_functions'=>array(array("json")),);}}$mc["elastic"]="Elasticsearch (beta)";if(isset($_GET["elastic"])){define("DRIVER","elastic");if(function_exists('json_decode')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="JSON",$server_info,$errno,$error,$_url,$_db;function
rootQuery($dg,array$Cb=null,$Ve='GET'){@ini_set('track_errors',1);$bd=@file_get_contents("$this->_url/".ltrim($dg,'/'),false,stream_context_create(array('http'=>array('method'=>$Ve,'content'=>$Cb!==null?json_encode($Cb):null,'header'=>$Cb!==null?'Content-Type: application/json':[],'ignore_errors'=>1,'follow_location'=>0,'max_redirects'=>0,))));if($bd===false){$this->error='Invalid server or credentials.';return
false;}$I=json_decode($bd,true);if($I===null){$this->error='Invalid server or credentials.';return
false;}if(!preg_match('~^HTTP/[0-9.]+ 2~i',$http_response_header[0])){if(isset($I['error']['root_cause'][0]['type']))$this->error=$I['error']['root_cause'][0]['type'].": ".$I['error']['root_cause'][0]['reason'];else$this->error='Invalid server or credentials.';return
false;}return$I;}function
query($dg,array$Cb=null,$Ve='GET'){return$this->rootQuery(($this->_db!=""?"$this->_db/":"/").ltrim($dg,'/'),$Cb,$Ve);}function
connect($M,$V,$F){$this->_url=build_http_url($M,$V,$F,"localhost",9200);$I=$this->query('');if(!$I)return
false;if(!isset($I['version']['number'])){$this->error='Invalid server or credentials.';return
false;}$this->server_info=$I['version']['number'];return
true;}function
select_db($Sb){$this->_db=$Sb;return
true;}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows;function
__construct($K){$this->num_rows=count($K);$this->_rows=$K;reset($this->_rows);}function
fetch_assoc(){$I=current($this->_rows);next($this->_rows);return$I;}function
fetch_row(){return
array_values($this->fetch_assoc());}}}class
Min_Driver
extends
Min_SQL{function
select($Q,$L,$Z,$wd,$Ef=array(),$y=1,$E=0,$sg=false){global$b;$Qb=array();$G="$Q/_search";if($L!=array("*"))$Qb["fields"]=$L;if($Ef){$zh=array();foreach($Ef
as$kb){$kb=preg_replace('~ DESC$~','',$kb,1,$Hb);$zh[]=($Hb?array($kb=>"desc"):$kb);}$Qb["sort"]=$zh;}if($y){$Qb["size"]=+$y;if($E)$Qb["from"]=($E*$y);}foreach($Z
as$X){list($kb,$yf,$X)=explode(" ",$X,3);if($kb=="_id")$Qb["query"]["ids"]["values"][]=$X;elseif($kb.$X!=""){$ei=array("term"=>array(($kb!=""?$kb:"_all")=>$X));if($yf=="=")$Qb["query"]["filtered"]["filter"]["and"][]=$ei;else$Qb["query"]["filtered"]["query"]["bool"]["must"][]=$ei;}}if($Qb["query"]&&!$Qb["query"]["filtered"]["query"]&&!$Qb["query"]["ids"])$Qb["query"]["filtered"]["query"]=array("match_all"=>array());$Hh=microtime(true);$gh=$this->_conn->query($G,$Qb);if($sg)echo$b->selectQuery("$G: ".json_encode($Qb),$Hh,!$gh);if(!$gh)return
false;$I=array();foreach($gh['hits']['hits']as$Id){$J=array();if($L==array("*"))$J["_id"]=$Id["_id"];$n=$Id['_source'];if($L!=array("*")){$n=array();foreach($L
as$x)$n[$x]=$Id['fields'][$x];}foreach($n
as$x=>$X){if($Qb["fields"])$X=$X[0];$J[$x]=(is_array($X)?json_encode($X):$X);}$I[]=$J;}return
new
Min_Result($I);}function
update($T,$Eg,$Ag,$y=0,$mh="\n"){$bg=preg_split('~ *= *~',$Ag);if(count($bg)==2){$s=trim($bg[1]);$G="$T/$s";return$this->_conn->query($G,$Eg,'POST');}return
false;}function
insert($T,$Eg){$s="";$G="$T/$s";$Qg=$this->_conn->query($G,$Eg,'POST');$this->_conn->last_id=$Qg['_id'];return$Qg['created'];}function
delete($T,$Ag,$y=0){$Md=array();if(is_array($_GET["where"])&&$_GET["where"]["_id"])$Md[]=$_GET["where"]["_id"];if(is_array($_POST['check'])){foreach($_POST['check']as$bb){$bg=preg_split('~ *= *~',$bb);if(count($bg)==2)$Md[]=trim($bg[1]);}}$this->_conn->affected_rows=0;foreach($Md
as$s){$G="{$T}/{$s}";$Qg=$this->_conn->query($G,'{}','DELETE');if(is_array($Qg)&&$Qg['found']==true)$this->_conn->affected_rows++;}return$this->_conn->affected_rows;}}function
connect(){global$b;$f=new
Min_DB;list($M,$V,$F)=$b->credentials();if($F!=""&&$f->connect($M,$V,""))return'La base de données ne support pas les mots de passe';if($f->connect($M,$V,$F))return$f;return$f->error;}function
support($Xc){return
preg_match("~database|table|columns~",$Xc);}function
logged_user(){global$b;$Lb=$b->credentials();return$Lb[1];}function
get_databases(){global$f;$I=$f->rootQuery('_aliases');if($I){$I=array_keys($I);sort($I,SORT_STRING);}return$I;}function
collations(){return
array();}function
db_collation($j,$nb){}function
engines(){return
array();}function
count_tables($i){global$f;$I=array();$H=$f->query('_stats');if($H&&$H['indices']){$Ud=$H['indices'];foreach($Ud
as$Td=>$Ih){$Sd=$Ih['total']['indexing'];$I[$Td]=$Sd['index_total'];}}return$I;}function
tables_list(){global$f;if(min_version(6))return
array('_doc'=>'table');$I=$f->query('_mapping');if($I)$I=array_fill_keys(array_keys($I[$f->_db]["mappings"]),'table');return$I;}function
table_status($C="",$Wc=false){global$f;$gh=$f->query("_search",array("size"=>0,"aggregations"=>array("count_by_type"=>array("terms"=>array("field"=>"_type")))),"POST");$I=array();if($gh){$S=$gh["aggregations"]["count_by_type"]["buckets"];foreach($S
as$Q){$I[$Q["key"]]=array("Name"=>$Q["key"],"Engine"=>"table","Rows"=>$Q["doc_count"],);if($C!=""&&$C==$Q["key"])return$I[$C];}}return$I;}function
error(){global$f;return
h($f->error);}function
information_schema(){}function
is_view($R){}function
indexes($Q,$g=null){return
array(array("type"=>"PRIMARY","columns"=>array("_id")),);}function
fields($Q){global$f;$Ee=array();if(min_version(6)){$H=$f->query("_mapping");if($H)$Ee=$H[$f->_db]['mappings']['properties'];}else{$H=$f->query("$Q/_mapping");if($H){$Ee=$H[$Q]['properties'];if(!$Ee)$Ee=$H[$f->_db]['mappings'][$Q]['properties'];}}$I=array();if($Ee){foreach($Ee
as$C=>$m){$I[$C]=array("field"=>$C,"full_type"=>$m["type"],"type"=>$m["type"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);if($m["properties"]){unset($I[$C]["privileges"]["insert"]);unset($I[$C]["privileges"]["update"]);}}}return$I;}function
foreign_keys($Q){return
array();}function
table($t){return$t;}function
idf_escape($t){return$t;}function
convert_field($m){}function
unconvert_field($m,$I){return$I;}function
fk_support($R){}function
found_rows($R,$Z){return
null;}function
create_database($j){global$f;return$f->rootQuery(urlencode($j),null,'PUT');}function
drop_databases($i){global$f;return$f->rootQuery(urlencode(implode(',',$i)),array(),'DELETE');}function
alter_table($Q,$C,$n,$kd,$tb,$Bc,$mb,$La,$Zf){global$f;$yg=array();foreach($n
as$Uc){$Zc=trim($Uc[1][0]);$ad=trim($Uc[1][1]?$Uc[1][1]:"text");$yg[$Zc]=array('type'=>$ad);}if(!empty($yg))$yg=array('properties'=>$yg);return$f->query("_mapping/{$C}",$yg,'PUT');}function
drop_tables($S){global$f;$I=true;foreach($S
as$Q)$I=$I&&$f->query(urlencode($Q),array(),'DELETE');return$I;}function
last_id(){global$f;return$f->last_id;}function
driver_config(){$U=array();$Lh=array();foreach(array('Nombres'=>array("long"=>3,"integer"=>5,"short"=>8,"byte"=>10,"double"=>20,"float"=>66,"half_float"=>12,"scaled_float"=>21),'Date et heure'=>array("date"=>10),'Chaînes'=>array("string"=>65535,"text"=>65535),'Binaires'=>array("binary"=>255),)as$x=>$X){$U+=$X;$Lh[$x]=array_keys($X);}return
array('possible_drivers'=>array("json + allow_url_fopen"),'jush'=>"elastic",'operators'=>array("=","query"),'functions'=>array(),'grouping'=>array(),'edit_functions'=>array(array("json")),'types'=>$U,'structured_types'=>$Lh,);}}class
Adminer{var$operators;function
name(){return"<a href='https://www.adminerevo.org/'".target_blank()." id='h1'>AdminerEvo</a>";}function
credentials(){return
array(SERVER,$_GET["username"],get_password());}function
connectSsl(){}function
permanentLogin($h=false){return
password_file($h);}function
bruteForceKey(){return$_SERVER["REMOTE_ADDR"];}function
serverName($M){return
h($M);}function
database(){return
DB;}function
databases($hd=true){return
get_databases($hd);}function
schemas(){return
schemas();}function
queryTimeout(){return
2;}function
headers(){}function
csp(){return
csp();}function
head(){return
true;}function
css(){$I=array();$o="adminer.css";if(file_exists($o))$I[]="$o?v=".crc32(file_get_contents($o));return$I;}function
loginForm(){global$mc;echo"<table cellspacing='0' class='layout'>\n",$this->loginFormField('driver','<tr><th>'.'Système'.'<td>',html_select("auth[driver]",$mc,DRIVER,"loginDriver(this);")."\n"),$this->loginFormField('server','<tr><th>'.'Serveur'.'<td>','<input name="auth[server]" value="'.h(SERVER).'" title="hostname[:port]" placeholder="localhost" autocapitalize="off">'."\n"),$this->loginFormField('username','<tr><th>'.'Utilisateur'.'<td>','<input name="auth[username]" id="username" value="'.h($_GET["username"]).'" autocomplete="username" autocapitalize="off">'.script("focus(qs('#username')); qs('#username').form['auth[driver]'].onchange();")),$this->loginFormField('password','<tr><th>'.'Mot de passe'.'<td>','<input type="password" name="auth[password]" autocomplete="current-password">'."\n"),$this->loginFormField('db','<tr><th>'.'Base de données'.'<td>','<input name="auth[db]" value="'.h($_GET["db"]).'" autocapitalize="off">'."\n"),"</table>\n","<p><input type='submit' value='".'Authentification'."'>\n",checkbox("auth[permanent]",1,$_COOKIE["adminer_permanent"],'Authentification permanente')."\n";}function
loginFormField($C,$Fd,$Y){return$Fd.$Y;}function
login($Ce,$F){if($F=="")return
sprintf('Adminer ne supporte pas l\'accès aux bases de données sans mot de passe, <a href="https://www.adminer.org/en/password/"%s>plus d\'information</a>.',target_blank());return
true;}function
tableName($Sh){return
h($Sh["Name"]);}function
fieldName($m,$Ef=0){return'<span title="'.h($m["full_type"]).'">'.h($m["field"]).'</span>';}function
selectLinks($Sh,$N=""){global$w,$k;echo'<p class="links">';$wa=array("select"=>'Afficher les données');if(support("table")||support("indexes"))$wa["table"]='Afficher la structure';if(support("table")){if(is_view($Sh))$wa["view"]='Modifier une vue';else$wa["create"]='Modifier la table';}if($N!==null)$wa["edit"]='Nouvel élément';$C=$Sh["Name"];$_=[];foreach($wa
as$x=>$X)$_[]="<a href='".h(ME)."$x=".urlencode($C).($x=="edit"?$N:"")."'".bold(isset($_GET[$x])).">$X</a>";echo
generate_linksbar($_),doc_link(array($w=>$k->tableHelp($C)),"?"),"\n";}function
foreignKeys($Q){return
foreign_keys($Q);}function
backwardKeys($Q,$Rh){return
array();}function
backwardKeysPrint($Oa,$J){}function
selectQuery($G,$Hh,$Vc=false){global$w,$k;if(!$Vc&&($gj=$k->warnings())){$s="warnings";$I=", <a href='#$s'>".'Avertissements'."</a>".script("qsl('a').onclick = partial(toggle, '$s');","")."<div id='$s' class='hidden'>\n$gj</div>\n";}$_=[(support("sql")?"<a href='".h(ME)."sql=".urlencode($G)."'>".'Modifier'."</a>":""),"<a href='#' class='copy-to-clipboard'>".'Copier dans le presse-papiers'."</a>",];return"<code class='jush-$w copy-to-clipboard'>".h(str_replace("\n"," ",$G))."</code> <span class='time'>(".format_time($Hh).")</span>".generate_linksbar($_);}function
sqlCommandQuery($G){return
shorten_utf8(trim($G),1000);}function
rowDescription($Q){return"";}function
rowDescriptions($K,$ld){return$K;}function
selectLink($X,$m){}function
selectVal($X,$z,$m,$Mf){$I=($X===null?"<i>NULL</i>":(preg_match("~char|binary|boolean~",$m["type"]??null)&&!preg_match("~var~",$m["type"]??null)?"<code>$X</code>":$X));if(preg_match('~blob|bytea|raw|file~',$m["type"]??null)&&!is_utf8($X))$I="<i>".lang(array('%d octet','%d octets'),strlen($Mf))."</i>";if(preg_match('~json~',$m["type"]??null))$I="<code class='jush-js'>$I</code>";return($z?"<a href='".h($z)."'".(is_url($z)?target_blank():"").">$I</a>":$I);}function
editVal($X,$m){return$X;}function
tableStructurePrint($n){echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap'>\n","<thead><tr><th>".'Colonne'."<td>".'Type'.(support("comment")?"<td>".'Commentaire':"")."</thead>\n";foreach($n
as$m){echo"<tr".odd()."><th>".h($m["field"]),"<td><span title='".h($m["collation"])."'>".h($m["full_type"])."</span>",($m["null"]?" <i>NULL</i>":""),($m["auto_increment"]?" <i>".'Incrément automatique'."</i>":""),(isset($m["default"])?" <span title='".'Valeur par défaut'."'>[<b>".h($m["default"])."</b>]</span>":""),(support("comment")?"<td>".h($m["comment"]):""),"\n";}echo"</table>\n","</div>\n";}function
tableIndexesPrint($v){echo"<table cellspacing='0'>\n";foreach($v
as$C=>$u){ksort($u["columns"]);$sg=array();foreach($u["columns"]as$x=>$X)$sg[]="<i>".h($X)."</i>".($u["lengths"][$x]?"(".$u["lengths"][$x].")":"").($u["descs"][$x]?" DESC":"");echo"<tr title='".h($C)."'><th>$u[type]<td>".implode(", ",$sg)."\n";}echo"</table>\n";}function
selectColumnsPrint($L,$e){global$sd,$zd;print_fieldset("select",'Sélectionner',$L);$r=0;$L[""]=array();foreach($L
as$x=>$X){$X=$_GET["columns"][$x]??null;$d=select_input(" name='columns[$r][col]'",$e,$X["col"]??null,($x!==""?"selectFieldChange":"selectAddRow"));echo"<div>".($sd||$zd?"<select name='columns[$r][fun]'>".optionlist(array(-1=>"")+array_filter(array('Fonctions'=>$sd,'Agrégation'=>$zd)),$X["fun"]??null)."</select>".on_help("getTarget(event).value && getTarget(event).value.replace(/ |\$/, '(') + ')'",1).script("qsl('select').onchange = function () { helpClose();".($x!==""?"":" qsl('select, input', this.parentNode).onchange();")." };","")."($d)":$d)." <input type='image' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.8.4")."' class='jsonly icon' title='",h('Effacer'),"' alt='x'>".script('qsl(".icon").onclick = selectRemoveRow;',"")."</div>\n";$r++;}echo"</div></fieldset>\n";}function
selectSearchPrint($Z,$e,$v){print_fieldset("search",'Rechercher',$Z);foreach($v
as$r=>$u){if($u["type"]=="FULLTEXT"){echo"<div>(<i>".implode("</i>, <i>",array_map('h',$u["columns"]))."</i>) AGAINST"," <input type='search' name='fulltext[$r]' value='".h($_GET["fulltext"][$r])."'>",script("qsl('input').oninput = selectFieldChange;",""),checkbox("boolean[$r]",1,isset($_GET["boolean"][$r]),"BOOL"),"</div>\n";}}$Za="this.parentNode.firstChild.onchange();";foreach(array_merge((array)$_GET["where"],array(array()))as$r=>$X){if(!$X||("$X[col]$X[val]"!=""&&in_array($X["op"],$this->operators))){echo"<div>".select_input(" name='where[$r][col]'",$e,$X["col"],($X?"selectFieldChange":"selectAddRow"),"(".'n\'importe où'.")"),html_select("where[$r][op]",$this->operators,$X["op"],$Za),"<input type='search' name='where[$r][val]' value='".h($X["val"])."'>",script("mixin(qsl('input'), {oninput: function () { $Za }, onkeydown: selectSearchKeydown, onsearch: selectSearchSearch});",""),"<input type='image' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.8.4")."' class='jsonly icon' title='",h('Effacer'),"' alt='x'>",script('qsl(".icon").onclick = selectRemoveRow;',""),"</div>\n";}}echo"</div></fieldset>\n";}function
selectOrderPrint($Ef,$e,$v){print_fieldset("sort",'Trier',$Ef);$r=0;foreach((array)$_GET["order"]as$x=>$X){if($X!=""){echo"<div>".select_input(" name='order[$r]'",$e,$X,"selectFieldChange"),checkbox("desc[$r]",1,isset($_GET["desc"][$x]),'décroissant')," <input type='image' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.8.4")."' class='jsonly icon' title='",h('Effacer'),"' alt='x'>",script('qsl(".icon").onclick = selectRemoveRow;',""),"</div>\n";$r++;}}echo"<div>".select_input(" name='order[$r]'",$e,"","selectAddRow"),checkbox("desc[$r]",1,false,'décroissant')," <input type='image' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.8.4")."' class='jsonly icon' title='",h('Effacer'),"' alt='x'>",script('qsl(".icon").onclick = selectRemoveRow;',""),"</div>\n","</div></fieldset>\n";}function
selectLimitPrint($y){echo"<fieldset><legend>".'Limite'."</legend><div>";echo"<input type='number' name='limit' class='size' value='".h($y)."'>",script("qsl('input').oninput = selectFieldChange;",""),"</div></fieldset>\n";}function
selectLengthPrint($hi){if($hi!==null){echo"<fieldset><legend>".'Longueur du texte'."</legend><div>","<input type='number' name='text_length' class='size' value='".h($hi)."'>","</div></fieldset>\n";}}function
selectActionPrint($v){echo"<fieldset><legend>".'Action'."</legend><div>","<input type='submit' value='".'Sélectionner'."'>"," <span id='noindex' title='".'Scan de toute la table'."'></span>","<script".nonce().">\n","var indexColumns = ";$e=array();foreach($v
as$u){$Pb=reset($u["columns"]);if($u["type"]!="FULLTEXT"&&$Pb)$e[$Pb]=1;}$e[""]=1;foreach($e
as$x=>$X)json_row($x);echo";\n","selectFieldChange.call(qs('#form')['select']);\n","</script>\n","</div></fieldset>\n";}function
selectCommandPrint(){return!information_schema(DB);}function
selectImportPrint(){return!information_schema(DB);}function
selectEmailPrint($zc,$e){}function
selectColumnsProcess($e,$v){global$sd,$zd;$L=array();$wd=array();foreach((array)$_GET["columns"]as$x=>$X){if($X["fun"]=="count"||($X["col"]!=""&&(!$X["fun"]||in_array($X["fun"],$sd)||in_array($X["fun"],$zd)))){$L[$x]=apply_sql_function($X["fun"],($X["col"]!=""?idf_escape($X["col"]):"*"));if(!in_array($X["fun"],$zd))$wd[]=$L[$x];}}return
array($L,$wd);}function
selectSearchProcess($n,$v){global$f,$k;$I=array();foreach($v
as$r=>$u){if($u["type"]=="FULLTEXT"&&$_GET["fulltext"][$r]!="")$I[]="MATCH (".implode(", ",array_map('idf_escape',$u["columns"])).") AGAINST (".q($_GET["fulltext"][$r]).(isset($_GET["boolean"][$r])?" IN BOOLEAN MODE":"").")";}foreach((array)$_GET["where"]as$x=>$X){if("$X[col]$X[val]"!=""&&in_array($X["op"],$this->operators)){$og="";$wb=" $X[op]";if(preg_match('~IN$~',$X["op"])){$Pd=process_length($X["val"]);$wb.=" ".($Pd!=""?$Pd:"(NULL)");}elseif($X["op"]=="SQL")$wb=" $X[val]";elseif($X["op"]=="LIKE %%")$wb=" LIKE ".$this->processInput($n[$X["col"]],"%$X[val]%");elseif($X["op"]=="ILIKE %%")$wb=" ILIKE ".$this->processInput($n[$X["col"]],"%$X[val]%");elseif($X["op"]=="FIND_IN_SET"){$og="$X[op](".q($X["val"]).", ";$wb=")";}elseif(!preg_match('~NULL$~',$X["op"]))$wb.=" ".$this->processInput($n[$X["col"]],$X["val"]);if($X["col"]!="")$I[]=$og.$k->convertSearch(idf_escape($X["col"]),$X,$n[$X["col"]]).$wb;else{$pb=array();foreach($n
as$C=>$m){if((preg_match('~^[-\d.'.(preg_match('~IN$~',$X["op"])?',':'').']+$~',$X["val"])||!preg_match('~'.number_type().'|bit~',$m["type"]))&&(!preg_match("~[\x80-\xFF]~",$X["val"])||preg_match('~char|text|enum|set~',$m["type"]))&&(!preg_match('~date|timestamp~',$m["type"])||preg_match('~^\d+-\d+-\d+~',$X["val"])))$pb[]=$og.$k->convertSearch(idf_escape($C),$X,$m).$wb;}$I[]=($pb?"(".implode(" OR ",$pb).")":"1 = 0");}}}return$I;}function
selectOrderProcess($n,$v){$I=array();foreach((array)$_GET["order"]as$x=>$X){if($X!="")$I[]=(preg_match('~^((COUNT\(DISTINCT |[A-Z0-9_]+\()(`(?:[^`]|``)+`|"(?:[^"]|"")+")\)|COUNT\(\*\))$~',$X)?$X:idf_escape($X)).(isset($_GET["desc"][$x])?" DESC":"");}return$I;}function
selectLimitProcess(){return(isset($_GET["limit"])?$_GET["limit"]:"50");}function
selectLengthProcess(){return(isset($_GET["text_length"])?$_GET["text_length"]:"100");}function
selectEmailProcess($Z,$ld){return
false;}function
selectQueryBuild($L,$Z,$wd,$Ef,$y,$E){return"";}function
messageQuery($G,$ii,$Vc=false){global$w,$k;restart_session();$Gd=&get_session("queries");if(isset($Gd[$_GET["db"]])===false)$Gd[$_GET["db"]]=array();if(strlen($G)>1e6)$G=preg_replace('~[\x80-\xFF]+$~','',substr($G,0,1e6))."\n…";$Gd[$_GET["db"]][]=array($G,time(),$ii);$Eh="sql-".count($Gd[$_GET["db"]]);$I="<a href='#$Eh' class='toggle'>".'Requête SQL'."</a> <a href='#' class='copy-to-clipboard icon expand' data-expand-id='$Eh'></a>\n";if(!$Vc&&($gj=$k->warnings())){$s="warnings-".count($Gd[$_GET["db"]]);$I="<a href='#$s' class='toggle'>".'Avertissements'."</a>, $I<div id='$s' class='hidden'>\n$gj</div>\n";}$_=[];if(support("sql")){$_[]='<a href="'.h(str_replace("db=".urlencode(DB),"db=".urlencode($_GET["db"]),ME).'sql=&history='.(count($Gd[$_GET["db"]])-1)).'">'.'Modifier'.'</a>';$_[]='<a href="#" class="copy-to-clipboard">'.'Copier dans le presse-papiers'.'</a>';}return" <span class='time'>".@date("H:i:s")."</span>"." $I<div id='$Eh' class='hidden'><pre><code class='jush-$w copy-to-clipboard'>".shorten_utf8($G,1000)."</code></pre>".($ii?" <span class='time'>($ii)</span>":'').generate_linksbar($_).'</div>';}function
editRowPrint($Q,$n,$J,$Ni){}function
editFunctions($m){global$uc;$I=($m["null"]?"NULL/":"");$Ni=isset($_GET["select"])||where($_GET);foreach($uc
as$x=>$sd){if(!$x||(!isset($_GET["call"])&&$Ni)){foreach($sd
as$fg=>$X){if(!$fg||preg_match("~$fg~",$m["type"]))$I.="/$X";}}if($x&&!preg_match('~set|blob|bytea|raw|file|bool~',$m["type"]))$I.="/SQL";}if($m["auto_increment"]&&!$Ni)$I='Incrément automatique';return
explode("/",$I);}function
editInput($Q,$m,$Ia,$Y){if($m["type"]=="enum"){$D=array();$ih=$Y;if(isset($_GET["select"])){$D[-1]='original';if($ih===null)$ih=-1;}if($m["null"]){$D[""]="NULL";if($Y===null&&!isset($_GET["select"]))$ih="";}$D[0]='vide';preg_match_all("~'((?:[^']|'')*)'~",$m["length"],$Ie);foreach($Ie[1]as$r=>$X){$X=stripcslashes(str_replace("''","'",$X));$D[$r+1]=$X;if($Y===$X)$ih=$r+1;}return"<select$Ia>".optionlist($D,(string)$ih,1)."</select>";}return"";}function
editHint($Q,$m,$Y){return"";}function
processInput($m,$Y,$q=""){if($q=="SQL")return$Y;$C=$m["field"];$I=q($Y);if(preg_match('~^(now|getdate|uuid)$~',$q))$I="$q()";elseif(preg_match('~^current_(date|timestamp)$~',$q))$I=$q;elseif(preg_match('~^([+-]|\|\|)$~',$q))$I=idf_escape($C)." $q $I";elseif(preg_match('~^[+-] interval$~',$q))$I=idf_escape($C)." $q ".(preg_match("~^(\\d+|'[0-9.: -]') [A-Z_]+\$~i",$Y)?$Y:$I);elseif(preg_match('~^(addtime|subtime|concat)$~',$q))$I="$q(".idf_escape($C).", $I)";elseif(preg_match('~^(md5|sha1|password|encrypt)$~',$q))$I="$q($I)";return
unconvert_field($m,$I);}function
dumpOutput(){$I=array('text'=>'ouvrir','file'=>'enregistrer');if(function_exists('gzencode'))$I['gz']='gzip';return$I;}function
dumpFormat(){return
array('sql'=>'SQL','csv'=>'CSV,','csv;'=>'CSV;','tsv'=>'TSV');}function
dumpDatabase($j){}function
dumpTable($Q,$Mh,$ie=0){if($_POST["format"]!="sql"){echo"\xef\xbb\xbf";if($Mh)dump_csv(array_keys(fields($Q)));}else{if($ie==2){$n=array();foreach(fields($Q)as$C=>$m)$n[]=idf_escape($C)." $m[full_type]";$h="CREATE TABLE ".table($Q)." (".implode(", ",$n).")";}else$h=create_sql($Q,$_POST["auto_increment"],$Mh);set_utf8mb4($h);if($Mh&&$h){if($Mh=="DROP+CREATE"||$ie==1)echo"DROP ".($ie==2?"VIEW":"TABLE")." IF EXISTS ".table($Q).";\n";if($ie==1)$h=remove_definer($h);echo"$h;\n\n";}}}function
dumpData($Q,$Mh,$G){global$f,$w;$Ke=($w=="sqlite"?0:1048576);if($Mh){if($_POST["format"]=="sql"){if($Mh=="TRUNCATE+INSERT")echo
truncate_sql($Q).";\n";$n=fields($Q);}$H=$f->query($G,1);if($H){$be="";$Wa="";$ne=array();$td=array();$Oh="";$Yc=($Q!=''?'fetch_assoc':'fetch_row');while($J=$H->$Yc()){if(!$ne){$Yi=array();foreach($J
as$X){$m=$H->fetch_field();if(!empty($n[$m->name]['generated'])){$td[$m->name]=true;continue;}$ne[]=$m->name;$x=idf_escape($m->name);$Yi[]="$x = VALUES($x)";}$Oh=($Mh=="INSERT+UPDATE"?"\nON DUPLICATE KEY UPDATE ".implode(", ",$Yi):"").";\n";}if($_POST["format"]!="sql"){if($Mh=="table"){dump_csv($ne);$Mh="INSERT";}dump_csv($J);}else{if(!$be)$be="INSERT INTO ".table($Q)." (".implode(", ",array_map('idf_escape',$ne)).") VALUES";foreach($J
as$x=>$X){if(isset($td[$x])){unset($J[$x]);continue;}$m=$n[$x];$J[$x]=($X!==null?unconvert_field($m,preg_match(number_type(),$m["type"])&&!preg_match('~\[~',$m["full_type"])&&is_numeric($X)?$X:q(($X===false?0:$X))):"NULL");}$ch=($Ke?"\n":" ")."(".implode(",\t",$J).")";if(!$Wa)$Wa=$be.$ch;elseif(strlen($Wa)+4+strlen($ch)+strlen($Oh)<$Ke)$Wa.=",$ch";else{echo$Wa.$Oh;$Wa=$be.$ch;}}}if($Wa)echo$Wa.$Oh;}elseif($_POST["format"]=="sql")echo"-- ".str_replace("\n"," ",$f->error)."\n";}}function
dumpFilename($Ld){return
friendly_url($Ld!=""?$Ld:(SERVER!=""?SERVER:"localhost"));}function
dumpHeaders($Ld,$Ye=false){$Pf=$_POST["output"];$Qc=(preg_match('~sql~',$_POST["format"])?"sql":($Ye?"tar":"csv"));header("Content-Type: ".($Pf=="gz"?"application/x-gzip":($Qc=="tar"?"application/x-tar":($Qc=="sql"||$Pf!="file"?"text/plain":"text/csv")."; charset=utf-8")));if($Pf=="gz")ob_start('ob_gzencode',1e6);return$Qc;}function
importServerPath(){return"adminer.sql";}function
homepage(){$_=[];if($_GET["ns"]==""&&support("database"))$_[]='<a href="'.h(ME).'database=">'.'Modifier la base de données'.'</a>';if(support("scheme"))$_[]="<a href='".h(ME)."scheme='>".($_GET["ns"]!=""?'Modifier le schéma':'Créer un schéma')."</a>";if($_GET["ns"]!=="")$_[]='<a href="'.h(ME).'schema=">'.'Schéma de la base de données'.'</a>';if(support("privileges"))$_[]="<a href='".h(ME)."privileges='>".'Privilèges'."</a>";echo
generate_linksbar($_);return
true;}function
navigation($Xe){global$ia,$w,$mc,$f;echo'<h1>
',$this->name(),' <span class="version">',$ia,'</span>
<a href="https://download.adminerevo.org/latest/adminer/"',target_blank(),' id="version" title="A newer version of AdminerEvo is available, download it now!">',(version_compare($ia,$_COOKIE["adminer_version"])<0?h($_COOKIE["adminer_version"]):""),'</a>
</h1>
';if($Xe=="auth"){$Pf="";foreach((array)$_SESSION["pwds"]as$aj=>$qh){foreach($qh
as$M=>$Vi){foreach($Vi
as$V=>$F){if($F!==null){$Wb=$_SESSION["db"][$aj][$M][$V];foreach(($Wb?array_keys($Wb):array(""))as$j)$Pf.="<li><a href='".h(auth_url($aj,$M,$V,$j))."'>($mc[$aj]) ".h($V.($M!=""?"@".$this->serverName($M):"").($j!=""?" - $j":""))."</a>\n";}}}}if($Pf)echo"<ul id='logins'>\n$Pf</ul>\n".script("mixin(qs('#logins'), {onmouseover: menuOver, onmouseout: menuOut});");}else{$S=array();if($_GET["ns"]!==""&&!$Xe&&DB!=""){$f->select_db(DB);$S=table_status('',true);}echo
script_src(preg_replace("~\\?.*~","",ME)."?file=jush.js&version=4.8.4");if(support("sql")){echo'<script',nonce(),'>
';if($S){$_=array();foreach($S
as$Q=>$T)$_[]=preg_quote($Q,'/');echo"var jushLinks = { $w: [ '".js_escape(ME).(support("table")?"table=":"select=")."\$&', /\\b(".implode("|",$_).")\\b/g ] };\n";foreach(array("bac","bra","sqlite_quo","mssql_bra")as$X)echo"jushLinks.$X = jushLinks.$w;\n";}$ph=$f->server_info;echo'bodyLoad(\'',(is_object($f)?preg_replace('~^(\d\.?\d).*~s','\1',$ph):""),'\'',(preg_match('~MariaDB~',$ph)?", true":""),');
</script>
';}$this->databasesPrint($Xe);$_=[];if(DB==""||!$Xe){if(support("sql")){$_[]="<a href='".h(ME)."sql='".bold(isset($_GET["sql"])&&!isset($_GET["import"])).">".'Requête SQL'."</a>";$_[]="<a href='".h(ME)."import='".bold(isset($_GET["import"])).">".'Importer'."</a>";}if(support("dump"))$_[]="<a href='".h(ME)."dump=".urlencode(isset($_GET["table"])?$_GET["table"]:$_GET["select"])."' id='dump'".bold(isset($_GET["dump"])).">".'Exporter'."</a>";}echo
generate_linksbar($_);if($_GET["ns"]!==""&&!$Xe&&DB!=""){echo
generate_linksbar(['<a href="'.h(ME).'create="'.bold($_GET["create"]==="").">".'Créer une table'."</a>"]);if(!$S)echo"<p class='message'>".'Aucune table.'."\n";else$this->tablesPrint($S);}}}function
databasesPrint($Xe){global$b,$f;$i=$this->databases();if(DB&&$i&&!in_array(DB,$i))array_unshift($i,DB);echo'<form action="">
',"<table id='dbs'><tr><td width=1>";hidden_fields_get();$Ub=script("mixin(qsl('select'), {onmousedown: dbMouseDown, onchange: dbChange});");echo"<label title='".'base de données'."' for='menu_db'>".'BD'."</label>:</td><td>".($i?"<select name='db' id='menu_db'>".optionlist(array(""=>"")+$i,DB)."</select>$Ub":"<input name='db' id='menu_db' value='".h(DB)."' autocapitalize='off'>\n"),"</td></tr>";if(support("scheme")){if($Xe!="db"&&DB!=""&&$f->select_db(DB)){echo"<tr><td><label for='menu_ns'>".'Schéma'.":</label></td>","<td><select name='ns' id='menu_ns'>".optionlist(array(""=>"")+$b->schemas(),$_GET["ns"])."</select>$Ub";if($_GET["ns"]!="")set_schema($_GET["ns"]);echo"</td></tr>";}}echo"<tr".($i?" class='hidden'":"")."><td colspan=2><input type='submit' value='".'Utiliser'."'></td></tr>\n","</table>";foreach(array("import","sql","schema","dump","privileges")as$X){if(isset($_GET[$X])){echo"<input type='hidden' name='$X' value=''>";break;}}}function
tablesPrint($S){echo"<ul id='tables'>".script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");foreach($S
as$Q=>$O){$C=$this->tableName($O);if($C!=""){echo'<li><a href="'.h(ME).'select='.urlencode($Q).'"'.bold($_GET["select"]==$Q||$_GET["edit"]==$Q,"select")." title='".'Afficher les données'."'>".'select'."</a> ",(support("table")||support("indexes")?'<a href="'.h(ME).'table='.urlencode($Q).'"'.bold(in_array($Q,array($_GET["table"],$_GET["create"],$_GET["indexes"],$_GET["foreign"],$_GET["trigger"],$_GET["select"])),(is_view($O)?"view":"structure"))." title='".'Afficher la structure'."'>$C</a>":"<span>$C</span>")."\n";}}echo"</ul>\n";}}$b=(function_exists('adminer_object')?adminer_object():new
Adminer);$mc=array("server"=>"MySQL")+$mc;if(!defined("DRIVER")){define("DRIVER","server");if(extension_loaded("mysqli")){class
Min_DB
extends
MySQLi{var$extension="MySQLi";function
__construct(){parent::init();}function
connect($M="",$V="",$F="",$Sb=null,$jg=null,$yh=null){global$b;mysqli_report(MYSQLI_REPORT_OFF);list($Jd,$jg)=explode(":",$M,2);$Gh=$b->connectSsl();if($Gh)$this->ssl_set($Gh['key'],$Gh['cert'],$Gh['ca'],'','');$I=@$this->real_connect(($M!=""?$Jd:ini_get("mysqli.default_host")),($M.$V!=""?$V:ini_get("mysqli.default_user")),($M.$V.$F!=""?$F:ini_get("mysqli.default_pw")),$Sb,(is_numeric($jg)?$jg:ini_get("mysqli.default_port")),(!is_numeric($jg)?$jg:$yh),($Gh?64:0));$this->options(MYSQLI_OPT_LOCAL_INFILE,false);return$I;}function
set_charset($ab){if(parent::set_charset($ab))return
true;parent::set_charset('utf8');return$this->query("SET NAMES $ab");}function
result($G,$m=0){$H=$this->query($G);if(!$H)return
false;$J=$H->fetch_array();return$J[$m];}function
quote($P){return"'".$this->escape_string($P)."'";}}}elseif(extension_loaded("mysql")&&!((ini_bool("sql.safe_mode")||ini_bool("mysql.allow_local_infile"))&&extension_loaded("pdo_mysql"))){class
Min_DB{var$extension="MySQL",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($M,$V,$F){if(ini_bool("mysql.allow_local_infile")){$this->error=sprintf('Désactiver %s ou activer %s or %s extensions.',"'mysql.allow_local_infile'","MySQLi","PDO_MySQL");return
false;}$this->_link=@mysql_connect(($M!=""?$M:ini_get("mysql.default_host")),("$M$V"!=""?$V:ini_get("mysql.default_user")),("$M$V$F"!=""?$F:ini_get("mysql.default_password")),true,131072);if($this->_link)$this->server_info=mysql_get_server_info($this->_link);else$this->error=mysql_error();return(bool)$this->_link;}function
set_charset($ab){if(function_exists('mysql_set_charset')){if(mysql_set_charset($ab,$this->_link))return
true;mysql_set_charset('utf8',$this->_link);}return$this->query("SET NAMES $ab");}function
quote($P){return"'".mysql_real_escape_string($P,$this->_link)."'";}function
select_db($Sb){return
mysql_select_db($Sb,$this->_link);}function
query($G,$Gi=false){$H=@($Gi?mysql_unbuffered_query($G,$this->_link):mysql_query($G,$this->_link));$this->error="";if(!$H){$this->errno=mysql_errno($this->_link);$this->error=mysql_error($this->_link);return
false;}if($H===true){$this->affected_rows=mysql_affected_rows($this->_link);$this->info=mysql_info($this->_link);return
true;}return
new
Min_Result($H);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$m=0){$H=$this->query($G);if(!$H||!$H->num_rows)return
false;return
mysql_result($H->_result,0,$m);}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($H){$this->_result=$H;$this->num_rows=mysql_num_rows($H);}function
fetch_assoc(){return
mysql_fetch_assoc($this->_result);}function
fetch_row(){return
mysql_fetch_row($this->_result);}function
fetch_field(){$I=mysql_fetch_field($this->_result,$this->_offset++);$I->orgtable=$I->table;$I->orgname=$I->name;$I->charsetnr=($I->blob?63:0);return$I;}function
__destruct(){mysql_free_result($this->_result);}}}elseif(extension_loaded("pdo_mysql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_MySQL";function
connect($M,$V,$F){global$b;$D=array(PDO::MYSQL_ATTR_LOCAL_INFILE=>false);$Gh=$b->connectSsl();if($Gh){if(!empty($Gh['key']))$D[PDO::MYSQL_ATTR_SSL_KEY]=$Gh['key'];if(!empty($Gh['cert']))$D[PDO::MYSQL_ATTR_SSL_CERT]=$Gh['cert'];if(!empty($Gh['ca']))$D[PDO::MYSQL_ATTR_SSL_CA]=$Gh['ca'];}$this->dsn("mysql:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$M)),$V,$F,$D);return
true;}function
set_charset($ab){$this->query("SET NAMES $ab");}function
select_db($Sb){return$this->query("USE ".idf_escape($Sb));}function
query($G,$Gi=false){$this->pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,!$Gi);return
parent::query($G,$Gi);}}}class
Min_Driver
extends
Min_SQL{function
insert($Q,$N){return($N?parent::insert($Q,$N):queries("INSERT INTO ".table($Q)." ()\nVALUES ()"));}function
insertUpdate($Q,$K,$qg){$e=array_keys(reset($K));$og="INSERT INTO ".table($Q)." (".implode(", ",$e).") VALUES\n";$Yi=array();foreach($e
as$x)$Yi[$x]="$x = VALUES($x)";$Oh="\nON DUPLICATE KEY UPDATE ".implode(", ",$Yi);$Yi=array();$ze=0;foreach($K
as$N){$Y="(".implode(", ",$N).")";if($Yi&&(strlen($og)+$ze+strlen($Y)+strlen($Oh)>1e6)){if(!queries($og.implode(",\n",$Yi).$Oh))return
false;$Yi=array();$ze=0;}$Yi[]=$Y;$ze+=strlen($Y)+2;}return
queries($og.implode(",\n",$Yi).$Oh);}function
slowQuery($G,$ji){if(min_version('5.7.8','10.1.2')){if(preg_match('~MariaDB~',$this->_conn->server_info))return"SET STATEMENT max_statement_time=$ji FOR $G";elseif(preg_match('~^(SELECT\b)(.+)~is',$G,$B))return"$B[1] /*+ MAX_EXECUTION_TIME(".($ji*1000).") */ $B[2]";}}function
convertSearch($t,$X,$m){return(preg_match('~char|text|enum|set~',$m["type"])&&!preg_match("~^utf8~",$m["collation"])&&preg_match('~[\x80-\xFF]~',$X['val'])?"CONVERT($t USING ".charset($this->_conn).")":$t);}function
warnings(){$H=$this->_conn->query("SHOW WARNINGS");if($H&&$H->num_rows){ob_start();select($H);return
ob_get_clean();}}function
tableHelp($C){$Fe=preg_match('~MariaDB~',$this->_conn->server_info);if(information_schema(DB))return
strtolower(($Fe?"information-schema-$C-table/":str_replace("_","-",$C)."-table.html"));if(DB=="mysql")return($Fe?"mysql$C-table/":"system-database.html");}}function
idf_escape($t){return"`".str_replace("`","``",$t)."`";}function
table($t){return
idf_escape($t);}function
connect(){global$b,$U,$Lh;$f=new
Min_DB;$Lb=$b->credentials();if($f->connect($Lb[0],$Lb[1],$Lb[2])){$f->set_charset(charset($f));$f->query("SET sql_quote_show_create = 1, autocommit = 1");if(min_version('5.7.8',10.2,$f)){$Lh['Chaînes'][]="json";$U["json"]=4294967295;}return$f;}$I=$f->error;if(function_exists('iconv')&&!is_utf8($I)&&strlen($ch=iconv("windows-1250","utf-8",$I))>strlen($I))$I=$ch;return$I;}function
get_databases($hd){$I=get_session("dbs");if($I===null){$G=(min_version(5)?"SELECT SCHEMA_NAME FROM information_schema.SCHEMATA ORDER BY SCHEMA_NAME":"SHOW DATABASES");$I=($hd?slow_query($G):get_vals($G));restart_session();set_session("dbs",$I);stop_session();}return$I;}function
limit($G,$Z,$y,$nf=0,$mh=" "){return" $G$Z".($y!==null?$mh."LIMIT $y".($nf?" OFFSET $nf":""):"");}function
limit1($Q,$G,$Z,$mh="\n"){return
limit($G,$Z,1,0,$mh);}function
db_collation($j,$nb){global$f;$I=null;$h=$f->result("SHOW CREATE DATABASE ".idf_escape($j),1);if(preg_match('~ COLLATE ([^ ]+)~',$h,$B))$I=$B[1];elseif(preg_match('~ CHARACTER SET ([^ ]+)~',$h,$B))$I=$nb[$B[1]][-1];return$I;}function
engines(){$I=array();foreach(get_rows("SHOW ENGINES")as$J){if(preg_match("~YES|DEFAULT~",$J["Support"]))$I[]=$J["Engine"];}return$I;}function
logged_user(){global$f;return$f->result("SELECT USER()");}function
tables_list(){return
get_key_vals(min_version(5)?"SELECT TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME":"SHOW TABLES");}function
count_tables($i){$I=array();foreach($i
as$j)$I[$j]=count(get_vals("SHOW TABLES IN ".idf_escape($j)));return$I;}function
table_status($C="",$Wc=false){$I=array();foreach(get_rows($Wc&&min_version(5)?"SELECT TABLE_NAME AS Name, ENGINE AS Engine, TABLE_COMMENT AS Comment FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ".($C!=""?"AND TABLE_NAME = ".q($C):"ORDER BY Name"):"SHOW TABLE STATUS".($C!=""?" LIKE ".q(addcslashes($C,"%_\\")):""))as$J){if($J["Engine"]=="InnoDB")$J["Comment"]=preg_replace('~(?:(.+); )?InnoDB free: .*~','\1',$J["Comment"]);if(!isset($J["Engine"]))$J["Comment"]="";if($C!="")return$J;$I[$J["Name"]]=$J;}return$I;}function
is_view($R){return$R["Engine"]===null;}function
fk_support($R){return
preg_match('~InnoDB|IBMDB2I~i',$R["Engine"])||(preg_match('~NDB~i',$R["Engine"])&&min_version(5.6));}function
fields($Q){$I=array();foreach(get_rows("SHOW FULL COLUMNS FROM ".table($Q))as$J){preg_match('~^([^( ]+)(?:\((.+)\))?( unsigned)?( zerofill)?$~',$J["Type"],$B);$I[$J["Field"]]=array("field"=>$J["Field"],"full_type"=>$J["Type"],"type"=>$B[1],"length"=>$B[2],"unsigned"=>ltrim($B[3].$B[4]),"default"=>($J["Default"]!=""||preg_match("~char|set~",$B[1])?(preg_match('~text~',$B[1])?stripslashes(preg_replace("~^'(.*)'\$~",'\1',$J["Default"])):$J["Default"]):null),"null"=>($J["Null"]=="YES"),"auto_increment"=>($J["Extra"]=="auto_increment"),"on_update"=>(preg_match('~^on update (.+)~i',$J["Extra"],$B)?$B[1]:""),"collation"=>$J["Collation"],"privileges"=>array_flip(preg_split('~, *~',$J["Privileges"])),"comment"=>$J["Comment"],"primary"=>($J["Key"]=="PRI"),"generated"=>preg_match('~^(VIRTUAL|PERSISTENT|STORED)~',$J["Extra"]),);}return$I;}function
indexes($Q,$g=null){$I=array();foreach(get_rows("SHOW INDEX FROM ".table($Q),$g)as$J){$C=$J["Key_name"];$I[$C]["type"]=($C=="PRIMARY"?"PRIMARY":($J["Index_type"]=="FULLTEXT"?"FULLTEXT":($J["Non_unique"]?($J["Index_type"]=="SPATIAL"?"SPATIAL":"INDEX"):"UNIQUE")));$I[$C]["columns"][]=$J["Column_name"];$I[$C]["lengths"][]=($J["Index_type"]=="SPATIAL"?null:$J["Sub_part"]);$I[$C]["descs"][]=null;}return$I;}function
foreign_keys($Q){global$f,$vf;static$fg='(?:`(?:[^`]|``)+`|"(?:[^"]|"")+")';$I=array();$Jb=$f->result("SHOW CREATE TABLE ".table($Q),1);if($Jb){preg_match_all("~CONSTRAINT ($fg) FOREIGN KEY ?\\(((?:$fg,? ?)+)\\) REFERENCES ($fg)(?:\\.($fg))? \\(((?:$fg,? ?)+)\\)(?: ON DELETE ($vf))?(?: ON UPDATE ($vf))?~",$Jb,$Ie,PREG_SET_ORDER);foreach($Ie
as$B){preg_match_all("~$fg~",$B[2],$_h);preg_match_all("~$fg~",$B[5],$bi);$I[idf_unescape($B[1])]=array("db"=>idf_unescape($B[4]!=""?$B[3]:$B[4]),"table"=>idf_unescape($B[4]!=""?$B[4]:$B[3]),"source"=>array_map('idf_unescape',$_h[0]),"target"=>array_map('idf_unescape',$bi[0]),"on_delete"=>($B[6]?$B[6]:"RESTRICT"),"on_update"=>($B[7]?$B[7]:"RESTRICT"),);}}return$I;}function
view($C){global$f;return
array("select"=>preg_replace('~^(?:[^`]|`[^`]*`)*\s+AS\s+~isU','',$f->result("SHOW CREATE VIEW ".table($C),1)));}function
collations(){$I=array();foreach(get_rows("SHOW COLLATION")as$J){if($J["Default"])$I[$J["Charset"]][-1]=$J["Collation"];else$I[$J["Charset"]][]=$J["Collation"];}ksort($I);foreach($I
as$x=>$X)asort($I[$x]);return$I;}function
information_schema($j){return(min_version(5)&&$j=="information_schema")||(min_version(5.5)&&$j=="performance_schema");}function
error(){global$f;return
h(preg_replace('~^You have an error.*syntax to use~U',"Syntax error",$f->error));}function
create_database($j,$mb){return
queries("CREATE DATABASE ".idf_escape($j).($mb?" COLLATE ".q($mb):""));}function
drop_databases($i){$I=apply_queries("DROP DATABASE",$i,'idf_escape');restart_session();set_session("dbs",null);return$I;}function
rename_database($C,$mb){$I=false;if(create_database($C,$mb)){$S=array();$dj=array();foreach(tables_list()as$Q=>$T){if($T=='VIEW')$dj[]=$Q;else$S[]=$Q;}$I=(!$S&&!$dj)||move_tables($S,$dj,$C);drop_databases($I?array(DB):array());}return$I;}function
auto_increment(){$Ma=" PRIMARY KEY";if($_GET["create"]!=""&&$_POST["auto_increment_col"]){foreach(indexes($_GET["create"])as$u){if(in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"],$u["columns"],true)){$Ma="";break;}if($u["type"]=="PRIMARY")$Ma=" UNIQUE";}}return" AUTO_INCREMENT$Ma";}function
alter_table($Q,$C,$n,$kd,$tb,$Bc,$mb,$La,$Zf){$c=array();foreach($n
as$m)$c[]=($m[1]?($Q!=""?($m[0]!=""?"CHANGE ".idf_escape($m[0]):"ADD"):" ")." ".implode($m[1]).($Q!=""?$m[2]:""):"DROP ".idf_escape($m[0]));$c=array_merge($c,$kd);$O=($tb!==null?" COMMENT=".q($tb):"").($Bc?" ENGINE=".q($Bc):"").($mb?" COLLATE ".q($mb):"").($La!=""?" AUTO_INCREMENT=$La":"");if($Q=="")return
queries("CREATE TABLE ".table($C)." (\n".implode(",\n",$c)."\n)$O$Zf");if($Q!=$C)$c[]="RENAME TO ".table($C);if($O)$c[]=ltrim($O);return($c||$Zf?queries("ALTER TABLE ".table($Q)."\n".implode(",\n",$c).$Zf):true);}function
alter_indexes($Q,$c){foreach($c
as$x=>$X)$c[$x]=($X[2]=="DROP"?"\nDROP INDEX ".idf_escape($X[1]):"\nADD $X[0] ".($X[0]=="PRIMARY"?"KEY ":"").($X[1]!=""?idf_escape($X[1])." ":"")."(".implode(", ",$X[2]).")");return
queries("ALTER TABLE ".table($Q).implode(",",$c));}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($dj){return
queries("DROP VIEW ".implode(", ",array_map('table',$dj)));}function
drop_tables($S){return
queries("DROP TABLE ".implode(", ",array_map('table',$S)));}function
move_tables($S,$dj,$bi){global$f;$Og=array();foreach($S
as$Q)$Og[]=table($Q)." TO ".idf_escape($bi).".".table($Q);if(!$Og||queries("RENAME TABLE ".implode(", ",$Og))){$dc=array();foreach($dj
as$Q)$dc[table($Q)]=view($Q);$f->select_db($bi);$j=idf_escape(DB);foreach($dc
as$C=>$cj){if(!queries("CREATE VIEW $C AS ".str_replace(" $j."," ",$cj["select"]))||!queries("DROP VIEW $j.$C"))return
false;}return
true;}return
false;}function
copy_tables($S,$dj,$bi){queries("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");foreach($S
as$Q){$C=($bi==DB?table("copy_$Q"):idf_escape($bi).".".table($Q));if(($_POST["overwrite"]&&!queries("\nDROP TABLE IF EXISTS $C"))||!queries("CREATE TABLE $C LIKE ".table($Q))||!queries("INSERT INTO $C SELECT * FROM ".table($Q)))return
false;foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")))as$J){$Ai=$J["Trigger"];if(!queries("CREATE TRIGGER ".($bi==DB?idf_escape("copy_$Ai"):idf_escape($bi).".".idf_escape($Ai))." $J[Timing] $J[Event] ON $C FOR EACH ROW\n$J[Statement];"))return
false;}}foreach($dj
as$Q){$C=($bi==DB?table("copy_$Q"):idf_escape($bi).".".table($Q));$cj=view($Q);if(($_POST["overwrite"]&&!queries("DROP VIEW IF EXISTS $C"))||!queries("CREATE VIEW $C AS $cj[select]"))return
false;}return
true;}function
trigger($C){if($C=="")return
array();$K=get_rows("SHOW TRIGGERS WHERE `Trigger` = ".q($C));return
reset($K);}function
triggers($Q){$I=array();foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")))as$J)$I[$J["Trigger"]]=array($J["Timing"],$J["Event"]);return$I;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
routine($C,$T){global$f,$Dc,$Zd,$U;$Ca=array("bool","boolean","integer","double precision","real","dec","numeric","fixed","national char","national varchar");$Ah="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$Fi="((".implode("|",array_merge(array_keys($U),$Ca)).")\\b(?:\\s*\\(((?:[^'\")]|$Dc)++)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s,]+)['\"]?)?";$fg="$Ah*(".($T=="FUNCTION"?"":$Zd).")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$Fi";$h=$f->result("SHOW CREATE $T ".idf_escape($C),2);preg_match("~\\(((?:$fg\\s*,?)*)\\)\\s*".($T=="FUNCTION"?"RETURNS\\s+$Fi\\s+":"")."(.*)~is",$h,$B);$n=array();preg_match_all("~$fg\\s*,?~is",$B[1],$Ie,PREG_SET_ORDER);foreach($Ie
as$Tf)$n[]=array("field"=>str_replace("``","`",$Tf[2]).$Tf[3],"type"=>strtolower($Tf[5]),"length"=>preg_replace_callback("~$Dc~s",'normalize_enum',$Tf[6]),"unsigned"=>strtolower(preg_replace('~\s+~',' ',trim("$Tf[8] $Tf[7]"))),"null"=>1,"full_type"=>$Tf[4],"inout"=>strtoupper($Tf[1]),"collation"=>strtolower($Tf[9]),);if($T!="FUNCTION")return
array("fields"=>$n,"definition"=>$B[11]);return
array("fields"=>$n,"returns"=>array("type"=>$B[12],"length"=>$B[13],"unsigned"=>$B[15],"collation"=>$B[16]),"definition"=>$B[17],"language"=>"SQL",);}function
routines(){return
get_rows("SELECT ROUTINE_NAME AS SPECIFIC_NAME, ROUTINE_NAME, ROUTINE_TYPE, DTD_IDENTIFIER FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB));}function
routine_languages(){return
array();}function
routine_id($C,$J){return
idf_escape($C);}function
last_id(){global$f;return$f->result("SELECT LAST_INSERT_ID()");}function
explain($f,$G){return$f->query("EXPLAIN ".(min_version(5.1)&&!min_version(5.7)?"PARTITIONS ":"").$G);}function
found_rows($R,$Z){return($Z||$R["Engine"]!="InnoDB"?null:$R["Rows"]);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($eh,$g=null){return
true;}function
create_sql($Q,$La,$Mh){global$f;$I=$f->result("SHOW CREATE TABLE ".table($Q),1);if(!$La)$I=preg_replace('~ AUTO_INCREMENT=\d+~','',$I);return$I;}function
truncate_sql($Q){return"TRUNCATE ".table($Q);}function
use_sql($Sb){return"USE ".idf_escape($Sb);}function
trigger_sql($Q){$I="";foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")),null,"-- ")as$J)$I.="\nCREATE TRIGGER ".idf_escape($J["Trigger"])." $J[Timing] $J[Event] ON ".table($J["Table"])." FOR EACH ROW\n$J[Statement];;\n";return$I;}function
show_variables(){return
get_key_vals("SHOW VARIABLES");}function
process_list(){return
get_rows("SHOW FULL PROCESSLIST");}function
show_status(){return
get_key_vals("SHOW STATUS");}function
convert_field($m){if(preg_match("~binary~",$m["type"]))return"HEX(".idf_escape($m["field"]).")";if($m["type"]=="bit")return"BIN(".idf_escape($m["field"])." + 0)";if(preg_match("~geometry|point|linestring|polygon~",$m["type"]))return(min_version(8)?"ST_":"")."AsWKT(".idf_escape($m["field"]).")";}function
unconvert_field($m,$I){if(preg_match("~binary~",$m["type"]??null))$I="UNHEX($I)";if(isset($m["type"])&&$m["type"]=="bit")$I="CONV($I, 2, 10) + 0";if(preg_match("~geometry|point|linestring|polygon~",$m["type"]??null)){$og=(min_version(8)?"ST_":"");$I=$og."GeomFromText($I, $og"."SRID($m[field]))";}return$I;}function
support($Xc){return!preg_match("~scheme|sequence|type|view_trigger|materializedview".(min_version(8)?"":"|descidx".(min_version(5.1)?"":"|event|partitioning".(min_version(5)?"":"|routine|trigger|view")))."~",$Xc);}function
kill_process($X){return
queries("KILL ".number($X));}function
connection_id(){return"SELECT CONNECTION_ID()";}function
max_connections(){global$f;return$f->result("SELECT @@max_connections");}function
driver_config(){$U=array();$Lh=array();foreach(array('Nombres'=>array("tinyint"=>3,"smallint"=>5,"mediumint"=>8,"int"=>10,"bigint"=>20,"decimal"=>66,"float"=>12,"double"=>21),'Date et heure'=>array("date"=>10,"datetime"=>19,"timestamp"=>19,"time"=>10,"year"=>4),'Chaînes'=>array("char"=>255,"varchar"=>65535,"tinytext"=>255,"text"=>65535,"mediumtext"=>16777215,"longtext"=>4294967295),'Listes'=>array("enum"=>65535,"set"=>64),'Binaires'=>array("bit"=>20,"binary"=>255,"varbinary"=>65535,"tinyblob"=>255,"blob"=>65535,"mediumblob"=>16777215,"longblob"=>4294967295),'Géométrie'=>array("geometry"=>0,"point"=>0,"linestring"=>0,"polygon"=>0,"multipoint"=>0,"multilinestring"=>0,"multipolygon"=>0,"geometrycollection"=>0),)as$x=>$X){$U+=$X;$Lh[$x]=array_keys($X);}return
array('possible_drivers'=>array("MySQLi","MySQL","PDO_MySQL"),'jush'=>"sql",'types'=>$U,'structured_types'=>$Lh,'unsigned'=>array("unsigned","zerofill","unsigned zerofill"),'operators'=>array("=","<",">","<=",">=","!=","LIKE","LIKE %%","REGEXP","IN","FIND_IN_SET","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL"),'functions'=>array("char_length","date","distinct","from_unixtime","unix_timestamp","lower","round","floor","ceil","sec_to_time","time_to_sec","upper"),'operator_regexp'=>'REGEXP','grouping'=>array("avg","count","count distinct","group_concat","max","min","sum"),'edit_functions'=>array(array("char"=>"md5/sha1/password/encrypt/uuid","binary"=>"md5/sha1","date|time"=>"now",),array(number_type()=>"+/-","date"=>"+ interval/- interval","time"=>"addtime/subtime","char|text"=>"concat",)),);}}$xb=driver_config();$ng=$xb['possible_drivers'];$w=$xb['jush'];$U=$xb['types'];$Lh=$xb['structured_types'];$Mi=$xb['unsigned'];$Af=$xb['operators'];$_f=isset($xb['operator_regexp'])&&in_array($xb['operator_regexp'],$Af)?$xb['operator_regexp']:null;$sd=$xb['functions'];$zd=$xb['grouping'];$uc=$xb['edit_functions'];if($b->operators===null){$b->operators=$Af;$b->operator_regexp=$_f;}define("SERVER",$_GET[DRIVER]);define("DB",$_GET["db"]);define("ME",preg_replace('~\?.*~','',relative_uri()).'?'.(sid()?SID.'&':'').(SERVER!==null?DRIVER."=".urlencode(SERVER).'&':'').(isset($_GET["username"])?"username=".urlencode($_GET["username"]).'&':'').(DB!=""?'db='.urlencode(DB).'&'.(isset($_GET["ns"])?"ns=".urlencode($_GET["ns"])."&":""):''));$ia="4.8.4";function
page_header($li,$l="",$Va=array(),$mi=""){global$ca,$ia,$b,$mc,$w;page_headers();if(is_ajax()&&$l){page_messages($l);exit;}$ni=$li.($mi!=""?": $mi":"");$oi=strip_tags($ni.(SERVER!=""&&SERVER!="localhost"?h(" - ".SERVER):"")." - ".$b->name());echo'<!DOCTYPE html>
<html lang="fr" dir="ltr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<title>',$oi,'</title>
<link rel="stylesheet" type="text/css" href="',h(preg_replace("~\\?.*~","",ME)."?file=default.css&version=4.8.4"),'">
',script_src(preg_replace("~\\?.*~","",ME)."?file=functions.js&version=4.8.4");if($b->head()){echo'<link rel="shortcut icon" type="image/x-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.8.4"),'">
<link rel="apple-touch-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.8.4"),'">
';foreach($b->css()as$Nb){echo'<link rel="stylesheet" type="text/css" href="',h($Nb),'">
';}}echo'
<body class="ltr nojs adminer">
';$o=get_temp_dir()."/adminer.version";if(!$_COOKIE["adminer_version"]&&file_exists($o)&&filemtime($o)+86400>time()){$bj=unserialize(file_get_contents($o));$_COOKIE["adminer_version"]=$bj["version"];}echo'<script',nonce(),'>
mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick',(isset($_COOKIE["adminer_version"])?"":", onload: partial(verifyVersion, '$ia', '".js_escape(ME)."', '".get_token()."')");?>});
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = '<?php echo
js_escape('Vous êtes hors ligne.'),'\';
var thousandsSeparator = \'',js_escape(','),'\';
</script>

<div id="help" class="jush-',$w,' jsonly hidden"></div>
',script("mixin(qs('#help'), {onmouseover: function () { helpOpen = 1; }, onmouseout: helpMouseout});"),'
<div id="content">
';if($Va!==null){$z=substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1);echo'<p id="breadcrumb"><a href="'.h($z?$z:".").'">'.$mc[DRIVER].'</a> &raquo; ';$z=substr(preg_replace('~\b(db|ns)=[^&]*&~','',ME),0,-1);$M=$b->serverName(SERVER);$M=($M!=""?$M:'Serveur');if($Va===false)echo"$M\n";else{echo"<a href='".h($z)."' accesskey='1' title='Alt+Shift+1'>$M</a> &raquo; ";if($_GET["ns"]!=""||(DB!=""&&is_array($Va)))echo'<a href="'.h($z."&db=".urlencode(DB).(support("scheme")?"&ns=":"")).'">'.h(DB).'</a> &raquo; ';if(is_array($Va)){if($_GET["ns"]!="")echo'<a href="'.h(substr(ME,0,-1)).'">'.h($_GET["ns"]).'</a> &raquo; ';foreach($Va
as$x=>$X){$fc=(is_array($X)?$X[1]:h($X));if($fc!="")echo"<a href='".h(ME."$x=").urlencode(is_array($X)?$X[0]:$X)."'>$fc</a> &raquo; ";}}echo"$li\n";}}echo"<h2>$ni</h2>\n","<div id='ajaxstatus' class='jsonly hidden'></div>\n";restart_session();page_messages($l);$i=&get_session("dbs");if(DB!=""&&$i&&!in_array(DB,$i,true))$i=null;stop_session();define("PAGE_HEADER",1);}function
page_headers(){global$b;header("Content-Type: text/html; charset=utf-8");header("Cache-Control: no-cache");header("X-Frame-Options: deny");header("X-XSS-Protection: 0");header("X-Content-Type-Options: nosniff");header("Referrer-Policy: origin-when-cross-origin");foreach($b->csp()as$Mb){$Ed=array();foreach($Mb
as$x=>$X)$Ed[]="$x $X";header("Content-Security-Policy: ".implode("; ",$Ed));}$b->headers();}function
csp(){return
array(array("script-src"=>"'self' 'unsafe-inline' 'nonce-".get_nonce()."' 'strict-dynamic'","connect-src"=>"'self' https://api.github.com/repos/adminerevo/adminerevo/releases/latest","frame-src"=>"'self'","object-src"=>"'none'","base-uri"=>"'none'","form-action"=>"'self'",),);}function
get_nonce(){static$hf;if(!$hf)$hf=base64_encode(rand_string());return$hf;}function
page_messages($l){$Oi=preg_replace('~^[^?]*~','',$_SERVER["REQUEST_URI"]);$Ue=[];if(isset($_SESSION["messages"][$Oi]))$Ue=$_SESSION["messages"][$Oi];if(count($Ue)>0){echo"<div class='message'>".implode("</div>\n<div class='message'>",$Ue)."</div>".script("messagesPrint();");unset($_SESSION["messages"][$Oi]);}if($l)echo"<div class='error'>$l</div>\n";}function
page_footer($Xe=""){global$b,$si;echo'</div>

';if($Xe!="auth"){echo'<form action="" method="post">
<p class="logout">
<input type="submit" name="logout" value="Déconnexion" id="logout">
<input type="hidden" name="token" value="',$si,'">
</p>
</form>
';}echo'<div id="menu">
';$b->navigation($Xe);echo'</div>
',script("setupSubmitHighlight(document);"),script("setupCopyToClipboard(document);"),"</body>\n</html>";}function
int32($af){while($af>=2147483648)$af-=4294967296;while($af<=-2147483649)$af+=4294967296;return(int)$af;}function
long2str($W,$fj){$ch='';foreach($W
as$X)$ch.=pack('V',$X);if($fj)return
substr($ch,0,end($W));return$ch;}function
str2long($ch,$fj){$W=array_values(unpack('V*',str_pad($ch,4*ceil(strlen($ch)/4),"\0")));if($fj)$W[]=strlen($ch);return$W;}function
xxtea_mx($rj,$qj,$Ph,$le){return
int32((($rj>>5&0x7FFFFFF)^$qj<<2)+(($qj>>3&0x1FFFFFFF)^$rj<<4))^int32(($Ph^$qj)+($le^$rj));}function
encrypt_string($Kh,$x){if($Kh=="")return"";$x=array_values(unpack("V*",pack("H*",md5($x))));$W=str2long($Kh,true);$af=count($W)-1;$rj=$W[$af];$qj=$W[0];$zg=floor(6+52/($af+1));$Ph=0;while($zg-->0){$Ph=int32($Ph+0x9E3779B9);$tc=$Ph>>2&3;for($Rf=0;$Rf<$af;$Rf++){$qj=$W[$Rf+1];$Ze=xxtea_mx($rj,$qj,$Ph,$x[$Rf&3^$tc]);$rj=int32($W[$Rf]+$Ze);$W[$Rf]=$rj;}$qj=$W[0];$Ze=xxtea_mx($rj,$qj,$Ph,$x[$Rf&3^$tc]);$rj=int32($W[$af]+$Ze);$W[$af]=$rj;}return
long2str($W,false);}function
decrypt_string($Kh,$x){if($Kh=="")return"";if(!$x)return
false;$x=array_values(unpack("V*",pack("H*",md5($x))));$W=str2long($Kh,false);$af=count($W)-1;$rj=$W[$af];$qj=$W[0];$zg=floor(6+52/($af+1));$Ph=int32($zg*0x9E3779B9);while($Ph){$tc=$Ph>>2&3;for($Rf=$af;$Rf>0;$Rf--){$rj=$W[$Rf-1];$Ze=xxtea_mx($rj,$qj,$Ph,$x[$Rf&3^$tc]);$qj=int32($W[$Rf]-$Ze);$W[$Rf]=$qj;}$rj=$W[$af];$Ze=xxtea_mx($rj,$qj,$Ph,$x[$Rf&3^$tc]);$qj=int32($W[0]-$Ze);$W[0]=$qj;$Ph=int32($Ph-0x9E3779B9);}return
long2str($W,true);}$f='';$Dd=$_SESSION["token"];if(!$Dd)$_SESSION["token"]=rand(1,1e6);$si=get_token();$hg=array();if($_COOKIE["adminer_permanent"]){foreach(explode(" ",$_COOKIE["adminer_permanent"])as$X){list($x)=explode(":",$X);$hg[$x]=$X;}}function
validate_server_input(){if(SERVER=="")return;$bg=parse_url(SERVER);if(!$bg)auth_error('Invalid server or credentials.');if(isset($bg['user'])||isset($bg['pass'])||isset($bg['query'])||isset($bg['fragment']))auth_error('Invalid server or credentials.');if(isset($bg['scheme'])&&!preg_match('~^(https?)$~i',$bg['scheme']))auth_error('Invalid server or credentials.');$Jd=(isset($bg['host'])?$bg['host']:'').(isset($bg['path'])?$bg['path']:'');if(strpos(rtrim($Jd,'/'),'/')!==false)auth_error('Invalid server or credentials.');if(isset($bg['port'])&&($bg['port']<1024||$bg['port']>65535))auth_error('La connexion aux ports privilégiés n\'est pas autorisée.');}function
build_http_url($M,$V,$F,$ac,$Zb=null){if(!preg_match('~^(https?://)?([^:]*)(:\d+)?$~',rtrim($M,'/'),$Ie)){$this->error='Invalid server or credentials.';return
false;}return($Ie[1]?:"http://").($V!==""||$F!==""?"$V:$F@":"").($Ie[2]!==""?$Ie[2]:$ac).(isset($Ie[3])?$Ie[3]:($Zb?":$Zb":""));}function
add_invalid_login(){global$b;$qd=file_open_lock(get_temp_dir()."/adminer.invalid");if(!$qd)return;$ee=unserialize(stream_get_contents($qd));$ii=time();if($ee){foreach($ee
as$fe=>$X){if($X[0]<$ii)unset($ee[$fe]);}}$de=&$ee[$b->bruteForceKey()];if(!$de)$de=array($ii+30*60,0);$de[1]++;file_write_unlock($qd,serialize($ee));}function
check_invalid_login(){global$b;$ee=unserialize(@file_get_contents(get_temp_dir()."/adminer.invalid"));$de=($ee?$ee[$b->bruteForceKey()]:array());if($de===null)return;$gf=($de[1]>29?$de[0]-time():0);if($gf>0)auth_error(lang(array('Trop de connexions échouées, essayez à nouveau dans %d minute.','Trop de connexions échouées, essayez à nouveau dans %d minutes.'),ceil($gf/60)));}$Ja=$_POST["auth"];if($Ja){session_regenerate_id();$aj=$Ja["driver"];$M=trim($Ja["server"]);$V=$Ja["username"];$F=(string)$Ja["password"];$j=$Ja["db"];set_password($aj,$M,$V,$F);$_SESSION["db"][$aj][$M][$V][$j]=true;if($Ja["permanent"]){$x=base64_encode($aj)."-".base64_encode($M)."-".base64_encode($V)."-".base64_encode($j);$tg=$b->permanentLogin(true);$hg[$x]="$x:".base64_encode($tg?encrypt_string($F,$tg):"");cookie("adminer_permanent",implode(" ",$hg));}if(count($_POST)==1||DRIVER!=$aj||SERVER!=$M||$_GET["username"]!==$V||DB!=$j)redirect(auth_url($aj,$M,$V,$j));}elseif($_POST["logout"]&&(!$Dd||verify_token())){foreach(array("pwds","db","dbs","queries")as$x)set_session($x,null);unset_permanent();redirect(substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1),'Au revoir !');}elseif($hg&&!$_SESSION["pwds"]){session_regenerate_id();$tg=$b->permanentLogin();foreach($hg
as$x=>$X){list(,$gb)=explode(":",$X);list($aj,$M,$V,$j)=array_map('base64_decode',explode("-",$x));set_password($aj,$M,$V,decrypt_string(base64_decode($gb),$tg));$_SESSION["db"][$aj][$M][$V][$j]=true;}}function
unset_permanent(){global$hg;foreach($hg
as$x=>$X){list($aj,$M,$V,$j)=array_map('base64_decode',explode("-",$x));if($aj==DRIVER&&$M==SERVER&&$V==$_GET["username"]&&$j==DB)unset($hg[$x]);}cookie("adminer_permanent",implode(" ",$hg));}function
auth_error($l){global$b,$Dd;$rh=session_name();if(isset($_GET["username"])){header("HTTP/1.1 403 Forbidden");if(($_COOKIE[$rh]||$_GET[$rh])&&!$Dd)$l='Session expirée, veuillez vous authentifier à nouveau.';else{restart_session();add_invalid_login();$F=get_password();if($F!==null){if($F===false)$l.=($l?'<br>':'').sprintf('Le mot de passe a expiré. <a href="https://www.adminer.org/en/extension/"%s>Implémentez</a> la méthode %s afin de le rendre permanent.',target_blank(),'<code>permanentLogin()</code>');set_password(DRIVER,SERVER,$_GET["username"],null);}unset_permanent();}}if(!$_COOKIE[$rh]&&$_GET[$rh]&&ini_bool("session.use_only_cookies"))$l='Veuillez activer les sessions.';$Uf=session_get_cookie_params();cookie("adminer_key",($_COOKIE["adminer_key"]?$_COOKIE["adminer_key"]:rand_string()),$Uf["lifetime"]);page_header('Authentification',$l,null);echo"<form action='' method='post'>\n","<div>";if(hidden_fields($_POST,array("auth")))echo"<p class='message'>".'Cette action sera exécutée après s\'être connecté avec les mêmes données de connexion.'."\n";echo"</div>\n";$b->loginForm();echo"</form>\n";page_footer("auth");exit;}if(isset($_GET["username"])&&!class_exists("Min_DB")){unset($_SESSION["pwds"][DRIVER]);unset_permanent();page_header('Extension introuvable',sprintf('Aucune des extensions PHP supportées (%s) n\'est disponible.',implode(", ",$ng)),false);page_footer("auth");exit;}stop_session(true);if(isset($_GET["username"])&&is_string(get_password())){validate_server_input();check_invalid_login();$f=connect();$k=new
Min_Driver($f);}$Ce=null;if(!is_object($f)||($Ce=$b->login($_GET["username"],get_password()))!==true){$l=(is_string($f)?h($f):(is_string($Ce)?$Ce:'Invalid server or credentials.'));auth_error($l.(preg_match('~^ | $~',get_password())?'<br>'.'Il y a un espace dans le mot de passe entré qui pourrait en être la cause.':''));}if($_POST["logout"]&&$Dd&&!verify_token()){page_header('Déconnexion','Token CSRF invalide. Veuillez renvoyer le formulaire.');page_footer("db");exit;}if($Ja&&$_POST["token"])$_POST["token"]=$si;$l='';if($_POST){if(!verify_token()){$Yd="max_input_vars";$Oe=ini_get($Yd);if(extension_loaded("suhosin")){foreach(array("suhosin.request.max_vars","suhosin.post.max_vars")as$x){$X=ini_get($x);if($X&&(!$Oe||$X<$Oe)){$Yd=$x;$Oe=$X;}}}$l=(!$_POST["token"]&&$Oe?sprintf('Le nombre maximum de champs est dépassé. Veuillez augmenter %s.',"'$Yd'"):'Token CSRF invalide. Veuillez renvoyer le formulaire.'.' '.'Si vous n\'avez pas envoyé cette requête depuis Adminer, alors fermez cette page.');}}elseif($_SERVER["REQUEST_METHOD"]=="POST"){$l=sprintf('Données POST trop grandes. Réduisez la taille des données ou augmentez la valeur de %s dans la configuration de PHP.',"'post_max_size'");if(isset($_GET["sql"]))$l.=' '.'Vous pouvez uploader un gros fichier SQL par FTP et ensuite l\'importer depuis le serveur.';}function
select($H,$g=null,$Hf=array(),$y=0){global$w;$_=array();$v=array();$e=array();$Ta=array();$U=array();$I=array();odd('');for($r=0;(!$y||$r<$y)&&($J=$H->fetch_row());$r++){if(!$r){echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap'>\n","<thead><tr>";for($ke=0;$ke<count($J);$ke++){$m=$H->fetch_field();$C=$m->name;$Gf=$m->orgtable;$Ff=$m->orgname;$I[$m->table]=$Gf;if($Hf&&$w=="sql")$_[$ke]=($C=="table"?"table=":($C=="possible_keys"?"indexes=":null));elseif($Gf!=""){if(!isset($v[$Gf])){$v[$Gf]=array();foreach(indexes($Gf,$g)as$u){if($u["type"]=="PRIMARY"){$v[$Gf]=array_flip($u["columns"]);break;}}$e[$Gf]=$v[$Gf];}if(isset($e[$Gf][$Ff])){unset($e[$Gf][$Ff]);$v[$Gf][$Ff]=$ke;$_[$ke]=$Gf;}}if($m->charsetnr==63)$Ta[$ke]=true;$U[$ke]=$m->type;echo"<th".($Gf!=""||$m->name!=$Ff?" title='".h(($Gf!=""?"$Gf.":"").$Ff)."'":"").">".h($C).($Hf?doc_link(array('sql'=>"explain-output.html#explain_".strtolower($C),'mariadb'=>"explain/#the-columns-in-explain-select",)):"");}echo"</thead>\n";}echo"<tr".odd().">";foreach($J
as$x=>$X){$z="";if(isset($_[$x])&&!$e[$_[$x]]){if($Hf&&$w=="sql"){$Q=$J[array_search("table=",$_)];$z=ME.$_[$x].urlencode($Hf[$Q]!=""?$Hf[$Q]:$Q);}else{$z=ME."edit=".urlencode($_[$x]);foreach($v[$_[$x]]as$kb=>$ke)$z.="&where".urlencode("[".bracket_escape($kb)."]")."=".urlencode($J[$ke]);}}elseif(is_url($X))$z=$X;if($X===null)$X="<i>NULL</i>";elseif($Ta[$x]&&!is_utf8($X))$X="<i>".lang(array('%d octet','%d octets'),strlen($X))."</i>";else{$X=h($X);if($U[$x]==254)$X="<code>$X</code>";}if($z)$X="<a href='".h($z)."'".(is_url($z)?target_blank():'').">$X</a>";echo"<td>$X";}}echo($r?"</table>\n</div>":"<p class='message'>".'Aucun résultat.')."\n";return$I;}function
referencable_primary($kh){$I=array();foreach(table_status('',true)as$Th=>$Q){if($Th!=$kh&&fk_support($Q)){foreach(fields($Th)as$m){if($m["primary"]){if($I[$Th]){unset($I[$Th]);break;}$I[$Th]=$m;}}}}return$I;}function
adminer_settings(){parse_str($_COOKIE["adminer_settings"],$th);return$th;}function
adminer_setting($x){$th=adminer_settings();return$th[$x];}function
set_adminer_settings($th){return
cookie("adminer_settings",http_build_query($th+adminer_settings()));}function
textarea($C,$Y,$K=10,$pb=80){global$w;echo"<textarea name='".h($C)."' rows='$K' cols='$pb' class='sqlarea jush-$w' spellcheck='false' wrap='off'>";if(is_array($Y)){foreach($Y
as$X)echo
h($X[0])."\n\n\n";}else
echo
h($Y);echo"</textarea>";}function
edit_type($x,$m,$nb,$md=array(),$Tc=array()){global$Lh,$U,$Mi,$vf;$T=$m["type"];echo'<td><select name="',h($x),'[type]" class="type" aria-labelledby="label-type">';if($T&&!isset($U[$T])&&!isset($md[$T])&&!in_array($T,$Tc))$Tc[]=$T;if($md)$Lh['Clés étrangères']=$md;echo
optionlist(array_merge($Tc,$Lh),$T),'</select><td><input name="',h($x),'[length]" value="',h($m["length"]),'" size="3"',(!$m["length"]&&preg_match('~var(char|binary)$~',$T)?" class='required'":"");echo' aria-labelledby="label-length"><td class="options">',"<select name='".h($x)."[collation]'".(preg_match('~(char|text|enum|set)$~',$T)?"":" class='hidden'").'><option value="">('.'interclassement'.')'.optionlist($nb,$m["collation"]).'</select>',($Mi?"<select name='".h($x)."[unsigned]'".(!$T||preg_match(number_type(),$T)?"":" class='hidden'").'><option>'.optionlist($Mi,$m["unsigned"]).'</select>':''),(isset($m['on_update'])?"<select name='".h($x)."[on_update]'".(preg_match('~timestamp|datetime~',$T)?"":" class='hidden'").'>'.optionlist(array(""=>"(".'ON UPDATE'.")","CURRENT_TIMESTAMP"),(preg_match('~^CURRENT_TIMESTAMP~i',$m["on_update"])?"CURRENT_TIMESTAMP":$m["on_update"])).'</select>':''),($md?"<select name='".h($x)."[on_delete]'".(preg_match("~`~",$T)?"":" class='hidden'")."><option value=''>(".'ON DELETE'.")".optionlist(explode("|",$vf),$m["on_delete"])."</select> ":" ");}function
process_length($ze){global$Dc;return(preg_match("~^\\s*\\(?\\s*$Dc(?:\\s*,\\s*$Dc)*+\\s*\\)?\\s*\$~",$ze)&&preg_match_all("~$Dc~",$ze,$Ie)?"(".implode(",",$Ie[0]).")":preg_replace('~^[0-9].*~','(\0)',preg_replace('~[^-0-9,+()[\]]~','',$ze)));}function
process_type($m,$lb="COLLATE"){global$Mi;if(DRIVER==='server'&&($m['unsigned']==='unsigned'||stripos((string)$m['type'],'int')!==false)&&min_version(8))$m["length"]='';return" $m[type]".process_length($m["length"]).(preg_match(number_type(),$m["type"])&&in_array($m["unsigned"],$Mi)?" $m[unsigned]":"").(preg_match('~char|text|enum|set~',$m["type"])&&$m["collation"]?" $lb ".q($m["collation"]):"");}function
process_field($m,$Ei){return
array(idf_escape(trim($m["field"])),process_type($Ei),($m["null"]?" NULL":" NOT NULL"),default_value($m),(preg_match('~timestamp|datetime~',$m["type"])&&$m["on_update"]?" ON UPDATE $m[on_update]":""),(support("comment")&&$m["comment"]!=""?" COMMENT ".q($m["comment"]):""),($m["auto_increment"]?auto_increment():null),);}function
default_value($m){$Yb=$m["default"];return($Yb===null?"":" DEFAULT ".(preg_match('~char|binary|text|enum|set~',$m["type"])||preg_match('~^(?![a-z])~i',$Yb)?q($Yb):$Yb));}function
type_class($T){foreach(array('char'=>'text','date'=>'time|year','binary'=>'blob','enum'=>'set',)as$x=>$X){if(preg_match("~$x|$X~",$T))return" class='$x'";}}function
edit_fields($n,$nb,$T="TABLE",$md=array()){global$Zd;$n=array_values($n);$bc=(($_POST?$_POST["defaults"]:adminer_setting("defaults"))?"":" class='hidden'");$ub=(($_POST?$_POST["comments"]:adminer_setting("comments"))?"":" class='hidden'");echo'<thead><tr>
';if($T=="PROCEDURE"){echo'<td>';}echo'<th id="label-name">',($T=="TABLE"?'Nom de la colonne':'Nom du paramètre'),'<td id="label-type">Type<textarea id="enum-edit" rows="4" cols="12" wrap="off" style="display: none;"></textarea>',script("qs('#enum-edit').onblur = editingLengthBlur;"),'<td id="label-length">Longueur
<td>','Options';if($T=="TABLE"){echo'<td id="label-null">NULL
<td><input type="radio" name="auto_increment_col" value=""><acronym id="label-ai" title="Incrément automatique">AI</acronym>',doc_link(array('sql'=>"example-auto-increment.html",'mariadb'=>"auto_increment/",'sqlite'=>"autoinc.html",'pgsql'=>"datatype.html#DATATYPE-SERIAL",'mssql'=>"ms186775.aspx",)),'<td id="label-default"',$bc,'>Valeur par défaut
',(support("comment")?"<td id='label-comment'$ub>".'Commentaire':"");}echo'<td>',"<input type='image' class='icon' name='add[".(support("move_col")?0:count($n))."]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.8.4")."' alt='+' title='".'Ajouter le prochain'."'>".script("row_count = ".count($n).";"),'</thead>
<tbody>
',script("mixin(qsl('tbody'), {onclick: editingClick, onkeydown: editingKeydown, oninput: editingInput});");foreach($n
as$r=>$m){$r++;$If=$m[($_POST?"orig":"field")];$jc=(isset($_POST["add"][$r-1])||(isset($m["field"])&&isset($_POST["drop_col"][$r])===false))&&(support("drop_col")||$If=="");echo'<tr',($jc?"":" style='display: none;'"),'>
',($T=="PROCEDURE"?"<td>".html_select("fields[$r][inout]",explode("|",$Zd),$m["inout"]):""),'<th>';if($jc){echo'<input name="fields[',$r,'][field]" value="',h($m["field"]),'" data-maxlength="64" autocapitalize="off" aria-labelledby="label-name">';}echo'<input type="hidden" name="fields[',$r,'][orig]" value="',h($If),'">';edit_type("fields[$r]",$m,$nb,$md);if($T=="TABLE"){echo'<td>',checkbox("fields[$r][null]",1,$m["null"],"","","block","label-null"),'<td><label class="block"><input type="radio" name="auto_increment_col" value="',$r,'"';if($m["auto_increment"]){echo' checked';}echo' aria-labelledby="label-ai"></label><td',$bc,'>',checkbox("fields[$r][has_default]",1,$m["has_default"],"","","","label-default"),'<input name="fields[',$r,'][default]" value="',h($m["default"]),'" aria-labelledby="label-default">',(support("comment")?"<td$ub><input name='fields[$r][comment]' value='".h($m["comment"])."' data-maxlength='".(min_version(5.5)?1024:255)."' aria-labelledby='label-comment'>":"");}echo"<td>",(support("move_col")?"<input type='image' class='icon' name='add[$r]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.8.4")."' alt='+' title='".'Ajouter le prochain'."'> "."<input type='image' class='icon' name='up[$r]' src='".h(preg_replace("~\\?.*~","",ME)."?file=up.gif&version=4.8.4")."' alt='↑' title='".'Déplacer vers le haut'."'> "."<input type='image' class='icon' name='down[$r]' src='".h(preg_replace("~\\?.*~","",ME)."?file=down.gif&version=4.8.4")."' alt='↓' title='".'Déplacer vers le bas'."'> ":""),($If==""||support("drop_col")?"<input type='image' class='icon' name='drop_col[$r]' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.8.4")."' alt='x' title='".'Effacer'."'>":"");}}function
process_fields(&$n){$nf=0;if($_POST["up"]){$te=0;foreach($n
as$x=>$m){if(key($_POST["up"])==$x){unset($n[$x]);array_splice($n,$te,0,array($m));break;}if(isset($m["field"]))$te=$nf;$nf++;}}elseif($_POST["down"]){$od=false;foreach($n
as$x=>$m){if(isset($m["field"])&&$od){unset($n[key($_POST["down"])]);array_splice($n,$nf,0,array($od));break;}if(key($_POST["down"])==$x)$od=$m;$nf++;}}elseif($_POST["add"]){$n=array_values($n);array_splice($n,key($_POST["add"]),0,array(array()));}elseif(!$_POST["drop_col"])return
false;return
true;}function
normalize_enum($B){return"'".str_replace("'","''",addcslashes(stripcslashes(str_replace($B[0][0].$B[0][0],$B[0][0],substr($B[0],1,-1))),'\\'))."'";}function
grant($ud,$vg,$e,$uf){if(!$vg)return
true;if($vg==array("ALL PRIVILEGES","GRANT OPTION"))return($ud=="GRANT"?queries("$ud ALL PRIVILEGES$uf WITH GRANT OPTION"):queries("$ud ALL PRIVILEGES$uf")&&queries("$ud GRANT OPTION$uf"));return
queries("$ud ".preg_replace('~(GRANT OPTION)\([^)]*\)~','\1',implode("$e, ",$vg).$e).$uf);}function
drop_create($nc,$h,$oc,$fi,$qc,$A,$Te,$Re,$Se,$rf,$ef){if($_POST["drop"])query_redirect($nc,$A,$Te);elseif($rf=="")query_redirect($h,$A,$Se);elseif($rf!=$ef){$Kb=queries($h);queries_redirect($A,$Re,$Kb&&queries($nc));if($Kb)queries($oc);}else
queries_redirect($A,$Re,queries($fi)&&queries($qc)&&queries($nc)&&queries($h));}function
create_trigger($uf,$J){global$w;$ki=" $J[Timing] $J[Event]".(preg_match('~ OF~',$J["Event"])?" $J[Of]":"");return"CREATE TRIGGER ".idf_escape($J["Trigger"]).($w=="mssql"?$uf.$ki:$ki.$uf).rtrim(" $J[Type]\n$J[Statement]",";").";";}function
create_routine($Yg,$J){global$Zd,$w;$N=array();$n=(array)$J["fields"];ksort($n);foreach($n
as$m){if($m["field"]!="")$N[]=(preg_match("~^($Zd)\$~",$m["inout"])?"$m[inout] ":"").idf_escape($m["field"]).process_type($m,"CHARACTER SET");}$cc=rtrim("\n$J[definition]",";");return"CREATE $Yg ".idf_escape(trim($J["name"]))." (".implode(", ",$N).")".(isset($_GET["function"])?" RETURNS".process_type($J["returns"],"CHARACTER SET"):"").($J["language"]?" LANGUAGE $J[language]":"").($w=="pgsql"?" AS ".q($cc):"$cc;");}function
remove_definer($G){return
preg_replace('~^([A-Z =]+) DEFINER=`'.preg_replace('~@(.*)~','`@`(%|\1)',logged_user()).'`~','\1',$G);}function
format_foreign_key($p){global$vf;$j=$p["db"];$if=$p["ns"];return" FOREIGN KEY (".implode(", ",array_map('idf_escape',$p["source"])).") REFERENCES ".($j!=""&&$j!=$_GET["db"]?idf_escape($j).".":"").($if!=""&&$if!=$_GET["ns"]?idf_escape($if).".":"").table($p["table"])." (".implode(", ",array_map('idf_escape',$p["target"])).")".(preg_match("~^($vf)\$~",$p["on_delete"])?" ON DELETE $p[on_delete]":"").(preg_match("~^($vf)\$~",$p["on_update"])?" ON UPDATE $p[on_update]":"");}function
tar_file($o,$pi){$I=pack("a100a8a8a8a12a12",$o,644,0,0,decoct($pi->size),decoct(time()));$fb=8*32;for($r=0;$r<strlen($I);$r++)$fb+=ord($I[$r]);$I.=sprintf("%06o",$fb)."\0 ";echo$I,str_repeat("\0",512-strlen($I));$pi->send();echo
str_repeat("\0",511-($pi->size+511)%512);}function
ini_bytes($Yd){$X=ini_get($Yd);switch(strtolower(substr($X,-1))){case'g':$X*=1024;case'm':$X*=1024;case'k':$X*=1024;}return$X;}function
doc_link($eg,$gi="<sup>?</sup>"){global$w,$f;$ph=$f->server_info;$bj=preg_replace('~^(\d\.?\d).*~s','\1',$ph);$Qi=array('sql'=>"https://dev.mysql.com/doc/refman/$bj/en/",'sqlite'=>"https://www.sqlite.org/",'pgsql'=>"https://www.postgresql.org/docs/$bj/",'mssql'=>"https://msdn.microsoft.com/library/",'oracle'=>"https://www.oracle.com/pls/topic/lookup?ctx=db".preg_replace('~^.* (\d+)\.(\d+)\.\d+\.\d+\.\d+.*~s','\1\2',$ph)."&id=",);if(preg_match('~MariaDB~',$ph)){$Qi['sql']="https://mariadb.com/kb/en/library/";$eg['sql']=(isset($eg['mariadb'])?$eg['mariadb']:str_replace(".html","/",$eg['sql']));}return($eg[$w]?"<a href='".h($Qi[$w].$eg[$w])."'".target_blank().">$gi</a>":"");}function
ob_gzencode($P){return
gzencode($P);}function
db_size($j){global$f;if(!$f->select_db($j))return"?";$I=0;foreach(table_status()as$R)$I+=$R["Data_length"]+$R["Index_length"];return
format_number($I);}function
set_utf8mb4($h){global$f;static$N=false;if(!$N&&preg_match('~\butf8mb4~i',$h)){$N=true;echo"SET NAMES ".charset($f).";\n\n";}}function
connect_error(){global$b,$f,$si,$l,$mc;if(DB!=""){header("HTTP/1.1 404 Not Found");page_header('Base de données'.": ".h(DB),'Base de données invalide.',true);}else{if($_POST["db"]&&!$l)queries_redirect(substr(ME,0,-1),'Les bases de données ont été supprimées.',drop_databases($_POST["db"]));page_header('Sélectionner la base de données',$l,false);$wa=['database'=>'Créer une base de données','privileges'=>'Privilèges','processlist'=>'Liste des processus','variables'=>'Variables','status'=>'Statut',];$_=[];foreach($wa
as$x=>$X){if(support($x))$_[]="<a href='".h(ME)."$x='>$X</a>";}echo
generate_linksbar($_),"<p>".sprintf('Version de %s : %s via l\'extension PHP %s',$mc[DRIVER],"<b>".h($f->server_info)."</b>","<b>$f->extension</b>")."\n","<p>".sprintf('Authentifié en tant que : %s',"<b>".h(logged_user())."</b>")."\n";$i=$b->databases();if($i){$fh=support("scheme");$nb=collations();echo"<form action='' method='post'>\n","<table cellspacing='0' class='checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),"<thead><tr>".(support("database")?"<td>":"")."<th>".'Base de données'." - <a href='".h(ME)."refresh=1'>".'Rafraîchir'."</a>"."<td>".'Interclassement'."<td>".'Tables'."<td>".'Taille'." - <a href='".h(ME)."dbsize=1'>".'Calcul'."</a>".script("qsl('a').onclick = partial(ajaxSetHtml, '".js_escape(ME)."script=connect');","")."</thead>\n";$i=($_GET["dbsize"]?count_tables($i):array_flip($i));foreach($i
as$j=>$S){$Xg=h(ME)."db=".urlencode($j);$s=h("Db-".$j);echo"<tr".odd().">".(support("database")?"<td>".checkbox("db[]",$j,in_array($j,(array)$_POST["db"]),"","","",$s):""),"<th><a href='$Xg' id='$s'>".h($j)."</a>";$mb=h(db_collation($j,$nb));echo"<td>".(support("database")?"<a href='$Xg".($fh?"&amp;ns=":"")."&amp;database=' title='".'Modifier la base de données'."'>$mb</a>":$mb),"<td align='right'><a href='$Xg&amp;schema=' id='tables-".h($j)."' title='".'Schéma de la base de données'."'>".($_GET["dbsize"]?$S:"?")."</a>","<td align='right' id='size-".h($j)."'>".($_GET["dbsize"]?db_size($j):"?"),"\n";}echo"</table>\n",(support("database")?"<div class='footer'><div>\n"."<fieldset><legend>".'Sélectionnée(s)'." <span id='selected'></span></legend><div>\n"."<input type='hidden' name='all' value=''>".script("qsl('input').onclick = function () { selectCount('selected', formChecked(this, /^db/)); };")."<input type='submit' name='drop' value='".'Supprimer'."'>".confirm()."\n"."</div></fieldset>\n"."</div></div>\n":""),"<input type='hidden' name='token' value='$si'>\n","</form>\n",script("tableCheck();");}}page_footer("db");}if(isset($_GET["status"]))$_GET["variables"]=$_GET["status"];if(isset($_GET["import"]))$_GET["sql"]=$_GET["import"];if(!(DB!=""?$f->select_db(DB):isset($_GET["sql"])||isset($_GET["dump"])||isset($_GET["database"])||isset($_GET["processlist"])||isset($_GET["privileges"])||isset($_GET["user"])||isset($_GET["variables"])||$_GET["script"]=="connect"||$_GET["script"]=="kill")){if(DB!=""||$_GET["refresh"]){restart_session();set_session("dbs",null);}connect_error();exit;}if(support("scheme")){if(DB!=""&&$_GET["ns"]!==""){if(!isset($_GET["ns"]))redirect(preg_replace('~ns=[^&]*&~','',ME)."ns=".get_schema());if(!set_schema($_GET["ns"])){header("HTTP/1.1 404 Not Found");page_header('Schéma'.": ".h($_GET["ns"]),'Schéma invalide.',true);page_footer("ns");exit;}}}$vf="RESTRICT|NO ACTION|CASCADE|SET NULL|SET DEFAULT";class
TmpFile{var$handler;var$size;function
__construct(){$this->handler=tmpfile();}function
write($Db){$this->size+=strlen($Db);fwrite($this->handler,$Db);}function
send(){fseek($this->handler,0);fpassthru($this->handler);fclose($this->handler);}}$Dc="'(?:''|[^'\\\\]|\\\\.)*'";$Zd="IN|OUT|INOUT";if(isset($_GET["select"])&&($_POST["edit"]||$_POST["clone"])&&!$_POST["save"])$_GET["edit"]=$_GET["select"];if(isset($_GET["callf"]))$_GET["call"]=$_GET["callf"];if(isset($_GET["function"]))$_GET["procedure"]=$_GET["function"];if(isset($_GET["download"])){$a=$_GET["download"];$n=fields($a);header("Content-Type: application/octet-stream");header("Content-Disposition: attachment; filename=".friendly_url("$a-".implode("_",$_GET["where"])).".".friendly_url($_GET["field"]));$L=array(idf_escape($_GET["field"]));$H=$k->select($a,$L,array(where($_GET,$n)),$L);$J=($H?$H->fetch_row():array());echo$k->value($J[0],$n[$_GET["field"]]);exit;}elseif(isset($_GET["table"])){$a=$_GET["table"];$n=fields($a);if(!$n)$l=error();$R=table_status1($a,true);$C=$b->tableName($R);page_header(($n&&is_view($R)?$R['Engine']=='materialized view'?'Vue matérialisée':'Vue':'Table').": ".($C!=""?$C:h($a)),$l);$b->selectLinks($R);$tb=$R["Comment"];if($tb!="")echo"<p class='nowrap'>".'Commentaire'.": ".h($tb)."\n";if($n)$b->tableStructurePrint($n);if(!is_view($R)){if(support("indexes")){echo"<h3 id='indexes'>".'Index'."</h3>\n";$v=indexes($a);if($v)$b->tableIndexesPrint($v);echo'<p class="links"><a href="'.h(ME).'indexes='.urlencode($a).'">'.'Modifier les index'."</a>\n";}if(fk_support($R)){echo"<h3 id='foreign-keys'>".'Clés étrangères'."</h3>\n";$md=foreign_keys($a);if($md){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Source'."<td>".'Cible'."<td>".'ON DELETE'."<td>".'ON UPDATE'."<td></thead>\n";foreach($md
as$C=>$p){echo"<tr title='".h($C)."'>","<th><i>".implode("</i>, <i>",array_map('h',$p["source"]))."</i>","<td><a href='".h($p["db"]!=""?preg_replace('~db=[^&]*~',"db=".urlencode($p["db"]),ME):($p["ns"]!=""?preg_replace('~ns=[^&]*~',"ns=".urlencode($p["ns"]),ME):ME))."table=".urlencode($p["table"])."'>".($p["db"]!=""?"<b>".h($p["db"])."</b>.":"").($p["ns"]!=""?"<b>".h($p["ns"])."</b>.":"").h($p["table"])."</a>","(<i>".implode("</i>, <i>",array_map('h',$p["target"]))."</i>)","<td>".h($p["on_delete"])."\n","<td>".h($p["on_update"])."\n",'<td><a href="'.h(ME.'foreign='.urlencode($a).'&name='.urlencode($C)).'">'.'Modifier'.'</a>';}echo"</table>\n";}echo'<p class="links"><a href="'.h(ME).'foreign='.urlencode($a).'">'.'Ajouter une clé étrangère'."</a>\n";}}if(support(is_view($R)?"view_trigger":"trigger")){echo"<h3 id='triggers'>".'Déclencheurs'."</h3>\n";$Di=triggers($a);if($Di){echo"<table cellspacing='0'>\n";foreach($Di
as$x=>$X)echo"<tr valign='top'><td>".h($X[0])."<td>".h($X[1])."<th>".h($x)."<td><a href='".h(ME.'trigger='.urlencode($a).'&name='.urlencode($x))."'>".'Modifier'."</a>\n";echo"</table>\n";}echo'<p class="links"><a href="'.h(ME).'trigger='.urlencode($a).'">'.'Ajouter un déclencheur'."</a>\n";}}elseif(isset($_GET["schema"])){page_header('Schéma de la base de données',"",array(),h(DB.($_GET["ns"]?".$_GET[ns]":"")));$Vh=array();$Wh=array();$ea=($_GET["schema"]?$_GET["schema"]:$_COOKIE["adminer_schema-".str_replace(".","_",DB)]);preg_match_all('~([^:]+):([-0-9.]+)x([-0-9.]+)(_|$)~',$ea,$Ie,PREG_SET_ORDER);foreach($Ie
as$r=>$B){$Vh[$B[1]]=array($B[2],$B[3]);$Wh[]="\n\t'".js_escape($B[1])."': [ $B[2], $B[3] ]";}$ti=0;$Qa=-1;$eh=array();$Jg=array();$xe=array();foreach(table_status('',true)as$Q=>$R){if(is_view($R))continue;$kg=0;$eh[$Q]["fields"]=array();foreach(fields($Q)as$C=>$m){$kg+=1.25;$m["pos"]=$kg;$eh[$Q]["fields"][$C]=$m;}$eh[$Q]["pos"]=($Vh[$Q]?$Vh[$Q]:array($ti,0));foreach($b->foreignKeys($Q)as$X){if(!$X["db"]){$ve=$Qa;if($Vh[$Q][1]||$Vh[$X["table"]][1])$ve=min(floatval($Vh[$Q][1]),floatval($Vh[$X["table"]][1]))-1;else$Qa-=.1;while($xe[(string)$ve])$ve-=.0001;$eh[$Q]["references"][$X["table"]][(string)$ve]=array($X["source"],$X["target"]);$Jg[$X["table"]][$Q][(string)$ve]=$X["target"];$xe[(string)$ve]=true;}}$ti=max($ti,$eh[$Q]["pos"][0]+2.5+$kg);}echo'<div id="schema" style="height: ',$ti,'em;">
<script',nonce(),'>
qs(\'#schema\').onselectstart = function () { return false; };
var tablePos = {',implode(",",$Wh)."\n",'};
var em = qs(\'#schema\').offsetHeight / ',$ti,';
document.onmousemove = schemaMousemove;
document.onmouseup = partialArg(schemaMouseup, \'',js_escape(DB),'\');
</script>
';foreach($eh
as$C=>$Q){echo"<div class='table' style='top: ".$Q["pos"][0]."em; left: ".$Q["pos"][1]."em;'>",'<a href="'.h(ME).'table='.urlencode($C).'"><b>'.h($C)."</b></a>",script("qsl('div').onmousedown = schemaMousedown;");foreach($Q["fields"]as$m){$X='<span'.type_class($m["type"]).' title="'.h($m["full_type"].($m["null"]?" NULL":'')).'">'.h($m["field"]).'</span>';echo"<br>".($m["primary"]?"<i>$X</i>":$X);}foreach((array)$Q["references"]as$ci=>$Kg){foreach($Kg
as$ve=>$Gg){$we=$ve-$Vh[$C][1];$r=0;foreach($Gg[0]as$_h)echo"\n<div class='references' title='".h($ci)."' id='refs$ve-".($r++)."' style='left: $we"."em; top: ".$Q["fields"][$_h]["pos"]."em; padding-top: .5em;'><div style='border-top: 1px solid Gray; width: ".(-$we)."em;'></div></div>";}}foreach((array)$Jg[$C]as$ci=>$Kg){foreach($Kg
as$ve=>$e){$we=$ve-$Vh[$C][1];$r=0;foreach($e
as$bi)echo"\n<div class='references' title='".h($ci)."' id='refd$ve-".($r++)."' style='left: $we"."em; top: ".$Q["fields"][$bi]["pos"]."em; height: 1.25em; background: url(".h(preg_replace("~\\?.*~","",ME)."?file=arrow.gif) no-repeat right center;&version=4.8.4")."'><div style='height: .5em; border-bottom: 1px solid Gray; width: ".(-$we)."em;'></div></div>";}}echo"\n</div>\n";}foreach($eh
as$C=>$Q){foreach((array)$Q["references"]as$ci=>$Kg){foreach($Kg
as$ve=>$Gg){$We=$ti;$Me=-10;foreach($Gg[0]as$x=>$_h){$lg=$Q["pos"][0]+$Q["fields"][$_h]["pos"];$mg=$eh[$ci]["pos"][0]+$eh[$ci]["fields"][$Gg[1][$x]]["pos"];$We=min($We,$lg,$mg);$Me=max($Me,$lg,$mg);}echo"<div class='references' id='refl$ve' style='left: $ve"."em; top: $We"."em; padding: .5em 0;'><div style='border-right: 1px solid Gray; margin-top: 1px; height: ".($Me-$We)."em;'></div></div>\n";}}}echo'</div>
<p class="links"><a href="',h(ME."schema=".urlencode($ea)),'" id="schema-link">Lien permanent</a>
';}elseif(isset($_GET["dump"])){$a=$_GET["dump"];if($_POST&&!$l){$Gb="";foreach(array("output","format","db_style","routines","events","table_style","auto_increment","triggers","data_style")as$x)$Gb.="&$x=".urlencode($_POST[$x]);cookie("adminer_export",substr($Gb,1));$S=array_flip((array)$_POST["tables"])+array_flip((array)$_POST["data"]);$Qc=dump_headers((count($S)==1?key($S):DB),(DB==""||count($S)>1));$he=preg_match('~sql~',$_POST["format"]);if($he){echo"-- Adminer $ia ".$mc[DRIVER]." ".str_replace("\n"," ",$f->server_info)." dump\n\n";if($w=="sql"){echo"SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
".($_POST["data_style"]?"SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
":"")."
";$f->query("SET time_zone = '+00:00'");$f->query("SET sql_mode = ''");}}$Mh=$_POST["db_style"];$i=array(DB);if(DB==""){$i=$_POST["databases"];if(is_string($i))$i=explode("\n",rtrim(str_replace("\r","",$i),"\n"));}foreach((array)$i
as$j){$b->dumpDatabase($j);if($f->select_db($j)){if($he&&preg_match('~CREATE~',$Mh)&&($h=$f->result("SHOW CREATE DATABASE ".idf_escape($j),1))){set_utf8mb4($h);if($Mh=="DROP+CREATE")echo"DROP DATABASE IF EXISTS ".idf_escape($j).";\n";echo"$h;\n";}if($he){if($Mh)echo
use_sql($j).";\n\n";$Of="";if($_POST["routines"]){foreach(array("FUNCTION","PROCEDURE")as$Yg){foreach(get_rows("SHOW $Yg STATUS WHERE Db = ".q($j),null,"-- ")as$J){$h=remove_definer($f->result("SHOW CREATE $Yg ".idf_escape($J["Name"]),2));set_utf8mb4($h);$Of.=($Mh!='DROP+CREATE'?"DROP $Yg IF EXISTS ".idf_escape($J["Name"]).";;\n":"")."$h;;\n\n";}}}if($_POST["events"]){foreach(get_rows("SHOW EVENTS",null,"-- ")as$J){$h=remove_definer($f->result("SHOW CREATE EVENT ".idf_escape($J["Name"]),3));set_utf8mb4($h);$Of.=($Mh!='DROP+CREATE'?"DROP EVENT IF EXISTS ".idf_escape($J["Name"]).";;\n":"")."$h;;\n\n";}}if($Of)echo"DELIMITER ;;\n\n$Of"."DELIMITER ;\n\n";}if($_POST["table_style"]||$_POST["data_style"]){$dj=array();foreach(table_status('',true)as$C=>$R){$Q=(DB==""||in_array($C,(array)$_POST["tables"]));$Qb=(DB==""||in_array($C,(array)$_POST["data"]));if($Q||$Qb){if($Qc=="tar"){$pi=new
TmpFile;ob_start(array($pi,'write'),1e5);}$b->dumpTable($C,($Q?$_POST["table_style"]:""),(is_view($R)?2:0));if(is_view($R))$dj[]=$C;elseif($Qb){$n=fields($C);$b->dumpData($C,$_POST["data_style"],"SELECT *".convert_fields($n,$n)." FROM ".table($C));}if($he&&$_POST["triggers"]&&$Q&&($Di=trigger_sql($C)))echo"\nDELIMITER ;;\n$Di\nDELIMITER ;\n";if($Qc=="tar"){ob_end_flush();tar_file((DB!=""?"":"$j/")."$C.csv",$pi);}elseif($he)echo"\n";}}if(function_exists('foreign_keys_sql')){foreach(table_status('',true)as$C=>$R){$Q=(DB==""||in_array($C,(array)$_POST["tables"]));if($Q&&!is_view($R))echo
foreign_keys_sql($C);}}foreach($dj
as$cj)$b->dumpTable($cj,$_POST["table_style"],1);if($Qc=="tar")echo
pack("x512");}}}if($he)echo"-- ".$f->result("SELECT NOW()")."\n";exit;}page_header('Exporter',$l,($_GET["export"]!=""?array("table"=>$_GET["export"]):array()),h(DB));echo'
<form action="" method="post">
<table cellspacing="0" class="layout">
';$Vb=array('','USE','DROP+CREATE','CREATE');$Xh=array('','DROP+CREATE','CREATE');$Rb=array('','TRUNCATE+INSERT','INSERT');if($w=="sql")$Rb[]='INSERT+UPDATE';parse_str($_COOKIE["adminer_export"],$J);if(!$J)$J=array("output"=>"text","format"=>"sql","db_style"=>(DB!=""?"":"CREATE"),"table_style"=>"DROP+CREATE","data_style"=>"INSERT");if(!isset($J["events"])){$J["routines"]=$J["events"]=($_GET["dump"]=="");$J["triggers"]=$J["table_style"];}echo"<tr><th>".'Sortie'."<td>".html_select("output",$b->dumpOutput(),$J["output"],0)."\n";echo"<tr><th>".'Format'."<td>".html_select("format",$b->dumpFormat(),$J["format"],0)."\n";echo($w=="sqlite"?"":"<tr><th>".'Base de données'."<td>".html_select('db_style',$Vb,$J["db_style"]).(support("routine")?checkbox("routines",1,$J["routines"],'Routines'):"").(support("event")?checkbox("events",1,$J["events"],'Évènements'):"")),"<tr><th>".'Tables'."<td>".html_select('table_style',$Xh,$J["table_style"]).checkbox("auto_increment",1,$J["auto_increment"],'Incrément automatique').(support("trigger")?checkbox("triggers",1,$J["triggers"],'Déclencheurs'):""),"<tr><th>".'Données'."<td>".html_select('data_style',$Rb,$J["data_style"]),'</table>
<p><input type="submit" value="Exporter">
<input type="hidden" name="token" value="',$si,'">

<table cellspacing="0">
',script("qsl('table').onclick = dumpClick;");$pg=array();if(DB!=""){$db=($a!=""?"":" checked");echo"<thead><tr>","<th style='text-align: left;'><label class='block'><input type='checkbox' id='check-tables'$db>".'Tables'."</label>".script("qs('#check-tables').onclick = partial(formCheck, /^tables\\[/);",""),"<th style='text-align: right;'><label class='block'>".'Données'."<input type='checkbox' id='check-data'$db></label>".script("qs('#check-data').onclick = partial(formCheck, /^data\\[/);",""),"</thead>\n";$dj="";$Yh=tables_list();foreach($Yh
as$C=>$T){$og=preg_replace('~_.*~','',$C);$db=($a==""||$a==(substr($a,-1)=="%"?"$og%":$C));$sg="<tr><td>".checkbox("tables[]",$C,$db,$C,"","block");if($T!==null&&!preg_match('~table~i',$T))$dj.="$sg\n";else
echo"$sg<td align='right'><label class='block'><span id='Rows-".h($C)."'></span>".checkbox("data[]",$C,$db)."</label>\n";$pg[$og]++;}echo$dj;if($Yh)echo
script("ajaxSetHtml('".js_escape(ME)."script=db');");}else{echo"<thead><tr><th style='text-align: left;'>","<label class='block'><input type='checkbox' id='check-databases'".($a==""?" checked":"").">".'Base de données'."</label>",script("qs('#check-databases').onclick = partial(formCheck, /^databases\\[/);",""),"</thead>\n";$i=$b->databases();if($i){foreach($i
as$j){if(!information_schema($j)){$og=preg_replace('~_.*~','',$j);echo"<tr><td>".checkbox("databases[]",$j,$a==""||$a=="$og%",$j,"","block")."\n";$pg[$og]++;}}}else
echo"<tr><td><textarea name='databases' rows='10' cols='20'></textarea>";}echo'</table>
</form>
';$dd=true;foreach($pg
as$x=>$X){if($x!=""&&$X>1){echo($dd?"<p>":" ")."<a href='".h(ME)."dump=".urlencode("$x%")."'>".h($x)."</a>";$dd=false;}}}elseif(isset($_GET["privileges"])){page_header('Privilèges');echo'<p class="links"><a href="'.h(ME).'user=">'.'Créer un utilisateur'."</a>";$H=$f->query("SELECT User, Host FROM mysql.".(DB==""?"user":"db WHERE ".q(DB)." LIKE Db")." ORDER BY Host, User");$ud=$H;if(!$H)$H=$f->query("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1) AS User, SUBSTRING_INDEX(CURRENT_USER, '@', -1) AS Host");echo"<form action=''><p>\n";hidden_fields_get();echo"<input type='hidden' name='db' value='".h(DB)."'>\n",($ud?"":"<input type='hidden' name='grant' value=''>\n"),"<table cellspacing='0'>\n","<thead><tr><th>".'Utilisateur'."<th>".'Serveur'."<th></thead>\n";while($J=$H->fetch_assoc())echo'<tr'.odd().'><td>'.h($J["User"])."<td>".h($J["Host"]).'<td><a href="'.h(ME.'user='.urlencode($J["User"]).'&host='.urlencode($J["Host"])).'">'.'Modifier'."</a>\n";if(!$ud||DB!="")echo"<tr".odd()."><td><input name='user' autocapitalize='off'><td><input name='host' value='localhost' autocapitalize='off'><td><input type='submit' value='".'Modifier'."'>\n";echo"</table>\n","</form>\n";}elseif(isset($_GET["sql"])){if(!$l&&$_POST["export"]){dump_headers("sql");$b->dumpTable("","");$b->dumpData("","table",$_POST["query"]);exit;}restart_session();$Hd=&get_session("queries");$Gd=&$Hd[DB];if(!$l&&$_POST["clear"]){$Gd=array();redirect(remove_from_uri("history"));}page_header((isset($_GET["import"])?'Importer':'Requête SQL'),$l);if(!$l&&$_POST){$qd=false;if(!isset($_GET["import"]))$G=$_POST["query"];elseif($_POST["webfile"]){$Dh=$b->importServerPath();$qd=@fopen((file_exists($Dh)?$Dh:"compress.zlib://$Dh.gz"),"rb");$G=($qd?fread($qd,1e6):false);}else$G=get_file("sql_file",true);if(is_string($G)){if(function_exists('memory_get_usage'))@ini_set("memory_limit",max(ini_bytes("memory_limit"),2*strlen($G)+memory_get_usage()+8e6));if($G!=""&&strlen($G)<1e6){$zg=$G.(preg_match("~;[ \t\r\n]*\$~",$G)?"":";");if(!$Gd||reset(end($Gd))!=$zg){restart_session();$Gd[]=array($zg,time());set_session("queries",$Hd);stop_session();}}$Ah="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$ec=";";$nf=0;$Ac=true;$g=connect();if(is_object($g)&&DB!=""){$g->select_db(DB);if($_GET["ns"]!="")set_schema($_GET["ns"],$g);}$sb=0;$Fc=array();$Vf='[\'"'.($w=="sql"?'`#':($w=="sqlite"?'`[':($w=="mssql"?'[':''))).']|/\*|-- |$'.($w=="pgsql"?'|\$[^$]*\$':'');$ui=microtime(true);parse_str($_COOKIE["adminer_export"],$ya);$sc=$b->dumpFormat();unset($sc["sql"]);while($G!=""){if(!$nf&&preg_match("~^$Ah*+DELIMITER\\s+(\\S+)~i",$G,$B)){$ec=$B[1];$G=substr($G,strlen($B[0]));}else{preg_match('('.preg_quote($ec)."\\s*|$Vf)",$G,$B,PREG_OFFSET_CAPTURE,$nf);list($od,$kg)=$B[0];if(!$od&&$qd&&!feof($qd))$G.=fread($qd,1e5);else{if(!$od&&rtrim($G)=="")break;$nf=$kg+strlen($od);if($od&&rtrim($od)!=$ec){while(preg_match('('.($od=='/*'?'\*/':($od=='['?']':(preg_match('~^-- |^#~',$od)?"\n":preg_quote($od)."|\\\\."))).'|$)s',$G,$B,PREG_OFFSET_CAPTURE,$nf)){$ch=$B[0][0];if(!$ch&&$qd&&!feof($qd))$G.=fread($qd,1e5);else{$nf=$B[0][1]+strlen($ch);if($ch[0]!="\\")break;}}}else{$Ac=false;$zg=substr($G,0,$kg);$sb++;$sg="<pre id='sql-$sb'><code class='jush-$w copy-to-clipboard'>".$b->sqlCommandQuery($zg)."</code></pre>\n";$sg.=generate_linksbar(["<a href='#' class='copy-to-clipboard'>".'Copier dans le presse-papiers'."</a>"]);if($w=="sqlite"&&preg_match("~^$Ah*+ATTACH\\b~i",$zg,$B)){echo$sg,"<p class='error'>".'Requêtes ATTACH ne sont pas supportées.'."\n";$Fc[]=" <a href='#sql-$sb'>$sb</a>";if($_POST["error_stops"])break;}else{if(!$_POST["only_errors"]){echo$sg;ob_flush();flush();}$Hh=microtime(true);if($f->multi_query($zg)&&is_object($g)&&preg_match("~^$Ah*+USE\\b~i",$zg))$g->query($zg);do{$H=$f->store_result();if($f->error){echo($_POST["only_errors"]?$sg:""),"<p class='error'>".'Erreur dans la requête'.($f->errno?" ($f->errno)":"").": ".error()."\n";$Fc[]=" <a href='#sql-$sb'>$sb</a>";if($_POST["error_stops"])break
2;}else{$ii=" <span class='time'>(".format_time($Hh).")</span>".(strlen($zg)<1000?" <a href='".h(ME)."sql=".urlencode(trim($zg))."'>".'Modifier'."</a>":"");$_a=$f->affected_rows;$gj=($_POST["only_errors"]?"":$k->warnings());$hj="warnings-$sb";if($gj)$ii.=", <a href='#$hj'>".'Avertissements'."</a>".script("qsl('a').onclick = partial(toggle, '$hj');","");$Nc=null;$Oc="explain-$sb";if(is_object($H)){$y=$_POST["limit"];$Hf=select($H,$g,array(),$y);if(!$_POST["only_errors"]){echo"<form action='' method='post'>\n";$jf=$H->num_rows;echo"<p>".($jf?($y&&$jf>$y?sprintf('%d / ',$y):"").lang(array('%d ligne','%d lignes'),$jf):""),$ii;if($g&&preg_match("~^($Ah|\\()*+SELECT\\b~i",$zg)&&($Nc=explain($g,$zg)))echo", <a href='#$Oc'>Explain</a>".script("qsl('a').onclick = partial(toggle, '$Oc');","");$s="export-$sb";echo", <a href='#$s'>".'Exporter'."</a>".script("qsl('a').onclick = partial(toggle, '$s');","")."<span id='$s' class='hidden'>: ".html_select("output",$b->dumpOutput(),$ya["output"])." ".html_select("format",$sc,$ya["format"])."<input type='hidden' name='query' value='".h($zg)."'>"." <input type='submit' name='export' value='".'Exporter'."'><input type='hidden' name='token' value='$si'></span>\n"."</form>\n";}}else{if(preg_match("~^$Ah*+(CREATE|DROP|ALTER)$Ah++(DATABASE|SCHEMA)\\b~i",$zg)){restart_session();set_session("dbs",null);stop_session();}if(!$_POST["only_errors"])echo"<p class='message' title='".h($f->info)."'>".lang(array('Requête exécutée avec succès, %d ligne modifiée.','Requête exécutée avec succès, %d lignes modifiées.'),$_a)."$ii\n";}echo($gj?"<div id='$hj' class='hidden'>\n$gj</div>\n":"");if($Nc){echo"<div id='$Oc' class='hidden'>\n";select($Nc,$g,$Hf);echo"</div>\n";}}$Hh=microtime(true);}while($f->next_result());}$G=substr($G,$nf);$nf=0;}}}}if($Ac)echo"<p class='message'>".'Aucune commande à exécuter.'."\n";elseif($_POST["only_errors"]){echo"<p class='message'>".lang(array('%d requête exécutée avec succès.','%d requêtes exécutées avec succès.'),$sb-count($Fc))," <span class='time'>(".format_time($ui).")</span>\n";}elseif($Fc&&$sb>1)echo"<p class='error'>".'Erreur dans la requête'.": ".implode("",$Fc)."\n";}else
echo"<p class='error'>".upload_error($G)."\n";}echo'
<form action="" method="post" enctype="multipart/form-data" id="form">
';$Lc="<input type='submit' value='".'Exécuter'."' title='Ctrl+Enter'>";if(!isset($_GET["import"])){$zg=$_GET["sql"];if($_POST)$zg=$_POST["query"];elseif($_GET["history"]=="all")$zg=$Gd;elseif($_GET["history"]!="")$zg=$Gd[$_GET["history"]][0];echo"<p>";textarea("query",$zg,20);echo
script(($_POST?"":"qs('textarea').focus();\n")."qs('#form').onsubmit = partial(sqlSubmit, qs('#form'), '".js_escape(remove_from_uri("sql|limit|error_stops|only_errors|history"))."');"),"<p>$Lc\n",'Limiter les lignes'.": <input type='number' name='limit' class='size' value='".h($_POST?$_POST["limit"]:$_GET["limit"])."'>\n";}else{echo"<fieldset><legend>".'Importer un fichier'."</legend><div>";$_d=(extension_loaded("zlib")?"[.gz]":"");echo(ini_bool("file_uploads")?"SQL$_d (&lt; ".ini_get("upload_max_filesize")."B): <input type='file' name='sql_file[]' multiple>\n$Lc":'L\'importation de fichier est désactivée.'),"</div></fieldset>\n";$Od=$b->importServerPath();if($Od){echo"<fieldset><legend>".'Depuis le serveur'."</legend><div>",sprintf('Fichier %s du serveur Web',"<code>".h($Od)."$_d</code>"),' <input type="submit" name="webfile" value="'.'Exécuter le fichier'.'">',"</div></fieldset>\n";}echo"<p>";}echo
checkbox("error_stops",1,($_POST?$_POST["error_stops"]:isset($_GET["import"])||$_GET["error_stops"]),'Arrêter en cas d\'erreur')."\n",checkbox("only_errors",1,($_POST?$_POST["only_errors"]:isset($_GET["import"])||$_GET["only_errors"]),'Montrer seulement les erreurs')."\n","<input type='hidden' name='token' value='$si'>\n";if(!isset($_GET["import"])&&$Gd){print_fieldset("history",'Historique',$_GET["history"]!="");for($X=end($Gd);$X;$X=prev($Gd)){$x=key($Gd);list($zg,$ii,$wc)=$X;echo'<a href="'.h(ME."sql=&history=$x").'" class="edit" title="'.'Modifier'.'">'.'Modifier'."</a>"." <span class='time' title='".@date('Y-m-d',$ii)."'>".@date("H:i:s",$ii)."</span>"." <code class='jush-$w'>".shorten_utf8(ltrim(str_replace("\n"," ",str_replace("\r","",preg_replace('~^(#|-- ).*~m','',$zg)))),80,"</code>").($wc?" <span class='time'>($wc)</span>":"")."<br>\n";}echo"<input type='submit' name='clear' value='".'Effacer'."'>\n","<a href='".h(ME."sql=&history=all")."' class='edit-all' title='".'Tout modifier'."'>".'Tout modifier'."</a>\n","</div></fieldset>\n";}echo'</form>
';}elseif(isset($_GET["edit"])){$a=$_GET["edit"];$n=fields($a);$Z=(isset($_GET["select"])?($_POST["check"]&&count($_POST["check"])==1?where_check($_POST["check"][0],$n):""):where($_GET,$n));$Ni=(isset($_GET["select"])?$_POST["edit"]:$Z);foreach($n
as$C=>$m){if(!isset($m["privileges"][$Ni?"update":"insert"])||$b->fieldName($m)==""||$m["generated"])unset($n[$C]);}if($_POST&&!$l&&!isset($_GET["select"])){$A=$_POST["referer"];if($_POST["insert"])$A=($Ni?null:$_SERVER["REQUEST_URI"]);elseif(!preg_match('~^.+&select=.+$~',$A))$A=ME."select=".urlencode($a);$v=indexes($a);$Ii=unique_array($_GET["where"],$v);$Bg="\nWHERE $Z";if(isset($_POST["delete"]))queries_redirect($A,'L\'élément a été supprimé.',$k->delete($a,$Bg,!$Ii));else{$N=array();foreach($n
as$C=>$m){$X=process_input($m);if($X!==false&&$X!==null)$N[idf_escape($C)]=$X;}if($Ni){if(!$N)redirect($A);queries_redirect($A,'L\'élément a été modifié.',$k->update($a,$N,$Bg,!$Ii));if(is_ajax()){page_headers();page_messages($l);exit;}}else{$H=$k->insert($a,$N);$ue=($H?last_id():0);queries_redirect($A,sprintf('L\'élément%s a été inséré.',($ue?" $ue":"")),$H);}}}$J=null;if($_POST["save"])$J=(array)$_POST["fields"];elseif($Z){$L=array();foreach($n
as$C=>$m){if(isset($m["privileges"]["select"])){$Ga=convert_field($m);if($_POST["clone"]&&$m["auto_increment"])$Ga="''";if($w=="sql"&&preg_match("~enum|set~",$m["type"]))$Ga="1*".idf_escape($C);$L[]=($Ga?"$Ga AS ":"").idf_escape($C);}}$J=array();if(!support("table"))$L=array("*");if($L){$H=$k->select($a,$L,array($Z),$L,array(),(isset($_GET["select"])?2:1));if(!$H)$l=error();else{$J=$H->fetch_assoc();if(!$J)$J=false;}if(isset($_GET["select"])&&(!$J||$H->fetch_assoc()))$J=null;}}if(!support("table")&&!$n){if(!$Z){$H=$k->select($a,array("*"),$Z,array("*"));$J=($H?$H->fetch_assoc():false);if(!$J)$J=array($k->primary=>"");}if($J){foreach($J
as$x=>$X){if(!$Z)$J[$x]=null;$n[$x]=array("field"=>$x,"null"=>($x!=$k->primary),"auto_increment"=>($x==$k->primary));}}}edit_form($a,$n,$J,$Ni);}elseif(isset($_GET["create"])){$a=$_GET["create"];$Xf=array();foreach(array('HASH','LINEAR HASH','KEY','LINEAR KEY','RANGE','LIST')as$x)$Xf[$x]=$x;$Ig=referencable_primary($a);$md=array();foreach($Ig
as$Th=>$m)$md[str_replace("`","``",$Th)."`".str_replace("`","``",$m["field"])]=$Th;$Kf=array();$R=array();if($a!=""){$Kf=fields($a);$R=table_status($a);if(!$R)$l='Aucune table.';}$J=$_POST;$J["fields"]=(array)$J["fields"];if($J["auto_increment_col"])$J["fields"][$J["auto_increment_col"]]["auto_increment"]=true;if($_POST)set_adminer_settings(array("comments"=>$_POST["comments"],"defaults"=>$_POST["defaults"]));if($_POST&&!process_fields($J["fields"])&&!$l){if($_POST["drop"])queries_redirect(substr(ME,0,-1),'La table a été effacée.',drop_tables(array($a)));else{$n=array();$Da=array();$Ri=false;$kd=array();$Jf=reset($Kf);$Ba=" FIRST";foreach($J["fields"]as$x=>$m){$p=$md[$m["type"]];$Ei=($p!==null?$Ig[$p]:$m);if($m["field"]!=""){if(!$m["has_default"])$m["default"]=null;if($x==$J["auto_increment_col"])$m["auto_increment"]=true;$xg=process_field($m,$Ei);$Da[]=array($m["orig"],$xg,$Ba);if(!$Jf||$xg!=process_field($Jf,$Jf)){$n[]=array($m["orig"],$xg,$Ba);if($m["orig"]!=""||$Ba)$Ri=true;}if($p!==null)$kd[idf_escape($m["field"])]=($a!=""&&$w!="sqlite"?"ADD":" ").format_foreign_key(array('table'=>$md[$m["type"]],'source'=>array($m["field"]),'target'=>array($Ei["field"]),'on_delete'=>$m["on_delete"],));$Ba=" AFTER ".idf_escape($m["field"]);}elseif($m["orig"]!=""){$Ri=true;$n[]=array($m["orig"]);}if($m["orig"]!=""){$Jf=next($Kf);if(!$Jf)$Ba="";}}$Zf="";if($Xf[$J["partition_by"]]){$ag=array();if($J["partition_by"]=='RANGE'||$J["partition_by"]=='LIST'){foreach(array_filter($J["partition_names"])as$x=>$X){$Y=$J["partition_values"][$x];$ag[]="\n  PARTITION ".idf_escape($X)." VALUES ".($J["partition_by"]=='RANGE'?"LESS THAN":"IN").($Y!=""?" ($Y)":" MAXVALUE");}}$Zf.="\nPARTITION BY $J[partition_by]($J[partition])".($ag?" (".implode(",",$ag)."\n)":($J["partitions"]?" PARTITIONS ".(+$J["partitions"]):""));}elseif(support("partitioning")&&preg_match("~partitioned~",$R["Create_options"]))$Zf.="\nREMOVE PARTITIONING";$Qe='La table a été modifiée.';if($a==""){cookie("adminer_engine",$J["Engine"]);$Qe='La table a été créée.';}$C=trim($J["name"]);queries_redirect(ME.(support("table")?"table=":"select=").urlencode($C),$Qe,alter_table($a,$C,($w=="sqlite"&&($Ri||$kd)?$Da:$n),$kd,($J["Comment"]!=$R["Comment"]?$J["Comment"]:null),($J["Engine"]&&$J["Engine"]!=$R["Engine"]?$J["Engine"]:""),($J["Collation"]&&$J["Collation"]!=$R["Collation"]?$J["Collation"]:""),($J["Auto_increment"]!=""?number($J["Auto_increment"]):""),$Zf));}}page_header(($a!=""?'Modifier la table':'Créer une table'),$l,array("table"=>$a),h($a));if(!$_POST){$J=array("Engine"=>$_COOKIE["adminer_engine"],"fields"=>array(array("field"=>"","type"=>(isset($U["int"])?"int":(isset($U["integer"])?"integer":"")),"on_update"=>"")),"partition_names"=>array(""),);if($a!=""){$J=$R;$J["name"]=$a;$J["fields"]=array();if(!$_GET["auto_increment"])$J["Auto_increment"]="";foreach($Kf
as$m){$m["has_default"]=isset($m["default"]);$J["fields"][]=$m;}if(support("partitioning")){$rd="FROM information_schema.PARTITIONS WHERE TABLE_SCHEMA = ".q(DB)." AND TABLE_NAME = ".q($a);$H=$f->query("SELECT PARTITION_METHOD, PARTITION_ORDINAL_POSITION, PARTITION_EXPRESSION $rd ORDER BY PARTITION_ORDINAL_POSITION DESC LIMIT 1");list($J["partition_by"],$J["partitions"],$J["partition"])=$H->fetch_row();$ag=get_key_vals("SELECT PARTITION_NAME, PARTITION_DESCRIPTION $rd AND PARTITION_NAME != '' ORDER BY PARTITION_ORDINAL_POSITION");$ag[""]="";$J["partition_names"]=array_keys($ag);$J["partition_values"]=array_values($ag);}}}$nb=collations();$Cc=engines();foreach($Cc
as$Bc){if(!strcasecmp($Bc,$J["Engine"])){$J["Engine"]=$Bc;break;}}echo'
<form action="" method="post" id="form">
<p>
';if(support("columns")||$a==""){echo'Nom de la table: <input name="name" data-maxlength="64" value="',h($J["name"]),'" autocapitalize="off">
';if($a==""&&!$_POST)echo
script("focus(qs('#form')['name']);");echo($Cc?"<select name='Engine'>".optionlist(array(""=>"(".'moteur'.")")+$Cc,$J["Engine"])."</select>".on_help("getTarget(event).value",1).script("qsl('select').onchange = helpClose;"):""),' ',($nb&&!preg_match("~sqlite|mssql~",$w)?html_select("Collation",array(""=>"(".'interclassement'.")")+$nb,$J["Collation"]):""),' <input type="submit" value="Enregistrer">
';}echo'
';if(support("columns")){echo'<div class="scrollable">
<table cellspacing="0" id="edit-fields" class="nowrap">
';edit_fields($J["fields"],$nb,"TABLE",$md);echo'</table>
',script("editFields();"),'</div>
<p>
Incrément automatique: <input type="number" name="Auto_increment" size="6" value="',h($J["Auto_increment"]),'">
',checkbox("defaults",1,($_POST?$_POST["defaults"]:adminer_setting("defaults")),'Valeurs par défaut',"columnShow(this.checked, 5)","jsonly");$vb=($_POST?$_POST["comments"]:adminer_setting("comments"));echo(support("comment")?checkbox("comments",1,$vb,'Commentaire',"editingCommentsClick(this, true);","jsonly").' '.(preg_match('~\n~',$J["Comment"])?"<textarea name='Comment' rows='2' cols='20'".($vb?"":" class='hidden'").">".h($J["Comment"])."</textarea>":'<input name="Comment" value="'.h($J["Comment"]).'" data-maxlength="'.(min_version(5.5)?2048:60).'"'.($vb?"":" class='hidden'").'>'):''),'<p>
<input type="submit" value="Enregistrer">
';}echo'
';if($a!=""){echo'<input type="submit" name="drop" value="Supprimer">',confirm(sprintf('Supprimer %s?',$a));}if(support("partitioning")){$Yf=preg_match('~RANGE|LIST~',$J["partition_by"]);print_fieldset("partition",'Partitionner par',$J["partition_by"]);echo'<p>
',"<select name='partition_by'>".optionlist(array(""=>"")+$Xf,$J["partition_by"])."</select>".on_help("getTarget(event).value.replace(/./, 'PARTITION BY \$&')",1).script("qsl('select').onchange = partitionByChange;"),'(<input name="partition" value="',h($J["partition"]),'">)
Partitions: <input type="number" name="partitions" class="size',($Yf||!$J["partition_by"]?" hidden":""),'" value="',h($J["partitions"]),'">
<table cellspacing="0" id="partition-table"',($Yf?"":" class='hidden'"),'>
<thead><tr><th>Nom de la partition<th>Valeurs</thead>
';foreach($J["partition_names"]as$x=>$X){echo'<tr>','<td><input name="partition_names[]" value="'.h($X).'" autocapitalize="off">',($x==count($J["partition_names"])-1?script("qsl('input').oninput = partitionNameChange;"):''),'<td><input name="partition_values[]" value="'.h($J["partition_values"][$x]).'">';}echo'</table>
</div></fieldset>
';}echo'<input type="hidden" name="token" value="',$si,'">
</form>
';}elseif(isset($_GET["indexes"])){$a=$_GET["indexes"];$Rd=array("PRIMARY","UNIQUE","INDEX");$R=table_status($a,true);if(preg_match('~MyISAM|M?aria'.(min_version(5.6,'10.0.5')?'|InnoDB':'').'~i',$R["Engine"]))$Rd[]="FULLTEXT";if(preg_match('~MyISAM|M?aria'.(min_version(5.7,'10.2.2')?'|InnoDB':'').'~i',$R["Engine"]))$Rd[]="SPATIAL";$v=indexes($a);$qg=array();if($w=="mongo"){$qg=$v["_id_"];unset($Rd[0]);unset($v["_id_"]);}$J=$_POST;if($_POST&&!$l&&!$_POST["add"]&&!$_POST["drop_col"]){$c=array();foreach($J["indexes"]as$u){$C=$u["name"];if(in_array($u["type"],$Rd)){$e=array();$_e=array();$gc=array();$N=array();ksort($u["columns"]);foreach($u["columns"]as$x=>$d){if($d!=""){$ze=$u["lengths"][$x];$fc=$u["descs"][$x];$N[]=idf_escape($d).($ze?"(".(+$ze).")":"").($fc?" DESC":"");$e[]=$d;$_e[]=($ze?$ze:null);$gc[]=$fc;}}if($e){$Mc=$v[$C];if($Mc){ksort($Mc["columns"]);ksort($Mc["lengths"]);ksort($Mc["descs"]);if($u["type"]==$Mc["type"]&&array_values($Mc["columns"])===$e&&(!$Mc["lengths"]||array_values($Mc["lengths"])===$_e)&&array_values($Mc["descs"])===$gc){unset($v[$C]);continue;}}$c[]=array($u["type"],$C,$N);}}}foreach($v
as$C=>$Mc)$c[]=array($Mc["type"],$C,"DROP");if(!$c)redirect(ME."table=".urlencode($a));queries_redirect(ME."table=".urlencode($a),'Index modifiés.',alter_indexes($a,$c));}page_header('Index',$l,array("table"=>$a),h($a));$n=array_keys(fields($a));if($_POST["add"]){foreach($J["indexes"]as$x=>$u){if($u["columns"][count($u["columns"])]!="")$J["indexes"][$x]["columns"][]="";}$u=end($J["indexes"]);if($u["type"]||array_filter($u["columns"],'strlen'))$J["indexes"][]=array("columns"=>array(1=>""));}if(!$J){foreach($v
as$x=>$u){$v[$x]["name"]=$x;$v[$x]["columns"][]="";}$v[]=array("columns"=>array(1=>""));$J["indexes"]=$v;}echo'
<form action="" method="post">
<div class="scrollable">
<table cellspacing="0" class="nowrap">
<thead><tr>
<th id="label-type">Type d\'index
<th><input type="submit" class="wayoff">Colonne (longueur)
<th id="label-name">Nom
<th><noscript>',"<input type='image' class='icon' name='add[0]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.8.4")."' alt='+' title='".'Ajouter le prochain'."'>",'</noscript>
</thead>
';if($qg){echo"<tr><td>PRIMARY<td>";foreach($qg["columns"]as$x=>$d){echo
select_input(" disabled",$n,$d),"<label><input disabled type='checkbox'>".'décroissant'."</label> ";}echo"<td><td>\n";}$ke=1;foreach($J["indexes"]as$u){if(!$_POST["drop_col"]||$ke!=key($_POST["drop_col"])){echo"<tr><td>".html_select("indexes[$ke][type]",array(-1=>"")+$Rd,$u["type"],($ke==count($J["indexes"])?"indexesAddRow.call(this);":1),"label-type"),"<td>";ksort($u["columns"]);$r=1;foreach($u["columns"]as$x=>$d){echo"<span>".select_input(" name='indexes[$ke][columns][$r]' title='".'Colonne'."'",($n?array_combine($n,$n):$n),$d,"partial(".($r==count($u["columns"])?"indexesAddColumn":"indexesChangeColumn").", '".js_escape($w=="sql"?"":$_GET["indexes"]."_")."')"),($w=="sql"||$w=="mssql"?"<input type='number' name='indexes[$ke][lengths][$r]' class='size' value='".h($u["lengths"][$x])."' title='".'Longueur'."'>":""),(support("descidx")?checkbox("indexes[$ke][descs][$r]",1,$u["descs"][$x],'décroissant'):"")," </span>";$r++;}echo"<td><input name='indexes[$ke][name]' value='".h($u["name"])."' autocapitalize='off' aria-labelledby='label-name'>\n","<td><input type='image' class='icon' name='drop_col[$ke]' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.8.4")."' alt='x' title='".'Effacer'."'>".script("qsl('input').onclick = partial(editingRemoveRow, 'indexes\$1[type]');");}$ke++;}echo'</table>
</div>
<p>
<input type="submit" value="Enregistrer">
<input type="hidden" name="token" value="',$si,'">
</form>
';}elseif(isset($_GET["database"])){$J=$_POST;if($_POST&&!$l&&!isset($_POST["add_x"])){$C=trim($J["name"]);if($_POST["drop"]){$_GET["db"]="";queries_redirect(remove_from_uri("db|database"),'La base de données a été supprimée.',drop_databases(array(DB)));}elseif(DB!==$C){if(DB!=""){$_GET["db"]=$C;queries_redirect(preg_replace('~\bdb=[^&]*&~','',ME)."db=".urlencode($C),'La base de données a été renommée.',rename_database($C,$J["collation"]));}else{$i=explode("\n",str_replace("\r","",$C));$Nh=true;$te="";foreach($i
as$j){if(count($i)==1||$j!=""){if(!create_database($j,$J["collation"]))$Nh=false;$te=$j;}}restart_session();set_session("dbs",null);queries_redirect(ME."db=".urlencode($te),'La base de données a été créée.',$Nh);}}else{if(!$J["collation"])redirect(substr(ME,0,-1));query_redirect("ALTER DATABASE ".idf_escape($C).(preg_match('~^[a-z0-9_]+$~i',$J["collation"])?" COLLATE $J[collation]":""),substr(ME,0,-1),'La base de données a été modifiée.');}}page_header(DB!=""?'Modifier la base de données':'Créer une base de données',$l,array(),h(DB));$nb=collations();$C=DB;if($_POST)$C=$J["name"];elseif(DB!="")$J["collation"]=db_collation(DB,$nb);elseif($w=="sql"){foreach(get_vals("SHOW GRANTS")as$ud){if(preg_match('~ ON (`(([^\\\\`]|``|\\\\.)*)%`\.\*)?~',$ud,$B)&&$B[1]){$C=stripcslashes(idf_unescape("`$B[2]`"));break;}}}echo'
<form action="" method="post">
<p>
',($_POST["add_x"]||strpos($C,"\n")?'<textarea id="name" name="name" rows="10" cols="40">'.h($C).'</textarea><br>':'<input name="name" id="name" value="'.h($C).'" data-maxlength="64" autocapitalize="off">')."\n".($nb?html_select("collation",array(""=>"(".'interclassement'.")")+$nb,$J["collation"]).doc_link(array('sql'=>"charset-charsets.html",'mariadb'=>"supported-character-sets-and-collations/",'mssql'=>"ms187963.aspx",)):""),script("focus(qs('#name'));"),'<input type="submit" value="Enregistrer">
';if(DB!="")echo"<input type='submit' name='drop' value='".'Supprimer'."'>".confirm(sprintf('Supprimer %s?',DB))."\n";elseif(!$_POST["add_x"]&&$_GET["db"]=="")echo"<input type='image' class='icon' name='add' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.8.4")."' alt='+' title='".'Ajouter le prochain'."'>\n";echo'<input type="hidden" name="token" value="',$si,'">
</form>
';}elseif(isset($_GET["scheme"])){$J=$_POST;if($_POST&&!$l){$z=preg_replace('~ns=[^&]*&~','',ME)."ns=";if($_POST["drop"])query_redirect("DROP SCHEMA ".idf_escape($_GET["ns"]),$z,'Le schéma a été supprimé.');else{$C=trim($J["name"]);$z.=urlencode($C);if($_GET["ns"]=="")query_redirect("CREATE SCHEMA ".idf_escape($C),$z,'Le schéma a été créé.');elseif($_GET["ns"]!=$C)query_redirect("ALTER SCHEMA ".idf_escape($_GET["ns"])." RENAME TO ".idf_escape($C),$z,'Le schéma a été modifié.');else
redirect($z);}}page_header($_GET["ns"]!=""?'Modifier le schéma':'Créer un schéma',$l);if(!$J)$J["name"]=$_GET["ns"];echo'
<form action="" method="post">
<p><input name="name" id="name" value="',h($J["name"]),'" autocapitalize="off">
',script("focus(qs('#name'));"),'<input type="submit" value="Enregistrer">
';if($_GET["ns"]!="")echo"<input type='submit' name='drop' value='".'Supprimer'."'>".confirm(sprintf('Supprimer %s?',$_GET["ns"]))."\n";echo'<input type="hidden" name="token" value="',$si,'">
</form>
';}elseif(isset($_GET["call"])){$da=($_GET["name"]?$_GET["name"]:$_GET["call"]);page_header('Appeler'.": ".h($da),$l);$Yg=routine($_GET["call"],(isset($_GET["callf"])?"FUNCTION":"PROCEDURE"));$Pd=array();$Of=array();foreach($Yg["fields"]as$r=>$m){if(substr($m["inout"],-3)=="OUT")$Of[$r]="@".idf_escape($m["field"])." AS ".idf_escape($m["field"]);if(!$m["inout"]||substr($m["inout"],0,2)=="IN")$Pd[]=$r;}if(!$l&&$_POST){$Ya=array();foreach($Yg["fields"]as$x=>$m){if(in_array($x,$Pd)){$X=process_input($m);if($X===false)$X="''";if(isset($Of[$x]))$f->query("SET @".idf_escape($m["field"])." = $X");}$Ya[]=(isset($Of[$x])?"@".idf_escape($m["field"]):$X);}$G=(isset($_GET["callf"])?"SELECT":"CALL")." ".table($da)."(".implode(", ",$Ya).")";$Hh=microtime(true);$H=$f->multi_query($G);$_a=$f->affected_rows;echo$b->selectQuery($G,$Hh,!$H);if(!$H)echo"<p class='error'>".error()."\n";else{$g=connect();if(is_object($g))$g->select_db(DB);do{$H=$f->store_result();if(is_object($H))select($H,$g);else
echo"<p class='message'>".lang(array('La routine a été exécutée, %d ligne modifiée.','La routine a été exécutée, %d lignes modifiées.'),$_a)." <span class='time'>".@date("H:i:s")."</span>\n";}while($f->next_result());if($Of)select($f->query("SELECT ".implode(", ",$Of)));}}echo'
<form action="" method="post">
';if($Pd){echo"<table cellspacing='0' class='layout'>\n";foreach($Pd
as$x){$m=$Yg["fields"][$x];$C=$m["field"];echo"<tr><th>".$b->fieldName($m);$Y=$_POST["fields"][$C];if($Y!=""){if($m["type"]=="enum")$Y=+$Y;if($m["type"]=="set")$Y=array_sum($Y);}input($m,$Y,(string)$_POST["function"][$C]);echo"\n";}echo"</table>\n";}echo'<p>
<input type="submit" value="Appeler">
<input type="hidden" name="token" value="',$si,'">
</form>
';}elseif(isset($_GET["foreign"])){$a=$_GET["foreign"];$C=$_GET["name"];$J=$_POST;if($_POST&&!$l&&!$_POST["add"]&&!$_POST["change"]&&!$_POST["change-js"]){$Qe=($_POST["drop"]?'La clé étrangère a été effacée.':($C!=""?'La clé étrangère a été modifiée.':'La clé étrangère a été créée.'));$A=ME."table=".urlencode($a);if(!$_POST["drop"]){$J["source"]=array_filter($J["source"],'strlen');ksort($J["source"]);$bi=array();foreach($J["source"]as$x=>$X)$bi[$x]=$J["target"][$x];$J["target"]=$bi;}if($w=="sqlite")queries_redirect($A,$Qe,recreate_table($a,$a,array(),array(),array(" $C"=>($_POST["drop"]?"":" ".format_foreign_key($J)))));else{$c="ALTER TABLE ".table($a);$nc="\nDROP ".($w=="sql"?"FOREIGN KEY ":"CONSTRAINT ").idf_escape($C);if($_POST["drop"])query_redirect($c.$nc,$A,$Qe);else{query_redirect($c.($C!=""?"$nc,":"")."\nADD".format_foreign_key($J),$A,$Qe);$l='Les colonnes de source et de destination doivent être du même type, il doit y avoir un index sur les colonnes de destination et les données référencées doivent exister.'."<br>$l";}}}page_header('Clé étrangère',$l,array("table"=>$a),h($a));if($_POST){ksort($J["source"]);if($_POST["add"])$J["source"][]="";elseif($_POST["change"]||$_POST["change-js"])$J["target"]=array();}elseif($C!=""){$md=foreign_keys($a);$J=$md[$C];$J["source"][]="";}else{$J["table"]=$a;$J["source"]=array("");}echo'
<form action="" method="post">
';$_h=array_keys(fields($a));if($J["db"]!="")$f->select_db($J["db"]);if($J["ns"]!="")set_schema($J["ns"]);$Hg=array_keys(array_filter(table_status('',true),'fk_support'));$bi=array_keys(fields(in_array($J["table"],$Hg)?$J["table"]:reset($Hg)));$wf="this.form['change-js'].value = '1'; this.form.submit();";echo"<p>".'Table visée'.": ".html_select("table",$Hg,$J["table"],$wf)."\n";if($w=="pgsql")echo'Schéma'.": ".html_select("ns",$b->schemas(),$J["ns"]!=""?$J["ns"]:$_GET["ns"],$wf);elseif($w!="sqlite"){$Wb=array();foreach($b->databases()as$j){if(!information_schema($j))$Wb[]=$j;}echo'BD'.": ".html_select("db",$Wb,$J["db"]!=""?$J["db"]:$_GET["db"],$wf);}echo'<input type="hidden" name="change-js" value="">
<noscript><p><input type="submit" name="change" value="Modifier"></noscript>
<table cellspacing="0">
<thead><tr><th id="label-source">Source<th id="label-target">Cible</thead>
';$ke=0;foreach($J["source"]as$x=>$X){echo"<tr>","<td>".html_select("source[".(+$x)."]",array(-1=>"")+$_h,$X,($ke==count($J["source"])-1?"foreignAddRow.call(this);":1),"label-source"),"<td>".html_select("target[".(+$x)."]",$bi,isset($J["target"][$x])?$J["target"][$x]:null,1,"label-target");$ke++;}echo'</table>
<p>
ON DELETE: ',html_select("on_delete",array(-1=>"")+explode("|",$vf),$J["on_delete"]),' ON UPDATE: ',html_select("on_update",array(-1=>"")+explode("|",$vf),$J["on_update"]),doc_link(array('sql'=>"innodb-foreign-key-constraints.html",'mariadb'=>"foreign-keys/",'pgsql'=>"sql-createtable.html#SQL-CREATETABLE-REFERENCES",'mssql'=>"ms174979.aspx",'oracle'=>"https://docs.oracle.com/cd/B19306_01/server.102/b14200/clauses002.htm#sthref2903",)),'<p>
<input type="submit" value="Enregistrer">
<noscript><p><input type="submit" name="add" value="Ajouter une colonne"></noscript>
';if($C!=""){echo'<input type="submit" name="drop" value="Supprimer">',confirm(sprintf('Supprimer %s?',$C));}echo'<input type="hidden" name="token" value="',$si,'">
</form>
';}elseif(isset($_GET["view"])){$a=$_GET["view"];$J=$_POST;$Lf="VIEW";if($w=="pgsql"&&$a!=""){$O=table_status($a);$Lf=strtoupper($O["Engine"]);}if($_POST&&!$l){$C=trim($J["name"]);$Ga=" AS\n$J[select]";$A=ME."table=".urlencode($C);$Qe='La vue a été modifiée.';$T=($_POST["materialized"]?"MATERIALIZED VIEW":"VIEW");if(!$_POST["drop"]&&$a==$C&&$w!="sqlite"&&$T=="VIEW"&&$Lf=="VIEW")query_redirect(($w=="mssql"?"ALTER":"CREATE OR REPLACE")." VIEW ".table($C).$Ga,$A,$Qe);else{$di=$C."_adminer_".uniqid();drop_create("DROP $Lf ".table($a),"CREATE $T ".table($C).$Ga,"DROP $T ".table($C),"CREATE $T ".table($di).$Ga,"DROP $T ".table($di),($_POST["drop"]?substr(ME,0,-1):$A),'La vue a été effacée.',$Qe,'La vue a été créée.',$a,$C);}}if(!$_POST&&$a!=""){$J=view($a);$J["name"]=$a;$J["materialized"]=($Lf!="VIEW");if(!$l)$l=error();}page_header(($a!=""?'Modifier une vue':'Créer une vue'),$l,array("table"=>$a),h($a));echo'
<form action="" method="post">
<p>Nom: <input name="name" value="',h($J["name"]),'" data-maxlength="64" autocapitalize="off">
',(support("materializedview")?" ".checkbox("materialized",1,$J["materialized"],'Vue matérialisée'):""),'<p>';textarea("select",$J["select"]);echo'<p>
<input type="submit" value="Enregistrer">
';if($a!=""){echo'<input type="submit" name="drop" value="Supprimer">',confirm(sprintf('Supprimer %s?',$a));}echo'<input type="hidden" name="token" value="',$si,'">
</form>
';}elseif(isset($_GET["event"])){$aa=$_GET["event"];$ce=array("YEAR","QUARTER","MONTH","DAY","HOUR","MINUTE","WEEK","SECOND","YEAR_MONTH","DAY_HOUR","DAY_MINUTE","DAY_SECOND","HOUR_MINUTE","HOUR_SECOND","MINUTE_SECOND");$Jh=array("ENABLED"=>"ENABLE","DISABLED"=>"DISABLE","SLAVESIDE_DISABLED"=>"DISABLE ON SLAVE");$J=$_POST;if($_POST&&!$l){if($_POST["drop"])query_redirect("DROP EVENT ".idf_escape($aa),substr(ME,0,-1),'L\'évènement a été supprimé.');elseif(in_array($J["INTERVAL_FIELD"],$ce)&&isset($Jh[$J["STATUS"]])){$dh="\nON SCHEDULE ".($J["INTERVAL_VALUE"]?"EVERY ".q($J["INTERVAL_VALUE"])." $J[INTERVAL_FIELD]".($J["STARTS"]?" STARTS ".q($J["STARTS"]):"").($J["ENDS"]?" ENDS ".q($J["ENDS"]):""):"AT ".q($J["STARTS"]))." ON COMPLETION".($J["ON_COMPLETION"]?"":" NOT")." PRESERVE";queries_redirect(substr(ME,0,-1),($aa!=""?'L\'évènement a été modifié.':'L\'évènement a été créé.'),queries(($aa!=""?"ALTER EVENT ".idf_escape($aa).$dh.($aa!=$J["EVENT_NAME"]?"\nRENAME TO ".idf_escape($J["EVENT_NAME"]):""):"CREATE EVENT ".idf_escape($J["EVENT_NAME"]).$dh)."\n".$Jh[$J["STATUS"]]." COMMENT ".q($J["EVENT_COMMENT"]).rtrim(" DO\n$J[EVENT_DEFINITION]",";").";"));}}page_header(($aa!=""?'Modifier un évènement'.": ".h($aa):'Créer un évènement'),$l);if(!$J&&$aa!=""){$K=get_rows("SELECT * FROM information_schema.EVENTS WHERE EVENT_SCHEMA = ".q(DB)." AND EVENT_NAME = ".q($aa));$J=reset($K);}echo'
<form action="" method="post">
<table cellspacing="0" class="layout">
<tr><th>Nom<td><input name="EVENT_NAME" value="',h($J["EVENT_NAME"]),'" data-maxlength="64" autocapitalize="off">
<tr><th title="datetime">Démarrer<td><input name="STARTS" value="',h("$J[EXECUTE_AT]$J[STARTS]"),'">
<tr><th title="datetime">Terminer<td><input name="ENDS" value="',h($J["ENDS"]),'">
<tr><th>Chaque<td><input type="number" name="INTERVAL_VALUE" value="',h($J["INTERVAL_VALUE"]),'" class="size"> ',html_select("INTERVAL_FIELD",$ce,$J["INTERVAL_FIELD"]),'<tr><th>Statut<td>',html_select("STATUS",$Jh,$J["STATUS"]),'<tr><th>Commentaire<td><input name="EVENT_COMMENT" value="',h($J["EVENT_COMMENT"]),'" data-maxlength="64">
<tr><th><td>',checkbox("ON_COMPLETION","PRESERVE",$J["ON_COMPLETION"]=="PRESERVE",'Conserver quand complété'),'</table>
<p>';textarea("EVENT_DEFINITION",$J["EVENT_DEFINITION"]);echo'<p>
<input type="submit" value="Enregistrer">
';if($aa!=""){echo'<input type="submit" name="drop" value="Supprimer">',confirm(sprintf('Supprimer %s?',$aa));}echo'<input type="hidden" name="token" value="',$si,'">
</form>
';}elseif(isset($_GET["procedure"])){$da=($_GET["name"]?$_GET["name"]:$_GET["procedure"]);$Yg=(isset($_GET["function"])?"FUNCTION":"PROCEDURE");$J=$_POST;$J["fields"]=(array)$J["fields"];if($_POST&&!process_fields($J["fields"])&&!$l){$If=routine($_GET["procedure"],$Yg);$di="$J[name]_adminer_".uniqid();drop_create("DROP $Yg ".routine_id($da,$If),create_routine($Yg,$J),"DROP $Yg ".routine_id($J["name"],$J),create_routine($Yg,array("name"=>$di)+$J),"DROP $Yg ".routine_id($di,$J),substr(ME,0,-1),'La routine a été supprimée.','La routine a été modifiée.','La routine a été créée.',$da,$J["name"]);}page_header(($da!=""?(isset($_GET["function"])?'Modifier la fonction':'Modifier la procédure').": ".h($da):(isset($_GET["function"])?'Créer une fonction':'Créer une procédure')),$l);if(!$_POST&&$da!=""){$J=routine($_GET["procedure"],$Yg);$J["name"]=$da;}$nb=get_vals("SHOW CHARACTER SET");sort($nb);$Zg=routine_languages();echo'
<form action="" method="post" id="form">
<p>Nom: <input name="name" value="',h($J["name"]),'" data-maxlength="64" autocapitalize="off">
',($Zg?'Langue'.": ".html_select("language",$Zg,$J["language"])."\n":""),'<input type="submit" value="Enregistrer">
<div class="scrollable">
<table cellspacing="0" class="nowrap">
';edit_fields($J["fields"],$nb,$Yg);if(isset($_GET["function"])){echo"<tr><td>".'Type de retour';edit_type("returns",$J["returns"],$nb,array(),($w=="pgsql"?array("void","trigger"):array()));}echo'</table>
',script("editFields();"),'</div>
<p>';textarea("definition",$J["definition"]);echo'<p>
<input type="submit" value="Enregistrer">
';if($da!=""){echo'<input type="submit" name="drop" value="Supprimer">',confirm(sprintf('Supprimer %s?',$da));}echo'<input type="hidden" name="token" value="',$si,'">
</form>
';}elseif(isset($_GET["sequence"])){$fa=$_GET["sequence"];$J=$_POST;if($_POST&&!$l){$z=substr(ME,0,-1);$C=trim($J["name"]);if($_POST["drop"])query_redirect("DROP SEQUENCE ".idf_escape($fa),$z,'La séquence a été supprimée.');elseif($fa=="")query_redirect("CREATE SEQUENCE ".idf_escape($C),$z,'La séquence a été créée.');elseif($fa!=$C)query_redirect("ALTER SEQUENCE ".idf_escape($fa)." RENAME TO ".idf_escape($C),$z,'La séquence a été modifiée.');else
redirect($z);}page_header($fa!=""?'Modifier la séquence'.": ".h($fa):'Créer une séquence',$l);if(!$J)$J["name"]=$fa;echo'
<form action="" method="post">
<p><input name="name" value="',h($J["name"]),'" autocapitalize="off">
<input type="submit" value="Enregistrer">
';if($fa!="")echo"<input type='submit' name='drop' value='".'Supprimer'."'>".confirm(sprintf('Supprimer %s?',$fa))."\n";echo'<input type="hidden" name="token" value="',$si,'">
</form>
';}elseif(isset($_GET["type"])){$ga=$_GET["type"];$J=$_POST;if($_POST&&!$l){$z=substr(ME,0,-1);if($_POST["drop"])query_redirect("DROP TYPE ".idf_escape($ga),$z,'Le type a été supprimé.');else
query_redirect("CREATE TYPE ".idf_escape(trim($J["name"]))." $J[as]",$z,'Le type a été créé.');}page_header($ga!=""?'Modifier le type'.": ".h($ga):'Créer un type',$l);if(!$J)$J["as"]="AS ";echo'
<form action="" method="post">
<p>
';if($ga!="")echo"<input type='submit' name='drop' value='".'Supprimer'."'>".confirm(sprintf('Supprimer %s?',$ga))."\n";else{echo"<input name='name' value='".h($J['name'])."' autocapitalize='off'>\n";textarea("as",$J["as"]);echo"<p><input type='submit' value='".'Enregistrer'."'>\n";}echo'<input type="hidden" name="token" value="',$si,'">
</form>
';}elseif(isset($_GET["trigger"])){$a=$_GET["trigger"];$C=$_GET["name"];$Ci=trigger_options();$J=(array)trigger($C,$a)+array("Trigger"=>$a."_bi");if($_POST){if(!$l&&in_array($_POST["Timing"],$Ci["Timing"])&&in_array($_POST["Event"],$Ci["Event"])&&in_array($_POST["Type"],$Ci["Type"])){$uf=" ON ".table($a);$nc="DROP TRIGGER ".idf_escape($C).($w=="pgsql"?$uf:"");$A=ME."table=".urlencode($a);if($_POST["drop"])query_redirect($nc,$A,'Le déclencheur a été supprimé.');else{if($C!="")queries($nc);queries_redirect($A,($C!=""?'Le déclencheur a été modifié.':'Le déclencheur a été créé.'),queries(create_trigger($uf,$_POST)));if($C!="")queries(create_trigger($uf,$J+array("Type"=>reset($Ci["Type"]))));}}$J=$_POST;}page_header(($C!=""?'Modifier un déclencheur'.": ".h($C):'Ajouter un déclencheur'),$l,array("table"=>$a));echo'
<form action="" method="post" id="form">
<table cellspacing="0" class="layout">
<tr><th>Temps<td>',html_select("Timing",$Ci["Timing"],$J["Timing"],"triggerChange(/^".preg_quote($a,"/")."_[ba][iud]$/, '".js_escape($a)."', this.form);"),'<tr><th>Évènement<td>',html_select("Event",$Ci["Event"],$J["Event"],"this.form['Timing'].onchange();"),(in_array("UPDATE OF",$Ci["Event"])?" <input name='Of' value='".h($J["Of"])."' class='hidden'>":""),'<tr><th>Type<td>',html_select("Type",$Ci["Type"],$J["Type"]),'</table>
<p>Nom: <input name="Trigger" value="',h($J["Trigger"]),'" data-maxlength="64" autocapitalize="off">
',script("qs('#form')['Timing'].onchange();"),'<p>';textarea("Statement",$J["Statement"]);echo'<p>
<input type="submit" value="Enregistrer">
';if($C!=""){echo'<input type="submit" name="drop" value="Supprimer">',confirm(sprintf('Supprimer %s?',$C));}echo'<input type="hidden" name="token" value="',$si,'">
</form>
';}elseif(isset($_GET["user"])){$ha=$_GET["user"];$vg=array(""=>array("All privileges"=>""));foreach(get_rows("SHOW PRIVILEGES")as$J){foreach(explode(",",($J["Privilege"]=="Grant option"?"":$J["Context"]))as$Eb)$vg[$Eb][$J["Privilege"]]=$J["Comment"];}$vg["Server Admin"]+=$vg["File access on server"];$vg["Databases"]["Create routine"]=$vg["Procedures"]["Create routine"];unset($vg["Procedures"]["Create routine"]);$vg["Columns"]=array();foreach(array("Select","Insert","Update","References")as$X)$vg["Columns"][$X]=$vg["Tables"][$X];unset($vg["Server Admin"]["Usage"]);foreach($vg["Tables"]as$x=>$X)unset($vg["Databases"][$x]);$df=array();if($_POST){foreach($_POST["objects"]as$x=>$X)$df[$X]=(array)$df[$X]+(array)$_POST["grants"][$x];}$vd=array();$sf="";if(isset($_GET["host"])&&($H=$f->query("SHOW GRANTS FOR ".q($ha)."@".q($_GET["host"])))){while($J=$H->fetch_row()){if(preg_match('~GRANT (.*) ON (.*) TO ~',$J[0],$B)&&preg_match_all('~ *([^(,]*[^ ,(])( *\([^)]+\))?~',$B[1],$Ie,PREG_SET_ORDER)){foreach($Ie
as$X){if($X[1]!="USAGE")$vd["$B[2]$X[2]"][$X[1]]=true;if(preg_match('~ WITH GRANT OPTION~',$J[0]))$vd["$B[2]$X[2]"]["GRANT OPTION"]=true;}}if(preg_match("~ IDENTIFIED BY PASSWORD '([^']+)~",$J[0],$B))$sf=$B[1];}}if($_POST&&!$l){$tf=(isset($_GET["host"])?q($ha)."@".q($_GET["host"]):"''");if($_POST["drop"])query_redirect("DROP USER $tf",ME."privileges=",'L\'utilisateur a été effacé.');else{$ff=q($_POST["user"])."@".q($_POST["host"]);$cg=$_POST["pass"];if($cg!=''&&!$_POST["hashed"]&&!min_version(8)){$cg=$f->result("SELECT PASSWORD(".q($cg).")");$l=!$cg;}$Kb=false;if(!$l){if($tf!=$ff){$Kb=queries((min_version(5)?"CREATE USER":"GRANT USAGE ON *.* TO")." $ff IDENTIFIED BY ".(min_version(8)?"":"PASSWORD ").q($cg));$l=!$Kb;}elseif($cg!=$sf)queries("SET PASSWORD FOR $ff = ".q($cg));}if(!$l){$Vg=array();foreach($df
as$lf=>$ud){if(isset($_GET["grant"]))$ud=array_filter($ud);$ud=array_keys($ud);if(isset($_GET["grant"]))$Vg=array_diff(array_keys(array_filter($df[$lf],'strlen')),$ud);elseif($tf==$ff){$qf=array_keys((array)$vd[$lf]);$Vg=array_diff($qf,$ud);$ud=array_diff($ud,$qf);unset($vd[$lf]);}if(preg_match('~^(.+)\s*(\(.*\))?$~U',$lf,$B)&&(!grant("REVOKE",$Vg,$B[2]," ON $B[1] FROM $ff")||!grant("GRANT",$ud,$B[2]," ON $B[1] TO $ff"))){$l=true;break;}}}if(!$l&&isset($_GET["host"])){if($tf!=$ff)queries("DROP USER $tf");elseif(!isset($_GET["grant"])){foreach($vd
as$lf=>$Vg){if(preg_match('~^(.+)(\(.*\))?$~U',$lf,$B))grant("REVOKE",array_keys($Vg),$B[2]," ON $B[1] FROM $ff");}}}queries_redirect(ME."privileges=",(isset($_GET["host"])?'L\'utilisateur a été modifié.':'L\'utilisateur a été créé.'),!$l);if($Kb)$f->query("DROP USER $ff");}}page_header((isset($_GET["host"])?'Utilisateur'.": ".h("$ha@$_GET[host]"):'Créer un utilisateur'),$l,array("privileges"=>array('','Privilèges')));if($_POST){$J=$_POST;$vd=$df;}else{$J=$_GET+array("host"=>$f->result("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', -1)"));$J["pass"]=$sf;if($sf!="")$J["hashed"]=true;$vd[(DB==""||$vd?"":idf_escape(addcslashes(DB,"%_\\"))).".*"]=array();}echo'<form action="" method="post">
<table cellspacing="0" class="layout">
<tr><th>Serveur<td><input name="host" data-maxlength="60" value="',h($J["host"]),'" autocapitalize="off">
<tr><th>Utilisateur<td><input name="user" data-maxlength="80" value="',h($J["user"]),'" autocapitalize="off">
<tr><th>Mot de passe<td><input name="pass" id="pass" value="',h($J["pass"]),'" autocomplete="new-password">
';if(!$J["hashed"])echo
script("typePassword(qs('#pass'));");echo(min_version(8)?"":checkbox("hashed",1,$J["hashed"],'Haché',"typePassword(this.form['pass'], this.checked);")),'</table>

';echo"<table cellspacing='0'>\n","<thead><tr><th colspan='2'>".'Privilèges'.doc_link(array('sql'=>"grant.html#priv_level"));$r=0;foreach($vd
as$lf=>$ud){echo'<th>'.($lf!="*.*"?"<input name='objects[$r]' value='".h($lf)."' size='10' autocapitalize='off'>":"<input type='hidden' name='objects[$r]' value='*.*' size='10'>*.*");$r++;}echo"</thead>\n";foreach(array(""=>"","Server Admin"=>'Serveur',"Databases"=>'Base de données',"Tables"=>'Table',"Columns"=>'Colonne',"Procedures"=>'Routine',)as$Eb=>$fc){foreach((array)$vg[$Eb]as$ug=>$tb){echo"<tr".odd()."><td".($fc?">$fc<td":" colspan='2'").' lang="en" title="'.h($tb).'">'.h($ug);$r=0;foreach($vd
as$lf=>$ud){$C="'grants[$r][".h(strtoupper($ug))."]'";$Y=$ud[strtoupper($ug)];if($Eb=="Server Admin"&&$lf!=(isset($vd["*.*"])?"*.*":".*"))echo"<td>";elseif(isset($_GET["grant"]))echo"<td><select name=$C><option><option value='1'".($Y?" selected":"").">".'Grant'."<option value='0'".($Y=="0"?" selected":"").">".'Revoke'."</select>";else{echo"<td align='center'><label class='block'>","<input type='checkbox' name=$C value='1'".($Y?" checked":"").($ug=="All privileges"?" id='grants-$r-all'>":">".($ug=="Grant option"?"":script("qsl('input').onclick = function () { if (this.checked) formUncheck('grants-$r-all'); };"))),"</label>";}$r++;}}}echo"</table>\n",'<p>
<input type="submit" value="Enregistrer">
';if(isset($_GET["host"])){echo'<input type="submit" name="drop" value="Supprimer">',confirm(sprintf('Supprimer %s?',"$ha@$_GET[host]"));}echo'<input type="hidden" name="token" value="',$si,'">
</form>
';}elseif(isset($_GET["processlist"])){if(support("kill")){if($_POST&&!$l){$pe=0;foreach((array)$_POST["kill"]as$X){if(kill_process($X))$pe++;}queries_redirect(ME."processlist=",lang(array('%d processus a été arrêté.','%d processus ont été arrêtés.'),$pe),$pe||!$_POST["kill"]);}}page_header('Liste des processus',$l);echo'
<form action="" method="post">
<div class="scrollable">
<table cellspacing="0" class="nowrap checkable">
',script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});");$r=-1;foreach(process_list()as$r=>$J){if(!$r){echo"<thead><tr lang='en'>".(support("kill")?"<th>":"");foreach($J
as$x=>$X)echo"<th>$x".doc_link(array('sql'=>"show-processlist.html#processlist_".strtolower($x),'pgsql'=>"monitoring-stats.html#PG-STAT-ACTIVITY-VIEW",'oracle'=>"REFRN30223",));echo"</thead>\n";}echo"<tr".odd().">".(support("kill")?"<td>".checkbox("kill[]",$J[$w=="sql"?"Id":"pid"],0):"");foreach($J
as$x=>$X)echo"<td>".(($w=="sql"&&$x=="Info"&&preg_match("~Query|Killed~",$J["Command"])&&$X!="")||($w=="pgsql"&&$x=="current_query"&&$X!="<IDLE>")||($w=="oracle"&&$x=="sql_text"&&$X!="")?"<code class='jush-$w'>".shorten_utf8($X,100,"</code>").' <a href="'.h(ME.($J["db"]!=""?"db=".urlencode($J["db"])."&":"")."sql=".urlencode($X)).'">'.'Cloner'.'</a>':h($X));echo"\n";}echo'</table>
</div>
<p>
';if(support("kill")){echo($r+1)."/".sprintf('%d au total',max_connections()),"<p><input type='submit' value='".'Arrêter'."'>\n";}echo'<input type="hidden" name="token" value="',$si,'">
</form>
',script("tableCheck();");}elseif(isset($_GET["select"])){$a=$_GET["select"];$R=table_status1($a);$v=indexes($a);$n=fields($a);$md=column_foreign_keys($a);$of=$R["Oid"];parse_str($_COOKIE["adminer_import"],$za);$Wg=array();$e=array();$hi=null;foreach($n
as$x=>$m){$C=$b->fieldName($m);if(isset($m["privileges"]["select"])&&$C!=""){$e[$x]=html_entity_decode(strip_tags($C),ENT_QUOTES);if(is_shortable($m))$hi=$b->selectLengthProcess();}$Wg+=$m["privileges"];}list($L,$wd)=$b->selectColumnsProcess($e,$v);$ge=count($wd)<count($L)||strstr($L[0],"DISTINCT");$Z=$b->selectSearchProcess($n,$v);$Ef=$b->selectOrderProcess($n,$v);$y=$b->selectLimitProcess();if($_GET["val"]&&is_ajax()){header("Content-Type: text/plain; charset=utf-8");foreach($_GET["val"]as$Ji=>$J){$Ga=convert_field($n[key($J)]);$L=array($Ga?$Ga:idf_escape(key($J)));$Z[]=where_check($Ji,$n);$I=$k->select($a,$L,$Z,$L);if($I)echo
reset($I->fetch_row());}exit;}$qg=$Li=null;foreach($v
as$u){if($u["type"]=="PRIMARY"){$qg=array_flip($u["columns"]);$Li=($L?$qg:array());foreach($Li
as$x=>$X){if(in_array(idf_escape($x),$L))unset($Li[$x]);}break;}}if($of&&!$qg){$qg=$Li=array($of=>0);$v[]=array("type"=>"PRIMARY","columns"=>array($of));}if($_POST&&!$l){$mj=$Z;if(!$_POST["all"]&&is_array($_POST["check"])){$eb=array();foreach($_POST["check"]as$bb)$eb[]=where_check($bb,$n);$mj[]="((".implode(") OR (",$eb)."))";}$mj=($mj?"\nWHERE ".implode(" AND ",$mj):"");if($_POST["export"]){cookie("adminer_import","output=".urlencode($_POST["output"])."&format=".urlencode($_POST["format"]));dump_headers($a);$b->dumpTable($a,"");$rd=($L?implode(", ",$L):"*").convert_fields($e,$n,$L)."\nFROM ".table($a);$yd=($wd&&$ge?"\nGROUP BY ".implode(", ",$wd):"").($Ef?"\nORDER BY ".implode(", ",$Ef):"");if(!is_array($_POST["check"])||$qg)$G="SELECT $rd$mj$yd";else{$Hi=array();foreach($_POST["check"]as$X)$Hi[]="(SELECT".limit($rd,"\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$n).$yd,1).")";$G=implode(" UNION ALL ",$Hi);}$b->dumpData($a,"table",$G);exit;}if(!$b->selectEmailProcess($Z,$md)){if($_POST["save"]||$_POST["delete"]){$H=true;$_a=0;$N=array();if(!$_POST["delete"]){foreach($e
as$C=>$X){$X=process_input($n[$C]);if($X!==null&&($_POST["clone"]||$X!==false))$N[idf_escape($C)]=($X!==false?$X:idf_escape($C));}}if($_POST["delete"]||$N){if($_POST["clone"])$G="INTO ".table($a)." (".implode(", ",array_keys($N)).")\nSELECT ".implode(", ",$N)."\nFROM ".table($a);if($_POST["all"]||($qg&&is_array($_POST["check"]))||$ge){$H=($_POST["delete"]?$k->delete($a,$mj):($_POST["clone"]?queries("INSERT $G$mj"):$k->update($a,$N,$mj)));$_a=$f->affected_rows;}else{foreach((array)$_POST["check"]as$X){$ij="\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$n);$H=($_POST["delete"]?$k->delete($a,$ij,1):($_POST["clone"]?queries("INSERT".limit1($a,$G,$ij)):$k->update($a,$N,$ij,1)));if(!$H)break;$_a+=$f->affected_rows;}}}$Qe=lang(array('%d élément a été modifié.','%d éléments ont été modifiés.'),$_a);if($_POST["clone"]&&$H&&$_a==1){$ue=last_id();if($ue)$Qe=sprintf('L\'élément%s a été inséré.'," $ue");}queries_redirect(remove_from_uri($_POST["all"]&&$_POST["delete"]?"page":""),$Qe,$H);if(!$_POST["delete"]){edit_form($a,$n,(array)$_POST["fields"],!$_POST["clone"]);page_footer();exit;}}elseif(!$_POST["import"]){if(!$_POST["val"])$l='Ctrl+cliquez sur une valeur pour la modifier.';else{$H=true;$_a=0;foreach($_POST["val"]as$Ji=>$J){$N=array();foreach($J
as$x=>$X){$x=bracket_escape($x,1);$N[idf_escape($x)]=(preg_match('~char|text~',$n[$x]["type"])||$X!=""?$b->processInput($n[$x],$X):"NULL");}$H=$k->update($a,$N," WHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($Ji,$n),!$ge&&!$qg," ");if(!$H)break;$_a+=$f->affected_rows;}queries_redirect(remove_from_uri(),lang(array('%d élément a été modifié.','%d éléments ont été modifiés.'),$_a),$H);}}elseif(!is_string($bd=get_file("csv_file",true)))$l=upload_error($bd);elseif(!preg_match('~~u',$bd))$l='Les fichiers doivent être encodés en UTF-8.';else{cookie("adminer_import","output=".urlencode($za["output"])."&format=".urlencode($_POST["separator"]));$H=true;$pb=array_keys($n);preg_match_all('~(?>"[^"]*"|[^"\r\n]+)+~',$bd,$Ie);$_a=count($Ie[0]);$k->begin();$mh=($_POST["separator"]=="csv"?",":($_POST["separator"]=="tsv"?"\t":";"));$K=array();foreach($Ie[0]as$x=>$X){preg_match_all("~((?>\"[^\"]*\")+|[^$mh]*)$mh~",$X.$mh,$Je);if(!$x&&!array_diff($Je[1],$pb)){$pb=$Je[1];$_a--;}else{$N=array();foreach($Je[1]as$r=>$kb)$N[idf_escape($pb[$r])]=($kb==""&&$n[$pb[$r]]["null"]?"NULL":q(str_replace('""','"',preg_replace('~^"|"$~','',$kb))));$K[]=$N;}}$H=(!$K||$k->insertUpdate($a,$K,$qg));if($H)$H=$k->commit();queries_redirect(remove_from_uri("page"),lang(array('%d ligne a été importée.','%d lignes ont été importées.'),$_a),$H);$k->rollback();}}}$Th=$b->tableName($R);if(is_ajax()){page_headers();ob_start();}else
page_header('Sélectionner'.": $Th",$l);$N=null;if(isset($Wg["insert"])||!support("table")){$N="";foreach((array)$_GET["where"]as$X){if($md[$X["col"]]&&count($md[$X["col"]])==1&&($X["op"]=="="||(!$X["op"]&&!preg_match('~[_%]~',$X["val"]))))$N.="&set".urlencode("[".bracket_escape($X["col"])."]")."=".urlencode($X["val"]);}}$b->selectLinks($R,$N);if(!$e&&support("table"))echo"<p class='error'>".'Impossible de sélectionner la table'.($n?".":": ".error())."\n";else{echo"<form action='' id='form'>\n","<div style='display: none;'>";hidden_fields_get();echo(DB!=""?'<input type="hidden" name="db" value="'.h(DB).'">'.(isset($_GET["ns"])?'<input type="hidden" name="ns" value="'.h($_GET["ns"]).'">':""):"");echo'<input type="hidden" name="select" value="'.h($a).'">','<input type="submit" value="'.h('Sélectionner').'">';echo"</div>\n";$b->selectColumnsPrint($L,$e);$b->selectSearchPrint($Z,$e,$v);$b->selectOrderPrint($Ef,$e,$v);$b->selectLimitPrint($y);$b->selectLengthPrint($hi);$b->selectActionPrint($v);echo"</form>\n";$E=$_GET["page"];if($E=="last"){$pd=$f->result(count_rows($a,$Z,$ge,$wd));$E=floor(max(0,$pd-1)/$y);}$hh=$L;$xd=$wd;if(!$hh){$hh[]="*";$Fb=convert_fields($e,$n,$L);if($Fb)$hh[]=substr($Fb,2);}foreach($L
as$x=>$X){$m=$n[idf_unescape($X)];if($m&&($Ga=convert_field($m)))$hh[$x]="$Ga AS $X";}if(!$ge&&$Li){foreach($Li
as$x=>$X){$hh[]=idf_escape($x);if($xd)$xd[]=idf_escape($x);}}$H=$k->select($a,$hh,$Z,$xd,$Ef,$y,$E,true);if(!$H)echo"<p class='error'>".error()."\n";else{if($w=="mssql"&&$E)$H->seek($y*$E);$_c=array();echo"<form action='' method='post' enctype='multipart/form-data'>\n";$K=array();while($J=$H->fetch_assoc()){if($E&&$w=="oracle")unset($J["RNUM"]);$K[]=$J;}if($_GET["page"]!="last"&&$y!=""&&$wd&&$ge&&$w=="sql")$pd=$f->result(" SELECT FOUND_ROWS()");if(!$K)echo"<p class='message'>".'Aucun résultat.'."\n";else{$Pa=$b->backwardKeys($a,$Th);echo"<div class='scrollable'>","<table id='table' cellspacing='0' class='nowrap checkable'>",script("mixin(qs('#table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true), onkeydown: editingKeydown});"),"<thead><tr>".(!$wd&&$L?"":"<td><input type='checkbox' id='all-page' class='jsonly'>".script("qs('#all-page').onclick = partial(formCheck, /check/);","")." <a href='".h($_GET["modify"]?remove_from_uri("modify"):$_SERVER["REQUEST_URI"]."&modify=1")."' title='".'Modification'."' class='edit-all'>".'Modification'."</a>");$bf=array();$sd=array();reset($L);$Dg=1;foreach($K[0]as$x=>$X){if(!isset($Li[$x])){$X=$_GET["columns"][key($L)]??null;$m=$n[$L?($X?$X["col"]:current($L)):$x];$C=($m?$b->fieldName($m,$Dg):($X["fun"]?"*":$x));if($C!=""){$Dg++;$bf[$x]=$C;$d=idf_escape($x);$Kd=remove_from_uri('(order|desc)[^=]*|page').'&order%5B0%5D='.urlencode($x);$fc="&desc%5B0%5D=1";echo"<th id='th[".h(bracket_escape($x))."]'>".script("mixin(qsl('th'), {onmouseover: partial(columnMouse), onmouseout: partial(columnMouse, ' hidden')});",""),'<a href="'.h($Kd.($Ef[0]==$d||$Ef[0]==$x||(!$Ef&&$ge&&$wd[0]==$d)?$fc:'')).'">';echo
apply_sql_function($X["fun"]??null,$C)."</a>";echo"<span class='column hidden'>","<a href='".h($Kd.$fc)."' title='".'décroissant'."' class='text'> ↓</a>";if(isset($X["fun"])===false){echo'<a href="#fieldset-search" title="'.'Rechercher'.'" class="text jsonly"> =</a>',script("qsl('a').onclick = partial(selectSearch, '".js_escape($x)."');");}echo"</span>";}$sd[$x]=$X["fun"]??null;next($L);}}$_e=array();if($_GET["modify"]){foreach($K
as$J){foreach($J
as$x=>$X)$_e[$x]=max($_e[$x],min(40,strlen(utf8_decode($X))));}}echo($Pa?"<th>".'Relations':"")."</thead>\n";if(is_ajax()){if($y%2==1&&$E%2==1)odd();ob_end_clean();}foreach($b->rowDescriptions($K,$md)as$af=>$J){$Ii=unique_array($K[$af],$v);if(!$Ii){$Ii=array();foreach($K[$af]as$x=>$X){if(!preg_match('~^(COUNT\((\*|(DISTINCT )?`(?:[^`]|``)+`)\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\(`(?:[^`]|``)+`\))$~',$x))$Ii[$x]=$X;}}$Ji="";foreach($Ii
as$x=>$X){if(($w=="sql"||$w=="pgsql")&&preg_match('~char|text|enum|set~',$n[$x]["type"])&&strlen($X)>64){$x=(strpos($x,'(')?$x:idf_escape($x));$x="MD5(".($w!='sql'||preg_match("~^utf8~",$n[$x]["collation"])?$x:"CONVERT($x USING ".charset($f).")").")";$X=md5($X);}$Ji.="&".($X!==null?urlencode("where[".bracket_escape($x)."]")."=".urlencode($X===false?"f":$X):"null%5B%5D=".urlencode($x));}echo"<tr".odd().">".(!$wd&&$L?"":"<td>".checkbox("check[]",substr($Ji,1),in_array(substr($Ji,1),(array)$_POST["check"])).($ge||information_schema(DB)?"":" <a href='".h(ME."edit=".urlencode($a).$Ji)."' class='edit' title='".'modifier'."'>".'modifier'."</a>"));foreach($J
as$x=>$X){if(isset($bf[$x])){$m=$n[$x];$X=$k->value($X,$m);if($X!=""&&(!isset($_c[$x])||$_c[$x]!=""))$_c[$x]=(is_mail($X)?$bf[$x]:"");$z="";if(preg_match('~blob|bytea|raw|file~',$m["type"]??null)&&$X!="")$z=ME.'download='.urlencode($a).'&field='.urlencode($x).$Ji;if(!$z&&$X!==null){foreach((array)$md[$x]as$p){if(count($md[$x])==1||end($p["source"])==$x){$z="";foreach($p["source"]as$r=>$_h)$z.=where_link($r,$p["target"][$r],$K[$af][$_h]);$z=($p["db"]!=""?preg_replace('~([?&]db=)[^&]+~','\1'.urlencode($p["db"]),ME):ME).'select='.urlencode($p["table"]).$z;if($p["ns"])$z=preg_replace('~([?&]ns=)[^&]+~','\1'.urlencode($p["ns"]),$z);if(count($p["source"])==1)break;}}}if($x=="COUNT(*)"){$z=ME."select=".urlencode($a);$r=0;foreach((array)$_GET["where"]as$W){if(!array_key_exists($W["col"],$Ii))$z.=where_link($r++,$W["col"],$W["val"],$W["op"]);}foreach($Ii
as$le=>$W)$z.=where_link($r++,$le,$W);}$X=select_value($X,$z,$m,$hi);$s=h("val[$Ji][".bracket_escape($x)."]");$Y=null;if(isset($_POST["val"][$Ji][bracket_escape($x)]))$_POST["val"][$Ji][bracket_escape($x)];$vc=!is_array($J[$x])&&is_utf8($X)&&$K[$af][$x]==$J[$x]&&!$sd[$x];$gi=preg_match('~text|lob~',$m["type"]??null);echo"<td id='$s'";if(($_GET["modify"]&&$vc)||$Y!==null){$Ad=h($Y!==null?$Y:$J[$x]);echo">".($gi?"<textarea name='$s' cols='30' rows='".(substr_count($J[$x],"\n")+1)."'>$Ad</textarea>":"<input name='$s' value='$Ad' size='$_e[$x]'>");}else{$De=strpos($X,"<i>…</i>");echo" data-text='".($De?2:($gi?1:0))."'".($vc?"":" data-warning='".h('Utilisez le lien "modifier" pour modifier cette valeur.')."'").">$X</td>";}}}if($Pa)echo"<td>";$b->backwardKeysPrint($Pa,$K[$af]);echo"</tr>\n";}if(is_ajax())exit;echo"</table>\n","</div>\n";}if(!is_ajax()){if($K||$E){$Kc=true;if($_GET["page"]!="last"){if($y==""||(count($K)<$y&&($K||!$E)))$pd=($E?$E*$y:0)+count($K);elseif($w!="sql"||!$ge){$pd=($ge?false:found_rows($R,$Z));if($pd<max(1e4,2*($E+1)*$y))$pd=reset(slow_query(count_rows($a,$Z,$ge,$wd)));else$Kc=false;}}$Sf=($y!=""&&($pd===false||$pd>$y||$E));if($Sf){echo(($pd===false?count($K)+1:$pd-$E*$y)>$y?'<p><a href="'.h(remove_from_uri("page")."&page=".($E+1)).'" class="loadmore">'.'Charger plus de données'.'</a>'.script("qsl('a').onclick = partial(selectLoadMore, ".(+$y).", '".'Chargement'."…');",""):''),"\n";}}echo"<div class='footer'><div>\n";if($K||$E){if($Sf){$Le=($pd===false?$E+(count($K)>=$y?2:1):floor(($pd-1)/$y));echo"<fieldset>";if($w!="simpledb"){echo"<legend><a href='".h(remove_from_uri("page"))."'>".'Page'."</a></legend>",script("qsl('a').onclick = function () { pageClick(this.href, +prompt('".'Page'."', '".($E+1)."')); return false; };"),pagination(0,$E).($E>5?" …":"");for($r=max(1,$E-4);$r<min($Le,$E+5);$r++)echo
pagination($r,$E);if($Le>0){echo($E+5<$Le?" …":""),($Kc&&$pd!==false?pagination($Le,$E):" <a href='".h(remove_from_uri("page")."&page=last")."' title='~$Le'>".'dernière'."</a>");}}else{echo"<legend>".'Page'."</legend>",pagination(0,$E).($E>1?" …":""),($E?pagination($E,$E):""),($Le>$E?pagination($E+1,$E).($Le>$E+1?" …":""):"");}echo"</fieldset>\n";}echo"<fieldset>","<legend>".'Résultat entier'."</legend>";$kc=($Kc?"":"~ ").$pd;echo
checkbox("all",1,0,($pd!==false?($Kc?"":"~ ").lang(array('%d ligne','%d lignes'),$pd):""),"var checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$kc' : checked); selectCount('selected2', this.checked || !checked ? '$kc' : checked);")."\n","</fieldset>\n";if($b->selectCommandPrint()){echo'<fieldset',($_GET["modify"]?'':' class="jsonly"'),'><legend>Modification</legend><div>
<input type="submit" value="Enregistrer"',($_GET["modify"]?'':' title="'.'Ctrl+cliquez sur une valeur pour la modifier.'.'"'),'>
</div></fieldset>
<fieldset><legend>Sélectionnée(s) <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="Modifier">
<input type="submit" name="clone" value="Cloner">
<input type="submit" name="delete" value="Effacer">',confirm(),'</div></fieldset>
';}$nd=$b->dumpFormat();foreach((array)$_GET["columns"]as$d){if($d["fun"]){unset($nd['sql']);break;}}if($nd){print_fieldset("export",'Exporter'." <span id='selected2'></span>");$Pf=$b->dumpOutput();echo($Pf?html_select("output",$Pf,$za["output"])." ":""),html_select("format",$nd,$za["format"])," <input type='submit' name='export' value='".'Exporter'."'>\n","</div></fieldset>\n";}$b->selectEmailPrint(array_filter($_c,'strlen'),$e);}echo"</div></div>\n";if($b->selectImportPrint()){echo"<div>","<a href='#import'>".'Importer'."</a>",script("qsl('a').onclick = partial(toggle, 'import');",""),"<span id='import' class='hidden'>: ","<input type='file' name='csv_file'> ",html_select("separator",array("csv"=>"CSV,","csv;"=>"CSV;","tsv"=>"TSV"),$za["format"],1);echo" <input type='submit' name='import' value='".'Importer'."'>","</span>","</div>";}echo"<input type='hidden' name='token' value='$si'>\n","</form>\n",(!$wd&&$L?"":script("tableCheck();"));}}}if(is_ajax()){ob_end_clean();exit;}}elseif(isset($_GET["variables"])){$O=isset($_GET["status"]);page_header($O?'Statut':'Variables');$Zi=($O?show_status():show_variables());if(!$Zi)echo"<p class='message'>".'Aucun résultat.'."\n";else{echo"<table cellspacing='0'>\n";foreach($Zi
as$x=>$X){echo"<tr>","<th><code class='jush-".$w.($O?"status":"set")."'>".h($x)."</code>","<td>".h($X);}echo"</table>\n";}}elseif(isset($_GET["script"])){header("Content-Type: text/javascript; charset=utf-8");if($_GET["script"]=="db"){$Qh=array("Data_length"=>0,"Index_length"=>0,"Data_free"=>0);foreach(table_status()as$C=>$R){json_row("Comment-$C",h($R["Comment"]));if(!is_view($R)){foreach(array("Engine","Collation")as$x)json_row("$x-$C",h($R[$x]));foreach($Qh+array("Auto_increment"=>0,"Rows"=>0)as$x=>$X){if($R[$x]!=""){$X=format_number($R[$x]);json_row("$x-$C",($x=="Rows"&&$X&&$R["Engine"]==($w=="pgsql"?"table":"InnoDB")?"~ $X":$X));if(isset($Qh[$x]))$Qh[$x]+=($R["Engine"]!="InnoDB"||$x!="Data_free"?$R[$x]:0);}elseif(array_key_exists($x,$R))json_row("$x-$C");}}}foreach($Qh
as$x=>$X)json_row("sum-$x",format_number($X));json_row("");}elseif($_GET["script"]=="kill")$f->query("KILL ".number($_POST["kill"]));else{foreach(count_tables($b->databases())as$j=>$X){json_row("tables-$j",$X);json_row("size-$j",db_size($j));}json_row("");}exit;}else{$Zh=array_merge((array)$_POST["tables"],(array)$_POST["views"]);if($Zh&&!$l&&!$_POST["search"]){$H=true;$Qe="";if($w=="sql"&&$_POST["tables"]&&count($_POST["tables"])>1&&($_POST["drop"]||$_POST["truncate"]||$_POST["copy"]))queries("SET foreign_key_checks = 0");if($_POST["truncate"]){if($_POST["tables"])$H=truncate_tables($_POST["tables"]);$Qe='Les tables ont été tronquées.';}elseif($_POST["move"]){$H=move_tables((array)$_POST["tables"],(array)$_POST["views"],$_POST["target"]);$Qe='Les tables ont été déplacées.';}elseif($_POST["copy"]){$H=copy_tables((array)$_POST["tables"],(array)$_POST["views"],$_POST["target"]);$Qe='Les tables ont été copiées.';}elseif($_POST["drop"]){if($_POST["views"])$H=drop_views($_POST["views"]);if($H&&$_POST["tables"])$H=drop_tables($_POST["tables"]);$Qe='Les tables ont été effacées.';}elseif($w!="sql"){$H=($w=="sqlite"?queries("VACUUM"):apply_queries("VACUUM".($_POST["optimize"]?"":" ANALYZE"),$_POST["tables"]));$Qe='Les tables ont bien été optimisées.';}elseif(!$_POST["tables"])$Qe='Aucune table.';elseif($H=queries(($_POST["optimize"]?"OPTIMIZE":($_POST["check"]?"CHECK":($_POST["repair"]?"REPAIR":"ANALYZE")))." TABLE ".implode(", ",array_map('idf_escape',$_POST["tables"])))){while($J=$H->fetch_assoc())$Qe.="<b>".h($J["Table"])."</b>: ".h($J["Msg_text"])."<br>";}queries_redirect(substr(ME,0,-1),$Qe,$H);}page_header(($_GET["ns"]==""?'Base de données'.": ".h(DB):'Schéma'.": ".h($_GET["ns"])),$l,true);if($b->homepage()){if($_GET["ns"]!==""){echo"<h3 id='tables-views'>".'Tables et vues'."</h3>\n";$Yh=tables_list();if(!$Yh)echo"<p class='message'>".'Aucune table.'."\n";else{echo"<form action='' method='post'>\n";if(support("table")){echo"<fieldset><legend>".'Rechercher dans les tables'." <span id='selected2'></span></legend><div>","<input type='search' name='query' value='".h($_POST["query"])."'>",script("qsl('input').onkeydown = partialArg(bodyKeydown, 'search');","")," <input type='submit' name='search' value='".'Rechercher'."'>\n";if($b->operator_regexp!==null){echo"<p><label><input type='checkbox' name='regexp' value='1'".(empty($_POST['regexp'])?'':' checked').'>'.'sous forme d\'expression régulière'.'</label>',doc_link(array('sql'=>'regexp.html','pgsql'=>'functions-matching.html#FUNCTIONS-POSIX-REGEXP'))."</p>\n";}echo"</div></fieldset>\n";if($_POST["search"]&&$_POST["query"]!=""){$_GET["where"][0]["op"]=$b->operator_regexp===null||empty($_POST['regexp'])?"LIKE %%":$b->operator_regexp;search_tables();}}echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),'<thead><tr class="wrap">','<td><input id="check-all" type="checkbox" class="jsonly">'.script("qs('#check-all').onclick = partial(formCheck, /^(tables|views)\[/);",""),'<th>'.'Table','<td>'.'Moteur'.doc_link(array('sql'=>'storage-engines.html')),'<td>'.'Interclassement'.doc_link(array('sql'=>'charset-charsets.html','mariadb'=>'supported-character-sets-and-collations/')),'<td>'.'Longueur des données'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'functions-admin.html#FUNCTIONS-ADMIN-DBOBJECT','oracle'=>'REFRN20286')),'<td>'.'Longueur de l\'index'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'functions-admin.html#FUNCTIONS-ADMIN-DBOBJECT')),'<td>'.'Espace inutilisé'.doc_link(array('sql'=>'show-table-status.html')),'<td>'.'Incrément automatique'.doc_link(array('sql'=>'example-auto-increment.html','mariadb'=>'auto_increment/')),'<td>'.'Lignes'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'catalog-pg-class.html#CATALOG-PG-CLASS','oracle'=>'REFRN20286')),(support("comment")?'<td>'.'Commentaire'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'functions-info.html#FUNCTIONS-INFO-COMMENT-TABLE')):''),"</thead>\n";$S=0;foreach($Yh
as$C=>$T){$cj=($T!==null&&!preg_match('~table|sequence~i',$T));$s=h("Table-".$C);echo'<tr'.odd().'><td>'.checkbox(($cj?"views[]":"tables[]"),$C,in_array($C,$Zh,true),"","","",$s),'<th>'.(support("table")||support("indexes")?"<a href='".h(ME)."table=".urlencode($C)."' title='".'Afficher la structure'."' id='$s'>".h($C).'</a>':h($C));if($cj){echo'<td colspan="6"><a href="'.h(ME)."view=".urlencode($C).'" title="'.'Modifier une vue'.'">'.(preg_match('~materialized~i',$T)?'Vue matérialisée':'Vue').'</a>','<td align="right"><a href="'.h(ME)."select=".urlencode($C).'" title="'.'Afficher les données'.'">?</a>';}else{foreach(array("Engine"=>array(),"Collation"=>array(),"Data_length"=>array("create",'Modifier la table'),"Index_length"=>array("indexes",'Modifier les index'),"Data_free"=>array("edit",'Nouvel élément'),"Auto_increment"=>array("auto_increment=1&create",'Modifier la table'),"Rows"=>array("select",'Afficher les données'),)as$x=>$z){$s=" id='$x-".h($C)."'";echo($z?"<td align='right'>".(support("table")||$x=="Rows"||(support("indexes")&&$x!="Data_length")?"<a href='".h(ME."$z[0]=").urlencode($C)."'$s title='$z[1]'>?</a>":"<span$s>?</span>"):"<td id='$x-".h($C)."'>");}$S++;}echo(support("comment")?"<td id='Comment-".h($C)."'>":"");}echo"<tr><td><th>".sprintf('%d au total',count($Yh)),"<td>".h($w=="sql"?$f->result("SELECT @@default_storage_engine"):""),"<td>".h(db_collation(DB,collations()));foreach(array("Data_length","Index_length","Data_free")as$x)echo"<td align='right' id='sum-$x'>";echo"</table>\n","</div>\n";if(!information_schema(DB)){echo"<div class='footer'><div>\n";$Wi="<input type='submit' value='".'Vide'."'> ".on_help("'VACUUM'");$Bf="<input type='submit' name='optimize' value='".'Optimiser'."'> ".on_help($w=="sql"?"'OPTIMIZE TABLE'":"'VACUUM OPTIMIZE'");echo"<fieldset><legend>".'Sélectionnée(s)'." <span id='selected'></span></legend><div>".($w=="sqlite"?$Wi:($w=="pgsql"?$Wi.$Bf:($w=="sql"?"<input type='submit' value='".'Analyser'."'> ".on_help("'ANALYZE TABLE'").$Bf."<input type='submit' name='check' value='".'Vérifier'."'> ".on_help("'CHECK TABLE'")."<input type='submit' name='repair' value='".'Réparer'."'> ".on_help("'REPAIR TABLE'"):"")))."<input type='submit' name='truncate' value='".'Tronquer'."'> ".on_help($w=="sqlite"?"'DELETE'":"'TRUNCATE".($w=="pgsql"?"'":" TABLE'")).confirm()."<input type='submit' name='drop' value='".'Supprimer'."'>".on_help("'DROP TABLE'").confirm()."\n";$i=(support("scheme")?$b->schemas():$b->databases());if(count($i)!=1&&$w!="sqlite"){$j=(isset($_POST["target"])?$_POST["target"]:(support("scheme")?$_GET["ns"]:DB));echo"<p>".'Déplacer vers une autre base de données'.": ",($i?html_select("target",$i,$j):'<input name="target" value="'.h($j).'" autocapitalize="off">')," <input type='submit' name='move' value='".'Déplacer'."'>",(support("copy")?" <input type='submit' name='copy' value='".'Copier'."'> ".checkbox("overwrite",1,$_POST["overwrite"],'écraser'):""),"\n";}echo"<input type='hidden' name='all' value=''>";echo
script("qsl('input').onclick = function () { selectCount('selected', formChecked(this, /^(tables|views)\[/));".(support("table")?" selectCount('selected2', formChecked(this, /^tables\[/) || $S);":"")." }"),"<input type='hidden' name='token' value='$si'>\n","</div></fieldset>\n","</div></div>\n";}echo"</form>\n",script("tableCheck();");}$_=[];$_[]="<a href='".h(ME)."create='>".'Créer une table'."</a>";if(support("view"))$_[]="<a href='".h(ME)."view='>".'Créer une vue'."</a>";echo
generate_linksbar($_);if(support("routine")){echo"<h3 id='routines'>".'Routines'."</h3>\n";$ah=routines();if($ah){echo"<table cellspacing='0'>\n",'<thead><tr><th>'.'Nom'.'<td>'.'Type'.'<td>'.'Type de retour'."<td></thead>\n";odd('');foreach($ah
as$J){$C=($J["SPECIFIC_NAME"]==$J["ROUTINE_NAME"]?"":"&name=".urlencode($J["ROUTINE_NAME"]));echo'<tr'.odd().'>','<th><a href="'.h(ME.($J["ROUTINE_TYPE"]!="PROCEDURE"?'callf=':'call=').urlencode($J["SPECIFIC_NAME"]).$C).'">'.h($J["ROUTINE_NAME"]).'</a>','<td>'.h($J["ROUTINE_TYPE"]),'<td>'.h($J["DTD_IDENTIFIER"]),'<td><a href="'.h(ME.($J["ROUTINE_TYPE"]!="PROCEDURE"?'function=':'procedure=').urlencode($J["SPECIFIC_NAME"]).$C).'">'.'Modifier'."</a>";}echo"</table>\n";}$_=[];if(support('procedure'))$_[]="<a href='".h(ME)."procedure='>".'Créer une procédure'."</a>";$_[]="<a href='".h(ME)."function='>".'Créer une fonction'."</a>";echo
generate_linksbar($_);}if(support("sequence")){echo"<h3 id='sequences'>".'Séquences'."</h3>\n";$oh=get_vals("SELECT sequence_name FROM information_schema.sequences WHERE sequence_schema = current_schema() ORDER BY sequence_name");if($oh){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Nom'."</thead>\n";odd('');foreach($oh
as$X)echo"<tr".odd()."><th><a href='".h(ME)."sequence=".urlencode($X)."'>".h($X)."</a>\n";echo"</table>\n";}echo
generate_linksbar(["<a href='".h(ME)."sequence='>".'Créer une séquence'."</a>"]);}if(support("type")){echo"<h3 id='user-types'>".'Types utilisateur'."</h3>\n";$Ui=types();if($Ui){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Nom'."</thead>\n";odd('');foreach($Ui
as$X)echo"<tr".odd()."><th><a href='".h(ME)."type=".urlencode($X)."'>".h($X)."</a>\n";echo"</table>\n";}echo
generate_linksbar(["<a href='".h(ME)."type='>".'Créer un type'."</a>"]);}if(support("event")){echo"<h3 id='events'>".'Évènements'."</h3>\n";$K=get_rows("SHOW EVENTS");if($K){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Nom'."<td>".'Horaire'."<td>".'Démarrer'."<td>".'Terminer'."<td></thead>\n";foreach($K
as$J){echo"<tr>","<th>".h($J["Name"]),"<td>".($J["Execute at"]?'À un moment précis'."<td>".$J["Execute at"]:'Chaque'." ".$J["Interval value"]." ".$J["Interval field"]."<td>$J[Starts]"),"<td>$J[Ends]",'<td><a href="'.h(ME).'event='.urlencode($J["Name"]).'">'.'Modifier'.'</a>';}echo"</table>\n";$Ic=$f->result("SELECT @@event_scheduler");if($Ic&&$Ic!="ON")echo"<p class='error'><code class='jush-sqlset'>event_scheduler</code>: ".h($Ic)."\n";}echo
generate_linksbar(["<a href='".h(ME)."event='>".'Créer un évènement'."</a>"]);}if($Yh)echo
script("ajaxSetHtml('".js_escape(ME)."script=db');");}}}page_footer();