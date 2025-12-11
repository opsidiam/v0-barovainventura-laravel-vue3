@extends('layouts.app')
@section('content')
    <div class="page-header" data-parallax="true" style="background-image: url({{asset('web/assets/img/sidebar_img.jpg')}}); height: 30vh;">
    </div>
    <div class="main main-raised">
        <div class="container">
            <div class="section section-contacts">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <h2 class="text-center title">INFORMÁCIE O SPRACÚVANÍ OSOBNÝCH ÚDAJOV</h2>
                        <p style="color: #222; font-size: 16px;">Pri spracúvaní osobných údajov postupujeme v súlade s platnou legislatívou upravujúcou ochranu osobných údajov a zabezpečujeme  ich ochranu v maximálne možnej miere. <br><br>
                            <b>Legislatíva:</b><br>
                            Nariadenie Európskeho parlamentu a rady (EÚ) 2016/679 zo dňa 27.04.2016 o ochrane fyzických osôb v súvislosti so spracovaním osobných údajov a voľnom pohybe týchto údajov a zrušení smernice 95/46/ES (všeobecné nariadenie o ochrane osobných údajov) (ďalej len „GDPR“),<br>
                            Zákon č. 18/2018 Z. z. o ochrane osobných údajov (ďalej len „zákon č. 18/2018 Z. z.“)<br><br>
                            V týchto informáciách je uvedené, ako nakladáme s Vašimi osobnými údajmi, ako nás môžete kontaktovať, ak máte otázky týkajúce sa spracúvania Vašich osobných údajov a ďalšie dôležité informácie. Odporúčame, aby ste sa s týmito informáciami dôkladne oboznámili. Aktuálne informácie týkajúce sa spracúvania Vašich osobných údajov budú zverejnené na našej webovej stránke  www.barovainventura.sk a tiež budú dostupné v priestoroch našich prevádzok. Informácie, ktoré sme Vám povinní vzhľadom na naše spracúvanie osobných údajov poskytnúť, sa môžu meniť alebo prestanú byť aktuálne. Z tohto dôvodu si vyhradzujeme možnosť kedykoľvek tieto podmienky upraviť a zmeniť v akomkoľvek rozsahu. V prípade, že zmeníme tieto podmienky podstatným spôsobom, túto zmenu Vám dáme do pozornosti napr. všeobecným oznámením na našej webovej adrese alebo osobitným oznámením prostredníctvom emailu.
                            <br><br>
                            <b>Prevádzkovateľ:</b><br>
                            Prevádzkovateľom informačných systémov, v ktorých sú spracúvané Vaše osobné údaje je:<br>
                            WebPlace s. r. o. so sídlom Trnovo 74, 038 41 Košťany nad Turcom,<br>
                            IČO: 52 646 181<br>
                            E- mail: info@barovainventura.sk<br>
                            Telefón: +421 948 357 763<br>
                            <br>
                            <b>Zodpovedná osoba</b><br>Zodpovedná osoba za ochranu osobných údajov Vám zodpovie prípadné otázky týkajúce sa spracúvania osobných údajov. Zodpovednú osobu môžete kontaktovať emailom na adresu: info@barovainventura.sk, telefonicky na číslo: +421 948 357 763 alebo písomne poštou na vyššie uvedenú adresu prevádzkovateľa.
                            <br>
                            <br>
                            <b>Osobné údaje, ktoré spracúvame a účel ich spracúvania:</b><br>
                            Prevádzkovateľ spracúva  osobné údaje obchodných a zmluvných partnerov a zákazníkov za účelom zabezpečenia zmluvných vzťahov prevádzkovateľa, fakturácie dotknutých osôb, vedenia účtovníctva pri založení a vedení predzmluvných a zmluvných vzťahov, plnenie zákonných povinností, zabezpečenie IT bezpečnosti,  daňové účely  a to najmä meno, priezvisko, adresa miesta podnikania, prevádzkarne, bydliska, dátum narodenia,  ale aj akékoľvek iné informácie a charakteristiky, na základe ktorých možno určiť fyzickú osobu.<br><br>
                            <b>Osobné údaje spracúvame v nasledovnom rozsahu:</b><br>
                            Identifikačné údaje: titul, meno, priezvisko, rodné priezvisko, dátum narodenia, rodné číslo, adresa, štátna príslušnosť, číslo občianskeho preukazu alebo pasu.
                            Kontaktné údaje: emailová adresa a telefónne číslo.<br><br>
                            <b>Právny základ:</b><br>
                            Právnym základom spracúvania osobných údajov je:<br>
                            -	článok 6. ods. 1 písm. a), písm. b), písm. f)  Nariadenia Európskeho parlamentu a rady (EÚ) 2016/679 zo dňa 27.04.2016 o ochrane fyzických osôb v súvislosti so spracovaním osobných údajov a voľnom pohybe týchto údajov a zrušení smernice 95/46/ES (všeobecné nariadenie o ochrane osobných údajov) (ďalej len „GDPR“)<br>
                            -	§ 13 ods. 1 zákona č. 18/2018 Z. z.<br>
                            -	zákon č. 513/1991 Z. z. Obchodný zákonník v znení neskorších predpisov<br>
                            -	zákon č. 40/1964 Zb. Občiansky zákonník v znení neskorších predpisov<br>
                            -	zákon č. 455/191 Zb. o živnostenskom podnikaní v znení neskorších predpisov<br>
                            -	zákon č. 431/2002 Z. z. o účtovníctve v znení neskorších predpisov<br>
                            -	zákon č. 563/2009 Z. z. o správe daní v znení neskorších predpisov<br>
                            -	zákon č. 595/2003 Z. z. o dani z príjmov v znení neskorších predpisov.<br><br>
                            Poskytovanie osobných údajov je požiadavkou, ktorá je potrebná na účely uzatvorenia uvedených zmlúv. Pokiaľ dotknutá osoba neposkytne svoje osobné údaje, nebude možné uzavrieť zmluvu.<br><br>
                            Poloautomatizované spracovanie osobných údajov: MS Office<br>
                            Neautomatizované spracovanie osobných údajov: objednávky, zmluvy, faktúry<br>
                            Dotknuté osoby: zmluvní partneri a zákazníci<br>
                            Kategória príjemcov: daňový úrad, príslušné štátne orgány na základe príslušných právnych predpisov.<br><br>
                            <b>Doba uchovávania Vašich osobných údajov:</b><br>
                            Vaše osobné údaje budeme uchovávať najviac do času, kým je to potrebné na účely, na ktoré sa osobné údaje spracúvajú.<br><br>
                            <b>S kým budú zdieľané Vaše osobné údaje:</b><br>
                            Osobné údaje našich zákazníkov a iných fyzických osôb sprístupňujeme len v nevyhnutnej miere a vždy pri zachovaní mlčanlivosti príjemcu údajov napr. našim zamestnancom, osobám, ktoré poverujeme vykonaním jednotlivých úkonov našich služieb, alebo právnych služieb spolupracujúcim advokátom,  našim účtovným poradcom,  alebo poskytovateľom softvérového vybavenia alebo podpory našej kancelárie, vrátane zamestnancov týchto osôb.<br><br>
                            <b>Budú Vaše osobné údaje poskytnuté mimo Európskej únie?</b><br>
                            Prenos osobných údajov do tretej krajiny alebo medzinárodnej organizácie sa neuskutočňuje.<br><br>
                            <b>Aké máte práva?</b><br>
                            <b>Právo na informácie:</b><br>
                            Ako prevádzkovateľ poskytneme informácie, spôsobom, ktorý pre Vás ako dotknutú osobu zabezpečí prístup k informáciám. Informácie o ochrane vašich osobných údajov sa nachádzajú na našej webovej stránke www.barovainventura.sk<br><br>
                            <b>Právo odvolať súhlas:</b><br>
                            V prípadoch, kedy Vaše osobné údaje spracúvame na základe Vášho súhlasu, máte právo tento súhlas kedykoľvek odvolať. Súhlas môžete odvolať elektronicky, na adrese zodpovednej osoby, písomne, oznámením o odvolaní súhlasu alebo osobne v prevádzke prevádzkovateľa. Odvolanie súhlasu nemá vplyv na zákonnosť spracúvania osobných údajov, ktoré sme na jeho základe o Vás spracúvali. Po odvolaní súhlasu budú Vaše osobné údaje zlikvidované.<br><br>
                            <b>Právo na prístup:</b><br>
                            Máte právo na poskytnutie kópie osobných údajov, ktoré o Vás máme k dispozícii, ako aj na informácie o tom, ako Vaše osobné údaje používame. Vo väčšine prípadov Vám budú Vaše osobné údaje poskytnuté v písomnej listinnej forme, pokiaľ nepožadujete iný spôsob ich poskytnutia. Ak ste o poskytnutie týchto informácií požiadali elektronickými prostriedkami, budú Vám poskytnuté elektronicky, ak to bude technicky možné.<br><br>
                            <b>Právo na opravu:</b><br>
                            Prijímame primerané opatrenia, aby sme zabezpečili presnosť, úplnosť a aktuálnosť informácií, ktoré o Vás máme k dispozícii. Ak si myslíte, že údaje, ktorými disponujeme sú nepresné, neúplné alebo neaktuálne, prosím, neváhajte nás požiadať, aby sme tieto informácie upravili, aktualizovali alebo doplnili.<br><br>
                            <b>Právo na výmaz (na zabudnutie):</b><br>
                            Máte právo nás požiadať o vymazanie Vašich osobných údajov, napríklad v prípade, ak osobné údaje, ktoré sme o Vás získali, už viac nie sú potrebné na naplnenie pôvodného účelu spracúvania. Vaše právo je však potrebné posúdiť z pohľadu všetkých relevantných okolností. Napríklad, môžeme mať určité právne a regulačné povinnosti, čo znamená, že nebudeme môcť Vašej žiadosti vyhovieť.<br><br>
                            <b>Právo na obmedzenie spracúvania:</b><br>
                            Za určitých okolností ste oprávnený nás požiadať, aby sme prestali používať Vaše osobné údaje. Ide napríklad o prípady, keď si myslíte, že osobné údaje, ktoré o Vás máme, môžu byť nepresné alebo keď si myslíte, že už Vaše osobné údaje nepotrebujeme využívať.<br><br>
                            <b>Právo na prenosnosť údajov:</b><br>
                            Za určitých okolností máte právo požiadať nás o prenos osobných údajov, ktoré ste nám poskytli, na inú tretiu stranu podľa Vášho výberu. Právo na prenosnosť sa však týka len osobných údajov, ktoré sme od Vás získali na základe súhlasu alebo na základe zmluvy, ktorej ste jednou zo zmluvných strán.<br><br>
                            <b>Právo namietať:</b><br>
                            Máte právo namietať voči spracúvaniu údajov, ktoré je založené na našich legitímnych oprávnených záujmoch. V prípade, ak nemáme presvedčivý legitímny oprávnený dôvod na spracúvanie a Vy podáte námietku, nebudeme Vaše osobné údaje ďalej spracúvať.<br><br>
                            <b>Spôsob uplatňovania Vašich práv:</b><br>
                            Vaše práva môžete uplatniť zaslaním písomnej žiadosti poštou na adresu prevádzkovateľa, elektronicky  na emailovú adresu alebo osobne u prevádzkovateľa. Pri žiadostiach najmä o prístup alebo prenos osobných údajov sme povinní overiť Vašu totožnosť na základe predloženia Vášho preukazu totožnosti s fotografiou (občiansky preukaz alebo pas) k nahliadnutiu. Z tohto dôvodu je možné takéto žiadosti uplatniť len osobne u prevádzkovateľa. Na Vašu žiadosť týkajúcu sa spracúvania osobných údajov budeme odpovedať bez zbytočného odkladu, najneskôr do jedného mesiaca od jej doručenia. V osobitných prípadoch môže byť lehota predĺžená o ďalší mesiac, ale vždy budete informovaný o dôvodoch predĺženia lehoty.<br><br>
                            <b>Právo podať návrh na začatie konania o ochrane osobných údajov:</b><br>
                            Ak sa domnievate, že Vaše osobné údaje spracúvane nespravodlivo alebo nezákonne, môžete podať sťažnosť na dozorný orgán, ktorým je Úrad na ochranu osobných údajov Slovenskej republiky, Hraničná 12, 820 07 Bratislava 27; tel. číslo: +421 /2/ 3231 3214; mail: statny.dozor@pdp.gov.sk, https://dataprotection.gov.sk. V prípade podania návrhu elektronickou formou je potrebné, aby spĺňal náležitosti podľa § 19 ods. 1 zákona č. 71/1967 Zb. o správnom konaní (správny poriadok).<br><br>
                            <b>Využitie súborov cookies</b><br>
                            Tento webový server využíva súbory cookies, aby stránky prispôsobil Vašim potrebám. Cookie je textový súbor, ktorý server uloží na Váš pevný disk. Tento súbor  rozširuje funkcie, dostupné na stránkach a umožňuje presnejšiu analýzu ich využitia. Bez ohľadu na spôsob použitia tieto súbory nebudú zhromažďovať osobne identifikovateľné informácie. Svoj webový prehliadač môžete nastaviť tak, aby tieto súbory prijímal alebo odmietal. V prípade odmietnutia nebude možné dobre využiť interaktívne prvky, ktoré môžu naše stránky obsahovať. Ak tieto  budú poskytované ďalej, tak už len ako anonymizované údaje, teda už to nebudú osobné údaje.<br><br>
                            Cookies sú malé textové súbory, ktoré môžu byť pri návšteve webových stránok odosielané do prehliadača a vzápätí ukladané do Vášho zariadenia (počítač, smartfón, tablet). Cookies sa ukladajú do priečinka pre súbory Vášho prehliadača a obvykle obsahujú názov webovej stránky, z ktorého pochádzajú, platnosť a hodnotu. Pri ďalšej návšteve stránky webový prehliadač cookies znovu načíta a tieto informácie odošle späť webovej stránke.<br><br>
                            Cookies používame s cieľom optimálne vytvárať a skvalitňovať naše služby, prispôsobiť ich Vašim záujmom a potrebám a zlepšovať ich štruktúru a obsah. na našich stránkach môžu byť použité dočasné alebo trvalé cookies. Dočasné sa uchovávajú vo Vašom zariadení, kým stránku neopustíte. trvalé cookies zostávajú na Vašom zariadení do uplynutia ich platnosti alebo manuálneho vymazania. Doba, počas ktorej si informácie ponechávame, závisí od typu súborov cookies.<br><br>
                            Súbory cookies môžete kontrolovať resp. zmazať podľa vlastného uváženia – podrobnosti nájdete na webovej stránke aboutcookies.org. Môžete vymazať všetky súbory cookies uložené vo Vašom počítači a väčšine prehliadačov môžete znemožniť ich ukladanie. V takom prípade však pravdepodobne budete musieť pri každej návšteve webovej lokality niektoré nastavenia upravovať manuálne a niektoré služby a funkcie nebudú fungovať správne.<br>
                            <br><br>Platné od 1.06.2021
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
