import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import Footer from '@/components/footer';
import Header from '@/components/header';
import miniBijou from '@/images/mini-bijou.png';
import petitBijou from '@/images/petit-bijou.png';

export default function Courses() {
    const { auth } = usePage<SharedData>().props;

  return (
    <div className="flex flex-col min-h-screen" style={{ backgroundColor: "#FEF4F3" }}>
      <Header name="Courses" />

      <div className="flex flex-1 flex-col sm:flex-row items-center justify-around py-10">
        <div>
          <Link href="courses/minibijou" ><img width="150" height="150" alt="Mini-Bijou" src={miniBijou}></img></Link>
          <span className='flex justify-center text-bold text-3xl pt-5'>Mini Bijou</span>
        </div>
        <div>
          <Link href="courses/petitbijou"><img width="150" height="150" alt="Petit-Bijou" src={petitBijou}></img></Link>
          <span className='flex justify-center text-bold text-3xl pt-5'>Petit Bijou</span>
        </div>
      </div>

      <Footer />
    </div>
  )
} 