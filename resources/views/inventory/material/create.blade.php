@extends('layouts.app', ['page' => 'Purchase Material', 'pageSlug' => 'material', 'section' => 'material'])

@section('content')
    <div class="container-fluid mt--7">
    @include('alerts.error')
    <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Add Material</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('inventory.material.index') }}" class="btn btn-sm btn-primary">Back to list</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <form method="post" action="{{ route('inventory.material.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Material information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('material_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-material">Product</label>
                                    <select name="material_id" id="input-material" class="form-select form-control-alternative{{ $errors->has('material') ? ' is-invalid' : '' }}" required>
                                    @foreach ($materials as $material)
                                            @if($material['id'] == old('id'))
                                                <option value="{{$material['id']}}" selected>{{ $material->material }}</option>
                                            @else
                                                <option value="{{$material['id']}}">{{ $material->material }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'material_id'])
                                </div>
                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-matAmount">Material Amount (kg)</label>
                                    <input type="number" step=0.001 name="matAmount" id="input-matAmount" class="form-control form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" value="0" required>
                                    @include('alerts.feedback', ['field' => 'product_id'])
                                </div>
                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-matDefect">Material Defect Amount (kg)</label>
                                    <input type="number" step=0.001 name="matDefect" id="input-matDefect" class="form-control form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" value="0" required>
                                    @include('alerts.feedback', ['field' => 'product_id'])
                                </div>
                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-price">Price</label>
                                    <input type="number" name="price" id="input-price" class="form-control form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" value="0" required>
                                    @include('alerts.feedback', ['field' => 'product_id'])
                                </div>
                                <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-date">Date</label>
                                    <input type="date" name="DateAdded" id="input-date" class="form-control form-control-alternative{{ $errors->has('product_id') ? ' is-invalid' : '' }}" value="0" required>
                                    @include('alerts.feedback', ['field' => 'product_id'])
                                </div>

                                <button type="submit" class="btn btn-success mt-4">Continue</button>
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