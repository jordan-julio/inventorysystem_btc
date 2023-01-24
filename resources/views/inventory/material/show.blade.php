@extends('layouts.app', ['page' => 'Add Material to Pot', 'pageSlug' => 'materialuse', 'section' => 'material'])

@section('content')
    @include('alerts.success')
    @include('alerts.error')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Pot Summary</h4>
                        </div>
                        <div class="col-4 text-right">
                            <form action="{{ route('materialused.destroy', $materialused) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Delete Pot
                                </button>
                            </form>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>Pot Number</th>
                            <th>Date</th>
                            <th>Product Name</th>
                            <th>materials</th>
                            <th>Total Quantity (kg)</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $materialused->PotNo }}</td>
                                <td>{{ date('d-m-y', strtotime($materialused->DateAdded)) }}</td>
                                <td>{{ $materialused->product_name }}</td>
                                <td>{{ $materialused->usedmaterial->count() }}</td>
                                <td>{{ $materialused->usedmaterial->sum('qty') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">products: {{ $materialused->usedmaterial->sum('qty') }}</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('materialused.product.add', ['materialused'=>$materialused->id]) }}" class="btn btn-sm btn-primary">Add</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Material</th>
                            <th>Quantity (Kg)</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($materialused->usedmaterial as $soldmat)
                                <tr>
                                    <td>{{ $soldmat->materialh->id }}</td>
                                    <td>{{ $soldmat->materialh->material }}</td>
                                    <td>{{ $soldmat->qty }}</td>
                                    <td class="td-actions text-right">
                                        <a href="{{ route('materialused.product.edit', ['materialused' => $materialused, 'usedmaterial' => $soldmat]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Pedido">
                                            <i class="tim-icons icon-pencil"></i>
                                        </a>
                                        <form action="{{ route('materialused.material.destroy', ['materialused' => $materialused, 'usedmaterial' => $soldmat]) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete Pedido" onclick="confirm('Estás seguro que quieres eliminar este pedido de producto/s? Su registro será eliminado de esta venta.') ? this.parentElement.submit() : ''">
                                                <i class="tim-icons icon-simple-remove"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection

@push('js')
    <script src="{{ asset('assets') }}/js/sweetalerts2.js"></script>
@endpush
