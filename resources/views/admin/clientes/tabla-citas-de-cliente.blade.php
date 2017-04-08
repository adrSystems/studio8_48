@foreach($cliente->citas as $cita)
<tr class="@if($cita->estado == 1){{'confirmada'}}@elseif($cita->estado == 2){{'en-curso'}}@elseif($cita->estado == 4){{'finalizada'}}@elseif($cita->estado == 5){{'cancelada'}}@endif" id="cita{{$cita->id}}">
  <td style="padding-left:5px">{{date('d/m/Y',strtotime($cita->fecha_hora))}}</td>
  <td>{{date('g:i a',strtotime($cita->fecha_hora))}}</td>
  <td>{{$estados[$cita->estado]}}</td>
  <td class="hidden-xs">${{$cita->monto}}</td>
  @if($cita->estado == 5)
    <td class="hidden-xs" id="table-cita-pagada">-</td>
  @else
    @if($cita->pagada)
    <td class="hidden-xs" id="table-cita-pagada">Si</td>
    @else
    <td class="hidden-xs" id="table-cita-pagada">No</td>
    @endif
  @endif
  <td style="padding-right:5px"><div class="mybtn btn-xs success-btn details-toggle" style="width:100%" id="{{$cita->id}}">Detalles</div></td>
</tr>
@endforeach
