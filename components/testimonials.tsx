"use client"

import { useState } from "react"
import { Star, ChevronLeft, ChevronRight } from "lucide-react"

const testimonials = [
  {
    rating: 5,
    review:
      "Nasadenie nám trvalo asi 15 minút. Odvtedy máme inventúru pod kontrolou a v prehľadoch hneď vidíme rozdiely. Jednoducho – menej strát, viac poriadku.",
    name: "Majiteľ baru",
    designation: "Barová Inventúra – zákazník",
  },
  {
    rating: 5,
    review:
      "Začali sme bez hardvéru, neskôr sme pridali váhu a skener. Skenovanie fliaš je rýchle a presné a uzavretie inventúry zvládneme na pár klikov.",
    name: "Prevádzkar reštaurácie",
    designation: "Barová Inventúra – zákazník",
  },
  {
    rating: 5,
    review:
      "Exporty do PDF a ďalších formátov nám uľahčili účtovanie. Keď sme potrebovali prispôsobiť export pre náš systém, podpora to promptne vyriešila.",
    name: "Majiteľ baru",
    designation: "Barová Inventúra – zákazník",
  },
  {
    rating: 5,
    review:
      "Prihlásenie k inventúre pomocou kódu je jednoduché. Každý zamestnanec má svoj kľúč, takže presne vieme, kto čo skenoval.",
    name: "Vedúci zmeny",
    designation: "Barová Inventúra – zákazník",
  },
  {
    rating: 5,
    review: "Máme dve prevádzky a systém zvládam obe bez problémov. Páči sa nám aj množstevná zľava.",
    name: "Majiteľ siete prevádzok",
    designation: "Barová Inventúra – zákazník",
  },
]

export function Testimonials() {
  const [current, setCurrent] = useState(0)

  const next = () => setCurrent((prev) => (prev + 1) % testimonials.length)
  const prev = () => setCurrent((prev) => (prev - 1 + testimonials.length) % testimonials.length)

  return (
    <section className="py-24 bg-gray-50">
      <div className="container mx-auto px-4">
        <div className="text-center mb-16">
          <h2 className="text-4xl md:text-5xl font-bold mb-4">
            Čo hovoria používatelia <span className="text-indigo-600">cloudovej aplikácie</span>
          </h2>
          <p className="text-xl text-gray-600 max-w-3xl mx-auto">
            Cloudové riešenie urýchľuje inventúru, znižuje straty a zjednodušuje správu dát. Pozrite si hodnotenia
            našich používateľov.
          </p>
        </div>

        <div className="max-w-4xl mx-auto">
          <div className="relative bg-white rounded-3xl shadow-xl p-8 md:p-12">
            <div className="flex justify-center mb-6">
              {[...Array(testimonials[current].rating)].map((_, i) => (
                <Star key={i} className="w-6 h-6 text-yellow-400 fill-current" />
              ))}
            </div>

            <p className="text-xl md:text-2xl text-gray-700 text-center mb-8 italic leading-relaxed">
              {testimonials[current].review}
            </p>

            <div className="text-center">
              <h4 className="text-lg font-bold text-gray-900">{testimonials[current].name}</h4>
              <p className="text-gray-500">{testimonials[current].designation}</p>
            </div>

            <div className="absolute left-4 top-1/2 -translate-y-1/2">
              <button
                onClick={prev}
                className="p-3 bg-indigo-100 hover:bg-indigo-200 rounded-full transition"
                aria-label="Predchádzajúci"
              >
                <ChevronLeft className="w-6 h-6 text-indigo-600" />
              </button>
            </div>
            <div className="absolute right-4 top-1/2 -translate-y-1/2">
              <button
                onClick={next}
                className="p-3 bg-indigo-100 hover:bg-indigo-200 rounded-full transition"
                aria-label="Ďalší"
              >
                <ChevronRight className="w-6 h-6 text-indigo-600" />
              </button>
            </div>
          </div>

          <div className="flex justify-center gap-2 mt-8">
            {testimonials.map((_, index) => (
              <button
                key={index}
                onClick={() => setCurrent(index)}
                className={`w-3 h-3 rounded-full transition ${current === index ? "bg-indigo-600" : "bg-gray-300"}`}
                aria-label={`Prejsť na hodnotenie ${index + 1}`}
              />
            ))}
          </div>
        </div>

        <div className="mt-16 text-center">
          <div className="flex justify-center gap-1 mb-4">
            {[...Array(5)].map((_, i) => (
              <Star key={i} className="w-8 h-8 text-yellow-400 fill-current" />
            ))}
          </div>
          <p className="text-gray-600">Veľa ďalších spokojných zákazníkov – pridajte sa medzi nich.</p>
        </div>
      </div>
    </section>
  )
}
