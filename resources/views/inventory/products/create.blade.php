@extends('layouts.app', ['page' => 'New Product', 'pageSlug' => 'products', 'section' => 'inventory'])
<!--products add data-->
@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">New Product</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('products.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Product Information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Name</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>

                                <div class="form-group{{ $errors->has('product_category_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Category</label>
                                    <select name="product_category_id" id="input-category" class="form-select form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required>
                                        @foreach ($categories as $category)
                                            @if($category['id'] == old('document'))
                                                <option value="{{$category['id']}}" selected>{{$category['name']}}</option>
                                            @else
                                                <option value="{{$category['id']}}">{{$category['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'product_category_id'])
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <label class="form-control-label" for="input-length">Length</label>
                                        <input type="number" name="length" id="input-length" class="form-control form-control-alternative" placeholder="Length" value="{{ old('length') }}" required>
                                        @include('alerts.feedback', ['field' => 'length'])
                                    </div>
                                    <div class="col-3">
                                        <label class="form-control-label" for="input-width">Width</label>
                                        <input type="number" name="width" id="input-width" class="form-control form-control-alternative" placeholder="Width" value="{{ old('width') }}" required>
                                        @include('alerts.feedback', ['field' => 'width'])
                                    </div>
                                    <div class="col-3">
                                        <label class="form-control-label" for="input-thick">Thickness</label>
                                        <input type="number" name="thickness" id="input-thick" class="form-control form-control-alternative" placeholder="Thickness" value="{{ old('thickness') }}" required>
                                        @include('alerts.feedback', ['field' => 'thickness'])
                                    </div>
                                    <div class="col-3">
                                        <label class="form-control-label" for="input-weight">Weight</label>
                                        <input type="number" name="weight" id="input-weight" class="form-control form-control-alternative" placeholder="Weight" value="{{ old('weight') }}" required>
                                        @include('alerts.feedback', ['field' => 'weight'])
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">                                    
                                        <div class="form-group{{ $errors->has('stock') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-stock">Stock</label>
                                            <input type="number" name="stock" id="input-stock" class="form-control form-control-alternative" placeholder="Stock" value="{{ old('stock') }}" required>
                                            @include('alerts.feedback', ['field' => 'stock'])
                                        </div>
                                    </div>                            
                                    <div class="col-4">                                    
                                        <div class="form-group{{ $errors->has('color') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-color">Color</label>
                                            <input type="text" name="color" id="input-color" class="form-control form-control-alternative" placeholder="Color" value="{{ old('color') }}" required>
                                            @include('alerts.feedback', ['field' => 'color'])
                                        </div>
                                    </div>
                                    <div class="col-4">                                    
                                        <div class="form-group{{ $errors->has('quality') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-quality">Quality</label>
                                            <select type="number" name="quality" id="input-quality" class="form-control form-control-alternative" placeholder="Quality" value="{{ old('quality') }}" required>
                                                <option value="Good">Good</option>
                                                <option value="Normal">Normal</option>
                                                <option value="Bad">Bad</option>
                                            </select>
                                            @include('alerts.feedback', ['field' => 'quality'])
                                        </div>
                                    </div>                         
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