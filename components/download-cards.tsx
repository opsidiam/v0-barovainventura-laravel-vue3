import { Download, FileText, Smartphone } from "lucide-react"

const downloads = [
  {
    icon: Download,
    title: "PC aplikácia (Windows)",
    subtitle: "Desktop aplikácia pre Windows",
    description: "Stiahните si desktop aplikáciu pre Windows, ktorá slúži na váženie a odosielanie údajov do cloudu.",
    downloadUrl: "/BarovaInventura.exe",
    available: true,
  },
  {
    icon: FileText,
    title: "Používateľská príručka",
    subtitle: "PDF dokument",
    description: "Kompletná používateľská príručka s návodom na používanie aplikácie a zariadení.",
    downloadUrl: "/Uzivatelska_prirucka.pdf",
    available: true,
  },
  {
    icon: Download,
    title: "PC aplikácia (macOS)",
    subtitle: "Desktop aplikácia pre Mac",
    description: "Desktop aplikácia pre macOS je momentálne vo vývoji.",
    available: false,
    note: "Čoskoro dostupné",
  },
  {
    icon: Smartphone,
    title: "Mobilná aplikácia (Android)",
    subtitle: "Aplikácia pre Android",
    description: "Mobilná aplikácia pre Android zariadenia je momentálne vo vývoji.",
    available: false,
    note: "Čoskoro dostupné",
  },
  {
    icon: Smartphone,
    title: "Mobilná aplikácia (iOS)",
    subtitle: "Aplikácia pre iPhone/iPad",
    description: "Mobilná aplikácia pre iOS zariadenia je momentálne vo vývoji.",
    available: false,
    note: "Čoskoro dostupné",
  },
]

export function DownloadCards() {
  return (
    <section className="py-20 bg-white">
      <div className="container mx-auto px-4">
        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          {downloads.map((item, index) => (
            <div
              key={index}
              className="bg-white border-2 border-gray-200 rounded-2xl p-8 hover:border-blue-600 transition"
            >
              <div className="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                <item.icon className="w-8 h-8 text-blue-600" />
              </div>

              <h3 className="text-xl font-bold mb-2">{item.title}</h3>
              <p className="text-sm text-gray-600 mb-4">{item.subtitle}</p>
              <p className="text-gray-600 mb-6">{item.description}</p>

              {item.available ? (
                <a
                  href={item.downloadUrl}
                  className="flex items-center justify-center gap-2 w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                >
                  <Download className="w-5 h-5" />
                  Stiahnuť
                </a>
              ) : (
                <div className="text-center py-3 bg-gray-100 rounded-lg text-gray-600">{item.note}</div>
              )}
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}
