import { Cloud, RefreshCw, Database, Download } from "lucide-react"

const features = [
  {
    icon: Cloud,
    title: "Centrálny cloud",
    description:
      "Všetky dáta sa ukladajú bezpečne v cloude. K inventúram máte prístup z akéhokoľvek zariadenia, všetky zmeny sú okamžite synchronizované.",
  },
  {
    icon: RefreshCw,
    title: "Okamžitá synchronizácia",
    description:
      "Desktop aplikácia odosiela údaje priamo do cloudu v reálnom čase. Celý tím vidí aktuálne dáta, žiadne duplicitné záznamy.",
  },
  {
    icon: Database,
    title: "Automatické zálohovanie",
    description:
      "Cloudová služba pravidelne zálohuje všetky vaše dáta. Žiadne riziko straty informácií pri výpadku lokálneho zariadenia.",
  },
  {
    icon: Download,
    title: "Jednoduchá inštalácia",
    description:
      "Desktop aplikáciu na váženie nainštalujete raz a ďalej sa všetko deje automaticky. Všetky dôležité procesy bežia v cloude.",
  },
]

export function Features() {
  return (
    <section className="py-24 bg-white" id="features">
      <div className="container mx-auto px-4">
        <div className="text-center mb-16">
          <h2 className="text-4xl md:text-5xl font-bold mb-4">
            <span className="text-indigo-600">Výhody</span> cloudovej inventúry
          </h2>
          <p className="text-xl text-gray-600 max-w-3xl mx-auto">
            Hlavná logika beží v cloude, desktop aplikácia zaisťuje presné váženie a okamžitú synchronizáciu údajov.
          </p>
        </div>

        <div className="grid lg:grid-cols-2 gap-8 max-w-5xl mx-auto">
          {features.map((feature, index) => (
            <div
              key={index}
              className="group flex gap-6 p-8 rounded-2xl bg-gradient-to-br from-indigo-50 to-purple-50 hover:from-indigo-100 hover:to-purple-100 transition-all duration-300 hover:shadow-lg"
            >
              <div className="flex-shrink-0">
                <div className="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                  <feature.icon className="w-8 h-8 text-white" />
                </div>
              </div>
              <div>
                <h4 className="text-xl font-bold mb-2 text-gray-900">{feature.title}</h4>
                <p className="text-gray-600 leading-relaxed">{feature.description}</p>
              </div>
            </div>
          ))}
        </div>

        <div className="mt-16 flex justify-center">
          <img
            src="/placeholder.svg?height=400&width=600"
            alt="Cloudová inventúra – prehľadové okno"
            className="rounded-2xl shadow-2xl max-w-full"
          />
        </div>
      </div>
    </section>
  )
}
