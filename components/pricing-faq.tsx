import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from "@/components/ui/accordion"

const faqs = [
  {
    q: "Ako funguje mesačné predplatné?",
    a: "Mesačné predplatné sa automaticky obnovuje každý mesiac. Cena je 25 € za jednu prevádzku, alebo 24 € za prevádzku pri dvoch a viac prevádzkach.",
  },
  {
    q: "Môžem zmeniť plán kedykoľvek?",
    a: "Áno, môžete kedykoľvek prejsť z mesačného na ročný plán alebo naopak. Pri prechode na ročný plán ušetríte 20%.",
  },
  {
    q: "Ako funguje zapožičanie zariadení?",
    a: "Zariadenia si môžete zapožičať za jednorazový poplatok. Váha stojí 120 € a skener 80 €. Zariadenia ostávajú vo vašom vlastníctve.",
  },
  {
    q: "Je možné vyskúšať službu zadarmo?",
    a: "Áno, ponúkame 30 dní cloud služby úplne zadarmo. Nemusíte zadávať žiadne platobné údaje.",
  },
]

export function PricingFaq() {
  return (
    <section className="py-20 bg-white">
      <div className="container mx-auto px-4">
        <div className="max-w-3xl mx-auto">
          <h2 className="text-3xl font-bold mb-8 text-center">Často kladené otázky</h2>
          <Accordion type="single" collapsible className="space-y-4">
            {faqs.map((faq, index) => (
              <AccordionItem key={index} value={`item-${index}`} className="border rounded-lg px-6">
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
