@extends('layouts.app', ['page' => 'List of Products', 'pageSlug' => 'productsadd', 'section' => 'inventory'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Products</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('productsadd.create') }}" class="btn btn-sm btn-primary">New product</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">Product</th>
                                <th scope="col">Length</th>
                                <th scope="col">Width</th>
                                <th scope="col">Thickness</th>
                                <th scope="col">Weight</th>
                                <th scope="col">Density</th>
                                <th scope="col">Stock Added</th>
                                <th scope="col">Color</th>
                                <th scope="col">Quality</th>
                                <th scope="col">Created At</th>
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->length }}</td>
                                        <td>{{ $product->width }}</td>
                                        <td>{{ $product->thickness }}</td>
                                        <td>{{ $product->weight }}</td>
                                        <td>{{ $product->density }}</td>
                                        <td>{{ $product->qty }}</td> 
                                        <td>{{ $product->color }}</td>
                                        <td>{{ $product->quality }}</td>
                                        <td>{{ $product->created_at }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('products.show', $product) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="More Details" disabled>
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                            <form action="{{ route('productsadd.destroy', $product->Kode) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete Product" onclick="confirm('Are you sure you want to remove this product? The records that contain it will continue to exist.') ? this.parentElement.submit() : ''">
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
                    <nav class="d-flex justify-content-end">
                        {{ $products->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
