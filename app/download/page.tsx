import { DownloadHero } from "@/components/download-hero"
import { DownloadCards } from "@/components/download-cards"
import { Newsletter } from "@/components/newsletter"

export default function DownloadPage() {
  return (
    <main className="min-h-screen">
      <DownloadHero />
      <DownloadCards />
      <Newsletter />
    </main>
  )
}
