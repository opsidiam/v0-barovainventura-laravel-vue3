@include('app.layouts.emails.head')

<tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
        <center>
            <table cellspacing="0" cellpadding="0" width="600" class="w320">
                <tr>
                    <td class="header-lg" style="padding-bottom: 15px; border-bottom: 2px solid #00b3ca;">
                        Ahoj {{ $user->name }} {{ $user->surname }}!
                    </td>
                </tr>
                <tr>
                    <td class="free-text" style="padding-top: 20px;">
                        <p style="margin-bottom: 20px; line-height: 1.6; color: #333;">
                            Vitajte v systéme <strong>Barová Inventúra</strong>! Váš účet bol úspešne vytvorený a čaká na aktiváciu v administrácii prevádzkovateľa.
                        </p>

                        <div style="background: #ffffff; border-radius: 5px; padding: 20px; margin-bottom: 25px; border-left: 4px solid #00b3ca;">
                            <h3 style="margin: 0 0 15px 0; color: #2c3e50; font-size: 18px;">Postup na prvú inventúru:</h3>

                            <ol style="margin-left: 20px; padding-left: 0; line-height: 1.6; color: #333;">
                                <li style="margin-bottom: 12px; padding-left: 5px;">
                                    <strong style="color: #00b3ca;">Vytvorenie podniku</strong><br>
                                    Prejdite do administrácie na stránke <a href="{{route('bar.list')}}" target="_blank" style="color: #00b3ca; text-decoration: underline;">www.barovainventura.sk</a><br> "Pridajte svoj podnik" a vyplňte povinné údaje.
                                </li>
                                <li style="margin-bottom: 12px; padding-left: 5px;">
                                    <strong style="color: #00b3ca;">Výber podniku</strong><br>
                                    V prehľade podnikov kliknite na "Vybrať". Po úspešnom zvolení podniku sa v hornej časti zobrazí názov vášho vybraného podniku.
                                </li>
                                <li style="margin-bottom: 12px; padding-left: 5px;">
                                    <strong style="color: #00b3ca;">Spustenie inventúry</strong><br>
                                    V ľavom menu zvoľte: "Inventúra" => "Začať inventúru" a postupujte podľa pokynov.
                                </li>
                            </ol>
                        </div>

                        <div style="text-align: center; margin: 30px 0;">
                            <a href="https://www.youtube.com/watch?v=we6Atvh1aSw" style="background-color: #3497da; color: white; padding: 12px 30px; text-decoration: none; border-radius: 4px; font-weight: bold; display: inline-block; font-size: 16px;">
                                Proces celej inventúry (Video)
                            </a>
                        </div>

                        <div style="background: #f8f9fa; border-radius: 5px; padding: 20px; margin-bottom: 25px; border-left: 4px solid #3498db;">
                            <h4 style="margin: 0 0 10px 0; color: #3498db; font-size: 16px;">Desktopová aplikácia</h4>
                            <p style="margin-bottom: 10px; line-height: 1.5; color: #333;">Pre prácu s inventúrou si stiahnite našu aplikáciu:</p>
                            <ul style="margin-top: 5px; padding-left: 20px;">
                                <li style="margin-bottom: 8px;"><a href="{{asset('BarovaInventura.exe')}}" style="color: #00b3ca; text-decoration: underline;">Stiahnuť aplikáciu (.exe)</a></li>
                                <li style="margin-bottom: 8px;"><a href="{{route('tutorial')}}" style="color: #00b3ca; text-decoration: underline;">Inštalačné video a návody</a></li>
                                <li style="margin-bottom: 8px;"><a href="{{asset('Uzivatelska_prirucka.pdf')}}" style="color: #00b3ca; text-decoration: underline;">Užívateľská príručka</a></li>
                            </ul>
                        </div>

                        <div style="text-align: center; margin: 30px 0;">
                            <a href="{{ route('dashboard.index') }}" style="background-color: #00b3ca; color: white; padding: 12px 30px; text-decoration: none; border-radius: 4px; font-weight: bold; display: inline-block; font-size: 16px;">
                                Prejsť do administrácie
                            </a>
                        </div>

                        <div style="font-size: 13px; color: #7f8c8d; border-top: 1px solid #eaeaea; padding-top: 15px; margin-top: 20px;">
                            <em>Poznámka: Na základnú inventúru nepotrebujete skener ani váhu. Tieto nástroje slúžia len pre vyššiu efektivitu práce.</em>
                        </div>
                    </td>
                </tr>
            </table>
        </center>
    </td>
</tr>

@include('app.layouts.emails.footer')
