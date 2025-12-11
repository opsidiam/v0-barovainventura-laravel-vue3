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
                            inventúra v podniku <strong>{{ $data->bar->name }}</strong> bola úspešne uzavretá.
                        </p>

                        <p style="margin-top: 0; margin-bottom: 25px;">
                            V prílohe tohto e-mailu nájdete výstupný dokument inventúry vo formáte PDF.
                        </p>

                        <div style="background-color: #f0f8ff; border-left: 4px solid #00b3ca; padding: 12px 15px; margin-bottom: 25px;">
                            <p style="margin: 0; font-size: 14px;">
                                <strong>Poznámka:</strong> Tento dokument obsahuje kompletný prehľad inventúry a nemôže slúžiť ako účtovný doklad.
                            </p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 20px; text-align: center;">
                        <a href="{{ route('stocktake.index') }}"
                           style="background-color: #00b3ca; color: white; padding: 12px 25px; text-decoration: none; border-radius: 4px; display: inline-block; font-weight: bold;">
                            Zobraziť inventúru v systéme
                        </a>
                    </td>
                </tr>
            </table>
        </center>
    </td>
</tr>
@include('app.layouts.emails.footer')
