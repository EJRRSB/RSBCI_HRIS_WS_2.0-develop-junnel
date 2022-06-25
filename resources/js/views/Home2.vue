<template> 
 

  <div class="nav-container">
      <SideNavBar />
      <div class="main-container">
          <TopNavBar />
          <slot></slot> 
          <BoardContent />
      </div>
  </div>
</template>

<script>
// import LeftNavBar from '@/components/LeftNavBar.vue'
// import MainHeader from '@/components/MainHeader.vue'
import SideNavBar from "../components/SideNavBar";
import TopNavBar from "../components/TopNavBar";
import BoardContent from '../components/BoardContent.vue'
export default {
  components: {
    SideNavBar,
    TopNavBar,
    BoardContent,
  },
}
</script>

<style lang="scss" scoped>
//Header Board Style.css

// .left-container { // ELTON -- COMMENTED
//   display: flex; 
//   flex-direction: column;
//   position: fixed;
//   height: 100vh;
//   width: auto;

//   z-index: 6; /* Stay on top */
//   top: 0; /* Stay at the top */
//   left: 0;

//   overflow-x: hidden;
//   overflow-y: hidden;
//   background-color: #efefef;
//   box-shadow: 1px 0px 5px 0px #888888;
// } 

// .right-container {
//   padding-left: 60px;
//   width: 100%;
//   min-height: 100vh;
//   height: auto;
// }

.board {
  padding-top: 60px;
  padding-bottom: 30px;
  width: 100%;
//   background: url('../assets/images/bg.png');
  background-attachment: fixed;
  background-repeat: no-repeat;
  background-position: top center;
  background-size: cover;
  min-height: 100vh;
  height: auto;
}

.breadcrumb-container {
  display: flex;
  align-items: center;
  z-index: 1;
  width: 100%;
  height: 30px;
  padding: 0 30px;
}

.breadcrumb-container a {
  font-family: 'Noto Sans', sans-serif;
  font-size: 0.9em;
  text-decoration: none;
  color: #6f499b;
  z-index: 1;
}

.breadcrumb-container a:hover {
  color: #92c156;
}
//Left Nav Bar.css


// ELTON 
.nav-container{

    width: 100%;
    height: 100%;
    display: flex;
}

.main-container{
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    background: none;
    width: 100%;

}
</style>
