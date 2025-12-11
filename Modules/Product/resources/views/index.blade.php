@extends('app.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Produkty</h1>
                    @isset($money)
                        <a href="{{ route('product.cart') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-cart mr-2"></i> Nákupný košík
                        </a>
                    @endisset
                </div>

                <!-- Products Grid -->
                <div class="row">
                    @forelse($products as $product)
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <div class="card shadow-sm h-100">
                                <!-- Product Image -->
                                <div class="product-image-container">
                                    <img src="{{ $product->img }}" class="card-img-top" alt="{{ $product->name }}">
                                </div>

                                <!-- Product Body -->
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title font-weight-bold">{{ $product->name }}</h5>
                                    <div class="card-text mb-3 flex-grow-1">
                                        {!! $product->short_description !!}
                                    </div>

                                    <!-- Price -->
                                    <div class="border-top pt-3">
                                        <h4 class="text-primary font-weight-bold mb-3">{{ $product->price }}€</h4>
                                    </div>

                                    <!-- Action Button -->
                                    <a href="{{ route('product.add-to-cart', $product->id) }}"
                                       class="btn btn-outline-primary btn-block mt-auto">
                                        <i class="fas fa-cart-plus mr-2"></i> Pridať do košíka
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info">
                                Momentálne žiadne produkty nie sú k dispozícii.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 10px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .product-image-container {
            height: 200px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px 10px 0 0;
        }

        .card-img-top {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        .card-title {
            min-height: 3rem;
        }
    </style>
@endsection
