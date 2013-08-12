jQuery(function($){
    $('a.uploadbutton').live('click',function(){
        var id = $(this).attr('rel');
        window.send_to_editor = function(img){
            var src = $(img).find('img').attr('src');
            $('#trmenuiconvl_'+id).val(src);
            $('img#trmenuicon_'+id).attr('src',src);
            tb_remove();
        }
        tb_show('upload',$(this).attr('href'));
        return false;
    });
    $('a.add_select_icon').live('click',function(){
        var id = $(this).attr('rel');
        var src = $(this).find('img').attr('src');
        $('#trmenuiconvl_'+id).val(src);
        $('img#trmenuicon_'+id).attr('src',src);
        tb_remove();
        return false;
    })
    $('a.removeimageicon').live('click',function(){
        var id = $(this).attr('rel');
        var src = '';
        $('#trmenuiconvl_'+id).val(src);
        $('img#trmenuicon_'+id).attr('src',src);
        return false;
    })
})