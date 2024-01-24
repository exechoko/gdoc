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
                                <h6 class="text-white mx-3"><strong> Tomar asistencia</strong></h6>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('cursos.guardar-asistencia', $curso->id) }}">
                            @csrf
                            <div class="card-body row col-xs-12 col-sm-12 col-md-12">
                                <div class="m-3 col-md-3">
                                    <label class="form-label">Fecha</label>
                                    <input type="datetime-local" name="fecha_asistencia" class="form-control">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Observaciones</label>
                                    <input type="text" name="observaciones"
                                        class="form-control border border-2 p-2" value=''>
                                </div>
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
                                                    PRESENTE</th>
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
                                                    <td class="text-center">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="presentes[{{ $alumno->id }}]">
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
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
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
