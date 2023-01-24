@extends('layouts.app', ['page' => 'Add Material to Pot', 'pageSlug' => 'materialuse', 'section' => 'material'])

@section('content')
    <div class="container-fluid mt--7">
    @include('alerts.error')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Register Pot</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('materialused.index') }}" class="btn btn-sm btn-primary">Back to list</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('materialused.store') }}" autocomplete="off">
                            @csrf
                                <div class="form-group{{ $errors->has('DateAdded') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-DateAdded">Date Added*</label>
                                    <input type="date" name="DateAdded" id="input-DateAdded" class="form-control form-control-alternative{{ $errors->has('DateAdded') ? ' is-invalid' : '' }}" value="-">
                                    @include('alerts.feedback', ['field' => 'DateAdded'])
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-control-label" for="input-PotNo">Pot Number</label>
                                        <input type="number" name="PotNo" id="input-PotNo" class="form-control form-control-alternative" placeholder="Pot No." value="{{ old('PotNo') }}" required>
                                        @include('alerts.feedback', ['field' => 'PotNo'])
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group{{ $errors->has('product_name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-productname">Product</label>
                                            <select name="product_name" id="input-productname" class="form-select form-control-alternative{{ $errors->has('product_name') ? ' is-invalid' : '' }}" required>
                                                @foreach ($products as $product)
                                                    @if($product['id'] == old('product_id'))
                                                        <option value="{{$product['name']}}" selected>[{{ $product->category->name }}] {{ $product->name }}</option>
                                                    @else
                                                        <option value="{{$product['name']}}">[{{ $product->category->name }}] {{ $product->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @include('alerts.feedback', ['field' => 'product_id'])
                                        </div>
                                    </div>
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