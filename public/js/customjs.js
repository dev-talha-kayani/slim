$(document).ready(function(){
    $(".buttonsave").hide();
})
$("#add-new-submit").click(function(){
    var check = $("#new-list-item-text").val();
    if(check ==""){
        alert("insert data");
    }else{
        var form = $("#add-new").serialize();
        //console.log(form);
        $.ajax({
            url: "../insert",
            data: form+"&type=insert",
            method:"POST",
            success: function(data) {
                $("#list").html(data);
                $("#new-list-item-text").val('');
            }
        })
    }
})

$(function(){
    var index = 0;
    var class_list = ["colorGreen", "colorRed", "colorBlue"];
    $(document).on("click",".colortab",function() { 
        $(this).closest('li').removeClass();
            $(this).closest('li').toggleClass(class_list[index++],class_list[index]);
             index %= class_list.length;
             var id = $(this).closest('li').attr('rel');
             var color =  $(this).closest('li').attr("class");
             type="updatecolor";    
            $.ajax({
                url: "../colorupdtae",
                data:{id:id,type:type,color:color},
                method:"POST",
                success: function(data) {
                    $("#list").html(data);
                    
                }
            })
    });
});
$(document).on("click",".deletetab",function() {
    if (confirm('Are you sure ?')) {
        // Save it!
        var id = $(this).closest('li').attr('rel');
        type="delete";    
    //console.log(form);
        $.ajax({
            url: "../delete",
            data:{id:id,type:type},
            method:"POST",
            success: function(data) {
                $("#list").html(data);
                
            }
        })
      } else {
        // Do nothing!
       
      }
})
$('span').bind('dblclick',function(){
        $(this).attr('contentEditable',true);
        $(this).append('<a class="buttonsave">Save</a>');
});
//$('span').on('change',function(){
$(document).on("change",".spandetector",function() {
    var text = $(this).closest('li').find("input").val();
    var id = $(this).closest('li').attr('rel');
 //   var color =  $(this).closest('li').attr("class");
   // alert(color);
    type="updatetext";    
        $.ajax({
            url: "../updatetext",
            data:{id:id,type:type,text:text},
            method:"POST",
            success: function(data) {
                $("#list").html(data);
                $(".buttonsave").hide();
                //location.reload();
            }
        })
})
$(document).on("click",".donetab",function() {
    var id = $(this).closest('li').attr('rel');
    var type="markread";    
    $.ajax({
        url: "../markread",
        data:{id:id,type:type},
        method:"POST",
        success: function(data) {
            $("#list").html(data);
            $(".buttonsave").hide();
        }
    })
})
$(document).on("click",".draggertab ",function() {
var $sortable = $( "#list" );
$sortable.sortable({
    stop: function ( event, ui ) {
        var type = "sorting";
        var parameters = $sortable.sortable( "toArray" );
        $.post("../updatepositions",{value:parameters,type:type},function(result){
            $("#list").html(data);
        });
    }
});
})
$('.spandetector').on({
    focus: function() {
        if (!$(this).data('disabled')) this.blur()
    },
    dblclick: function() {
        $(this).data('disabled', true);
        this.focus()
    },
    blur: function() {
        $(this).data('disabled', false);
    }
});