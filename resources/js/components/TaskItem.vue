<template>
    <div 
        @touchend="touchEnd($event)" 
        @touchstart="touchStart($event)"
        @mouseup="touchEnd($event)"
        @mousedown="touchStart($event)">
        <p>{{ task }}</p>
        <div>
            <base-button v-if="complete" @click="activateTask(id)">Undo</base-button>
            <base-button v-else @click="completeTask(id)">Done</base-button>
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
        touchEnd(event){
            if(event.timeStamp - this.touchStartTimeStamp > 800){
                this.$emit('modify-task', this.id);
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
    padding: 10px 0;
    
}
div:not(:last-of-type){
    border-bottom: 1px solid white;
}
p{
    margin: 0;
    text-transform: capitalize;
    user-select: none;
}

</style>