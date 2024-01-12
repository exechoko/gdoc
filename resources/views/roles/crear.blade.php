<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="roles"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Roles"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <section class="section">
                <div class="section-header">
                    <h3 class="page__heading">Nuevo Rol</h3>
                </div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                            <strong>¡Revise los campos!</strong>
                                            @foreach ($errors->all() as $error)
                                                <span class="badge badge-danger">{{ $error }}</span>
                                            @endforeach
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('roles.store') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">Nombre del Rol</label>
                                                <input type="text" name="name"
                                                    class="form-control border border-2 p-2" value=''>
                                                @error('name')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="row col-md-3 mb-3">
                                                <label for="permissions"
                                                    class="col-md-4 col-form-label text-md-end text-start">Permisos</label>
                                                <div class="col-md-6">
                                                    @forelse ($permission as $perm)
                                                        <div class="form-switch">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="permission_{{ $perm->id }}" name="permissions[]"
                                                                value="{{ $perm->id }}"
                                                                {{ in_array($perm->id, old('permissions', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="permission_{{ $perm->id }}">{{ $perm->name }}</label>
                                                        </div>
                                                    @empty
                                                        <!-- Mensaje si no hay permisos disponibles -->
                                                    @endforelse

                                                    @if ($errors->has('permissions'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('permissions') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
