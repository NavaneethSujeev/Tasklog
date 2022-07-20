@extends('sidebar.sidebar')
@section('content')
<style>
    .container{
        padding: 10%;
    }
    .section{
        padding:5%;
    }
    h3{
        text-align: center;
    }
</style>
<body>
    <div class="container">
        <div class="card">
            <div class="section">
                <form action="{{route('doaddstaff')}}" method="post">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <h3>ADD STAFF</h3>
                    @csrf
                    <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="name" class="form-control" id="name" placeholder="Enter name" name="name" required>
                    </div>
                    <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                    </div>
                    <div class="mb-3">
                    <label for="pwd" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
                    </div>
                    <div class="form-check mb-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="remember"> Remember me
                    </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>    
        </div>
    </div>
@stop