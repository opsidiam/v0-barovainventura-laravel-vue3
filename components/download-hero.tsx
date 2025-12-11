import Link from "next/link"

export function DownloadHero() {
  return (
    <section className="py-20 bg-gradient-to-b from-blue-600 to-blue-700 text-white">
      <div className="container mx-auto px-4">
        <div className="text-center max-w-3xl mx-auto">
          <h1 className="text-5xl font-bold mb-6">Stiahnutia</h1>
          <nav className="flex items-center justify-center gap-2 text-blue-100">
            <Link href="/" className="hover:text-white transition">
              Domov
            </Link>
            <span>»</span>
            <span>Stiahnutia</span>
          </nav>
        </div>
      </div>
    </section>
  )
}
