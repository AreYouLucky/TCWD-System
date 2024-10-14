<template>
    <v-layout class="layout">
        <v-card width="100%" class="rounded-xl pt-2 elevation-2">
            <v-card-title class=" d-flex justify-space-between pa-2 flex-wrap"><span class="font-weight-black">
                    <v-icon class="mx-4">mdi-help-box-multiple</v-icon>Questions
                    Section</span>
                <div class="d-flex justify-end buttons-list">
                    <v-btn color="light-blue-darken-3" prepend-icon="mdi-plus" variant="elevated" rounded="xl"
                        size="small" @click="questionForm = true">
                        <h5>Add Question</h5>
                    </v-btn>
                </div>
            </v-card-title>
            <v-card-item>
                <v-row dense class="pt-2">
                    <v-col cols="12" md="2" sm="3">
                        <v-select variant="outlined" label="Difficulty" v-model="difficulty" rounded="xl" hide-details
                            placeholder="all" :items="difficulties" item-value="difficulty_id" item-title="name"
                            density="compact" @update:modelValue="fetchQuestionByDifficulty" />
                    </v-col>
                    <v-col cols="12" md="4" sm="3">
                        <v-text-field v-model="search" clearable density="compact" hide-details placeholder="Search"
                            prepend-inner-icon="mdi-magnify" rounded="xl" variant="outlined" class="ml-2" />
                    </v-col>
                    <v-col cols="12" md="6" sm="6" class="d-flex align-center justify-end">
                        <v-btn icon color="transparent" @click="fetchAllQuestions()" size="small">
                            <v-tooltip activator="parent" location="top"> Refresh </v-tooltip>
                            <v-icon>mdi-refresh</v-icon>
                        </v-btn>
                    </v-col>
                </v-row>
            </v-card-item>
            <v-card-item class="pa-5">
                <v-data-table :headers="headers" :items="processedQuestions" :search="search" :loading="loading" dense
                    class="bg-transparent border-thin rounded-lg">
                    <template v-slot:item.question="{ item }">
                        <div v-html="sanitizeHTML(item.question)"></div>
                    </template>
                    <template v-slot:item.status="{ item }">
                        <v-switch v-model="item.statusBoolean" color="blue" size="900" hide-details
                            @update:modelValue="updateStatus(item.question_id, item.statusBoolean ? 1 : 0)">
                        </v-switch>
                    </template>
                    <template v-slot:item.actions="{ item }">
                        <v-btn icon color="red" @click="deleteQuestion(item.question_id)" class="ma-1" size="x-small"
                            variant="text">
                            <v-tooltip activator="parent" location="top"> Delete Question </v-tooltip>
                            <v-icon>mdi-trash-can</v-icon>
                        </v-btn>
                        <v-btn icon color="success" @click="editQuestion(item.question_id)" class="ma-1" size="x-small"
                            variant="text">
                            <v-tooltip activator="parent" location="top"> Update Question </v-tooltip>
                            <v-icon>mdi-pen</v-icon>
                        </v-btn>
                    </template>
                </v-data-table>
            </v-card-item>
        </v-card>
        <v-dialog v-model="questionForm" max-width="900" persistent>
            <v-card prepend-icon="mdi-playlist-edit" title="Question Information" class="rounded-lg">
                <v-divider></v-divider>
                <v-card-item>
                    <v-row dense class="pa-2">
                        <v-col cols="12" md="6" sm="6">
                            <v-select v-model="fields.difficulty_id" variant="outlined" :items="difficulties"
                                item-value="difficulty_id" item-title="name" density="comfortable" label="Difficulty"
                                rounded="xl" :rules="[rules.required]"
                                :error-messages="err.difficulty_id ? err.difficulty_id[0] : ''"></v-select>
                        </v-col>
                        <v-col cols="6" md="6">
                            <v-file-input label="Image" variant="outlined" v-model="fields.img"
                                prepend-icon="mdi-camera" accept="image/*" @change="onChange" rounded="xl"
                                density="comfortable" :error-messages="err.img ? err.img[0] : ''"></v-file-input>
                        </v-col>
                        <v-col cols="12" md="6" sm="6">
                            <v-select v-model="fields.category" variant="outlined" :items="categories"
                                density="comfortable" label="Category" rounded="xl" :rules="[rules.required]"
                                :error-messages="err.category ? err.category[0] : ''"></v-select>
                        </v-col>
                        <v-col cols="12" md="6" sm="6">
                            <v-select v-model="fields.year_lvl" variant="outlined" :items="year_lvl"
                                density="comfortable" label="Category" rounded="xl" :rules="[rules.required]"
                                :error-messages="err.year_lvl ? err.year_lvl[0] : ''"></v-select>
                        </v-col>
                        <v-col cols="12" md="12" sm="12" class="mb-5">
                            <ckeditor :editor="editor" :config="editorConfig" v-model="fields.question"
                                :error-messages="err.question ? err.question[0] : ''"
                                class="bg-transparent text-black rounded-xl"></ckeditor>
                        </v-col>
                        <template v-for="(choice, ix) in choices" :key="ix">
                            <v-col cols="12" md="5" sm="10">
                                <v-text-field label="Choice" variant="outlined" v-model="choice.choice"
                                    :rules="[rules.required]" density="comfortable" rounded="xl"></v-text-field>
                            </v-col>
                            <v-col cols="12" md="1" sm="2">
                                <v-btn icon="mdi-delete" color="red-lighten-2" variant="text"
                                    @click="removeChoice(ix)" />
                            </v-col>
                        </template>
                        <v-col cols="12" md="5" sm="5">
                            <v-btn variant="elevated" @click="addChoice()" color="blue" size="small" class="mb-4">
                                <v-icon>
                                    mdi-plus </v-icon></v-btn>
                        </v-col>
                    </v-row>
                    <v-row dense>
                        <v-col cols="12" md="5" sm="10">
                            <v-select v-model="fields.correct_ans" variant="outlined" :items="choices"
                                item-value="choice" item-title="choice" density="comfortable" label="Correct Answer"
                                rounded="xl" :rules="[rules.required]"
                                :error-messages="err.correct_ans ? err.correct_ans[0] : ''"></v-select>
                        </v-col>
                    </v-row>
                    <v-row dense>
                        <v-col cols="12" md="12" sm="12" class="d-flex justify-center mb-2" v-if="questionImagePath">
                            <v-img max-width="400" aspect-ratio="16/9" contain :src="questionImagePath"></v-img>
                        </v-col>
                    </v-row>
                </v-card-item>
                <v-divider></v-divider>
                <v-card-actions class="d-flex justify-center pa-5">
                    <v-btn text="Close" variant="elevated" @click="closeForm()" color="red" class="px-5"
                        rounded="xl"></v-btn>
                    <v-btn color="success" text="Save" variant="elevated" @click="saveQuestion" class="px-5"
                        v-if="id == 0" rounded="xl"></v-btn>
                    <v-btn color="orange" text="Update" variant="elevated" @click="updateQuestion" class="px-5"
                        rounded="xl" v-if="id > 0"></v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
</template>
<script>

import axios from "axios";
import Swal from "sweetalert2";
import { ClassicEditor, Font, BlockQuote, Heading, Essentials, Bold, Code, Italic, Strikethrough, Subscript, Superscript, Underline, Paragraph, HorizontalLine, Undo, SpecialCharacters, SpecialCharactersEssentials, Indent, IndentBlock, List, Alignment } from 'ckeditor5';
import CKEditor from '@ckeditor/ckeditor5-vue';
import 'ckeditor5/ckeditor5.css';
import MathType from '@wiris/mathtype-ckeditor5/dist/index.js';
import DOMPurify from 'dompurify';

export default {
    components: {
        ckeditor: CKEditor.component
    },
    data() {
        return {
            editor: ClassicEditor,
            editorData: '<p>Hello from CKEditor 5 in Vue!</p>',
            editorConfig: {
                plugins: [Heading, Font, Essentials, Bold, Code, Italic, Strikethrough, Subscript, Superscript, Underline, BlockQuote, Paragraph, Undo, SpecialCharacters, SpecialCharactersEssentials, List, Indent, IndentBlock, HorizontalLine, Alignment,MathType],
                toolbar: ['Heading', '|',
                    {
                        label: 'Fonts',
                        withText: true,
                        items: ['fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor']
                    },
                    {
                        label: 'Basic Styles',
                        withText: true,
                        items: ['bold', 'italic', 'underline', 'strikethrough', 'code', 'subscript', 'superscript']
                    },
                    'SpecialCharacters', 'horizontalLine', 'blockQuote', '|', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'alignment','|', 'MathType', 'ChemType', '|', 'undo', 'redo'],
                placeholder: 'Insert Question here...',
                language: 'en',
            },
            rules: {
                required: (value) => !!value || "Required.",
                min: (v) => v.length >= 4 || "Minimum 4 characters",
            },
            search: "",
            loading: false,
            headers: [
                {
                    title: "Question",
                    align: "start",
                    key: "question",
                },
                {
                    title: "Year Level",
                    align: "start",
                    key: "year_lvl",
                },
                {
                    title: "Category",
                    align: "start",
                    key: "category",
                },
                {
                    title: "Correct Answer",
                    align: "start",
                    key: "correct_ans",
                },
                {
                    title: "Difficulty",
                    align: "center",
                    key: "name",
                },
                {
                    title: "Status",
                    align: "center",
                    key: "status",
                },
                {
                    title: "Actions",
                    align: "center",
                    key: "actions",
                },
            ],
            questions: [],
            difficulties: [],
            fields: {
                question: '',
                correct_ans: '',
                difficulty_id: 1,
                year_lvl: 'Junior (Grade 7-10)',
                category: 'General Mathematics',
                img: null
            },
            choices: [
                {
                    choice: '',
                },
                {
                    choice: '',
                },
                {
                    choice: '',
                },
                {
                    choice: '',
                }
            ],
            questionForm: false,
            id: 0,
            questionImagePath: '',
            questionImage: null,
            err: [],
            difficulty: '',
            year_lvl: [
                'Senior (Grade 11-12)', 'Beginner (Grade 1-3)', 'Intermediate (Grade 4-6)', 'Junior (Grade 7-10)'
            ],
            categories: [
                'General Mathematics', 'Mathematics', 'Statistics and Probability', 'Disaster Readiness and Risk Reduction', 'Earth and Life Science', 'Earth Science',
                'Physical Science', 'Science'
            ]

        };
    },
    methods: {
        sanitizeHTML(html) {
            return DOMPurify.sanitize(html);
        },
        fetchAllQuestions() {
            this.loading = true;
            axios.get('/questions').then(
                res => {
                    this.questions = res.data;
                    this.loading = false;
                }
            )
        },
        fetchQuestionByDifficulty() {
            this.loading = true;
            axios.get('/difficulty-question/' + this.difficulty).then(
                res => {
                    this.questions = res.data
                    this.loading = false
                }
            )
        },
        updateStatus(id, status) {
            console.log(status)
            axios.post('/update-status/' + id + '/' + status).then(
                res => {
                    // Swal.fire(
                    //     {
                    //         icon: "success",
                    //         title: "Status Successfully Updated!",
                    //         color: "#ffffff",
                    //         background: "#000000",
                    //         confirmButtonColor: "#2e58ff"
                    //     }
                    // );
                }
            )
        },
        addChoice() {
            this.choices.push({
                choice: '',
            });
        },
        removeChoice(index) {
            this.choices.splice(index, 1);
        },
        closeForm() {
            this.fields = {
                question: '',
                correct_ans: '',
                difficulty_id: 1,
                year_lvl: 'Junior (Grade 7-10)',
                category: 'General Mathematics',
                img: null
            };
            this.choices = [{
                choice: '',
            },
            {
                choice: '',
            },
            {
                choice: '',
            },
            {
                choice: '',
            }];
            this.questionForm = false;
            this.questionImagePath = ''
            this.questionImage = null
            this.err = [];
            this.id = 0;
        },
        onChange(e) {
            this.questionImage = e.target.files[0];
            this.fields.img = [this.questionImage];
            this.previewImage();
        },
        previewImage() {
            const file = this.questionImage;
            if (!file) return;

            if (!file.type.match("image.*")) {
                alert("Please select an image file");
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                this.questionImagePath = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        saveQuestion() {
            let formData = new FormData();
            if (this.questionImage) {
                formData.append("img_dir", this.questionImage);
            }
            formData.append("question", this.fields.question ?? '');
            formData.append("correct_ans", this.fields.correct_ans ?? '');
            formData.append("difficulty_id", this.fields.difficulty_id ?? '');
            formData.append("year_lvl", this.fields.year_lvl ?? '');
            formData.append("category", this.fields.category ?? '');

            axios.post('/add-question', formData, { params: this.choices }).then(
                res => {
                    this.closeForm()
                    this.fetchAllQuestions()
                    Swal.fire(
                        {
                            icon: "success",
                            title: "Question Successfully Saved!",
                            color: "#ffffff",
                            background: "#000000",
                            confirmButtonColor: "#2e58ff"
                        }
                    );
                }
            ).catch(
                err => {
                    this.err = err.response.data.errors
                })
        },
        editQuestion(id) {
            this.id = id
            axios.get('/get-question/' + this.id).then(
                res => {
                    this.fields = res.data.question;
                    if(res.data.question.img_dir){
                        this.questionImagePath = `/storage/questions/${res.data.question.img_dir}`
                    }
                    this.choices = res.data.choices;
                    this.questionForm = true
                    this.questionImage = null
                }
            )
        },
        updateQuestion() {
            let formData = new FormData();
            if (this.questionImage) {
                formData.append("img_dir", this.questionImage);
            }
            formData.append("question", this.fields.question);
            formData.append("correct_ans", this.fields.correct_ans);
            formData.append("difficulty_id", this.fields.difficulty_id);
            formData.append("year_lvl", this.fields.year_lvl ?? '');
            formData.append("category", this.fields.category ?? '');

            axios.post('/update-question/' + this.id, formData, { params: this.choices }).then(
                res => {
                    this.closeForm()
                    // this.fetchAllQuestions()
                    // Swal.fire(
                    //     {
                    //         icon: "success",
                    //         title: "Question Successfully updated!",
                    //         color: "#ffffff",
                    //         background: "#000000",
                    //         confirmButtonColor: "#2e58ff"
                    //     }
                    // );
                }
            )
        },
        fetchAllDifficulties() {
            axios.get('/difficulties').then(
                res => {
                    this.difficulties = res.data
                }
            )
        },
        deleteQuestion(id) {
            this.id = id
            Swal.fire({
                title: "Are you sure you want to delete this question?",
                icon: "warning",
                background: "#000000",
                confirmButtonColor: "#2e58ff",
                showCancelButton: true,
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
                color: "#ffffff",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete("/delete-question/" + this.id).then((res) => {
                        this.response = res.data.status;
                        Swal.fire({
                            title: "Deleted!",
                            text: 'Question Successfully Deleted!',
                            icon: "success",
                            color: "#ffffff",
                            background: "#000000",
                            confirmButtonColor: "#2e58ff"
                        });
                        this.fetchAllQuestions();
                        this.closeForm()
                    });
                }
                else {
                    this.closeForm()
                }
            });
        },
        initData() {
            this.fetchAllDifficulties();
            this.fetchAllQuestions()
        },
    },
    computed: {
        processedQuestions() {
            return this.questions.map(question => ({
                ...question,
                statusBoolean: question.status === 0 ? false : true
            }));
        }
    },
    mounted() {
        this.initData();
    },
};
</script>
<style scoped>
.layout {
    padding: 0px 10px 20px 10px;
}

.gradient-card {
    background: linear-gradient(to bottom, #000000, #00203c) !important;
}

@media (max-width: 500px) {
    .layout {
        padding: 0px;
    }

    .buttons-list {
        width: 100%;
    }
}
</style>