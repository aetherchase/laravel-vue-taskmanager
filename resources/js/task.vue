<template>
    <div class="card border-light col-sm-3 px-0">
        <div class="d-flex card-header text-white" :class="bool_is_complete ? ['completed', 'bg-light'] : 'bg-primary'">
            <img class="switch-btn" alt="Отметить как выполненное" @click="status_switch">
            <a class="card-delete ml-auto col-2" @click="destroy"  @click.prevent="" href="/">x</a>
        </div>
        <div class="card-body">
            <p class="card-text" contenteditable v-text="local_content" @blur="edit" @keydown.enter="confirm_edit"></p>
        </div>
    </div>
</template>

<style>
    .switch-btn{
        content: url("../img/checked.png");
    }
    .switch-btn:hover{
        filter: drop-shadow(0px 0px 22px  white);
    }

    .completed .switch-btn{
        content: url("../img/unchecked.png");
    }
    .completed .switch-btn:hover{
        filter: drop-shadow(0px 0px 6px rgba(18,96,255,0.33));
    }

    .card{
        margin-bottom: 40px!important;
        box-shadow: 6px 5px 10px 3px rgba(76, 76, 76, 0.11);
    }

    .card-delete:hover{
        text-decoration: none;
    }

    .completed .card-delete{
        color: dodgerblue;
    }

    [contenteditable]:focus {
        background-color: transparent;
        border: none;
        outline: 0 solid transparent;
    }

    [contenteditable]:focus::selection {
        background: rgba(255,221,39,0.38); /* WebKit/Blink Browsers */
    }

    .card-header>a{
        color: white;
        font-size: 1.4em;
        padding-top: 0;
        margin-right: -0.8em;
    }
    .card-header>p{
        padding-left: 0;
        font-size: 1.4em;
        padding-top: 0.1em;
    }
    .card-header>img {
        height: 1.5em;
        width: 1.5em;
        margin-top: 0.4em;
    }



    .card-header{
        padding-bottom: 3px!important;
        padding-top: 4px;
        width: 100%!important;
        height: 2.7em;
    }
</style>

<script>
    import axios from 'axios'
    export default {
        props: {
            id: Number,
            content: String,
            is_complete: Number,
        },
        data(){
            return{
                local_content: this.content,
                local_is_complete: this.is_complete
            }
        },
        computed:{
           bool_is_complete(){
               let bool_is_complete;
               this.local_is_complete === 1 ? bool_is_complete = true : bool_is_complete = false;
               return bool_is_complete;
           }
        },

        mounted(){
            this.local_is_complete === 1 ? this.className = "complete" : "incomplete";
        },
        methods: {
            edit(evt){
                console.log('editing confirmed');
                let src = evt.target.innerText;
                this.local_content = src;
                console.log(src);
                this.save_to_db();
            },
            confirm_edit(evt){
                console.log('enter key editing confirmed...');
                evt.target.blur();
                this.save_to_db();
                //this.$refs.task.blur();
            },
            status_switch(){
                console.log(this.local_is_complete);
                this.local_is_complete === 1 ? this.local_is_complete = 0 : this.local_is_complete = 1;
                console.log(this.local_is_complete);
                this.save_to_db();
            },
            save_to_db(){
                console.log('saving to database...');
                axios.put('/api/task/'.concat(this.id),
                    {
                        content: this.local_content,
                        is_complete: this.local_is_complete
                    }).then(this.$parent.fetch_tasks());
            },
            destroy(){
                axios.delete('/api/task/'.concat(this.id));
                this.$parent.fetch_tasks();
            }
        }
    }
</script>