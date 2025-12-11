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
                        Týmto e-mailom vám potvrdzujeme aktiváciu licencie.<br><br>
                        Licencia bola predĺžená do: <strong>{{$data['user']['licence_expire']->format("d.m.Y")}}</strong><br>
                        Počet podnikov: <strong>{{$data['user']['licence_bar_count']}} x</strong>
                    </td>
                </tr>

            </table>
        </center>
    </td>
</tr>
@include('app.layouts.emails.footer')

