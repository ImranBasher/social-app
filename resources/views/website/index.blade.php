@extends("website.layouts.website")

@section("content")

    @include("website.post.post_box")

    <div class="loadMore">
        @isset($posts)
            @foreach ($posts as $post)
                @include("website.post.post")
            @endforeach
        @endisset
    </div>


@endsection

























{{--              <div class="coment-area">--}}
{{--                    <ul class="we-comet">--}}
{{--                        <li>--}}
{{--                            <div class="comet-avatar">--}}
{{--                                <img src = "{{ asset('frontend') }}/images/resources/comet-1.jpg" alt="">--}}




{{--                            </div>--}}
{{--                            <div class="we-Comment">--}}
{{--                                <div class="coment-head">--}}
{{--                                    <h5><a href="time-line.html" title="">Jason borne</a></h5>--}}
{{--                                    <span>1 year ago</span>--}}
{{--                                    <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>--}}
{{--                                </div>--}}
{{--                                <p>we are working for the dance and sing songs. this car is very awesome for the youngster. please vote this car and like our post</p>--}}
{{--                            </div>--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <div class="comet-avatar">--}}
{{--                                        <img src = "{{ asset('frontend') }}/images/resources/comet-2.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="we-Comment">--}}
{{--                                        <div class="coment-head">--}}
{{--                                            <h5><a href="time-line.html" title="">alexendra dadrio</a></h5>--}}
{{--                                            <span>1 month ago</span>--}}
{{--                                            <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>--}}
{{--                                        </div>--}}
{{--                                        <p>yes, really very awesome car i see the features of this car in the official website of <a href="#" title="">#Mercedes-Benz</a> and really impressed :-)</p>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <div class="comet-avatar">--}}
{{--                                        <img src = "{{ asset('frontend') }}/images/resources/comet-3.jpg" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="we-Comment">--}}
{{--                                        <div class="coment-head">--}}
{{--                                            <h5><a href="time-line.html" title="">Olivia</a></h5>--}}
{{--                                            <span>16 days ago</span>--}}
{{--                                            <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>--}}
{{--                                        </div>--}}
{{--                                        <p>i like lexus cars, lexus cars are most beautiful with the awesome features, but this car is really outstanding than lexus</p>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <div class="comet-avatar">--}}
{{--                                <img src = "{{ asset('frontend') }}/images/resources/comet-1.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="we-Comment">--}}
{{--                                <div class="coment-head">--}}
{{--                                    <h5><a href="time-line.html" title="">Donald Trump</a></h5>--}}
{{--                                    <span>1 week ago</span>--}}
{{--                                    <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>--}}
{{--                                </div>--}}
{{--                                <p>we are working for the dance and sing songs. this video is very awesome for the youngster. please vote this video and like our channel--}}
{{--                                    <i class="em em-smiley"></i>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" title="" class="showmore underline">more comments</a>--}}
{{--                        </li>--}}
{{--                        <li class="post-Comment">--}}
{{--                            <div class="comet-avatar">--}}
{{--                                <img src = "{{ asset('frontend') }}/images/resources/comet-1.jpg" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="post-comt-box">--}}
{{--                                <form method="post">--}}
{{--                                    <textarea placeholder="Post your Comment"></textarea>--}}
{{--                                    <div class="add-smiles">--}}
{{--                                        <span class="em em-expressionless" title="add icon"></span>--}}
{{--                                    </div>--}}
{{--                                    <button type="submit"></button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div> --}}
{{--            </div>--}}
