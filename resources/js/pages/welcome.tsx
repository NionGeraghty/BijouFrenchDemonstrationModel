import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import flagLogo from '@/images/flag-logo.png';
import children from '@/images/children.png';
import Footer from '@/components/footer';

type CoursesProps = {
  courses: {
    title: string
    slug: string
  }[] 
}

export default function Welcome({courses}: CoursesProps) {
    const { auth } = usePage<SharedData>().props;

  return (
    <div className="flex flex-col min-h-screen" style={{ backgroundColor: "#FEF4F3" }}>
      <div className="flex justify-between items-center px-20">
        <div className="Logo">
          <img src={flagLogo} width="250" height="110" alt="Bijou French" />
        </div>
        <div className="flex flex-col lg:flex-row justify-between w-2/5 text-black">
          <Link href="/">Home</Link>
          <Link href="/courses">Courses</Link>
          <Link href="/aboutbijoufrench">About Bijou French</Link>
          <Link href="/aboutsue">About Sue</Link>
        </div>
      </div>

        <div className="flex flex-col md:flex-row justify-around items-center md:items-start">
        <div className="pt-[7%] align-self:center">
            <img src={children} alt="Students" width="300" height="163" />
        </div>

        <div className="basis-full lg:basis-2/5 text-center lg:text-left text-black">
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
    { courses.map(course => 
        <div key={course.slug}>
          <Link
      href={"courses/" + course.slug}
      className="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition text-center"
    >
      {course.title}
    </Link>
          </div>) }
  </div>
</div>
        </div>

        <Footer />
    </div>
  );
}
