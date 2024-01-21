<template>
    <form class="max-w-4xl mx-auto px-10 mt-10" @submit.prevent="handleSubmit">
        <label class="flex flex-col gap-5">
            <span class="-translate-x-[1px] text-[17px] font-medium opacity-70"
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
                class="rounded bg-[#0066dd] py-[8px] font-medium text-white transition-opacity duration-300 ease-in-out hover:opacity-90 self-center px-8"
            >
                <span v-if="isLoading"> Generating url ... </span>
                <span v-if="!isLoading">Generate URL</span>
            </button>

            <div
                v-if="error"
                class="text-red-500 text-[15px] font-semibold -translate-y-3"
            >
                {{ error }}
            </div>
        </label>
    </form>
</template>

<script>
import { ref } from "vue";
export default {
    props: ["addUrlToState"],
    setup(props) {
        const url = ref("");
        const isLoading = ref(false);
        const error = ref(null);

        const url_regex_validation =
            /(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/;

        const handleSubmit = async () => {
            isLoading.value = true;
            error.value = null;

            if (!url.value.match(url_regex_validation)) {
                isLoading.value = false;
                error.value =
                    "The value you inserted is not a valid URL, please insert a valid URL";
            }

            if (url.value.match(url_regex_validation)) {
                const response = await fetch(
                    "http://localhost:8000/api/url/shorten",
                    {
                        method: "POST",
                        body: url.value,
                    }
                );

                const json = await response.json();

                if (json.error) {
                    isLoading.value = false;
                    error.value = json.error;
                    return;
                }

                if (response.ok) {
                    isLoading.value = false;
                    error.value = false;

                    props.addUrlToState({ ...json, visits_count: 0 });
                }

                if (!response.ok) {
                    isLoading.value = false;
                    error.value = true;
                }
            }
        };

        return { url, isLoading, error, handleSubmit };
    },
};
</script>
