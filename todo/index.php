<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head> 
<?php 

// $obj->update("1","test");
?>
<body> 
  <div id="page-wrap">
    <div id="header">
      <h1><a href="">PHP Sample Test App</a></h1>
    </div>

    <div id="main">
      <noscript>This site just doesn't work, period, without JavaScript</noscript>

      <ul id="list" class="ui-sortable">
      <?php 
          $del_e="";
          $del_s="";
          $counter=0;
          foreach($alllist as $data){
            $counter ++;
            $text = $data['text'];
            $id = $data['id'];
            $color = $data['color'];
            $status = $data['status'];
          
        ?>
        <li color="1" class="<?php echo $color;?>" rel="<?php echo $id;?>" id="<?php echo $id;?>">
      
         <?php if($status == "1"){
           $del_s="<del>";
           $del_e="</del>";
         }else{
          $del_s="";
          $del_e="";
         }?>
         <?php echo $del_s;?><input class="spandetector" id="2listitem" title="Double-click to edit..." style="opacity: 1;" value="<?php echo $text;?>"><?php echo $del_e;?>
         <!-- <?php echo $del_s;?><span  id="2listitem" title="Double-click to edit..." style="opacity: 1;"><?php echo $text;?></span></del><?php echo $del_e;?> -->

          <div class="draggertab tab" rel="<?php echo $id;?>"></div>

          <div class="colortab tab"></div>
          <div class="deletetab tab" style="width: 44px; display: block; right: -64px;">
          </div>
          <div class="donetab tab"></div>
        </li>
          <?php } ?>
      </ul>
	  <br />

      <form  id="add-new" method="post">
        <input type="text" id="new-list-item-text" name="new-list-item-text" required/>
        <a href="jacascript:;" id="add-new-submit" value="Add" class="button" >Add</a>
      </form>

      <div class="clear"></div>
    </div>
  </div>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min_1.js"></script>
<script src="js/customjs.js"></script>
</html>
