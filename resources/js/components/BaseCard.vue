<template>
    <div :class="modifier">
        <slot></slot>
    </div>
</template>

<script>
export default{
    props: ['modifier']
}
</script>

<style scoped>
    div{
        position: relative;
        background-color: rgb(0, 194, 0);
        padding: 20px;
        margin: 20px auto 0 auto;
        max-width: 800px;
        widows: 100%;
        border: 1px solid black;
    }
    div .tabbed{
        margin-top: 50px;
    }
</style>