<template>
    <div class="max-w-4xl mx-auto px-10 mt-10 flex flex-col">
        <div
            class="flex w-full justify-between border-b-[1px] shadow-sm pb-3 border-zinc-200"
        >
            <h2 class="font-semibold text-[15px] w-1/2 text-center">
                Full Url
            </h2>
            <h2 class="font-semibold text-[15px] w-[25%] text-center">
                Short Url
            </h2>
            <h2 class="font-semibold text-[15px] w-[25%] text-center">
                Url Visits
            </h2>
        </div>

        <div v-if="latest_urls.length">
            <div v-for="url in latest_urls" :key="url.id">
                <div class="flex justify-between py-2 bg-blue-100/30">
                    <a
                        :href="url.longUrl"
                        target="_blank"
                        class="text-[#0000EE] text-[15px] cursor-pointer underline w-1/2 text-center overflow-hidden"
                        @click="incrementUrlVisits(url.id)"
                    >
                        {{ url.longUrl }}
                    </a>
                    <a
                        :href="url.longUrl"
                        target="_blank"
                        class="text-[#0000EE] text-[15px] cursor-pointer underline w-[25%] text-center"
                        @click="incrementUrlVisits(url.id)"
                    >
                        {{ url.shortUrl }}
                    </a>
                    <h2 class="text-[15px] w-[25%] text-center">
                        {{ url.visits_count }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["latest_urls"],
    setup() {
        const incrementUrlVisits = async (id) => {
            await fetch(`http://localhost:8000/api/url/shorten/${id}`, {
                method: "PUT",
            });
        };
        return { incrementUrlVisits };
    },
};
</script>

<style></style>
