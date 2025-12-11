"use client"

import Link from "next/link"
import { CheckCircle2 } from "lucide-react"

export default function ContractSuccessPage() {
  return (
    <main className="min-h-screen flex items-center justify-center bg-gradient-to-b from-green-50 to-white p-4">
      <div className="w-full max-w-2xl">
        <div className="bg-white rounded-2xl shadow-lg p-8 md:p-12 text-center">
          <div className="mx-auto w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mb-6">
            <CheckCircle2 className="w-14 h-14 text-green-600" />
          </div>

          <h1 className="text-3xl font-semibold mb-3">Žiadosť bola úspešne prijatá</h1>
          <p className="text-gray-600 mb-8">
            Ďakujeme. Vašu požiadavku sme zaznamenali a čoskoro vás budeme kontaktovať s ďalšími informáciami.
          </p>

          <div className="flex flex-col sm:flex-row gap-3 justify-center">
            <Link href="/" className="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
              Prejsť na úvod
            </Link>
            <button
              onClick={() => window.close()}
              className="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition"
            >
              Zavrieť okno
            </button>
          </div>
        </div>

        <p className="text-center text-gray-500 text-sm mt-4">
          Ak ste e-mail neobdržali, skontrolujte priečinok <em>Spam</em> alebo <em>Reklama</em>.
        </p>
      </div>
    </main>
  )
}
