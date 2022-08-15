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
        const taskId = new Date().toISOString();
        this.tasks.unshift({
            id: taskId,
            title: task,
            complete: false
        });
        
    },
    deleteTask(taskId){
        const taskIndex = this.tasks.findIndex((task) => task.id === taskId);
        this.tasks.splice(taskIndex,1);
    },
    completeTask(taskId){
        const taskIndex = this.tasks.findIndex(task => task.id === taskId);
        this.tasks[taskIndex].complete = true;

        // Update list in database
        window.axios.post("/list/" + this.listId, {
            task: this.tasks[taskIndex]
        });
    },
    activateTask(taskId){
        const taskIndex = this.tasks.findIndex(task => task.id === taskId);
        this.tasks[taskIndex].complete = false;
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