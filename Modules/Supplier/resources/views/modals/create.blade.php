<div class="modal fade" id="supplierAddNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pridať dodávateľa</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="{{route('supplier.store')}}" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <p>Vyplň informácie o dodávateľovi.<br>
                        {{__('user.mandatory_fields')}}</p>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="name" class="form-control" placeholder="Názov *" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="address" class="form-control" placeholder="Adresa" value="">
                            </div>
                            <div class="col-4">
                                <input type="text" name="address_number" class="form-control" placeholder="Číslo domu" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="city" class="form-control" placeholder="Mesto" value="">
                            </div>
                            <div class="col">
                                <input type="text" name="psc" class="form-control" placeholder="PSČ" value="">
                            </div>
                            <div class="col">
                                <input type="text" name="stat" class="form-control" placeholder="Štát" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="email" class="form-control" placeholder="E-Mail *" value=""  required>
                            </div>
                            <div class="col">
                                <input type="text" name="phone" class="form-control" placeholder="Tel.č" value="" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                Poznámka
                                <textarea class="form-control" name="note"></textarea>
                            </div>
                        </div>
                    </div></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Zrušiť</button>
                    <button class="btn btn-success" type="submit" >Pridať</button>
                </div>
            </form>
        </div>
    </div>

</div>
