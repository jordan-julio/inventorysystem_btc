@extends('layouts.app', ['page' => 'List of Materials', 'pageSlug' => 'homematerials', 'section' => 'material'])

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Materials</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('inventory.material.createnew') }}" class="btn btn-sm btn-primary">Material Baru</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">Material Name</th>
                                <th scope="col">Amount/Jumlah (kg)</th>
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($materials as $material)
                                    <tr>
                                        <td>{{ $material->material }}</td>
                                        <td>{{ $material->TotalmatAmount }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('inventory.material.edit', $material) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Product">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('inventory.material.destroy', $material) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete Material" onclick="confirm('Are you sure you want to remove this product? The records that contain it will continue to exist.') ? this.parentElement.submit() : ''">
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
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end">
                        {{ $materials->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
