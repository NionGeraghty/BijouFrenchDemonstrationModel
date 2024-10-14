<template>
    <div class="flex justify-center items-center">
        <div class="w-full">
            <Heading>Dashboard</Heading>
            <p class="leading-tight mt-3">Welcome to the dashboard!</p>
            <h1 class="mt-8 text-xl text-gray-500 font-light">
                Game Submissions
            </h1>
            <div class="mt-4">
                <Card class="p-4 mb-2" v-for="course in data.courses">
                    <h2 class="text-xl">
                        {{ course.title }}
                    </h2>
                    <div>
                        <div class="grid grid-cols-4 font-bold">
                            <p>Name</p>
                            <p>Date</p>
                            <p>Completed?</p>
                            <p>Time spent</p>
                        </div>
                        <div
                            v-for="attempt in course.game_attempts"
                            class="grid grid-cols-4"
                        >
                            <p>
                                {{ attempt.name }}
                            </p>
                            <p>
                                {{ attempt.date }}
                            </p>
                            <p>
                                {{ attempt.completed_at ? "Yes" : "No" }}
                            </p>
                            <p>
                                {{
                                    attempt.time_spent
                                        ? attempt.time_spent
                                        : "-"
                                }}
                            </p>
                        </div>
                    </div>
                </Card>
            </div>
            <h1 class="mt-8 text-xl text-gray-500 font-light">Live Courses</h1>
            <div class="grid grid-cols-3 gap-3 mt-4">
                <Card
                    class="flex flex-col items-stretch justify-stretch live-courses__card-shadow"
                    v-for="course in data.courses"
                >
                    <a
                        class="block p-4 h-full w-full"
                        :href="`/resources/courses/${course.id}`"
                    >
                        <h2 class="text-xl">
                            {{ course.title }}
                        </h2>
                        <h3 class="mt-2">
                            {{ course.activities.length }} Activities
                        </h3>
                        <div class="pl-2">
                            <p>
                                {{
                                    course.activities.filter((a) => a.worksheet)
                                        .length
                                }}
                                Worksheets
                            </p>
                            <p>
                                {{
                                    course.activities.filter((a) => a.answers)
                                        .length
                                }}
                                Answers
                            </p>
                        </div>
                        <h3 class="mt-2">{{ course.songs.length }} Songs</h3>
                        <div class="pl-2">
                            <p>
                                {{
                                    course.songs.filter((s) => s.lyrics).length
                                }}
                                Lyrics
                            </p>
                            <p>
                                {{ course.songs.filter((s) => s.mp3).length }}
                                MP3s
                            </p>
                        </div>
                    </a>
                </Card>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, onMounted } from "vue";

const data = reactive({
    courses: [],
});

onMounted(() => {
    // populate data.courses
    Nova.request()
        .get("/nova-vendor/live-courses")
        .then((response) => {
            data.courses = response.data;
        })
        .catch((error) => {
            console.error("Error fetching courses", error);
        });
});
</script>
