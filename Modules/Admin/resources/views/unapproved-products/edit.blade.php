@extends('admin.layouts.app')

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">{{__('warehouse.product-detail')}}</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    {{--                    <div class="card-header py-3">--}}
                    {{--                        <button class="btn btn-success" data-toggle="modal" data-target="#AdminAddItem">Pridať produkt</button>--}}
                    {{--                    </div>--}}
                    <div class="card-body col-xl-12 col-sm-6">
                        <form action="{{route('admin.unapproved-products.update',$cargo)}}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <h2>Produkt: {{$cargo->name}}</h2>
                                </div>
                                <input type="hidden" name="id" value="{{$cargo->id}}">
                                <div class="col-xl-6 col-sm-12">
                                    <label for="basic-url" class="form-label">Name</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="name" value="{{$cargo->name}}" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-sm-12">
                                    <label for="basic-url" class="form-label">Vyrobca</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="brand" value="{{$cargo->brand}}" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-12">
                                    <label for="basic-url" class="form-label">Typ</label>
                                    <div class="input-group mb-3">
                                        <select class="form-control" name="type">
                                            <option @if($cargo->type == 0) selected @endif value="0">Rozlievaný</option>
                                            <option @if($cargo->type == 1) selected @endif value="1">Kusový</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-12">
                                    <label for="basic-url" class="form-label">Objem / Váha</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="volume" value="{{$cargo->volume ?? null}}" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                        <span class="input-group-text">.ml / .g</span>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-12">
                                    <label for="basic-url" class="form-label">Alcohol</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="alcohol" value="{{$cargo->alcohol ?? null}}" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-12">
                                    <label for="basic-url" class="form-label">Váha plného obalu</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="weight_full" value="{{$cargo->weight_full ?? null}}" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                        <span class="input-group-text">.g (gram)</span>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-12">
                                    <label for="basic-url" class="form-label">Váha prázdneho obalu</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="weight_empty" value="{{$cargo->weight_empty ?? null}}" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                        <span class="input-group-text">.g (gram)</span>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-12">
                                    <label for="basic-url" class="form-label">Tolerancia váhy obalu </label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="weight_tolerance" value="{{$cargo->weight_tolerance ?? null}}" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                        <span class="input-group-text">.g (gram)</span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-sm-12">
                                    <label for="basic-url" class="form-label" style="color: white">.</label>
                                    <button type="submit" class="btn btn-block btn-xl btn-success">Uložiť</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
    </div>
@endsection

@section('js')
@endsection
