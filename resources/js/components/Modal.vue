<template>
    <div class="wrapper">
        <input type="text" :value="title">
        <div class="buttons">
            <base-button>Save</base-button>
            <base-button @click="deleteTask(id)">Delete</base-button>
        </div>
    </div>
    <div class="background" @click="closeModal"></div>
</template>

<script>
export default{
    props: ['id','title'],
    emits: ['close-modal','delete-task'],
    methods:{
        closeModal(){
            this.$emit('close-modal');
        },
        deleteTask(taskId){
            this.$emit('delete-task',taskId);
        }
    }
}
</script>

<style scoped>
.wrapper{
    display: block;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    background-color: rgb(0, 194, 0);
    border: 1px solid black;
    padding: 20px;
    box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
    z-index: 2;
}

.background{
    position: fixed;
    height: 100vh;
    width: 100vh;
    top: 0;
    left: 0;
    background-color: rgba(0,0,0,0.5);
    z-index: 1;
}
.buttons{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-top: 20px;
}

input{
        flex-grow: 1;
        padding: 6px;
        font-size: 16px;
        line-height: 16px;
        border: 1px solid black;
    }

</style>