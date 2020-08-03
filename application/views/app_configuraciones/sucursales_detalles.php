<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
	<div class="col-xl-9">
      <div class="card border-light mb-4">
         <div class="card-body">
         	<table class="table table-dark table-sm">
			  <tbody>
			    <tr>
			      <th scope="row">RUC:</th>
			      <td>49504403858695</td>
			      <th scope="row">Razon Social</th>
			      <td>Chothes and more S.A.C.</td>
			    </tr>
			    <tr>
			      <th colspan="2" scope="row">Dirección Fiscal (Notificaciones):</th>
			      <td colspan="2">Jr. Acora 123 LT 23 Puno Perú</td>
			    </tr>
			    <tr>
			      <th scope="row">Nombre:</th>
			      <td>Shopday Cede Central</td>
			      <th scope="row">Categoría:</th>
			      <td>Venta en general de productos no perecibles</td>
			    </tr>
			    <tr>
			      <th scope="row">Direccion:</th>
			      <td>Jr. Acora 123 LT 23</td>
			      <th scope="row">Ubicación:</th>
			      <td>PUNO - EL COLLAO - ILAVE</td>
			    </tr>
			    <tr>
			      <th scope="row">Licencia:</th>
			      <td>0003764-MPCI</td>
			      <th scope="row">Administrador:</th>
			      <td>Flavia Caxi Alvarado</td>
			    </tr>
			    <tr>
			      <th scope="row">Teléfono:</th>
			      <td>968991714</td>
			      <th scope="row">Sitio Web:</th>
			      <td>https://es-la.facebook.com/</td>
			    </tr>
			  </tbody>
			</table>		   
         </div>
      </div>
   </div>
   <div class="col-xl-3">
      <div class="card border-success mb-4">
         <div class="card-body">
         	<ul class="list-group">
		      <li class="list-group-item d-flex justify-content-between lh-condensed">
		         <div>
		            <h6 class="my-0">Ventas</h6>
		            <small class="text-muted">22 de enero 2021 (hoy)</small>
		         </div>
		         <span class="text-muted">S/ 160.00</span>
		      </li>
		      <li class="list-group-item d-flex justify-content-between lh-condensed">
		         <div>
		            <h6 class="my-0">Compras</h6>
		            <small class="text-muted">22 de enero 2021 (hoy)</small>
		         </div>
		         <span class="text-muted">S/ 50.00</span>
		      </li>
		      <li class="list-group-item d-flex justify-content-between lh-condensed">
		         <div>
		            <h6 class="my-0">Ganancias</h6>
		            <small class="text-muted">22 de enero 2021 (hoy)</small>
		         </div>
		         <span class="text-muted">S/ 90.00</span>
		      </li>
		      <li class="list-group-item d-flex justify-content-between bg-light">
		         <div class="text-success">
		            <h6 class="my-0">Deudas Inversión</h6>
		            <small>Inicial S/15,000.00</small>
		         </div>
		         <span class="text-success">-S/15,000.00</span>
		      </li>
		   </ul>
         </div>
      </div>
   </div>
   <div class="col-xl-6">
      <div class="card bg-light mb-4">
         <div class="card-header">VENTAS SEMANALES</div>
         <div class="card-body">
            <canvas id="myAreaChart" width="100%" height="40"></canvas>
         </div>
      </div>
   </div>
   <div class="col-xl-6">
      <div class="card bg-light mb-4">
         <div class="card-header">VENTAS MENSUALES</div>
         <div class="card-body">
            <canvas id="myBarChart" width="100%" height="40"></canvas>
         </div>
      </div>
   </div>
   <div class="col-xl-12">
      <div class="card text-white bg-primary mb-4">
         <div class="card-header">GANACIAS ANTERIORES</div>
         <div class="card-body">
         	<table class="table table-sm text-white">
			  <thead>
			     <tr>
			      <th scope="col">Fecha</th>
			      <th scope="col">Compras</th>
			      <th scope="col">Ventas</th>
			      <th scope="col">Ganancias</th>
			      <th scope="col">Responsable</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <th scope="row">1</th>
			      <td>Mark</td>
			      <td>Otto</td>
			      <td>@mdo</td>
			      <td>@mdo</td>
			    </tr>
			    <tr>
			      <th scope="row">2</th>
			      <td>Jacob</td>
			      <td>Thornton</td>
			      <td>@fat</td>
			      <td>@mdo</td>
			    </tr>
			    <tr>
			      <th scope="row">3</th>
			      <td colspan="2">Larry the Bird</td>
			      <td>@twitter</td>
			      <td>@mdo</td>			      
			    </tr>
			  </tbody>
			</table>
         </div>
      </div>
   </div>
   <div class="col-xl-5">
      <div class="card text-white bg-success mb-4">
         <div class="card-header">DEPARTAMENTOS (ÁREAS) DE LA SUCURSAL</div>
         <div class="card-body">
         	<table class="table table-sm text-white">
			  <thead>
			    <tr>
			      <th scope="col">Código</th>
			      <th scope="col">Nombre</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <th scope="row">1</th>
			      <td>Mark</td>
			    </tr>
			    <tr>
			      <th scope="row">2</th>
			      <td>Jacob</td>
			    </tr>
			    <tr>
			      <th scope="row">3</th>
			      <td colspan="2">Larry the Bird</td>
			      
			    </tr>
			  </tbody>
			</table>
         </div>
      </div>
   </div>
   <div class="col-xl-7">
      <div class="card text-white bg-info mb-4">
         <div class="card-header">EMPLEADOS DE LA SUCURSAL</div>
         <div class="card-body">
         	<table class="table table-sm text-white">
			  <thead>
			    <tr>
			      <th scope="col">Código</th>
			      <th scope="col">Nombres</th>
			      <th scope="col">Apellidos</th>
			      <th scope="col">Cargo</th>
			      <th scope="col">Usuario</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <th scope="row">1</th>
			      <td>Mark</td>
			      <td>Otto</td>
			      <td>@mdo</td>
			      <td>@mdo</td>
			    </tr>
			    <tr>
			      <th scope="row">2</th>
			      <td>Jacob</td>
			      <td>Thornton</td>
			      <td>@fat</td>
			      <td>@mdo</td>
			    </tr>
			    <tr>
			      <th scope="row">3</th>
			      <td colspan="2">Larry the Bird</td>
			      <td>@twitter</td>
			      <td>@mdo</td>
			    </tr>
			  </tbody>
			</table>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var key = arixshell_read_cache_serial();
	console.log(key);
	arixshell_iniciar_llaves_locales("#btn_id_sucursales_1d","#con_id_sucursales_1d");
    arixshell_cargar_botones_menu('btn-atras, btn-editar');
    arixshell_cargar_ultimo_titulo('Una sucursal');
    $(arixshell_cargar_llave_local(0)).on("click", ".btn-atras", function() {
        arixshell_hacer_pagina_atras();
    });
    //primer cuadro
    var datos = arixshell_upload_datos('configuraciones/axconfiguraciones_cargar_datos_sucursal', 'data='+key+'&');
    

    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
	Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["January", "February", "March", "April", "May", "June"],
    datasets: [{
      label: "Revenue",
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: [4215, 5312, 6251, 7841, 9821, 14984],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 15000,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});

var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Mar 1", "Mar 2", "Mar 3", "Mar 4", "Mar 5", "Mar 6", "Mar 7", "Mar 8", "Mar 9", "Mar 10", "Mar 11", "Mar 12", "Mar 13"],
    datasets: [{
      label: "Sessions",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 50,
      pointBorderWidth: 2,
      data: [10000, 30162, 26263, 18394, 18287, 28682, 31274, 33259, 25849, 24159, 32651, 31984, 38451],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 40000,
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});

}); 
</script>