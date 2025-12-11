import Link from "next/link"

export function VopContent() {
  return (
    <div className="container mx-auto px-4 py-12 max-w-4xl">
      <div className="bg-white rounded-2xl shadow-lg p-8 md:p-12">
        <div className="flex items-center justify-between mb-8">
          <Link href="/" className="text-blue-600 hover:text-blue-700 flex items-center gap-2">
            ← Späť domov
          </Link>
        </div>

        <div className="prose prose-lg max-w-none">
          <h1 className="text-4xl font-bold mb-8">Všeobecné obchodné podmienky</h1>

          <h2 className="text-2xl font-bold mt-8 mb-4">Úvodné ustanovenia</h2>
          <p className="text-gray-600 leading-relaxed">
            Tieto všeobecné obchodné podmienky upravujú právne vzťahy medzi WebPlace S.R.O, so sídlom Trnovo 74, 038 41
            Košťany nad Turcom, IČO:52 646 181, a užívateľovi online aplikácie barovainventura.SK zo zmlúv o poskytovaní
            týchto online služieb.
          </p>

          <h2 className="text-2xl font-bold mt-8 mb-4">1) Predávajúci</h2>
          <p className="text-gray-600 leading-relaxed">
            Predávajúcim sa rozumie prevádzkovateľ portálu, ktorý je prevádzkovateľom e-shopu, webovej stránky
            www.barovainventura.sk, ktorým je spoločnosť WEBPLACE.
          </p>

          <h2 className="text-2xl font-bold mt-8 mb-4">2) Kupujúci</h2>
          <p className="text-gray-600 leading-relaxed">
            Kupujúcim sa rozumie fyzická osoba – spotrebiteľ, alebo právnická osoba, fyzická osoba - ktorá koná v rámci
            predmetu svojej podnikateľskej činnosti.
          </p>

          <h2 className="text-2xl font-bold mt-8 mb-4">3) Objednávka, kúpna zmluva</h2>
          <p className="text-gray-600 leading-relaxed">
            Návrhom k uzatvoreniu kúpnej zmluvy (ponukou) je umiestnenie tovaru predávajúcim na www.barovainventura.sk.
            Kúpna zmluva vzniká, pokiaľ nie je uvedené inak, odoslaním objednávky kupujúcim.
          </p>

          <h2 className="text-2xl font-bold mt-8 mb-4">9) Reklamácie</h2>
          <ol className="list-decimal pl-6 space-y-4 text-gray-600">
            <li>Práva Užívateľa z chybného plnenia sa riadi platnými právnymi predpismi.</li>
            <li>
              Užívateľ je oprávnený reklamovať Služby, doplnkové služby a ďalšie plnenie, ak nezodpovedajú popisu na
              Webovom rozhraní.
            </li>
            <li>
              Reklamáciu je Používateľ povinný oznámiť Poskytovateľovi čo najskôr po zistení závady na kontaktný e-mail
              Poskytovateľa.
            </li>
          </ol>

          <h2 className="text-2xl font-bold mt-8 mb-4">10) Odstúpenie od zmluvy</h2>
          <p className="text-gray-600 leading-relaxed">
            Poskytovateľ poskytuje Užívateľovi možnosť pri prvom nákupe odstúpiť od Zmluvy s garanciou vrátenia peňazí
            pre prípad, že sa Službou nebude spokojný. Užívateľ môže garancia vrátenia peňazí využiť do 30 dní od
            uhradenia ceny Služby.
          </p>

          <div className="mt-12 p-6 bg-blue-50 rounded-lg">
            <h3 className="font-semibold mb-2">Máte otázky?</h3>
            <p className="text-gray-700">
              V prípade akýchkoľvek otázok nás kontaktujte na{" "}
              <a href="mailto:info@barovainventura.sk" className="text-blue-600 hover:underline">
                info@barovainventura.sk
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  )
}
