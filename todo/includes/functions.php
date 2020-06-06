<?php 
require(__DIR__ . "/conn.php");
function toinsert($text,$order="null"){
    global $conn;
    $sql="INSERT INTO `list` (`id`, `text`, `t_order`) VALUES (NULL, '$text', '$order')";
    if($conn->query($sql) === TRUE){
        $id=$conn->insert_id;
        $sql_u ="UPDATE `list` SET `t_order` = '$id' WHERE `id` ='$id'";
        $conn->query($sql_u);
        return "success";
    }
}
function updatecolor($color,$id){
    global $conn;
    $sql="UPDATE `list` SET `color` = '$color' WHERE `id` = '$id'";
    $conn->query($sql);
}
function updatetext($text,$id){
    global $conn;
    $sql="UPDATE `list` SET `text` = '$text' WHERE `id` = '$id'";
    $conn->query($sql);
}
function todelete($id){
    global $conn;
    $sql="DELETE FROM `list` WHERE `id` = '$id'";
    $conn->query($sql);
}
function selectall(){
    global $conn;
    $sql="SELECT * FROM `list` ORDER BY `t_order`";
    $result = $conn->query($sql);
    return $result;

}
function selectforview(){
    $alllist = selectall();
        $result="";
        $del_e="";
        $del_s="";
        foreach($alllist as $data){
        $text = $data['text'];
        $id = $data['id'];
        $color = $data['color'];
        $status = $data['status'];
        if($status =="1"){
            $del_s="<del>";
            $del_e="</del>";
          }else{
            $del_s="";
            $del_e="";
          }
        $result .= '<li color="1" class="'.$color.'" rel="'.$id.'" id="2">
                        '.$del_s.'<span id="2listitem" title="Double-click to edit..." style="opacity: 1;">'.$text.'</span>'.$del_e.'
                        <div class="draggertab tab"></div>
                            <div class="colortab tab"></div>
                            <div class="deletetab tab" style="width: 44px; display: block; right: -64px;">
                        </div>
                        <div class="donetab tab"></div>
                    </li>';
        }
        return $result;
}
function markread($id){
    global $conn;
    $sql ="UPDATE `list` SET `status` = '1' WHERE `id` ='$id'";
    $conn->query($sql);
}
function updateposition($position,$id){
    global $conn;
    $sql ="UPDATE `list` SET `t_order` = '$position' WHERE `id` ='$id'";
    $conn->query($sql);
}
?>