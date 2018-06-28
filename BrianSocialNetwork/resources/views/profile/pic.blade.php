@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{Auth::user()->name}}</div>
                <div class="panel-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif -->
                    <div class="col-md-4">
                      Welcome to your profile
                      <img src="{{ url('../')}}/img/{{Auth::user()->pic}}" width="80px" height="80px"><br><hr>

                      <form class="form-group" action="{{ url('/') }}/uploadPhoto" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="file" name="pic" value="" class="form-control">
                        <br>
                        <input type="submit" name="submit" class="btn btn-success" value="Submit">

                      </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
