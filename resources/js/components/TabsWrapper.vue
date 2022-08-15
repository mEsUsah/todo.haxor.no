<template>
    <div>
        <button :class="listsActive" @click="showPendignTasks">Active ({{ pendingTasks }})</button>
        <button :class="listsCompleted" @click="showCompletedTasks">Completed ({{ completedTasks }})</button>
    </div>
</template>

<script>
export default{
    props: ['activeList','completedTasks','pendingTasks'],
    emits: ['switch-view'],
    methods: {
        showCompletedTasks(){
            this.$emit('switch-view', 'completed')
        },
        showPendignTasks(){
            this.$emit('switch-view', 'pending')
        }
    },
    computed: {
        listsActive(){
            if(this.activeList === 'pending'){
                return 'active'
            }
            return false;
        },
        listsCompleted(){
            if(this.activeList === 'completed'){
                return 'active'
            }
            return false;
        }
    }
}
</script>

<style scoped>
    div{
        position: absolute;
        top: -30px;
        left: -1px;
    }
    button{
        padding: 6px 12px;
        font-size: 16px;
        line-height: 16px;
        background-color: rgb(0, 169, 0);
        border: 1px solid black;
        color: white;
        cursor: pointer;
    }
    button:not(:first-child){
        border-left: none;
    }
    button.active{
        border-bottom-color: rgb(0, 194, 0);
        background-color: rgb(0, 194, 0);
    }
</style>