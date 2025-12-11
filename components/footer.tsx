import Link from "next/link"
import { Facebook, Twitter, Instagram, Mail, Phone, ArrowUp } from "lucide-react"

export function Footer() {
  return (
    <footer className="gradient-bg text-white">
      <div className="container mx-auto px-4 py-16">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          {/* Logo & Contact */}
          <div>
            <h3 className="text-2xl font-bold mb-4">Barová Inventúra</h3>
            <ul className="space-y-2">
              <li>
                <a
                  href="mailto:info@barovainventura.sk"
                  className="flex items-center gap-2 hover:text-pink-400 transition"
                >
                  <Mail className="w-4 h-4" /> info@barovainventura.sk
                </a>
              </li>
              <li>
                <a href="tel:+421948357763" className="flex items-center gap-2 hover:text-pink-400 transition">
                  <Phone className="w-4 h-4" /> 0948 357 763
                </a>
              </li>
            </ul>
            <div className="flex gap-4 mt-4">
              <a
                href="https://www.facebook.com/barovainventura/"
                target="_blank"
                rel="noopener noreferrer"
                className="hover:text-pink-400 transition"
              >
                <Facebook className="w-5 h-5" />
              </a>
              <a
                href="https://twitter.com/BarovaInventura"
                target="_blank"
                rel="noopener noreferrer"
                className="hover:text-pink-400 transition"
              >
                <Twitter className="w-5 h-5" />
              </a>
              <a
                href="https://www.instagram.com/barovainventura.sk/"
                target="_blank"
                rel="noopener noreferrer"
                className="hover:text-pink-400 transition"
              >
                <Instagram className="w-5 h-5" />
              </a>
            </div>
          </div>

          {/* Useful Links */}
          <div>
            <h4 className="font-semibold text-lg mb-4">Užitočné odkazy</h4>
            <ul className="space-y-2">
              <li>
                <Link href="/pricelist" className="hover:text-pink-400 transition">
                  Cenník
                </Link>
              </li>
              <li>
                <Link href="/contact" className="hover:text-pink-400 transition">
                  Kontakt
                </Link>
              </li>
              <li>
                <Link href="/tutorial" className="hover:text-pink-400 transition">
                  Návody
                </Link>
              </li>
              <li>
                <Link href="/download" className="hover:text-pink-400 transition">
                  Na stiahnutie
                </Link>
              </li>
            </ul>
          </div>

          {/* Help & Support */}
          <div>
            <h4 className="font-semibold text-lg mb-4">Pomoc a podpora</h4>
            <ul className="space-y-2">
              <li>
                <Link href="/contact" className="hover:text-pink-400 transition">
                  Kontakt
                </Link>
              </li>
              <li>
                <Link href="/faq" className="hover:text-pink-400 transition">
                  FAQ
                </Link>
              </li>
              <li>
                <Link href="/vop" className="hover:text-pink-400 transition">
                  VOP
                </Link>
              </li>
              <li>
                <Link href="/gdpr" className="hover:text-pink-400 transition">
                  GDPR
                </Link>
              </li>
              <li>
                <Link href="/support" className="hover:text-pink-400 transition">
                  Podpora
                </Link>
              </li>
            </ul>
          </div>

          {/* Newsletter */}
          <div>
            <h4 className="font-semibold text-lg mb-4">Newsletter</h4>
            <p className="text-white/70 mb-4">Prihláste sa na odber noviniek</p>
            <form className="flex gap-2">
              <input
                type="email"
                placeholder="Váš e-mail"
                className="flex-1 px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white placeholder:text-white/50 focus:outline-none focus:ring-2 focus:ring-pink-500"
              />
              <button type="submit" className="px-4 py-2 bg-pink-500 hover:bg-pink-600 rounded-lg transition">
                OK
              </button>
            </form>
          </div>
        </div>
      </div>

      {/* Bottom Footer */}
      <div className="border-t border-white/10">
        <div className="container mx-auto px-4 py-4">
          <div className="flex flex-col md:flex-row justify-between items-center gap-4">
            <p className="text-white/70">&copy; {new Date().getFullYear()} Barová Inventúra</p>
            <p className="text-white/70">
              Vytvoril{" "}
              <a
                href="https://web-place.sk/"
                target="_blank"
                rel="noopener noreferrer"
                className="text-pink-400 hover:text-pink-300"
              >
                WebPlace s.r.o.
              </a>
            </p>
          </div>
        </div>
      </div>

      {/* Go to top */}
      <a
        href="#"
        className="fixed bottom-8 right-8 w-12 h-12 bg-pink-500 hover:bg-pink-600 rounded-full flex items-center justify-center shadow-lg transition"
        aria-label="Späť hore"
      >
        <ArrowUp className="w-5 h-5 text-white" />
      </a>
    </footer>
  )
}
