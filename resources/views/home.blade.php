@extends('layouts.app')

@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Pantalla principal</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div>

  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
      <div class="row">
        <!-- Recent Sales -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Hoy</a></li>
                <li><a class="dropdown-item" href="#">Este mes</a></li>
                <li><a class="dropdown-item" href="#">Este año</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Lista Actividades <span>| Hoy</span></h5>

              <!-- Tabla con la clase 'datatable' para habilitar DataTables -->
              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Periodo</th>
                    <th scope="col">Horario</th>
                    <th scope="col">Nombre de Actividades</th>
                    <th scope="col">Estado</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row"><a href="#">1</a></th>
                    <td>ENE-ABR 2025</td>
                    <td>Mar 14.00-16.00</td>
                    <td><a href="#" class="text-primary">Act Clase 1 Edificios</a></td>
                    <td><span class="badge bg-success">Completo</span></td>
                  </tr>
                  <tr>
                    <th scope="row"><a href="#">2</a></th>
                    <td>ENE-ABR 2025</td>
                    <td>Mier 14.00-16.00</td>                    
                    <td><a href="#" class="text-primary">Act clase 3 Canchas</a></td>
                    <td><span class="badge bg-warning">Pendiente</span></td>
                  </tr>
                  <tr>
                    <th scope="row"><a href="#">3</a></th>
                    <td>ENE-ABR 2025</td>
                    <td>Mar 14.00-16.00</td>
                    <td><a href="#" class="text-primary">Act clase 1 Botes maya</a></td>
                    <td><span class="badge bg-success">Completo</span></td>
                  </tr>                  
                </tbody>
              </table>
            </div>
          </div>
        </div><!-- End Recent Sales -->
      </div>
    </div>
  </div>

</main>

@endsection

<!-- Incluir los scripts necesarios para DataTables -->
@section('scripts')
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  
  <!-- jQuery (necesario para DataTables) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function() {
      // Inicializar DataTable en la tabla con la clase 'datatable'
      $('.datatable').DataTable({
        "searching": true,  // Habilitar búsqueda
        "columnDefs": [
          {
            "targets": [3],  // Especificamos que la columna "Nombre Act" (índice 3) será la que se buscará
            "searchable": true  // Habilitar búsqueda solo para esta columna
          }
        ]
      });
    });
  </script>
@endsection
