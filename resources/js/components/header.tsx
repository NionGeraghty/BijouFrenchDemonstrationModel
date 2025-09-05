import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import flagLogo from '@/images/flag-logo.png';

export default function Footer(props:{name:string}) {
    const { auth } = usePage<SharedData>().props;

  return (
      <header className = "bg-[#6FA7BD] text-white">
      <div className="flex justify-between items-center px-20">
          <div className="Logo">
              <Link href="/"><img src={flagLogo} width="250" height="110" alt="Bijou French" /></Link>
          </div>
          <div className="flex flex-col lg:flex-row justify-between w-2/5">
              <Link href="/">Home</Link>
              <Link href="/courses">Courses</Link>
              <Link href="/aboutbijoufrench">About Bijou French</Link>
              <Link href="/aboutsue">About Sue</Link>
          </div>
          
      </div>
      <div className="text-center text-3xl font-bold mb-2">
        {props.name}
      </div>
      </header>
  )
}