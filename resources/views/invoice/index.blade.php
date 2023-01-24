@extends('layouts.app', ['page' => 'Create Custom Invoice', 'pageSlug' => 'custominvoice', 'section' => ''])

@section('content')
    <div class="container-fluid mt--7">
    @include('alerts.error')
    @if(session('status'))
        <div class="alert alert-danger">{{session('status')}}</div>
    @endif
    <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Custom Invoice</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <form method="post" action="{{ route('invoice.getinvoice') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Invoice information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('sale_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-product">Order Id</label>
                                    <select name="sale_id" id="input-product" class="form-select form-control-alternative{{ $errors->has('sale') ? ' is-invalid' : '' }}" required>
                                    @foreach ($sales as $sale)
                                            @if($sale['id'] == old('id'))
                                                <option value="{{$sale['id']}}" selected>[{{ $sale->id }}] {{ $sale->user->name }} - Tanggal: {{ date('d-m-y', strtotime($sale->created_at)) }}</option>
                                            @else
                                                <option value="{{$sale['id']}}">[{{ $sale->id }}] {{ $sale->user->name }} - Tanggal: {{ date('d/M/Y', strtotime($sale->created_at)) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'sale_id'])
                                </div>
                                <div class="form-group{{ $errors->has('sale_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-ppn">PPN</label>
                                    <input type="number" name="ppn" id="input-ppn" class="form-control form-control-alternative{{ $errors->has('sale_id') ? ' is-invalid' : '' }}" value="0" required>
                                    @include('alerts.feedback', ['field' => 'sale_id'])
                                </div>
                                <div class="form-group{{ $errors->has('sale_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-discount">Discount</label>
                                    <input type="number" name="discount" id="input-discount" class="form-control form-control-alternative{{ $errors->has('sale_id') ? ' is-invalid' : '' }}" value="0" required>
                                    @include('alerts.feedback', ['field' => 'sale_id'])
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