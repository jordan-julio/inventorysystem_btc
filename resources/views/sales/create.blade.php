@extends('layouts.app', ['page' => 'Register Sale', 'pageSlug' => 'sales-create', 'section' => 'transactions'])

@section('content')
    <div class="container-fluid mt--7">
    @include('alerts.error')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Register Sale</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('sales.index') }}" class="btn btn-sm btn-primary">Back to list</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('sales.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Customer information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('client_id') ? ' has-danger' : '' }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                    <label class="form-control-label" for="input-name">Client</label>
                                    <select name="client_id" id="input-category" class="form-select form-control-alternative{{ $errors->has('client') ? ' is-invalid' : '' }}" required>
                                        @foreach ($clients as $client)
                                            @if($client['id'] == old('client'))
                                                <option value="{{$client['id']}}" selected>{{$client['name']}} - {{$client['document_type'].$client['document_id']}}</option>
                                            @else
                                                <option value="{{$client['id']}}">{{$client['name']}} - {{$client['document_type'].$client['document_id']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'client_id'])
                                </div>
                                <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-address">Address*</label>
                                    <input type="text" name="address" id="input-address" class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" value="-">
                                    @include('alerts.feedback', ['field' => 'address'])
                                </div>
                                <div class="form-group{{ $errors->has('ponumber') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-ponumber">PO number (optional)</label>
                                    <input type="text" name="ponumber" id="input-ponumber" class="form-control form-control-alternative{{ $errors->has('ponumber') ? ' is-invalid' : '' }}" value="-">
                                    @include('alerts.feedback', ['field' => 'ponumber'])
                                </div>
                                <div class="form-group{{ $errors->has('DateCreated') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-DateCreated">Date</label>
                                    <input type="Date" name="DateCreated" id="input-DateCreated" class="form-control form-control-alternative{{ $errors->has('DateCreated') ? ' is-invalid' : '' }}">
                                    @include('alerts.feedback', ['field' => 'DateCreated'])
                                </div>
                                <div class="form-group{{ $errors->has('kurang_bool') ? ' has-danger' : '' }}">

                                    <label class="form-control-label" for="input-kurang_bool">Kurangin?</label>
                                    <select name="kurang_bool" id="input-kurang_bool" class="form-control form-control-alternative{{ $errors->has('kurang_bool') ? ' is-invalid' : '' }}" required>
                                        <option value="1" selected>Kurangin Stock Di Inventory</option>
                                        <option value="0">TIDAK Kurangin Stock Di Inventory</option>
                                    </select>
                                    @include('alerts.feedback', ['field' => 'kurang_bool'])
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