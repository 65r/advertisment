@extends('front.frontShow.master')
@section('content')
@include('front.frontShow.header')
    <div class="container-fluid">
        <div class="row text-center">
            <div >
                <div class="box text-center" id="card">
                    <p class="text-center text-bold pt-4">{{__('sentence.choose_header')}}</p>
                    <a href="{{route('login')}}"><button class="btn btn-primary mt-3 px-5">
                            {{__('sentence.login_as_user')}}</button><hr></a>

                    <a href="{{route('admin_login')}}"><button class="btn btn-secondary mt-3 px-5">
                            {{__('sentence.login_as_admin')}}</button>
                        <hr></a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style>
    div#card{
        margin: 30px;
        min-width: 350px;
        border-radius: 15px;
        min-height: 350px;
        background-color: lavender;
        border: 1px solid lavender;
    }
    </style>
    @endsection
