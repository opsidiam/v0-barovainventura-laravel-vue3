import { TutorialHero } from "@/components/tutorial-hero"
import { VideoTutorials } from "@/components/video-tutorials"
import { TutorialFaq } from "@/components/tutorial-faq"
import { Newsletter } from "@/components/newsletter"

export default function TutorialPage() {
  return (
    <main className="min-h-screen">
      <TutorialHero />
      <VideoTutorials />
      <TutorialFaq />
      <Newsletter />
    </main>
  )
}
