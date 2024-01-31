<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="cursos"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Ver Curso"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong> Administrar curso</strong></h6>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="ms-3 my-3 text-start">
                                <!-- Botón para abrir modal todas las notas -->
                                <a id="mostrarNotasBtn{{ $curso->id }}" class="btn bg-gradient-success mb-0"
                                    data-toggle="modal" data-target="#modalTodasNotas{{ $curso->id }}">
                                    <i class="material-icons text-sm">calculate</i>&nbsp;Notas
                                </a>
                                <!-- Botón para abrir modal asistencias -->
                                <a id="mostrarAsistenciasBtn{{ $curso->id }}" class="btn bg-gradient-info mb-0"
                                    data-toggle="modal" data-target="#modalAsistencias{{ $curso->id }}">
                                    <i class="material-icons text-sm">calendar_month</i>&nbsp;Asistencias
                                </a>
                            </div>
                            <div class="me-3 my-3 text-end">
                                <a id="nuevaEvaluacionBtn{{ $curso->id }}" class="btn bg-gradient-success mb-0"
                                    data-toggle="modal" data-target="#nuevaEvaluacion{{ $curso->id }}">
                                    <i class="material-icons text-sm">add</i>&nbsp;Nueva evaluación
                                </a>
                                <a class="btn bg-gradient-danger mb-0"
                                    href="{{ route('cursos.nueva-calificacion', $curso->id) }}">
                                    <i class="material-icons text-sm">calculate</i>&nbsp;Calificar
                                </a>
                                <a class="btn bg-gradient-info mb-0"
                                    href="{{ route('cursos.nueva-asistencia', $curso->id) }}">
                                    <i class="material-icons text-sm">add</i>&nbsp;Tomar asistencia
                                </a>
                            </div>
                        </div>

                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                APELLIDO</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                NOMBRE</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NOTAS</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ASISTENCIA</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($alumnos as $alumno)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm">{{ $alumno->id }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $alumno->apellido }}</h6>
                                                    </div>
                                                </td>
                                                <td class="">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $alumno->nombre }}</h6>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        @if ($alumno->calificaciones->count() > 0)
                                                            <button id="verNotasModalBtn{{ $alumno->id }}"
                                                                type="button" class="btn btn-info" data-toggle="modal"
                                                                data-target="#verNotasModal{{ $alumno->id }}">
                                                                Ver
                                                            </button>
                                                        @else
                                                            <p class="text-xs text-secondary mb-0">Sin notas</p>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        @if ($alumno->asistencias->count() > 0)
                                                            <button id="verAsistenciasModalBtn{{ $alumno->id }}"
                                                                type="button" class="btn btn-secondary"
                                                                data-toggle="modal"
                                                                data-target="#verAsistenciasModal{{ $alumno->id }}">
                                                                Ver
                                                            </button>
                                                        @else
                                                            <p class="text-xs text-secondary mb-0">Sin Asistencias</p>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal para crear evaluacion -->
            <div id="modal-nueva-evaluacion" class="modal fade" data-backdrop="false"
                style="background-color: rgba(0, 0, 0, 0.5);" role="dialog" aria-hidden="true">
                <div id="dialog" class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <!-- Contenido del modal -->
                        <div class="modal-header bg-info">
                            <h4 class="modal-title text-white">Nueva evaluación</h4>
                        </div>
                        <div class="modal-body" style="overflow-x: auto; overflow-y: auto;">
                            <div class="col-lg-12">
                                <label class="form-label">Fecha</label>
                                <input type="date" name="fecha_evaluacion" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <select name="asignatura_id" id="" class="form-control">
                                    <option value="">Seleccione la asignatura</option>
                                    @foreach ($asignaturas as $asignatura)
                                        <option value="{{ $asignatura->id }}">
                                            {{ $asignatura->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label">Observaciones</label>
                                <textarea type="text" name="observaciones" class="form-control border border-2 p-2" value=''></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="cerrarModalNuevaEvaluacion" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-times"></i>
                                <span>Cerrar</span>
                            </button>
                            <button id="guardarNuevaEvaluacion" class="btn btn-success" data-dismiss="modal">
                                <i class="fa fa-times"></i>
                                <span>Guardar</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal para notas -->
            <div id="modal-notas" class="modal fade" data-backdrop="false"
                style="background-color: rgba(0, 0, 0, 0.5);" role="dialog" aria-hidden="true">
                <div id="dialog" class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <!-- Contenido del modal -->
                        <div class="modal-header bg-info">
                            <h4 class="modal-title text-white">Notas</h4>
                        </div>
                        <div class="modal-body" style="min-height: 500px; overflow-x: auto; overflow-y: auto;">
                            <div class="col-lg-12" style="margin-top:20px; padding:0; min-height: 400px;">
                                <table id="table-notas" class="table table-condensed table-bordered table-stripped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Asignatura</th>
                                            <th>Nota</th>
                                            <th>Observaciones</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-times"></i>
                                <span> Cerrar</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal para asistencias -->
            <div id="modal-asistencias" class="modal fade" data-backdrop="false"
                style="background-color: rgba(0, 0, 0, 0.5);" role="dialog" aria-hidden="true">
                <div id="dialog" class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <!-- Contenido del modal -->
                        <div class="modal-header bg-warning">
                            <h4 class="modal-title text-white">Asistencias</h4>
                        </div>
                        <div class="modal-body" style="min-height: 500px; overflow-x: auto; overflow-y: auto;">
                            <div class="col-lg-12" style="margin-top:20px; padding:0; min-height: 400px;">
                                <table id="table-asistencias"
                                    class="table table-condensed table-bordered table-stripped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Asistió</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-times"></i>
                                <span> Cerrar</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal de todas las asistencias -->
            <div id="modalAsistencias" class="modal fade" data-backdrop="false"
                style="background-color: rgba(0, 0, 0, 0.5);" role="dialog" aria-hidden="true">
                <div id="dialog" class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Asistencias</h5>
                        </div>
                        <div class="modal-body" id="modalContentAsistencia">
                            <!-- El contenido de la tabla se mostrará aquí -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal de todas las notas -->
            <div id="modalTodasNotas" class="modal fade" data-backdrop="false"
                style="background-color: rgba(0, 0, 0, 0.5);" role="dialog" aria-hidden="true">
                <div id="dialog" class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Notas</h5>
                        </div>
                        <div class="modal-body" id="modalContentNotas">
                            <!-- El contenido de la tabla se mostrará aquí -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Script AJAX para cargar las notas -->
            <script>
                $(document).ready(function() {
                    var $tableNotas = $('#table-notas');
                    var $tableAsistencias = $('#table-asistencias');
                    var $modalNotas = $('#modal-notas');
                    var $modalAsistencias = $('#modal-asistencias');
                    var $modalNuevaEvaluacion = $('#modal-nueva-evaluacion');
                    var $modalTodasAsistencias = $('#modalAsistencias');
                    var $modalTodasNotas = $('#modalTodasNotas');

                    // Asignar manejador de eventos para el botón "Cerrar"
                    $modalNotas.find('.btn-danger').on('click', function() {
                        $modalNotas.modal('hide');
                    });
                    // Asignar manejador de eventos para el botón "Cerrar"
                    $modalAsistencias.find('.btn-danger').on('click', function() {
                        $modalAsistencias.modal('hide');
                    });
                    $modalTodasAsistencias.find('.btn-danger').on('click', function() {
                        $modalTodasAsistencias.modal('hide');
                    });
                    $modalTodasNotas.find('.btn-danger').on('click', function() {
                        $modalTodasNotas.modal('hide');
                    });
                    // Asignar manejador de eventos para el botón "Cerrar"
                    $modalNuevaEvaluacion.find('#cerrarModalNuevaEvaluacion').on('click', function() {
                        $modalNuevaEvaluacion.modal('hide');
                    });
                    //Guardar evaluacion
                    $modalNuevaEvaluacion.find('#guardarNuevaEvaluacion').on('click', function() {
                        nuevaEvaluacion({{ $curso->id }});
                    });

                    function handleClickEvent(id, consultarFunction) {
                        $(id).click(function() {
                            // Llamamos a la función consultarFunction solo cuando hacemos clic en el botón
                            consultarFunction($(this).data('id'));
                        });
                    }

                    // Iteramos sobre cada botón "Ver" para asignar el manejador de eventos
                    @foreach ($alumnos as $alumno)
                        handleClickEvent('#verNotasModalBtn{{ $alumno->id }}', function() {
                            consultarNotas({{ $alumno->id }});
                        });
                        handleClickEvent('#verAsistenciasModalBtn{{ $alumno->id }}', function() {
                            consultarAsistencias({{ $alumno->id }});
                        });
                    @endforeach

                    handleClickEvent('#nuevaEvaluacionBtn{{ $curso->id }}', function() {
                        $('#modal-nueva-evaluacion').modal('show');
                    });
                    handleClickEvent('#mostrarAsistenciasBtn{{ $curso->id }}', function() {
                        mostrarAsistencias({{ $curso->id }})
                    });
                    handleClickEvent('#mostrarNotasBtn{{ $curso->id }}', function() {
                        mostrarTodasLasNotas({{ $curso->id }})
                    });

                    function mostrarAsistencias(cursoId) {
                        $.ajax({
                            url: '/mostrar-asistencias/' + cursoId,
                            method: 'GET',
                            dataType: 'json', // Indicar que esperas un JSON como respuesta
                            success: function(data) {
                                console.log('data', data);
                                $('#modalAsistencias').modal('show');
                                actualizarTablaAsistencias(data);
                            },
                            error: function(error) {
                                console.error(error);
                            }
                        });
                    }

                    function mostrarTodasLasNotas(cursoId) {
                        $.ajax({
                            url: '/mostrar-todas-notas/' + cursoId,
                            method: 'GET',
                            dataType: 'json', // Indicar que esperas un JSON como respuesta
                            success: function(data) {
                                console.log('data', data);
                                $('#modalTodasNotas').modal('show');
                                actualizarTablaNotas(data);
                            },
                            error: function(error) {
                                console.error(error);
                            }
                        });
                    }

                    function actualizarTablaNotas(data) {
                        // Limpiar contenido actual de la tabla
                        $('#modalContentNotas').empty();

                        // Construir la tabla con los datos recibidos
                        var tableHtml =
                            '<div class="table-responsive"><table class="table table-condensed table-bordered table-stripped"><thead><tr><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alumno</th>';

                        // Cabeceras para las evaluaciones
                        $.each(data.fechasCabeceras, function(index, evaluacion) {
                            tableHtml +=
                                '<th class="text-uppercase text-secondary text-xxs font-weight-bolder">' +
                                evaluacion + '</th>';
                        });

                        tableHtml += '</tr></thead><tbody>';
                        $.each(data.alumnos, function(index, alumno) {
                            tableHtml += '<tr><td class="text-xs font-weight-bolder">' + alumno.apellido + ' ' +
                                alumno.nombre + '</td>';

                            // Celdas para las calificaciones
                            $.each(data.evaluaciones, function(index, evaluacion) {
                                tableHtml +=
                                    '<td class="text-uppercase text-secondary text-xxs font-weight-bolder">';
                                // Mostrar la calificación del alumno en la evaluación
                                tableHtml += data.calificacionesData[alumno.id][evaluacion
                                .fecha_evaluacion];
                                tableHtml += '</td>';
                            });

                            tableHtml += '</tr>';
                        });
                        tableHtml += '</tbody></table></div>'; // Agregar la clase 'table-responsive' al contenedor

                        // Agregar la tabla al contenido de la modal
                        $('#modalContentNotas').html(tableHtml);
                    }


                    function actualizarTablaAsistencias(data) {
                        // Limpiar contenido actual de la tabla
                        $('#modalContentAsistencia').empty();

                        // Construir la tabla con los datos recibidos
                        var tableHtml =
                            '<div class="table-responsive"><table class="table table-condensed table-bordered table-stripped"><thead><tr><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alumno</th>';
                        $.each(data.fechasCabeceras, function(index, fecha) {
                            tableHtml +=
                                '<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">' +
                                fecha + '</th>';
                        });
                        tableHtml += '</tr></thead><tbody>';
                        $.each(data.alumnos, function(index, alumno) {
                            tableHtml += '<tr><td class="text-xs font-weight-bolder">' + alumno.apellido + ' ' +
                                alumno.nombre + '</td>';
                            $.each(data.fechasAsistencia, function(index, fecha) {
                                tableHtml +=
                                    '<td class="text-uppercase text-secondary text-xxs font-weight-bolder">';
                                // Mostrar si el alumno está presente o ausente
                                tableHtml += data.asistenciasData[alumno.nombre][fecha];
                                tableHtml += '</td>';
                            });
                            tableHtml += '</tr>';
                        });
                        tableHtml += '</tbody></table></div>'; // Agregar la clase 'table-responsive' al contenedor

                        // Agregar la tabla al contenido de la modal
                        $('#modalContentAsistencia').html(tableHtml);
                    }

                    /*//Con datatables
                    function actualizarTablaAsistencias(data) {
                        // Limpiar contenido actual de la tabla
                        $('#modalContentAsistencia').empty();

                        // Construir la tabla con los datos recibidos
                        var tableHtml =
                            '<table id="tablaTodasAsistencias" class="table table-bordered table-stripped"><thead><tr><th>Alumno</th>';
                        $.each(data.fechasCabeceras, function(index, fecha) {
                            tableHtml +=
                                '<th>' +
                                fecha + '</th>';
                        });
                        tableHtml += '</tr></thead><tbody>';
                        $.each(data.alumnos, function(index, alumno) {
                            tableHtml += '<tr><td>' + alumno
                                .apellido + ' ' +
                                alumno.nombre + '</td>';
                            $.each(data.fechasAsistencia, function(index, fecha) {
                                tableHtml +=
                                    '<td>';
                                // Mostrar si el alumno está presente o ausente
                                tableHtml += data.asistenciasData[alumno.nombre][fecha];
                                tableHtml += '</td>';
                            });
                            tableHtml += '</tr>';
                        });
                        tableHtml += '</tbody></table>'; // Agregar la clase 'table-responsive' al contenedor

                        // Agregar la tabla al contenido de la modal
                        $('#modalContentAsistencia').html(tableHtml);

                        // Destruir la instancia anterior de DataTables si existe
                        if ($.fn.DataTable.isDataTable('#tablaTodasAsistencias')) {
                            $('#tablaTodasAsistencias').DataTable().destroy();
                        }

                        // Inicializar DataTables para permitir el desplazamiento horizontal
                        $('#tablaTodasAsistencias').DataTable({
                            scrollX: true,
                            fixedColumns: {
                                leftColumns: 1 // Fijar la columna "Alumno"
                            }
                        });
                    }*/

                    function nuevaEvaluacion(cursoId) {
                        console.log('idCurso', cursoId);
                        var fechaEvaluacion = $('[name="fecha_evaluacion"]').val();
                        var asignaturaId = $('[name="asignatura_id"]').val();
                        var observaciones = $('[name="observaciones"]').val();
                        $.ajax({
                            url: '/nueva-evaluacion/' + cursoId,
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                fecha_evaluacion: fechaEvaluacion,
                                asignatura: asignaturaId,
                                observaciones: observaciones
                            },
                            success: function(data) {
                                console.log(data);
                                $modalNuevaEvaluacion.modal('hide');
                            },
                            error: function(error) {
                                console.error(error);
                            }
                        });
                    }

                    function consultarNotas(alumnoId) {
                        console.log('idAlumno', alumnoId);
                        $.ajax({
                            url: '/obtener-notas/' + alumnoId,
                            type: 'GET',
                            success: function(data) {
                                console.log(data);
                                // Llamamos a la función para construir y mostrar la tabla
                                mostrarTablaNotas(data.notas);
                                $('#modal-notas').modal('show');
                            }
                        });
                    }

                    function consultarAsistencias(alumnoId) {
                        console.log('idAlumno', alumnoId);
                        $.ajax({
                            url: '/obtener-asistencias/' + alumnoId,
                            type: 'GET',
                            success: function(data) {
                                console.log(data);
                                // Llamamos a la función para construir y mostrar la tabla
                                mostrarTablaAsistencias(data.asistencias);
                                $('#modal-asistencias').modal('show');
                            }
                        });
                    }

                    function mostrarTablaAsistencias(asistencias) {
                        var tableBody = $tableAsistencias.find('tbody');
                        tableBody.empty();

                        // Iteramos sobre las asistencias y agregamos filas a la tabla
                        $.each(asistencias, function(index, asistencia) {
                            var claseEstilo = asistencia.asistio === 'SI' ? 'text-success' : 'text-danger';
                            var row = '<tr>' +
                                '<td>' + asistencia.id + '</td>' +
                                '<td>' + asistencia.fecha + '</td>' +
                                '<td class="' + claseEstilo + '">' + asistencia.asistio + '</td>' +
                                '</tr>';
                            tableBody.append(row);
                        });
                    }

                    function mostrarTablaNotas(notas) {
                        var tableBody = $tableNotas.find('tbody');
                        // Limpiamos cualquier contenido existente en la tabla
                        tableBody.empty();

                        // Iteramos sobre las notas y agregamos filas a la tabla
                        $.each(notas, function(index, nota) {
                            var row = '<tr>' +
                                '<td>' + nota.id + '</td>' +
                                '<td>' + nota.materia + '</td>' +
                                '<td>' + nota.nota + '</td>' +
                                '<td>' + (nota.observaciones ? nota.observaciones : 'N/A') + '</td>' +
                                '<td>' + nota.fecha + '</td>' +
                                '</tr>';
                            tableBody.append(row);
                        });
                    }
                });
            </script>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
