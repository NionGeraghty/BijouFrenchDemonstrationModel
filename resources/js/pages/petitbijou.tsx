import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import Footer from '@/components/footer';
import Header from '@/components/header';
import Downloadables from '@/components/downloadables';

export default function Courses() {
    const { auth } = usePage<SharedData>().props;

    return (
        <div className="flex flex-col min-h-screen" style={{ backgroundColor: "#FEF4F3" }}>
            <Header name="Petit Bijou" />

            <main className="flex flex-col md:flex-row justify-between items-stretch pr-10">

                <div className="mx-auto max-w-[1200px] px-2 py-10 order-[2]">
                    <div className="max-w-[890px] prose">
                        <div>
                            <h3 className="text-3xl text-bold"><strong>Petit Bijou language summary: September to December 2025 (11 weeks)</strong></h3>
                            <p className="py-2"><em>This is a guide only: plenty of other language will be used during the lessons, &nbsp;and in the songs, the activity sheets, and the suggestions for further learning.</em></p>
                            <p className="text-blue-600"><span><strong>Greetings &amp; how we are feeling &nbsp;</strong></span></p>
                            <p className="py-2"><strong>Bonjour </strong>(hello) &nbsp; <strong>Salut </strong>(hi) &nbsp; <strong>Au revoir</strong> (goodbye) &nbsp; <strong>À bientôt</strong> (see you soon)<br /><strong>Comment ça va?/Ça va</strong> (how are you/how’s it going) &nbsp;</p>
                            <p>&nbsp;<strong>Ça va/Ça va bien </strong>(I’m okay/fine) &nbsp;<strong>Très bien merci</strong> (very well thanks) <strong>&nbsp; Ça va mal</strong> (not very good) &nbsp;&nbsp;<br /><strong>Je suis fatigué/fatiguée</strong> (I’m tired) &nbsp; &nbsp; &nbsp; <strong>Et toi/vous?</strong> (how about you?)</p>
                            <p>&nbsp;</p>
                            <p className="text-blue-600"><span><strong>Topic 1: My family&nbsp;</strong></span></p>
                            <p className="py-2"><strong>Je m’appelle…</strong> (my name is…) &nbsp; <strong>J’ai 7/8/9 ans</strong> (I’m 7/8/9 years old)</p>
                            <p className="py-2"><strong>Maman </strong>(mum) &nbsp; <strong>Papa </strong>(dad) &nbsp; <strong>ma soeur</strong> (my sister) &nbsp; <strong>mon frère</strong> (my brother) &nbsp;</p>
                            <p className="py-2"><strong>mon grand-père </strong>(my grandfather) <strong>ma grand-mère</strong> (my grandmother)</p>
                            <p className="py-2"><strong>Il s’appelle…</strong> (his name is …) &nbsp; <strong>Elle s’appelle…</strong> (Her name is…)</p>
                            <p className="py-2"><strong>Il/Elle est sympa</strong> (He/She is nice) &nbsp; &nbsp; <strong>Il/Elle est drôle</strong> (He/She is funny) &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>
                            <p className="py-2">&nbsp;<strong>Il est intelligent</strong> (He is intelligent) &nbsp; <strong>&nbsp;Elle est intelligente</strong> (She is intelligent)</p>
                            <p>&nbsp;</p>
                            <p className="text-blue-600"><span><strong>Topic 2: Decorating the Christmas tree</strong></span></p>
                            <p className="py-2"><em>We will be decorating a small foam Christmas tree, and the children will ask for the decorations they would like to put on the tree.</em></p>
                            <p className="py-2"><strong>Je décore le sapin </strong>(I’m decorating the Christmas tree)</p>
                            <p className="py-2"><strong>Père Noël/Papa Noël </strong>(Father Christmas) &nbsp;&nbsp;</p>
                            <p className="py-2"><strong>une étoile </strong>(a star) &nbsp;<strong>un renne</strong> (a reindeer) &nbsp;<strong>une boule de Noël </strong>( a bauble) &nbsp;</p>
                            <p className="py-2"><strong>je voudrais une boule rouge/jaune</strong> (I’d like a red/yellow bauble) &nbsp; &nbsp; plus other colours</p>
                            <p className="py-2"><strong>la bûche de Noël</strong> (the chocolate yule log) &nbsp;&nbsp;</p>
                            <p className="py-2"><strong>Je voudrais une part de bûche de Noël s’il vous plaît</strong> (I’d like a slice of Yule log please)&nbsp;</p>
                            <p className="py-2"><strong>Bon appétit</strong> (Enjoy your food)</p>
                            <p className="py-2"><strong>Joyeux Noël </strong>(Merry Christmas) &nbsp; <strong>Bonne année </strong>(Happy new year)</p>
                            <p>&nbsp;</p>
                            <p><strong>Basics</strong></p>
                            <p className="py-2">Colours and numbers</p>
                            <p><strong>Songs&nbsp;</strong></p>
                            <p className="py-2">Bonjour Bonjour comment ça va?</p>
                            <p className="py-2">Fais dodo</p>
                            <p className="py-2">Petit Papa Noël</p>
                            <p className="py-2">L’as-Tu Vu ?</p>
                        </div>
                    </div>
                </div>

                <Downloadables />
            </main>

            <Footer />
        </div>
    )
} 