@extends('layouts.app', ['page' => 'Materials Purchased', 'pageSlug' => 'homematerials', 'section' => 'material'])
<!--products add data-->
@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">New Material</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('inventory.material.home') }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('inventory.material.storenew') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Material Information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-matName">Material Name</label>
                                    <input type="text" name="material" id="input-matName" class="form-control form-control-alternative{{ $errors->has('matName') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('matName') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'matName'])
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-control-label" for="input-matAmount">Material Amount/Jumlah (Kg)</label>
                                        <input type="number" step=0.001 name="TotalmatAmount" id="input-matAmount" class="form-control form-control-alternative" placeholder="Amount" value="{{ old('matAmount') }}" required>
                                        @include('alerts.feedback', ['field' => 'matAmount'])
                                    </div>
                                    <div class="col-6">
                                        <label class="form-control-label" for="input-matDefect">Material Defect (Kg)</label>
                                        <input type="number" name="TotalmatDefect" id="input-matDefect" class="form-control form-control-alternative" placeholder="Defect" value="{{ old('matDefect') }}" required>
                                        @include('alerts.feedback', ['field' => 'matDefect'])
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