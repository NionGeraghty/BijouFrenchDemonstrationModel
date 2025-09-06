import { Head, usePage } from "@inertiajs/react";
import Footer from '@/components/footer';
import Header from '@/components/header';
import Downloadables from '@/components/downloadables';

export default function AuthPage() {
  const { course, page } = usePage<{ course: string; page: string }>().props;

    return (
        <div className="flex flex-col min-h-screen" style={{ backgroundColor: "#FEF4F3" }}>
            <Header name={course === "petitbijou" ? "Petit Bijou" : "Mini Bijou"} />

            <main className="flex flex-col md:flex-row justify-between items-stretch pr-10">

                <div className="mx-auto max-w-[1200px] px-2 py-10 order-[2]">
                    This course requires an access code.<br />
                    Please enter your code below
                    <input
                        type="password"
                        placeholder="Enter code"
                        className="w-full border rounded-lg px-4 py-2 mb-4 bg-white text-black border-black"
                    />
                </div>

                <Downloadables course={course} />
            </main>

            <Footer />
        </div>
    );
}
