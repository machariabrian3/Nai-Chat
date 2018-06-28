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
                  <h4 align="center">Find Friends {{Auth::user()->name}}</h4>
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
                        @foreach($FriendRequests as $uList)
                        <div style="border-bottom:1px solid #ccc; margin-bottom:15px" class="row">
                          <div class="col-md-2 pull-left">
                            <img class="img-rounded" src="{{ url('../')}}/img/{{$uList->pic}}" width="80px" height="80px">
                          </div>
                          <div class="col-md-7 pull-left">
                            <h3>
                              <a href="#">
                                {{ucwords($uList->name)}}
                              </a>
                            </h3>
                            <p><b>Gender: </b>{{$uList->gender}}</p>
                            <p><b>Email: </b>{{$uList->email}}</p>
                          </div>
                          <div class="col-md-3 pull-right">

                              <p>
                                <a href="{{url('/accept')}}/{{$uList->name}}/{{$uList->id}}" class="btn btn-sm btn-success">Confirm</a>

                                <a href="{{url('/requestRemove')}}/{{$uList->id}}" class="btn btn-sm btn-danger">Reject</a>
                              </p>

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
