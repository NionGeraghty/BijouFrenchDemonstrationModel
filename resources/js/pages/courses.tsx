import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import Footer from '@/components/footer';
import Header from '@/components/header';
//import miniBijou from '@/images/mini-bijou.png';
//import petitBijou from '@/images/petit-bijou.png';

type CoursesProps = {
  courses: {
    title: string
    slug: string
    imgSrc: string
  }[]
  
}

export default function Courses({courses}: CoursesProps) {
    const { auth } = usePage<SharedData>().props;

  return (
    
    <div className="flex flex-col min-h-screen" style={{ backgroundColor: "#FEF4F3" }}>
      
      <Header name="Courses" />

      <div className="flex flex-1 flex-col sm:flex-row items-center justify-around py-10">
        { courses.map(course => 
        <div key={course.slug}>
          <Link href={"courses/" + course.slug}><img width="150" height="150" alt={course.title} src={course.imgSrc}></img></Link>
          <span className='flex justify-center text-bold text-3xl pt-5'>{course.title}</span>
          </div>) }
      </div>

      <Footer />
    </div>
  )
} 