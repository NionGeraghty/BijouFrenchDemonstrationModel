// import { type SharedData } from '@/types';
// import { Head, Link, usePage } from '@inertiajs/react';
import Downloadables from '@/components/downloadables';
import Footer from '@/components/footer';
import Header from '@/components/header';

type CoursePageProps = {
    cohort: {
        title: string;
        slug: string;
    };
    article: {
        title: string;
        slug: string;
        text: string;
    };
};

export default function CoursePage({ cohort, article }: CoursePageProps) {
    // const { auth } = usePage<SharedData>().props;

    return (
        <div className="flex min-h-screen flex-col" style={{ backgroundColor: '#FEF4F3' }}>
            <Header name={cohort.title} /> {/*Change dynamically*/}
            <main className="flex flex-col items-stretch justify-between pr-10 md:flex-row">
                <div className="order-[2] mx-auto max-w-[1200px] px-2 py-10">
                    <div className="prose max-w-[890px] text-black" dangerouslySetInnerHTML={{ __html: article.text }} />
                </div>
                <Downloadables course={cohort.slug} /> {/*Change dynamically*/}
            </main>
            <Footer />
        </div>
    );
}
