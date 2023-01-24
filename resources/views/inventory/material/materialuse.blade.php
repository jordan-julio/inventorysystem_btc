
@extends('layouts.app', ['page' => 'Add Material to Pot', 'pageSlug' => 'materialuse', 'section' => 'material'])

@section('content')
    @include('alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Material Use</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('materialused.create') }}" class="btn btn-sm btn-primary">Register Pot</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table">
                            <thead>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $materials->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
