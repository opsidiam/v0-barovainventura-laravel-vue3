import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from "@/components/ui/accordion"

const faqs = [
  {
    q: "Čo robiť, ak neviem nájsť návod, ktorý potrebujem?",
    a: 'Ak neviete nájsť návod, ktorý potrebujete, kontaktujte nás na <a href="mailto:info@barovainventura.sk" class="text-blue-600">info@barovainventura.sk</a> a s radosťou vám pripravíme návod na mieru.',
  },
  {
    q: "Mám problém, ktorý je vo videu len čiastočne spomenutý.",
    a: "Pokojne nás kontaktujte – radi vám všetko doplníme a vysvetlíme. Komunikovať môžeme e-mailom, telefonicky, prípadne poskytujeme podporu aj cez vzdialený prístup k ploche (AnyDesk).",
  },
  {
    q: "Koľko stojí podpora a pomoc?",
    a: "Podpora cez telefón alebo e-mail, prípadne zdieľanie plochy, je zadarmo. Našich zákazníkov si vážime a radi investujeme náš čas do pomoci.",
  },
  {
    q: "Čo mám spraviť, ak chcem, aby mi to niekto prišiel vysvetliť na prevádzku?",
    a: 'Dohodnite si prosím osobnú asistenciu e-mailom na <a href="mailto:info@barovainventura.sk" class="text-blue-600">info@barovainventura.sk</a>. Následne dohodneme vyslanie technika priamo k vám na prevádzku v dohodnutom termíne.',
  },
]

export function TutorialFaq() {
  return (
    <section className="py-20 bg-gray-50">
      <div className="container mx-auto px-4">
        <div className="max-w-3xl mx-auto">
          <Accordion type="single" collapsible className="space-y-4">
            {faqs.map((faq, index) => (
              <AccordionItem key={index} value={`item-${index}`} className="bg-white border rounded-lg px-6">
                <AccordionTrigger className="text-left font-semibold hover:no-underline">{faq.q}</AccordionTrigger>
                <AccordionContent className="text-gray-600" dangerouslySetInnerHTML={{ __html: faq.a }} />
              </AccordionItem>
            ))}
          </Accordion>
        </div>
      </div>
    </section>
  )
}
