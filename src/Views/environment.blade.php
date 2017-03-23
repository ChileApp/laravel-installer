@extends('vendor.installer.layouts.master')

@section('title', trans('installer_messages.environment.title'))
@section('style')
    <link href="{{ asset('installer/bootstrap/css/bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset('installer/froiden-helper/helper.css') }}" rel="stylesheet"/>
@endsection
@section('container')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('message'))
        <p class="alert alert-danger">{{ session('message') }}</p>
    @endif

    <form method="post" action="{{ route('LaravelInstaller::environmentSave') }}" id="login-form">
    <div class="modal-body">
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">Hostname</label>

                <div class="col-sm-10">
                    <input type="text" name="hostname" class="form-control" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" name="username" class="form-control">
                </div>
            </div>


            <div class="form-group">
                <label  class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="password">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Database</label>
                <div class="col-sm-10">
                    <input type="text" name="database" class="form-control">
                </div>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <div class="buttons">
            <button class="button" onclick="checkEnv();return false">
                {{ trans('installer_messages.next') }}
            </button>
        </div>
    </div>
   </form>
    <script>
        function checkEnv() {
            $.easyAjax({
                url: "{!! route('LaravelInstaller::environmentSave') !!}",
                type: "GET",
                data: $("#login-form").serialize(),
                container: "#login-form",
                messagePosition: "inline"
            });
        }
    </script>
@stop
@section('scripts')
    <script src="{{ asset('installer/js/jQuery-2.2.0.min.js') }}"></script>
    <script src="{{ asset('installer/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('installer/froiden-helper/helper.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection