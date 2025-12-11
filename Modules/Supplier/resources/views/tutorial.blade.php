@extends('app.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Dostupné návody</h1>

                <div class="row">
                    <!-- Licencie -->
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow">
                            <div class="card-header bg-primary text-white">
                                <h4 class="my-0 font-weight-normal text-center">Začiatok a prihlásenie</h4>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h2 class="card-title pricing-card-title text-center py-3">Prihlásenie do aplikácie</h2>
                                <ul class="list-unstyled mt-3 mb-4 flex-grow-1">
                                    <li class="py-1"> Prihlásenie do administrácie</li>
                                    <li class="py-1"> Vytvorenie inventúry</li>
                                    <li class="py-1"> Prihlásenie do aplikácie</li>
                                </ul>
                                <button type="button" class="btn btn-primary btn-block mt-auto py-2" id="startStocktake">
                                    <i class="fas fa-eye mr-2"></i> Pustiť video
                                </button>
                            </div>
                        </div>
                    </div> <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow">
                            <div class="card-header bg-primary text-white">
                                <h4 class="my-0 font-weight-normal text-center">Inštalácia</h4>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h2 class="card-title pricing-card-title text-center py-3">Inštalácia PC aplikácie</h2>
                                <ul class="list-unstyled mt-3 mb-4 flex-grow-1">
                                    <li class="py-1">Stiahnutie PC aplikácie</li>
                                    <li class="py-1">Povolenie defenderu</li>
                                    <li class="py-1">Inštalácia PC aplikácie</li>
                                </ul>
                                <button type="button" class="btn btn-primary btn-block mt-auto py-2" id="install">
                                    <i class="fas fa-eye mr-2"></i> Pustiť video
                                </button>
                            </div>
                        </div>
                    </div> <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow">
                            <div class="card-header bg-primary text-white">
                                <h4 class="my-0 font-weight-normal text-center">Váha</h4>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h2 class="card-title pricing-card-title text-center py-3">Kalibrácia váhy</h2>
                                <ul class="list-unstyled mt-3 mb-4 flex-grow-1">
                                    <li class="py-1">Predstavenie váhy BI V2</li>
                                    <li class="py-1">Kalibrácia váhy</li>
                                    <li class="py-1">Kontrola kalibrácie</li>
                                </ul>
                                <button type="button" class="btn btn-primary btn-block mt-auto py-2" id="weight">
                                    <i class="fas fa-eye mr-2"></i> Pustiť video
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#startStocktake').click(function() {
                Swal.fire({
                    title: '<strong>Začiatok a prihlásenie</strong>',
                    icon: 'info',
                    width: '50rem',
                    html:
                        '<iframe width="560" height="315" src="https://www.youtube.com/embed/9p0-TTMRJ8g?autoplay=1&mute=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText:
                        '<i class="fa fa-thumbs-up"></i> Chápem',
                })
            });
            $('#install').click(function() {
                Swal.fire({
                    title: '<strong>Inštalácia</strong>',
                    icon: 'info',
                    width: '50rem',
                    html:
                        '<iframe width="560" height="315" src="https://www.youtube.com/embed/-CT2UDn5JjY?autoplay=1&mute=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText:
                        '<i class="fa fa-thumbs-up"></i> Chápem',
                })
            });
            $('#weight').click(function() {
                Swal.fire({
                    title: '<strong>Kalibrácia váhy</strong>',
                    icon: 'info',
                    width: '50rem',
                    html:
                        '<iframe width="560" height="315" src="https://www.youtube.com/embed/_nCp19VkxzQ?autoplay=1&mute=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                    showCloseButton: true,
                    showCancelButton: false,
                    focusConfirm: false,
                    confirmButtonText:
                        '<i class="fa fa-thumbs-up"></i> Chápem',
                })
            });
        });
    </script>
@endsection
@section('css')
    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .pricing-card-title {
            font-size: 2rem;
            color: #2c3e50;
        }
        .list-unstyled li {
            border-bottom: 1px solid #f0f0f0;
            padding: 8px 0;
        }
    </style>
@endsection
