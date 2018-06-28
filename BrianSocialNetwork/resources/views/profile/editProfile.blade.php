@extends('layouts.app')

@section('content')
{{$data}}
<div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading">
            Sidebar
          </div>
        </div>
      </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                  {{Auth::user()->name}}
                  <!-- <a href="{{ url('editProfile') }}">
                    <button type="button" name="edit" class="pull-right btn btn-success btn-sm">
                      Edit Profile
                    </button>
                  </a> -->

                </div>
                <div class="panel-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif -->
                    <div class="col-md-12">
                      <h4 align="center">Edit your profile</h4>
                      <div class="col-md-12">
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
                      <div class="col-md-12">
                        <h4>Edit your about message</h4>
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1">#about</span>
                          <input type="text" class="form-control" placeholder="About" name="" aria-describedby=" basic-addon1" value="{{Auth::user()->about}}">
                        </div>
                      </div>
                      <div class="">
                        <input style="margin:10px;" class="btn btn-success btn-sm pull-right" type="submit" name="" value="submit">
                      </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
