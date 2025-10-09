import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import Footer from '@/components/footer';
import Header from '@/components/header';

type ArticlesProps = {
  articles: {
    title: string
    slug: string
    text: string
  }[]
}

export default function aboutsue({articles}:ArticlesProps) {
  const { auth } = usePage<SharedData>().props;

  return (
    <div className="flex flex-col min-h-screen" style={{ backgroundColor: "#FEF4F3" }}>
      <Header name="About Sue" />

      <div className="mx-auto max-w-[1200px] px-2 py-10 font-noah text-lg">
        <div className="max-w-[890px] prose" dangerouslySetInnerHTML={{
      __html: articles.find((c) => c.slug === 'aboutsue')?.text || '',
    }}></div>
      </div>

      {/*<div className="mx-auto max-w-[1200px] px-2 py-10 font-noah text-lg">
        <div className="max-w-[890px] prose">
          <div>
            <h2 className="pb-5">My Story</h2>
            <p className="pb-5">Bonjour! My name is Sue Backley, and I run <strong>Bijou French</strong>.</p>

            <p className="pb-5">I have always loved France and the French language. As a child I spent many happy holidays in France with my family, and we especially enjoyed our trips to Bordeaux to stay with friends. After studying French with German at university, I moved to Nancy in north-eastern France, where I spent 4 years teaching English to university students. I then lived in Paris for 3 years, where I continued to teach English at the Franco-British Chamber of Commerce. I loved my time in France, absorbing the culture and the language, and I continue to enjoy regular holidays there with my family. </p>

            <p className="pb-5">My professional life has been devoted to teaching. Since moving back to England and doing my teacher training, I have taught French and German in secondary schools and French at primary level. Teaching primary school pupils made me realise how well children respond to a language at a young age. I also witnessed first-hand how my own son (now 20 years old!) absorbed French naturally and with a great deal of enthusiasm and enjoyment when he was a child. With this in mind, I set up a French club for children called <strong>Les Petits Dauphins</strong> in January 2007. Since
              then, I have taught countless children of primary age, in lunchtime and after-school clubs in Abingdon. I have loved every second of it!</p>

            <p className="pb-5">When Covid-19 struck in March 2020, I had no idea that I would be unable to return to work for over 18 months. Once the reality began to sink in, I decided to try to put the time to the best possible use and to produce something positive out of a difficult situation. And so, I am very happy to introduce you to Bijou French, my brand-new French course for primary children. So, what is new? As well as attending weekly face-to-face French classes at school, the children will have access to several new resources on my brand-new Bijou French website (see <Link className="text-blue-600 hover:underline" href="/aboutbijoufrench">About Bijou French</Link> for more information). I believe that, by offering this extra material to supplement the classes, I can offer a complete language learning experience, as well as making it easier for parents to get involved with their child’s learning, if they wish to do so.</p>

            <p className="pb-5">I am really excited to embark on this fresh adventure: I love finding new ways to share my passion for France and the French language, and I very much hope your child will enjoy learning French with Bijou French.</p>

            <p className="pb-5">À bientôt.</p>

            <p className="pb-5">Sue</p>

            <p className="pb-5">October 2022</p>
          </div>
        </div>
      </div>*/}

      <Footer />
    </div>
  )
}