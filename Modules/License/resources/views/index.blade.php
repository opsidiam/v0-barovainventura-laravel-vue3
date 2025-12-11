@extends('app.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Dostupné licencie</h1>

                <div class="row">
                    <!-- Licencie -->
                    @foreach($licenses as $license)
                        <div class="col-md-3 mb-4">
                            <div class="card h-100 shadow">
                                <div class="card-header bg-primary text-white">
                                    <h4 class="my-0 font-weight-normal text-center">{{ $license->name }}</h4>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h2 class="card-title pricing-card-title text-center py-3">{{ format_short_price($license->price) }}</h2>
                                    <ul class="list-unstyled mt-3 mb-4 flex-grow-1">
                                        <li class="py-1"><i class="fas fa-calendar-alt mr-2 text-primary"></i> Doba: {{ $license->time / 86400 }} dní</li>
                                        <li class="py-1"><i class="fas fa-store mr-2 text-primary"></i> Počet podnikov: 1</li>
                                        <li class="py-1"><i class="fas fa-check-circle mr-2 text-primary"></i> Prístup: Plný</li>
                                        <li class="py-1"><i class="fas fa-envelope mr-2 text-primary"></i> Notifikácie e-mailom: Áno</li>
                                        <li class="py-1"><i class="fas fa-file-pdf mr-2 text-primary"></i> PDF výstup: Áno</li>
                                    </ul>
                                    <form action="{{ route('license.select') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $license->id }}">
                                        <button type="submit" class="btn btn-primary btn-block mt-auto py-2">
                                            <i class="fas fa-shopping-cart mr-2"></i> Kúpiť
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Plán na mieru -->
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow">
                            <div class="card-header bg-primary text-white">
                                <h4 class="my-0 font-weight-normal text-center">Plán na mieru</h4>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h2 class="card-title pricing-card-title text-center py-3">Od 20€</h2>
                                <form action="{{ route('license.select') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label><i class="fas fa-calendar-alt mr-2 text-primary"></i> Doba:</label>
                                        <select class="form-control mb-3" name="time" required>
                                            <option value="30">30 dní</option>
                                            <option value="360">360 dní</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label><i class="fas fa-store mr-2 text-primary"></i> Počet podnikov:</label>
                                        <input type="number" min="1" step="1" class="form-control" value="{{$barCount ?? '1'}}" name="count" required>
                                    </div>
                                    <ul class="list-unstyled mt-3 mb-4">
                                        <li class="py-1"><i class="fas fa-check-circle mr-2 text-primary"></i> Prístup: Plný</li>
                                        <li class="py-1"><i class="fas fa-envelope mr-2 text-primary"></i> Notifikácie e-mailom: Áno</li>
                                        <li class="py-1"><i class="fas fa-file-pdf mr-2 text-primary"></i> PDF výstup: Áno</li>
                                    </ul>
                                    <button type="submit" class="btn btn-primary btn-block mt-auto py-2">
                                        <i class="fas fa-shopping-cart mr-2"></i> Kúpiť
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
