import Link from "next/link"
import { ArrowRight } from "lucide-react"

export function Hero() {
  return (
    <section className="relative min-h-screen flex items-center gradient-bg overflow-hidden">
      {/* Decorative elements */}
      <div className="absolute top-20 left-10 w-32 h-32 bg-pink-500/20 rounded-full blur-3xl" />
      <div className="absolute top-40 right-20 w-48 h-48 bg-blue-500/20 rounded-full blur-3xl" />
      <div className="absolute bottom-20 left-1/3 w-40 h-40 bg-purple-500/20 rounded-full blur-3xl" />

      <div className="container mx-auto px-4 py-20 relative z-10">
        <div className="grid lg:grid-cols-2 gap-12 items-center">
          <div className="space-y-8">
            <h1 className="text-5xl md:text-6xl font-bold leading-tight text-white">
              Jednoduchá <span className="text-pink-400">inventúra</span>
            </h1>
            <p className="text-xl text-white/80 max-w-lg">
              Aplikácia Barová inventúra slúži pre vytvorenie inventúry baru s pomocou váženia otvorených fliaš a EAN
              skenera.
            </p>
            <Link
              href="/register"
              className="inline-flex items-center gap-2 px-8 py-4 bg-pink-500 hover:bg-pink-600 text-white rounded-full font-semibold transition shadow-lg shadow-pink-500/30"
            >
              30 dní úplne zadarmo <ArrowRight className="w-5 h-5" />
            </Link>
          </div>

          <div className="relative">
            <div className="relative mx-auto w-full max-w-md">
              <div className="absolute inset-0 bg-gradient-to-br from-pink-500/30 to-purple-500/30 rounded-3xl blur-3xl" />
              <div className="relative">
                <img
                  src="/placeholder.svg?height=600&width=400"
                  alt="Barová Inventúra aplikácia"
                  className="w-full h-auto rounded-3xl shadow-2xl"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}
