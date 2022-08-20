<template>
    <div @touchend="touchEnd($event, id)" @touchstart="touchStart($event)">
        <p>{{ task }}</p>
        <div>
            <base-button v-if="complete" @click="activateTask(id)">Activate</base-button>
            <base-button v-else @click="completeTask(id)">Complete</base-button>
        </div>
    </div>
</template>

<script>
export default{
    props: ['id','task','complete'],
    emits: ['delete-task','complete-task', 'activate-task','modify-task'],
    data(){
        return{
            touchStartTimeStamp: 0,
        }
    },
    methods: {
        completeTask(taskId){
            this.$emit('complete-task', taskId);
        },
        activateTask(taskId){
            this.$emit('activate-task', taskId);
        },
        touchStart(event){
                this.touchStartTimeStamp = event.timeStamp;
        },
        touchEnd(event, taskId){
            if(event.timeStamp - this.touchStartTimeStamp > 800){
                this.$emit('modify-task', taskId);
            }
        },
    }
}
</script>

<style scoped>
div{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
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