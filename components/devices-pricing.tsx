export function DevicesPricing() {
  const devices = [
    {
      name: "Váha",
      description:
        "Presná digitálna váha pre váženie otvorených fliaš. Pripojenie cez USB kábel, automatická kalibrácia.",
      note: "Váha je kalibrovateľná a pripojiteľná k PC cez USB",
      price: 120,
      unit: "€ / kúpna cena",
    },
    {
      name: "Skener",
      description:
        "Čítačka čiarových kódov pre rýchle skenovanie produktov. Kompatibilná so všetkými bežnými EAN kódmi.",
      note: "Tip: Môžete použiť akúkoľvek USB čítačku čiarových kódov",
      price: 80,
      unit: "€ / kúpna cena",
    },
  ]

  return (
    <section className="py-20 bg-gradient-to-br from-indigo-50 to-purple-50">
      <div className="container mx-auto px-4">
        <div className="text-center mb-12">
          <h2 className="text-4xl font-bold mb-4">
            Cenník <span className="text-indigo-600">zariadení</span>
          </h2>
          <p className="text-gray-600 max-w-2xl mx-auto">
            Ponúkame možnosť zakúpiť si potrebné zariadenia pre inventúru. Všetky zariadenia sú plne kompatibilné s
            našou aplikáciou.
          </p>
        </div>

        <div className="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
          {devices.map((device, index) => (
            <div
              key={index}
              className="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-shadow border border-gray-100"
            >
              <h3 className="text-2xl font-bold mb-4 text-gray-900">{device.name}</h3>
              <div className="space-y-4 mb-6">
                <p className="text-gray-600 leading-relaxed">{device.description}</p>
                <p className="text-sm text-indigo-600 italic">{device.note}</p>
              </div>
              <div className="text-center pt-6 border-t border-gray-100">
                <div className="text-4xl font-bold text-indigo-600 mb-2">{device.price}</div>
                <div className="text-gray-500">{device.unit}</div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}
