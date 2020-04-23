<template>
    <div>
        <!-- Button trigger modal -->
        <button
            type="button"
            class="btn btn-primary btn-sm btn-flat"
            data-toggle="modal"
            :data-target="'#model' + row.id"
        >
            <i class="fas fa-eye"></i>
        </button>
        <div
            class="modal fade"
            :id="'model' + row.id"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modelTitleId"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        {{ row.description }}
                    </div>
                </div>
            </div>
        </div>
        hola
    </div>
</template>
<script>
export default {
    props: {
        row: {
            type: Object,
            required: true
        }
    }
};
</script>
