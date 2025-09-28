@extends('layouts.web')

@section('title', 'Historial')

@section('content-record')

@if( $count > 0)
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>Mes del reporte</th>
                <th>Detalle</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach($table as $record)
            <tr>
                <td>
                    @spanishDate( $record->details['mes'] )
                </td>
                <td>
                    <ul>
                        <li>Ingresos: @formatCurrency($record->details['ingresos'])</li>
                        <li>Egresos: @formatCurrency($record->details['egresos'])</li>
                        <li>Balance: @formatCurrency($record->details['balance'])</li>
                    </ul>
                </td>
                <td>
                    <div class="tools">
                        <a href="{{ route('generatePdf', ['id'=>$record->id]) }}" title="Generar PDF" target="_blank">
                            <i class='bx bxs-file-pdf icon-medium'></i>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-box">
        {{ $table->links('pagination::bootstrap-4') }}
    </div>
</div>

@else
<div class="alert-box">
    <div class="alert alert-notice">
        <i class='bx bxs-info-square icon-head icon-medium'></i>
        Sin historial!!!
    </div>
</div>
@endif

@endsection
