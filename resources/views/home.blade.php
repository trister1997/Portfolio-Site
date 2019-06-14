@extends('layout')
@section('content')

    <div class="primary col-lg-8 col-12">
        <section class="about section">
            <div class="section-inner">
                <h2 class="heading">About Me</h2>
                <div class="content">
                    <p>{!! isset($profileAttributes['about_me']) ? $profileAttributes['about_me'] : '' !!}</p>
                </div><!--//content-->
            </div><!--//section-inner-->
        </section><!--//section-->

        @if(count($projects))
            <section class="latest section">
                <div class="section-inner">
                    <h2 class="heading">Latest Projects</h2>
                    <div class="content">
                        @foreach ($projects as $project)
                            <div class="item row">
                                <a class="col-md-4 col-12" href="{{$project->link}}" target="_blank">
                                    <img class="img-fluid project-image" src="{{$project->image}}" alt="{{$project->title}}">
                                </a>
                                <div class="desc col-md-8 col-12">
                                    <h3 class="title"><a href="{{$project->link}}" target="_blank">{{$project->title}}</a></h3>
                                    <p class="mb-2">{!! $project->description !!}</p>
                                    <p><a class="more-link" href="{{$project->link}}" target="_blank"><i class="fas fa-external-link-alt"></i>Find out more</a></p>
                                </div>
                            </div>
                        @endforeach
                    </div><!--//content-->
                </div><!--//section-inner-->                 s
            </section><!--//section-->
        @endif

        @if(count($jobs))
            <section class="experience section">
                <div class="section-inner">
                    <h2 class="heading">Work Experience</h2>
                    <div class="content">
                        @foreach($jobs as $job)
                            <div class="item">
                                <h3 class="title">{{$job->title}} - <span class="place">{{$job->company}}</span> <span class="year">({{$job->start_year}} - {{$job->end_year}})</span></h3>
                                <p>{{$job->description}}</p>
                            </div>
                        @endforeach
                    </div><!--//content-->
                </div><!--//section-inner-->
            </section><!--//section-->
        @endif
        @if(isset($profileAttributes['github_username']))
            <section class="github section">
                <div class="section-inner">
                    <h2 class="heading">My GitHub</h2>
                    <div id="ghfeed" class="ghfeed"></div><!--//ghfeed-->
                </div><!--//secton-inner-->
            </section><!--//section-->
        @endif
    </div><!--//primary-->
    <div class="secondary col-lg-4 col-12">
        @if(count($skills))
            <aside class="skills aside section">
                <div class="section-inner">
                    <h2 class="heading">Skills</h2>
                    <div class="content">
                        <div class="skillset">
                            @foreach($skills as $skill)
                                <div class="item">
                                    <h3 class="level-title">{{$skill->title}}</h3>
                                    <div class="level-bar">
                                        <div class="level-bar-inner" data-level="{{$skill->percentage}}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div><!--//content-->
                </div><!--//section-inner-->
            </aside><!--//section-->
        @endif

        @if(count($schools))
            <aside class="education aside section">
                <div class="section-inner">
                    <h2 class="heading">Education</h2>
                    <div class="content">
                        @foreach($schools as $school)
                            <div class="item">
                                <h3 class="title"><i class="fas fa-graduation-cap"></i> {{$school->major}}</h3>
                                <h4 class="university">{{$school->name}} <span class="year">({{$school->start_year}}-{{$school->end_year}})</span></h4>
                            </div>
                        @endforeach
                    </div><!--//content-->
                </div><!--//section-inner-->
            </aside><!--//section-->
        @endif

        @if(count($conferences))
            <aside class="list conferences aside section">
                <div class="section-inner">
                    <h2 class="heading">Conferences</h2>
                    <div class="content">
                        <ul class="list-unstyled">
                            @foreach($conferences as$conference)
                                <li><i class="far fa-calendar-alt"></i> <a href="{{$conference->link}}" target="_blank">{{$conference->name}}</a> ({{$conference->location}})</li>
                            @endforeach
                        </ul>
                    </div><!--//content-->
                </div><!--//section-inner-->
            </aside><!--//section-->
        @endif
    </div><!--//secondary-->
@endsection
@section('extraJS')
    <script type="text/javascript">
        $(document).ready(function() {
            GitHubActivity.feed({ username: "{{$profileAttributes['github_username']}}", selector: "#ghfeed" });
            $('.level-bar-inner').css('width', '0');

            $(window).on('load', function() {

                $('.level-bar-inner').each(function() {

                    var itemWidth = $(this).data('level');

                    $(this).animate({
                        width: itemWidth
                    }, 800);

                });

            });

            /* Bootstrap Tooltip for Skillset */
            $('.level-label').tooltip();
        });
    </script>
@endsection