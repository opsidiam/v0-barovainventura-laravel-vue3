<?php

return [
    'newsletter' => [
        'title'             => 'Prihláste sa na odber',
        'subtitle'          => 'Buďte medzi prvými, ktorí dostanú najnovšie články priamo do svojej e-mailovej schránky',
        'email_placeholder' => 'Zadajte svoj e-mail',
        'submit'            => 'ODOSLAŤ',
    ],

    'download' => [
        'title' => 'Všetko, čo potrebujete pre systém Barová Inventúra, na jednom mieste',
        'breadcrumbs' => [
            'home'  => 'Domov',
            'title' => 'Na stiahnutie',
        ],

        // karty na stránke Na stiahnutie
        'cards' => [
            'pc_win' => [
                'title'    => 'PC aplikácia',
                'subtitle' => '(Windows)',
                'desc'     => 'Počítačová aplikácia na vykonanie inventúry. Slúži výhradne na vykonanie inventúry v spojení s váhou a skenerom. Na prehľad a uzavretie inventúry slúži webová administrácia.',
                'cta'      => 'Stiahnuť',
                // voliteľne: priamo URL, ak ju máš
                // 'url'   => route('register'),
            ],
            'manual_pdf' => [
                'title'    => 'Používateľská príručka',
                'subtitle' => '(PDF)',
                'desc'     => 'Príručka na ovládanie aplikácie a váhy – všetky potrebné informácie na jednom mieste v PDF.',
                'cta'      => 'Stiahnuť',
            ],
            'pc_mac' => [
                'title'    => 'PC aplikácia',
                'subtitle' => '(macOS)',
                'desc'     => 'Počítačová aplikácia na vykonanie inventúry. Slúži výhradne na vykonanie inventúry v spojení s váhou a skenerom. Na prehľad a uzavretie inventúry slúži webová administrácia.',
                'note'     => 'Intenzívne na tom pracujeme',
            ],
            'mobile_android' => [
                'title'    => 'Mobilná aplikácia',
                'subtitle' => '(Android)',
                'desc'     => 'Pomocná sila v prípade, že máte sklad mimo baru. Aplikácia slúži na naskenovanie a zadanie počtu plných fliaš a kusových produktov v sklade. Na prehľad a uzavretie inventúry slúži webová administrácia; na proces inventúry slúži PC aplikácia.',
                'note'     => 'Intenzívne na tom pracujeme',
            ],
            'mobile_ios' => [
                'title'    => 'Mobilná aplikácia',
                'subtitle' => '(iOS)',
                'desc'     => 'Pomocná sila v prípade, že máte sklad mimo baru. Aplikácia slúži na naskenovanie a zadanie počtu plných fliaš a kusových produktov v sklade. Na prehľad a uzavretie inventúry slúži webová administrácia; na proces inventúry slúži PC aplikácia.',
                'note'     => 'Intenzívne na tom pracujeme',
            ],
        ],
    ],

    'support' => [
        'title' => 'Kontaktovať podporu',
        'text'  => 'Vyplňte formulár nižšie a stručne popíšte problém. Ozveme sa vám čo najskôr. V naliehavých prípadoch napíšte na info@barovainventura.sk.',
        'breadcrumbs' => [
            'title' => 'Kontaktovať podporu',
            'home'  => 'Domov',
        ],
    ],

    'contract' => [
        'title'      => 'Zapožičanie zariadenia',
        'text'       => 'Táto stránka slúži na vyplnenie žiadosti o zapožičanie zariadenia.',
        'form_title' => 'Zmluva o zapožičaní zariadenia',
        'form_text'  => 'Po vyplnení tohto formulára vám bude vygenerovaná zmluva. Stiahnite si ju a podpíšte. Podpísanú zmluvu následne v ďalšom kroku nahrajte a odošlite.',
        'form_done_title' => 'Podpísanie a odoslanie zmluvy',
        'form_done_text'  => 'Stiahnite si vygenerovanú zmluvu, vytlačte ju, podpíšte a nahrajte späť cez formulár nižšie.',

        'download_pdf_button' => 'Stiahnuť zmluvu (PDF)',
        'download_help'       => 'Po stiahnutí zmluvu vytlačte a podpíšte.',
        'upload_hint'         => 'Naskenujte podpísanú zmluvu a nahrajte ju nižšie (PDF alebo obrázok).',
        'upload_label'        => 'Podpísaná zmluva (PDF/JPG/PNG)',
        'upload_note'         => 'Max. 10 MB. Povolené formáty: PDF, JPG, PNG.',
        'submit_button'       => 'Odoslať',
        'upload_done'         => 'Zmluva bola úspešne nahraná.<br>Náš administrátor ju skontroluje a po úspešnej kontrole vám odošleme zariadenia na zadanú adresu.',
    ],


    'pricelist' => [
        'title' => 'Naše ceny a plány',
        'breadcrumbs' => [
            'home'      => 'Domov',
            'pricelist' => 'Naše ceny a plány',
        ],
        'section' => [
            'title'  => 'Jednoduché a férové <span>ceny</span>',
            'toggle' => [
                'month' => 'Mesačne',
                'year'  => 'Ročne',
                'offer' => '-10 %',
            ],
        ],

        'plans' => [
            'monthly' => [
                'name'    => '30 dní',
                'tagline' => 'Pre začiatok',
            ],
            'yearly' => [
                'name'    => '360 dní',
                'tagline' => 'Najlepšia hodnota',
            ],
        ],

        'features' => [
            'duration'    => 'Doba',
            'locations'   => 'Počet podnikov',
            'access'      => 'Prístup',
            'email_notif' => 'Notifikácie e-mailom',
            'pdf_export'  => 'PDF výstup',
            'access_full' => 'Plný',
            'yes'         => 'Áno',
        ],

        'cta'        => 'Objednať',
        'note'       => 'Ceny sú za 1 podnik.',
        'per_outlet' => '/podnik',

        'faq' => [
            'items' => [
                [
                    'q' => 'Koľko stojí používanie Barovej Inventúry?',
                    'a' => 'Štandardná cena je <strong>:price € mesačne za jednu prevádzku</strong>.',
                ],
                [
                    'q' => 'Ako sa počíta cena?',
                    'a' => 'Cena závisí <strong>iba od počtu prevádzok</strong> vo vašom účte.',
                ],
                [
                    'q' => 'Ponúkate skúšobné obdobie?',
                    'a' => 'Áno, systém si môžete bezplatne vyskúšať počas skúšobného obdobia.',
                ],
                [
                    'q' => 'Aké sú možnosti platby a fakturácie?',
                    'a' => 'Platba prebieha <strong>na faktúru</strong>. Po odoslaní objednávky budete presmerovaní na <strong>firemnú platobnú bránu</strong>, kde nájdete <strong>QR kód na platbu</strong> a možnosť <strong>stiahnuť faktúru</strong>. Faktúru dostanete e-mailom <strong>pred aj po úhrade</strong>.',
                ],
                [
                    'q' => 'Ponúkate zľavy pri viacerých prevádzkach?',
                    'a' => 'Áno. Ak máte <strong>viac ako jednu prevádzku</strong>, získavate <strong>automaticky 5&nbsp;% zľavu</strong> na objednávku licencie.',
                ],
                [
                    'q' => 'Je v cene zahrnutý aj hardvér (váha, skener)?',
                    'a' => 'Hardvér je <strong>samostatný</strong> a dá sa <strong>zakúpiť priamo v aplikácii</strong>.',
                ],
                [
                    'q' => 'Je používanie viazané zmluvou alebo minimálnou dobou?',
                    'a' => 'Nie. <strong>Žiadna viazanosť</strong> ani povinnosť systém používať. <strong>Licencie sa nepredlžujú automaticky</strong> a môžete skončiť kedykoľvek.',
                ],
                [
                    'q' => 'Ako je to s DPH a údajmi na faktúre?',
                    'a' => 'Aktuálne je spoločnosť <strong>neplatcom DPH</strong>, preto sú faktúry <strong>bez DPH</strong>. Ak potrebujete faktúru s DPH, napíšte nám prosím na <strong>info@barovainventura.sk</strong> – po odkomunikovaní to vieme zabezpečiť.',
                ],
            ],
        ],
        'title_devices'   => 'Zariadenia k Barovej Inventúre',
        'borrow_info_html'=> 'Zariadenia si môžete <strong>zapožičať na 30 dní</strong> na vyskúšanie. V prípade záujmu je potrebné mať <strong>vytvorenú registráciu</strong> a následne napísať na <strong><a href="mailto:sales@barovainventura.sk">sales@barovainventura.sk</a></strong> s požiadavkou na zapožičanie.',
        'borrow_pricelist' => 'Ceny zariadení nájdete v časti <strong>Cenník</strong> – kliknite v hornom menu.<br>',
        'devices' => [
            'scale' => [
                'name'       => 'Digitálna váha BI V2',
                'desc_html'  => 'Na digitálnej váhe BI V2 odvážite produkty do 5&nbsp;kg. Vďaka kompaktným rozmerom sa zmestí na každý stôl aj do väčšiny zásuviek. Váha obsahuje integrovaný mikropočítač na priame prepojenie s našou PC aplikáciou – namerané hodnoty sa zobrazia okamžite, čím šetríte čas a znižujete chybovosť. Váha je vyrobená na mieru pre aplikáciu Barová Inventúra.',
                'note_html'  => '<b style="color:red">!! Váha nie je úradne overená (ciachovaná) !!</b><br>Zariadenie má výhradne informatívny charakter.',
                'price_label'=> '€',
            ],
            'scanner' => [
                'name'       => 'PBS-WX7 skener čiarových kódov',
                'desc_html'  => 'PBS-WX7 je bezdrôtový Bluetooth skener čiarových kódov. Umožňuje pohodlnú prácu bez kábla a spoľahlivo číta 1D, 2D aj QR kódy (vrátane EAN a Data Matrix). Vyznačuje sa presným a rýchlym snímaním, takže je ideálny do náročných prevádzok.',
                'tip_html'   => '<small style="display:block; font-size:12px; color:#6c757d;">Odporúčame používať skener cez kábel (USB) pre maximálnu stabilitu pripojenia. Skener funguje správne, ak je v systéme nastavená klávesnica EN alebo SK.</small>',
                'price_label'=> '€',
            ],
        ],
    ],

    // CONTACT
    'contact' => [
        'breadcrumb_title' => 'Kontaktujte nás',
        'breadcrumb_text'  => 'Ak máte otázku, kontaktujte nás, odpovieme vám čo najskôr.',
        'breadcrumb_home'  => 'Domov',

        'form_title' => 'Zanechajte <span>správu</span>',
        'form_text'  => 'Vyplňte formulár nižšie, náš tím sa vám čoskoro ozve.',
        'name'       => 'Meno',
        'email'      => 'E-mail',
        'company'    => 'Názov spoločnosti',
        'country'    => 'Krajina',
        'phone'      => 'Telefón',
        'website'    => 'Webstránka',
        'message'    => 'Vaša správa',
        'agree'      => 'Súhlasím so zasielaním e-mailov, newsletterov a propagačných správ',
        'send'       => 'ODOSLAŤ SPRÁVU',

        'info_title' => 'Máte nejakú <span>otázku?</span>',
        'info_text'  => 'Ak máte akúkoľvek otázku týkajúcu sa nášho produktu, služby, platby alebo spoločnosti, navštívte našu stránku',
        'read_faq'   => 'FAQ',

        'email_us' => 'Napíšte nám',
        'call_us'  => 'Zavolajte nám',
        'visit_us' => 'Sídlo',

        'success' => 'Vaša správa bola úspešne odoslaná. Čoskoro sa vám ozveme.',
        'error'   => 'Nastala chyba pri odosielaní správy. Skúste to prosím neskôr.',
    ],

    'header' => [
        'home'         => 'Domov',
        'features'     => 'Vlastnosti',
        'how_it_works' => 'Ako to funguje?',
        'pricing'      => 'Cenník',
        'tutorials'    => 'Návody a video',
        'download'     => 'Na stiahnutie',
        'contact'      => 'Kontakt',
        'login'        => 'Prihlásiť sa',
        'register'     => 'Začať zdarma',
    ],

    'footer' => [
        'useful_links' => 'Užitočné odkazy',
        'help_support' => 'Pomoc a podpora',
        'try_out'      => 'Vyskúšajte',
        'tutorials'    => 'Návody a video',
        'download'     => 'Na stiahnutie',
        'vop'          => 'VOP',
        'gdpr'         => 'GDPR',
        'pricing'      => 'Cenník',
        'cookie'       => 'Cookie',
        'about'        => 'Náš tím',
        'contact'      => 'Kontakt',
        'faq'          => 'FAQ',
        'pc_app'       => 'PC aplikácia',
        'user_manual'  => 'Používateľská príručka',
        'support'      => 'Podpora',
        'created_by'   => 'Vytvoril',
    ],

    'getstarted' => [
        'title'    => 'Stiahnite PC aplikáciu a spustite inventúru',
        'subtitle' => 'Prihláste sa k vytvorenej inventúre, pripojte váhu a skener a skenujte fľaše. Export získate po spracovaní v administrácii (1–2 min).',
        'btns' => [
            'download' => 'Stiahnuť PC aplikáciu (Windows)',
            'guides'   => 'Návody a video',
        ],
        'alts' => [
            'anim'   => 'Animácia',
            'thumb1' => 'Ukážka – sťahovanie aplikácie',
            'thumb2' => 'Ukážka – mobilný skener',
        ],
    ],

    'faq' => [
        'title' => 'Máte otázky? Pozrite sem',
        'breadcrumbs' => [
            'home' => 'Domov',
            'faq'  => 'FAQ',
        ],
        'items' => [
            [
                'q' => 'Čo je Barová Inventúra?',
                'a' => 'Barová Inventúra je online nástroj určený pre pohostinstvá, bary, reštaurácie a iné prevádzky, ktorý umožňuje presne a rýchlo evidovať skladové zásoby nápojov a potravín, sledovať predaj a optimalizovať nákupy.',
            ],
            [
                'q' => 'Má Barová Inventúra vlastnú databázu produktov?',
                'a' => 'Áno, Barová Inventúra disponuje desiatkami tisíc produktov, takže stačí naskenovať čiarový kód a produkt sa nájde. Ak produkt v databáze nemáme, systém vás vyzve na jeho pridanie a zobrazí polia na doplnenie informácií, aby ste mohli pokračovať v inventúre. Uložené údaje následne skontroluje administrátor a zaradí ich do databázy, takže ide len o jednorazový krok.',
            ],
            [
                'q' => 'Počas váženia sa odpočítava aj hmotnosť obalu?',
                'a' => 'Áno, systém pracuje s parametrami hmotnosti prázdneho obalu, ktorú následne odpočíta od naváženej hmotnosti produktu. Nastavená je tolerancia 10 gramov, napríklad ak je vo fľaši ovocie.',
            ],
            [
                'q' => 'Ako Barová Inventúra funguje?',
                'a' => 'Systém využíva jednoduché zadávanie údajov o stave zásob a ich spotrebe. Dáta sa spracujú do prehľadných reportov, ktoré pomáhajú odhaliť straty, kontrolovať zamestnancov a efektívne plánovať nákup.',
            ],
            [
                'q' => 'Je potrebná špeciálna technika alebo zariadenie?',
                'a' => 'Barovú Inventúru je možné používať aj bez digitálnej váhy a skenera čiarových kódov, čo je vhodné pre podniky s&nbsp;maximálne 20 druhmi produktov. Ak má podnik viac ako 20 druhov produktov, odporúčame pre rýchlosť a efektivitu využiť hardvér od nás.',
            ],
            [
                'q' => 'Koľko stojí používanie Barovej Inventúry?',
                'a' => 'Cena závisí len od počtu prevádzok. Štandardná cena za jednu prevádzku je 20&nbsp;€ mesačne.',
            ],
            [
                'q' => 'Môžem Barovú Inventúru používať aj bez internetu?',
                'a' => 'Nie, keďže ide o cloudové riešenie, je potrebné mať pripojenie na internet.',
            ],
            [
                'q' => 'Ako mi Barová Inventúra pomôže znížiť straty?',
                'a' => 'Presné sledovanie spotreby odhalí rozdiely medzi predajom a skutočným stavom zásob. To vám umožní rýchlejšie zistiť, kde vznikajú straty – či už ide o chyby, zlé nalievanie alebo úmyselné krátenie.',
            ],
            [
                'q' => 'Je možné exportovať dáta?',
                'a' => 'Áno, Barová Inventúra umožňuje export údajov vo viacerých formátoch – napríklad pre účtovné systémy, skladové systémy a iné externé aplikácie. Exportované súbory je možné následne upraviť podľa potrieb konkrétneho externého systému.',
            ],
            [
                'q' => 'Poskytujete školenie pre používanie systému?',
                'a' => 'Na webe poskytujeme online návody. Pre školenie alebo technický zásah je potrebné požiadať na e-mailovej adrese <strong>sales@barovainventura.sk</strong>.',
            ],
            [
                'q' => 'Ako rýchlo môžem začať systém používať?',
                'a' => 'Po aktivácii účtu môžete Barovú Inventúru začať používať už do 10 – 20 minút.',
            ],
            [
                'q' => 'Poskytujete technickú podporu?',
                'a' => 'Áno, zákaznícka podpora je k dispozícii e-mailom a telefonicky.',
            ],
            [
                'q' => 'Môže Barová Inventúra fungovať vo viacerých prevádzkach naraz?',
                'a' => 'Áno, systém podporuje viac prevádzok v jednom účte, pričom každá má vlastný sklad, predaje a prehľady.',
            ],
            [
                'q' => 'Je možné pridať neobmedzený počet produktov?',
                'a' => 'Áno, do systému môžete pridať ľubovoľný počet produktov. Kategórie produktov systém nepodporuje.',
            ],
            [
                'q' => 'Umožňuje systém sledovať minimálne množstvá na sklade?',
                'a' => 'Áno, môžete nastaviť minimálne množstvá zásob a systém vás upozorní, keď je potrebné doplniť tovar.',
            ],
            [
                'q' => 'Môžem si systém vyskúšať pred zakúpením?',
                'a' => 'Áno, ponúkame možnosť bezplatného testovania systému počas skúšobného obdobia.',
            ],
            [
                'q' => 'Je možné používať Barovú Inventúru na mobile?',
                'a' => 'Áno, systém je plne responzívny a optimalizovaný pre používanie na mobilných zariadeniach aj tabletoch.',
            ],
            [
                'q' => 'Vie systém pracovať s nápojmi na otvorené fľaše?',
                'a' => 'Áno, môžete evidovať aj čiastočne otvorené fľaše a systém automaticky prepočíta množstvá na litre alebo mililitre.',
            ],
            [
                'q' => 'Je možné nastaviť prístupové práva pre rôznych používateľov?',
                'a' => 'Nie, aktuálne systém nepodporuje nastavovanie používateľských oprávnení (permisie).',
            ],
            [
                'q' => 'Umožňuje Barová Inventúra sledovať históriu zmien?',
                'a' => 'Áno, všetky zmeny sa zaznamenávajú v histórii, takže vždy viete, kto a kedy vykonal úpravy.',
            ],
            [
                'q' => 'Je možné prepojiť Barovú Inventúru s pokladničným systémom?',
                'a' => 'Áno, systém je možné prepojiť s viacerými typmi pokladničných systémov. V prípade, že takýto systém momentálne nepodporujeme, stačí nás kontaktovať na <strong>info@barovainventura.sk</strong> a urobíme maximum pre to, aby sme váš systém pripojili na našu platformu.',
            ],
            [
                'q' => 'Ako často sa systém aktualizuje?',
                'a' => 'Barová Inventúra sa pravidelne aktualizuje, aby sme pridávali nové funkcie, zlepšovali rýchlosť a zvyšovali bezpečnosť. Aktualizácie prebiehajú automaticky bez prerušenia prevádzky.',
            ],
        ],
    ],

    'tutorial' => [
        'title' => 'Pozri si rýchle ukážky práce so systémom Barová Inventúra',
        'breadcrumbs' => [
            'home'  => 'Domov',
            'title' => 'Návody',
        ],

        'hero' => [
            'title_html' => '<span>Video</span> návody',
            'subtitle'   => 'Pozri si rýchle ukážky práce so systémom Barová Inventúra – od registrácie po kalibráciu a exporty.',
        ],

        'cards' => [
            [
                'img'        => 'web/images/standard.png',
                'img_alt'    => 'Registrácia',
                'title'      => 'Začiatok a prihlásenie',
                'subtitle'   => 'Prihlásenie do aplikácie',
                'bullets'    => [
                    'Prihlásenie do administrácie',
                    'Vytvorenie inventúry',
                    'Prihlásenie do aplikácie',
                ],
                'video_url'  => 'https://www.youtube.com/embed/9p0-TTMRJ8g?autoplay=1&mute=0',
                'video_cta'  => 'Pustiť video',
                'video_title'=> 'Video návod – Úvod',
            ],
            [
                'img'        => 'web/images/unlimited.png',
                'img_alt'    => 'Inštalácia',
                'title'      => 'Inštalácia',
                'subtitle'   => 'Inštalácia PC aplikácie',
                'bullets'    => [
                    'Stiahnutie PC aplikácie',
                    'Povolenie defenderu',
                    'Inštalácia PC aplikácie',
                ],
                'video_url'  => 'https://www.youtube.com/embed/-CT2UDn5JjY?autoplay=1&mute=0',
                'video_cta'  => 'Pustiť video',
                'video_title'=> 'Video návod – Inštalácia',
            ],
            [
                'img'        => 'web/images/premium.png',
                'img_alt'    => 'Kalibrácia váhy',
                'title'      => 'Váha',
                'subtitle'   => 'Kalibrácia váhy',
                'bullets'    => [
                    'Predstavenie váhy BI V',
                    'Kalibrácia váhy',
                    'Kontrola kalibrácie',
                ],
                'video_url'  => 'https://www.youtube.com/embed/_nCp19VkxzQ?autoplay=1&mute=0',
                'video_cta'  => 'Pustiť video',
                'video_title'=> 'Video návod – Kalibrácia váhy',
            ],
        ],

        'faq' => [
            [
                'q' => 'Čo robiť, ak neviem nájsť návod, ktorý potrebujem?',
                'a' => 'Ak neviete nájsť návod, ktorý potrebujete, kontaktujte nás na <a href="mailto:info@barovainventura.sk">info@barovainventura.sk</a> a s radosťou vám pripravíme návod na mieru.',
            ],
            [
                'q' => 'Mám problém, ktorý je vo videu len čiastočne spomenutý.',
                'a' => 'Pokojne nás kontaktujte – radi vám všetko doplníme a vysvetlíme. Komunikovať môžeme e-mailom, telefonicky, prípadne poskytujeme podporu aj cez vzdialený prístup k ploche (AnyDesk).',
            ],
            [
                'q' => 'Koľko stojí podpora a pomoc?',
                'a' => 'Podpora cez telefón alebo e-mail, prípadne zdieľanie plochy, je zadarmo. Našich zákazníkov si vážime a radi investujeme náš čas do pomoci.',
            ],
            [
                'q' => 'Čo mám spraviť, ak chcem, aby mi to niekto prišiel vysvetliť na prevádzku?',
                'a' => 'Dohodnite si prosím osobnú asistenciu e-mailom na <a href="mailto:info@barovainventura.sk">info@barovainventura.sk</a>. Následne dohodneme vyslanie technika priamo k vám na prevádzku v dohodnutom termíne.',
            ],
        ],
    ],
];
