<template>
    <base-card>
        <add-task @add-item="addTask"></add-task>
    </base-card>
    <base-card modifier="tabbed">
        <tabs-wrapper
            :activeList="activeList"
            :pendingTasks="getPendingTasks"
            :completedTasks="getCompletedTasks"
            @switch-view="showTasks">
        </tabs-wrapper>

        <task-item 
            v-for="task in displayedTasks" 
            :key="task.id"
            :id="task.id"
            :task="task.title"
            :complete="task.complete"
            @delete-task="deleteTask"
            @complete-task="completeTask"
            @activate-task="activateTask">
        </task-item>
    </base-card>
</template>

<script>
import TaskItem from './components/TaskItem.vue';
import AddTask from './components/AddTask.vue';

export default {
data(){
    return{
        activeList: 'pending',
        listId: document.getElementById("todo").getAttribute('data-list-id'),
        tasks: []
    }
},
computed: {
    displayedTasks(){
        if(this.activeList == 'pending'){
            return this.tasks.filter(task => task.complete === false);
        } else {
            return this.tasks.filter(task => task.complete === true);
        }
    },
    getCompletedTasks(){
        return this.tasks.filter(task => task.complete === true).length;
    },
    getPendingTasks(){
        return this.tasks.filter(task => task.complete === false).length;
    },
},
methods: {
    addTask(task){
        window.axios.post("/xhr/task", {
           title: task,
           list: this.listId
        }).then((response) => {
            console.log("task added!");
        });
    },
    deleteTask(taskId){
        const taskIndex = this.tasks.findIndex((task) => task.id === taskId);
        window.axios.post("/xhr/task/" + taskId + "/delete", {
           id: taskId,
        }).then((response) => {
            console.log("task deleted");
        });
    },
    completeTask(taskId){
        const taskIndex = this.tasks.findIndex(task => task.id === taskId);
        
        // Update list in database
        window.axios.post("/xhr/task/" + taskId + "/edit", {
           id: taskId,
           complete: 1
        }).then((response) => {
            console.log("task completed");
        });
    },
    activateTask(taskId){
        const taskIndex = this.tasks.findIndex(task => task.id === taskId);

        // Update list in database
        window.axios.post("/xhr/task/" + taskId + "/edit", {
           id: taskId,
           complete: 0
        }).then((response) => {
            console.log("task activated");
        });
    },
    showTasks(type){
        if(type === 'completed'){
            this.activeList = 'completed';
        }
        if(type === 'pending'){
            this.activeList = 'pending';
        }
    }
},
components: {
    TaskItem,
    AddTask,
},
mounted(){
    window.axios.get("/xhr/list/" + this.listId)
        .then((response) => {
            response.data.forEach(element => {
                if(element.complete == "0"){
                    element.complete = false
                }
                if(element.complete == "1"){
                    element.complete = true
                }
                this.tasks.push(element);
            });
        });
    },
    created(){
        window.Echo.private('list.' + this.listId)
            .listen('TaskUpdated', (event) => {
                if(event.list == this.listId){
                    const taskIndex = this.tasks.findIndex(task => task.id === event.task);
                    
                    if(event.complete == 1){
                        this.tasks[taskIndex].complete = true;
                    }
                    if(event.complete == 0){
                        this.tasks[taskIndex].complete = false;
                    }
                }
            })
            .listen('TaskCreated', (event) => {
                this.tasks.unshift({
                    id: event.id,
                    title: event.title,
                    complete: false
                });
            })
            .listen('TaskDeleted', (event) => {
                const taskIndex = this.tasks.findIndex(task => task.id === event.id);
                this.tasks.splice(taskIndex, 1);
            });
    }
}
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato:wght@300;700&display=swap');
    body{
        margin: 0;
        font-family: 'Lato', sans-serif;
        background-color: rgb(239 239 239);
    }
    #todo{
        margin: 0 10px;
    }
</style>