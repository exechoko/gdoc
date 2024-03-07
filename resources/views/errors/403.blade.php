<x-layout bodyClass="bg-gray-200">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <x-navbars.navs.guest signin='login' signup='register'></x-navbars.navs.guest>
                <!-- End Navbar -->
            </div>
        </div>
    </div>
    <div class="page-header justify-content-center min-vh-100"
        style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container text-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title text-light">403</h1>
                    <h2 class="text-light">Sin permisos </h2>
                    <h4 class="text-light">Ooooups! Su plan no lo permite.</h4>
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                        <i class="material-icons opacity-10">account_balance</i>
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <h4 class="text-center mb-0">Free</h4>
                                    <ul>
                                        <li>Administración de <strong>1</strong> curso</li>
                                        <li>Sin límite de estudiantes.</li>
                                    </ul>
                                    <hr class="horizontal dark my-3">
                                    <h5 class="mb-0">$0/mes</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                        <i class="material-icons opacity-10">payments</i>
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <h4 class="text-center mb-0">Premium</h4>
                                    <ul>
                                        <li>Administración de <strong>2</strong> cursos</li>
                                        <li>Sin límite de estudiantes.</li>
                                    </ul>
                                    <hr class="horizontal dark my-3">
                                    <h5 class="mb-0">$3.000/mes</h5>
                                    <hr class="horizontal dark my-3">
                                    <a href="https://www.mercadopago.com.ar/subscriptions/checkout?preapproval_plan_id=2c9380848d698da5018dadfdeafb2937" class="btn btn-success mx-2">Suscribirse</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                        <i class="material-icons opacity-10">payments</i>
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <h4 class="text-center mb-0">Pro</h4>
                                    <ul>
                                        <li><strong>Sin límites</strong> de cursos</li>
                                        <li>Sin límite de estudiantes.</li>
                                    </ul>
                                    <hr class="horizontal dark my-3">
                                    <h5 class="mb-0">$5.000/mes</h5>
                                    <hr class="horizontal dark my-3">
                                    <a href="https://www.mercadopago.com.ar/subscriptions/checkout?preapproval_plan_id=2c9380848d91c062018dadff189c0d69" class="btn btn-success mx-2">Suscribirse</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footers.guest></x-footers.guest>
</x-layout>
