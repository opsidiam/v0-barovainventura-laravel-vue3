import Link from "next/link"

export function GdprContent() {
  return (
    <div className="container mx-auto px-4 py-12 max-w-4xl">
      <div className="bg-white rounded-2xl shadow-lg p-8 md:p-12">
        <div className="flex items-center justify-between mb-8">
          <Link href="/" className="text-blue-600 hover:text-blue-700 flex items-center gap-2">
            ← Späť domov
          </Link>
        </div>

        <div className="prose prose-lg max-w-none">
          <h1 className="text-4xl font-bold mb-8">Informácie o spracúvaní osobných údajov</h1>

          <p className="text-gray-600 leading-relaxed">
            Pri spracúvaní osobných údajov postupujeme v súlade s platnou legislatívou upravujúcou ochranu osobných
            údajov a zabezpečujeme ich ochranu v maximálne možnej miere.
          </p>

          <h2 className="text-2xl font-bold mt-8 mb-4">Legislatíva</h2>
          <p className="text-gray-600 leading-relaxed">
            Nariadenie Európskeho parlamentu a rady (EÚ) 2016/679 zo dňa 27.04.2016 o ochrane fyzických osôb v
            súvislosti so spracúvaním osobných údajov a voľnom pohybe týchto údajov a zrušení smernice 95/46/ES
            (všeobecné nariadenie o ochrane osobných údajov) (ďalej len „GDPR"), Zákon č. 18/2018 Z. z. o ochrane
            osobných údajov
          </p>

          <h2 className="text-2xl font-bold mt-8 mb-4">Prevádzkovateľ</h2>
          <div className="bg-blue-50 p-6 rounded-lg mb-6">
            <p className="font-semibold mb-2">WebPlace s. r. o.</p>
            <p className="text-gray-700">Trnovo 74, 038 41 Košťany nad Turcom</p>
            <p className="text-gray-700">IČO: 52 646 181</p>
            <p className="text-gray-700">E-mail: info@barovainventura.sk</p>
            <p className="text-gray-700">Telefón: +421 948 357 763</p>
          </div>

          <h2 className="text-2xl font-bold mt-8 mb-4">Osobné údaje, ktoré spracúvame</h2>
          <p className="text-gray-600 leading-relaxed">
            Prevádzkovateľ spracúva osobné údaje obchodných a zmluvných partnerov a zákazníkov za účelom zabezpečenia
            zmluvných vzťahov prevádzkovateľa, fakturácie dotknutých osôb, vedenia účtovníctva pri založení a vedení
            predzmluvných a zmluvných vzťahov, plnenie zákonných povinností.
          </p>

          <h2 className="text-2xl font-bold mt-8 mb-4">Vaše práva</h2>
          <ul className="list-disc pl-6 space-y-2 text-gray-600">
            <li>Právo na prístup k osobným údajom</li>
            <li>Právo na opravu osobných údajov</li>
            <li>Právo na výmaz osobných údajov (právo na zabudnutie)</li>
            <li>Právo na obmedzenie spracúvania</li>
            <li>Právo na prenosnosť údajov</li>
            <li>Právo namietať</li>
            <li>Právo odvolať súhlas</li>
          </ul>

          <div className="mt-12 p-6 bg-gray-50 rounded-lg">
            <p className="text-sm text-gray-600">Platné od 1.06.2021</p>
          </div>
        </div>
      </div>
    </div>
  )
}
