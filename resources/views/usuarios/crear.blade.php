<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="roles"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Usuarios"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <section class="section">
                <div class="section-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-auto my-auto">
                                        <div class="h-100">
                                            <h5 class="mb-1">
                                                Nuevo usuario
                                            </h5>
                                        </div>
                                    </div>
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
                                    <form method="POST" action="{{ route('usuarios.store') }}">
                                        @csrf
                                        <div class="row col-xs-12 col-sm-12 col-md-12">
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">Nombre completo</label>
                                                <input type="text" name="name"
                                                    class="form-control border border-2 p-2" value=''>
                                                @error('name')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">E-mail</label>
                                                <input type="email" name="email"
                                                    class="form-control border border-2 p-2" value=''>
                                                @error('name')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">Teléfono</label>
                                                <input type="number" name="phone"
                                                    class="form-control border border-2 p-2" value=''>
                                                @error('phone')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">D.N.I.</label>
                                                <input type="text" name="dni"
                                                    class="form-control border border-2 p-2" value=''>
                                                @error('dni')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label">Contraseña</label>
                                                <div class="form-label">
                                                    <input type="password" name="password" id="password"
                                                        class="form-control border border-2 p-2" value=''>
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        id="togglePassword">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                                @error('password')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-4">
                                                <label class="form-label">Repetir contraseña</label>
                                                <div class="form-label">
                                                    <input type="password" name="confirm-password" id="confirm-password"
                                                        class="form-control border border-2 p-2" value=''>
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        id="toggleConfirmPassword">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                                @error('confirm-password')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label for="roles" class="text-start">Roles</label>
                                                <div class="col-md-6">
                                                    @foreach ($roles as $roleId => $roleName)
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="role_{{ $roleId }}"
                                                                name="roles[{{ $roleId }}]"
                                                                value='{{ $roleId }}'>
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
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm-password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
        });
        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
        });
    </script>
    <x-plugins></x-plugins>
</x-layout>
