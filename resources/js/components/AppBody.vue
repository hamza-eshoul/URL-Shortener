<template>
    <main class="my-10">
        <UrlsStatistics
            :urls="urls"
            :urls_visits_total="urls_visits_total"
            :most_visited_url="most_visited_url"
            :least_visited_url="least_visited_url"
        />
        <UrlShortener :addUrlToState="addUrlToState" />
        <UrlsList :latest_urls="latest_urls" />
    </main>
</template>

<script>
import { computed, onMounted, ref, toRaw } from "vue";

// components
import UrlsStatistics from "./UrlsStatistics.vue";
import UrlShortener from "./UrlShortener.vue";
import UrlsList from "./UrlsList.vue";

export default {
    components: { UrlsStatistics, UrlShortener, UrlsList },

    setup() {
        const urls = ref([]);
        const latest_urls = ref([]);

        onMounted(() => {
            const fetchUrls = async () => {
                const response = await fetch(
                    "http://localhost:8000/api/url/shorten"
                );

                const json = await response.json();

                urls.value = json;

                latest_urls.value = json.slice(0, 10);
            };

            fetchUrls();
        });

        const addUrlToState = (url) => {
            urls.value = [url, ...urls.value];
            latest_urls.value = [url, ...latest_urls.value];
        };

        // Urls Stats

        const urls_visits_total = computed(() => {
            if (urls.length !== 0) {
                return urls.value.reduce((total, url) => {
                    return total + url.visits_count;
                }, 0);
            }
        });

        const most_visited_url = computed(() => {
            if (urls.length !== 0) {
                const ordered_urls = urls.value.sort((a, b) => {
                    if (a.visits_count < b.visits_count) {
                        return 1;
                    } else {
                        return -1;
                    }
                });

                return toRaw(ordered_urls[0]);
            }
        });

        const least_visited_url = computed(() => {
            if (urls.length !== 0) {
                const unordered_urls = urls.value.sort((a, b) => {
                    if (a.visits_count > b.visits_count) {
                        return 1;
                    } else {
                        return -1;
                    }
                });

                return toRaw(unordered_urls[0]);
            }
        });

        return {
            urls,
            latest_urls,
            urls_visits_total,
            most_visited_url,
            least_visited_url,
            addUrlToState,
        };
    },
};
</script>

<style></style>
