<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="alumnos"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Alumnos"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong> Agregar, Editar, Borrar alumnos</strong></h6>
                            </div>
                        </div>
                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-success mb-0" href="{{ route('alumnos.create') }}"><i
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
                                                ESCUELA</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                CURSO</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                TELEFONO</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                EMAIL</th>
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
                                                <td class="align-middle text-center text-sm">

                                                    @if ($alumno->escuela)
                                                        <p class="text-xs text-secondary mb-0">{{ $alumno->escuela->nombre }}</p>
                                                    @else
                                                        <p class="text-xs text-secondary mb-0">Escuela no asignada</p>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @if ($alumno->curso)
                                                        <p class="text-xs text-secondary mb-0">{{ $alumno->curso->nivel }} {{ $alumno->curso->division }}</p>
                                                    @else
                                                        <p class="text-xs text-secondary mb-0">Curso no asignado</p>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">{{ $alumno->telefono }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">{{ $alumno->email }}</p>
                                                </td>
                                                <td>
                                                    @can('editar-alumno')
                                                        <a class="btn btn-info"
                                                            href="{{ route('alumnos.edit', $alumno->id) }}"><i
                                                                class="material-icons">edit</i></a>
                                                    @endcan
                                                    @can('borrar-alumno')
                                                        <form method="POST"
                                                            action="{{ route('alumnos.destroy', $alumno->id) }}"
                                                            style="display:inline">
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
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
