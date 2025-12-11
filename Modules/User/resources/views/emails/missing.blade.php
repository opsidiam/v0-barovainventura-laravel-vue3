@include('app.layouts.emails.head')
<tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
        <center>
            <table cellspacing="0" cellpadding="0" width="600" class="w320">
                <tr>
                    <td class="header-lg">
                        Ahoj {{$recipient['name']}},
                    </td>
                </tr>
                <tr>
                    <td class="free-text" style="padding: 20px 0; font-size: 16px; line-height: 1.6; color: #555;">
                        <p>Dlho sme ťa už v aplikácii <strong>Barová inventúra</strong> nevideli a chýbaš nám! 😊</p>

                        <p>Všetko v poriadku? Dúfame, že áno, ale keby si potreboval s čímkoľvek pomôcť, kľudne sa ozvi.</p>

                        <p>Mimochodom - neušlo ti, že by bol teraz ideálny čas na inventúru? Je to rýchle a jednoduche 😊.</p>

                        <p>Klikni sem a poď sa na to pozrieť:<br>
                            <a href="{{route('stocktake.index')}}" style="color: #2b6cb0; text-decoration: underline;">Spustiť inventúru</a></p>

                        <p>Tešíme sa, že sa zase uvidíme!</p>

                        <p style="margin-top: 30px;">
                            Tvoj tím Barová inventúra<br>
                            <span style="font-size: 14px; color: #718096;">Ak máš akékoľvek otázky, kľudne nás kontaktuj.</span>
                        </p>
                    </td>
                </tr>
            </table>
        </center>
    </td>
</tr>
@include('app.layouts.emails.footer')
