import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import activitysheets from '@/images/activity-sheets.png';
import songs from '@/images/songs.png';

export default function Downloadables() {
    const { auth } = usePage<SharedData>().props;

    return (
        <div className="order-[1] md:order-[3] pt-10">
            <div className="sticky top-2 flex flex-col items-center pb-10">
                <Link className="mb-4 block" href="/">
                    <img src={activitysheets} alt="Activity Sheets"></img></Link>
                <Link className="mb-4 block" href="/">
                    <img src={songs} alt="Songs"></img></Link>
            </div>
        </div>
    )
}