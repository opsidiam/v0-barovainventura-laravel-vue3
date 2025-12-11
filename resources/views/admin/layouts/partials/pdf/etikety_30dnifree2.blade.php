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
            width: 97%;
            border-collapse: collapse;
            border-spacing: 0;
        }
        .td {
            margin: 0;
            padding: 0;
            height: 11%;
            text-align: center;
            /*border: 1px solid black;*/
            max-width: 33%;
        }
        td img {
            height: 30px;
            padding-bottom: 13px;
        }
        .td p {
            margin: 0;
            padding: 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
<table class="table">
    <tbody>
    @for($riadok = 0; $riadok <= 8; $riadok++)
        <tr class="tr">
            @for($blok = 0; $blok <= 2; $blok++)
                <td class="td">
                    <p style="font-weight: bold; font-size: 18px">Patrik Karaba</p>
                    <p>info@barovainventura.sk</p>
                    <p>+421 948 357 763</p>
                </td>
            @endfor
        </tr>
    @endfor
    </tbody>
</table>
</body>
</html>
