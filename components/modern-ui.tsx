import { Smartphone, Zap, FileText } from "lucide-react"

const benefits = [
  {
    icon: Smartphone,
    title: "Prístup odkiaľkoľvek",
    description:
      "Cloudová časť je dostupná z akéhokoľvek zariadenia s internetom. Desktop aplikácia je potrebná len pre priame váženie a skenovanie.",
  },
  {
    icon: Zap,
    title: "Plynulá cloud synchronizácia",
    description:
      "Desktop aplikácia odosiela údaje priamo do cloudu. Viac používateľov môže pracovať súčasne, všetky údaje sa automaticky zlučujú.",
  },
  {
    icon: FileText,
    title: "Automatické cloudové exporty",
    description:
      "Všetky reporty a výstupy sa generujú priamo z cloudu. PDF, Excel a ďalšie formáty dostupné okamžite pre účtovníctvo a manažment.",
  },
]

export function ModernUI() {
  return (
    <section className="py-20 bg-gradient-to-b from-white to-blue-50">
      <div className="container mx-auto px-4">
        <div className="grid lg:grid-cols-2 gap-12 items-center">
          <div className="space-y-8">
            <div>
              <h2 className="text-4xl font-bold mb-4">
                Moderné cloudové <span className="text-blue-600">riešenie</span>
              </h2>
              <p className="text-xl text-gray-600">
                Hlavná aplikácia beží v cloude, desktopová časť slúži na váženie a odosielanie údajov. Všetky reporty,
                histórie a nastavenia máte k dispozícii online.
              </p>
            </div>

            <div className="space-y-6">
              {benefits.map((benefit, index) => (
                <div key={index} className="border-l-4 border-blue-600 pl-6">
                  <div className="flex items-start gap-3 mb-2">
                    <benefit.icon className="w-5 h-5 text-blue-600 mt-1" />
                    <h4 className="text-lg font-semibold">{benefit.title}</h4>
                  </div>
                  <p className="text-gray-600">{benefit.description}</p>
                </div>
              ))}
            </div>
          </div>

          <div className="relative">
            <div className="grid grid-cols-2 gap-4">
              <img
                src="/placeholder.svg?height=400&width=300"
                alt="Cloud rozhranie"
                className="rounded-2xl shadow-lg"
              />
              <div className="space-y-4 pt-8">
                <img src="/placeholder.svg?height=180&width=300" alt="Sync" className="rounded-2xl shadow-lg" />
                <img src="/placeholder.svg?height=180&width=300" alt="Reporty" className="rounded-2xl shadow-lg" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}
