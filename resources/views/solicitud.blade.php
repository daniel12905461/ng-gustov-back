<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        .table-cell {
            border: 1px solid black;
            text-align: center;
            border-collapse: collapse;
        }
        /* .vertical-text {
            writing-mode: vertical-lr;
            transform: rotate(180deg);
        } */
        .tabla-hidden {
            visibility: hidden;
            /* height: auto; */
        }
        .tabla-visible {
            visibility: visible !important;
        }
    </style>
</head>
<body style="font-size: 15px !important;">
    <table style="width: 100%; text-align: center;">
        <tr>
            <td>
                <h2>Restaurante Gustov</h2>
            </td>
            <th>
                <b>Recibo de vacaciones</b> <br>
            </th>
            <th style="display: flex; justify-content: center;">
                <img src="images/logo.png" alt="" style="width: 40px;;"/>
            </th>
        </tr>
    </table>
    <br/>
    <table style="width: 100%;">
        <tr>
            <td>
                Empleado: <b>{{$solicitud->vacacion->empleado->nombres}} {{$solicitud->vacacion->empleado->apellidos}}</b>
            </td>
            <td>
                Fecha de Inicio: <b>{{$solicitud->vacacion->empleado->fecha_inicio}}</b>
            </td>
        </tr>
        <tr>
            <td>
                Año: <b>2023</b>
            </td>
            <td>
                Dias Restantes de Vacación: <b>{{$solicitud->vacacion->dias_restantes}}</b>
            </td>
        </tr>
    </table>
    <br>
    <table style="width: 100%; align-content: center;">
        <tr>
            <th>
                Dias de Vacaciones:    
            </th>
        </tr>
    </table>
    <table border="1" align="center" cellspacing="0" cellspacing="0" style="width:50%; text-align:center;">
        <tr>
            <th class="table-cell">N°</th>
            <th class="table-cell">Día</th>
            <th class="table-cell">Fecha</th>
        </tr>
        @foreach ($solicitud->dias as $key => $dia)
        <tr>
            <td class="table-cell" style="width: 20px;">{{ $key + 1 }}</td>
            <td class="table-cell">{{$dia->nombre}}</td>
            <td class="table-cell">{{$dia->fecha}}</td>
        </tr>
        @endforeach
        
    </table>
</body>
</html>
