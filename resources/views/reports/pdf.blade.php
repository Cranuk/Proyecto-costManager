<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte del mes - CostManager</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            text-align: center;
        }

        th {
            font-size: 1rem;
            color: #e6e6e9;
        }

        th,
        td {
            padding: 5px;
        }

        thead tr {
            background-color: #282C34;
            text-align: center;
        }

        tbody tr:nth-child(even) {
            background-color: #c8c9cd;
        }

        tbody tr:nth-child(odd) {
            background-color: #e3e3e6;
        }

        .page-break {
            page-break-after: always;
        }

    </style>
</head>
<body>
    <h2>{{ $title }} @spanishDate( $record->details['mes'] )</h2>

    <h3>Ingresos</h3>
    <table>
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Descripcion</th>
                <th>Fecha</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($revenues as $revenue)
            <tr>
                <td>
                    @nameCategory($revenue->category_id)
                </td>
                <td>{{ $revenue->description }}</td>
                <td>
                    <!--NOTE: se pone la fecha que se creo dado que ahora se muestra los gastos solo del mes actual-->
                    @formatDate($revenue->created_at)
                    <!--NOTE: creamos una directiva de blade para la funcion helper para formato de fecha -->
                </td>
                <td>
                    @formatCurrency($revenue->amount)
                    <!--NOTE: creamos directiva blade para la funcion helper para formato de moneda -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <h3>Gastos</h3>
    <table>
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Descripcion</th>
                <th>Fecha</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
            <tr>
                <td>
                    @nameCategory($expense->category_id)
                </td>
                <td>{{ $expense->description }}</td>
                <td>
                    <!--NOTE: se pone la fecha que se creo dado que ahora se muestra los gastos solo del mes actual-->
                    @formatDate($expense->created_at)
                    <!--NOTE: creamos una directiva de blade para la funcion helper para formato de fecha -->
                </td>
                <td>
                    @formatCurrency($expense->amount)
                    <!--NOTE: creamos directiva blade para la funcion helper para formato de moneda -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <h3>Resumen</h3>
    <p>
        Total Ingresos: <strong>@formatCurrency($totalRevenues)</strong>
        Total Egresos: <strong>@formatCurrency($totalExpenses)</strong>
        Balance: <strong>@formatCurrency($balance)</strong>
    </p>
    <div class="page-break"></div>
</body>
</html>
