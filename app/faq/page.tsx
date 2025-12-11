import { FaqHero } from "@/components/faq-hero"
import { FaqSection } from "@/components/faq-section"
import { Newsletter } from "@/components/newsletter"

export default function FaqPage() {
  return (
    <main className="min-h-screen">
      <FaqHero />
      <FaqSection />
      <Newsletter />
    </main>
  )
}
