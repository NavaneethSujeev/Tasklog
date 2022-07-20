@extends('sidebar.sidebar')
@section('content')
<style>
    .card{
        padding:4%; 
    }
    .section{
        padding:4%; 
    }
    h3{
        text-align: center;
    }
</style>
<div class="section">
    <div class="card">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="section">
            <form action="{{route('doaddtask')}}" method="post">
                <h3>ADD TASK</h3>
                @csrf
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Task Title:</label>
                    <input type="name" class="form-control" id="name" placeholder="Your Task" name="Task">
                </div>
                <div class="row-fluid">
                    <div class="col-md-3">
                        <label for="Date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="Date"  name="Date">
                    </div>
                    <div class="col-md-3">
                        <label for="Starttime" class="form-label">Start Time</label>
                        <input type="time" class="form-control" id="starttime"  name="starttime">
                    </div>                   
                    <div class="col-md-3">
                        <label for="Endtime" class="form-label">End Time</label>
                        <input type="time" class="form-control" id="endtime"  name="endtime"><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>    
    </div>
</div>   
@stop