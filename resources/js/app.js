require('./bootstrap');

import axios from 'axios'
import task from './task.vue'

var app = new Vue({
    el: '#app',
    data: {
        tasks: [],
    },
    methods:{
        add_task(){
            axios.post('/api/task',
                { content: 'нажмите, чтобы редактировать'} )
                .then((response) => {
                    console.log(response)
                });
            axios.get('/api/task')
                .then(response => (this.tasks  = response.data));
        },
        delete_task(){
            axios.post('/api/task',
                { content: 'нажмите, чтобы редактировать'} )
                .then((response) => {
                    console.log(response)
                });
        },
        fetch_tasks(){
            console.log('refreshing tasks...');
            axios.get('/api/task')
                .then(response => (this.tasks  = response.data));
        }
    },
    components:{
      'task': task,
    },
    computed:{
        complete_tasks(){
            let complete_tasks = [];
            for (let task of this.tasks) {
                if(task.is_complete === 1) complete_tasks.push(task);
            }
            return complete_tasks;
        },
        actual_tasks(){
            let actual_tasks = [];
            for (let task of this.tasks) {
                if(task.is_complete === 0) actual_tasks.push(task);
            }
            return actual_tasks;
        }

    },
    mounted(){
        this.fetch_tasks();
    }
});

