<template>

    <div>
        <div v-if="alertmessage.text != ''" style="margin: 10px 10px 10px 10px;"
            :class="{
                'alert errorAlert': alertmessage.type === 'error',
                'alert successAlert': alertmessage.type === 'success'
            }" role="alert">
            <span>{{alertmessage.text}}</span>
        </div>
    </div>

</template>

<style>
    .errorAlert{
        color: #721c24;
        background-color: #f8d7da;
        border: 1px solid #fb9da7;
    }

    .successAlert{
        color: #155724;
        background-color: #d4edda;
        border: 1px solid #80d493;
    }

</style>

<script>
export default {
    name: "Message",
    props: [
        'alertmessage'
    ]       
};
</script>