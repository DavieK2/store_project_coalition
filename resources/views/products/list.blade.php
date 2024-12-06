@foreach ($products as $index => $product)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $product->product_name }}</td>
        <td>{{ $product->qty }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->created_at }}</td>
        <td>{{ $product->qty *  $product->price }}</td>
    </tr>
@endforeach