<template>
    <div class="nav-container">
        <SideNavBar />
        <div class="main-container">
            <TopNavBar />
            <slot></slot>
        </div>
    </div>
</template>

<script>
import SideNavBar from "./SideNavBar";
import TopNavBar from "./TopNavBar";
export default { components: { SideNavBar, TopNavBar } };
</script>

<style lang="sass" scoped>
.nav-container
    width: 100%
    height: 100%
    display: flex
    .main-container
        display: flex
        flex-direction: column
        justify-content: flex-start
        background: none
        width: 100%
</style>
