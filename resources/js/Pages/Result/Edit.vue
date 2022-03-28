<template>
    <app-header></app-header>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form method="post" @submit.prevent="submit">
                <h2 class="text-left">Student Form</h2>

              

                    <h2 class="text-center">Add New Student</h2>

                    <errors-and-messages :errors="errors"></errors-and-messages>

                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input type="text" class="form-control" name="name" id="name" v-model="form.name" />
                    </div>
                    <div class="form-group">
                        <label for="name">Last Name</label>
                        <input type="text" class="form-control" name="name" id="name" v-model="form.lastname" />
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" v-model="form.email" />
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" v-model="form.password" />
                    </div>
                    <div class="form-group">
                        <label for="name">Gender</label>
                        <input type="text" class="form-control" name="name" id="name" v-model="form.gender" />
                    </div>
                    <div class="form-group">
                        <label for="name">Date of Birth</label>
                        <input type="text" class="form-control" name="name" id="name" v-model="form.dob" />
                    </div>
                    <div class="form-group">
                        <label for="name">Address</label>
                        <input type="text" class="form-control" name="name" id="name" v-model="form.address" />
                    </div>
                    

                    <input type="submit" class="btn btn-primary btn-block" value="Update" />
            </form>
        </div>
    </div>
</template>

<script>
import AppHeader from "../../Partials/AppHeader";
import {inject, reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";
import ErrorsAndMessages from "../../Partials/ErrorsAndMessages";
import {usePage} from "@inertiajs/inertia-vue3";

export default {
    name: "Edit",
    components: {
        ErrorsAndMessages,
        AppHeader
    },
    props: {
        errors: Object
    },
    setup() {
        const form = reactive({
            name: null,
            lastname: null,
            email: null,
            password: null,
            gender: null,
            dob: null,
            address: null,
            _token: usePage().props.value.csrf_token,
            _method: "PUT"
        });

        // retrieve post prop
        const {first_name, last_name, email, password, gender, dob, address ,id} = usePage().props.value.student;
        form.name = first_name;
        form.lastname = last_name;
        form.email = email;
        form.password = password;
        form.gender = gender;
        form.dob = dob;
        form.address = address;
        form.id = id;

        const route = inject('$route');

        function submit() {
            Inertia.post(route('student.update', {'id': id}), form, {
                forceFormData: true
            });
        }

        return {
            form, submit,  
        }
    }
}
</script>

<style scoped>
    form {
        margin-top: 20px;
    }
</style>