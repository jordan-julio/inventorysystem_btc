@extends('layouts.app', ['page' => 'Create Custom Invoice', 'pageSlug' => 'custominvoice'])

@section('content')
    <div class="container-fluid mt--7">
    @include('alerts.error')
    <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Custom Invoice</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('invoice.index') }}" class="btn btn-sm btn-primary">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <form method="post" action="{{ route('invoice.getinvoice') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Invoice Information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('sale_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-product">Order Id</label>
                                    <select name="sale_id" id="input-product" class="form-select form-control-alternative{{ $errors->has('sale') ? ' is-invalid' : '' }}" disabled>
                                        <option value="{{$sale['id']}}" selected>[{{ $sale->id }}] {{ $sale->user->name }} - Tanggal: {{ date('d-m-y', strtotime($sale->created_at)) }}</option>
                                    </select>
                                    @include('alerts.feedback', ['field' => 'sale_id'])
                                </div>
                                @if($discount != 0)
                                    <div class="form-group{{ $errors->has('sale_id') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-initialTotal">Harga Tanpa Discount, Tanpa PPN</label>
                                        <input type="String" name="initialTotal" id="input-initialTotal" class="form-control form-control-alternative{{ $errors->has('sale_id') ? ' is-invalid' : '' }}" value="{{ $initialTotal }}" required>
                                        @include('alerts.feedback', ['field' => 'sale_id'])
                                    </div>
                                    <div class="form-group{{ $errors->has('sale_id') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-totalDiscount">Total Discount ({{ $discount }} %)</label>
                                            <input type="String" name="totalDiscount" id="input-totalDiscount" class="form-control form-control-alternative{{ $errors->has('sale_id') ? ' is-invalid' : '' }}" value="{{ $discountamount }}" required>
                                            @include('alerts.feedback', ['field' => 'sale_id'])
                                        </div>
                                    <div class="form-group{{ $errors->has('sale_id') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-totalAmount">Harga Sama Discount, Tanpa PPN</label>
                                        <input type="String" name="totalAmount" id="input-totalAmount" class="form-control form-control-alternative{{ $errors->has('sale_id') ? ' is-invalid' : '' }}" value="{{ $totalAmount }}" required>
                                        @include('alerts.feedback', ['field' => 'sale_id'])
                                    </div>
                                @else
                                    <div class="form-group{{ $errors->has('sale_id') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-totalAmount">Harga Tanpa PPN</label>
                                        <input type="String" name="totalAmount" id="input-totalAmount" class="form-control form-control-alternative{{ $errors->has('sale_id') ? ' is-invalid' : '' }}" value="{{ $totalAmount }}" required>
                                        @include('alerts.feedback', ['field' => 'sale_id'])
                                    </div>
                                @endif
                                <div class="form-group{{ $errors->has('sale_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-ppn">{{ $ppn }}% PPN</label>
                                    <input type="String" name="ppn" id="input-ppn" class="form-control form-control-alternative{{ $errors->has('sale_id') ? ' is-invalid' : '' }}" value="{{ $ppnAmount }}" required>
                                    @include('alerts.feedback', ['field' => 'sale_id'])
                                </div>
                                @if($discount != 0)
                                    <div class="form-group{{ $errors->has('sale_id') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-finalRes">Total Sama PPN Dan Discount</label>
                                        <input type="String" name="finalRes" id="input-finalRes" class="form-control form-control-alternative{{ $errors->has('sale_id') ? ' is-invalid' : '' }}" value="{{ $finalRes }}" required>
                                        @include('alerts.feedback', ['field' => 'sale_id'])
                                    </div>
                                @else
                                    <div class="form-group{{ $errors->has('sale_id') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-finalRes">Total Sama PPN</label>
                                        <input type="String" name="finalRes" id="input-finalRes" class="form-control form-control-alternative{{ $errors->has('sale_id') ? ' is-invalid' : '' }}" value="{{ $finalRes }}" required>
                                        @include('alerts.feedback', ['field' => 'sale_id'])
                                    </div>
                                @endif
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