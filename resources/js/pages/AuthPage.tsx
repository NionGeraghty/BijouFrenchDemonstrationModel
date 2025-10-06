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
    title: string;
    access_code: string;
  }[];
};

export default function AuthPage({cohort, courses}:AuthPageProps) {
  const { course, page } = usePage<{ course: string; page: string }>().props;
  const [password, setPassword] = useState("");

  const handleClick = () =>{
    const match = courses.find(c => c.access_code === password);

    if (match){
        alert("Valid Password! :)");
    }
    else{
        alert("Invalid Password! :(")
    }
  };

    return (
        <div className="flex flex-col min-h-screen" style={{ backgroundColor: "#FEF4F3" }}>
            <Header name={cohort.title} />

            <main className="flex flex-col md:flex-row justify-between items-stretch pr-10">

                <div className="mx-auto max-w-[1200px] px-2 py-10 order-[2]">
                    This course requires an access code.<br />
                    Please enter your code below
                    <input
                        type="password"
                        placeholder="Enter code"
                        onChange={(e) => setPassword(e.target.value)}
                        className="w-full border rounded-lg px-4 py-2 mb-4 bg-white text-black border-black"
                    />
                    <button
                    onClick={handleClick}
                    className="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition text-center"
                    >
                    Authenticate
                    </button>
                </div>

                <Downloadables course={cohort.slug} />
            </main>

            <Footer />
        </div>
    );
}
