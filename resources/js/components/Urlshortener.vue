<template>
    <form class="max-w-4xl mx-auto px-10 mt-10" @submit.prevent="handleSubmit">
        <label class="flex flex-col gap-5">
            <span class="-translate-x-[1px] text-[16px] font-medium opacity-70"
                >Generate your short url here :
            </span>
            <input
                type="text"
                placeholder="Enter your full URL here ..."
                required
                v-model="url"
                class="rounded border-[1px] border-zinc-200 px-2 py-2 shadow-sm outline-[#0066dd] focus:bg-[#f8fafd] focus:drop-shadow-xl"
            />
            <button
                class="rounded bg-[#0066dd] py-[8px] font-medium text-white transition-opacity duration-300 ease-in-out hover:opacity-90"
            >
                Generate URL
            </button>
        </label>
    </form>
</template>

<script>
import { ref } from "vue";
export default {
    setup() {
        const url = ref("");

        const handleSubmit = async () => {
            if (url.value) {
                const response = await fetch(
                    "http://localhost:8000/api/url/shorten",
                    {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: url.value,
                    }
                );
            }
        };

        return { url, handleSubmit };
    },
};
</script>
