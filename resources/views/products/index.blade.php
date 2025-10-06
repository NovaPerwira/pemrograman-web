<!-- Tampilkan tabel produk di sini -->
<a href="{{ route('products.create') }}">Tambah Produk</a>

@if ($message = Session::get('success'))
    <div>{{ $message }}</div>
@endif

<table>
    <tr>
        <th>Nama</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>
    @foreach ($products as $Product)
    <tr>
        <td>{{ $product->name }}</td>
        <td>{{ $product->price }}</td>
        <td>
            <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                <a href="{{ route('products.edit',$product->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<!-- Link Paginasi -->
{{!! $products->links() !!}}
                