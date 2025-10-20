import activitysheets from '@/images/activity-sheets.png';
import songs from '@/images/songs.png';
import { type SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/react';

interface Props {
    course: string;
}

export default function Downloadables({ course }: Props) {
    const { auth } = usePage<SharedData>().props;

    return (
        <div className="order-[1] pt-10 md:order-[3]">
            <div className="sticky top-2 flex flex-col items-center pb-10">
                <Link className="mb-4 block" href={`/courses/${course}/activities`}>
                    <img src={activitysheets} alt="Activity Sheets"></img>
                </Link>
                <Link className="mb-4 block" href={`/courses/${course}/songs`}>
                    <img src={songs} alt="Songs"></img>
                </Link>
            </div>
        </div>
    );
}
