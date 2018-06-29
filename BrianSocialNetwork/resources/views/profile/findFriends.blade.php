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
                      <div class="col-md-12 col-sm-12">
                        @foreach($allUsers as $uList)
                        <div style="border-bottom:1px solid #ccc; margin-bottom:15px" class="row">
                          <div class="col-md-2 pull-left">
                            <img class="img-rounded" src="{{ url('../')}}/img/{{$uList->pic}}" width="80px" height="80px">
                          </div>
                          <div class="col-md-7 pull-left">
                            <h3>
                              <a href="{{url('/profile')}}/{{$uList->slug}}">
                                {{ucwords($uList->name)}}
                              </a>
                            </h3>
                            <p> Nairobi-Kenya</p>
                            <p class="label label-default">{{$uList->about}}</p>
                          </div>
                          <div class="col-md-3 pull-right">
                            <?php
                                $check = DB::table('friendships')->where('user_requested','=',$uList->id)->where('requester','=',Auth::user()->id)->first();
                                if ($check == '') {
                              ?>
                              <p>
                                <a href="{{url('/')}}/addFriend/{{$uList->id}}" class="btn btn-sm btn-success">Add Friend</a>
                              </p>
                              <?php  }else{ ?>
                                <p class="label label-primary">Request already sent.</p>
                              <?php } ?>

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
