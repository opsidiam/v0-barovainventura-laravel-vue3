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
        /*table:last-child {*/
        /*    page-break-after: avoid;*/
        /*}*/
        .td {
            height: 12.13%;
            text-align: center;
            width: 50%;
        }
    </style>
</head>
<body>
<table class="table">
    <tbody>
     <tr class="tr">
        <td class="td">
            <table>
                <tr>
                    <td style="width: 45%; padding-right: 10px">
                        <img style="height:50px;padding-bottom: 8px; width: 100%" src="{{asset('ean/ri_1.png')}}"><br>
                        <img style="height:40px; width: 100%" src="data:image/png;base64,{{$ean_img[0]}}">
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td style="text-align: center" colspan="4">
                                    <span style="font-style:normal;font-weight:normal;font-size:7pt;color:#231f20; text-align: center">MADE IN SLOVAKIA</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <span style="font-style:normal;font-weight:bold;font-size:8pt;color:#231f20">BALENIE: {{$balenie}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; width: 32px">
                                    <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">S/N:</span>
                                </td>
                                <td colspan="3" style="border: 1px solid #000;">
                                    <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">020-{{$sn_1[0]}}-{{$sn_2[0]}}-{{$sn_3[0]}}-{{$sn_4[0]}}-{{$match[0]}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_3.png')}}">
                                </td>
                                <td>
                                    <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_4.png')}}">
                                </td>
                                <td>
                                    <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_5.png')}}">
                                </td>
                                <td style="width: 90px">
                                    <span style="font-size:5pt;color:#231f20; padding: 0; margin: 0">
                                        DISTRIBUTOR<br>
                                        WEBPLACE S.R.O<br>
                                        TRNOVO 74, 038 41<br>
                                        KOŠŤANY NAD TURCOM
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
         <td class="td">
             <table>
                 <tr>
                     <td style="width: 45%; padding-right: 10px">
                         <img style="height:50px;padding-bottom: 8px; width: 100%" src="{{asset('ean/ri_1.png')}}"><br>
                         <img style="height:40px; width: 100%" src="data:image/png;base64,{{$ean_img[1]}}">
                     </td>
                     <td>
                         <table>
                             <tr>
                                 <td style="text-align: center" colspan="4">
                                     <span style="font-style:normal;font-weight:normal;font-size:7pt;color:#231f20; text-align: center">MADE IN SLOVAKIA</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td colspan="4">
                                     <span style="font-style:normal;font-weight:bold;font-size:8pt;color:#231f20">BALENIE: {{$balenie}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td style="border: 1px solid #000; width: 32px">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">S/N:</span>
                                 </td>
                                 <td colspan="3" style="border: 1px solid #000;">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">020-{{$sn_1[1]}}-{{$sn_2[1]}}-{{$sn_3[1]}}-{{$sn_4[1]}}-{{$match[1]}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_3.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_4.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_5.png')}}">
                                 </td>
                                 <td style="width: 90px">
                                    <span style="font-size:5pt;color:#231f20; padding: 0; margin: 0">
                                        DISTRIBUTOR<br>
                                        WEBPLACE S.R.O<br>
                                        TRNOVO 74, 038 41<br>
                                        KOŠŤANY NAD TURCOM
                                    </span>
                                 </td>
                             </tr>
                         </table>
                     </td>
                 </tr>
             </table>
         </td>
    </tr>
     <tr class="tr">
         <td class="td">
             <table>
                 <tr>
                     <td style="width: 45%; padding-right: 10px">
                         <img style="height:50px;padding-bottom: 8px; width: 100%" src="{{asset('ean/ri_1.png')}}"><br>
                         <img style="height:40px; width: 100%" src="data:image/png;base64,{{$ean_img[2]}}">
                     </td>
                     <td>
                         <table>
                             <tr>
                                 <td style="text-align: center" colspan="4">
                                     <span style="font-style:normal;font-weight:normal;font-size:7pt;color:#231f20; text-align: center">MADE IN SLOVAKIA</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td colspan="4">
                                     <span style="font-style:normal;font-weight:bold;font-size:8pt;color:#231f20">BALENIE: {{$balenie}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td style="border: 1px solid #000; width: 32px">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">S/N:</span>
                                 </td>
                                 <td colspan="3" style="border: 1px solid #000;">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">020-{{$sn_1[2]}}-{{$sn_2[2]}}-{{$sn_3[2]}}-{{$sn_4[2]}}-{{$match[2]}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_3.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_4.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_5.png')}}">
                                 </td>
                                 <td style="width: 90px">
                                    <span style="font-size:5pt;color:#231f20; padding: 0; margin: 0">
                                        DISTRIBUTOR<br>
                                        WEBPLACE S.R.O<br>
                                        TRNOVO 74, 038 41<br>
                                        KOŠŤANY NAD TURCOM
                                    </span>
                                 </td>
                             </tr>
                         </table>
                     </td>
                 </tr>
             </table>
         </td>
         <td class="td">
             <table>
                 <tr>
                     <td style="width: 45%; padding-right: 10px">
                         <img style="height:50px;padding-bottom: 8px; width: 100%" src="{{asset('ean/ri_1.png')}}"><br>
                         <img style="height:40px; width: 100%" src="data:image/png;base64,{{$ean_img[3]}}">
                     </td>
                     <td>
                         <table>
                             <tr>
                                 <td style="text-align: center" colspan="4">
                                     <span style="font-style:normal;font-weight:normal;font-size:7pt;color:#231f20; text-align: center">MADE IN SLOVAKIA</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td colspan="4">
                                     <span style="font-style:normal;font-weight:bold;font-size:8pt;color:#231f20">BALENIE: {{$balenie}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td style="border: 1px solid #000; width: 32px">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">S/N:</span>
                                 </td>
                                 <td colspan="3" style="border: 1px solid #000;">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">020-{{$sn_1[3]}}-{{$sn_2[3]}}-{{$sn_3[3]}}-{{$sn_4[3]}}-{{$match[3]}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_3.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_4.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_5.png')}}">
                                 </td>
                                 <td style="width: 90px">
                                    <span style="font-size:5pt;color:#231f20; padding: 0; margin: 0">
                                        DISTRIBUTOR<br>
                                        WEBPLACE S.R.O<br>
                                        TRNOVO 74, 038 41<br>
                                        KOŠŤANY NAD TURCOM
                                    </span>
                                 </td>
                             </tr>
                         </table>
                     </td>
                 </tr>
             </table>
         </td>
    </tr>
     <tr class="tr">
         <td class="td">
             <table>
                 <tr>
                     <td style="width: 45%; padding-right: 10px">
                         <img style="height:50px;padding-bottom: 8px; width: 100%" src="{{asset('ean/ri_1.png')}}"><br>
                         <img style="height:40px; width: 100%" src="data:image/png;base64,{{$ean_img[4]}}">
                     </td>
                     <td>
                         <table>
                             <tr>
                                 <td style="text-align: center" colspan="4">
                                     <span style="font-style:normal;font-weight:normal;font-size:7pt;color:#231f20; text-align: center">MADE IN SLOVAKIA</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td colspan="4">
                                     <span style="font-style:normal;font-weight:bold;font-size:8pt;color:#231f20">BALENIE: {{$balenie}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td style="border: 1px solid #000; width: 32px">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">S/N:</span>
                                 </td>
                                 <td colspan="3" style="border: 1px solid #000;">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">020-{{$sn_1[4]}}-{{$sn_2[4]}}-{{$sn_3[4]}}-{{$sn_4[4]}}-{{$match[4]}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_3.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_4.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_5.png')}}">
                                 </td>
                                 <td style="width: 90px">
                                    <span style="font-size:5pt;color:#231f20; padding: 0; margin: 0">
                                        DISTRIBUTOR<br>
                                        WEBPLACE S.R.O<br>
                                        TRNOVO 74, 038 41<br>
                                        KOŠŤANY NAD TURCOM
                                    </span>
                                 </td>
                             </tr>
                         </table>
                     </td>
                 </tr>
             </table>
         </td>
         <td class="td">
             <table>
                 <tr>
                     <td style="width: 45%; padding-right: 10px">
                         <img style="height:50px;padding-bottom: 8px; width: 100%" src="{{asset('ean/ri_1.png')}}"><br>
                         <img style="height:40px; width: 100%" src="data:image/png;base64,{{$ean_img[5]}}">
                     </td>
                     <td>
                         <table>
                             <tr>
                                 <td style="text-align: center" colspan="4">
                                     <span style="font-style:normal;font-weight:normal;font-size:7pt;color:#231f20; text-align: center">MADE IN SLOVAKIA</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td colspan="4">
                                     <span style="font-style:normal;font-weight:bold;font-size:8pt;color:#231f20">BALENIE: {{$balenie}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td style="border: 1px solid #000; width: 32px">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">S/N:</span>
                                 </td>
                                 <td colspan="3" style="border: 1px solid #000;">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">020-{{$sn_1[5]}}-{{$sn_2[5]}}-{{$sn_3[5]}}-{{$sn_4[5]}}-{{$match[5]}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_3.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_4.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_5.png')}}">
                                 </td>
                                 <td style="width: 90px">
                                    <span style="font-size:5pt;color:#231f20; padding: 0; margin: 0">
                                        DISTRIBUTOR<br>
                                        WEBPLACE S.R.O<br>
                                        TRNOVO 74, 038 41<br>
                                        KOŠŤANY NAD TURCOM
                                    </span>
                                 </td>
                             </tr>
                         </table>
                     </td>
                 </tr>
             </table>
         </td>
    </tr>
     <tr class="tr">
         <td class="td">
             <table>
                 <tr>
                     <td style="width: 45%; padding-right: 10px">
                         <img style="height:50px;padding-bottom: 8px; width: 100%" src="{{asset('ean/ri_1.png')}}"><br>
                         <img style="height:40px; width: 100%" src="data:image/png;base64,{{$ean_img[6]}}">
                     </td>
                     <td>
                         <table>
                             <tr>
                                 <td style="text-align: center" colspan="4">
                                     <span style="font-style:normal;font-weight:normal;font-size:7pt;color:#231f20; text-align: center">MADE IN SLOVAKIA</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td colspan="4">
                                     <span style="font-style:normal;font-weight:bold;font-size:8pt;color:#231f20">BALENIE: {{$balenie}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td style="border: 1px solid #000; width: 32px">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">S/N:</span>
                                 </td>
                                 <td colspan="3" style="border: 1px solid #000;">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">020-{{$sn_1[6]}}-{{$sn_2[6]}}-{{$sn_3[6]}}-{{$sn_4[6]}}-{{$match[6]}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_3.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_4.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_5.png')}}">
                                 </td>
                                 <td style="width: 90px">
                                    <span style="font-size:5pt;color:#231f20; padding: 0; margin: 0">
                                        DISTRIBUTOR<br>
                                        WEBPLACE S.R.O<br>
                                        TRNOVO 74, 038 41<br>
                                        KOŠŤANY NAD TURCOM
                                    </span>
                                 </td>
                             </tr>
                         </table>
                     </td>
                 </tr>
             </table>
         </td>
         <td class="td">
             <table>
                 <tr>
                     <td style="width: 45%; padding-right: 10px">
                         <img style="height:50px;padding-bottom: 8px; width: 100%" src="{{asset('ean/ri_1.png')}}"><br>
                         <img style="height:40px; width: 100%" src="data:image/png;base64,{{$ean_img[7]}}">
                     </td>
                     <td>
                         <table>
                             <tr>
                                 <td style="text-align: center" colspan="4">
                                     <span style="font-style:normal;font-weight:normal;font-size:7pt;color:#231f20; text-align: center">MADE IN SLOVAKIA</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td colspan="4">
                                     <span style="font-style:normal;font-weight:bold;font-size:8pt;color:#231f20">BALENIE: {{$balenie}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td style="border: 1px solid #000; width: 32px">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">S/N:</span>
                                 </td>
                                 <td colspan="3" style="border: 1px solid #000;">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">020-{{$sn_1[7]}}-{{$sn_2[7]}}-{{$sn_3[7]}}-{{$sn_4[7]}}-{{$match[7]}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_3.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_4.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_5.png')}}">
                                 </td>
                                 <td style="width: 90px">
                                    <span style="font-size:5pt;color:#231f20; padding: 0; margin: 0">
                                        DISTRIBUTOR<br>
                                        WEBPLACE S.R.O<br>
                                        TRNOVO 74, 038 41<br>
                                        KOŠŤANY NAD TURCOM
                                    </span>
                                 </td>
                             </tr>
                         </table>
                     </td>
                 </tr>
             </table>
         </td>
    </tr>
     <tr class="tr">
         <td class="td">
             <table>
                 <tr>
                     <td style="width: 45%; padding-right: 10px">
                         <img style="height:50px;padding-bottom: 8px; width: 100%" src="{{asset('ean/ri_1.png')}}"><br>
                         <img style="height:40px; width: 100%" src="data:image/png;base64,{{$ean_img[8]}}">
                     </td>
                     <td>
                         <table>
                             <tr>
                                 <td style="text-align: center" colspan="4">
                                     <span style="font-style:normal;font-weight:normal;font-size:7pt;color:#231f20; text-align: center">MADE IN SLOVAKIA</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td colspan="4">
                                     <span style="font-style:normal;font-weight:bold;font-size:8pt;color:#231f20">BALENIE: {{$balenie}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td style="border: 1px solid #000; width: 32px">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">S/N:</span>
                                 </td>
                                 <td colspan="3" style="border: 1px solid #000;">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">020-{{$sn_1[8]}}-{{$sn_2[8]}}-{{$sn_3[8]}}-{{$sn_4[8]}}-{{$match[8]}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_3.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_4.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_5.png')}}">
                                 </td>
                                 <td style="width: 90px">
                                    <span style="font-size:5pt;color:#231f20; padding: 0; margin: 0">
                                        DISTRIBUTOR<br>
                                        WEBPLACE S.R.O<br>
                                        TRNOVO 74, 038 41<br>
                                        KOŠŤANY NAD TURCOM
                                    </span>
                                 </td>
                             </tr>
                         </table>
                     </td>
                 </tr>
             </table>
         </td>
         <td class="td">
             <table>
                 <tr>
                     <td style="width: 45%; padding-right: 10px">
                         <img style="height:50px;padding-bottom: 8px; width: 100%" src="{{asset('ean/ri_1.png')}}"><br>
                         <img style="height:40px; width: 100%" src="data:image/png;base64,{{$ean_img[9]}}">
                     </td>
                     <td>
                         <table>
                             <tr>
                                 <td style="text-align: center" colspan="4">
                                     <span style="font-style:normal;font-weight:normal;font-size:7pt;color:#231f20; text-align: center">MADE IN SLOVAKIA</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td colspan="4">
                                     <span style="font-style:normal;font-weight:bold;font-size:8pt;color:#231f20">BALENIE: {{$balenie}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td style="border: 1px solid #000; width: 32px">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">S/N:</span>
                                 </td>
                                 <td colspan="3" style="border: 1px solid #000;">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">020-{{$sn_1[9]}}-{{$sn_2[9]}}-{{$sn_3[9]}}-{{$sn_4[9]}}-{{$match[9]}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_3.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_4.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_5.png')}}">
                                 </td>
                                 <td style="width: 90px">
                                    <span style="font-size:5pt;color:#231f20; padding: 0; margin: 0">
                                        DISTRIBUTOR<br>
                                        WEBPLACE S.R.O<br>
                                        TRNOVO 74, 038 41<br>
                                        KOŠŤANY NAD TURCOM
                                    </span>
                                 </td>
                             </tr>
                         </table>
                     </td>
                 </tr>
             </table>
         </td>
    </tr>
     <tr class="tr">
         <td class="td">
             <table>
                 <tr>
                     <td style="width: 45%; padding-right: 10px">
                         <img style="height:50px;padding-bottom: 8px; width: 100%" src="{{asset('ean/ri_1.png')}}"><br>
                         <img style="height:40px; width: 100%" src="data:image/png;base64,{{$ean_img[10]}}">
                     </td>
                     <td>
                         <table>
                             <tr>
                                 <td style="text-align: center" colspan="4">
                                     <span style="font-style:normal;font-weight:normal;font-size:7pt;color:#231f20; text-align: center">MADE IN SLOVAKIA</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td colspan="4">
                                     <span style="font-style:normal;font-weight:bold;font-size:8pt;color:#231f20">BALENIE: {{$balenie}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td style="border: 1px solid #000; width: 32px">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">S/N:</span>
                                 </td>
                                 <td colspan="3" style="border: 1px solid #000;">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">020-{{$sn_1[10]}}-{{$sn_2[10]}}-{{$sn_3[10]}}-{{$sn_4[10]}}-{{$match[10]}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_3.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_4.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_5.png')}}">
                                 </td>
                                 <td style="width: 90px">
                                    <span style="font-size:5pt;color:#231f20; padding: 0; margin: 0">
                                        DISTRIBUTOR<br>
                                        WEBPLACE S.R.O<br>
                                        TRNOVO 74, 038 41<br>
                                        KOŠŤANY NAD TURCOM
                                    </span>
                                 </td>
                             </tr>
                         </table>
                     </td>
                 </tr>
             </table>
         </td>
         <td class="td">
             <table>
                 <tr>
                     <td style="width: 45%; padding-right: 10px">
                         <img style="height:50px;padding-bottom: 8px; width: 100%" src="{{asset('ean/ri_1.png')}}"><br>
                         <img style="height:40px; width: 100%" src="data:image/png;base64,{{$ean_img[11]}}">
                     </td>
                     <td>
                         <table>
                             <tr>
                                 <td style="text-align: center" colspan="4">
                                     <span style="font-style:normal;font-weight:normal;font-size:7pt;color:#231f20; text-align: center">MADE IN SLOVAKIA</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td colspan="4">
                                     <span style="font-style:normal;font-weight:bold;font-size:8pt;color:#231f20">BALENIE: {{$balenie}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td style="border: 1px solid #000; width: 32px">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">S/N:</span>
                                 </td>
                                 <td colspan="3" style="border: 1px solid #000;">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">020-{{$sn_1[11]}}-{{$sn_2[11]}}-{{$sn_3[11]}}-{{$sn_4[11]}}-{{$match[11]}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_3.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_4.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_5.png')}}">
                                 </td>
                                 <td style="width: 90px">
                                    <span style="font-size:5pt;color:#231f20; padding: 0; margin: 0">
                                        DISTRIBUTOR<br>
                                        WEBPLACE S.R.O<br>
                                        TRNOVO 74, 038 41<br>
                                        KOŠŤANY NAD TURCOM
                                    </span>
                                 </td>
                             </tr>
                         </table>
                     </td>
                 </tr>
             </table>
         </td>
    </tr>
     <tr class="tr">
         <td class="td">
             <table>
                 <tr>
                     <td style="width: 45%; padding-right: 10px">
                         <img style="height:50px;padding-bottom: 8px; width: 100%" src="{{asset('ean/ri_1.png')}}"><br>
                         <img style="height:40px; width: 100%" src="data:image/png;base64,{{$ean_img[12]}}">
                     </td>
                     <td>
                         <table>
                             <tr>
                                 <td style="text-align: center" colspan="4">
                                     <span style="font-style:normal;font-weight:normal;font-size:7pt;color:#231f20; text-align: center">MADE IN SLOVAKIA</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td colspan="4">
                                     <span style="font-style:normal;font-weight:bold;font-size:8pt;color:#231f20">BALENIE: {{$balenie}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td style="border: 1px solid #000; width: 32px">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">S/N:</span>
                                 </td>
                                 <td colspan="3" style="border: 1px solid #000;">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">020-{{$sn_1[12]}}-{{$sn_2[12]}}-{{$sn_3[12]}}-{{$sn_4[12]}}-{{$match[12]}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_3.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_4.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_5.png')}}">
                                 </td>
                                 <td style="width: 90px">
                                    <span style="font-size:5pt;color:#231f20; padding: 0; margin: 0">
                                        DISTRIBUTOR<br>
                                        WEBPLACE S.R.O<br>
                                        TRNOVO 74, 038 41<br>
                                        KOŠŤANY NAD TURCOM
                                    </span>
                                 </td>
                             </tr>
                         </table>
                     </td>
                 </tr>
             </table>
         </td>
         <td class="td">
             <table>
                 <tr>
                     <td style="width: 45%; padding-right: 10px">
                         <img style="height:50px;padding-bottom: 8px; width: 100%" src="{{asset('ean/ri_1.png')}}"><br>
                         <img style="height:40px; width: 100%" src="data:image/png;base64,{{$ean_img[13]}}">
                     </td>
                     <td>
                         <table>
                             <tr>
                                 <td style="text-align: center" colspan="4">
                                     <span style="font-style:normal;font-weight:normal;font-size:7pt;color:#231f20; text-align: center">MADE IN SLOVAKIA</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td colspan="4">
                                     <span style="font-style:normal;font-weight:bold;font-size:8pt;color:#231f20">BALENIE: {{$balenie}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td style="border: 1px solid #000; width: 32px">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">S/N:</span>
                                 </td>
                                 <td colspan="3" style="border: 1px solid #000;">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">020-{{$sn_1[13]}}-{{$sn_2[13]}}-{{$sn_3[13]}}-{{$sn_4[13]}}-{{$match[13]}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_3.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_4.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_5.png')}}">
                                 </td>
                                 <td style="width: 90px">
                                    <span style="font-size:5pt;color:#231f20; padding: 0; margin: 0">
                                        DISTRIBUTOR<br>
                                        WEBPLACE S.R.O<br>
                                        TRNOVO 74, 038 41<br>
                                        KOŠŤANY NAD TURCOM
                                    </span>
                                 </td>
                             </tr>
                         </table>
                     </td>
                 </tr>
             </table>
         </td>
    </tr>
     <tr class="tr">
         <td class="td">
             <table>
                 <tr>
                     <td style="width: 45%; padding-right: 10px">
                         <img style="height:50px;padding-bottom: 8px; width: 100%" src="{{asset('ean/ri_1.png')}}"><br>
                         <img style="height:40px; width: 100%" src="data:image/png;base64,{{$ean_img[14]}}">
                     </td>
                     <td>
                         <table>
                             <tr>
                                 <td style="text-align: center" colspan="4">
                                     <span style="font-style:normal;font-weight:normal;font-size:7pt;color:#231f20; text-align: center">MADE IN SLOVAKIA</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td colspan="4">
                                     <span style="font-style:normal;font-weight:bold;font-size:8pt;color:#231f20">BALENIE: {{$balenie}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td style="border: 1px solid #000; width: 32px">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">S/N:</span>
                                 </td>
                                 <td colspan="3" style="border: 1px solid #000;">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">020-{{$sn_1[14]}}-{{$sn_2[14]}}-{{$sn_3[14]}}-{{$sn_4[14]}}-{{$match[14]}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_3.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_4.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_5.png')}}">
                                 </td>
                                 <td style="width: 90px">
                                    <span style="font-size:5pt;color:#231f20; padding: 0; margin: 0">
                                        DISTRIBUTOR<br>
                                        WEBPLACE S.R.O<br>
                                        TRNOVO 74, 038 41<br>
                                        KOŠŤANY NAD TURCOM
                                    </span>
                                 </td>
                             </tr>
                         </table>
                     </td>
                 </tr>
             </table>
         </td>
         <td class="td">
             <table>
                 <tr>
                     <td style="width: 45%; padding-right: 10px">
                         <img style="height:50px;padding-bottom: 8px; width: 100%" src="{{asset('ean/ri_1.png')}}"><br>
                         <img style="height:40px; width: 100%" src="data:image/png;base64,{{$ean_img[15]}}">
                     </td>
                     <td>
                         <table>
                             <tr>
                                 <td style="text-align: center" colspan="4">
                                     <span style="font-style:normal;font-weight:normal;font-size:7pt;color:#231f20; text-align: center">MADE IN SLOVAKIA</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td colspan="4">
                                     <span style="font-style:normal;font-weight:bold;font-size:8pt;color:#231f20">BALENIE: {{$balenie}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td style="border: 1px solid #000; width: 32px">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">S/N:</span>
                                 </td>
                                 <td colspan="3" style="border: 1px solid #000;">
                                     <span style="font-style:normal;font-weight:bold;font-size:9pt;color:#231f20">020-{{$sn_1[15]}}-{{$sn_2[15]}}-{{$sn_3[15]}}-{{$sn_4[15]}}-{{$match[15]}}</span>
                                 </td>
                             </tr>
                             <tr>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_3.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_4.png')}}">
                                 </td>
                                 <td>
                                     <img style="height:0.28in; padding-right: 0; padding-left: 0; margin-right: 0; margin-left: 0" src="{{asset('ean/ri_5.png')}}">
                                 </td>
                                 <td style="width: 90px">
                                    <span style="font-size:5pt;color:#231f20; padding: 0; margin: 0">
                                        DISTRIBUTOR<br>
                                        WEBPLACE S.R.O<br>
                                        TRNOVO 74, 038 41<br>
                                        KOŠŤANY NAD TURCOM
                                    </span>
                                 </td>
                             </tr>
                         </table>
                     </td>
                 </tr>
             </table>
         </td>
    </tr>
    </tbody>
</table>
</body>
</html>
