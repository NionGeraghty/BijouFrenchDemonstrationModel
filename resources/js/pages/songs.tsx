import { Head, Link, usePage } from "@inertiajs/react";
import Footer from '@/components/footer';
import Header from '@/components/header';
import Downloadables from '@/components/downloadables';

type SongsProps = {
  cohort: {
    title: string;
    slug: string;
  };
  songslist:{
    title: string;
    mp3: string;
    lyrics: string;
  }[];
}

export default function Songs({cohort,songslist}:SongsProps){
    return(
        <div className="flex flex-col min-h-screen" style={{ backgroundColor: "#FEF4F3" }}>
                    <Header name={cohort.title} /> {/*Change dynamically*/}
                    <main className="flex flex-col md:flex-row justify-between items-stretch pr-10">
                        <div className="mx-auto max-w-[1200px] px-2 py-10 order-[2]">
                            Songs go here
                        </div>

                        <div className='pr-10 order-[2]'>
                          <ul className = 'posts pt-10 pb-16'>
                            {
                              songslist.map( song => 
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
    )
}