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
export default {
    props: [
        "urls",
        "urls_visits_total",
        "most_visited_url",
        "least_visited_url",
    ],
};
</script>

<style></style>
