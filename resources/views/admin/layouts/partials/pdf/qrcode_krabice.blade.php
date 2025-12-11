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
            margin: 12px;
            position: absolute;
            /*page-break-after: always;*/
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }
        .td {
            margin: 0;
            padding: 0;
            height: 12.3%;
            text-align: center;
            /*border: 1px solid black;*/
            width: 50%;
        }
    </style>
</head>
<body>
<table class="table">
    <tbody>
    @for($riadok = 0; $riadok <= 7; $riadok++)
    <tr class="tr">
        @for($blok = 0; $blok <= 1; $blok++)
        <td class="td">
            <table style="width: 100%">
                <tr>
                    <td><img style="padding: 0; margin: 0; padding-left: 10px; height: 100px"  src="data:image/png;base64,{{$qr[$riadok][$blok]}}"></td>
                    <td style="width: 100%; text-align: center">
                        <p style="padding: 0; margin: 0; font-weight: bold; font-size: 13px;">Zľava 10%</p>
                        <p style="padding: 0; margin: 0; font-size: 10px;">Túto zľavu je možné použiť pri nákupe licencie na obdobie: 1 mesiac</p>
                    </td>
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
