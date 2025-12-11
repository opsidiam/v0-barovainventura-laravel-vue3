import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from "@/components/ui/accordion"

const faqs = [
  {
    q: "Ako funguje cloudová inventúra?",
    a: "Cloudová inventúra kombinuje desktop aplikáciu na váženie a cloud službu na správu dát. Všetky údaje sa ukladajú v cloude v reálnom čase a máte k nim prístup z akéhokoľvek zariadenia.",
  },
  {
    q: "Potrebujem špeciálne zariadenia?",
    a: "Áno, potrebujete váhu a čítačku čiarových kódov. Tieto zariadenia si môžete zapožičať od nás alebo použiť vlastné kompatibilné zariadenia.",
  },
  {
    q: "Môžem používať aplikáciu na viacerých zariadeniach?",
    a: "Áno, cloudová časť je dostupná z akéhokoľvek zariadenia s internetom. Desktop aplikácia je potrebná len tam, kde vážite.",
  },
  {
    q: "Ako sú zabezpečené moje dáta?",
    a: "Všetky dáta sú šifrované a pravidelne zálohované v cloude. Používame najmodernejšie bezpečnostné štandardy pre ochranu vašich údajov.",
  },
  {
    q: "Môžem vyskúšať službu zadarmo?",
    a: "Áno, ponúkame 30 dní cloud služby úplne zadarmo. Nemusíte zadávať žiadne platobné údaje.",
  },
  {
    q: "Ako rýchlo môžem začať používať službu?",
    a: "Po registrácii môžete začať používať cloudovú časť okamžite. Desktop aplikáciu nainštalujete do 5 minút a môžete začať vážiť.",
  },
]

export function FaqSection() {
  return (
    <section className="py-20 bg-white">
      <div className="container mx-auto px-4">
        <div className="max-w-3xl mx-auto">
          <Accordion type="single" collapsible defaultValue="item-0" className="space-y-4">
            {faqs.map((faq, index) => (
              <AccordionItem key={index} value={`item-${index}`} className="border-2 rounded-lg px-6">
                <AccordionTrigger className="text-left font-semibold hover:no-underline">{faq.q}</AccordionTrigger>
                <AccordionContent className="text-gray-600">{faq.a}</AccordionContent>
              </AccordionItem>
            ))}
          </Accordion>
        </div>
      </div>
    </section>
  )
}
