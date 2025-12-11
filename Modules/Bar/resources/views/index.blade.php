@extends('app.layouts.app')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Podniky</h1>
        </div>
        <div class="row">
            @foreach($bars as $key => $bar)
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div style="width: 100%;float: right; padding-left: 10px">
                            @if($license_active)
                                @if($key < $license_bar_count)
                                    <form method="post" action="{{route('bar.select')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$bar->id}}">
                                        <button style="float: left;" class="btn btn-success" type="submit">Vybrať</button>
                                    </form>
                                @else
                                    <small class="text-danger">
                                        <a href="{{route('license.index')}}">
                                            <button class="btn btn-sm btn-warning">Rozšíriť licenciu</button>
                                        </a>
                                        Limit podnikov: {{$license_bar_count}}
                                    </small>
                                @endif
                            @else
                                <small class="text-danger">
                                    <a href="{{route('license.index')}}">
                                        <button class="btn btn-sm btn-warning">Predĺžiť licenciu</button>
                                    </a>
                                    Licencia expirovala
                                </small>
                            @endif
                            <a href="#" data-toggle="modal" data-target="#deleteBarModal_{{$bar->id}}" style="float: right; padding-right: 10px;">
                                <span aria-hidden="true"><i class="fas fa-trash-alt text-danger"></i></span>
                            </a>
                            @if($key < $license_bar_count)
                                <a href="#" data-toggle="modal" data-target="#updateBarModal_{{$bar->id}}" style="float: right; padding-right: 10px;">
                                    <span aria-hidden="true"><i class="fas fa-edit"></i></span>
                                </a>
                            @endif
                        </div>

                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{$bar->address}} {{$bar->number}}, {{$bar->city}} {{$bar->psc}}</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$bar->name}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @if($license_bar_active)
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="#" data-toggle="modal" data-target="#addBarModal">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Pridaj svoj podnik</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-plus fa-2x text-blue-900"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @else
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{route('license.index')}}">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            @if($key < $license_bar_count)
                                                Predĺžiť licenciu
                                            @else
                                                Rozšíriť licenciu
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-plus fa-2x text-blue-900"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
    @if($tutorial_show)
        <script>
            Swal.fire({
                title: "<strong>Vitaj</strong>",
                html: `Vitaj v systéme <strong>Barová Inventúra</strong>.<br>
                   Tu sa nachádzajú podniky, ktoré sú tvoje. :)<br>
                   Pre pokračovanie je potrebné vytvoriť si podnik.`,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `
                <i class="fa fa-thumbs-up"></i> Chápem
            `,
                icon: "question"
            });
        </script>
    @endif
@endsection
