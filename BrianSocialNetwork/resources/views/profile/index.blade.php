@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading">
            {{ucwords(Auth::user()->name)}}'s Sidebar
          </div>
        </div>
        <div class="panel-body">
        
        </div>
      </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                  {{Auth::user()->name}}
                  <a href="{{ url('editProfile') }}">
                    <button type="button" name="edit" class="pull-right btn btn-success btn-sm">
                      Edit Profile
                    </button>
                  </a>

                </div>
                <div class="panel-body">

                    <div class="col-md-6 ">
                      <div class="thumbnail">
                        <h3 align="center">{{ucwords(Auth::user()->name)}}</h3>
                        <img class="img-circle" src="{{ url('../')}}/img/{{Auth::user()->pic}}" width="80px" height="80px"><br>
                        <div class="caption" align="center">
                          <p>Nairobi - Kenya</p>
                          <a href="{{ url('/') }}/changePhoto">
                            <button class="btn btn-sm btn-info" type="button" name="button">
                              <i>change image</i>
                            </button>
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <h4>
                        <span class="label label-default">About</span>
                      </h4>
                      <p>{{Auth::user()->about}}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
