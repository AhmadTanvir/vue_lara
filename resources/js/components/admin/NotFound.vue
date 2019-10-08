<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="box" style="margin-top: 300px; width: 500px; height: 500px">
                    <div class="box__ghost">
                        <div class="symbol"></div>
                        <div class="symbol"></div>
                        <div class="symbol"></div>
                        <div class="symbol"></div>
                        <div class="symbol"></div>
                        <div class="symbol"></div>
                        <div class="box__ghost-container">
                            <div class="box__ghost-eyes">
                                <div class="box__eye-left"></div>
                                <div class="box__eye-right"></div>
                            </div>
                            <div class="box__ghost-bottom">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                        <div class="box__ghost-shadow"></div>
                    </div>
                    <div class="box__description">
                        <div class="box__description-container">
                            <div class="box__description-title">Whoops!</div>
                            <div class="box__description-text">It seems like we couldn't find the page you were looking for</div>
                        </div>
                        <router-link to="/dashboard" class="box__button">Go back</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted() {

    }
}

</script>
