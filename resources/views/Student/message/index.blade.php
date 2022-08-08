<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @if (session('Error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i>{{ __('Error') }}</h5>
                {{ session('Error') }}
            </div>
        @endif
        @if (session('Success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>{{ __('Success') }}</h5>
                {{ session('Success') }}
            </div>
        @endif
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $page_title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.home') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $page_title }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card  direct-chat-primary">
                    <div class="card-header">
                        <div class="card-tools">
                            <!-- Collapse Button -->
                            <a href="{{ url()->previous() }}"
                                class="btn btn-block btn-outline-secondary">{{ __('back') }}</a>
                        </div>
                        <h3 class="card-title">{{ $forum->group->name }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages chat-messages" style="height:60vh">
                            <!-- Message to the right -->
                            @foreach ($messages as $message)
                                @if ($message->user_id == Auth::guard('student')->user()->id)
                                    <div class="direct-chat-msg right msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span
                                                class="direct-chat-name float-right">{{ $message->user->name }}</span>
                                            <span
                                                class="direct-chat-timestamp float-left">{{ $message->date }}</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        @php
                                            $path = $message->user->image == null ? '/assets/img/avatar-placeholder.png' : '/assets/uploads/' . $message->user->image;
                                        @endphp
                                        <img src="{{ $path }}" class="direct-chat-img"
                                            alt="{{__('message user image')}}">

                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            {{ $message->message }}
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                @elseif ($message->teacher_id)
                                    <div class="direct-chat-msg msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span
                                                class="direct-chat-name float-left">{{ $message->teacher->name }}</span>
                                            <span
                                                class="direct-chat-timestamp float-right">{{ $message->created_at }}</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        @php
                                            $path = $message->teacher->image == null ? '/assets/img/avatar-placeholder.png' : '/assets/uploads/' . $message->teacher->image;
                                        @endphp
                                        <img src="{{ $path }}" class="direct-chat-img"
                                            alt="{{__('message user image')}}">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            {{ $message->message }}
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                @elseif($message->user_id)
                                    <div class="direct-chat-msg msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span
                                                class="direct-chat-name float-left">{{ $message->user->name }}</span>
                                            <span
                                                class="direct-chat-timestamp float-right">{{ $message->created_at }}</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        @php
                                            $path = $message->user->image == null ? '/assets/img/avatar-placeholder.png' : '/assets/uploads/' . $message->user->image;
                                        @endphp
                                        <img src="{{ $path }}" class="direct-chat-img"
                                            alt="{{__('message user image')}}">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            {{ $message->message }}
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                @endif
                            @endforeach
                            <!-- /.direct-chat-msg -->
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="form-group has-validation">
                            <input type="text" name="text" placeholder="{{__('Message')}} ..." class="form-control message">
                            <div class="invalid-feedback error" style="display: none">
                                {{ __('Enter a message') }}
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-primary send">{{__('Send')}}</button>
                            </span>
                        </div>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.content -->
</div>
<script>
    var intervalId = window.setInterval(function() {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/student/message/add/" + {{ $forum->id }},
            type: "GET",
            dataType: "json",
            success: function(results) {
                if (results.length) {
                    $(".chat-messages").html('');
                    results.forEach(result => {
                        let path = "img/avatar-placeholder.png";
                        var created_at = moment.utc(result['created_at']);
                        var date = created_at.tz("Asia/Jerusalem").format(
                            "YYYY-MM-DD HH:mm:ss");
                        if (result['user_id']) {
                            if (result['user']['image']) {
                                path = 'uploads/'+result['user']['image'];
                            }
                            if (result['user_id'] ==
                                {{ Auth::guard('student')->id() }}) {
                                $(".chat-messages").append(
                                    `<div class="direct-chat-msg right msg">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-right">${ result['user']['name'] }</span>
                                    <span class="direct-chat-timestamp float-left">${ date}</span>
                                </div>
                                <!-- /.direct-chat-infos -->
                                <img class="direct-chat-img" src="{{ url('assets/${path}') }}"
                                    alt="message user image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    ${result['message'] }
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>`);
                            } else {
                                $(".chat-messages").append(`<div class="direct-chat-msg msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-left">${ result['user']['name'] }</span>
                                            <span class="direct-chat-timestamp float-right">${ date }</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="{{ url('assets/uploads/${path}') }}"
                                            alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            ${result['message'] }
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>`);
                            }
                        } else if (result['teacher_id']) {
                            if (result['teacher']['image']) {
                                path = 'uploads/'+result['teacher']['image'];
                            }
                            $(".chat-messages").append(`<div class="direct-chat-msg msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-left">${ result['teacher']['name'] }</span>
                                            <span class="direct-chat-timestamp float-right">${ date }</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="{{ url('assets/${path}') }}"
                                            alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            ${result['message'] }
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>`);
                        }
                    });
                }
            },
        });
    }, 2000);
    $(document).ready(function() {
        $(".send").click(function() {
            var msg = $(".message").val();
            if (msg) {
                if (/[!@#$%^&*()_+.,;:]/.test(msg) == false) {
                    $('.message').removeClass('is-invalid');
                    $(".error").css("display", "none");
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        url: "/student/message/save/" + {{ $forum->id }} + '/' + $(
                                ".message")
                            .val(),
                        type: "get",
                        dataType: "json",
                        success: function(result) {

                            now = new Date(Date.now());

                            dd = now.getDate();
                            mm = (now.getMonth() + 1);

                            if (dd < 10) dd = '0' + dd;
                            if (mm < 10) mm = '0' + mm;

                            var date = now.getFullYear() + '-' + mm +
                                '-' + dd;
                            var time = now.getHours() + ":" + now.getMinutes() + ":" +
                                now.getSeconds();
                            var dateTime = date + ' ' + time;
                            if (result.length > 0) {

                                let path = "img/avatar-placeholder.png";
                                if (result['user']['image']) {
                                    path = 'uploads/'+result['user']['image'];
                                }
                                $(".chat-messages").append(
                                    `<div class="direct-chat-msg right msg">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-right">{{ Auth::guard('student')->user()->name }}</span>
                                    <span class="direct-chat-timestamp float-left">${dateTime}</span>
                                </div>
                                <!-- /.direct-chat-infos -->
                                <img class="direct-chat-img" src="{{ url('assets/${path}') }}"
                                    alt="message user image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    ${msg}
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>`);
                                $('.chat-messages').animate({
                                    scrollTop: $('.chat-messages')
                                        .get(0).scrollHeight
                                }, 500);
                            }
                            $(".message").val("");
                        },
                    });
                } else {
                    $(".message").val("");
                    $('.message').addClass('is-invalid');
                    $(".error").html("{{__('The message must contain letters, spaces and numbers only.')}}");
                    $(".error").css("display", "block");
                }
            } else {
                $('.message').addClass('is-invalid');
                $(".error").css("display", "block");
            }
        });
    });
</script>
