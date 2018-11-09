@extends('layout')
@section('content')
    <div class="col-xl-8 offset-xl-2 py-5">
        <form id="contact-form" method="post" role="form">
            @csrf
            <div class="messages"></div>

            <div class="controls">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_name">First Name *</label>
                            <input id="form_name" type="text" name="first_name" class="form-control" placeholder="Please enter your first name" required="required" data-error="Firstname is required.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_lastname">Last Name *</label>
                            <input id="form_lastname" type="text" name="last_name" class="form-control" placeholder="Please enter your last name" required="required" data-error="Lastname is required.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <lßabel for="form_email">Email *</lßabel>
                            <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email" required="required" data-error="Valid email is required.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <input id="subject" type="text" name="subject" class="form-control" placeholder="Please enter the subject" required="required" data-error="Valid subject is required">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_message">Message *</label>
                            <textarea id="form_message" name="message" class="form-control" placeholder="Message for me" rows="4" required="required" data-error="Please, leave us a message."></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-success btn-send" value="Send message">
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
@section('extraJS')
    <script type="text/javascript">
        $(document).ready(function() {
            GitHubActivity.feed({ username: "{{$profileAttributes['github_username']}}", selector: "#ghfeed" });
        });
    </script>
@endsection