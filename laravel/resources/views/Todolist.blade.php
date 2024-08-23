
@extends('layouts.app')
@section('content')
<h1>PHP - Simple To Do List App</h1>
<div id="message"></div>
<form action="{{url('ajaxtask')}}" method="post" id="addtask">
@csrf
    <div class="form-group text-center">
        <input type="text" name="description">
        <input type="submit" class="btn btn-primary" value="Add Task">
        <!-- <button type="submit" class="btn btn-primary">Add Task</button> -->
    </div>
    <div class="form-group">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="task_data">

            </tbody>

    </div>
</form>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        $('#addtask').on('submit', function(event)
        {
            event.preventDefault();
            $.ajax({
                url:"{{url('ajaxtask')}}",
                data:$('#addtask').serialize(),
                type:'post',
                success:function(result)
                {
                    $('#message').css('display','block');
                    $('#message').html(result.message);
                    $('#addtask')[0].reset();
                    fetchrecord();
                }
            });
        });

        $(document).on('click','.btn-success',function(event){
            $.ajaxSetup({
                beforeSend: function(xhr, type) {
                    if (!type.crossDomain) {
                        xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                    }
                },
            });
            event.preventDefault();
            var id=$(this).val();
            console.log(id);
            $.ajax({
                    url:'updatedata',
                    type:'post',
                    data:{
                        id:id
                    },
                    
                    success:function(response)
                    {
                        console.log(response);
                        fetchrecord();
                    }
            })
            
        });

        $(document).on('click','.btn-danger',function(event){
            $.ajaxSetup({
                beforeSend: function(xhr, type) {
                    if (!type.crossDomain) {
                        xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                    }
                },
            });
            event.preventDefault();
            var id=$(this).val();
            if(confirm("Are you sure you want to delete this task?")){
                $.ajax({
                    url:'deletedata',
                    type:'POST',
                    data:{
                        id:id
                    },
                    success:function(response)
                    {
                        // console.log(response);
                        fetchrecord();
                    }
                })
            }
        });
        fetchrecord();
        function fetchrecord() {
            

            $.ajax({
                url:'getdata',
                type:'GET',
                success:function(response)
                {
                    var tr = '';
                    for(var i=0;i<response.length;i++) 
                    {
                        var id=response[i].id;
                        var description = response[i].description;
                        var status = response[i].status;
                        tr +='<tr>';
                        tr += '<td>'+id+'</td>';
                        tr += '<td>'+description+'</td>';
                        tr += '<td>'+status+'</td>';
                        tr +='<td><button type="button" value="'+id+'" class="btn btn-success"><i class="fa fa-edit"></i></button></td>';
                        tr +='<td><button type="button" value="'+id+'" class="btn btn-danger"><i class="fa fa-close"></i></button></td>';
                        tr +='</tr>';
                        
                    }
                $('#task_data').html(tr);
                }
            });
        }
        
        
    });
</script>
@endsection
    