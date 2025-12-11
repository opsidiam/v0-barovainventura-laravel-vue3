<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pripravení odísť??</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Ak ste pripravení ukončiť svoju aktuálnu reláciu, nižšie vyberte možnosť „Odhlásiť sa“</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Zrušiť</button>
                <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Odhlásiť sa') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>

{{--<div class="modal fade" id="AdminAddItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"--}}
{{--     aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="exampleModalLabel">Pridať produkt</h5>--}}
{{--                <button class="close" type="button" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">×</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <form action="{{route('admin.labels.add')}}" method="post">--}}
{{--                @csrf--}}
{{--                <div class="modal-body">--}}

{{--                    <h5>Povinne polia sú označene červenou hviezdičkou <i style="color: red">*</i></h5>--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                Názov <i style="color: red">*</i><input type="text" name="name" class="form-control" required>--}}
{{--                            </div>--}}
{{--                            <div class="col">--}}
{{--                                Objem <i style="color: red">*</i><input type="number" name="volume" class="form-control" required>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                % Alk. <i style="color: red">*</i><input type="number" name="alcohol" class="form-control" required>--}}
{{--                            </div>--}}
{{--                            <div class="col">--}}
{{--                                Značka <i style="color: red">*</i><input type="text" name="brand" class="form-control" required>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                Váha prázdneho balenia v g.<input type="number" name="weight_empty" class="form-control">--}}
{{--                            </div>--}}
{{--                            <div class="col">--}}
{{--                                Váha plného balenia v g. <input type="number" name="weight_full" class="form-control">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                EAN <i style="color: red">*</i><input type="text" name="ean" class="form-control" required>--}}
{{--                            </div>--}}
{{--                            <div class="col">--}}
{{--                                Tolerancia váhay v g. <input type="number" name="weight_tolerance" class="form-control">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button class="btn btn-primary" type="submit">{{ __('Vytvoriť') }}</button>--}}

{{--                </div>--}}
{{--            </form>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="modal fade" id="AdminAddEticetsEan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"--}}
{{--     aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="exampleModalLabel">Pridať etikety (EAN)</h5>--}}
{{--                <button class="close" type="button" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">×</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <form action="{{route('admin.labels.ean.add')}}" method="post">--}}
{{--                @csrf--}}
{{--                <div class="modal-body">--}}

{{--                    <h5>Povinne polia sú označene červenou hviezdičkou <i style="color: red">*</i></h5>--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                Názov balenia <i style="color: red">*</i><input type="text" name="name" class="form-control" required>--}}
{{--                            </div>--}}
{{--                            <div class="col">--}}
{{--                                Typ balenia<i style="color: red">*</i>--}}
{{--                                <select class="form-control" name="typ">--}}
{{--                                    <option value="1">VÁHA</option>--}}
{{--                                    <option value="2">SKENER</option>--}}
{{--                                    <option value="3">VÁHA+SKENER</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                Max vaha <i style="color: red">*</i><input type="number" name="max" class="form-control" value="5" required>--}}
{{--                            </div>--}}
{{--                            <div class="col">--}}
{{--                                Verzia <i style="color: red">*</i><input type="number" name="version" class="form-control" required>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button class="btn btn-primary" type="submit">{{ __('Vytvoriť') }}</button>--}}

{{--                </div>--}}
{{--            </form>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="modal fade" id="AdminAddEticetsQr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"--}}
{{--     aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="exampleModalLabel">Pridať etikety (QR)</h5>--}}
{{--                <button class="close" type="button" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">×</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <form action="{{route('admin.labels.qr.add')}}" method="post">--}}
{{--                @csrf--}}
{{--                <div class="modal-body">--}}

{{--                    <h5>Povinne polia sú označene červenou hviezdičkou <i style="color: red">*</i></h5>--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                Názov <i style="color: red">*</i><input type="text" name="name" class="form-control" required>--}}
{{--                            </div>--}}
{{--                            <div class="col">--}}
{{--                                Objem <i style="color: red">*</i><input type="number" name="volume" class="form-control" required>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                % Alk. <i style="color: red">*</i><input type="number" name="alcohol" class="form-control" required>--}}
{{--                            </div>--}}
{{--                            <div class="col">--}}
{{--                                Značka <i style="color: red">*</i><input type="text" name="brand" class="form-control" required>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                Váha prázdneho balenia v g.<input type="number" name="weight_empty" class="form-control">--}}
{{--                            </div>--}}
{{--                            <div class="col">--}}
{{--                                Váha plného balenia v g. <input type="number" name="weight_full" class="form-control">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                EAN <i style="color: red">*</i><input type="text" name="ean" class="form-control" required>--}}
{{--                            </div>--}}
{{--                            <div class="col">--}}
{{--                                Tolerancia váhay v g. <input type="number" name="weight_tolerance" class="form-control">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button class="btn btn-primary" type="submit">{{ __('Vytvoriť') }}</button>--}}

{{--                </div>--}}
{{--            </form>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="modal fade" id="AdminAddEticetsLogo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="exampleModalLabel">Pridať etikety (LOGO)</h5>--}}
{{--                <button class="close" type="button" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">×</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <form action="{{route('admin.labels.logo.create')}}" method="post">--}}
{{--                @csrf--}}
{{--                <div class="modal-body">--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button class="btn btn-primary" type="submit">{{ __('Vytvoriť') }}</button>--}}

{{--                </div>--}}
{{--            </form>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="modal fade" id="AdminAdd30dayFree" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"--}}
{{--     aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="exampleModalLabel">Pridať etikety (30 dni zadarmo)</h5>--}}
{{--                <button class="close" type="button" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">×</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--            <form action="{{route('admin.labels.30day.free')}}" method="post">--}}
{{--                @csrf--}}
{{--                    <button class="btn btn-primary" type="submit">{{ __('Vytvoriť') }} 1</button>--}}
{{--            </form>--}}
{{--            <form action="{{route('admin.labels.30day.free2')}}" method="post">--}}
{{--                @csrf--}}
{{--                    <button class="btn btn-primary" type="submit">{{ __('Vytvoriť') }} 2</button>--}}
{{--            </form>--}}


{{--        </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
