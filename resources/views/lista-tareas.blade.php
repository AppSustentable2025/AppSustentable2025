@extends('layouts.app')
@section('content')
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Crear tareas</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Lista de tareas</a></li>
        <li class="breadcrumb-item active">Crear tareas</li>
      </ol>
    </nav>
  </div>

  <div class="container">
    <div class="card card-default">
      <div class="card-body">
        <form id="addCustomer" class="form-inline">
          <div class="form-group">            
            <input id="name" type="text" class="form-control" name="name" style="margin-right: 10px;" placeholder="Nombre de la tarea" required autofocus>
          </div>
          <button id="submitCustomer" type="button" class="btn btn-primary mb-2">Guardar</button>
        </form>
      </div>
    </div>
    <table id="taskTable" class="table table-bordered display">
      <thead>
        <tr>
          <th>Nombre</th>
          <th width="180" class="text-center">Acción</th>
        </tr>
      </thead>
      <tbody id="tbody"></tbody>
    </table>
  </div>

  <!-- Modal para actualizar tarea -->
  <div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateModalLabel">Actualizar Tarea</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="task_name">Nombre de la Tarea</label>
              <input type="text" class="form-control" id="task_name">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="saveUpdate">Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Firebase Scripts --}}
  <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://www.gstatic.com/firebasejs/5.10.1/firebase.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <script>
    var config = {
      apiKey: "{{ config('services.firebase.api_key') }}",
      authDomain: "{{ config('services.firebase.auth_domain') }}",
      databaseURL: "{{ config('services.firebase.database_url') }}",
      storageBucket: "{{ config('services.firebase.storage_bucket') }}",
    };
    firebase.initializeApp(config);
    var database = firebase.database();

    var table = $('#taskTable').DataTable();

    function loadTasks() {
      firebase.database().ref('Tareas/').on('value', function(snapshot) {
        table.clear().draw();
        var value = snapshot.val();
        $.each(value, function(index, value) {
          if (value) {
            table.row.add([
              value.name,
              '<button class="btn btn-info updateData" data-id="' + index + '">Actualizar</button>' +
              ' <button class="btn btn-danger removeData" data-id="' + index + '">Eliminar</button>'
            ]).draw(false);
          }
        });
      });
    }

    loadTasks();

    $('#submitCustomer').on('click', function() {
      var name = $("#name").val().trim();
      if (name === "") {
        alert("Por favor, ingrese un nombre de tarea.");
        return;
      }
      var newTaskRef = database.ref('Tareas/').push();
      newTaskRef.set({ name: name });
      $("#name").val("");
    });

    var updateID = null;

    $('#taskTable tbody').on('click', '.updateData', function() {
      updateID = $(this).data('id');
      database.ref('Tareas/' + updateID).once('value', function(snapshot) {
        var values = snapshot.val();
        if (values) {
          $('#task_name').val(values.name);
          $('#update-modal').modal('show');
        }
      });
    });

    $('#saveUpdate').on('click', function() {
      var newName = $("#task_name").val().trim();
      if (newName === "") {
        alert("El nombre de la tarea no puede estar vacío.");
        return;
      }
      var updates = {};
      updates['/Tareas/' + updateID] = { name: newName };
      database.ref().update(updates, function(error) {
        if (error) {
          alert("Hubo un error al actualizar la tarea.");
        } else {
          $('#update-modal').modal('hide');
        }
      });
    });

    $('#taskTable tbody').on('click', '.removeData', function() {
      var id = $(this).attr('data-id');
      if (confirm("¿Está seguro de eliminar esta tarea?")) {
        database.ref('Tareas/' + id).remove();
      }
    });
  </script>

@endsection
