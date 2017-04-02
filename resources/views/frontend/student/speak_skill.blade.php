@extends('layouts.app')

@section('header')
    <h1 class="page-header">Test Speak</h1>
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

         .speech {border: 1px solid #DDD; width: 300px; padding: 0; margin: 0}
        .speech input {border: 0; width: 240px; display: inline-block; height: 30px;}
        .speech img {float: right; width: 40px }

        #start_button,
        #results {
            float: left;
        }

        #results {
            margin-left: 10px;
            float: left;
            width: 100%;
        }

        #messages_result {
            color: rgb(27, 245, 27);
            float: left;
            width: 100%;
            margin-left: 30px;
            font-size: 16px;
            font-weight: 500;
        }

        #btns {
            margin-bottom: 5px;
        }

    </style>
@stop

@section('menu-main')
    @include('frontend.student.partials.menu-main')
@stop

@section('content')

    {{--@foreach($speak_items as $item)--}}
        {{--<div>--}}
            {{--<p id="text_demo">{{$item->content}}</p>--}}
            {{--@if(isset($item->url_mp3_create))--}}
                {{--<audio controls>--}}
                    {{--<source src="{{$item->url_mp3_create}}" type="audio/mpeg">--}}
                {{--</audio>--}}
            {{--@else--}}
                {{--<audio controls>--}}
                    {{--<source src="{{URL::asset($item->url_mp3)}}" type="audio/mpeg">--}}
                {{--</audio>--}}
            {{--@endif--}}

        {{--</div>--}}
    {{--@endforeach--}}
<div class="container">
    <div>
        <h3>Listen and repeat</h3>
        <input type="hidden" id="level-tesing-hidden" value="{{$get_next_level}}">
        <input type="hidden" id="skill-code-tesing-hidden" value="Speak">

        <p id="text_demo">{{$item->content}}</p>
        @if(isset($speak_items[0]->url_mp3_create))
            <audio controls>
                <source src="{{$item->url_mp3_create}}" type="audio/mpeg">
            </audio>
        @else
            <audio controls>
                <source src="{{URL::asset($item->url_mp3)}}" type="audio/mpeg">
            </audio>
        @endif

    </div>

    <div style="float:left; width: 100%">
        {{--<a href="#" id="start_button" onclick="startDictation(event)"><i class="fa fa-microphone" aria-hidden="true"></i></a>--}}

        <div id="results">
            <a href="#" id="start_button" style="margin-right: 10px;"><i class="fa fa-microphone" aria-hidden="true"></i></a>
            <span id="final_span" class="final"></span>
            <span id="interim_span" class="interim"></span>
        </div>
        <div id="messages_result"></div>
    </div>

    <p> For now it is supported only in Firefox(v25+) and Chrome(v47+)</p>
    <div id='gUMArea'>
        <div>
            Record:
            <input type="radio" name="media" value="audio">audio
        </div>
    </div>
    <div id='btns'>
        <button  class="btn btn-default" id='start'>Start</button>
        <button  class="btn btn-default" id='stop' disabled>Stop</button>
    </div>
    <div>
        <ul  class="list-unstyled" id='ul'></ul>
    </div>

    <button id="check_diff" class="btn btn-success" style="margin-top: 10px;" disabled>Check</button>
    {{--<button id="next-level-speck" class="btn btn-success"--}}
            {{--style="margin-top: 10px;" onclick="next_level_speaking('{{$get_next_level}}')">Next</button>--}}
    <a class="btn btn-success" href="{{route('frontend.dashboard.student.learn.speak', [])}}">Next</a>
</div>

@stop

@section('script')

    <script>
        'use strict'

        let log = console.log.bind(console),
                id = val => document.getElementById(val),
                ul = id('ul'),
                start = id('start'),
                stop = id('stop'),
                check_diff = id('check_diff'),
                stream,
                recorder,
                counter=1,
                chunks,
                media, record_recognition, final_transcript = '';

            let mv = { audio: {
                            tag: 'audio',
                            type: 'audio/ogg',
                            ext: '.ogg',
                            gUM: {audio: true}
                        }
                    };
            media =mv.audio;
            navigator.mediaDevices.getUserMedia(media.gUM).then(_stream => {
                stream = _stream;
            id('gUMArea').style.display = 'none';
            id('btns').style.display = 'inherit';
            start.removeAttribute('disabled');

            recorder = new MediaRecorder(stream);
            recorder.ondataavailable = e => {
                chunks.push(e.data);
                if(recorder.state == 'inactive')  makeLink();
            };
//            log('got media successfully');
        }).catch(log);
        console.log(record_recognition);
        start.onclick = e => {
            start.disabled = true;
            stop.removeAttribute('disabled');
            chunks=[];
            recorder.start();

            final_transcript = '';
            final_span.innerHTML = '';
            interim_span.innerHTML = '';
            messages_result.innerHTML = '';

            record_recognition = new webkitSpeechRecognition();
            record_recognition.lang = "en-US";
            record_recognition.continuous = true;
            record_recognition.interimResults = true;
            record_recognition.start();

            record_recognition.onresult = function(event) {
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
            }
        }
        stop.onclick = e => {
            stop.disabled = true;
            recorder.stop();
            start.removeAttribute('disabled');
            check_diff.removeAttribute('disabled');

            record_recognition.stop();
        }

        function makeLink(){
            let blob = new Blob(chunks, {type: media.type })
                    , url = URL.createObjectURL(blob)
                    , li = document.createElement('li')
                    , mt = document.createElement(media.tag)
                    , hf = document.createElement('a')
                    ;
            mt.controls = true;
            mt.src = url;
            hf.href = url;
            hf.download = `${counter++}${media.ext}`;
            hf.innerHTML = `<i class="fa fa-download" aria-hidden="true"></i> ${hf.download}`;
            li.appendChild(mt);
            li.appendChild(hf);
            ul.appendChild(li);
        }

        </script>
    <script>


    <!-- HTML5 Speech Recognition API -->
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

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

        $('#check_diff').click(function () {

            text_demo = $('#text_demo').text();
            text_speak = $('#final_span').text();

            url = '{{ route('frontend.student.testing.check_text_speech') }}';
            $.ajax({
                url: url,
                type: "post",
                data: {
                    text_demo: text_demo,
                    text_speak: text_speak,
                    _token: CSRF_TOKEN
                },
                success: function (data) {

                    if (data.code == 200) {
                        if (data.result == null) {
                            $('#messages_result').text(data.message);
                        } else {
                            $('#final_span').remove();
                            $('#results').prepend(data.result);
                            $('#messages_result').text(data.message);
                        }
                    }

                    if (data.code == 404) {
                        swal('', data.message, 'error').catch(swal.noop);

                        return false;
                    }
                },
                error: function () {
                    alert('error');
                    swal('', 'Không thực hiện được hành động này!', 'error');
                }
            });
        });

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

        function next_level_speaking() {
            $.ajax({
                url: '{{route("frontend.dashboard.student.learn.speak")}}',
                type: "get",
                data: {},
                success: function (data) {},
                error: function () {
                    alert("Không lấy được thông tin này!");
                }
            });

            return false;
        }
    </script>

@stop
