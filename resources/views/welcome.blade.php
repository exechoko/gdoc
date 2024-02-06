<x-layout bodyClass="">
    <div class="page-header justify-content-center min-vh-100"
        style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container mt-5">
            <h1 class="text-light text-center">GDOC - Sistema de Gestión Docente</h1>
            <p class="text-light text-center lead">Optimiza tu experiencia educativa</p>
            <p class="text-light text-center lead">El Sistema de Gestión Docente (GDOC) es una plataforma integral diseñada para
                facilitar la gestión eficiente de la actividad docente, permitiendo a los educadores administrar de
                manera efectiva sus cursos, alumnos, evaluaciones, asistencias y mantener un calendario actualizado
                con información relevante.</p>
            <div class="text-center mb-4">
                <a href="{{ route('login') }}" class="btn btn-primary mx-2">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="btn btn-success mx-2">Registrarse</a>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Funcionalidades Principales</h2>

        <ul class="list-group">
            <li class="list-group-item">1. Gestión de Cursos:
                <ul>
                    <li>Los docentes pueden crear y administrar sus cursos de manera intuitiva.</li>
                    <li>Asignación de detalles del curso, como nombre, código, descripción y materia.</li>
                    <li>Posibilidad de definir fechas de inicio y finalización.</li>
                </ul>
            </li>

            <li class="list-group-item">2. Registro de Alumnos:
                <ul>
                    <li>Funcionalidad para añadir y gestionar la información de los alumnos inscritos en cada curso.</li>
                    <li>Almacenamiento de datos personales, información de contacto y detalles académicos.</li>
                </ul>
            </li>

            <li class="list-group-item">3. Calendario Integrado:
                <ul>
                    <li>Visualización de un calendario que muestra fechas importantes, como exámenes, entregas de proyectos y eventos académicos.</li>
                    <li>La capacidad de agregar eventos y recordatorios para mantener a los docentes informados sobre sus responsabilidades.</li>
                </ul>
            </li>

            <!-- Include other functionality points similarly -->

        </ul>
    </div>

    <x-footers.guest></x-footers.guest>
</x-layout>
