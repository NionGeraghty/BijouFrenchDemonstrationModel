import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import flagLogo from '@/images/flag-logo.png';
import children from '@/images/children.png';

export default function testHome() {
    const { auth } = usePage<SharedData>().props;

  return (
    <div className="flex flex-col min-h-screen" style={{ backgroundColor: "#FEF4F3" }}>
        <div className="flex justify-between items-center px-20">
    <div className="Logo">
        <img src={flagLogo} width="250" height="110" alt="Bijou French" />
    </div>
    <div className="flex flex-col lg:flex-row justify-between w-2/5">
        <Link href="/">Home</Link>
        <Link href="/Courses">Courses</Link>
        <Link>About Bijou French</Link>
        <Link>About Sue</Link>
    </div>
</div>

        <div className="flex flex-col md:flex-row justify-around items-center md:items-start">
        <div className="pt-[7%] align-self:center">
            <img src={children} alt="Students" width="300" height="163" />
        </div>

        <div className="basis-full lg:basis-2/5 text-center lg:text-left">
  <p className="text-center font-semibold text-2xl sm:text-3xl md:text-4xl text-[#aa837e] leading-none">
    Welcome to
  </p>

  <h1 className="text-center font-bold text-4xl sm:text-5xl md:text-6xl lg:text-7xl mt-2 tracking-tighter text-blue-900 leading-[1]">
    Bijou French
  </h1>

  <p className="mt-4 text-base sm:text-lg">
    French club for primary school children
  </p>

  <ul className="list-disc mt-4 space-y-2 text-base sm:text-lg text-left inline-block mx-auto lg:mx-0">
    <li>Fun and engaging lessons in a relaxed and happy atmosphere.</li>
    <li>Action games, team activities, magic, songs, and much more…</li>
    <li>Extra resources and challenges on the website.</li>
  </ul>

  <p className="mt-4 text-base sm:text-lg">
    Join us at Bijou French for a fun-filled French adventure!
  </p>

  <div className="flex flex-col sm:flex-row justify-around gap-4 mt-6">
    <Link
      href="/"
      className="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition text-center"
    >
      Mini Bijou
    </Link>
    <Link
      href="/"
      className="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition text-center"
    >
      Petit Bijou
    </Link>
  </div>
</div>
        </div>

        <div className="mt-auto">
        <div className="py-6 bg-[#7EB1C2] text-white/80">
        <div className="mx-auto max-w-[1200px] px-2">
            <div className="flex flex-col sm:flex-row justify-between items-center">
                <img src={flagLogo} alt="Bijou French" width="250" height="110"></img>
                <nav className="sm:pt-0 pt-4">
                    <h2 className="uppercase tracking-widest mb-2">Navigate</h2> 
                    <ul className="text-sm">
                        <li><Link href="/">Home</Link></li> 
                        <li><Link href="/Courses">Courses</Link></li> 
                        <li><Link href="/about-bijou-french">About Bijou French</Link></li> 
                        <li><Link href="/about-sue">About Sue</Link></li> 
                    </ul>
                </nav>
            </div>
        </div>
        </div>
        <div className="bg-[#08688e] text-white/50 text-sm py-2">
            <div className="mx-auto max-w-[1200px] px-2">
                <p>© Copyright {new Date().getFullYear()} Susannah Backley trading as Bijou French</p>
            </div>
        </div>
        </div>
    </div>
  );
}
