@foreach ($products as $index => $product)
<tr>
    <td>{{ $index + 1 }}</td>
    <td>{{ $product->product_name }}</td>
    <td>{{ $product->qty }}</td>
    <td>{{ $product->price }}</td>
    <td>{{ $product->created_at }}</td>
    <td>{{ (intval( $product->qty )) * (floatval( $product->price )) }}</td>
    <td>
        <button onclick="edit('{{ $product->product_name }}','{{ $product->qty }}','{{ $product->price }}','{{ $product->id }}')" class="btn btn-sm btn-primary">Edit</button>
    </td>
</tr>
@endforeach