@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-info">
          <div class="panel-heading">
            {{ucwords(Auth::user()->name)}}
          </div>
          <div class="panel-body">
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
                    Friend Requests ({{App\friendships::where('status',NULL)->where('user_requested',Auth::user()->id)->count()}})
                  </li>
                </a>
              </ul>
            </div>
          </div>
        </div>
      </div>
        <div class="col-md-9">
            <div class="panel panel-info">
                <div class="panel-heading">
                  <h4 align="center">Notifications</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                      @if(session()->get('msg'))
                        <div class="alert alert-success">
                          <p>
                            {{session()->get('msg')}}
                          </p>
                        </div>
                      @endif
                      <div class="col-md-12 col-sm-12">
                        @foreach($notes as $note)
                        <div style="border-bottom:1px solid #ccc; margin-bottom:15px" class="row">
                          <div class="list-group">
                            <a href="{{url('/profile')}}/{{$note->slug}}" class="list-group-item">
                              <h4 class="list-group-item-heading" style="color:green;">{{ucwords($note->name)}}</h4>
                              <p class="list-group-item-text">{{$note->note}}</p>
                            </a>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
