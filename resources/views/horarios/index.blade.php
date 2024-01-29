<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="horarios"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Horarios"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong> Agregar, Editar, Borrar horarios</strong></h6>
                            </div>
                        </div>
                        <div class=" me-3 my-3 text-end">
                            <a id="nuevoHorarioBtn" class="btn bg-gradient-success mb-0" data-toggle="modal"
                                data-target="#nuevoHorario">
                                <i class="material-icons text-sm">add</i>&nbsp;Cargar horario
                            </a>
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
                                                ESCUELA</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                ASIGNATURA</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                CURSO</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                DÍA</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                INGRESO</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                SALIDA</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                OBSERVACIONES</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($horarios as $horario)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm">{{ $horario->id }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="">
                                                    @if ($horario->escuela)
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $horario->escuela->nombre }}</p>
                                                    @else
                                                        <p class="text-xs text-secondary mb-0">Escuela no asignada</p>
                                                    @endif
                                                </td>
                                                <td class="">
                                                    @if ($horario->asignatura)
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $horario->asignatura->nombre }}
                                                        </p>
                                                    @else
                                                        <p class="text-xs text-secondary mb-0">Asignatura no asignada
                                                        </p>
                                                    @endif
                                                </td>
                                                <td class="">
                                                    @if ($horario->curso)
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $horario->curso->nivel }} {{ $horario->curso->division }}
                                                        </p>
                                                    @else
                                                        <p class="text-xs text-secondary mb-0">Curso no asignado</p>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">{{ $horario->dia_semana }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">{{ $horario->ingreso }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">{{ $horario->salida }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">{{ $horario->observaciones }}
                                                    </p>
                                                </td>
                                                <td>
                                                    @can('editar-horario')
                                                        <a class="btn btn-info" href="#"><i
                                                                class="material-icons">edit</i></a>
                                                    @endcan
                                                    @can('borrar-horario')
                                                        <form method="POST" action="#}" style="display:inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="material-icons">delete_forever</i></button>
                                                        </form>
                                                    @endcan
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
            <div id="modal-nuevo-horario" class="modal fade" data-backdrop="false"
                style="background-color: rgba(0, 0, 0, 0.5);" role="dialog" aria-hidden="true">
                <div id="dialog" class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <!-- Contenido del modal -->
                        <div class="modal-header bg-info">
                            <h4 class="modal-title text-white">Cargar horario</h4>
                        </div>
                        <div class="modal-body" style="overflow-x: auto; overflow-y: auto;">
                            <div class="form-group col-md-12">
                                <label class="form-label">Días de la semana</label><br>
                                @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $dia)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="dias_semana[]"
                                            value="{{ $dia }}">
                                        <label class="form-check-label">{{ ucfirst($dia) }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Ingreso</label>
                                <input type="time" name="ingreso" class="form-control">
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Salida</label>
                                <input type="time" name="salida" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <select name="escuela_id" id="" class="form-control">
                                    <option value="">Seleccione la escuela</option>
                                    @foreach ($escuelas as $escuela)
                                        <option value="{{ $escuela->id }}">
                                            {{ $escuela->nombre }}
                                        </option>
                                    @endforeach
                                </select>
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
                                <select name="curso_id" id="" class="form-control">
                                    <option value="">Seleccione el curso</option>
                                    @foreach ($cursos as $curso)
                                        <option value="{{ $curso->id }}">
                                            {{ $curso->nivel }} {{ $curso->division }}
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
                            <button id="cerrarModalNuevoHorario" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-times"></i>
                                <span>Cerrar</span>
                            </button>
                            <button id="guardarNuevoHorario" class="btn btn-success" data-dismiss="modal">
                                <i class="fa fa-times"></i>
                                <span>Guardar</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    var $modalNuevoHorario = $('#modal-nuevo-horario');
                    // Asignar manejador de eventos para el botón "Cerrar"
                    $modalNuevoHorario.find('#cerrarModalNuevoHorario').on('click', function() {
                        $modalNuevoHorario.modal('hide');
                    });
                    //Guardar evaluacion
                    $modalNuevoHorario.find('#guardarNuevoHorario').on('click', function() {
                        nuevoHorario();
                    });

                    function handleClickEvent(id, consultarFunction) {
                        $(id).click(function() {
                            consultarFunction($(this).data('id'));
                        });
                    }

                    handleClickEvent('#nuevoHorarioBtn', function() {
                        $('#modal-nuevo-horario').modal('show');
                    });

                    function nuevoHorario() {
                        var horaIngreso = $('[name="ingreso"]').val();
                        var horaSalida = $('[name="salida"]').val();
                        var asignaturaId = $('[name="asignatura_id"]').val();
                        var escuelaId = $('[name="escuela_id"]').val();
                        var cursoId = $('[name="curso_id"]').val();
                        var observaciones = $('[name="observaciones"]').val();
                        var diasSemana = $('[name="dias_semana[]"]:checked').map(function() {
                            return $(this).val();
                        }).get().join(', ');

                        $.ajax({
                            url: '/horarios/store',
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                dias: diasSemana,
                                ingreso: horaIngreso,
                                salida: horaSalida,
                                escuela: escuelaId,
                                asignatura: asignaturaId,
                                curso: cursoId,
                                observaciones: observaciones
                            },
                            success: function(data) {
                                console.log(data);
                                $modalNuevoHorario.modal('hide');
                            },
                            error: function(error) {
                                console.error(error);
                            }
                        });
                    }
                });
            </script>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
