import Link from "next/link"

export function ContactHero() {
  return (
    <section className="py-20 bg-gradient-to-b from-blue-600 to-blue-700 text-white">
      <div className="container mx-auto px-4">
        <div className="text-center max-w-3xl mx-auto">
          <h1 className="text-5xl font-bold mb-4">Kontakt</h1>
          <p className="text-xl text-blue-100 mb-6">Máte otázky? Radi vám pomôžeme!</p>
          <nav className="flex items-center justify-center gap-2 text-blue-100">
            <Link href="/" className="hover:text-white transition">
              Domov
            </Link>
            <span>»</span>
            <span>Kontakt</span>
          </nav>
        </div>
      </div>
    </section>
  )
}
