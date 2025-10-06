<!-- Tampilkan error validasi -->
@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div>
        <strong>Nama:</strong>
        <input type="text" name="name" placeholder="Nama Produk">
    </div>
    <div>
        <strong>Harga:</strong>
        <input type="number" name="price" placeholder="Harga">
    </div>
    <button type="submit">Simpan</button>
</form>