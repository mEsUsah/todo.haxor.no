<template>
    <div>
        <input @keydown.enter="addItem" type="text" name="task" v-model="task" placeholder="Task to do...">
        <button @click="addItem">Add</button>
    </div>
</template>

<script>
export default{
    emits: ['add-item'],
    data(){
        return{
            task: ""
        }
    },
    methods: {
        addItem(){
            this.$emit('add-item', this.task);
            this.task = '';
        }
    }
}
</script>

<style scoped>
    div{
        width: 100%;
        display: flex;
    }
    input{
        flex-grow: 1;
        padding: 6px;
        font-size: 16px;
        line-height: 16px;
        border: 1px solid black;
        border-right: none;
    }
    button{
        padding: 6px 12px;
        font-size: 16px;
        line-height: 16px;
        border: 1px solid black;
        background-color: black;
        color: white;
    }
</style>