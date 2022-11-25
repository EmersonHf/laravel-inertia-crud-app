<template>

    <Head title="Dashboard" />
    <!-- <BreezeInput id="cpf" type="text" class="mt-1 block w-full" v-model="form.cpf" autofocus /> -->
    <div className="mb-4">
        <BreezeLabel for="cpf" value="CPF" />

        <BreezeInput id="cpf" @change="substituiCPFS" type="cpf" class="mt-1 block w-full cpf" autofocus />
        <span className="text-red-600" v-if="form.errors.cpf">
            {{ form.errors.cpf }}
        </span>
    </div>

</template>

<script setup>


import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import BreezeLabel from '@/Components/Label.vue';
import BreezeInput from '@/Components/Input.vue';


const props = defineProps({
    user: Object,
});
const cpfsList = document.querySelectorAll(user);

function elementsInnerText([...elements]) {
    return elements.map(element => element.innetText)
}

const limparCPF = (cpf) => {
    return cpf.replace(/\D/g, '');

}

const construirCPF = (cpf) => {
    return cpf.replace(/(d{3})(\d{3})(\d{3})(\d{2})/g, '$1.$2.$3-$4');

}

const formatarCPFS = (cpfs) => {
    return cpfs.map(limparCPF).map(construirCPF);
}

const substituiCPFS = (cpfsElements) => {
    const cpfs = elementsInnerText(cpfsElements);
    const cpfsFormatados = formatarCPFS(cpfs);
    cpfsElements.forEach((element, index) => {
        element.innerText = cpfsFormatados[index];
    });
}

substituiCPFS(cpfsList);



</script>

