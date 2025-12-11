@include('app.layouts.emails.head')
<tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
        <center>
            <table cellspacing="0" cellpadding="0" width="600" class="w320">
                <tr>
                    <td class="header-lg">
                        Ahoj {{ $data['user']['name'] }} {{ $data['user']['surname'] }}.
                    </td>
                </tr>
                <tr>
                    <td class="free-text">
                        @if($data['type'] === 'expire')
                            Tvoja licencia bola deaktivovaná z dôvodu expirácie.<br><br>
                            Dátum expirácie: <strong>{{$data['user']['licence_expire']->format("d.m.Y")}}</strong><br><br>
                            Pre obnovenie prístupu klikni na tlačidlo nižšie:
                        @elseif($data['type'] === 'last_day')
                            Naliehavé upozornenie: Tvoja licencia expiruje <strong>zajtra</strong>!<br><br>
                            Dátum expirácie: <strong>{{$data['user']['licence_expire']->format("d.m.Y")}}</strong><br><br>
                            Pre predĺženie licencie a neprerušený prístup klikni na tlačidlo nižšie:
                        @else
                            Upozornenie: Tvoja licencia expiruje <strong>o 7 dní</strong><br><br>
                            Dátum expirácie: <strong>{{$data['user']['licence_expire']->format("d.m.Y")}}</strong><br><br>
                            Odporúčame predĺžiť licenciu čím skôr:
                        @endif

                        <div style="margin-top: 30px; text-align: center;">
                            <a href="{{route('license.index')}}" style="display: inline-block; padding: 12px 24px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 4px; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold; transition: background-color 0.3s;">
                                Aktivovať licenciu
                            </a>
                        </div>

                        @if($data['type'] === 'last_week' || $data['type'] === 'last_day')
                            <p style="margin-top: 20px; font-size: 14px; color: #666;">
                                Po expirácii stratíte prístup k všetkým prémiovým funkciám.
                            </p>
                        @endif
                    </td>
                </tr>

            </table>
        </center>
    </td>
</tr>
@include('app.layouts.emails.footer')

