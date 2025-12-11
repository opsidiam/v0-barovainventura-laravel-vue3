import type React from "react"
import type { Metadata } from "next"
import { Inter } from "next/font/google"
import { Analytics } from "@vercel/analytics/next"
import "./globals.css"

const inter = Inter({ subsets: ["latin"] })

export const metadata: Metadata = {
  title: "Barová Inventúra - Cloudová inventúra pre bary",
  description:
    "Aplikácia Barová inventúra slúži pre vytvorenie inventúry baru s pomocou váženia otvorených fliaš a EAN skenera.",
  openGraph: {
    title: "Barová inventúra",
    description:
      "Aplikácia Barová inventúra slúži pre vytvorenie inventúry baru s pomocou váženia otvorených fliaš a EAN skenera.",
    url: "https://barovainventura.sk",
    siteName: "WebPlace s.r.o.",
    type: "website",
  },
  twitter: {
    card: "summary_large_image",
    title: "Barová inventúra",
    description:
      "Aplikácia Barová inventúra slúži pre vytvorenie inventúry baru s pomocou váženia otvorených fliaš a EAN skenera.",
    site: "@BarovaInventura",
  },
    generator: 'v0.app'
}

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode
}>) {
  return (
    <html lang="sk">
      <body className={`font-sans antialiased`}>
        {children}
        <Analytics />
      </body>
    </html>
  )
}
