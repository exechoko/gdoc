<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="alumnos"></x-navbars.sidebar>
    <!-- Mensajes de éxito y error -->
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Alumnos"></x-navbars.navs.auth>
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
                                                Editar alumno
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
                                    <form method="POST" action="{{ route('alumnos.update', $alumno->id) }}">
                                        @method('PATCH')
                                        @csrf
                                        <div class="row col-xs-12 col-sm-12 col-md-12">
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">Apellido</label>
                                                <input type="text" name="apellido"
                                                    class="form-control border border-2 p-2"
                                                    value='{{ $alumno->apellido }}'>
                                                @error('apellido')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">Nombre completo</label>
                                                <input type="text" name="nombre"
                                                    class="form-control border border-2 p-2"
                                                    value='{{ $alumno->nombre }}'>
                                                @error('nombre')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">D.N.I.</label>
                                                <input type="number" name="dni"
                                                    class="form-control border border-2 p-2"
                                                    value='{{ $alumno->dni }}'>
                                                @error('dni')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label>Fecha de nacimiento</label>
                                                <input type="date" name="fecha_nacimiento" class="form-control"
                                                    value='{{ $alumno->fecha_nacimiento }}'>
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">E-mail</label>
                                                <input type="email" name="email"
                                                    class="form-control border border-2 p-2"
                                                    value='{{ $alumno->email }}'>
                                                @error('email')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">Teléfono</label>
                                                <input type="number" name="telefono"
                                                    class="form-control border border-2 p-2"
                                                    value='{{ $alumno->telefono }}'>
                                                @error('telefono')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">Dirección</label>
                                                <input type="text" name="direccion"
                                                    class="form-control border border-2 p-2"
                                                    value='{{ $alumno->direccion }}'>
                                                @error('direccion')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">Ciudad</label>
                                                <input type="text" name="ciudad"
                                                    class="form-control border border-2 p-2"
                                                    value='{{ $alumno->ciudad }}'>
                                                @error('ciudad')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">Provincia</label>
                                                <input type="text" name="provincia"
                                                    class="form-control border border-2 p-2"
                                                    value='{{ $alumno->provincia }}'>
                                                @error('provincia')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-3">
                                                <label class="form-label">Pais</label>
                                                <input type="text" name="pais"
                                                    class="form-control border border-2 p-2"
                                                    value='{{ $alumno->pais }}'>
                                                @error('pais')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">Escuela</label>
                                                    <select class="form-select m" id="escuela_select" name="escuela_id"
                                                        data-placeholder="Seleccione una escuela">
                                                        <option value="{{ $alumno->escuela->id }}">
                                                            {{ $alumno->escuela->nombre }}</option>
                                                        @foreach ($escuelas as $escuela)
                                                            <option value="{{ $escuela->id }}">
                                                                {{ $escuela->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label">Curso</label>
                                                    <select class="form-select m" id="curso_select" name="curso_id"
                                                        data-placeholder="Seleccione un curso">
                                                        <option value="{{ $alumno->curso->id }}">
                                                            {{ $alumno->curso->nivel }} {{ $alumno->curso->division }}
                                                        </option>
                                                        @foreach ($cursos as $curso)
                                                            <option value="{{ $curso->id }}">
                                                                {{ $curso->nivel }} {{ $curso->division }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Observaciones</label>
                                                <textarea type="text" name="observaciones" class="form-control border border-2 p-2"
                                                    value='{{ $alumno->observaciones }}'></textarea>
                                                @error('observaciones')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
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
    <script>
        $('#escuela_select').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
        $('#curso_select').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>
</x-layout>
