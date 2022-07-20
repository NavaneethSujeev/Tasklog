@extends('sidebar.sidebar')
@section('content')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<style>
    .section{
        padding: 20px;
    }
</style>
<div class="section">
    <table id="dtBasicExample" class="table table-striped table-bordered padding" cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th class="th-sm">Name</th>
            <th class="th-sm">Task</th>
            <th class="th-sm">Date</th>
            <th class="th-sm">Time Taken (hr)</th>
            <th class="th-sm">Status</th>
            <th class="th-sm">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{$task->name}}</td>
                <td>{{$task->task}}</td>
                <td>{{$task->date}}</td>
                <td>
                <?   $time1 = new DateTime($task->starttime);
                        $time2 = new DateTime($task->endtime);
                        $interval = $time1->diff($time2);
                        echo $interval->format('%H:%M  hour');
                ?>
                </td>
                <td>@if($task->status=='2')<button class="btn btn-warning">Pending</button>@elseif($task->status=='1')<button type="button" class="btn btn-danger">Rejected</button>@elseif($task->status=='0')<button  type="button" class="btn btn-success">Approved</button>@endif</td>
                <td>
                    <button type="button"class="btn btn-danger changestatus" datastatus="Reject" value="{{$task->id}}">Reject</button>
                    &nbsp
                    <button type="button" class="btn btn-success changestatus"  datastatus="Approve" value="{{$task->id}}">Approve</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>   
<script>
    $('.changestatus').click(function(){
      var id     = $(this).val();
      var status = $(this).attr('datastatus');

      console.log(status);
      console.log(id);

  
        $.ajax({
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ url('/changestatus') }}", 
            type:'POST',
            data:{id,status},
            success: function(result){
                window.location.reload();

            }
        });
    });

</script>
@stop   