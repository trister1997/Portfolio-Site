<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{env('SITE_TITLE')}}</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootstrap 4 Portfolio/Resume Theme for Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- FontAwesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js" integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9" crossorigin="anonymous"></script>

    <!-- Global CSS -->
    <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">

    <!-- github calendar css -->
    <link rel="stylesheet" href="/plugins/github-calendar/dist/github-calendar.css">
    <!-- github acitivity css -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/octicons/2.0.2/octicons.min.css">
    <link rel="stylesheet" href="/plugins/github-activity/github-activity-0.1.5.min.css">

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="/css/styles.css">

</head>

<body>
<!-- ******HEADER****** -->
<header class="header">
    <div class="container clearfix">
        <img class="profile-image img-fluid float-left" width="180" height="180" src="{{isset($profileAttributes['profile_image']) ? $profileAttributes['profile_image'] : ''}}" alt="{{isset($profileAttributes['name']) ? $profileAttributes['name'] : ''}}" />
        <div class="profile-content float-left">
            <h1 class="name">{{isset($profileAttributes['name']) ? $profileAttributes['name'] : ''}}</h1>
            <h2 class="desc">{{isset($profileAttributes['job_title']) ? $profileAttributes['job_title'] : ''}}</h2>
            <ul class="social list-inline">
                @if (isset($profileAttributes['twitter']))
                    <li class="list-inline-item"><a href="{{$profileAttributes['twitter']}}"><i class="fab fa-twitter"></i></a></li>
                @endif
                @if (isset($profileAttributes['linkedin']))
                    <li class="list-inline-item"><a href="{{$profileAttributes['linkedin']}}"><i class="fab fa-linkedin-in"></i></a></li>
                @endif
                @if(isset($profileAttributes['github']))
                    <li class="list-inline-item"><a href="{{$profileAttributes['github']}}"><i class="fab fa-github-alt"></i></a></li>
                @endif
                @if(isset($profileAttributes['stack_overflow']))
                    <li class="list-inline-item"><a href="{{$profileAttributes['stack_overflow']}}"><i class="fab fa-stack-overflow"></i></a></li>
                @endif
            </ul>
        </div><!--//profile-->
        @if($showContact)
            <a class="btn btn-cta-primary float-right" href="/contact"><i class="fas fa-paper-plane"></i> Contact Me</a>
        @endif
    </div><!--//container-->
</header><!--//header-->

<div class="container sections-wrapper">
    <div class="row">
        @yield('content')
    </div><!--//row-->
</div><!--//masonry-->

<!-- ******FOOTER****** -->
<footer class="footer">
    <div class="container text-center">
        <!--/* This template is released under the Creative Commons Attribution 3.0 License. Please keep the attribution link below when using for your own project. Thank you for your support. :) If you'd like to use the template without the attribution, you can check out our commercial license options via our website: themes.3rdwavemedia.com */-->
        <small class="copyright">Theme by <a href="https://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a><br>Site by <a href="https://rister.io" target="_blank"> Tyler Rister</a> </small>
    </div><!--//container-->
</footer><!--//footer-->

<!-- Javascript -->
<script type="text/javascript" src="/plugins/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/plugins/popper.min.js"></script>
<script type="text/javascript" src="/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/plugins/jquery-rss/dist/jquery.rss.min.js"></script>
<!-- github calendar plugin -->
<script type="text/javascript" src="/plugins/github-calendar/dist/github-calendar.min.js"></script>
<!-- github activity plugin -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/mustache.js/0.7.2/mustache.min.js"></script>
<script type="text/javascript" src="/plugins/github-activity/github-activity-0.1.5.min.js"></script>
<!-- custom js -->
@yield('extraJS')
</body>
</html>

