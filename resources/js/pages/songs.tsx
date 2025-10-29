import { Head, Link, usePage } from "@inertiajs/react";
import Footer from '@/components/footer';
import Header from '@/components/header';
import Downloadables from '@/components/downloadables';
import { ReactNode, useEffect, useState } from 'react';

type SongsProps = {
  cohort: {
    title: string;
    slug: string;
    active_course?: {
        title: string;
        access_code: string;
    };
  };
  songslist:{
    title: string;
    mp3: string;
    lyrics: string;
  }[];
}

type AuthGuardProps = {
  children?: ReactNode;
  correctPassword: string;
  slug: string;
  cohort: {
    title: string;
    slug: string;
  };
};

function AuthGuard({ children, correctPassword, slug, cohort }: AuthGuardProps) {
    const [password, setPassword] = useState('');
    const [authenticated, setAuthenticated] = useState(false);

    const handleClick = () => {
        setAuthenticated(password === correctPassword);
    };

    const cleanUpSavedPassword = () => {
        localStorage.removeItem(`auth_${slug}`);
    };

    useEffect(() => {
        if (authenticated) {
            // save the password to localStorage
            localStorage.setItem(`auth_${slug}`, password);
        } else {
            // wrong pass, delete the password
            cleanUpSavedPassword();
        }
    }, [authenticated]);

    useEffect(() => {
        // check for a saved password in localStorage
        const savedPassword = localStorage.getItem(`auth_${slug}`);
        if (savedPassword){
        if (savedPassword === correctPassword) {
            setAuthenticated(true);
            setPassword(savedPassword);
        } else {
            cleanUpSavedPassword();
        }
    }
    }, []);

    if (!authenticated) {
        return (
            <div className="flex min-h-screen flex-col text-black" style={{ backgroundColor: '#FEF4F3' }}>
                <Header name={cohort.title} />
                <main className="flex flex-col md:flex-row justify-between items-stretch pr-10">
            <div className="mx-auto max-w-[1200px] px-2 py-10 order-[2]">
                This course requires an access code.
                <br />
                Please enter your code below
                <input
                    type="password"
                    value={password}
                    placeholder="Enter code"
                    onChange={(e) => setPassword(e.target.value)}
                    onKeyDown={(e) => {
                        if (e.key === 'Enter') {
                            handleClick();
                        }
                    }}
                    className="mb-4 w-full rounded-lg border border-black bg-white px-4 py-2 text-black"
                />
                <button onClick={handleClick} className="rounded bg-blue-500 px-6 py-2 text-center text-white transition hover:bg-blue-600">
                    Authenticate
                </button>
            </div>
            <Downloadables course={cohort.slug} />
            </main>
            <Footer />
            </div>
        );
    }

    return <>{children}</>;
}

export default function Songs({cohort,songslist}:SongsProps){
    return(
      <AuthGuard correctPassword={cohort.active_course?.access_code || ''} slug={cohort.slug} cohort={cohort}>
        <div className="flex flex-col min-h-screen" style={{ backgroundColor: "#FEF4F3" }}>
                    <Header name={cohort.title} /> {/*Change dynamically*/}
                    <main className="flex flex-col md:flex-row justify-between items-stretch pr-10">
                        <div className="mx-auto max-w-[1200px] px-2 py-10 order-[2]">
                            Songs go here
                        </div>

                        <div className='pr-10 order-[2]'>
                          <ul className = 'posts pt-10 pb-16'>
                            {
                              songslist?.map( song => 
                              <li key={song.title} className = 'flex pb-4 flex-col md:flex-row items-start'>
                                <p className="md:flex-[0_0_400px]">{song.title}</p>
                                <a className="mx-5 md:block whitespace-nowrap text-blue-primary hover:underline" href={song.mp3} download>Song</a>
                                <a className="mx-5 md:block whitespace-nowrap text-blue-primary hover:underline" href={song.lyrics} download>Lyrics</a>
                              </li>
                              )}
                          </ul>
                        </div>
        
                        <Downloadables course={cohort.slug} /> {/*Change dynamically*/}
                    </main>
        
                    <Footer />
                </div>
            </AuthGuard>
    )
} 