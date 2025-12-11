@include('app.layouts.emails.head')
<tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
        <center>
            <table cellspacing="0" cellpadding="0" width="600" class="w320">
                <tr>
                    <td class="header-lg">
                        @if($data['type'] == 'update_invoice_data' || $data['type'] == 'verify_invoice_email' || $data['type'] == 'invoice_product' || $data['type'] == 'invoice_license')
                            @if(Auth::user()->email_fa_name != null)
                                Vážená spoločnosť {{ Auth::user()->email_fa_name }}.
                            @else
                                Ahoj {{ Auth::user()->name }} {{ Auth::user()->surname }}.
                            @endif
                        @else
                            Ahoj {{ Auth::user()->name }} {{ Auth::user()->surname }}.
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="free-text">
                        @if($data['type'] == 'update_settings')
                            Táto emailová adresa bola nastavená ako predvolená adresa na ktorú budú zasielane dôležité informácie.<br><br><br><span style="font-size: 15px; font-weight: bold;">Boli vykonané následovne zmeny:</span><br>
                        @elseif($data['type'] == 'update_invoice_data')
                            Táto emailová adresa bola nastavená ako predvolená adresa na ktorú budú zasielane faktúry.<br><br><br><span style="font-size: 15px; font-weight: bold;">Boli vykonané následovne zmeny:</span><br>
                        @elseif($data['type'] == 'inventure_output')
                            Inventúra v podniku '.$data['bar_name'].' bola uzavretá.<br>V prílohe sa nachádza výstupný dokument inventúry.
                        @elseif($data['type'] == 'verify_email')
                            V prípade že sa jedna o vami zadanú požiadavku tak potvrďte tuto adresu kliknutím na nižšie uvedenú URL adresu.<br><a href="{{url('app/user/verify/email/')}}/{{$data['token']}}" target="_blank" style="color: #00b3ca">Potvrdiť túto e-mailovú adresu</a> <br><br><br>V prípade že sa nejedna o vami zadanú požiadavku tak tuto správu ignorujte.
                        @elseif($data['type'] == 'verify_invoice_email')
                            V prípade že sa jedna o vami zadanú požiadavku tak potvrďte tuto adresu kliknutím na nižšie uvedenú URL adresu.<br><a href="{{url('app/user/verify/invoice/email/')}}/{{$data['token']}}" target="_blank" style="color: #00b3ca">Potvrdiť túto e-mailovú adresu</a> <br><br><br>V prípade že sa nejedna o vami zadanú požiadavku tak tuto správu ignorujte.
                        @elseif($data['type'] == 'verify_invoice_email')
                            Faktúra v prílohe je riadny účtovný doklad a po vytlačení si ju môžete zaevidovať do účtovníctva. Daňový doklad v elektronickej forme je podľa Zákona o účtovníctve č. 431/2002 zo dňa 18. júna 2002, §32 "Preukázateľnosť účtovného záznamu" právoplatným daňovým dokladom. <br>
                            <br><br><br>V prípade že sa nejedna o vami zadanú požiadavku tak tuto správu ignorujte.
                        @endif
                        @if($data['type'] == 'update_settings' || $data['type'] == 'update_invoice_data' || $data['type'] == null)
                            @if(isset($data['data']))
                                @foreach($data['data'] as $d)

                                    {{$d[0]}} => {{$d[1]}}<br>
                                @endforeach
                            @endif
                        @endif
                    </td>
                </tr>

            </table>
        </center>
    </td>
</tr>
@if(isset($data['invoice_data']))
        <tr>
            <td class="w320">
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td class="mini-container-left">
                            <table cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td class="mini-block-padding">
                                        <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse:separate !important;">
                                            <tr>
                                                <td class="mini-block">
                                                    <span class="header-sm">Fakturačné údaje</span><br>
                                                    Meno: {{ $data['invoice_data']['invoice_name'] }}<br>
                                                    Adresa: {{ $data['invoice_data']['invoice_address'] }}<br>
                                                    PSČ: {{ $data['invoice_data']['invoice_psc'] }}<br>
                                                    Mesto: {{ $data['invoice_data']['invoice_city'] }}<br>
                                                    Stat: {{ $data['invoice_data']['invoice_stat'] }}<br>
                                                    ICO: {{ $data['invoice_data']['invoice_ico'] }}<br>
                                                    DIC: {{ $data['invoice_data']['invoice_dic'] }}<br>
                                                    IC DPH: {{ $data['invoice_data']['invoice_icdph'] }}<br>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
@endif
@include('app.layouts.emails.footer')

