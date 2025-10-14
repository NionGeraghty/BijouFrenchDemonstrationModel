import { type SharedData } from '@/types';
import { useState } from "react";
import { Head, Link, usePage } from "@inertiajs/react";
import Footer from '@/components/footer';
import Header from '@/components/header';
import Downloadables from '@/components/downloadables';
import { GitCommitHorizontal } from "lucide-react";
import Courses from './courses';

type AuthPageProps = {
  cohort: {
    title: string;
    slug: string;
  };
  courses:{
    id: number;
    title: string;
    access_code: string;
  }[];
  songs:{
    title: string;
    course_id: number;
    mp3: string;
    lyrics: string;
  }[];
  activities:{
    title: string;
    course_id: number;
    worksheet: string;
    answers: string;
  }[];
};

export default function AuthPage({cohort, courses, songs, activities}:AuthPageProps) {
  const { course, page } = usePage<{ course: string; page: string }>().props;
  const [password, setPassword] = useState("");
  const [authenticated, setAuthenticated] = useState(false);
  const [authenticatedCourse, setAuthenticatedCourse] = useState<number | null>(null);

  const handleClick = () =>{
    const match = courses.find(c => c.access_code === password);

    if (match){
        setAuthenticated(true);
        setAuthenticatedCourse(match.id);
    }
    else{
        setPassword("");
        alert("Invalid Password! :(");
    }
  };

    return (
        <div className="flex flex-col min-h-screen" style={{ backgroundColor: "#FEF4F3" }}>
            <Header name={cohort.title} />

            <main className="flex flex-col md:flex-row justify-between items-stretch pr-10">

                {!authenticated ? (<div className="mx-auto max-w-[1200px] px-2 py-10 order-[2]">
                    This course requires an access code.<br />
                    Please enter your code below
                    <input
                        type="password"
                        value={password}
                        placeholder="Enter code"
                        onChange={(e) => setPassword(e.target.value)}
                        onKeyDown={(e)=>{
                          if(e.key === "Enter"){
                            handleClick();
                          }
                        }}
                        className="w-full border rounded-lg px-4 py-2 mb-4 bg-white text-black border-black"
                    />
                    <button
                    onClick={handleClick}
                    className="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition text-center"
                    >
                    Authenticate
                    </button>
                </div>) : (
                  (()=>{
                    switch (page){
                      case "songs":
                        return (
                        <div className='pr-10 order-[2]'>
                          <ul className = 'posts pt-10 pb-16'>
                            {
                              songs.filter(song => song.course_id === authenticatedCourse).map( song => 
                              <li key={song.title} className = 'flex pb-4 flex-col md:flex-row items-start'>
                                <p className="md:flex-[0_0_400px]">{song.title}</p>
                                <a className="mx-5 md:block whitespace-nowrap text-blue-primary hover:underline" href={song.mp3} download>Song</a>
                                <a className="mx-5 md:block whitespace-nowrap text-blue-primary hover:underline" href={song.lyrics} download>Lyrics</a>
                              </li>
                              )}
                          </ul>
                        </div>);
                        case "activitysheets":
                        return (
                        <div className='pr-10 order-[2]'>
                          <ul className = 'posts pt-10 pb-16'>
                            {
                              activities.filter(activity => activity.course_id === authenticatedCourse).map( activity => 
                              <li key={activity.title} className = 'flex pb-4 flex-col md:flex-row items-start'>
                                <p className="md:flex-[0_0_400px]">{activity.title}</p>
                                <a className="mx-5 md:block whitespace-nowrap text-blue-primary hover:underline" href={activity.worksheet} download>Activity Sheet</a>
                                <a className="mx-5 md:block whitespace-nowrap text-blue-primary hover:underline" href={activity.answers} download>Answers</a>
                              </li>
                              )}
                          </ul>
                        </div>);
                        default:
                          return (<div>Error</div>)
                    }
                  })()
                  
                )
                }

                <Downloadables course={cohort.slug} />
            </main>

            <Footer />
        </div>
    );
}
