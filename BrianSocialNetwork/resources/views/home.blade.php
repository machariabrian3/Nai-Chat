@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-info">
          <div class="panel-heading">
            Quick Links
          </div>
          <div class="panel-body">
            <ul class="list-group">
              <a style="margin:1px;" href="/friends">
                <li class="list-group-item">
                  My Friends
                </li>
              </a>
              <a style="margin:1px;" href="/findFriends">
                <li class="list-group-item">
                  Find Friends
                </li>
              </a>
              <a style="margin:1px;" href="/requests">
                <li class="list-group-item">
                  Friend Requests ({{App\friendships::where('status',0)->where('user_requested',Auth::user()->id)->count()}})
                </li>
              </a>

            </ul>
          </div>
        </div>
      </div>
        <div class="col-md-9">
            <div class="panel panel-info">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
