<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="cursos"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Cursos"></x-navbars.navs.auth>
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
                                                Nuevo curso
                                            </h5>
                                        </div>
                                    </div>
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
                                    @if ($errors->any())
                                        <div class="col-xs-12 col-sm-12 col-md-12 alert alert-dark alert-dismissible fade show"
                                            role="alert">
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
                                    <form method="POST" action="{{ route('cursos.store') }}">
                                        @csrf
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group col-md-12">
                                                <div class="mb-3">
                                                    <select class="form-select m" id="escuela_select" name="escuela_id"
                                                        data-placeholder="Seleccione una escuela">
                                                        <option value=""></option>
                                                        @foreach ($escuelas as $escuela)
                                                            <option value="{{ $escuela->id }}">
                                                                {{ $escuela->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <select class="form-select" id="asignatura_select"
                                                        name="asignatura_id"
                                                        data-placeholder="Seleccione una asignatura">
                                                        <option value=""></option>
                                                        @foreach ($asignaturas as $asignatura)
                                                            <option value="{{ $asignatura->id }}">
                                                                {{ $asignatura->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row col-xs-12 col-sm-12 col-md-12">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Año</label>
                                                <input type="text" name="nivel"
                                                    class="form-control border border-2 p-2" value=''>
                                                @error('nivel')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">División</label>
                                                <input type="text" name="division"
                                                    class="form-control border border-2 p-2" value=''>
                                                @error('division')
                                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label class="form-label">Observaciones</label>
                                                <textarea type="text" name="observaciones" class="form-control border border-2 p-2" value=''></textarea>
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
        $('#asignatura_select').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>
</x-layout>
