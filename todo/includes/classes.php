<?php 
namespace todo\includes;

class Lists {
    function viewall(){
        $lists = \ORM::for_table('list')->order_by_asc('t_order')->find_array();
        return $lists;
    }
    function tester($id,$value){
        
        $lists = ORM::for_table('list') ->where(array(
            'id' => $id
        ))->find_one();
        $lists->text=$value;
        $lists->save();
    }
    function updateclr($color,$id){
        if ( filter_var($id, FILTER_VALIDATE_INT) === false || empty($id) ||  empty($color)) {
            echo "variable is not an integer Or is empty";
        }else{
          
            $lists = \ORM::for_table('list') ->where(array(
                'id' => $id
            ))->find_one();
            $lists->color=$color;
            $lists->save();
        }
    }
    function updatemark($id){
        if ( filter_var($id, FILTER_VALIDATE_INT) === false || empty($id) ) {
            echo "variable is not an integer Or is empty";
        }else{
            $lists = \ORM::for_table('list') ->where(array(
                'id' => $id
            ))->find_one();
            $lists->status = "1";
            $lists->save();
        }
    }
    function deletethat($id){
        if ( filter_var($id, FILTER_VALIDATE_INT) === false || empty($id) ) {
            echo "variable is not an integer Or is empty";
        }else{
            $lists = \ORM::for_table('list') ->where(array(
                'id' => $id
            ))->find_one();
            $lists->delete();
        }
    }
    function updateposition($position,$id){
        if ( filter_var($id, FILTER_VALIDATE_INT) === false || empty($id) || empty($position) || filter_var($position, FILTER_VALIDATE_INT) === false ) {
            echo "variable is not an integer Or is empty";
        }else{
            $lists = \ORM::for_table('list') ->where(array(
                'id' => $id
            ))->find_one();
            $lists->t_order = $position;
            $lists->save();
        }
    }
    function updatetext($data,$id){
        if ( filter_var($id, FILTER_VALIDATE_INT) === false || empty($id) || empty($data) ) {
            echo "variable is not an integer Or is empty";
        }else{
            $lists = \ORM::for_table('list') ->where(array(
                'id' => $id
            ))->find_one();
            $lists->text = $data;
            $lists->save();
        }
    }
    function insert($value){
        if ( empty($value) ) {
            echo "variable is not an integer Or is empty";
        }else{
            $lists = \ORM::for_table('list')->create();
            $lists->text = $value;
            $lists->save();
            $listMax = \ORM::for_table('list')->order_by_desc('id')->find_one();
            $id = $listMax->id;
            $listMax->t_order = $id;
            $listMax->save();
            return "success";
        }
    }
    function viewallspecified(){
        $lists = \ORM::for_table('list')->order_by_asc('t_order')->find_many();
        $textdata="";
        foreach($lists as $listst){
            $id = $listst['id'];
            $text = $listst['text'];
            $color = $listst['color'];
            $status = $listst['status'];
            $del_e="";
            $del_s="";
            if($status =="1"){
                $del_s="<del>";
                $del_e="</del>";
              }else{
                $del_s="";
                $del_e="";
              }
            $textdata .='
        <li color="1" class="'.$color.'" rel="'.$id.'" id="'.$id.'">
        
        '.$del_s.'<input  class="spandetector" id="2listitem" title="Double-click to edit..." style="opacity: 1;" value="'.$text.'">'.$del_e.'

          <div class="draggertab tab"></div>

          <div class="colortab tab"></div>

          <div class="deletetab tab" style="width: 44px; display: block; right: -64px;">
          </div>

          <div class="donetab tab"></div>
        </li>';
        }
        return $textdata;

        

    }
}
?>