<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="calendario"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Calendario"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3"><strong>Calendario</strong></h6>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('calendario.index') }}">
                            @csrf
                            <div class="card-body row col-xs-12 col-sm-12 col-md-12">
                                <select name="tipo_evento" id="tipo_evento" class="form-control">
                                    <option value="">Tipo de Eventos</option>
                                    @foreach ($tipos_evento as $tipo)
                                        <option value="{{ $tipo }}">
                                            {{ $tipo }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="calendar"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        locale: 'es',
                        //initialView: 'dayGridMonth',
                        initialView: 'multiMonthYear',
                        events: @json($eventos),

                        eventClick: function(info) {
                            Swal.fire({
                                //title: "Detalle",
                                text: info.event.title,
                                icon: "info"
                            });
                            /*alert('Event: ' + info.event.title);
                            alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                            alert('View: ' + info.view.type);*/

                            // change the border color just for fun
                            info.el.style.borderColor = 'red';
                        }

                    });
                    calendar.render();

                    // Agrega un evento de cambio al campo de selección
                    $('#tipo_evento').change(function() {
                        // Obtiene el valor seleccionado
                        var selectedType = $(this).val();

                        // Realiza una solicitud AJAX para obtener eventos según el tipo seleccionado
                        $.ajax({
                            url: '{{ route('calendario.fetchEvents') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                tipo_evento: selectedType
                            },
                            success: function(response) {
                                console.log('data', response);
                                // Actualiza el calendario con los nuevos eventos
                                calendar.removeAllEvents();
                                calendar.addEventSource(response.events);
                            },
                            error: function(error) {
                                console.error(error);
                            }
                        });
                    });
                });
            </script>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
