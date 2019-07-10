jQuery(function($){
 
$('#img').change(function() {
    var preview = $('#preview');
    //現在表示されているものを消す。
    preview.find("img").fadeOut(300);
 
    //アップロード、表示
    $(this).upload('upload.php',$("form").serialize(),function(html){
        preview.html(html).animate({"height":preview.find("img").height()+"px"},300,function(){
            preview.find("img").hide().fadeIn(300);
        });
    },'html');
});
 
});