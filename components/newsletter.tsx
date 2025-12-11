"use client"

import type React from "react"
import { useState } from "react"

export function Newsletter() {
  const [email, setEmail] = useState("")

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    console.log("Newsletter signup:", email)
    setEmail("")
  }

  return (
    <section className="py-20 gradient-bg">
      <div className="container mx-auto px-4">
        <div className="max-w-3xl mx-auto bg-white/10 backdrop-blur-sm rounded-3xl p-8 md:p-12 text-center">
          <h2 className="text-3xl md:text-4xl font-bold text-white mb-4">Prihláste sa k odberu noviniek</h2>
          <p className="text-white/80 text-lg mb-8">
            Získajte aktuálne informácie o nových funkciách a zľavách priamo do vašej schránky.
          </p>

          <form onSubmit={handleSubmit} className="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
            <input
              type="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              placeholder="Váš email"
              required
              className="flex-1 px-6 py-3 rounded-full bg-white/20 border border-white/30 text-white placeholder:text-white/60 focus:outline-none focus:ring-2 focus:ring-pink-500"
            />
            <button
              type="submit"
              className="px-8 py-3 bg-pink-500 hover:bg-pink-600 text-white rounded-full font-semibold transition"
            >
              Odoberať
            </button>
          </form>
        </div>
      </div>
    </section>
  )
}
