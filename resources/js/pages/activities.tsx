// import { Head, Link, usePage } from "@inertiajs/react";
import Downloadables from '@/components/downloadables';
import Footer from '@/components/footer';
import Header from '@/components/header';
import { ReactNode, useEffect, useState } from 'react';

type ActivitiesProps = {
    group: {
        title: string;
        slug: string;
        activeCourse?: {
            title: string;
            access_code: string;
        };
    };
    activities: {
        title: string;
        worksheet: string;
        answers: string;
    }[];
};

type AuthGuardProps = {
  children?: ReactNode;
  correctPassword: string;
  slug: string;
  group: {
    title: string;
    slug: string;
  };
};

function AuthGuard({ children, correctPassword, slug, group }: AuthGuardProps) {
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
                <Header name={group.title} />
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
            <Downloadables course={group.slug} />
            </main>
            <Footer />
            </div>
        );
    }

    return <>{children}</>;
}

export default function Activities({ group, activities }: ActivitiesProps) {
    return (
        <AuthGuard correctPassword={group.activeCourse?.access_code || ''} slug={group.slug} group={group}>
            <div className="flex min-h-screen flex-col text-black" style={{ backgroundColor: '#FEF4F3' }}>
                <Header name={group.title} /> {/*Change dynamically*/}
                <main className="flex flex-col items-stretch justify-between pr-10 md:flex-row">
                    <div>
                        <div className="order-[2] mx-auto max-w-[1200px] px-2 py-10">Activities go here</div>
                        <div className="order-[2] pr-10">
                            <ul className="posts pt-10 pb-16">
                                {activities?.map((activity) => (
                                    <li key={activity.title} className="flex flex-col items-start pb-4 md:flex-row">
                                        <p className="md:flex-[0_0_400px]">{activity.title}</p>
                                        <a
                                            className="text-blue-primary mx-5 whitespace-nowrap hover:underline md:block"
                                            href={activity.worksheet}
                                            download
                                        >
                                            Worksheet
                                        </a>
                                        <a
                                            className="text-blue-primary mx-5 whitespace-nowrap hover:underline md:block"
                                            href={activity.answers}
                                            download
                                        >
                                            Answers
                                        </a>
                                    </li>
                                ))}
                            </ul>
                        </div>
                    </div>
                    <Downloadables course={group.slug} /> {/*Change dynamically*/}
                </main>
                <Footer />
            </div>
        </AuthGuard>
    );
}
