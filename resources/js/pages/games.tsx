import Footer from '@/components/footer';
import Header from '@/components/header';
import Downloadables from '@/components/downloadables';
import { ReactNode, useEffect, useState } from 'react';

type GamesProps = {
  group: {
    title: string;
    slug: string;
    course?: {
      title: string;
      access_code: string;
    };
  };
  gamesData: {
    reorder_games: any[];
    odd_one_out_games: any[];
    category_games: any[];
    match_up_games: any[];
    games_active: boolean;
  };
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
    if (savedPassword) {
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
            <button
              onClick={handleClick}
              className="rounded bg-blue-500 px-6 py-2 text-center text-white transition hover:bg-blue-600"
            >
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

export default function Games({ group, gamesData }: GamesProps) {
  return (
    <AuthGuard correctPassword={group.course?.access_code || ''} slug={group.slug} group={group}>
      <div className="flex min-h-screen flex-col text-black" style={{ backgroundColor: '#FEF4F3' }}>
        <Header name={group.title} />
        <main className="flex flex-col items-stretch justify-between pr-10 md:flex-row">
          <div className="order-[2] mx-auto w-full max-w-[1200px] px-2 py-10">
            <h1 className="mb-6 text-2xl font-bold">Games</h1>

            {!gamesData.games_active && (
              <div className="mb-4 rounded-lg bg-yellow-100 p-4 text-yellow-800">
                <p>Games are currently inactive for this course.</p>
              </div>
            )}

            <div className="space-y-8">
              {/* Reorder Games */}
              <div className="rounded-lg bg-white p-6 shadow">
                <h2 className="mb-4 text-xl font-semibold">Reorder Games</h2>
                <pre className="overflow-x-auto rounded bg-gray-100 p-4 text-sm">
                  {JSON.stringify(gamesData.reorder_games, null, 2)}
                </pre>
              </div>

              {/* Odd One Out Games */}
              <div className="rounded-lg bg-white p-6 shadow">
                <h2 className="mb-4 text-xl font-semibold">Odd One Out Games</h2>
                <pre className="overflow-x-auto rounded bg-gray-100 p-4 text-sm">
                  {JSON.stringify(gamesData.odd_one_out_games, null, 2)}
                </pre>
              </div>

              {/* Category Games */}
              <div className="rounded-lg bg-white p-6 shadow">
                <h2 className="mb-4 text-xl font-semibold">Category Games</h2>
                <pre className="overflow-x-auto rounded bg-gray-100 p-4 text-sm">
                  {JSON.stringify(gamesData.category_games, null, 2)}
                </pre>
              </div>

              {/* Match Up Games */}
              <div className="rounded-lg bg-white p-6 shadow">
                <h2 className="mb-4 text-xl font-semibold">Match Up Games</h2>
                <pre className="overflow-x-auto rounded bg-gray-100 p-4 text-sm">
                  {JSON.stringify(gamesData.match_up_games, null, 2)}
                </pre>
              </div>
            </div>
          </div>
          <Downloadables course={group.slug} />
        </main>
        <Footer />
      </div>
    </AuthGuard>
  );
}

