import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import Footer from '@/components/footer';
import Header from '@/components/header';

export default function aboutbijoufrench() {
  const { auth } = usePage<SharedData>().props;

  return (
    <div className="flex flex-col min-h-screen" style={{ backgroundColor: "#FEF4F3" }}>
      <Header name="About Bijou French" />

      <div className="mx-auto max-w-[1200px] px-2 py-10 font-noah text-lg">
        <div className="max-w-[890px] prose"><div>
          <p className="pb-5"><strong>The course</strong></p>
          <p className="pb-5">Bijou French is a fun, dynamic French course for primary school children, created by a qualified teacher with many years’ experience teaching children in this age range. The course is split into 3 levels: Mini Bijou for children in years 1-2, Petit Bijou for children in years 3-4 and Top Bijou for children in years 5-6. The Mini Bijou and Petit Bijou children will attend weekly breakfast or lunchtime clubs at school, on a day to be arranged with the school. The Top Bijou children will attend clubs run during the school holidays.</p>
          <p className="pb-5">As well as face-to-face lessons, the children will have the chance to consolidate and extend their learning using the following resources available on the website:</p>
          <ul className="pb-5 pl-6 list-disc">
            <li>
              <p className="pb-5">Downloadable activity sheets</p>
            </li>
            <li>
              <p className="pb-5">Song lyrics and audio versions of the songs</p>
            </li>
            <li>
              <p className="pb-5">Extra challenges and tips for further practice</p>
            </li>
          </ul>
          <p className="pb-5">The activity sheets allow the children to practise the language learned in the lessons and to explore some basic grammar points, as well as building in some reading and writing skills. Songs are a great way of learning a foreign language, and the children will be able to listen to our songs at home via the website and study the lyrics if they wish to. Extra challenges and tips are for those who wish to take their learning a little further.</p>
          <p className="pb-5"><strong>The lessons</strong></p>
          <p className="pb-5">The lessons are packed with entertaining activities, such as games (including the ever-popular hide and seek and magic bag), stories, songs &amp; rhymes, and much more. Bijou the puppy will bring a smile to our faces as she joins us for some of the activities. Where possible, we will do a practical activity to complete a topic, for example role plays and food tasting. This helps to bring the topic to life, as well as hopefully being very enjoyable. The spirit of the lessons is light-hearted and the emphasis very much on fun – in my experience children learn best when they are having fun!</p>
          <p className="pb-5">The lessons cover a range of engaging topics, such as holidays, food &amp; drink, and hobbies, carefully selected to appeal to a range of interests and also to lay the foundations for language learning at secondary school. We also learn sub-topics, such as colours, numbers, and weather, which are built into the lessons each week. Individual and team challenges keep motivation levels high, and the children’s efforts are rewarded with special French stickers and the occasional small prize for exceptional effort or achievement.</p>
          <p className="pb-5"><strong>Pricing</strong></p>
          <p className="pb-5">Mini Bijou &amp; Petit Bijou lunchtime club and breakfast club:</p>
          <p className="pb-5">&nbsp;£5.50-£6.00 per session (payable termly in advance)</p>
          <p className="pb-5">Top Bijou holiday club: £85 per course (three classes, each lasting 2.5 hours, to include drinks and snacks).</p>
          <p className="pb-5"><strong>GCSE tuition</strong></p>
          <p className="pb-5">Bijou French also offers one-to-one GCSE French tuition. I have several years’ experience tutoring pupils in Year 10 and Year 11. I really enjoy helping pupils prepare for the GSCE French exam, giving them a confidence boost and helping them to fulfil their potential. In the GCSE tuition classes, I will support your child’s learning by:</p>
          <ul className="pb-5 pl-6 list-disc">
            <li>
              <p className="pb-5">giving tailored help with all 4 language skills assessed in the GCSE French exam (reading, writing, listening, speaking).</p>
            </li>
            <li>
              <p className="pb-5">working with them to identify areas of the language where improvement may be needed and focussing on these areas.</p>
            </li>
            <li>
              <p className="pb-5">identifying and polishing their strengths in the French language, ensuring they make good use of these, especially in the papers where they have a little more control over the language they use (writing and speaking).</p>
            </li>
            <li>
              <p className="pb-5">in the months leading up to the GCSEs, providing guidance and support with exam preparation for GCSE French (effective revision and time management, etc) and exam technique (timing, familiarity with exam papers, breaking down difficult questions, gaining bonus points in writing and speaking, etc).</p>
            </li>
          </ul>
          <p className="pb-5">The GCSE tuition classes take place on a weekly basis, in my home in Abingdon.&nbsp;</p>
          <p className="pb-5">Please email me for further information or to book your free 30 minute consultation: <u><a href="mailto:susannahbackley@gmail.com">susannahbackley@gmail.com</a></u></p>
          <p className="pb-5">A bientôt,</p>
          <p className="pb-5">Sue</p>
        </div>
        </div>
      </div>

      <Footer />
    </div>
  )
}