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

<div class="modal fade" id="discontCode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Použiť zľavový kód</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="{{route('user.code.post')}}">
            <div class="modal-body">
            @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <input type="text" name="code" class="form-control" placeholder="Zľavový kód" value="" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Zrušiť</button>
                <button class="btn btn-success" type="submit" >Pridať</button>
            </div>
        </form>
        </div>
    </div>
</div>



<div class="modal fade" id="addBarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pridať podnik</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="{{route('bar.store')}}">
                @csrf
            <div class="modal-body">
                <p>Vyplň informácie o podniku.</p>

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <input type="text" name="name" class="form-control" placeholder="Názov" required>
                        </div>
                        <div class="col">
                            <input type="text" name="address" class="form-control" placeholder="Adresa" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <input type="text" name="number" class="form-control" placeholder="Číslo domu" required>
                        </div>
                        <div class="col">
                            <input type="text" name="city" class="form-control" placeholder="Mesto" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <input type="text" name="psc" class="form-control" placeholder="PSČ" required>
                        </div>
                        <div class="col">
                            <input type="text" name="country" class="form-control" placeholder="Štát" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <input type="text" name="chef" class="form-control" placeholder="Vedúci/a" required>
                        </div>
                        <div class="col">
                            <input type="text" name="phone" class="form-control" placeholder="Tel.č" required>
                        </div>
                    </div>
                </div></div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Zrušiť</button>
                <button class="btn btn-success" type="submit" >Vytvoriť</button>

            </div>
            </form>
        </div>
    </div>
</div>

@if (isset($bars))
    @foreach($bars as $bar)
        <div class="modal fade" id="deleteBarModal_{{$bar->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteBarModal_{{$bar->id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Si si istí/a??</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Týmto vymažeš podnik aj so všetkými inventúrami aj s celím skladom</div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">Zrušiť</button>
                        <a class="btn btn-danger" href="{{ route('bar.destroy', $bar->id) }}" onclick="event.preventDefault();document.getElementById('deletebar-form').submit();">{{ __('Vymazať') }}</a>
                        <form id="deletebar-form" action="{{ route('bar.destroy', $bar->id) }}" method="POST" class="d-none">
                            @method('DELETE')
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="updateBarModal_{{$bar->id}}" tabindex="-1" role="dialog" aria-labelledby="updateBarModal_{{$bar->id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upraviť podnik</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form method="post" action="{{route('bar.update', $bar->id)}}">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <p>Vyplň informácie o podniku.</p>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="name" class="form-control" placeholder="Názov" value="{{$bar->name}}" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="address" class="form-control" placeholder="Adresa" value="{{$bar->address}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="number" class="form-control" placeholder="Číslo domu" value="{{$bar->number}}" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="city" class="form-control" placeholder="Mesto" value="{{$bar->city}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="psc" class="form-control" placeholder="PSČ" value="{{$bar->psc}}" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="country" class="form-control" placeholder="Štát" value="{{$bar->country}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="chef" class="form-control" placeholder="Vedúci/a" value="{{$bar->chef}}" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="phone" class="form-control" placeholder="Tel.č" value="{{$bar->phone}}" required>
                                    </div>
                                </div>
                            </div></div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Zrušiť</button>
                            <button class="btn btn-success" type="submit" >Vytvoriť</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif

@if(isset($users))
    @foreach($users as $user)
        <div class="modal fade" id="deleteUserModal_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteUserModal_{{$user->id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Si si istí/a??</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Týmto vymažeš zamestnanca z tejto inventúry</div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">Zrušiť</button>
                        <a class="btn btn-danger" href="{{ route('stocktake.user.delete') }}" onclick="event.preventDefault();document.getElementById('deletebar-form-delete-user_{{$user->id}}').submit();">{{ __('Vymazať') }}</a>
                        <form id="deletebar-form-delete-user_{{$user->id}}" action="{{ route('stocktake.user.delete') }}" method="POST" class="d-none">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <input type="hidden" name="inv" value="{{$user->inv}}">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

@if(isset($open_inventure))
    @foreach($open_inventure as $open)
        <div class="modal fade" id="deleteInventureModal_{{$open->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteInventureModal_{{$open->id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Si si istí/a??</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Týmto vymažeš inventúru (ID: {{$open->id}}) aj s dátamy.</div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">Zrušiť</button>
                        <a class="btn btn-danger" href="{{ route('post.delete.inventure') }}" onclick="event.preventDefault();document.getElementById('deletebar-form-inv_{{$open->id}}').submit();">{{ __('Vymazať') }}</a>
                        <form id="deletebar-form-inv_{{$open->id}}" action="{{ route('post.delete.inventure') }}" method="POST" class="d-none">
                            <input type="hidden" name="id" value="{{$open->id}}">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

@if(isset($stocktake))
    <div class="modal fade" id="closeInvModal" tabindex="-1" role="dialog" aria-labelledby="closeInvModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Si si istí/a??</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Týmto uzavrieš inventúru (ID: {{$stocktake->id}}) aj s dátamy.<br>Po uzavretí sa všetky údaje uložia a nebude možné ich ďalej upravovať.</div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Zrušiť</button>
                    <a class="btn btn-danger" href="{{ route('stocktake.data.close') }}" onclick="event.preventDefault();document.getElementById('closebar-form-inv_{{$stocktake->id}}').submit();">{{ __('Uzavrieť inventúru') }}</a>
                    <form id="closebar-form-inv_{{$stocktake->id}}" action="{{ route('stocktake.data.close') }}" method="POST" class="d-none">
                        <input type="hidden" name="id" value="{{$stocktake->id}}">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteInvModal" tabindex="-1" role="dialog" aria-labelledby="closeInvModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Si si istí/a??</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Týmto vymažeš inventúru (ID: {{$stocktake->id}}) aj s dátamy.</div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Zrušiť</button>
                    <a class="btn btn-danger" href="{{ route('stocktake.destroy',$stocktake->id) }}" onclick="event.preventDefault();document.getElementById('deletebar-form-inv_{{$stocktake->id}}').submit();">{{ __('Vymazať inventúru') }}</a>
                    <form id="deletebar-form-inv_{{$stocktake->id}}" action="{{ route('stocktake.destroy',$stocktake->id) }}" method="POST" class="d-none">
                        @method('DELETE')
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

@if(isset($employees))
    @foreach($employees as $employee)
        <div class="modal fade" id="detailEmployeeEditModal_{{$employee->id}}" tabindex="-1" role="dialog" aria-labelledby="closeInvModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('employees.edit', ['name' => $employee->name])}}</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form method="post" action="{{route('user.employees.update',$employee->id)}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$employee->id}}">
                        <div class="modal-body">
                            <p>{{__('user.write_info')}}</p>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="name" class="form-control" placeholder="{{__('employees.table.name')}}*" value="{{$employee->name ?? null}}"  required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input type="email" name="email" class="form-control" placeholder="{{__('employees.table.email')}}*" value="{{$employee->email ?? null}}"  required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="app_pass" class="form-control" placeholder="{{__('employees.table.inv_pass')}}*" value="{{$employee->app_pass ?? null}}"  required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">{{__('user.close')}}</button>
                            <button class="btn btn-success" type="submit" >{{__('user.add')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteEmployeeModal_{{$employee->id}}" tabindex="-1" role="dialog" aria-labelledby="closeInvModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('user.sure')}}</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">{{__('employees.delete_description', ['name' => $employee->name])}}</div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">{{__('user.close')}}</button>
                        <a class="btn btn-danger" href="{{ route('user.employees.delete',$employee->id) }}" onclick="event.preventDefault();document.getElementById('deletebar-form-employees_{{$employee->id}}').submit();">{{__('employees.button.delete')}}</a>
                        <form id="deletebar-form-employees_{{$employee->id}}" action="{{ route('user.employees.delete',$employee->id) }}" method="POST" class="d-none">
                            <input type="hidden" name="id" value="{{$employee->id}}">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
<div class="modal fade" id="autoLogoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ste odhlásený/á.</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>Boli ste automaticky odhlásený/á.</h3>
                <p>
                    Dôvod:<br>
                     - Nečinnosť viac ako 10 minút
                </p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Prihlásiť sa') }}</a>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="UserAddItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pridať rozlievaný produkt</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="{{route('item.store')}}">
                @csrf
                <div class="modal-body">
                    <p>
                        <b>"Otvorená fľaša"</b> - Objem otvorenej fľaše zadajte v gramoch. (Ak nie je otvorená žiadna fľaša tak zadajte 0)<br>
                        <b>"Fľaše"</b> - Zadajte počet neotvorených fliaš.<br>
                        <b>"Cena plnej fľaše"</b> - Zadajte vašu nákupnú cenu flaše.<br>
                        <b>"Predajná cena poháriku"</b> - Zadajte vašu predajnú cenu pohariku (Cena štandardne pre obsah 0.4 dl).<br>
                        <b>"Obsah poháriku"</b> - Zadajte obsah v mililitroch (10 ml = 0.1 dl).<br>
                        <br>
                        {{__('user.mandatory_fields')}}
                    </p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <select class="js-example-basic-single form-control" id="live_search_cargo_list" name="cargo_id" required></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <select class="js-example-basic-single form-control" id="live_search_service_list" name="service_id"></select>
                                </div>
                            </div>
                            <div class="col">
                                <input type="text" minlength="1" name="open_botle" class="form-control" placeholder="Otvorená fľaša (g)">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="text" minlength="1" name="price_buy" class="form-control" placeholder="Cena plnej fľaše (€)">
                            </div>
                            <div class="col">
                                <input type="text" minlength="1" name="price_sell" class="form-control" placeholder="Predajná cena poháriku (€)">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="text" minlength="1" name="weight_sell" class="form-control" placeholder="Obsah poháriku (ml)">
                            </div>
                            <div class="col">
                                <input type="text" name="botle" class="form-control" placeholder="Fľaše (ks)">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="product_key_supplier" class="form-control" placeholder="Kód produktu dodávateľa">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">{{ __('Pridať produkt') }}</button>
                </div>
            </form>
        </div>
    </div>

</div>

<div class="modal fade" id="UserAddItemNoAlko" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pridať nerozlievaný produkt</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="{{route('item.store')}}">
                @csrf
                <div class="modal-body">
                    <p>
                        <b>"Produkty"</b> - Zadajte počet kusov na sklade.<br>
                        <b>"Cena poduktu"</b> - Zadajte vašu nákupnú cenu produktu za kus.<br>
                        <b>"Predajná cena poduktu"</b> - Zadajte vašu predajnú cenu poduktu za kus.<br>
                        <br>
                        {{__('user.mandatory_fields')}}
                    </p>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <select class="js-example-basic-single form-control" id="live_search_cargo_list_no_alko" name="cargo_id" required></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <select class="js-example-basic-single form-control" id="live_search_service_list_no_alko" name="service_id"></select>
                                </div>
                            </div>
                            <div class="col">
                                <input type="text" name="botle" class="form-control" placeholder="Produkty (ks)">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="text" minlength="1" name="price_buy" class="form-control" placeholder="Cena poduktu (€)">
                            </div>
                            <div class="col">
                                <input type="text" minlength="1" name="price_sell" class="form-control" placeholder="Predajná cena poduktu (€)">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="product_key_supplier" class="form-control" placeholder="Kód produktu dodávateľa">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">{{ __('Pridať produkt') }}</button>
                </div>
            </form>
        </div>
    </div>

</div>

<div id="detailScanModaladdItem"></div>
@if(isset($tovar))
    @foreach($tovar as $t)
        <div class="modal fade" id="addCargoDataModal_{{$t['id']}}" tabindex="-1" role="dialog" aria-labelledby="addCargoDataModal_{{$t['id']}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pomôž nám zlepšiť túto službu</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form id="form-Update-weight-full-empty_{{$t['id']}}" action="{{ route('user.inventure.update.post.weight.full.empty') }}" method="POST">
                    <div class="modal-body">
                        <p><span style="color: red; font-weight: bold">Údaje zadávajte pravdivo, v prípade zlého vyplnenie vám to môže spôsobiť zlé výsledky inventury / uzávierky..</span><br><br>Pre produkt: <b>{{$t['nazov']}}</b> nemáme doplnené nasledujúce údaje:<br></p>
                        <div class="form-group">
                            <div class="row">
                                @if($t['weight_full'] == null)
                                <div class="col-12">
                                    Zadajte váhu plnej fľaša (v gramoch)<br>
                                    <input type="number" name="weight_full" class="form-control">
                                </div>
                                @endif
                                @if($t['weight_empty'] == null)
                                <div class="col-12">
                                    <br>Zadajte váhu prázdnej fľaša (v gramoch)<br>
                                    <input type="number" name="weight_empty" class="form-control" >
                                </div>
                                    @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">Zrušiť</button>
                        <a class="btn btn-danger" href="{{ route('user.inventure.update.post.weight.full.empty') }}" onclick="event.preventDefault();document.getElementById('form-Update-weight-full-empty_{{$t['id']}}').submit();">{{ __('Aktualizovať') }}</a>
                            <input type="hidden" name="ean" value="{{$t['ean']}}">
                            @csrf
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif

@if(isset($close_inventure))
    @foreach($close_inventure as $close)
        <div class="modal fade" id="deleteLastInvModal_{{$close->id}}" tabindex="-1" role="dialog" aria-labelledby="closeInvModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Si si istí/a??</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Týmto vymažeš inventúru (ID: {{$close->id}}) aj s dátamy.</div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">Zrušiť</button>
                        <a class="btn btn-danger" href="{{ route('post.delete.inventure') }}" onclick="event.preventDefault();document.getElementById('deletebar-form-inv_{{$close->id}}').submit();">{{ __('Vymazať inventúru') }}</a>
                        <form id="deletebar-form-inv_{{$close->id}}" action="{{ route('user.inventure.delete.last.post') }}" method="POST" class="d-none">
                            <input type="hidden" name="id" value="{{$close->id}}">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif


{{--<div class="modal fade" id="employeesAddNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="exampleModalLabel">{{__('employees.button.add')}}</h5>--}}
{{--                <button class="close" type="button" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">×</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <form method="post" action="{{route('user.employees.create')}}">--}}
{{--                @csrf--}}
{{--                <div class="modal-body">--}}
{{--                    <p>{{__('user.write_info')}}<br>--}}
{{--                    {{__('user.mandatory_fields')}}<br>--}}
{{--                    {{__('employees.modal_info')}}</p>--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                <input type="text" name="name" class="form-control" placeholder="{{__('employees.table.name')}}*" value=""  required>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                <input type="email" name="email" class="form-control" placeholder="{{__('employees.table.email')}}*" value=""  required>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col">--}}
{{--                                <input type="text" name="app_pass" class="form-control" placeholder="{{__('employees.table.inv_pass')}}*" value=""  required>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button class="btn btn-secondary" type="button" data-dismiss="modal">{{__('user.close')}}</button>--}}
{{--                    <button class="btn btn-success" type="submit" >{{__('user.add')}}</button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--</div>--}}

@if(isset($items) and isset($ModalAddParametersDayCloser))
    @foreach($items as $item)
        <div class="modal fade" id="ModalAddParametersDayCloser_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ste odhlásený/á.</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <form id="form-Update-weight-full-empty_{{$item->id}}" action="{{ route('user.day.update.post.prices') }}" method="POST">
                        <div class="modal-body">
                            <p><span style="color: red; font-weight: bold">Údaje zadávajte pravdivo, v prípade zlého vyplnenie vám to môže spôsobiť zlé výsledky uzávierky .</span><br><br>Pre produkt: <b>{{$item->name}}</b> nemáme doplnené nasledujúce údaje:<br></p>
                            <div class="form-group">
                                <div class="row">
                                    @if($item->price_sell == null)
                                        @if($item->weight_sell == null)
                                            <div class="col-sm-6">
                                                Predajná cena pohárika<br>
                                                <input type="number" name="price_sell" class="form-control">
                                            </div>
                                            <div class="col-sm-6">
                                                Obsah pohárika v mililitroch<br>
                                                <input type="number" name="weight_sell" class="form-control" >
                                            </div>
                                            @if($item->price_buy == null)
                                                <div class="col-sm-12">
                                                    Nákupná cena fľaše<br>
                                                    <input type="number" name="price_buy" class="form-control">
                                                </div>
                                            @endif
                                        @else
                                            @if($item->price_buy == null)
                                                <div class="col-sm-6">
                                                    Predajná cena pohárika<br>
                                                    <input type="number" name="price_sell" class="form-control">
                                                </div>
                                                <div class="col-sm-6">
                                                    Nákupná cena fľaše<br>
                                                    <input type="number" name="price_buy" class="form-control">
                                                </div>
                                            @else
                                                <div class="col-sm-12">
                                                    Predajná cena pohárika<br>
                                                    <input type="number" name="price_sell" class="form-control">
                                                </div>
                                            @endif
                                        @endif
                                    @else
                                        @if($item->weight_sell == null)
                                            @if($item->price_buy == null)
                                                <div class="col-sm-6">
                                                    Nákupná cena fľaše<br>
                                                    <input type="number" name="price_buy" class="form-control">
                                                </div>
                                                <div class="col-sm-6">
                                                    Obsah pohárika v mililitroch<br>
                                                    <input type="number" name="weight_sell" class="form-control" >
                                                </div>
                                            @else
                                                <div class="col-sm-12">
                                                    Obsah pohárika v mililitroch<br>
                                                    <input type="number" name="weight_sell" class="form-control" >
                                                </div>
                                            @endif

                                        @else
                                            <div class="col-sm-12">
                                                Nákupná cena fľaše<br>
                                                <input type="number" name="price_buy" class="form-control">
                                            </div>
                                        @endif
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="button" data-dismiss="modal">Zrušiť</button>
                            <a class="btn btn-danger" href="{{ route('user.day.update.post.prices') }}" onclick="event.preventDefault();document.getElementById('form-Update-weight-full-empty_{{$item->id}}').submit();">{{ __('Aktualizovať') }}</a>
                            <input type="hidden" name="id_product" value="{{$item->id}}">
                            @csrf
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="detailItemDataModal_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="detailItemDataModal_{{$item->id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pomôž nám zlepšiť túto službu</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form id="form-Update-uzavierka-weight-full-empty_{{$item->id}}" action="{{ route('user.inventure.update.post.weight.full.empty') }}" method="POST">
                        <div class="modal-body">
                            <p><span style="color: red; font-weight: bold">Údaje zadávajte pravdivo, v prípade zlého vyplnenie vám to môže spôsobiť zlé výsledky inventury / uzávierky.</span><br><br>Pre produkt: <b>{{$item->name}}</b> nemáme doplnené nasledujúce údaje:<br></p>
                            <div class="form-group">
                                <div class="row">
                                    @if(!is_numeric($item->weight_full))
                                        <div class="col-12">
                                            Zadajte váhu plnej fľaša (v gramoch)<br>
                                            <input type="number" name="weight_full" class="form-control">
                                        </div>
                                    @endif
                                    @if(!is_numeric($item->weight_empty))
                                        <div class="col-12">
                                            <br>Zadajte váhu prázdnej fľaša (v gramoch)<br>
                                            <input type="number" name="weight_empty" class="form-control" >
                                        </div>
                                    @endif
                                        @if(!is_numeric($item->weight_tolerance))
                                            <div class="col-12">
                                                <br>Zadajte toleranciu váhy fľaša (v gramoch)<br>
                                                <input type="number" name="weight_tolerance" class="form-control" >
                                            </div>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="button" data-dismiss="modal">Zrušiť</button>
                            <a class="btn btn-danger" href="{{ route('user.inventure.update.post.weight.full.empty') }}" onclick="event.preventDefault();document.getElementById('form-Update-uzavierka-weight-full-empty_{{$item->id}}').submit();">{{ __('Aktualizovať') }}</a>
                            <input type="hidden" name="ean" value="{{$item->ean}}">
                            @csrf
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif

{{--<div class="modal fade" id="closeUzavierkuModal" tabindex="-1" role="dialog" aria-labelledby="closeInvModal" aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="exampleModalLabel">Si si istí/a??</h5>--}}
{{--                <button class="close" type="button" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">×</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">Týmto uzavrieš uzávierku aj s dátamy.</div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button class="btn btn-primary" type="button" data-dismiss="modal">Zrušiť</button>--}}
{{--                <a class="btn btn-success" href="{{ route('user.deadline.close.data') }}" onclick="event.preventDefault();document.getElementById('deadline_form').submit();">{{ __('Uzavrieť uzávierku') }}</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

