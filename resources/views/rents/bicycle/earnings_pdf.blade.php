<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Ganancias Mensuales</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h2, h3 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .logo {
            display: block;
            margin: 0 auto; /* Centrar el logo */
            max-width: 150px; /* Ajusta el tamaño del logo según sea necesario */
            height: auto; /* Mantiene la relación de aspecto */
        }
    </style>
</head>
<body>
    <!-- Logo -->
    <center>
        <img src="{{ public_path('img/logosena.png') }}" alt="Logo" class="logo">
    </center>
    

    <h2>Reporte de Ganancias Mensuales</h2>

    <!-- Tabla Resumen de Ganancias Mensuales -->
    <table>
        <thead>
            <tr>
                <th>Mes</th>
                <th>Ganancias Totales (COP)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($earnings as $earning)
                <tr>
                    <td>{{ \Carbon\Carbon::create()->month($earning->month)->locale('es')->monthName }}</td>
                    <td>{{ number_format($earning->total, 2) }} COP</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Detalle por cada mes -->
    @foreach($rentalsByMonth as $month => $rentals)
        <h3>{{ $month }}</h3>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Bicicleta</th>
                    <th>Precio (COP)</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rentals as $rental)
                    <tr>
                        <td>{{ $rental->date }}</td>
                        <td>{{ $rental->person->name }}</td>
                        <td>{{ $rental->bicycle->brand }}</td>
                        <td>{{ number_format($rental->price, 2) }}</td>
                        <td>{{ $rental->state }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>
