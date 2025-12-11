@include('app.layouts.emails.head')
<tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
        <center>
            <table cellspacing="0" cellpadding="0" width="600" class="w320">
                <tr>
                    <td>
                        {!! $content !!}
                    </td>
                </tr>
            </table>
        </center>
    </td>
</tr>
@include('app.layouts.emails.footer')
