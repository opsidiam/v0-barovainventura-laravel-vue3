<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        /* Moderný reset a základné štýly */
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
            width: 100%;
            background-color: #fff;
        }

        /* Elegantná hlavička */
        header {
            position: relative;
            width: 100%;
            margin: 0 0 15px 0;
            padding: 10px 0;
            background-color: #f8f9fa;
            border-bottom: 2px solid #e0e0e0;
        }

        /* Stĺpcová mriežka pre hlavičku */
        .header-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .header-col {
            flex: 1;
            min-width: 200px;
        }

        /* Boxový model pre bunky */
        .header-table th, .header-table td,
        .data-table th, .data-table td {
            border: 1px solid #e0e0e0;
            padding: 6px 8px;
            vertical-align: middle;
        }

        /* Moderný dizajn tabuliek */
        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 10px 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .data-table thead th {
            background-color: #2c3e50;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 9px;
            letter-spacing: 0.5px;
        }

        .data-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .data-table tbody tr:hover {
            background-color: #f1f5fd;
        }

        /* Farebné akcenty */
        .positive {
            color: #27ae60;
            font-weight: 600;
        }

        .negative {
            color: #e74c3c;
            font-weight: 600;
        }

        .highlight {
            background-color: #fffde7;
        }

        /* Päta s gradientom */
        #footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 25px;
            background: linear-gradient(to right, #f8f9fa, #e0e0e0);
            color: #7f8c8d;
            text-align: right;
            padding: 5px 15px 0 0;
            font-size: 9px;
            border-top: 1px solid #ddd;
        }

        /* Číslovanie strán */
        .page-number:before {
            content: "Strana " counter(page);
            font-size: 9px;
            color: #7f8c8d;
            letter-spacing: 0.5px;
        }

        /* Responsívne breakpointy */
        @media print {
            .header-col {
                min-width: 150px;
            }
        }

        /* Špeciálne prvky */
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
            background-color: #3498db;
            color: white;
        }

        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e0e0e0, transparent);
            margin: 8px 0;
        }
    </style>
</head>
<body>

<!-- Hlavička dokumentu -->
<header>
    <table class="header-table">
        <tr>
            <th width="25%">Názov podniku</th>
            <th width="30%">Adresa podniku</th>
            <th width="20%">Zodpovedná osoba za podnik</th>
            <th width="25%">Zodpovedná osoba za inventúru</th>
        </tr>
        <tr>
            <td>{{ $bar->name }}</td>
            <td>{{ $bar->address }} {{ $bar->number }}, {{ $bar->city }} {{ $bar->psc }}, {{ $bar->country }}</td>
            <td>{{ $bar->chef }} @if(isset($bar->phone))({{ $bar->phone }})@endif</td>
            <td>{{ $mine_user }}</td>
        </tr>

        @if($users_count > 0)
            <tr>
                <th colspan="4">Osoby zúčastnené na inventúre</th>
            </tr>
            <tr>
                @foreach($users as $user)
                    <td class="user" colspan="{{ $loop->last && $users_count % 4 != 0 ? (4 - ($users_count-1) % 4) : 1 }}">
                        <b>{{ $user->name }} {{ $user->surname }}</b><br>
                        (API: {{ $user->api }})
                    </td>
                    @if($loop->iteration % 4 == 0 && !$loop->last)
            </tr><tr>
                @endif
                @endforeach
            </tr>
        @endif
    </table>
</header>

<!-- Telo dokumentu -->
<div class="content">
    <table class="data-table">
        <thead>
        <tr>
            <th width="25%">Názov (Objem, Alk.) / (g)</th>
            <th width="20%">Aktuálne skladom (Bal) / (ks)</th>
            <th width="15%">Naskenoval</th>
            <th width="15%">EAN</th>
            <th width="25%">Zisk/Strata</th>
        </tr>
        </thead>
        <tbody>
        @php
            $total_stock_cost = 0;
        @endphp
        @if($items)
            @foreach($items as $item)
                <tr>
                    @if($item['stocktake_data']['type'] == 0)
                        <td><b>{{ $item['stocktake_data']['name'] }}</b><br>
                            <small>Objem: {{ $item['stocktake_data']['volume'] }} ml | Alk. {{ $item['stocktake_data']['alcohol'] }}%</small>
                        </td>
                    @else
                        <td><b>{{ $item['stocktake_data']['name'] }}</b><br>
                            <small>Váha: {{ $item['stocktake_data']['weight'] }} g</small>
                        </td>
                    @endif

                    <td>
                        @if($item['stocktake_data']['show_in_grams'])
                            @if($item['stocktake_data']['type'] == 0)
                                <span class="negative">{{ $item['stocktake_data']['weight'] }} g</span>
                                ({{ $item['stocktake_data']['full_packs'] }} ks)
                            @else
                                {{ $item['stocktake_data']['full_packs'] }} ks
                            @endif
                        @else
                            @if($item['stocktake_data']['type'] == 0)
                                {{ $item['stocktake_data']['weight'] }} ml
                                ({{ $item['stocktake_data']['full_packs'] }} ks)
                                [Spolu: {{($item['stocktake_data']['weight'] + ($item['stocktake_data']['volume'] * $item['stocktake_data']['full_packs'])) / 1000}}L]
                            @else
                                {{ $item['stocktake_data']['full_packs'] }} ks
                            @endif
                        @endif
                    </td>

                    <td>{{ $item['stocktake_data']['scanned_by'] }}</td>
                    <td>{{ $item['stocktake_data']['ean'] }}</td>

                    <td>
                        @if(isset($item['stocktake_data']['financial_data']))
                            @php
                                $total_stock_cost_item = $item['stocktake_data']['financial_data']['total_stock_cost'];
                                $total_stock_cost = $total_stock_cost + $total_stock_cost_item;
                            @endphp
                            @if($item['stocktake_data']['financial_data']['total_profit'] > 0)
                                <span class="positive">{{ $item['stocktake_data']['financial_data']['total_profit'] }} €</span><br>
                                <small class="small-text">
                                    Náklady: {{ $item['stocktake_data']['financial_data']['total_cost'] }} € | Tržba: {{ $item['stocktake_data']['financial_data']['total_revenue'] }} €<br>
                                    Hodnota: {{ $total_stock_cost_item }} €
                                </small>
                            @else
                                <span class="negative">{{ $item['stocktake_data']['financial_data']['total_profit'] }} €</span><br>
                                <small class="small-text">
                                    Náklady: {{ $item['stocktake_data']['financial_data']['total_cost'] }} € | Tržba: {{ $item['stocktake_data']['financial_data']['total_revenue'] }} €<br>
                                    Hodnota: {{ $total_stock_cost_item }} €
                                </small>
                            @endif
                        @else
                            <span class="positive">- €</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
        <tfoot>
        <tr class="summary-row">
            <td colspan="5" style="text-align: right; padding-right: 20px">
                Tržba spolu: <b>{{ $total_profit }} €</b>
                Hodnota skladu spolu: <b>{{ $total_stock_cost }} €</b>
            </td>
        </tr>
        </tfoot>
    </table>
</div>

{{--<!-- Päta dokumentu -->--}}
{{--<footer id="footer">--}}
{{--    <div class="page-number"></div>--}}
{{--</footer>--}}

</body>
</html>
