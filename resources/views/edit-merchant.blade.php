@extends('components.app')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="breadcrumb breadcrumb-style ">
                            <li class="breadcrumb-item">
                                <h4 class="page-title">Edit Merchant</h4>
                            </li>
                            <li class="breadcrumb-item bcrumb-1">
                                <a href="/dashboard">
                                    <i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item bcrumb-2">
                                <a href="/all-merchant" onClick="return false;">Merchant</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Merchant</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <strong>Edit</strong> Merchant</h2>
                        </div>
                        @if (count($errors) > 0)
                            <div class = "alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" action="{{route('updatemerchant', $merchants->id)}}" >
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-2">
                                    <select class="list-group row-cols-md-4" name="state"  required>
                                        <option value="{{$merchants->state}}">{{$merchants->state}}</option>
                                        @foreach($states as $state)
                                            <option value="{{$merchants->state}}">{{$state->state_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{$merchants->first_name}}" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{$merchants->last_name}}" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control"
                                                       placeholder="Business name" name="business_name" value="{{$merchants->business_name}}"  required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" placeholder="Agent Id" name="agent_id" value="{{$merchants->agent_id}}" />
                                                @if(Session::get('agent_error'))
                                                    <p>Agent_id is already in use</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <select class="list-group row-cols-md-4" name="odd1" id="select1" onchange="getSelectedValue(this.value);" >
                                                <option value="{{$merchants->odd1}}" >{{optional($merchants->merchantOdd1)->odds}}</option>
                                                @foreach($odds as $odd)
                                                    <option value="{{$odd->id}}">{{$odd->odds}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="list-group row-cols-md-4" name="odd2" id="select2" onchange="getSelectedValue(this.value);" >
                                                <option value="{{$merchants->odd2}}" >{{optional($merchants->merchantOdd2)->odds}}</option>
                                            @foreach($odds as $odd)
                                                    <option value="{{$odd->id}}">{{$odd->odds}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="list-group row-cols-md-4" name="odd3" id="select3" >
                                                <option value="{{$merchants->odd3}}" >{{optional($merchants->merchantOdd3)->odds}}</option>
                                            @foreach($odds as $odd)
                                                    <option value="{{$odd->id}}">{{$odd->odds}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="list-group row-cols-md-4" name="odd4" id="select4">
                                                <option value="{{$merchants->odd4}}" >{{optional($merchants->merchantOdd4)->odds}}</option>
                                            @foreach($odds as $odd)
                                                    <option value="{{$odd->id}}">{{$odd->odds}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="list-group row-cols-md-4" name="odd5" id="select5">
                                                <option value="{{$merchants->odd5}}" >{{optional($merchants->merchantOdd5)->odds}}</option>
                                            @foreach($odds as $odd)
                                                    <option value="{{$odd->id}}">{{$odd->odds}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="list-group row-cols-md-4" name="odd6" id="select6">
                                                <option value="{{$merchants->odd6}}" >{{optional($merchants->merchantOdd6)->odds}}</option>
                                            @foreach($odds as $odd)
                                                    <option value="{{$odd->id}}">{{$odd->odds}}</option>
                                                @endforeach
                                            </select>
                                        </div>
{{--                                        <div class="col-sm-6 col-lg-3">--}}
{{--                                            @foreach( $odds as $odd)--}}
{{--                                                <label>--}}
{{--                                                    <input type="checkbox" name="odds[]" value="{{$odd->id}}" multiple />--}}
{{--                                                    <span>{{$odd->odds}}</span>--}}
{{--                                                </label>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
                                    </div>
                                    <div class="col-lg-12 p-t-20 text-center">
                                        <button type="submit" class="btn btn-success waves-effect m-r-15" >Submit</button>
                                        <button type="button" class="btn btn-danger waves-effect"><a href="/all-merchant" style="color: inherit;"> Cancel </a></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
