@include('app.layouts.emails.head')
<tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
        <center>
            <table cellspacing="0" cellpadding="0" width="600" class="w320">
                <tr>
                    <td class="header-lg">
                        Ahoj {{ $data['user']->name }} {{ $data['user']->surname }},
                    </td>
                </tr>
                <tr>
                    <td class="free-text">
                        <p style="margin-top: 0; margin-bottom: 15px;">
                            Ak máte záujem o zapožičanie zariadenia na skúšobnú dobu, môžete podať požiadavku kliknutím na tento odkaz.
                        </p>

                        <div style="background-color: #f0f8ff; border-left: 4px solid #00b3ca; padding: 12px 15px; margin-bottom: 25px;">
                            <p style="margin: 0; font-size: 14px;">
                                <strong>Poznámka:</strong> Po kliknutí na odkaz nižšie bude vaša žiadosť spracovaná systémom a obratom vám bude zaslaný e-mail s podrobnými inštrukciami.
                            </p>
                        </div>

                        <a href="{{ route('request-contract', ['hash' => $data['hash']]) }}"
                           style="background-color: #00b3ca; color: white; padding: 12px 25px; text-decoration: none; border-radius: 4px; display: inline-block; font-weight: bold;">
                            Požiadať o zapožičanie zariadenia
                        </a>
                    </td>

                </tr>
            </table>
        </center>
    </td>
</tr>
@include('app.layouts.emails.footer')
