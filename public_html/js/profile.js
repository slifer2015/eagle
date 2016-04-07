$(document).ready(function () {

    /**
     * Created By Dara on 8/2/2016
     *
     */
    $(document).on('submit', 'form[data-remote]', function (e) {
        e.preventDefault();
        var $this = $(this);
        var data = $this.serialize();
        var action = $this.attr('action');
        var method = $this.attr('method');
        if ($this.find('input[name="_method"]').length > 0) {
            method = $this.find('input[name="_method"]').val();
        }
        var current_text = $this.find('button[type=submit]').html();
        $.ajax({
            data: data,
            type: method,
            dataType: 'json',
            url: action,
            beforeSend: function () {
                $this.find('button[type="submit"]').find('i').attr('class', '').addClass('fa fa-spinner fa-spin');
            },
            complete: function () {
                if ($this.find('button[type="submit"]').find('i').hasClass('fa fa-spinner fa-spin')) {
                    $this.find('button[type="submit"]').html(current_text);
                }
            },
            success: function (data) {
                if (data.hasCallback) {
                    window[data.callback](data.returns, $this);
                }
                if (data.hasMsg) {
                    var type = 'success';
                    if (data.msgType) {
                        type = data.msgType;
                    }
                    $.notify(data.msg, {type: type});
                }
            },
            error: function (xhr) {
                alert("An error occured: " + xhr.status + " " + xhr.statusText);
            }
        });
    });
});

/*Setup Ajax Request*/
$.ajaxSetup({
    'headers': {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/*functions*/
function article_comment(data,$this) {
    if(data.nested){//reply
        $this.closest('li#comment-reply-form').prev('li.media.level1').after(data.newComment);
        $('.article-full-details span.num_comment').html(data.numComment);
        $this.closest('li#comment-reply-form').remove();

    }else{
        $('.comment-list').find('ul.media-list').prepend(data.newComment);
        $('.article-full-details span.num_comment').html(data.numComment);
        $('.comment-list').find('textarea[name="content"]').val('');
    }

}

$('ul.media-list').on('click', 'a.reply-button', function (e) {
    e.preventDefault();
    var $this = $(this);
    var article_id=$this.closest('li.media').attr('data-article-value');
    var comment_id=$this.closest('li.media').attr('data-comment-value');
    var src=$('li.media.comment-form img').attr('src');
    var action='/ajax/article/'+article_id+'/comment/'+comment_id+'/store';
    if ($('ul.media-list').has('li#comment-reply-form').length > 0) {
        if ($this.closest('li.media').next('li#comment-reply-form').length > 0) {
            $('li#comment-reply-form').remove();
        } else {
            $('li#comment-reply-form').remove();
            $this.closest('li.media').after('<li id="comment-reply-form" class="media comment-form reply comment-reply-form"><div class="media-right"><a href="#"><img class="media-object" src='+src+' alt=""></a></div><div class="media-body"><form method="post" class="form-horizontal" data-remote="true" action='+action+'><textarea class="form-control" placeholder="لطفا پاسخ خود را وارد نمایید ..." name="content" id=""></textarea><button type="submit" class="btn btn-learn"><i class="fa fa-paper-plane-o"></i> ثبت پاسخ</button></form></div></li>')
        }
    } else {
        $this.closest('li.media').after('<li id="comment-reply-form" class="media comment-form reply comment-reply-form"><div class="media-right"><a href="#"><img class="media-object" src='+src+' alt=""></a></div><div class="media-body"><form method="post" class="form-horizontal" data-remote="true" action='+action+'><textarea class="form-control" placeholder="لطفا پاسخ خود را وارد نمایید ..." name="content" id=""></textarea><button type="submit" class="btn btn-learn"><i class="fa fa-paper-plane-o"></i> ثبت پاسخ</button></form></div></li>');
    }
});
