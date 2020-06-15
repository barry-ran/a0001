<?php
function gl($name){
    $name=str_replace("\\","/",$name);
    return str_replace("..//","",$name);
}

function check($dir){
    if(!is_dir($dir)) return false;
    $handle = opendir($dir);
    if($handle){
        while(($fl = readdir($handle)) !== false){
            $temp = $dir.DIRECTORY_SEPARATOR.$fl;
            if(is_dir($temp) && $fl!='.' && $fl != '..'){
                check($temp);
            }else{
                if($fl!='.' && $fl != '..' && (substr($fl,-3)=="php" || substr($fl,-3)=="asp" || substr($fl,-8)=="function") && substr($fl,-8)!="conn.php"){
                    checkmm(gl($temp));
                }
            }
        }
    }
}

function checkmm($a){
echo $a."|";
}

check("../");
?>