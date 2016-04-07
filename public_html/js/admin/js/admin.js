$(document).ready(function () {

    $('.article_summernote').summernote({
        height: 230,
        direction: 'rtl',
        lang: 'fa-IR',
        toolbar: [
            //[groupname, [button list]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['color', ['color']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']],
        ],
        callbacks: {
            onImageUpload:function(files,editor,welEditable){
                uploadArticleFile(files[0],editor,welEditable);
            },
            onMediaDelete:function(files,editor,editable){
                console.log(files[0].src);
                deleteArticleFile(files[0],editor,editable);
            }
        }


    });

    $('select#mainCategory').change(function(){

        var $this=$(this);
        if($this.val!=0){
            $.ajax({
                type:'get',
                url:"/ajax/category/subCategory",
                data:{category_id:$this.val()},

                beforeSend:function(){

                },
                complete:function(){

                },
                success:function(data){
                    var $select = $("select#categories_select");
                    $select.select2("val",'');
                    $select.empty();
                    $(data).each(function (key, value) {
                        var $option = $("<option/>").attr("value", value.id).text(value.name);
                        $select.append($option);
                    });
                },
                error:function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                }
            })
        }


    });

    $('#tags_select').select2({
        tags: "true",
        placeholder: "کلمات کلیدی",
        dir:'rtl',
        language:'fa',
        maximumSelectionLength: 4
        /*data:[{id:1,text:'reza'}]*/
    });

    $('#categories_select').select2({
        placeholder: "دسته بندی",
        dir:'rtl',
        language:'fa',
        maximumSelectionLength: 4
    });

    $('select#mainCategory').find('option[value=0]').attr('disabled',true);
    $('select#subCategory').find('option[value=0]').attr('disabled',true);

    /**
     * Created By Dara on 14/2/2016
     * fill the subCategory select box on when main category selected
     */
    /*$('select#mainCategory').change(function(){
        var $this=$(this);
        if($this.val!=0){
            $.ajax({
                type:'get',
                url:"/ajax/category/subCategory",
                data:{category_id:$this.val()},
                dataType:'json',
                beforeSend:function(){

                },
                complete:function(){

                },
                success:function(data){
                    var $select=$('select#subCategory');
                    var $default=$("<option/>").attr({'value':0,'disabled':true,'selected':true}).text('انتخاب کنید');
                    $select.html('');
                    $select.prepend($default);
                    $.each(data,function(key,value){
                        var $option=$("<option/>").attr('value',key).text(value);
                        $select.append($option);
                    });
                },
                error:function(xhr){
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                }
            })
        }
    });*/

    /**
     * Created By Dara on 21/2/2016
     * delete attachment related to session
     */
    $("a.delete-session-attachment").click(function(e){
        e.preventDefault();
        var $this=$(this);
        var session_id=$this.attr('data-session');
        var attachment_id=$this.attr('data-attachment');
        $.ajax({
            type:'get',
            dataType:'json',
            url:'/ajax/session/'+session_id+'/attachment/'+attachment_id+'/delete',
            beforeSend:function(){
                $this.html('<i class="fa fa-spinner fa-spin"></i>');
            },
            complete:function(){

            },
            success:function(data){
                var type='success';
                $this.closest('tr').remove();
                $.notify(data.msg, {type: type});
            },
            error:function(xhr){
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    });

});
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
/**
 * Created By Dara on 5/2/2016
 * upload image(summernote)
 */
function uploadArticleFile(file, editor, welEditable) {
    data = new FormData();
    data.append('file', file);
    data.append('_token', $("input[name='_token']").val());
    $.ajax({
        data: data,
        type: 'POST',
        url: '/admin/article/upload',
        cache: false,
        contentType: false,
        processData: false,
        success: function (url) {
            $('.article_summernote').summernote('editor.insertImage', url);
        }
    })
}

/**
 * Created By Dara on 6/2/2016
 * delete image(summernote)
 */
function deleteArticleFile(file,editor,editable){
    $.ajax({
        data:{
            src:file.src,
            _token:$('input[name="_token"]').val(),
            _method:'delete'
        },
        type:'POST',
        url:'/admin/article/delete',
        success:function(){

        }

    })
}