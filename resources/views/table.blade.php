@foreach($products as $product)
<tr>
    <th scope="row">{{ $loop->index + 1 }}</th>
    <td>{{$product->name ?? ''}}</td>
    <td>{{$product->details ?? ''}}</td>
    <td>
        <button class="btn btn-info" onClick="showProductEditModal('{{ $product->id }}','{{ $product->name }}','{{ $product->details }}')">
            Edit
    </button>
        <button class="btn btn-danger" onClick="productDelete('{{ $product->id }}')" >Delete</button>
    </td>
</tr>
@endforeach
