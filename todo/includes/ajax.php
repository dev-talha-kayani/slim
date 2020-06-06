<?php 
require(__DIR__."/classes.php");
if($_POST['type']=="insert"){
    $text = $_POST['new-list-item-text'];
   $insert = $obj->insert($text);
   if($insert =="success"){
    $view =  $obj->viewallspecified();
    echo $view;
   }
}
if($_POST['type']=="delete"){
    $id = $_POST['id'];
   $obj->deletethat($id);
   $view =  $obj->viewallspecified();
    echo $view;
}
if($_POST['type']=="updatecolor"){
    $id = $_POST['id'];
    $color = $_POST['color'];
    $obj->updateclr($color,$id);
    $view =  $obj->viewallspecified();
    echo $view;
}
if($_POST['type']=="updatetext"){
    $id = $_POST['id'];
    $text = $_POST['text'];
    $result = explode('<a',$text);
    $data = $result[0];
    $obj->updatetext($data,$id);
    $view =  $obj->viewallspecified();
    echo $view;
}
if($_POST['type']=="markread"){
    $id = $_POST['id'];
    $obj->updatemark($id);
    $view =  $obj->viewallspecified();
    echo $view;
}
if($_POST['type']=="sorting"){
    foreach ($_POST["value"] as $key => $value) {
        $obj->updateposition($key,$value);
        $view = $obj->viewallspecified();
        echo $view;
    }
}
?>