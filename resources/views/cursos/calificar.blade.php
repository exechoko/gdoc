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
                                <h6 class="text-white mx-3"><strong> Calificar</strong></h6>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('cursos.calificar', $curso->id) }}">
                            @csrf
                            <div class="card-body row col-xs-12 col-sm-12 col-md-12">
                                <div class="m-3 col-md-4">
                                    <select name="asignatura_id" id="" class="form-control">
                                        <option value="">Seleccione la asignatura</option>
                                        @foreach ($asignaturas as $asignatura)
                                            <option value="{{ $asignatura->id }}">
                                                {{ $asignatura->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <!-- Modifica tu segundo select para agregarle un evento onchange -->
                                    <select name="evaluacion_id" id="evaluacion_id" class="form-control">
                                        <option value="">Seleccione la evaluación</option>
                                        @foreach ($evaluaciones as $evaluacion)
                                            <option value="{{ $evaluacion->id }}">
                                                {{ $evaluacion->fecha_evaluacion }} {{ $evaluacion->observaciones }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Agrega un nuevo div para contener la tabla -->
                                <div id="calificacionesTableContainer" class="table-responsive p-0"></div>

                                <div class="table-responsive p-0">
                                    <table id='table-notas-calificacion' class="table align-items-center mb-0">
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
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    NOTA</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    OBSERVACIONES</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="calificacionesTableBody">
                                            <!-- Aquí se llenarán dinámicamente las filas de la tabla con JavaScript -->
                                        </tbody>
                                        <!--tbody>
                                            {{-- @foreach ($alumnos as $alumno) --}}
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <p class="mb-0 text-sm">{{-- $alumno->id --}}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{-- $alumno->apellido --}}</h6>
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{-- $alumno->nombre --}}</h6>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center">
                                                            <input type="number" step="0.01" class="form-control"
                                                                name="notas[{{-- $alumno->id --}}]" placeholder="Nota">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center">
                                                            <input type="text" step="0.01" class="form-control"
                                                                name="observaciones[{{-- $alumno->id --}}]"
                                                                placeholder="Observación">
                                                        </div>
                                                    </td>
                                                </tr>
                                            {{-- @endforeach --}}
                                        </tbody-->
                                    </table>
                                </div>
                                <div class="text-end m-3">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    var $calificacionesTableBody = $('#calificacionesTableBody');
                    var asignaturaSelect = $('#asignatura_id');
                    var evaluacionSelect = $('#evaluacion_id');

                    evaluacionSelect.on('change', function() {
                        var evaluacionId = $(this).val();
                        if (evaluacionId) {
                            $.ajax({
                                url: '/obtener-calificaciones/' + evaluacionId,
                                type: 'GET',
                                dataType: 'json',
                                success: function(calificaciones) {
                                    // Limpia el cuerpo de la tabla
                                    $calificacionesTableBody.empty();

                                    // Si hay calificaciones, mostrarlas
                                    if (calificaciones.length > 0) {
                                        $.each(calificaciones, function(index, calificacion) {
                                            var rowHtml = '<tr>' +
                                                '<td>' + calificacion.alumno.id + '</td>' +
                                                '<td>' + calificacion.alumno.apellido +
                                                '</td>' +
                                                '<td>' + calificacion.alumno.nombre + '</td>' +
                                                '<td>' +
                                                '<input type="number" step="0.01" class="form-control" ' +
                                                'name="notas[' + calificacion.alumno.id +
                                                ']" ' +
                                                'value="' + (calificacion.nota ?? '') +
                                                '" placeholder="Nota">' +
                                                '</td>' +
                                                '<td>' +
                                                '<input type="text" class="form-control" ' +
                                                'name="observaciones[' + calificacion.alumno
                                                .id + ']" ' +
                                                'value="' + (calificacion.observaciones ?? '') +
                                                '" placeholder="Observación">' +
                                                '</td>' +
                                                '</tr>';

                                            $calificacionesTableBody.append(rowHtml);
                                        });
                                    } else {
                                        // Si no hay calificaciones, mostrar el listado de alumnos
                                        @foreach ($alumnos as $alumno)
                                            var rowHtml = '<tr>' +
                                                '<td>' + {{ $alumno->id }} + '</td>' +
                                                '<td>' + '{{ $alumno->apellido }}' + '</td>' +
                                                '<td>' + '{{ $alumno->nombre }}' + '</td>' +
                                                '<td>' +
                                                '<input type="number" step="0.01" class="form-control" ' +
                                                'name="notas[' + {{ $alumno->id }} +
                                                ']" placeholder="Nota">' +
                                                '</td>' +
                                                '<td>' +
                                                '<input type="text" class="form-control" ' +
                                                'name="observaciones[' + {{ $alumno->id }} +
                                                ']" placeholder="Observación">' +
                                                '</td>' +
                                                '</tr>';

                                            $calificacionesTableBody.append(rowHtml);
                                        @endforeach
                                    }
                                },
                                error: function(error) {
                                    console.error(error);
                                }
                            });
                        } else {
                            // Si no se selecciona ninguna evaluación, limpiar la tabla
                            $calificacionesTableBody.empty();
                        }
                    });
                });
            </script>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
