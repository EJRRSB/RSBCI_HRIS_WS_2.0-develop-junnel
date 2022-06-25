<template>
    <div>    
        <div> 
            <div class ="modal-bg"  >
                <div class="modal-container"> 
                    <Loading message ="Processing"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
 
    import Loading from '../../components/Loading.vue'
    import { ref } from 'vue'

    export default {
        components: {
            Loading, 
        },  
    }

</script>

<style lang="sass" scoped>
.modal-container  
    height: 300px
    width: 300px
    background-color: white  

.modal-bg
    position: absolute
    width: 100%
    height: 100%
    display: flex
    top: 0
    right: 0
    justify-content: center
    align-items: center
    background-color: #3d3b3bc2
    z-index: 99
    border-radius: 5px

</style>