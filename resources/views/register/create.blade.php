<x-layout bodyClass="">

    <div>
        <div class="container position-sticky z-index-sticky top-0">
            <div class="row">
                <div class="col-12">
                    <!-- Navbar -->
                    <x-navbars.navs.guest signin='login' signup='register'></x-navbars.navs.guest>
                    <!-- End Navbar -->
                </div>
            </div>
        </div>
        <main class="main-content  mt-0">
            <section>
                <div class="page-header min-vh-100">
                    <div class="container">
                        <div class="row">
                            <div
                                class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                                <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                                    style="background-image: url('../assets/img/illustrations/illustration-signup.jpg'); background-size: cover;">
                                </div>
                            </div>
                            <div
                                class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                                <div class="card card-plain">
                                    @if ($errors->any())
                                        <div class="alert alert-secondary">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>
                                                        <p class='text-white'>{{ $error }}</p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="card-header">
                                        <h4 class="font-weight-bolder">Registro</h4>
                                        <p class="mb-0">Ingrese su nombre completo, email y contraseña para
                                            registrarse</p>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="input-group input-group-outline mt-3">
                                                <label class="form-label">Nombre completo</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ old('name') }}">
                                            </div>
                                            @error('name')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                            <div class="input-group input-group-outline mt-3">
                                                <label class="form-label">Teléfono (sin 0 ni 15)</label>
                                                <input type="number" class="form-control" name="phone"
                                                    value="{{ old('phone') }}">
                                            </div>
                                            @error('name')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                            <div class="input-group input-group-outline mt-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ old('email') }}">
                                            </div>
                                            @error('email')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                            <div class="input-group input-group-outline mt-3">
                                                <label class="form-label">Contraseña</label>
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                            @error('password')
                                                <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                            <div class="form-check form-check-info text-start ps-0 mt-3">
                                                <input class="form-check-input" type="checkbox" id="terminos"
                                                    name="terminos">
                                                <label class="form-check-label" for="terminos">
                                                    Estoy de acuerdo con <a href="javascript:;"
                                                        class="text-dark font-weight-bolder">Términos y Condiciones</a>
                                                </label>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Registrarme</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                        <p class="mb-2 text-sm mx-auto">
                                            Ya tienes una cuenta?
                                            <a href="{{ route('login') }}"
                                                class="text-primary text-gradient font-weight-bold">Iniciar sesión</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    @push('js')
        <script src="{{ asset('assets') }}/js/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                // Espera a que el documento esté completamente cargado
                // Agrega un evento de escucha al formulario cuando se envía
                $('form').submit(function(event) {
                    // Evita que el formulario se envíe automáticamente
                    event.preventDefault();
                    // Verifica si el checkbox está marcado
                    var isChecked = $('#terminos').prop('checked');
                    // Si el checkbox está marcado, puedes realizar acciones aquí
                    if (isChecked) {
                        // Por ejemplo, aquí podrías enviar el formulario
                        $(this).unbind('submit').submit();
                    } else {
                        // Si el checkbox no está marcado, muestra un mensaje de error o realiza otra acción
                        //swal2('Debes aceptar los términos y condiciones.', 'warning');
                        Swal.fire({
                            title: 'Atención',
                            text: 'Debes aceptar los términos y condiciones para continuar.',
                            icon: 'warning',
                            confirmButtonText: 'Ok'
                        });
                    }
                });
            });
        </script>
    @endpush
</x-layout>
