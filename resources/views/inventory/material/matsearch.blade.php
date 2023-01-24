@extends('layouts.app', ['page' => 'Add Material to Pot', 'pageSlug' => 'matsearch', 'section' => 'material'])

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="card-title">Pot Search</h4>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <p>&emsp;Cari Tanggal:</p>
	                <form action="/invetorymanagement/laravel-inventory/public/inventory/materials/cari" method="GET">
                        <div class="col-12">
		                    <input type="date" name="cari" class="form-control" value="{{ old('cari') }}">
                        </div>
                        <div class="col-3">
		                    <input type="submit" value="CARI">
                        </div>
	                </form>
                    
                    <div class="card-body">
                        @include('alerts.success')
                        <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                <thead class=" text-primary">
		                            <tr>
                                    <th>Number</th>
                                    <th>Date Created</th>
                                    <th>User</th>
                                    <th>Materials</th>
                                    <th>Total Stock</th>
                                    <th></th>
                                </thead>
                                <tbody>
		                        @foreach ($materials as $material)
                                    <tr>
                                        <td>{{ $material->id }}</td>
                                        <td>{{ date('d-M-y', strtotime($material->DateAdded)) }}</td>
                                        <td></td>
                                        <td>{{ $material->usedmaterial->count() }}</td>
                                        <td>{{ $material->usedmaterial->sum('qty') }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('materialused.show', ['materialused' => $material]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Sale">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('materialused.destroy', $material) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete Sale" onclick="confirm('Are you sure you want to delete this sale? All your records will be permanently deleted.') ? this.parentElement.submit() : ''">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
	</table>
    <br/>
	Halaman : {{ $materials->currentPage() }} <br/>
	Jumlah Data : {{ $materials->total() }} <br/>
	Data Per Halaman : {{ $materials->perPage() }} <br/>
 
 
	{{ $materials->links() }}
                        </div>
                    </div>    
                </div>
            </div>

@endsection
	