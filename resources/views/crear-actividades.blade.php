@extends('layouts.app')
@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Creacion de cuentas y actividades</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item">Crear actividades</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-6">

        <div class="card">
          <div class="card-body">
            <!-- Input file -->
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Lista de Alumnos:</h5>
              <a href="#" class="btn btn-primary" id="xxxx">+ Alumno</a>
              <a href="#" class="btn btn-primary" id="btnCargarLista">Cargar lista</a>
            </div>

            <!-- Input file oculto para seleccionar archivos Excel -->
            <input class="form-control" type="file" id="formFile" style="display: none;" accept=".xls, .xlsx">

            <!-- Tabla para mostrar los datos cargados -->
            <table class="table table-hover" id="tablaAlumnos">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">PERIODO</th>
                  <th scope="col">HORARIO</th>
                  <th scope="col">MATRICULA</th>
                  <th scope="col">NOMBRE</th> <!-- Ajuste en el ancho -->
                </tr>
              </thead>
              <tbody id="tbodyAlumnos"></tbody>
            </table>
            <!-- End Table with hoverable rows -->
          </div>
        </div>
      </div>

      <!-- Tabla lista de tareas -->
      <div class="col-lg-5 d-flex justify-content-end">
        <div class="card" style="max-width: 300px;">
          <div class="card-body">
            <h5 class="card-title">Lista de tareas:</h5>
            <select class="form-select" id="taskSelect" aria-label="Default select example">                  
                </select>
            <!-- Select para elegir una tarea -->
            

            <!-- Table with stripped rows -->
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col" style="width: 10%;">#</th> <!-- Columna para el número de línea -->
                  <th style="width: 70%;">Nombre</th> <!-- Columna para el nombre de la tarea -->
                  <th scope="col" style="width: 20%;">Acción</th> <!-- Columna para el botón -->
                </tr>
              </thead>
              <tbody id="tbody"></tbody>
            </table>
            <!-- End Table with stripped rows -->
          </div>
        </div>
      </div>

      <!-- End Table with stripped rows -->
    </div>
  </section>
</main>
<!-- End #main -->
@endsection

<!-- Firebase Scripts -->
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
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

  function loadTasks() {
    firebase.database().ref('Tareas/').on('value', function(snapshot) {
      var tbody = $('#tbody');
      tbody.empty(); // Limpiar el tbody antes de agregar nuevas filas

      var value = snapshot.val();
      var taskCount = 1; // Contador para enumerar las filas

      $.each(value, function(key, task) {
        if (task && task.name) { // Asegurarse de que la tarea tenga un nombre
          // Crear una fila con el número de línea, el nombre de la tarea y el botón de eliminar
          var row = `
          <tr id="task-${key}"> <!-- ID único para cada fila con el key de Firebase -->
            <td>${taskCount}</td> <!-- Número de línea -->
            <td>${task.name}</td> <!-- Nombre de la tarea -->
            <td>
              <button class="btn btn-danger btn-sm" onclick="removeTask('${key}')">Eliminar</button> <!-- Botón de eliminar -->
            </td>
          </tr>`;

          tbody.append(row); // Añadir la fila a la tabla
          taskCount++; // Incrementar el número de línea
        }
      });
    });
  }

  // Función para eliminar la fila de la tabla sin afectar Firebase
  function removeTask(taskKey) {
    // Eliminar solo la fila de la tabla
    $(`#task-${taskKey}`).remove();
  }

  $(document).ready(function() {
    loadTasks(); // Cargar las tareas al iniciar
  });
</script>

<!-- Agregar la librería XLSX para procesar archivos Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>

<script>
  $(document).ready(function() {
    // Al hacer clic en el botón, abre el input file
    $("#btnCargarLista").click(function(event) {
      event.preventDefault();
      $("#formFile").click();
    });

    // Al seleccionar un archivo, procesarlo
    $("#formFile").change(function(event) {
      var file = event.target.files[0]; // Obtener el archivo seleccionado
      if (!file) return;

      var reader = new FileReader();
      reader.readAsArrayBuffer(file);

      reader.onload = function(e) {
        var data = new Uint8Array(e.target.result);
        var workbook = XLSX.read(data, {
          type: "array"
        });

        var firstSheet = workbook.SheetNames[0]; // Tomar la primera hoja del archivo
        var sheetData = XLSX.utils.sheet_to_json(workbook.Sheets[firstSheet], {
          defval: ""
        });

        // Limpiar la tabla antes de cargar los datos
        $("#tbodyAlumnos").empty();

        // Iterar sobre los datos y cargar solo las columnas deseadas
        sheetData.forEach((row, index) => {
          if (row["PERIODO"] && row["HORARIO"] && row["MATRICULA"] && row["NOMBRE"]) {
            var formattedMatricula = `al${row["MATRICULA"]}@utcj.edu.mx`;

            var newRow = `
                            <tr>
                                <th scope="row">${index + 1}</th>
                                <td>${row["PERIODO"]}</td>
                                <td>${row["HORARIO"]}</td>
                                <td>${formattedMatricula}</td>
                                <td>${row["NOMBRE"]}</td>
                            </tr>
                        `;
            $("#tbodyAlumnos").append(newRow);
          }
        });

        // Limpiar el input file para permitir cargar el mismo archivo nuevamente
        $("#formFile").val("");
      };
    });
  });
</script>

<!-- Lista de tareas - AGREGAR TAREAS A LA TABLA -->
<script>
  // Cargar las tareas de Firebase y llenar el select
function loadTasksToSelect() {
  firebase.database().ref('Tareas/').on('value', function(snapshot) {
    var taskSelect = $('#taskSelect');
    taskSelect.empty(); // Limpiar el select antes de agregar nuevas opciones
    taskSelect.append('<option selected>Agregar tareas</option>'); // Opción por defecto

    var value = snapshot.val();
    $.each(value, function(key, task) {
      if (task && task.name) {
        var option = `<option value="${key}">${task.name}</option>`; // Crear opción para el select
        taskSelect.append(option); // Añadir la opción al select
      }
    });
  });
}

// Agregar una tarea seleccionada al cuerpo de la tabla
function addTaskToTable(taskKey) {
  firebase.database().ref('Tareas/' + taskKey).once('value', function(snapshot) {
    var task = snapshot.val();
    if (task && task.name) {
      var tbody = $('#tbody');
      var taskCount = tbody.children().length + 1; // Contador para el número de línea

      // Crear una nueva fila con la tarea seleccionada
      var row = `
        <tr id="task-${taskKey}">
          <td>${taskCount}</td> <!-- Número de línea -->
          <td>${task.name}</td> <!-- Nombre de la tarea -->
          <td>
            <button class="btn btn-danger btn-sm" onclick="removeTask('${taskKey}')">Eliminar</button>
          </td>
        </tr>
      `;
      
      tbody.append(row); // Añadir la fila a la tabla
    }
  });
}

// Función para eliminar la fila de la tabla sin afectar Firebase
function removeTask(taskKey) {
  $(`#task-${taskKey}`).remove(); // Eliminar solo la fila de la tabla
}

$(document).ready(function() {
  loadTasksToSelect(); // Cargar las tareas al iniciar y llenar el select
  
  // Agregar tarea seleccionada al hacer una selección en el select
  $('#taskSelect').change(function() {
    var selectedTaskKey = $(this).val();
    if (selectedTaskKey && selectedTaskKey !== "Open this select menu") {
      addTaskToTable(selectedTaskKey);
    }
  });
});

</script>