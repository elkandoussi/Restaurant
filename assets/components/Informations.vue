<template>
    <div class="border">
        <p> Prénom : {{firstname}} </p>
    </div>
</template>

<script>
export default {
    delimiters: ['${', '}'] ,
    name: 'informations',
    props: ['firstname', 'lastname', 'email', 'password']
}
</script>
    