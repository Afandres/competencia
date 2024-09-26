@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Ganancias Mensuales</h2>
    <canvas id="earningsChart"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('earningsChart').getContext('2d');
    const earnings = @json($earnings);

    // Crear un array con los nombres de los meses
    const monthNames = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    // Convertir los números de mes a nombres de mes
    const labels = earnings.map(e => monthNames[e.month - 1]);
    const data = earnings.map(e => e.total);

    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Ganancias',
                data: data,
                borderColor: 'rgba(75, 192, 192, 1)', // Color de la línea
                borderWidth: 2, // Grosor de la línea
                
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
