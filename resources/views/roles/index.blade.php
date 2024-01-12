<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="roles"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Roles"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                @can('crear-rol')
                                    <a class="btn btn-success" href="{{ route('roles.create') }}">Nuevo</a>
                                @endcan
                                <label class="alert alert-dark mb-0" style="float: right;">Registros:
                                    {{ $roles->total() }}</label>
                            </div>

                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th style="color:#000000ed;">Rol</th>
                                        <th style="color:#000000;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @can('editar-rol')
                                                    <a class="btn btn-primary"
                                                        href="{{ route('roles.edit', $role->id) }}">Editar</a>
                                                @endcan

                                                @can('borrar-rol')
                                                    <form method="POST" action="{{ route('roles.destroy', $role->id) }}"
                                                        style="display:inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Borrar</button>
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
