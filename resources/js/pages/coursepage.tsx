import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import Footer from '@/components/footer';
import Header from '@/components/header';
import Downloadables from '@/components/downloadables';

type CoursePageProps = {
  cohort: {
    title: string;
    slug: string;
  };
  articles: {
    title: string
    slug: string
    text: string
  }[];
};

export default function CoursePage({cohort, articles}: CoursePageProps) {
    const { auth } = usePage<SharedData>().props;

    return (
        <div className="flex flex-col min-h-screen" style={{ backgroundColor: "#FEF4F3" }}>
            <Header name={cohort.title} /> {/*Change dynamically*/}
            <main className="flex flex-col md:flex-row justify-between items-stretch pr-10">
                <div className="mx-auto max-w-[1200px] px-2 py-10 order-[2]">
                    <div className="max-w-[890px] prose" dangerouslySetInnerHTML={{
                    __html: articles.find((c) => c.slug === cohort.slug)?.text || '',
                    }}>
                    </div></div>

                <Downloadables course={cohort.slug} /> {/*Change dynamically*/}
            </main>

            <Footer />
        </div>
    )
} 