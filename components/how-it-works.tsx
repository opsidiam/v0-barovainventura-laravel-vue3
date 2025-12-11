const steps = [
  {
    number: "01",
    title: "Registrácia do cloudu",
    subtitle: "CLOUD ADMIN",
    description:
      "Zaregistrujte sa do cloudovej aplikácie a vytvorte si podnik v cloude. Všetky nastavenia, histórie a reporty sú dostupné online.",
    cloudAdvantage: "Všetky údaje sa okamžite ukladajú do cloudu, k nim máte prístup z akéhokoľvek zariadenia.",
    image: "/placeholder.svg?height=300&width=400",
  },
  {
    number: "02",
    title: "Inštalácia a váženie",
    subtitle: "DESKTOP APLIKÁCIA",
    description:
      "Nainštalujte si desktop aplikáciu, ktorá komunikuje s cloudom. Použite ju na váženie otvorených fliaš a skenovanie čiarových kódov.",
    cloudAdvantage: "Každý naskenovaný kód sa okamžite odosiela do cloudu. Žiadne lokálne ukladanie dát.",
    image: "/placeholder.svg?height=300&width=400",
  },
  {
    number: "03",
    title: "Reporty a exporty z cloudu",
    subtitle: "CLOUD ADMIN",
    description:
      "Po dokončení inventúry si v cloudovom rozhraní pozrite reporty a stiahnite exporty. Všetky výpočty a analýzy bežia v cloude.",
    cloudAdvantage:
      "Dáta sú vždy aktuálne a dostupné z akéhokoľvek zariadenia. Manažment vidí výsledky v reálnom čase.",
    image: "/placeholder.svg?height=300&width=400",
  },
]

export function HowItWorks() {
  return (
    <section className="py-20 bg-gradient-to-b from-blue-50 to-white" id="how-it-works">
      <div className="container mx-auto px-4">
        <div className="text-center mb-16">
          <h2 className="text-4xl font-bold mb-4">
            <span className="text-blue-600">Ako funguje</span> cloudová inventúra
          </h2>
          <p className="text-xl text-gray-600 max-w-3xl mx-auto">
            Kompletný proces kombinuje cloudovú administráciu a desktop aplikáciu na váženie. Všetky dáta sa ukladajú do
            cloudu v reálnom čase.
          </p>
        </div>

        <div className="space-y-20">
          {steps.map((step, index) => (
            <div
              key={index}
              className={`grid lg:grid-cols-2 gap-12 items-center ${index % 2 === 1 ? "lg:flex-row-reverse" : ""}`}
            >
              <div className={`space-y-6 ${index % 2 === 1 ? "lg:order-2" : ""}`}>
                <div className="flex items-center gap-4">
                  <span className="text-6xl font-bold text-blue-600/20">{step.number}</span>
                  <div>
                    <h4 className="text-2xl font-bold">{step.title}</h4>
                    <span className="text-sm text-blue-600 font-semibold">{step.subtitle}</span>
                  </div>
                </div>
                <p className="text-lg text-gray-600">{step.description}</p>
                <div className="p-4 bg-blue-50 rounded-lg border-l-4 border-blue-600">
                  <p className="font-semibold text-blue-900 mb-1">Cloudová výhoda:</p>
                  <p className="text-gray-700">{step.cloudAdvantage}</p>
                </div>
              </div>
              <div className={index % 2 === 1 ? "lg:order-1" : ""}>
                <img src={step.image || "/placeholder.svg"} alt={step.title} className="w-full rounded-2xl shadow-xl" />
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}
