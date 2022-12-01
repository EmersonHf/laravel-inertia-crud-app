<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import BreezeLabel from '@/Components/Label.vue';
import BreezeInput from '@/Components/Input.vue';




const props = defineProps({
    user: Object,

});

const form = useForm({
    name: props.user.name,
    email: props.user.email,

    password: props.user.password,

    // tel: "",
    // cidade: "",
    // estado: "",
});
const submit = () => {
    form.put(route("users.update", props.user.id));
};

</script>
<template>

    <Head title="Dashboard" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ⚙ Editar Usuario
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div className="flex items-center justify-between mb-6">
                            <Link className="px-6 py-2 text-white bg-blue-500 rounded-md focus:outline-none"
                                :href="route('users.index')">
                            Back
                            </Link>
                        </div>
                        <form name="createForm" @submit.prevent="submit">
                            <div className="flex flex-col">
                                <div className="mb-4">
                                    <BreezeLabel for="name" value="Nome" />

                                    <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                                        autofocus />
                                    <span className="text-red-600" v-if="form.errors.name">
                                        {{ form.errors.name }}
                                    </span>
                                </div>

                                <div className="mb-4">
                                    <BreezeLabel for="email" value="Email" />

                                    <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email"
                                        autofocus />
                                    <span className="text-red-600" v-if="form.errors.email">
                                        {{ form.errors.email }}
                                    </span>
                                </div>
                                <div className="mb-4">
                                    <BreezeLabel for="password" value="Senha" />

                                    <BreezeInput id="password" type="password" class="mt-1 block w-full"
                                        v-model="form.password" autofocus />
                                    <span className="text-red-600" v-if="form.errors.password">
                                        {{ form.errors.password }}
                                    </span>
                                </div>

                            </div>

                            <div className="mt-4">
                                <button type="submit" :href="route('users.index')" className=" px-6 py-2 font-bold text-white
                  bg-green-500 rounded">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>