<template>
    <section class="max-w-4xl mx-auto px-10 mt-10">
        <h2 class="-translate-x-[1px] text-[17px] font-medium opacity-70">
            Urls Statistics
        </h2>

        <div class="grid grid-cols-2 gap-4 py-4">
            <div
                class="flex flex-col gap-1 border-zinc-300 border-[1px] rounded px-2 py-1.5"
            >
                <h2
                    class="-translate-x-[1px] text-[14.5px] text-[#0066dd] font-medium"
                >
                    Most Visited Url
                </h2>
                <span
                    v-if="urls.length"
                    class="font-semibold w-full overflow-hidden"
                >
                    {{ most_visited_url.longUrl }}
                </span>
            </div>
            <div
                class="flex flex-col gap-1 border-zinc-300 border-[1px] rounded px-2 py-1.5"
            >
                <h2
                    class="-translate-x-[1px] text-[14.5px] text-[#0066dd] font-medium"
                >
                    Least Visited Url
                </h2>
                <span v-if="urls.length" class="font-semibold overflow-hidden">
                    {{ least_visited_url.longUrl }}
                </span>
            </div>
            <div
                class="flex flex-col gap-1 border-zinc-300 border-[1px] rounded px-2 py-1.5"
            >
                <h2
                    class="-translate-x-[1px] text-[14.5px] text-[#0066dd] font-medium"
                >
                    Total Of Urls Visits
                </h2>
                <span class="font-semibold">{{ urls_visits_total }}</span>
            </div>
            <div
                class="flex flex-col gap-1 border-zinc-300 border-[1px] rounded px-2 py-1.5"
            >
                <h2
                    class="-translate-x-[1px] text-[14.5px] text-[#0066dd] font-medium"
                >
                    Total of generated Urls
                </h2>
                <span class="font-semibold">{{ urls.length }}</span>
            </div>
        </div>
    </section>
</template>

<script>
import { computed, onMounted, ref, toRaw } from "vue";
export default {
    setup() {
        const urls = ref([]);

        onMounted(() => {
            const fetchUrls = async () => {
                const response = await fetch(
                    "http://localhost:8000/api/url/shorten"
                );

                const json = await response.json();

                urls.value = json;
            };

            fetchUrls();
        });

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

        return { urls, urls_visits_total, most_visited_url, least_visited_url };
    },
};
</script>

<style></style>
