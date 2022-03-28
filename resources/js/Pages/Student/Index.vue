<template>
        <app-header></app-header>

        <div class="row">
            <div class="col-md-12" style="margin-top: 20px">
                <h2 class="text-left">Welcome Online Result System</h2>

                <errors-and-messages :errors="errors"></errors-and-messages>

                <div >
                    <div class="card">
                        <h5 class="card-header">Featured</h5>
                        <div class="card-body">
                            <div class="col-md-10 article" >
                                <article>
                                <h4>{{student.first_name}} {{ student.last_name }}</h4><br><br>
                                </article>
                                <inertia-link :href="$route('student.edit', {id: student.id})" class="btn btn-primary pull-right action-btn">Edit Student details</inertia-link>
                                <inertia-link :href="$route('result.index', {id: student.id})" class="btn btn-dark pull-right action-btn">View Result</inertia-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</template>

<script>
import AppHeader from "../../Partials/AppHeader";
import ErrorsAndMessages from "../../Partials/ErrorsAndMessages";
import {usePage} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import {computed, inject} from "vue";

export default {
    name: "Students",
    components: {
        ErrorsAndMessages,
        AppHeader
    },
    props: {
        errors: Object
    },
    setup() {
        const route = inject('$route');

        const deletePost = (id) => {
            if (!confirm('Are you sure?')) return;
            Inertia.delete(route('student.destroy', {id}));
        }

        const student = computed(() => usePage().props.value.student);

      

        return {
            student,
            deletePost,
        }
    }
}
</script>

<style scoped>
    .action-btn {
        margin-left: 12px;
        font-size: 13px;
    }

    .article {
        margin-top: 20px;
    }

</style>