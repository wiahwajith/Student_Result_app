<template>
        <app-header></app-header>

        <div class="row">
            <div class="col-md-12" style="margin-top: 20px">
                <h2 class="text-left">Students Result</h2>

                <errors-and-messages :errors="errors"></errors-and-messages>
                    <p>{{ $page.props.student[0].result.exam_date}}</p>

              
                    <div class="col-md-10 article border" v-for="student in $page.props.student" :key="student.id">
                        
                        <article>
                            <h5>Student Name :  {{ student.first_name }} {{ student.last_name }}</h5>
                            <h5>Student Emails :  {{ student.email }}</h5>
                            <h5>gender :  {{ student.gender }}</h5>
                            <h5>date of birth :  {{ student.dob }}</h5>
                            <h5>address :  {{ student.address }}</h5>
                        </article>
                        <div v-if="student.result.length > 0">
                            <div>

                                <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Exam</th>
                                    <th scope="col">marks</th>
                                    <th scope="col">GPA</th>
                                    <th scope="col">exam_date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for=" result in student.result" :key="result.id">
                                    <th scope="row">{{ count++ }}</th>
                                    <td>{{ result.subject[0].subject_name  }}</td>
                                    <td>{{ result.exam[0].exam_name  }}</td>
                                    <td>{{ result.marks  }}</td>
                                    <td>{{ result.gpa  }}</td>
                                    <td>{{ result.exam_date  }}</td>
                
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                    </div>
                <div class="text-center" v-else>
                   <div class="alert alert-warning" role="alert">
                    No result yet!
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

        var  count = 1;
        return {
            student,
            count,
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