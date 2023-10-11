<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<link rel="stylesheet" href="estilo.css">
    <title>Document</title>
</head>
<body>
<figure class="highcharts-figure">
    <div id="container"></div>
   
</figure>
</body>
</html>
<script>
    Highcharts.chart('container', {

title: {
    text: 'Empresa XYZ',
    align: 'center'
},

subtitle: {
    text: 'Total de ventas anuales de los ultimos 10 años',
    align: 'center'
},

yAxis: {
    title: {
        text: 'Ventas en $'
    }
},

xAxis: {
    accessibility: {
        rangeDescription: 'Desde 2013 al 2022'
    }
},

legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle'
},

plotOptions: {
    series: {
        label: {
            connectorAllowed: false
        },
        pointStart: 2013
    }
},

series: [{
    name: 'Ventas anuales',
    data: [

        <?php
        include_once 'conexion.php';
        $consulta = "SELECT sum(venta) as venta, year(fecha) as año 
        FROM detalle_factura 
        INNER JOIN encabezado_factura ON detalle_factura.codigo = encabezado_factura.codigo 
        GROUP BY year(fecha)
        ORDER BY año ASC";
        $ejecutar = mysqli_query($pdo,$consulta);
        while ($data=mysqli_fetch_array($ejecutar)) {
            $ventastotales = number_format($data[0],2,'.','');
            echo $ventastotales.",";
        }
        
        ?>

    ]
}],

responsive: {
    rules: [{
        condition: {
            maxWidth: 500
        },
        chartOptions: {
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
            }
        }
    }]
}

});

</script>