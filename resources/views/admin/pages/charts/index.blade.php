@extends('admin.layout.layout')

@section('title', 'Gráficos')

@section('content')
	
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-header__title">Ingresos por ventas, mes y año</h3>

					<div>
						<form>
							<div class="form-group mb-0">
								<select class="form-control form-control-sm col-sm-1" name="year" id="year">
									@foreach($years as $year)
										<option value="{{ $year }}">{{ $year }}</option>
									@endforeach
								</select>
							</div>
						</form>
					</div>
				</div>

				<div class="box-body">
					<div class="revenue">
						<canvas id="revenue" width="800" height="250"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-header">
					<h3 class="box-header__title">Cantidad de Pedidos Entregados por Delivery</h3>
				</div>

				<div class="box-body">
					<canvas id="delivery" width="800" height="400"></canvas>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="box">
				<div class="box-header">
					<h3 class="box-header__title">Cantidad de productos vendidos por categoría</h3>
				</div>

				<div class="box-body">
					<canvas id="category" width="800" height="400"></canvas>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-header__title">Clientes con al Menos una compra realizada</h3>
				</div>

				<div class="box-body">
					<canvas id="customer" width="800" height="250"></canvas>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-header__title">Cantidad de Productos Vendidos</h3>
				</div>

				<div class="box-body">
					<canvas id="product" width="800" height="250"></canvas>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-header">
					<h3 class="box-header__title">Cantidad de Pedidos por Canales</h3>
				</div>

				<div class="box-body">
					<canvas id="channel" width="800" height="450"></canvas>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="box">
				<div class="box-header">
					<h3 class="box-header__title">Cantidad de Pedidos por Estatus</h3>
				</div>

				<div class="box-body">
					<canvas id="estatus" width="800" height="450"></canvas>
				</div>
			</div>
		</div>
	</div>

@endsection



@section('css')

	<style type="text/css">
		.box { background: white; padding: 10px 20px; border-radius: 3%; box-shadow: black 0px 3px 10px -5px; margin-bottom: 25px; }
		.box-header { padding: 15px 0; }
		.box-header__title { font-size: 17px; font-weight: bold; text-transform: uppercase; }
	</style>

@endsection


@section('script')

	<script src="{{ asset('plugins/chart.js/Chart.bundle.min.js') }}"></script>

	<script>
		{{-- Ingresos por Venta --}}
		var revenue = function (revenue) {
			if(revenue != null)
			{
				new Chart(document.getElementById("revenue"), {
					type: 'line',
					data: {
						labels: revenue.labels,
						datasets: [{
							label: "Ingresos",
							backgroundColor: ['#00695C', '#00BFA5', '#0277BD', '#D84315', '#4E342E', '#FF8F00', '#0091EA', '#d50000', '#FFD600', '#4DD0E1', '#FF5722', '#607D8B'],
							data: revenue.values,
							fill: false
						}]
					},
					options: {
						legend: { display: false },
						title: {
							display: true,
							text: 'Ingresos'
						}
					}
				});
			}

			else
				alert('No existen datos para el año consultado.');
		}

		{{-- Ingresos por Venta --}}
		var revenue_data = @json($revenue);
		revenue(revenue_data);


		{{-- Cantidad de Pedidos Entregados por Delivery --}}
		var delivery = @json($delivery);

		new Chart(document.getElementById("delivery"), {
			type: 'pie',
			data: {
				labels: delivery.labels,
				datasets: [{
					backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
					data: delivery.values
				}]
			},
			options: {
				title: {
					display: true,
					text: 'Deliveries'
				}
			}
		});


		{{-- Clientes con al Menos una Compra Realizada --}}
		var customer = @json($customer);

		new Chart(document.getElementById("customer"), {
			type: 'line',
			data: {
				labels: customer.labels,
				datasets: [{
					label: 'Compras',
					borderColor: "#3cba9f",
					data: customer.values,
					fill: false
				}]
			},
			options: {
				legend: { display: false },
				title: {
					display: true,
					text: 'Clientes'
				},
				scales: {
					yAxes: [{
						ticks: {
							min: 1,
							stepSize: 1
						}
					}]
				}
			}
		});


		{{-- Cantidad de Productos Vendidos --}}
		var product = @json($product);

		new Chart(document.getElementById("product"), {
			type: 'bar',
			data: {
				labels: product.labels,
				datasets: [{
					label: 'Productos',
					backgroundColor: ['#00695C', '#00BFA5', '#0277BD', '#D84315', '#4E342E', '#FF8F00', '#0091EA', '#d50000', '#FFD600', '#4DD0E1', '#FF5722', '#607D8B'],
					data: product.values
				}]
			},
			options: {
				legend: { display: false },
				title: {
					display: true,
					text: 'Productos'
				},
				scales: {
					yAxes: [{
						ticks: {
							min: 1,
							stepSize: 1
						}
					}],
					xAxes: [{
						barThickness: 45,  // indica el ancho de las barras en px
                		maxBarThickness: 60 // indica el max. del ancho de las barras en px
				  	}]
				}
			}
		});


		{{-- Cantidad de Productos Vendidos por Categoría --}}
		var category = @json($category);

		new Chart(document.getElementById("category"), {
			type: 'doughnut',
			data: {
				labels: category.labels,
				datasets: [{
					label: "Categoría",
					backgroundColor: ['#4E342E', '#FF8F00', '#0091EA', '#d50000', '#FFD600', '#4DD0E1', '#FF5722', '#607D8B'],
					data: category.values
				}]
			},
			options: {
				title: {
					display: true,
					text: 'Categorías'
				}
			}
		});


		{{-- Cantidad de Pedidos por Canales --}}
		var channel = @json($channel);

		new Chart(document.getElementById("channel"), {
			type: 'doughnut',
			data: {
				labels: channel.labels,
				datasets: [{
					label: "Canal",
					backgroundColor: ['#3e95cd', '#8e5ea2','#3cba9f'],
					data: channel.values
				}]
			},
			options: {
				title: {
					display: true,
					text: 'Canales'
				}
			}
		});


		{{-- Cantidad de Pedidos por Eestatus --}}
		var estatus = @json($estatus);

		new Chart(document.getElementById("estatus"), {
			type: 'pie',
			data: {
				labels: estatus.labels,
				datasets: [{
					backgroundColor: ['#4DD0E1', '#FF5722', '#607D8B', "#3cba9f", "#e8c3b9"],
					data: estatus.values
				}]
			},
			options: {
				title: {
					display: true,
					text: 'Estatus'
				}
			}
		});


		{{-- Consulta via Ajax --}}
		$('#year').change(function () {

			// petición AJAX
			$.ajax({
	        	type: 'POST',
	        	headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
	        	url: '{{ route('ingresos') }}',
	        	data: { 'year': $('#year option:selected').val() },
	        	success: function (response) {

		        	// removiendo el lienzo para generar un nuevo gráfico
			        $("canvas#revenue").remove();
					$("div.revenue").append('<canvas id="revenue" width="800" height="250"></canvas>');

					{{-- Ingresos por Venta --}}
					revenue(response.data);
	            }
	        }) // fin de la petición AJAX
		});

	</script>

@endsection