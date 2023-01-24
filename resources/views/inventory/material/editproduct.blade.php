@extends('layouts.app', ['page' => 'Add Material to Pot', 'pageSlug' => 'materialuse', 'section' => 'material'])

@section('content')
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Edit Material</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('materialused.show', $materialused) }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('materialused.material.update', ['materialused' => $materialused, 'usedmaterial' => $usedmaterial]) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <div class="pl-lg-4">
                                <input type="hidden" name="material_u_id" value="{{ $materialused->id }}">
                                <div class="form-group{{ $errors->has('mat_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-product">Material</label>
                                    <select name="mat_id" id="input-product" class="form-select form-control-alternative{{ $errors->has('mat_id') ? ' is-invalid' : '' }}" required>
                                        @foreach ($materials as $material)
                                            @if($material['id'] == old('mat_id') or $material['id'] == $usedmaterial->mat_id )
                                                <option value="{{$material['id']}}" selected> {{ $material->material }}</option>
                                            @else
                                                <option value="{{$material['id']}}"> {{ $material->material }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'mat_id'])
                                </div>

                                <div class="form-group{{ $errors->has('mat_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-qty">Quantity</label>
                                    <input type="number" step=0.001 name="qty" id="input-qty" class="form-control form-control-alternative{{ $errors->has('mat_id') ? ' is-invalid' : '' }}" value="{{ old('qty', $usedmaterial->qty) }}" required>
                                    @include('alerts.feedback', ['field' => 'mat_id'])
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Continue</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('js')
    <script>
        new SlimSelect({
            select: '.form-select'
        });
    </script>
@endpush