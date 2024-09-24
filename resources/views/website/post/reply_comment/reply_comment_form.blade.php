    <form action="{{ route('website.comment.reply.store')}}"  method="post" enctype = "multipart/form-data">
        @csrf
        <textarea placeholder="Post your comment_reply" name = "comment_reply_body"></textarea>
        <input type = "hidden" name = "post_id" value ="{{ $post->id }}">
        <input type = "hidden" name = "post_comment_id" value ="{{ $comment->id }}">

        <div class = "row">
            <div class="attachments col-lg-2" >
                <i class="fa fa-image"></i>
                <label class="fileContainer">
                    <input type="file" name="pic_name[]">
                </label>
            </div>
            <div class = "col-lg-10">
                <input type = "submit" value = "Reply" class=" btn btn-primary" style="float: right">
            </div>
        </div>
    </form>

