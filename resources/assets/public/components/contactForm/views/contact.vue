		
<template>
    <div class="container whitecontainer">
        <section class="section">

            <contact-form></contact-form>
        </section>
    </div>


</template>

<script>

    //import endpoints from '../endpoints.js';   //relative path - beware

    export default {
       mounted() {
           setTimeout(() => {
                window.scrollTo(0, 0);
            }, 100);
        },
    };
</script>



<style lang="scss">
    //@import '~sass/variables';
</style>

		