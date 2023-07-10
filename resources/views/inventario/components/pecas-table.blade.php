
@if ($entradas)
    @foreach ($entradas as $entrada)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$entrada['designacao']}}</td>
            <td>{{number_format($entrada['quantidade'], 2, '.')}} l</td>
            <td>{{number_format($entrada['preco'], 2, '.')}} Mts</td>
            <td>{{number_format($entrada['total'], 2, '.')}} Mts</td>
            <td>
                <a href="#" class="h5 p-l-5 txt-danger" onclick="javascript:removeFromEntradas({{ $entrada['peca_id'] }}, this.parentElement.parentElement)"> <i class="fa fa-trash-o" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"></i></a>
            </td>
        </tr>
    @endforeach
@endif
