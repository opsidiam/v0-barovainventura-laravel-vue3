<tr>
    <td align="center" valign="top" width="100%" style="background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;">
        <center>
            <table cellpadding="0" cellspacing="0" width="600" class="w320">
                <tr>
                    <td class="content-padding">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td class="header-md">
                                    Ako na to?
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:separate !important;">
                            <tr>
                                <td class="info-block">
                                    <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:separate !important;">
                                        <tr>
                                            <td class="block-rounded">
                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td class="info-img">
                                                            <img class="info-img" src="{{ asset('img/email-ean.jpg') }}" alt="img" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 15px;">
                                                            <table cellspacing="0" cellpadding="0" width="100%">
                                                                <tr>
                                                                    <td style="text-align:center; width:155px">
                                                                        <span class="header-sm">Naskenuj</span>
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
                                <td class="info-block">
                                    <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:separate !important;">
                                        <tr>
                                            <td class="block-rounded">
                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td class="info-img">
                                                            <img class="info-img" src="{{ asset('img/email-vaha.jpg') }}" alt="img" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 15px;">
                                                            <table cellspacing="0" cellpadding="0" width="100%">
                                                                <tr>
                                                                    <td style="text-align:center; width:155px">
                                                                        <span class="header-sm">Odváž</span>
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
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="content-padding">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td class="header-md">
                                    Hotovo!
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </center>
    </td>
</tr>
<tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7; height: 100px;">
        <center>
            <table cellspacing="0" cellpadding="0" width="600" class="w320">
                <tr>
                    <td style="padding: 25px 0 25px">
                        <strong><a href="https://web-place.sk">WebPlace s.r.o</a></strong><br>
                        <strong><a href="{{route('home')}}">www.BarovaInventura.sk</a></strong>
                    </td>
                </tr>
            </table>
        </center>
    </td>
</tr>

<tr>
    <td>
        <p style="font-size: 8px; text-align: center; line-height: 10px">
            Všetky práva vyhradené<br>
            Informácie obsiahnuté v tejto správe a jej prílohách sú dôverné, sú určené výlučne pre potreby jeho adresáta (adresátov) a sú/môžu byť obchodným tajomstvom alebo sú/môžu byť právne chránené podľa iných právnych predpisov.
            <br><br>
            Ochrana osobných údajov<br>
            Dovoľujeme si Vás informovať, že všetky Vami poskytnuté osobné údaje, ktoré budú spracovávané našou spoločnosťou budú realizované v súlade s ustanovením § 13 ods. 1 Písm. a) zákona č. 18/2018 Z. z. o ochrane osobných údajov a o zmene a doplnení niektorých zákonov. Ak máte záujem o bližšie informácie, obráťte sa na naše telefónne číslo, e-mailovú adresu.
            <br><br>
            Upozornenie: Táto správa je určená výlučne jej adresátovi. Informácie a údaje, ktoré sú v nej uvedené, alebo ktoré sú obsiahnuté v jej priložených súboroch, môžu byť informáciami alebo údajmi chránenými podľa platných právnych predpisov v Slovenskej republike. V prípade, ak nie ste určený ako prijímateľ tochto e-mailu alebo jeho oprávnený zástupca, upozorňujeme Vás, že informácie a údaje v nej uvedené nie ste oprávnený spracúvať, ani ich sprístupniť alebo poskytnúť tretej osobe alebo ich zverejniť. Ak ste nedopatrením prijali alebo zachytili tento e-mail, dovoľujeme si Vás požiadať, aby ste následne e-mail vrátane všetkých kópii vymazali z Vášho počítača a z Vašej e-mailovej schránky a zničili všetky jej výtlačky.
            <br><br>
            Všetky práva vyhradené.
            @if(Auth::check() || isset($data['user']))
                Táto správa je určená výlučne adresátovi {{Auth::user()->name ?? $data['user']['name']}} {{Auth::user()->surname ?? $data['user']['surname']}} na e-mail '{{Auth::user()->email_info ?? $data['user']['email_info']}}.
            @endif

        </p>
    </td>
</tr>
</table>
</body>
</html>
