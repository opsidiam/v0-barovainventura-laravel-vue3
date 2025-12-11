@include('app.layouts.emails.head')
<tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
        <center>
            <table cellspacing="0" cellpadding="0" width="600" class="w320">
                <tr>
                    <td class="header-lg">
                        @if(isset($user) && $user->invoice_company_name != null)
                            Vážená spoločnosť {{ $user->invoice_company_name }}.
                        @elseif(isset($user))
                            Ahoj {{ $user->name }} {{ $user->surname }}.
                        @else
                            Dobrý deň,
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="free-text">
                        <p>Dostali ste tento email, pretože sme dostali žiadosť o obnovu hesla pre váš účet v aplikácii <strong>Barová Inventúra</strong>.</p>

                        <p>Ak ste nepožiadali o obnovu hesla, ignorujte tento email. V opačnom prípade kliknite na tlačidlo nižšie pre obnovu hesla:</p>

                        <center>
                            <a href="{{ $resetUrl }}" target="_blank" style="background-color: #00b3ca; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; display: inline-block; margin: 20px 0;">
                                Obnoviť heslo
                            </a>
                        </center>

                        <p>Tento odkaz na obnovu hesla vyprší za {{ $expire }} minút.</p>

                        <p>Ak tlačidlo nefunguje, skopírujte a vložte nasledujúcu URL adresu do vášho prehliadača:<br>
                            <small>{{ $resetUrl }}</small></p>
                    </td>
                </tr>
            </table>
        </center>
    </td>
</tr>
@include('app.layouts.emails.footer')
