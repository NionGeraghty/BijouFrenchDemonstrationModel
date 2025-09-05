import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import Footer from '@/components/footer';
import Header from '@/components/header';
import Downloadables from '@/components/downloadables';

export default function Courses() {
    const { auth } = usePage<SharedData>().props;

    return (
        <div className="flex flex-col min-h-screen" style={{ backgroundColor: "#FEF4F3" }}>
            <Header name="Mini Bijou" />
            <main className="flex flex-col md:flex-row justify-between items-stretch pr-10">
                <div className="mx-auto max-w-[1200px] px-2 py-10 order-[2]">
                    <div className="max-w-[890px] prose">
                    <div>
                    <h3 className ="text-3xl text-bold">&nbsp;Mini Bijou Language Summary: September to December 2025 (11 weeks)</h3>
                    <p className="py-2"><em>This is a guide only: plenty of other language will be used during the lessons, &nbsp;and in the songs, the activity sheets, and the suggestions for further learning.</em></p>
                    <p>&nbsp;</p>
                    <p className="py-2"><strong>Greetings &amp; how we are feeling</strong></p>
                    <p className="py-2"><strong>Bonjour </strong>(hello) &nbsp; <strong>Salut </strong>(hi) &nbsp; <strong>Au revoir </strong>(goodbye) &nbsp;<strong> A bientôt</strong> (see you soon)</p>
                    <p className="py-2"><strong>Comment ça va?/Ça va?</strong> (how are you/how’s it going?) &nbsp; &nbsp;<strong>Ça va/Ça va bien</strong> (I’m okay/fine) &nbsp;&nbsp;</p>
                    <p className="py-2"><strong>Très bien merci </strong>(very well thanks) &nbsp; &nbsp; &nbsp; &nbsp;<strong>Je suis fatigué/fatiguée</strong> (I’m tired) &nbsp; &nbsp;&nbsp;</p>
                    <p>&nbsp;</p>
                    <p><strong>Topic 1: All about me</strong></p>
                    <p className="text-blue-600"><span><em>Children will learn to understand and answer 2 questions</em></span>.</p>
                    <p className="py-2"><strong>Comment tu t’appelles?</strong> (What’s your name?) &nbsp; <strong>Quel âge as-tu?</strong> (How old are you?)</p>
                    <p className="py-2"><strong>Je m’appelle …</strong> (My name is …) &nbsp; <strong>J’ai 5/6/7 ans</strong> (I’m 5/6/7 years old)</p>
                    <p className="text-blue-600"><em><span>Children will learn to say where they like to go.</span></em></p>
                    <p className="py-2"><strong>J’aime….</strong> (I like….)</p>
                    <p className="py-2"><strong>&nbsp;le parc</strong> (the park) &nbsp; <strong>&nbsp;la piscine</strong> (the swimming pool) &nbsp; &nbsp;<strong>le cinéma</strong> (the cinema) &nbsp;</p>
                    <p className="py-2"><strong>&nbsp;la plage</strong> (the beach) &nbsp;<strong> le parc d’attractions</strong> (the theme park)</p>
                    <p className="py-2"><strong>J’aime le cinéma, mais je préfère la plage</strong> (I like the cinema, but I prefer the beach), etc</p>
                    <p>&nbsp;</p>
                    <p><strong>Topic 2: Christmas</strong></p>
                    <p className="py-2"><strong>Père Noël/Papa Noël</strong> (Father Christmas) &nbsp; <strong>le cadeau</strong> (the present) &nbsp;<strong> le renne </strong>(the reindeer)</p>
                    <p className="py-2"><strong>le sapin de Noël</strong> (the Christmas tree) &nbsp; &nbsp; &nbsp; <strong>&nbsp;la bûche de Noël</strong> (chocolate yule log) &nbsp; &nbsp;</p>
                    <p className="py-2"><strong>Je voudrais une part de bûche de Noël s’il vous plaît&nbsp;</strong></p>
                    <p className="py-2">(I would like a slice of chocolate yule log please)</p>
                    <p className="py-2"><strong>Joyeux Noël</strong> (Merry Christmas) &nbsp;<strong>Bon appétit</strong> (Enjoy your food)</p>
                    <p>&nbsp;</p>
                    <p><strong>Basics</strong></p>
                    <p className="py-2">Colours &amp; numbers</p>
                    <p>&nbsp;</p>
                    <p><strong>Songs</strong></p>
                    <p className="py-2">Bonjour Monsieur</p>
                    <p className="py-2">Père Noël</p>
                    <p className="py-2">Petit Papa Noël</p>
                    <p className="py-2">Comment Tu T’appelles ?</p>
                    <p className="py-2">Quel Age As-Tu ?</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p></div></div></div>

                <Downloadables />
            </main>

            <Footer />
        </div>
    )
} 

