@if ($trabalhos)
    @foreach ($trabalhos as $key => $trabalho)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$trabalho['descricao']}}</td>
            <td>{{$trabalho['tecnico_1']}}</td>
            <td>{{date('d-m-Y, H:i', strtotime($trabalho['data_hora_inicio_1']))}}</td>
            <td>{{date('d-m-Y, H:i', strtotime($trabalho['data_hora_fim_1']))}}</td>
            <td>{{($trabalho['tecnico_2']) ? $trabalho['tecnico_2'] : '-'}}</td>
            <td>{{($trabalho['data_hora_inicio_2']) ? date('d-m-Y, H:i', strtotime($trabalho['data_hora_inicio_2'])) : '-'}}</td>
            <td>{{($trabalho['data_hora_fim_2']) ? date('d-m-Y, H:i', strtotime($trabalho['data_hora_fim_2'])) : '-'}}</td>
            <td>
                <a href="#" class="h5 p-l-5 txt-danger" onclick="javascript:removeFromJobs({{ $key }}, this.parentElement.parentElement)"> <i class="fa fa-trash-o" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"></i></a>
            </td>
        </tr>
    @endforeach
@endif
