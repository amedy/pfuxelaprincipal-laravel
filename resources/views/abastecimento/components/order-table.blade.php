
@if ($ordens)
    @foreach ($ordens as $ordem)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$ordem['viatura']}}</td>
            <td>{{$ordem['distancia_calculada']}} km</td>
            <td>{{number_format($ordem['quantidade'], 2, '.')}} l</td>
            <td>{{number_format($ordem['preco_combustivel'], 2, '.')}} Mts</td>
            <td>
                @if ($ordem['rotas'])
                    @foreach ($ordem['rotas'] as $rota)
                    <span class="badge badge-success"> {{ $rota }} </span>
                    @endforeach
                @endif
            </td>
            <td>{{number_format($ordem['total'], 2, '.')}} Mts</td>
            <td>
                <a href="#" class="h5 p-l-5 txt-danger" onclick="javascript:removeFromOrdens({{ $ordem['viatura_id'] }}, this.parentElement.parentElement)"> <i class="fa fa-trash-o" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"></i></a>
            </td>
        </tr>
    @endforeach
@endif
