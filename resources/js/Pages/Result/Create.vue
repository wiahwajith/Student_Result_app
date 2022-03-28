<template>
    <app-header></app-header>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form method="post" @submit.prevent="submit">
                <h5 class="text-left">Add Result to : <b> {{$page.props.student.first_name }} {{$page.props.student.last_name}}</b></h5>



                    <errors-and-messages :errors="errors"></errors-and-messages>

                    <div class="form-group">
                        <label for="name"> Exam </label>
                        <section>
                            <select @change="isDisabled" class="form-control" v-model="form.exam_id" >
                            <option>Please select a Exam </option>
                            <option v-for="exam in $page.props.exams" v-bind:key="exam.id"  v-bind:value="exam.id">{{ exam.exam_name }}</option>
                            </select>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Add Exam
                        </button>
                        </section>
                    </div>
                    <div class="form-group">
                        <label for="name">Subject</label>
                        <section>
                            <select @change="isDisabled" class="form-control" v-model="form.subject_id" >
                            <option>Please select a Subject </option>
                            <option v-for="subject in  $page.props.subjects" v-bind:key="subject.id" v-bind:value="subject.id"> {{ subject.subject_name }}</option>
                            </select>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#SubjectModal">
                        Add subject
                        </button>
                        </section>
                    </div>

                    <div class="form-group">
                        <label for="email">Marks</label>
                        <input type="text" class="form-control" name="Marks" id="Marks" v-model="form.marks" />
                    </div>

                    <div class="form-group">
                        <label for="email">GPA</label>
                        <input type="text" class="form-control" name="GPA" id="GPA" v-model="form.gpa" />
                    </div>
                    <div class="form-group">
                        <label for="email">Attempt</label>
                        <input type="text" class="form-control" name="email" id="email" v-model="form.attempt" />
                    </div>
                    <div class="form-group">
                        <label for="name">Exam Date</label>
                        <input type="text" class="form-control" name="name" id="name" v-model="form.exam_date" />
                    </div>
  
                    

                    <input type="submit" class="btn btn-primary btn-block" value="ADD" />
            </form>
            
        </div>
    </div>
        <!-- Modal exam -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Exam</h5>
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form method="post" @submit.prevent="modelSubmit">  
                    <div class="form-group">
                        <label for="email">Exam Code</label>
                        <input type="text" class="form-control" name="exam_code" id="exam_code" v-model="modelForm.exam_code" />
                    </div>
                    <div class="form-group">
                        <label for="email">exam_name</label>
                        <input type="text" class="form-control" name="exam_name" id="exam_name" v-model="modelForm.exam_name" />
                    </div>
                    <div class="form-group">
                        <label for="email">exam_status</label>
                        <input type="text" class="form-control" name="exam_status" id="exam_status" v-model="modelForm.exam_status" />

                    </div>
        <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        <!-- Modal subject -->
<div class="modal fade" id="SubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
     
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form method="post" @submit.prevent="modelSubjectSubmit">  
                    <div class="form-group">
                        <label for="email">Subject Code</label>
                        <input type="text" class="form-control" name="Subject_code" id="Subject_code" v-model="modelFormSubject.subject_code" />
                    </div>
                    <div class="form-group">
                        <label for="email">Subject name</label>
                        <input type="text" class="form-control" name="Subject_name" id="Subject_name" v-model="modelFormSubject.subject_name" />
                    </div>
                    <div class="form-group">
                        <label for="email">Subject status</label>
                        <input type="text" class="form-control" name="Subject_status" id="Subject_status" v-model="modelFormSubject.subject_status" />
                    </div>
        <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import AppHeader from "../../Partials/AppHeader";
import ErrorsAndMessages from "../../Partials/ErrorsAndMessages";
import {inject, reactive,computed} from "vue";
import {Inertia} from "@inertiajs/inertia";
import {usePage} from "@inertiajs/inertia-vue3";


export default {
    name: "Create",
    components: {
        ErrorsAndMessages,
        AppHeader
    },
    props: {
        errors: Object,
    },
    setup() {
        const studentID = computed(() => usePage().props.value.student.id);
        const form = reactive({
            exam_id: null,
            subject_id: null,
            marks: null,
            gpa: null,
            attempt: null,
            exam_date: null,
            student_id : studentID,
            _token: usePage().props.value.csrf_token
        });
        const modelForm = reactive({
            exam_code: null,
            exam_name: null,
            exam_status: null,
            _token: usePage().props.value.csrf_token
        });
        const modelFormSubject = reactive({
            subject_code: null,
            subject_name: null,
            subject_status: null,
            _token: usePage().props.value.csrf_token
        });

        const route = inject('$route');

        function submit() {
            Inertia.post(route('result.store'), form, {
                forceFormData: true
            });
        }
        function modelSubmit() {
            Inertia.post(route('exam.store'), modelForm, {
                forceFormData: true
            });
            $('#exampleModal').modal('hide');
        }
        function modelSubjectSubmit() {
            Inertia.post(route('subject.store'), modelFormSubject, {
                forceFormData: true
            });
             $('#SubjectModal').modal('hide');
        }
        

        return {
            form, modelForm, modelFormSubject, submit, modelSubmit, modelSubjectSubmit
        }
    }
}
</script>

<style scoped>
    form {
        margin-top: 20px;
    }
</style>