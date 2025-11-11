<template>
    <div>
        <Head title="Pages" />

        <Heading class="mb-6">Pages</Heading>

        <Card v-for="page in data.pages" class="p-4 mb-6">
            <div class="mb-2 text-xl">
                <p>/{{ page.slug }}</p>
            </div>

            <p class="mb-1">Article</p>
            <div class="flex gap-2">
                <div>
                    <select
                        class="p-1"
                        :value="page.article_id"
                        @change="
                            handleArticleChange(page.slug, $event.target.value)
                        "
                    >
                        <option
                            v-for="article in data.articles"
                            :value="article.id"
                        >
                            {{ article.title }}
                        </option>
                    </select>
                </div>
            </div>

            <!-- <button @click="updateArticle">Update article</button> -->
        </Card>
    </div>
</template>

<script setup>
import { reactive, onMounted } from "vue";

const data = reactive({
    pages: [],
    articles: [],
});

const handleArticleChange = (slug, articleId) => {
    console.log("Updating article", slug, articleId);
    Nova.request()
        .put(`/nova-vendor/pages/${slug}`, { article_id: articleId })
        .then((response) => {
            // Handle success if needed
            console.log("Article updated successfully", response);
        })
        .catch((error) => {
            // Handle error if needed
            console.error("Error updating article", error);
        });
};

onMounted(() => {
    // populate data.pages
    Nova.request()
        .get("/nova-vendor/pages")
        .then((response) => {
            data.pages = response.data;
        });

    // populate data.articles
    Nova.request()
        .get("/nova-vendor/pages/articles")
        .then((response) => {
            data.articles = response.data;
        });
});
</script>

<style>
/* Scoped Styles */
</style>
