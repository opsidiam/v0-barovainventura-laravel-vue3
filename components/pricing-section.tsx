"use client"

import { useState } from "react"
import { Check } from "lucide-react"

const plans = {
  monthly: [
    {
      title: "Cloud služba - Mesačná",
      subtitle: "Prístup k cloudovej aplikácii",
      price: 25,
      locations: "1",
      features: [
        "Cloudová služba: Mesačný prístup",
        "Počet prevádzok: 1",
        "Plný prístup k cloud aplikácii",
        "Cloudové notifikácie: Áno",
        "Export z cloudu: Áno",
      ],
    },
    {
      title: "Cloud služba - Mesačná",
      subtitle: "Prístup k cloudovej aplikácii",
      price: 24,
      locations: "2+",
      discount: "5% zľava",
      features: [
        "Cloudová služba: Mesačný prístup",
        "Počet prevádzok: 2+",
        "Plný prístup k cloud aplikácii",
        "Cloudové notifikácie: Áno",
        "Export z cloudu: Áno",
      ],
    },
  ],
  yearly: [
    {
      title: "Cloud služba - Ročná",
      subtitle: "Prístup k cloudovej aplikácii",
      price: 240,
      locations: "1",
      highlighted: true,
      features: [
        "Cloudová služba: Ročný prístup",
        "Počet prevádzok: 1",
        "Plný prístup k cloud aplikácii",
        "Cloudové notifikácie: Áno",
        "Export z cloudu: Áno",
      ],
    },
    {
      title: "Cloud služba - Ročná",
      subtitle: "Prístup k cloudovej aplikácii",
      price: 228,
      locations: "2+",
      discount: "5% zľava",
      highlighted: true,
      features: [
        "Cloudová služba: Ročný prístup",
        "Počet prevádzok: 2+",
        "Plný prístup k cloud aplikácii",
        "Cloudové notifikácie: Áno",
        "Export z cloudu: Áno",
      ],
    },
  ],
}

export function PricingSection() {
  const [period, setPeriod] = useState<"monthly" | "yearly">("monthly")

  return (
    <section className="py-20 bg-white">
      <div className="container mx-auto px-4">
        <div className="text-center mb-12">
          <h2 className="text-4xl font-bold mb-4">
            Cenník <span className="text-indigo-600">cloud služby</span>
          </h2>
        </div>

        <div className="flex items-center justify-center gap-4 mb-12">
          <button
            onClick={() => setPeriod("monthly")}
            className={`px-6 py-2 rounded-full font-semibold transition ${
              period === "monthly" ? "bg-indigo-600 text-white" : "bg-gray-100 text-gray-600 hover:bg-gray-200"
            }`}
          >
            Mesačne
          </button>
          <button
            onClick={() => setPeriod("yearly")}
            className={`px-6 py-2 rounded-full font-semibold transition ${
              period === "yearly" ? "bg-indigo-600 text-white" : "bg-gray-100 text-gray-600 hover:bg-gray-200"
            }`}
          >
            Ročne
          </button>
          {period === "yearly" && (
            <span className="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
              Ušetrite 20%
            </span>
          )}
        </div>

        <div className="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
          {plans[period].map((plan, index) => (
            <div
              key={index}
              className={`relative rounded-3xl p-8 transition-all ${
                plan.highlighted
                  ? "bg-gradient-to-br from-indigo-600 to-purple-600 text-white shadow-2xl scale-105"
                  : "bg-white border-2 border-gray-200 hover:border-indigo-300 hover:shadow-lg"
              }`}
            >
              <div className="text-center mb-6">
                <h3 className="text-2xl font-bold mb-2">{plan.title}</h3>
                <p className={plan.highlighted ? "text-indigo-100" : "text-gray-600"}>{plan.subtitle}</p>
              </div>

              <div className="text-center mb-8">
                <div className="flex items-baseline justify-center gap-2">
                  <span className="text-5xl font-bold">{plan.price}</span>
                  <span className="text-xl">€</span>
                </div>
                <p className={`mt-2 ${plan.highlighted ? "text-indigo-100" : "text-gray-600"}`}>
                  /podnik/{period === "monthly" ? "mesiac" : "rok"}
                </p>
                {plan.discount && (
                  <span className="inline-block mt-2 px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                    {plan.discount}
                  </span>
                )}
              </div>

              <ul className="space-y-3 mb-8">
                {plan.features.map((feature, idx) => (
                  <li key={idx} className="flex items-start gap-3">
                    <Check
                      className={`w-5 h-5 flex-shrink-0 mt-0.5 ${plan.highlighted ? "text-indigo-200" : "text-green-600"}`}
                    />
                    <span className={plan.highlighted ? "text-indigo-50" : "text-gray-600"}>{feature}</span>
                  </li>
                ))}
              </ul>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}
