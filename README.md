## Laravel Inventory

# Fix material use search FRONT FINISH

<h3>Data Pegawai</h3>
 
 
	<p>Cari Data Pegawai :</p>
	<form action="/invetorymanagement/laravel-inventory/public/inventory/materials/cari" method="GET">
		<input type="date" name="cari" placeholder="Cari Pegawai .." value="{{ old('cari') }}">
		<input type="submit" value="CARI">
	</form>
		
	<br/>
 
	<table>
		<tr>
        <th>Number</th>
                                <th>Date Created</th>
                                <th>User</th>
                                <th>Materials</th>
                                <th>Total Stock</th>
                                <th></th>
		</tr>
		@foreach ($materials as $material)
                                    <tr>
                                        <td>{{ $material->id }}</td>
                                        <td>{{ date('d-M-y', strtotime($material->DateAdded)) }}</td>
                                        <td></td>
                                        <td>{{ $material->usedmaterial->count() }}</td>
                                        <td>{{ $material->usedmaterial->sum('qty') }}</td>
                                        <td class="td-actions text-right">
                                            <a href="{{ route('materialused.show', ['materialused' => $material]) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit Sale">
                                                <i class="tim-icons icon-pencil"></i>
                                            </a>
                                            <form action="{{ route('materialused.destroy', $material) }}" method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete Sale" onclick="confirm('Are you sure you want to delete this sale? All your records will be permanently deleted.') ? this.parentElement.submit() : ''">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
	</table>
 
	<br/>
	Halaman : {{ $materials->currentPage() }} <br/>
	Jumlah Data : {{ $materials->total() }} <br/>
	Data Per Halaman : {{ $materials->perPage() }} <br/>
 
 
	{{ $materials->links() }}
@endsection