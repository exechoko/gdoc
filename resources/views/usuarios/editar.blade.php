<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="usuarios"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Usuarios"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <section class="section">
                <div class="section-header">
                    <h3 class="page__heading">Editar usuario</h3>
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

                                    <form method="POST" action="{{ route('usuarios.update', $user->id) }}">
                                        @method('PATCH')
                                        @csrf
                                        <div class="row col-xs-12 col-sm-12 col-md-12">

                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">Nombre completo</label>
                                                <input type="text" name="name"
                                                    class="form-control border border-2 p-2"
                                                    value='{{ $user->name }}'>
                                                @error('name')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">Teléfono</label>
                                                <input type="text" name="phone"
                                                    class="form-control border border-2 p-2"
                                                    value='{{ $user->phone }}'>
                                                @error('phone')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">D.N.I.</label>
                                                <input type="text" name="dni"
                                                    class="form-control border border-2 p-2"
                                                    value='{{ $user->phone }}'>
                                                @error('dni')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label">Contraseña</label>
                                                <div class="form-label">
                                                    <input type="password" name="password" id="password" class="form-control border border-2 p-2" value='{{ $user->password }}'>
                                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                                @error('password')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>

                                            <div class="mb-3 col-md-12">
                                                <label for="roles" class="text-start">Roles</label>
                                                <div class="col-md-6">
                                                    @foreach ($roles as $roleId => $roleName)
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="role_{{ $roleId }}" name="roles[]"
                                                                value="{{ $roleId }}"
                                                                {{ in_array($roleId, $userRoles) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="role_{{ $roleId }}">{{ $roleName }}</label>
                                                        </div>
                                                    @endforeach
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
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
        });
    </script>
    <x-plugins></x-plugins>
</x-layout>
