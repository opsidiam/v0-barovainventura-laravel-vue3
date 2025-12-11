import { Header } from "@/components/header"
import { Breadcrumb } from "@/components/breadcrumb"
import { PricingSection } from "@/components/pricing-section"
import { DevicesPricing } from "@/components/devices-pricing"
import { PricingFaq } from "@/components/pricing-faq"
import { Newsletter } from "@/components/newsletter"
import { Footer } from "@/components/footer"

export default function PricelistPage() {
  return (
    <main className="min-h-screen">
      <Header isWhite />
      <Breadcrumb title="Cenník" items={[{ label: "Domov", href: "/" }, { label: "Cenník" }]} />
      <PricingSection />
      <DevicesPricing />
      <PricingFaq />
      <Newsletter />
      <Footer />
    </main>
  )
}
