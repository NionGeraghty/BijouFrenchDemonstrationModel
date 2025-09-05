import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import flagLogo from '@/images/flag-logo.png';

export default function Footer() {
    const { auth } = usePage<SharedData>().props;

  return (
    <footer className="mt-auto">
        <div className="py-6 bg-[#7EB1C2] text-white/80">
        <div className="mx-auto max-w-[1200px] px-2">
            <div className="flex flex-col sm:flex-row justify-between items-center">
                <img src={flagLogo} alt="Bijou French" width="250" height="110"></img>
                <nav className="sm:pt-0 pt-4">
                    <h2 className="uppercase tracking-widest mb-2">Navigate</h2> 
                    <ul className="text-sm">
                        <li><Link href="/">Home</Link></li> 
                        <li><Link href="/courses">Courses</Link></li> 
                        <li><Link href="/aboutbijoufrench">About Bijou French</Link></li> 
                        <li><Link href="/aboutsue">About Sue</Link></li> 
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
        </footer>
  )
}

