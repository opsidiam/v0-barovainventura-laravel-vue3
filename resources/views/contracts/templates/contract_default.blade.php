<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zmluva o výpožičke</title>
    <style>
        @page {
            size: A4;
            margin: 18mm 12mm; /* top right bottom left */
        }
        html, body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 11pt;
            color: #000;
            line-height: 1.28;
        }

        h1, h2, h3 { margin: 0 0 6px 0; font-weight: 700; }
        h1 { font-size: 22px; color: #17365D; text-align: center; }
        h2 { font-size: 16px; text-align: center; }
        .subtitle { font-size: 16px; text-align: center; margin: 2px 0 14px 0; }

        .section-title { font-size: 16px; font-weight: 700; text-align: center; margin: 12px 0 6px 0; }
        .article { font-size: 16px; font-weight: 700; text-align: center; margin: 14px 0 2px 0; }

        p { margin: 0 0 5px 0; }
        .block { margin: 6px 0 8px 0; }

        .kv { width: 100%; border-collapse: collapse; margin: 0 0 4px 0; }
        .kv td { vertical-align: top; padding: 1px 0; }
        .kv td.label { width: 37%; white-space: nowrap; }
        .kv td.value { width: 63%; }

        .line {
            display: inline-block;
            min-width: 50mm;
            border-bottom: 1px dotted #000;
            line-height: 1.1;
        }
        .line.short { min-width: 55mm; }

        ol.alpha { margin: 4px 0 6px 0; padding-left: 14mm; }
        ol.alpha > li { margin: 1px 0; }
        ol.dec { margin: 4px 0 6px 0; padding-left: 7mm; }
        ol.dec > li { margin: 1px 0; }

        .muted { color: #000; }
        .center { text-align: center; }
        .mt-8 { margin-top: 6px; }
        .mt-10 { margin-top: 8px; }
        .mt-16 { margin-top: 12px; }
        .mt-22 { margin-top: 16px; }
        .mb-0 { margin-bottom: 0; }
        .mb-6 { margin-bottom: 4px; }
        .mb-10 { margin-bottom: 8px; }
        .tight { margin-top: 2px; }
        .page-break { page-break-after: always; }

        .sign-grid {
            width: 100%;
            margin-top: 10mm;
            border-collapse: collapse;
        }
        .sign-grid td {
            width: 50%;
            vertical-align: top;
            padding-right: 6mm;
        }
        .sign-where {
            margin-bottom: 8mm;
        }
        .sign-line { border-bottom: 1px solid #000; height: 0; margin: 2mm 0 2mm 0; }
        .sign-caption { text-align: center; font-size: 11pt; }

        /* obrázok s podpisom požičiavateľa */
        .signature-img{
            display: block;
            max-height: 40mm;
            padding-left: 50px;
            margin: -18mm 0 -10mm 0; /* mierne „sadne“ na linku */
            opacity: .95;       /* jemná textúra ostane čitateľná pod podpisom */
        }

        /* päta – 3 mm od fyzického okraja */
        .footer{
            position: fixed;
            left: 0; right: 0;
            bottom: -9mm;     /* 3mm - bottom margin(12mm) */
            text-align: center;
            font-size: 10pt;
            color: #000;
            z-index: 10;
        }
        .footer .pagenum:before { content: counter(page); }

        /* LOGO 3 mm od okraja papiera (pri okrajoch 18/12mm => top: -15mm, left: -9mm) */
        .logo-fixed{
            position: fixed;
            top: -15mm;
            left: -9mm;
            width: 24mm;
            opacity: .3;
            z-index: 0;
        }

        /* Maska len na PRVEJ strane, aby logo nebolo vidno na 1. strane.
           Absolútne pozicovaný blok sa vyrenderuje iba na prvej strane. */
        .first-page-logo-mask{
            position: absolute;
            top: -15mm;   /* rovnaké súradnice ako logo */
            left: -9mm;
            width: 40mm;  /* trochu väčšie než logo */
            height: 25mm;
            background: #fff;
            z-index: 5;   /* nad logom, pod textom to nevadí (v ľavom hornom rohu) */
        }
    </style>
</head>
<body>

{{-- Fixné logo – na všetkých stranách okrem prvej (tam ho prekrýva maska) --}}
@if(!empty($logo_path))
    <img class="logo-fixed" src="{{ $logo_path }}" alt="WebPlace logo">
@else
    <img class="logo-fixed" src="{{ public_path('images/webplace-logo.png') }}" alt="WebPlace logo">
@endif

{{-- MASKA iba pre PRVÚ stranu – skryje logo v ľavom hornom rohu --}}
<div class="first-page-logo-mask"></div>

<div class="footer">
    <span class="pagenum"></span>
</div>

<h1>Zmluva o výpožičke</h1>
<p class="subtitle">uzatvorená podľa § 659 a&nbsp;nasl. zák. č. 40/1964 Zb. Občiansky zákonník</p>
<p class="center mb-10">(ďalej len „Zmluva“)</p>

<p class="mb-6">medzi:</p>

<table class="kv">
    <tr>
        <td class="label">Požičiavateľom:</td>
        <td class="value"><strong>WebPlace s.r.o</strong></td>
    </tr>
    <tr>
        <td class="label">Meno a&nbsp;priezvisko:</td>
        <td class="value"><strong>Patrik Karaba</strong></td>
    </tr>
    <tr>
        <td class="label">IČO:</td>
        <td class="value"><strong>52646181</strong></td>
    </tr>
    <tr>
        <td class="label">DIČ:</td>
        <td class="value"><strong>2121093139</strong></td>
    </tr>
    <tr>
        <td class="label">Sídlo:</td>
        <td class="value"><strong>Trnovo 74, 038 41 Trnovo Slovensko</strong></td>
    </tr>
</table>

<p class="tight muted">(ďalej len „požičiavateľ“)</p>

<p class="mt-10 mb-6">a</p>

<table class="kv">
    <tr>
        <td class="label">Vypožičiavateľom:</td>
        <td class="value">
            @if(!empty($company))
                <span class="line">{{ $company }}</span>
            @else
                <span class="line">&nbsp;</span>
            @endif
        </td>
    </tr>
    <tr>
        <td class="label">Meno a&nbsp;priezvisko:</td>
        <td class="value">
            @if(!empty($name))
                <span class="line">{{ $name??'' }} {{ $surname??'' }}</span>
            @else
                <span class="line">&nbsp;</span>
            @endif
        </td>
    </tr>
    <tr>
        <td class="label">Dátum narodenia / IČO :</td>
        <td class="value">
            @if(!empty($date_ico))
                <span class="line short">{{ $date_ico }}</span>
            @else
                <span class="line short">&nbsp;</span>
            @endif
        </td>
    </tr>
    <tr>
        <td class="label">Trvale bytom:</td>
        <td class="value">
            @if(!empty($address))
                <span class="line">{{ $address }}, {{ $postal }} {{ $city }} {{ $country }}</span>
            @else
                <span class="line">&nbsp;</span>
            @endif
        </td>
    </tr>
    <tr>
        <td class="label">Kontakt (Tel):</td>
        <td class="value">
            @if(!empty($phone))
                <span class="line short">{{ $phone }}</span>
            @else
                <span class="line short">&nbsp;</span>
            @endif
        </td>
    </tr>
</table>

<p class="tight muted">(ďalej len „vypožičiavateľ“)</p>
<p class="mt-8">(ďalej “požičiavateľ” a “ vypožičiavateľ” spolu ako “zmluvné strany”)</p>

<div class="article">Článok I.</div>
<div class="section-title">Úvodné ustanovenia</div>

<ol class="dec">
    <li>Požičiavateľ je výlučným vlastníkom nasledovnej veci:
        <ol class="alpha">
            <li><strong>Digitálna váha BI V2.</strong></li>
            <li><strong>100g kalibračne závažie.</strong></li>
            <li><strong>Micro USB kábel 1m/2m.</strong></li>
            <li><strong>Ručný snímač čiarového kódu.</strong></li>
            <li><strong>Držiaka ručného snímača čiarového kódu.</strong></li>
            <li><strong>RS232 -&gt; USB kábel 1,5m.</strong></li>
        </ol>
    </li>
    <li>(ďalej len „vypožičiavaná vec“ alebo „vec“), ktorú má záujem vypožičať vypožičiavateľovi
        za podmienok dohodnutých v tejto zmluve.</li>
    <li>Vypožičiavateľ je osobou, ktorá má záujem si vypožičať vec uvedenú v čl. I bode 1 tejto
        zmluvy od požičiavateľa.</li>
</ol>

<div class="page-break"></div>
<div class="article">Článok II.</div>
<div class="section-title">Predmet zmluvy</div>

<ol class="dec">
    <li>Predmetom tejto zmluvy je záväzok požičiavateľa odovzdať vec uvedenú v čl. I bode 1 tejto
        zmluvy vypožičiavateľovi do bezodplatného dočasného užívania a záväzok vypožičiavateľa
        prevziať vec uvedenú v čl. I bode 1 tejto zmluvy od požičiavateľa a po ukončení
        vypožičania ju vrátiť požičiavateľovi, a to všetko za podmienok dohodnutých v tejto
        zmluve.</li>
    <li>Požičiavateľ vypožičiava vypožičiavateľovi vec na nasledovný účel:
        <strong>Užívanie v spojení s aplikáciou www.barovainventura.sk, slúži výhradne na informatívne účely.</strong>
    </li>
    <li>Vypožičiavateľ berie na vedomie že vypožičané veci majú výhradne informatívny charakter,
        a preto ich nie je možné použiť na cenotvorbu alebo akýkoľvek účel ktorý by mal vplyv na
        zisky alebo náklady vypožičiavateľa.</li>
</ol>

<div class="article">Článok III.</div>
<div class="section-title">Odovzdanie vypožičiavanej veci</div>

<ol class="dec">
    <li>Zmluvné strany sa dohodli, že požičiavateľ odovzdá vypožičiavateľovi vypožičiavanú vec
        bezprostredne pri uzatvorení tejto zmluvy.</li>
    <li>Zmluvné strany podpisom tejto zmluvy potvrdzujú odovzdanie a prevzatie vypožičiavanej
        veci.</li>
</ol>

<div class="article">Článok IV.</div>
<div class="section-title">Práva a povinnosti zmluvných strán</div>

<ol class="dec">
    <li>Požičiavateľ sa zaväzuje odovzdať vec vypožičiavateľovi v stave spôsobilom na riadne
        a dohodnuté užívanie.</li>
    <li>Požičiavateľ sa zaväzuje informovať vypožičiavateľa o spôsobe a pravidlách užívania
        vypožičiavanej veci, najmä o návode na používanie a technických normách, ktoré sa
        vzťahujú na užívanie vypožičiavanej veci tak, aby nedošlo k jej znehodnoteniu.</li>
    <li>Vypožičiavateľ podpisom tejto zmluvy potvrdzuje, že bol zo strany požičiavateľa
        oboznámený o stave vypožičiavanej veci a o pravidlách užívania vypožičiavanej veci,
        najmä o návode na používanie a technických normách, ktoré sa vzťahujú na užívanie
        vypožičiavanej veci.</li>
    <li>Vypožičiavateľ sa zaväzuje užívať vypožičanú vec riadne a v súlade s touto zmluvou a jej
        účelom tak, aby nedošlo k poškodeniu, strate alebo zničeniu vypožičanej veci.
        Vypožičiavateľ zodpovedá požičiavateľovi za škodu spôsobenú porušením tejto
        povinnosti.</li>
    <li>Ak hrozí na vypožičanej veci bezprostredná škoda, je vypožičiavateľ povinný túto škodu
        odvrátiť. V takomto prípade má vypožičiavateľ právo požadovať od požičiavateľa náhradu
        nevyhnutných nákladov.</li>
    <li>Vypožičiavateľ berie na vedomie, že je povinný vykonávať na vlastné náklady bežnú
        údržbu a drobné opravy na vypožičanej veci.</li>
    <li>Iné než drobné opravy je povinný vykonať požičiavateľ. Vypožičiavateľ je v takomto
        prípade povinný bez zbytočného odkladu informovať požičiavateľa o potrebe
        nevyhnutných, iných než drobných, opráv, ktoré má vykonať požičiavateľ a súčasne je
        povinný umožniť požičiavateľovi vykonanie týchto opráv. V opačnom prípade zodpovedá
        vypožičiavateľ za škodu, ktorá vznikne nesplnením tejto povinnosti.</li>
    <li>Vypožičiavateľ nie je oprávnený prenechať vypožičanú vec tretím osobám. To neplatí, ak
        požičiavateľ mu udelí súhlas na prenechanie vypožičanej veci tretím osobám.</li>
    <li>Vypožičiavateľ je oprávnený prisvojiť si prípadné úžitky (plody, prírastky) vypožičanej
        veci.</li>
    <li>Vypožičiavateľ je oprávnený vrátiť vypožičanú vec požičiavateľovi v prípade, ak má táto
        vec vady, na ktoré ho požičiavateľ neupozornil.</li>
    <li>Vypožičiavateľ je povinný vrátiť vypožičanú vec požičiavateľovi po uplynutí doby
        výpožičky v stave, v akom vypožičanú vec prijal, a to s prihliadnutím na jej bežné
        opotrebenie.</li>
    <li>Požičiavateľ zodpovedá len za vady, ktoré má vypožičaná vec v čase jej odovzdania
        vypožičiavateľovi a na ktoré neupozornil vypožičiavateľa, hoci o nich vedel. Rovnako
        zodpovedá požičiavateľ za vady na vypožičanej veci v prípade, ak výslovne ubezpečil
        vypožičiavateľa, že vypožičaná vec nemá žiadne vady a uvedené vyhlásenie sa ukáže ako
        nepravdivé. V takomto prípade zodpovedá požičiavateľ vypožičiavateľovi za škodu, ktorá
        vznikla v dôsledku týchto vád. Požičiavateľ však nezodpovedá za vady v prípade, ak
        preukáže, že o existencii vád nevedel a s prihliadnutím na pomery ani vedieť nemohol.</li>
    <li>Zmluvné strany sa dohodli, že práva a povinnosti vyplývajúce z tejto zmluvy prechádzajú
        na právnych nástupcov oboch zmluvných strán.</li>
</ol>

<div class="article">Článok V.</div>
<div class="section-title">Skončenie výpožičky a zánik zmluvy</div>

<ol class="dec">
    <li>Táto zmluva zaniká uplynutím doby výpožičky.</li>
    <li>Zmluvné strany sa dohodli, že vypožičiavateľ vráti požičiavateľovi vypožičanú vec
        najneskôr do {{$param1 ?? '30'}} dni od prevzatia veci.</li>
    <li>Zmluvné strany sa dohodli, že miestom vrátenia vypožičiavanej veci je adresa požičiavateľa.</li>
    <li>Požičiavateľ berie na vedomie, že sa nemôže domáhať vrátenia vypožičiavanej veci pred
        dátumom uvedeným v bode 2 tohto článku zmluvy. To neplatí, ak vypožičiavateľ nebude
        vec užívať riadne alebo bude vec užívať v rozpore s touto zmluvou, resp. s jej účelom.
        V takomto prípade má požičiavateľ právo odstúpiť od zmluvy. Účinky odstúpenia od
        zmluvy nastanú dňom doručenia písomného odstúpenia od zmluvy druhej zmluvnej strane.
        Momentom odstúpenia od zmluvy sa zmluva zrušuje od začiatku a zmluvné strany sú
        povinné si vrátiť plnenia prijaté do momentu odstúpenia od zmluvy.</li>
</ol>

<div class="page-break"></div>
<div class="article">Článok VI.</div>
<div class="section-title">Zmluvná pokuta</div>

<ol class="dec">
    <li>Zmluvné strany sa dohodli, že v prípade, ak sa vypožičiavateľ dostane do omeškania
        s vrátením vypožičanej veci podľa čl. V tejto zmluvy, zaväzuje sa zaplatiť požičiavateľovi
        zmluvnú pokutu vo výške 2 eur (slovom: dve eura), a to za každý, aj začatý deň omeškania
        až do vrátenia veci.</li>
    <li>Zmluvné strany sa dohodli, že v prípade, ak sa vypožičaná vec zničí alebo stratí
        vypožičiavanú vec, zaväzuje sa zaplatiť požičiavateľovi zmluvnú pokutu vo výške 200 eur
        (slovom: dvesto eur).</li>
</ol>

<div class="article">Článok VII.</div>
<div class="section-title">Záverečné ustanovenia</div>

<ol class="dec">
    <li>Táto zmluva je vyhotovená v dvoch exemplároch, z toho je jeden pre požičiavateľa a jeden
        pre vypožičiavateľa.</li>
    <li>Právne vzťahy medzi zmluvnými stranami, ktoré nie sú upravené v zmluve, sa riadia
        zákonom č. 40/1964 Zb. Občiansky zákonník.</li>
    <li>Zmluva sa môže meniť alebo doplňovať výlučne formou písomných a očíslovaných
        dodatkov odkazujúcich na túto zmluvu podpísaných obidvomi zmluvnými stranami.</li>
    <li>Ak sa preukáže, že niektoré z ustanovení zmluvy (alebo jeho časť) je neplatné a/alebo
        neúčinné, takáto neplatnosť a/alebo neúčinnosť nemá za následok neplatnosť a/alebo
        neúčinnosť ďalších ustanovení zmluvy (alebo zostávajúcej časti dotknutého ustanovenia),
        alebo samotnej zmluvy. V takomto prípade sa obe zmluvné strany zaväzujú bez zbytočného
        odkladu nahradiť takéto ustanovenie (jeho časť) novým tak, aby bol zachovaný účel,
        sledovaný uzavretím zmluvy a dotknutým ustanovením.</li>
    <li>Zmluvné strany prehlasujú, že sú plne spôsobilé na uzavretie tejto zmluvy. Pred podpisom
        tejto zmluvy si ju prečítali, obsahu porozumeli a plne s ním súhlasia. Na znak svojej vôle
        byť viazaní touto zmluvou ju vlastnoručne podpisujú.</li>
    <li>Zmluvné strany prehlasujú, že ich prejavy vôle byť viazaní touto zmluvou sú slobodné,
        jasné, určité a zrozumiteľné. Zmluvná voľnosť oboch zmluvných strán nie je ničím
        obmedzená a zmluvu nepodpisujú v tiesni, v omyle, ani za nápadne nevýhodných
        podmienok.</li>
</ol>

<table class="sign-grid">
    <tr>
        <td>
            <div class="sign-where">
                V Martine, dňa: {{$now}}
            </div>

            {{-- Obrázok podpisu požičiavateľa --}}
            @if(!empty($signature_lender_path))
                <img class="signature-img" src="{{ $signature_lender_path }}" alt="Podpis požičiavateľa">
            @else
                {{-- Fallback path – uprav podľa projektu --}}
                <img class="signature-img" src="{{ public_path('images/signatures/lender.png') }}" alt="Podpis požičiavateľa">
            @endif

            <div class="sign-line"></div>
            <div class="sign-caption">Požičiavateľ</div>
        </td>
        <td>
            <div class="sign-where" style="padding-bottom: 52px">
                V ........................., dňa: .........................</div>
            <div class="sign-line"></div>
            <div class="sign-caption">Vypožičiavateľ</div>
        </td>
    </tr>
</table>

</body>
</html>
