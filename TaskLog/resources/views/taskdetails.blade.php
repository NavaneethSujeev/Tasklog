@extends('sidebar.sidebar')
@section('content')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
    .taskdetails{
        padding: 3px;
    }
    .warning{
        background-color: #ffc107;
    }
    .reject{
        background-color: #dc3545;

    }
    .approved{
        background-color: #28a745;

    }
    .statusspan{
        color: white;
    }
</style>
<div class="section">
    
    <div class="card">
        <h3>TASK DETAILS</h3>
        @foreach($tasks as $task)
          <div class="taskdetails">
            <div class="card @if($task->status == 0)approved @elseif($task->status == 1)reject @elseif($task->status == 2)warning @endif">
                <div class="row">
                    <div class="col-md-10"><h5>{{$task->task}}</h5> <br> <b>DATE :</b> {{$task->date}} <b> START :</b>  {{$task->starttime}} <b> END :</b>  {{$task->endtime}}</div>
                    <div class="col-md-2">@if($task->status == 1) <span class="statusspan">REJECTED<span> @elseif($task->status == 0)<span class="statusspan">APPROVED<span> @else <button class="btn btn-primary editbtn" value="{{$task->id}}">Edit</button>@endif</div>
                </div>
             </div>
          </div>
         @endforeach 
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="update">
                    <h3>ADD TASK</h3>
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Task Title:</label>
                        <input type="name" class="form-control" id="name"  name="Task" required>
                    </div>
                    <div class="row-fluid">
                        <div class="col-md-5">
                            <label for="Date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="Date"  name="Date" required>
                        </div>
                        <div class="col-md-5">
                            <label for="Starttime" class="form-label">Start Time</label>
                            <input type="time" class="form-control" id="starttime"  name="starttime" required>
                        </div>                   
                        <div class="col-md-5">
                            <label for="Endtime" class="form-label">End Time</label>
                            <input type="time" class="form-control" id="endtime"  name="endtime" required><br>
                        </div>
                    </div>
                    <input type="hidden" value="" id="selectedid">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="updatebtn">Save changes</button>
            </div>
          </div>
        </div>
      </div>
</div> 
<script>
    $('.editbtn').click(function(){
       var id =  $(this).val();
       $('#selectedid').val(id);

       $('#exampleModal').modal('show');
       
       $.ajax({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ url('/edittask') }}", 
            type:'POST',
            data:{id},
            success: function(result){
                $('input[name="Task"]').val(result.task);
                $('input[name="Date"]').val(result.date);
                $('input[name="starttime"]').val(result.starttime);
                $('input[name="endtime"]').val(result.endtime);

             }
         });
    });
    $('#updatebtn').click(function(){

       var Task      = $('input[name="Task"]').val();
       var Date      = $('#Date').val();
       var starttime = $('#starttime').val();
       var endtime   = $('#endtime').val();
       var id        = $('#selectedid').val();
       
       $.ajax({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ url('/updatetask') }}", 
            type:'POST',
            data:{id,Task,Date,starttime,endtime},
            success: function(result){
                window.location.reload();

             }
         });
    });

</script>

@stop