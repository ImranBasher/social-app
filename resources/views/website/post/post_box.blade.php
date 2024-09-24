<div class="central-meta">
    <div class="new-postbox">
        <figure>
            <img src = "{{ asset('frontend') }}/images/resources/admin2.jpg" alt="">
        </figure>
        <div class="newpst-input">
            <form action="{{ route('website.post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <textarea rows="5" name = 'post_body' placeholder="write something" required></textarea>
                <div class="attachments">
                    <ul>
                        <li>
                            <i class="fa fa-image"></i>
                            <label class="fileContainer">
                                <input type="file" name="pic_name[]">
                            </label>
                        </li>
                        <li>
                            <button type="submit" class="btn btn-primary">Post</button>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</div><!-- add post new box -->

















{{-- if require then add those options --}}


{{--
                        <li>
                            <i class="fa fa-video-camera"></i>
                            <label class="fileContainer">
                                <input type="file">
                            </label>
                        </li>

                        <li>
                            <i class="fa fa-music"></i>
                            <label class="fileContainer">
                                <input type="file" >
                            </label>
                        </li>

                         <li>
                            <i class="fa fa-camera"></i>
                            <label class="fileContainer">
                                <input type="file">
                            </label>
                        </li>
--}}
