import Link from "next/link"
import { XCircle } from "lucide-react"

export default function ContractErrorPage() {
  return (
    <main className="min-h-screen flex items-center justify-center bg-gradient-to-b from-red-50 to-white p-4">
      <div className="w-full max-w-2xl">
        <div className="bg-white rounded-2xl shadow-lg p-8 md:p-12 text-center">
          <div className="mx-auto w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mb-6">
            <XCircle className="w-14 h-14 text-red-600" />
          </div>

          <h1 className="text-3xl font-semibold mb-3">Žiadosť bola odmietnutá</h1>
          <p className="text-gray-600 mb-8">
            Vaša žiadosť nemohla byť prijatá, pretože už bola v minulosti podaná. Ak si myslíte, že ide o omyl,
            kontaktujte nás, prosím.
          </p>

          <div className="flex flex-col sm:flex-row gap-3 justify-center">
            <Link href="/" className="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
              Prejsť na úvod
            </Link>
            <Link href="/contact" className="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
              Kontaktovať podporu
            </Link>
          </div>
        </div>

        <p className="text-center text-gray-500 text-sm mt-4">
          Potrebujete pomoc? Napíšte nám na{" "}
          <a href="mailto:support@barovainventura.sk" className="text-blue-600 hover:underline">
            sales@barovainventura.sk
          </a>
        </p>
      </div>
    </main>
  )
}
