<template>
    <div>
        <button
            type="button"
            class="btn btn-primary btn-sm btn-flat"
            data-toggle="modal"
            data-target="#model"
            @click="$emit('clear', clear)"
        >
            {{ title }}
        </button>
    </div>
</template>
<script>
export default {
    props: ["title"]
};
</script>
