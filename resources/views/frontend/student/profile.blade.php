@if (Auth::user()->hasRole('ST'))
    @extends('layouts.app')

    @section('menu-main')
         @include('frontend.student.partials.menu-main')
    @stop

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

@else
    @extends('layouts.app-backend')
@endif

@section('style-menu-main')
    <style>
        #edit_avatar_img {
            width: 100%;
        }

        #editInputFileAvatar {
            margin-bottom: 10px;
            margin-top: 10px;
        }

    </style>
@stop


@section('content')

    <div class="container">
        <div><h3>Profile</h3></div>
        <div class="row">
            <div class="col-lg-3">
                {{ Form::open(['route' => ['frontend.student.change.profile.avatar', $user->id],
                     'class' => 'form-horizontal', 'method' => 'POST', 'id' => 'edit-avatar-auth',
                         'enctype' => 'multipart/form-data']) }}
                @if($user->avatar != null)
                    <img src="{{URL::asset($user->avatar)}}" id="edit_avatar_img" alt="Avatar">
                @else
                    <img src="{{URL::asset('imgs-dashboard/avatar.png')}}" id="edit_avatar_img" alt="Avatar">
                @endif

                @if(Auth::user())
                    <input type="file" id="editInputFileAvatar" name="change_avatar">
                @endif
                <button type="submit" class="btn btn-default">Upload</button>
                {!! Form::close() !!}

            </div>
            <div class="col-lg-9">
                {{ Form::open(['route' => ['frontend.student.change.profile.infomation', $user->id],
                     'class' => 'form-horizontal', 'method' => 'POST', 'id' => 'edit-infomation-auth']) }}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="user_name">User Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="user_name" name="change_user_name"
                               value="{{$user->user_name}}" placeholder="Enter User Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="full_name">Full Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="full_name" name="change_full_name"
                               value="{{$user->full_name}}" placeholder="Enter Full Name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="change_email"
                               value="{{$user->email}}" placeholder="Enter email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="sel1">Class:</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="change-class" name="change_class" required>
                            @foreach($classes as $class)
                                <option value="{{$class->id}}">{{$class->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{--<div class="form-group">--}}
                {{--<label class="control-label col-sm-2" for="pwd">Password:</label>--}}
                {{--<div class="col-sm-10">--}}
                {{--<input type="password" class="form-control" id="pwd"--}}
                {{--value="{{$user->password}}" placeholder="Enter password">--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="row" style="margin-bottom: 40px"></div>

    </div>

@stop

@section('script')
    <script>
        //
        <!-- HTML5 Speech Recognition API -->
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        function readURL_Avatar(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#edit_avatar_img').attr('src', e.target.result);
                    $('#edit_avatar_img').css('display', 'block');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#editInputFileAvatar").change(function () {
            readURL_Avatar(this);
        });

        $('#change-class').val('{{$user->class_id}}');
    </script>

@stop
