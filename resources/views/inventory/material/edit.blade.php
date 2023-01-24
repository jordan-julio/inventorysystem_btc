@extends('layouts.app', ['page' => 'Edit Material', 'pageSlug' => 'homematerials', 'section' => 'material'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Edit Material</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('inventory.material.home') }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('inventory.material.update', $material) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">Material Information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('material') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-material">{{ __('material') }}</label>
                                    <input type="text" name="material" id="input-material" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('material', $material->material) }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>

                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-TotalmatAmount">{{ __('Quantity') }}</label>
                                    <input type="text" name="TotalmatAmount" id="input-TotalmatAmount" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Quantity') }}" value="{{ old('TotalmatAmount', $material->TotalmatAmount) }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        new SlimSelect({
            select: '.form-select'
        })
    </script>
@endpush