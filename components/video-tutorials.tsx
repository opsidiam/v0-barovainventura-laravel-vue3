"use client"

import { Play } from "lucide-react"

const tutorials = [
  {
    title: "Začiatok a prihlásenie",
    subtitle: "Prihlásenie do aplikácie",
    points: ["Prihlásenie do administrácie", "Vytvorenie inventúry", "Prihlásenie do aplikácie"],
    videoUrl: "https://www.youtube.com/embed/9p0-TTMRJ8g",
  },
  {
    title: "Inštalácia",
    subtitle: "Inštalácia PC aplikácie",
    points: ["Stiahnutie PC aplikácie", "Povolenie defendera", "Inštalácia PC aplikácie"],
    videoUrl: "https://www.youtube.com/embed/-CT2UDn5JjY",
  },
  {
    title: "Váha",
    subtitle: "Kalibrácia váhy",
    points: ["Predstavenie váhy BI V2", "Kalibrácia váhy", "Kontrola kalibrácie"],
    videoUrl: "https://www.youtube.com/embed/_nCp19VkxzQ",
  },
  {
    title: "Inventúra",
    subtitle: "Proces celej inventúry",
    points: ["Začiatok inventúry", "Proces inventúry", "Ukončenie a export"],
    videoUrl: "https://www.youtube.com/embed/we6Atvh1aSw",
  },
]

export function VideoTutorials() {
  return (
    <section className="py-20 bg-white">
      <div className="container mx-auto px-4">
        <div className="text-center mb-12">
          <h2 className="text-4xl font-bold mb-4">
            <span className="text-blue-600">Video</span> návody
          </h2>
          <p className="text-xl text-gray-600 max-w-3xl mx-auto">
            Pozri si rýchle ukážky práce so systémom Barová Inventúra – od registrácie po kalibráciu a exporty.
          </p>
        </div>

        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
          {tutorials.map((tutorial, index) => (
            <div
              key={index}
              className="bg-white border-2 border-gray-200 rounded-2xl p-6 hover:border-blue-600 transition"
            >
              <div className="w-20 h-20 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-6">
                <img src="/placeholder.svg?height=60&width=60" alt="" className="w-12 h-12" />
              </div>

              <h3 className="text-xl font-bold mb-2 text-center">{tutorial.title}</h3>
              <p className="text-sm text-gray-600 text-center mb-4">{tutorial.subtitle}</p>

              <ul className="space-y-2 mb-6 text-sm text-gray-600">
                {tutorial.points.map((point, idx) => (
                  <li key={idx}>- {point}</li>
                ))}
              </ul>

              <button className="w-full flex items-center justify-center gap-2 px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <Play className="w-5 h-5" />
                Pustiť video
              </button>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}
