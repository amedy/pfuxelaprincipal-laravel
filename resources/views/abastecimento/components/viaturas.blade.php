<option value="">Escolha uma opcção</option>
@if ($viaturas)
    @foreach ($viaturas as $viatura)
        <option value="{{$viatura->id}}" {{(old('viatura') == $viatura->id) ? 'selected' : ''}}>{{$viatura->matricula}}</option>
    @endforeach
@endif
