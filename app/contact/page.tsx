import { ContactHero } from "@/components/contact-hero"
import { ContactForm } from "@/components/contact-form"
import { Newsletter } from "@/components/newsletter"

export default function ContactPage() {
  return (
    <main className="min-h-screen">
      <ContactHero />
      <ContactForm />
      <Newsletter />
    </main>
  )
}
