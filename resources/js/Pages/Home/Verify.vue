<template>
        <app-header></app-header>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                                <errors-and-messages :errors="errors"></errors-and-messages>
    
                                <div class="alert alert-warning mt-5" role="alert">
                                  Please Verify Your e-mail!
                                </div>
                               

            </div>
        </div>

</template>

<script>
    import AppHeader from "../../Partials/AppHeader";
    import ErrorsAndMessages from "../../Partials/ErrorsAndMessages";

    import {Inertia} from "@inertiajs/inertia";
    import { usePage } from '@inertiajs/inertia-vue3'
    import {reactive,inject} from 'vue';

    export default {
        components: {
            ErrorsAndMessages,
            AppHeader
        },
        name: "Login",
        props: {
            errors: Object
        },
        setup() {
            const form = reactive({
               email: null,
               password: null,
               _token: usePage().props.value.csrf_token
            });

            const route = inject('$route');

            function submit() {
                Inertia.post(route('login'), form);
            }

            return {
                form, submit
            }
        }
    }
</script>

<style scoped>
    form {
        margin-top: 20px;
    }
</style>