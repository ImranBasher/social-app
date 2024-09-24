<li>
    <div class="post-comt-box">
        <form  action="{{ route('website.comment.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <textarea placeholder="Post your comment" name ="comment_body"></textarea>
            <input type = "hidden" name = "post_id" value ="{{ $post->id }}">
            <div class ="row">
{{--                <div class = "col-lg-2">--}}
                    <div class="attachments col-lg-2">
                        <i class="fa fa-image"></i>
                        <label class="fileContainer">
                            <input type="file" name="pic_name[]">
                        </label>
                    </div>
{{--                </div>--}}
                <div class = "col-lg-10">
                    <input type = "submit" value = "comment" class=" btn btn-primary" style="float: right">
                </div>
            </div>
        </form>
    </div>
</li>
