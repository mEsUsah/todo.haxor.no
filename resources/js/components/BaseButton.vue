<template>
    <button>
        <slot></slot>
    </button>
</template>

<style scoped>
    button{
        padding: 6px 12px;
        font-size: 16px;
        line-height: 16px;
        border: 1px solid black;
        background-color: black;
        color: white;
        cursor: pointer;
    }
    button:not(:first-child){
        margin-left: 6px;
    }
</style>