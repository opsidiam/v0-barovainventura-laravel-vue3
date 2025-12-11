"use client"

import { useState } from "react"
import Link from "next/link"
import { Menu, X, ChevronDown } from "lucide-react"
import { Button } from "@/components/ui/button"

interface HeaderProps {
  isWhite?: boolean
}

export function Header({ isWhite = false }: HeaderProps) {
  const [isOpen, setIsOpen] = useState(false)
  const [dropdownOpen, setDropdownOpen] = useState(false)

  return (
    <header
      className={`fixed top-0 left-0 right-0 z-50 transition-all ${isWhite ? "bg-indigo-950 shadow-lg" : "bg-transparent"}`}
    >
      <div className="container mx-auto px-4">
        <nav className="flex items-center justify-between py-4">
          <Link href="/" className="flex items-center">
            <span className="text-2xl font-bold text-white">Barová Inventúra</span>
          </Link>

          {/* Desktop Menu */}
          <div className="hidden lg:flex items-center gap-6">
            <Link href="/" className="text-white/90 hover:text-white transition">
              Domov
            </Link>

            <div className="relative">
              <button
                onClick={() => setDropdownOpen(!dropdownOpen)}
                className="flex items-center gap-1 text-white/90 hover:text-white transition"
              >
                Viac <ChevronDown className="w-4 h-4" />
              </button>
              {dropdownOpen && (
                <div className="absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2">
                  <Link href="/#features" className="block px-4 py-2 text-gray-700 hover:bg-indigo-50">
                    Výhody
                  </Link>
                  <Link href="/#how_it_work" className="block px-4 py-2 text-gray-700 hover:bg-indigo-50">
                    Ako to funguje
                  </Link>
                  <Link href="/tutorial" className="block px-4 py-2 text-gray-700 hover:bg-indigo-50">
                    Návody
                  </Link>
                  <Link href="/download" className="block px-4 py-2 text-gray-700 hover:bg-indigo-50">
                    Na stiahnutie
                  </Link>
                  <Link href="/faq" className="block px-4 py-2 text-gray-700 hover:bg-indigo-50">
                    FAQ
                  </Link>
                </div>
              )}
            </div>

            <Link href="/pricelist" className="text-white/90 hover:text-white transition">
              Cenník
            </Link>
            <Link href="/contact" className="text-white/90 hover:text-white transition">
              Kontakt
            </Link>
            <Link href="/login" className="text-white/90 hover:text-white transition">
              Prihlásenie
            </Link>
            <Button asChild className="bg-pink-500 hover:bg-pink-600 text-white rounded-full px-6">
              <Link href="/register">Registrácia</Link>
            </Button>
          </div>

          {/* Mobile Menu Button */}
          <button className="lg:hidden text-white" onClick={() => setIsOpen(!isOpen)}>
            {isOpen ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
          </button>
        </nav>

        {/* Mobile Menu */}
        {isOpen && (
          <div className="lg:hidden bg-indigo-950 rounded-lg mb-4 p-4">
            <div className="flex flex-col gap-4">
              <Link href="/" className="text-white/90 hover:text-white">
                Domov
              </Link>
              <Link href="/#features" className="text-white/90 hover:text-white">
                Výhody
              </Link>
              <Link href="/#how_it_work" className="text-white/90 hover:text-white">
                Ako to funguje
              </Link>
              <Link href="/tutorial" className="text-white/90 hover:text-white">
                Návody
              </Link>
              <Link href="/download" className="text-white/90 hover:text-white">
                Na stiahnutie
              </Link>
              <Link href="/pricelist" className="text-white/90 hover:text-white">
                Cenník
              </Link>
              <Link href="/contact" className="text-white/90 hover:text-white">
                Kontakt
              </Link>
              <Link href="/faq" className="text-white/90 hover:text-white">
                FAQ
              </Link>
              <Link href="/login" className="text-white/90 hover:text-white">
                Prihlásenie
              </Link>
              <Button asChild className="bg-pink-500 hover:bg-pink-600 text-white rounded-full">
                <Link href="/register">Registrácia</Link>
              </Button>
            </div>
          </div>
        )}
      </div>
    </header>
  )
}
