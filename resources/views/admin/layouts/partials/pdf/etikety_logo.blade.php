<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Table Test</title>
    <style>

        @page {
            margin: 0;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
        }

        .table {
            padding: 72px 17px;
            margin: 12px;
            position: absolute;
            /*page-break-after: always;*/
            width: 97%;
            border-collapse: collapse;
            border-spacing: 0;
        }
        .td {
            margin: 0;
            padding: 0;
            height: 8.60%;
            text-align: center;
            /*border: 1px solid black;*/
            width: 100%;
            font-size: 14.1px;
        }
        td img{
            width: 96%;
            padding-left: 1%;
        }
    </style>
</head>
<body>
<table class="table">
    <tbody>
    @for($riadok = 0; $riadok <= 9; $riadok++)
        <tr class="tr">
            @for($blok = 0; $blok <= 3; $blok++)
                <td class="td">
                    <table style="width: 100%">
                        <tr>
                            <td><img src="{{asset('/img/V1_alt.png')}}"><br>www.barovainventura.sk</td>
                        </tr>
                    </table>
                </td>
            @endfor
        </tr>
    @endfor
    </tbody>
</table>
</body>
</html>
