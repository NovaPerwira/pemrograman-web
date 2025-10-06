<form action="{{ route('products.update',$product->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <strong>Nama:</strong>
        <input type="text" name="name" value="{{ $product->name }}">
    </div>
    <div>
        <strong>Harga:</strong>
        <input type="number" name="price" value="{{ $product->price }}">
    </div>
    <button type="submit">Update</button>
</form>