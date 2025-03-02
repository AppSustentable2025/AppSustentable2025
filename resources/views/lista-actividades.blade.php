@extends('layouts.app')
@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Lista de actividades</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item">Lista de actividades</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h5 class="card-title">Actividades creadas</h5>
            </div>
            <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('actividades.create') }}" class="btn btn-primary btn-sm px-4">Nuevo</a>


            </div>
            <!-- Table with stripped rows -->
            <table class="table datatable">
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
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main>
<!-- End #main -->
@endsection