@extends('layouts.app')

@section('header')
    <h1 class="page-header">{{ trans('label.backend.dashboard')  }}</h1>
@stop

@section('style-menu-main')
   <style>
       #home-id .col-lg-6 {
           margin-right: 20px;
       }

       #home-id .col-lg-6,
       #home-id .col-lg-5 {
           background: #fafaf3;
           padding-top: 16px;
           padding-bottom: 16px;
       }


   </style>
@stop

@section('menu-main')
    @include('frontend.student.partials.menu-main')
@stop

@section('content')

    @include('frontend.student.home')

@stop

@section('script')
    <script type="text/javascript">
        var final_transcript = '';
        var recognizing = false;

        if ('webkitSpeechRecognition' in window) {

            var recognition = new webkitSpeechRecognition();

            recognition.continuous = true;
            recognition.interimResults = true;

            recognition.onstart = function() {
                recognizing = true;
            };

            recognition.onerror = function(event) {
                console.log(event.error);
            };

            recognition.onend = function() {
                recognizing = false;
            };

            recognition.onresult = function(event) {
                var interim_transcript = '';
                for (var i = event.resultIndex; i < event.results.length; ++i) {
                    if (event.results[i].isFinal) {
                        final_transcript += event.results[i][0].transcript;
                    } else {
                        interim_transcript += event.results[i][0].transcript;
                    }
                }
                final_transcript = capitalize(final_transcript);
                final_span.innerHTML = linebreak(final_transcript);
                interim_span.innerHTML = linebreak(interim_transcript);

            };
        }

        var two_line = /\n\n/g;
        var one_line = /\n/g;
        function linebreak(s) {
            return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
        }

        function capitalize(s) {
            return s.replace(s.substr(0,1), function(m) { return m.toUpperCase(); });
        }

        function startDictation(event) {
            if (recognizing) {
                recognition.stop();
                return;
            }
            final_transcript = '';
            recognition.lang = 'en-US';
            recognition.start();
            final_span.innerHTML = '';
            interim_span.innerHTML = '';
        }
    </script>

    <script type="text/javascript">
        $('#btn-go-test').click(function () {
            val_level = $('#option-level-test').val();
            if(val_level == 0) {
                return false;
            }
        });

        function showLevel(level_id) {
            $.ajax({
                {{--url: '{{route("frontend.dashboard.student.redirect", level_id)}}',--}}
                type: "GET",
                data: {
                    level_id: level_id
                },
                success: function (data) {},
                error: function () {
                    alert("Không lấy được thông tin này!");
                }
            });
            return false;
        }
    </script>

@stop
