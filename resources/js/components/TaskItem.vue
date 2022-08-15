<template>
    <div>
        <p>{{ task }}</p>
        <div>
            <base-button v-if="complete" @click="deleteTask(id)">Delete</base-button>
            <base-button v-if="complete" @click="activateTask(id)">Activate</base-button>
            <base-button v-else @click="completeTask(id)">Complete</base-button>
        </div>
    </div>
</template>

<script>
export default{
    props: ['id','task','complete'],
    emits: ['delete-task','complete-task', 'activate-task'],
    methods: {
        deleteTask(taskId){
            this.$emit('delete-task', taskId);
        },
        completeTask(taskId){
            this.$emit('complete-task', taskId);
        },
        activateTask(taskId){
            this.$emit('activate-task', taskId);
        },
        
    }
}
</script>

<style scoped>
div{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    padding: 10px;
    
}
div:not(:last-of-type){
    border-bottom: 1px solid white;
}
p{
    margin: 0;
    text-transform: capitalize;
}

</style>