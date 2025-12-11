@extends('web.layouts.auth')

@section('content')
    <div class="full_bg">

        <div class="container">
            <section class="signup_section">

                <div class="top_part">
                    <a href="{{route('home')}}" class="back_btn"><i class="icofont-arrow-left"></i> {{ __('web.header.home') }}</a>
                    <a class="navbar-brand" href="{{route('home')}}">
                        <img src="{{asset('img/V1 alt - W.svg')}}" alt="image">
                    </a>
                </div>

                <!-- Comment Form Section -->
                <div class="signup_form" style="width: 100%; padding: 2rem">
                    <div class="section_title">
                        <h2><span>Všeobecné obchodné podmienky</span> </h2>
                    </div>
                    <p style="color: #222; font-size: 16px;"><br>
                        <b>Úvodné ustanovenia obchodných podmienok</b><br>
                        Tieto všeobecné obchodné podmienky upravujú právne vzťahy medzi WebPlace S.R.O, so sídlom Trnovo 74, 038 41 Košťany nad Turcom, IČO:52 646 181, vedená na Okresnom súde v Žiline pod Číslom vložky 73133/L, Konateľ Patrik Karaba, a užívateľovi online aplikácie barovainventura.SK zo zmlúv o poskytovaní týchto online služieb uzatvorených prostredníctvom prostriedkov komunikácie na diaľku cez rozhranie webovej aplikácie poskytovateľa.<BR>
                        Predávajúci týmto upravuje v súlade s z.č. 40/1964 Zb. Občiansky zákonník, z.č.250/2007 Z.z. o ochrane spotrebiteľa a o zmene zákona Slovenskej národnej rady č. 372/1990 Zb. o priestupkoch v znení neskorších predpisov, z.č. 102/2014 Z.z. o ochrane spotrebiteľa pri predaji tovaru alebo poskytovaní služieb na základe zmluvy uzavretej na diaľku alebo zmluvy uzavretej mimo prevádzkových priestorov predávajúceho a o zmene a doplnení niektorých zákonov, tieto obchodné podmienky, platné pre nákup na e-shope www.barovainventura.sk<br>
                        Obchodné podmienky upravujú práva a povinnosti zmluvných strán pri využívaní webovej stránky predávajúceho umiestnené na adrese  www.barovainventura.sk  na uzavretie (uzatvorenie) kúpnej zmluvy (ďalej len „webová stránka“) a ďalšie súvisiace právne vzťahy.<br>
                        Znenie obchodných podmienok môže predávajúci meniť a dopĺňať. Neskoršími zmenami obchodných podmienok nie sú dotknuté práva a povinnosti vzniknuté po dobu účinnosti predchádzajúceho znenia obchodných podmienok.<br><br>
                        <b>1) Predávajúci</b><br>
                        Predávajúcim sa rozumie prevádzkovateľ portálu (viď. Prevádzkovateľ), ktorý je prevádzkovateľom e-shopu, webovej stránky www.barovainventura.sk   , ktorým je spoločnosť WEBPLACE podrobný popis<br><br>
                        <b>2) Kupujúci</b><br>
                        Kupujúcim sa rozumie :<br>
                        Fyzická osoba – spotrebiteľ.  Spotrebiteľom je fyzická osoba, ktorá pri uzatváraní a plnení zmluvy nekoná v rámci predmetu svojej podnikateľskej činnosti, zamestnania alebo povolania.<br>
                        Právnicka osoba, fyzická osoba - ktorá koná v rámci predmetu svojej podnikateľskej činnosti<br>
                        Zmluvy, ktoré sú uzatvárané kupujúcim, sa riadia najmä z.č. 40/1964 Zb. Občianskym zákonníkom v platnom znení, Obchodným zákonníkom 513/1991 Z.z.,  z.č.250/2007 Z.z. o ochrane spotrebiteľa a o zmene zákona Slovenskej národnej rady č. 372/1990 Zb. o priestupkoch v znení neskorších predpisov, z.č. 102/2014 Z.z. o ochrane spotrebiteľa pri predaji tovaru alebo poskytovaní služieb na základe zmluvy uzavretej na diaľku alebo zmluvy uzavretej mimo prevádzkových priestorov predávajúceho a o zmene a doplnení niektorých zákonov.<br><br>
                        <b>3) Objednávka, kúpna zmluva</b><br>
                        Návrhom k uzatvoreniu kúpnej zmluvy (ponukou) je umiestnenie tovaru predávajúcim na www.barovainventura.sk kúpna zmluva vzniká, pokiaľ nie je uvedené inak, odoslaním objednávky kupujúcim – spotrebiteľom a prijatím objednávky predávajúcim. Toto prijatie predávajúci bez zbytočného odkladu potvrdí kupujúcemu informatívnym e-mailom. Vzniknutú zmluvu (vrátane dohodnutej ceny) je možné meniť alebo zrušiť iba na základe dohody strán alebo na základe zákonných dôvodov. Predávajúci si okrem toho vyhradzuje právo na zrušenie objednávky alebo kúpnej zmluvy na základe dohody s kupujúcim v prípadoch, kedy zjavnou technickou chybou cena, veľkosť alebo vlastnosti tovaru vykazujú celkom zjavne chybu a došlo k hrubému nepomeru medzi vzájomnými plneniami alebo ak predávajúci tovar aktuálne vypredal. V prípade, že kupujúci zaplatil už časť alebo celkovú kúpnu cenu, bude mu táto čiastka prevedená späť na jeho účet bez zbytočného odkladu alebo poukázaná na ním uvedenú adresu, tým kúpna zmluva zaniká.<br><br>
                        <b>4) Tovar</b><br>
                        Tovarom sa rozumie : aplikácia barová inventúra, ktorá je  ponúkaná predávajúcim prostredníctvom e-shopu  www.barovainventura.sk . Cena je platná po dobu, po ktorú je zverejnená. Predmetná aplikácia podporuje nasledujúci odmeňovací systém :<br>
                        Bar 1 – užívateľ aplikácie<br>
                        Bar 2 – pozvaný používať aplikáciu od Bar 1<br><br>

                        1.	Bar 1 pozve Bar 2 používať aplikáciu<br>
                        2.	Bar 2 dostane zľavu na prvú platbu 10% (len v prípade že sa zaregistruje pod URL adresou ktorú mu pošle Bar 1)<br>
                        3.	Bar 2 to prijme a zaplatí si prístup na 1 mesiac<br><br>

                        Ako náhle prebehne platba od Bar 2 tak Bar 1 získava zľavu 20% na dali mesiac(len v prípade že sa Bar 2 zaregistruje pod URL adresou ktorú mu pošle Bar 1).<br><br>

                        Percentuálne zľavy budú zobrazene v hornej časti rozhrania po prihlásení, zľavy sú automaticky odpočítavane pri platbe, príklad (Ak ma užívateľ zľavu 50% tak pri objednávaní služby na dlani mesiac mu je 50% automaticky odpočítaných z celkovej sumy, takže neje možne sít u zľavu odkladať a presúvať, platnosť zľavy je nekonečna, takže ak si pol roka nekúpi službu a na učte ma napríklad 10% zľavu tak ta zľava bude platná až do kým ju nevyčerpá).<br><br>
                        <b>5) Cena</b><br>
                        Čiastka, ktorá je u predmetnej aplikácií uvedená,  je uvedená je vrátane DPH. Tato čiastka však neobsahuje náklady na dodanie, ktoré sú uvedené samostatne. Konečná čiastka, ktorú bude kupujúci platiť za tovar vrátane jeho dodania, je uvedená na konci objednávky a bude potvrdená predávajúcim zaslaním potvrdenia o uzavretí kúpnej zmluvy.<br><br>
                        <b>6) Spôsob platby</b><br>
                        Kupujúci je oprávnený zvoliť pri nákupe tovaru niektorú z týchto alternatív platby:<br>
                        a.	platba v hotovosti na dobierku<br>
                        b.	platba vopred prostredníctvom platobnej karty<br><br>

                        <b>7) Zabezpečenie</b><br>
                        Prístup k užívateľskému účtu je zabezpečený užívateľským menom a heslom. Kupujúci je povinný zachovávať mlčanlivosť ohľadom informácií nevyhnutných k prístupu na jeho užívateľský účet a berie na vedomie, že predávajúci nezodpovedá za prípadné dôsledky porušenia tejto povinnosti zo strany kupujúceho.<br>
                        Registráciou sa rozumie uvedenie mena, priezviska, adresy, e-mailu a telefónu do formulára uvedeného na hlavnej strane predávajúceho. Pri registrácii na webovej stránke a pri objednávaní aplikácie je kupujúci povinný uvádzať správne a pravdivé všetky údaje. Údaje uvedené v užívateľskom účte je kupujúci pri akejkoľvek ich zmene povinný aktualizovať.<br><br>
                        <b>8) Spracovanie osobných údajov a nakladanie s osobnými údajmi</b><br>
                        Predávajúci spracováva osobné údaje a nakladá s nimi v súlade so zákonom o spracovaní osobných údajov, zák.č. zákona č. 122/2013 Z.z. o ochrane osobných údajov a o zmene niektorých zákonov (ďalej len „Zákon o ochrane osobných údajov“).<br>
                        Predávajúci týmto oznamuje kupujúcemu, že v zmysle §10 ods. 3 písm. b)  Zákona o ochrane osobných údajov predávajúci ako prevádzkovateľ bude v procese uzatvárania kúpnej zmluvy spracúvať osobné údaje kupujúceho bez jeho súhlasu ako dotknutej osoby, keďže spracúvanie osobných údajov kupujúceho bude vykonávané predávajúcim v predzmluvných vzťahoch s kupujúcim a spracúvanie osobných údajov je nevyhnutné na plnenie z kúpnej zmluvy, v ktorej vystupuje kupujúci ako jedna zo zmluvných strán.<br>
                        Zmluvné strany sa dohodli, že kupujúci v prípade, že je spotrebiteľom je povinný oznámiť predávajúcemu v objednávke svoje meno  a priezvisko, adresu trvalého bydliska vrátane PSČ, číslo telefónu a e-mail adresu. Zmluvné strany sa dohodli, že kupujúci v prípade, že je podnikateľom je povinný oznámiť predávajúcemu v objednávke svoje obchodné meno, adresu sídla vrátane PSČ, IČO, telefónne číslo a e-mail adresu.<br>
                        Kupujúci môže zaškrtnutím príslušného políčka pred odoslaním objednávky vyjadriť svoj súhlas v zmysle §-u 11 ods. 1 Zákon o ochrane osobných údajov, aby predávajúci spracoval a uschovával jeho osobné údaje, najmä tie, ktoré sú uvedené vyššie a/alebo ktoré sú potrebné pri činnosti predávajúceho týkajúcej sa zasielania informácií o nových produktoch, zľavách a akciách na ponúkaný tovar. Kupujúci udeľuje predávajúcemu tento súhlas na dobu určitú do splnenia účelu spracúvania osobných údajov kupujúceho. Predávajúci po splnení účelu spracúvania zabezpečí bezodkladne likvidáciu osobných údajov kupujúceho. Súhlas so spracovaním osobných údajov môže kupujúci kedykoľvek písomne odvolať. Súhlas zanikne v lehote 1 mesiaca od doručenia odvolania súhlasu kupujúcim predávajúcemu.<br>
                        Kupujúci berie na vedomie, že je povinný svoje osobné údaje (pri registrácii užívateľského účtu alebo pri objednávke) uvádzať správne a pravdivo a že je povinný bez zbytočného odkladu informovať predávajúceho o zmene svojich osobných údajov.<br><br>


                        <b>9) Reklamácie</b><br>

                        1. Práva Užívateľa z chybného plnenia sa riadi platnými právnymi predpismi.<br>
                        2. Užívateľ je oprávnený reklamovať Služby, doplnkové služby a ďalšie plnenie, ak nezodpovedajú popisu na Webovom rozhranie, nie sú poskytované po objednanú dobu alebo sú z iného dôvodu v rozpore so zmluvou.<br>
                        3. Reklamáciu je Používateľ povinný oznámiť Poskytovateľovi čo najskôr po zistení závady (najneskôr však do 6 mesiacov od zistenia), a to na kontaktný e-mail Poskytovateľa. Reklamácia by mala obsahovať popis chyby a všetky k tomu relevantné skutočnosti. Zároveň s oznámením závady oznámi Užívateľ spôsob, ktorým by chcel reklamáciu riešiť. Poskytovateľ si vyhradzuje právo ponúknuť iný ako navrhnutý spôsob riešenie.Ak využijete reklamáciu formou emailovej korešpondencie, kontaktujte Poskytovateľa na adrese info@barovainventura.sk<br>
                        4. Právo z chybného plnenia Služby Barová inventúra musí Užívateľ uplatniť najneskôr do dvoch dní po opätovnom sprevádzkovaní Služby Barová inventúra. Neskôr podaná reklamácia bude odmietnutá a Užívateľ stráca nároky zo zodpovednosti za vady.<br>
                        5. Užívateľ môže požadovať bezplatné odstránenie vady, primeranú zľavu z ceny alebo poskytnutia náhradnej Služby bez vád. Užívateľ môže prípadne od zmluvy odstúpiť.<br>
                        6. Poskytovateľ rozhodne o spôsobe vybavenia reklamácie v lehote 30 dní odo dňa, keď mu bola doručená. O tomto bude Používateľa informovať emailom.<br>
                        7. Ak je reklamácia uznaná za oprávnenú, Poskytovateľ bezodkladne zjedná nápravu. Poskytovateľ ponúka Používateľovi táto náhradné plnenie (ako práva z chybného plnenia):<br>
                        • (I) poskytnutím náhradnej Služby, alebo<br>
                        • (II) bezplatným predĺžením predplateného obdobia.<br>
                        Riešenie reklamácie vrátením kreditov do Peňaženky alebo vrátením peňazí na účet je spravidla iba v prípadoch, kedy iné spôsoby riešenia nepripadajú do úvahy.<br>
                        8. Ak dostupnosť Služby klesne pod dostupnosť garantovanú (SLA), ide o vadné plnenie Služby a Užívateľ má nárok na primeranú zľavu z kúpnej ceny. Primeraná zľava z kúpnej ceny sa stanoví ako dvojnásobok alikvotnú časti ceny za Službu, ktorá z dôvodu jej nedostupnosti nemohla byť využitá.<br>
                        9. Reklamovať je možné nesprávne dobitie kreditu alebo nesprávne odpočítaní kreditu. Užívateľ je povinný reklamáciu uplatniť bez zbytočného odkladu po tom, čo používateľ zistí, že kredity neboli pripísané v správnej výške, alebo že prípadne neboli v správnej výške z účtu odpočítané. V takom prípade je Užívateľ povinný kontaktovať Poskytovateľa a predložiť doklad o platbe. Ak je reklamácia oprávnená, bude Užívateľovi pripísaný kredit v správnej výške.<br>
                        10. Podanie reklamácie nemá odkladný účinok na úhradu ceny za poskytnutú Službu.<br><br>

                        <b>10) Odstúpenie od zmluvy</b><br>

                        A. Odstúpenie od zmluvy zo strany užívateľa - Garancia vrátenia peňazí<br>

                        1. Poskytovateľ poskytuje Užívateľovi možnosť pri prvom nákupe odstúpiť od Zmluvy s garanciou vrátenia peňazí pre prípad, že sa Službou nebude spokojný či zistí, že zakúpená Služba pre neho nie je vhodná. Užívateľ môže garancia vrátenia peňazí využiť do 30 dní od uhradenia ceny Služby za prvé predplatené obdobie. Odstúpenie od zmluvy nemusí byť nijako odôvodnené. Na účely vrátenia peňazí Užívateľ zvolí účet, kam mu majú byť peniaze zaslané; Ak Užívateľ nezvolí žiadny účet, bude vyzvaný k uvedeniu účtu formou e-mailu. Na vrátenú sumu vystaví Poskytovateľ opravný daňový doklad. Poskytovateľ sa zaväzuje vrátiť Používateľovi peniaze do 30 dní odo dňa potvrdenia prijatia opravného daňového dokladu zo strany Užívateľa (netýka sa Užívateľov, ktorí sú spotrebiteľmi).<br>
                        2. Užívateľ môže odstúpenie zaslať e-mailom, poštou, osobne alebo iným podobným spôsobom, ktoré umožnia zachytenie obsahu správy a identifikáciu Užívateľa, s podpisom oprávneného zástupcu Užívateľa.<br>
                        B. ODSTÚPENIE OD ZMLUVY ZO STRANY POSKYTOVATEĽA<br>

                        1. V prípade, že Užívateľ poruší povinnosti stanovené zákonom alebo zmluvou alebo neuhradí riadne a včas cenu za Službu, má Poskytovateľ právo obmedziť Užívateľovi používať Služby, či od Zmluvy odstúpiť.<br>
                        2. Poskytovateľ má právo od zmluvy odstúpiť bez zbytočného odkladu po tom čo zistí, že druhá strana porušila Zmluvu podstatným spôsobom.<br>
                        3. Na účely tejto zmluvy sa za podstatné porušenie považuje:<br>
                        • omeškania Užívateľa s úhradou platby dlhšia ako 30 dní<br>
                        • porušenie licenčného ujednania práv na ochranu autorských práv a povinností<br>
                        • rokovaním Používateľa, ktoré poškodzuje aplikácie, softvér, ktorý je súčasťou Služby, alebo sa inak snažia obísť tarifné obmedzenia;<br>
                        • využívaní Služby v rozpore s právnymi predpismi alebo s dobrými mravmi;<br>
                        • konanie, ktoré je spôsobilé priamo alebo nepriamo poškodiť dobré meno Poskytovateľa, Užívateľ Poskytovateľovi neposkytne vyžiadané údaje alebo budú tieto údaje nepravdivé,<br>
                        • rokovaní Užívateľa, ktorým Užívateľ poškodzuje webovú aplikáciu Poskytovateľa alebo sa snaží obísť tarifné obmedzenia.<br>
                        4. Používateľovi v takom prípade nevzniká nárok na vrátenie zaplatenej ceny za využívanie Služby.<br>
                        5. Poskytovateľ môže odstúpenie zaslať e-mailom na adresu uvedenú v užívateľskom účte Užívateľa alebo poštou na adresu sídla / miesta podnikania Užívateľa.<br><br>





                        Spracovaním osobných údajov kupujúceho môže predávajúci poveriť tretiu osobu ako spracovateľa.<br><br>

                    </p>
                </div>
            </section>
        </div>

    </div>
@endsection

