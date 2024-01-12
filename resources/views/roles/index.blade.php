<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="roles"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Roles"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong> Agregar, Editar y Eliminar roles</strong></h6>
                            </div>
                        </div>
                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-success mb-0" href="{{ route('roles.create') }}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Agregar rol</a>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <label class="alert alert-white mb-0" style="float: right;">Registros:
                                    {{ $roles->total() }}</label>
                            </div>

                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-s font-weight-bolder opacity-7"
                                            style="color:#000000ed;">Rol</th>
                                        <th class="text-uppercase text-secondary text-s font-weight-bolder opacity-7"
                                            style="color:#000000;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @can('editar-rol')
                                                    <a class="btn btn-info" href="{{ route('roles.edit', $role->id) }}"><i
                                                            class="material-icons">edit</i></a>
                                                @endcan

                                                @can('borrar-rol')
                                                    <form method="POST" action="{{ route('roles.destroy', $role->id) }}"
                                                        style="display:inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="material-icons">close</i></button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                                {!! $roles->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
