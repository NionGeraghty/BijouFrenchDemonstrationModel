import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import Footer from '@/components/footer';
import Header from '@/components/header';
//import miniBijou from '@/images/mini-bijou.png';
//import petitBijou from '@/images/petit-bijou.png';

type CoursesProps = {
  groups: {
    title: string
    slug: string
    image: string
  }[]
}

export default function Courses({groups}: CoursesProps) {
    const { auth } = usePage<SharedData>().props;

  return (

    <div className="flex flex-col min-h-screen" style={{ backgroundColor: "#FEF4F3" }}>

      <Header name="Courses" />

      <div className="flex flex-1 flex-col sm:flex-row items-center justify-around py-10">
        { groups.map(group =>
        <div key={group.slug}>
          <Link href={"courses/" + group.slug}><img width="150" height="150" alt={group.title} src={group.image}></img></Link>
          <span className='flex justify-center text-bold text-3xl pt-5'>{group.title}</span>
          </div>) }
      </div>

      <Footer />
    </div>
  )
} 