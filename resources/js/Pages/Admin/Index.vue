<template>
        <app-header></app-header>

        <div class="row">
            <div class="col-md-12" style="margin-top: 20px">
                <h2 class="text-left">All Students</h2>

                <errors-and-messages :errors="errors"></errors-and-messages>

                <div v-if="student.data.length > 0">
                    <div class="card">
                    <h5 class="card-header">All Students details</h5>
                        <div class="card-body">
                            <div class="col-md-10 article border" v-for="student in student.data" :key="student.id">
                                <h4>{{student.first_name}}</h4>
                                <img v-if="student.image_url" width="300" height="250" :src="student.image_url" class="pull-left img-responsive thumb margin10 img-thumbnail">
                                <article>
                                    <p>
                                        {{ student.last_name }}
                                    </p>
                                </article>
                                <inertia-link :href="$route('administrator.edit', {id: student.id})" class="btn btn-primary pull-right action-btn">Edit Student details</inertia-link>
                                <inertia-link :href="$route('result.create', {id: student.id})" class="btn btn-info pull-right action-btn">Add Result</inertia-link>
                                <inertia-link :href="$route('student.edit', {id: student.id})" class="btn btn-secondary pull-right action-btn">Edit Result</inertia-link>
                                <inertia-link :href="$route('result.index', {id: student.id})" class="btn btn-dark pull-right action-btn">View Result</inertia-link>
                                <a href="javascript:void(0);" class="btn btn-warning pull-right action-btn" @click.prevent="deletePost(student.id)"><i class="fas fa-trash-alt"></i> Delete Student</a>
                            </div>
                        </div>
                    </div>


                    <!-- Pagination links-->
                    <nav aria-label="Page navigation" v-if="student.total > student.per_page" style="margin-top: 20px">
                        <ul class="pagination">
                            <!-- Previous link -->
                            <li :class="'page-item' + (student.links[0].url == null ? ' disabled' : '')">
                                <inertia-link :href="student.links[0].url == null ? '#' : student.links[0].url" class="page-link" v-html="student.links[0].label"></inertia-link>
                            </li>

                            <!-- Numbers -->
                            <li v-for="item in numberLinks"  :class="'page-item' + (item.active ? ' disabled' : '')">
                                <inertia-link :href="item.active ? '#' : item.url" class="page-link" v-html="item.label"></inertia-link>
                            </li>

                            <!-- Next link -->
                            <li :class="'page-item' + (student.links[Students.links.length - 1].url == null ? ' disabled' : '')">
                                <inertia-link :href="student.links[Students.links.length - 1].url == null ? '#' : student.links[student.links.length - 1].url" class="page-link" v-html="student.links[student.links.length - 1].label"></inertia-link>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="text-center" v-else>
                    No posts found! <inertia-link :href="$route('student.create')">Create Post</inertia-link>
                </div>
            </div>
        </div>

</template>

<script>
import AppHeader from "../../Partials/AdminAppHeader";
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
            Inertia.delete(route('administrator.destroy', {id}));
        }

        const student = computed(() => usePage().props.value.student);

        const numberLinks = student.value.links.filter((v, i) => i > 0 && i < student.value.links.length - 1);

        return {
            student,
            deletePost,
            numberLinks
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