@extends('layouts.app', ['pageSlug' => 'material', 'page' => 'Materials Purchase', 'section' => 'material'])


@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Materials Purchased</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('inventory.material.create') }}" class="btn btn-sm btn-primary">Tambah Material</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-12">
                        <input type="date" name="search" id="search" class="form-control" placeholder="Insert Date..." />
                    </div>
                    
                    <div class="card-body">
                        @include('alerts.success')
                        <div class="table-responsive">
                            <h3 align="center">Total Data : <span id="total_records"></span></h3>
                            <table class="table table-striped table-bordered">
                                <thead class=" text-primary">
                                    <th scope="col">Material Name</th>
                                    <th scope="col">Amount/Jumlah (kg)</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">DateAdded</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>    
                </div>
            </div>

<script>
$(document).ready(function(){

 fetch_customer_data();

 function fetch_customer_data(query = '')
 {
  $.ajax({
   url:"{{ route('inventory.material.action') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('tbody').html(data.table_data);
    $('#total_records').text(data.total_data);
    $('#total_price').text(data.total);
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_customer_data(query);
 });
});
</script>
<br/>
<p class="text-primary">Total: <span id="total_price"></span></p><br/>
@endsection

