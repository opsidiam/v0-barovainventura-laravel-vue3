@include('app.layouts.emails.head')
<tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
        <center>
            <table cellspacing="0" cellpadding="0" width="600" class="w320">
                <tr>
                    <td class="header-lg">
                        @if($data['type'] == 'update_invoice_data' || $data['type'] == 'verify_invoice_email')
                            @if(Auth::user()->invoice_company_name != null)
                                Vážená spoločnosť {{ Auth::user()->invoice_company_name }}.
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
                        @elseif($data['type'] == 'verify_email')
                            Týmto potvrďte, že chcete na túto e-mailovú adresu dostávať uzavreté inventúry a dôležité oznámenia z aplikácie <strong>Barová Inventúra</strong>.<br>
                            V prípade že sa jedna o vami zadanú požiadavku tak potvrďte tuto adresu kliknutím na nižšie uvedenú URL adresu.<br><a href="{{route('user.verify.email',$data['token'])}}" target="_blank" style="color: #00b3ca">Potvrdiť túto e-mailovú adresu</a> <br><br><br>V prípade že sa nejedna o vami zadanú požiadavku tak tuto správu ignorujte.
                        @elseif($data['type'] == 'verify_invoice_email')
                            Týmto potvrďte, že chcete na túto e-mailovú adresu dostávať faktúry z aplikácie <strong>Barová Inventúra</strong>.<br>
                            V prípade že sa jedna o vami zadanú požiadavku tak potvrďte tuto adresu kliknutím na nižšie uvedenú URL adresu.<br><a href="{{route('user.verify.invoice',$data['token'])}}" target="_blank" style="color: #00b3ca">Potvrdiť túto e-mailovú adresu</a> <br><br><br>V prípade že sa nejedna o vami zadanú požiadavku tak tuto správu ignorujte.
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
@include('app.layouts.emails.footer')

