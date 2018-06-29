@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-info">
          <div class="panel-heading">
            {{ucwords(Auth::user()->name)}}'s Quick Links
          </div>
          <div class="panel-body">
            <ul  class="list-group">
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
      @foreach($userData as $uData)
        <div class="col-md-9">
            <div class="panel panel-info">
                <div class="panel-heading">
                  {{ucwords($uData->name)}}
                  @if($uData->id == Auth::user()->id)
                  <a href="{{ url('editProfile') }}">
                    <button type="button" name="edit" class="pull-right btn btn-success btn-sm">
                      Edit Profile
                    </button>
                  </a>
                  @endif
                </div>
                <div class="panel-body">

                    <div class="col-md-6 ">
                      <div class="thumbnail">
                        <h3 align="center">{{ucwords($uData->name)}}</h3>
                        <img class="img-circle" src="{{ url('../')}}/img/{{$uData->pic}}" width="80px" height="80px"><br>
                        <div class="caption" align="center">
                          <p>Nairobi - Kenya</p>

                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <h4>
                        <span class="label label-default">About</span>
                      </h4>
                      <p>{{$uData->about}}</p>
                    </div>

                </div>
            </div>
        </div>
      @endforeach
    </div>
</div>
@endsection
