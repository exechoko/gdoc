<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="cursos"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Cursos"></x-navbars.navs.auth>
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
                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-success mb-0" href="{{ route('cursos.create') }}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Nuevo</a>
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
                                                                type="button" class="btn btn-info"
                                                                data-toggle="modal"
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
            <!-- Modal para notas -->
            <div id="modal-notas" class="modal fade" data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);"
                role="dialog" aria-hidden="true">
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
            <div id="modal-asistencias" class="modal fade" data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);"
                role="dialog" aria-hidden="true">
                <div id="dialog" class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <!-- Contenido del modal -->
                        <div class="modal-header bg-warning">
                            <h4 class="modal-title text-white">Asistencias</h4>
                        </div>
                        <div class="modal-body" style="min-height: 500px; overflow-x: auto; overflow-y: auto;">
                            <div class="col-lg-12" style="margin-top:20px; padding:0; min-height: 400px;">
                                <table id="table-asistencias" class="table table-condensed table-bordered table-stripped">
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

            <!-- Script AJAX para cargar las notas -->
            <script>
                $(document).ready(function() {
                    var $tableNotas = $('#table-notas');
                    var $tableAsistencias = $('#table-asistencias');
                    var $modalNotas = $('#modal-notas');
                    var $modalAsistencias = $('#modal-asistencias');

                    // Asignar manejador de eventos para el botón "Cerrar"
                    $modalNotas.find('.btn-danger').on('click', function() {
                        $modalNotas.modal('hide');
                    });
                    // Asignar manejador de eventos para el botón "Cerrar"
                    $modalAsistencias.find('.btn-danger').on('click', function() {
                        $modalAsistencias.modal('hide');
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
                        handleClickEvent('#verAsistenciasModalBtn{{ $alumno->id }}', function(){
                            consultarAsistencias({{ $alumno->id }});
                        });
                    @endforeach

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
                            var row = '<tr>' +
                                '<td>' + asistencia.id + '</td>' +
                                '<td>' + asistencia.creado + '</td>' +
                                '<td>' + asistencia.asistio + '</td>' +
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
                                '<td>' + nota.creado + '</td>' +
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