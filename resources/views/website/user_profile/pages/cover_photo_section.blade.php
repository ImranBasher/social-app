<section>
    <div class="feature-photo">
        <!-- cover Photo start -->
        @include('website.user_profile.pages.cover')

        <!-- profile picture and nav bar -->
        <div class="container-fluid">
            <div class="row merged">
                 <!-- profile picture -->
                @include('website.user_profile.pages.profile')
                <!-- nav bar -->
                @include('website.user_profile.pages.nav')
            </div>
        </div>
    </div>
</section>
