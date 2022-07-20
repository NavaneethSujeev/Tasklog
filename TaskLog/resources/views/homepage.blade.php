@extends('sidebar.sidebar')
@section('content')
<style>
    .section{
        padding: 25%
    }
    .wrapper{
        text-align: center;
    }
</style>
<div class="section">
    <h3>WELCOME TO TASKLOG ,YOU ARE A <u> {{auth()->user()->user_type}}</u></h3>
    <form action="{{route('logout')}}">
        <div class="wrapper">
             <button type="submit" class="btn btn-danger">Logout</button>
        </div>
    </form>
</div>
@stop