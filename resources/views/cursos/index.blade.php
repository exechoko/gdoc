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
                                <h6 class="text-white mx-3"><strong> Agregar, Editar, Borrar cursos</strong></h6>
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
                                                ESCUELA</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                AÑO</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                DIVISIÓN</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cursos as $curso)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm">{{ $curso->id }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        @if ($curso->escuela)
                                                            <p class="text-xs text-secondary mb-0">
                                                                {{ $curso->escuela->nombre }}</p>
                                                        @else
                                                            <p class="text-xs text-secondary mb-0">Escuela no asignada
                                                            </p>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $curso->nivel }}</h6>
                                                    </div>
                                                </td>
                                                <td class="">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $curso->division }}</h6>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a class="btn btn-warning"
                                                            href="{{ route('cursos.show', $curso->id) }}"><i
                                                                class="material-icons">visibility</i></a>
                                                    @can('editar-curso')
                                                        <a class="btn btn-info"
                                                            href="{{ route('cursos.edit', $curso->id) }}"><i
                                                                class="material-icons">edit</i></a>
                                                    @endcan
                                                    @can('borrar-curso')
                                                        <form method="POST"
                                                            action="{{ route('cursos.destroy', $curso->id) }}"
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
