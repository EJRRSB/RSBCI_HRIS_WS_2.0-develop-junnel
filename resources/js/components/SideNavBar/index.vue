<template>
    <div class="left-container" :class="{ collapsed: !isExpanded }">
        <div class="leftnav">
            <div class="logo-placeholder">
                <img
                    class="leftnav-logo"
                    :src="[
                        isExpanded
                            ? '/assets/images/array-logo.svg'
                            : '/assets/images/array-box-logo.svg',
                    ]"
                    alt="array-logo-full"
                />
            </div>
            <SideNavBarLinks
                v-for="link in links"
                :key="link"
                :link="link"
                :isExpanded="isExpanded"
            />
        </div>
        <div class="expanded-button-container">
            <div class="expanded-button" @click="isExpanded = !isExpanded">
                <img
                    src="/assets/images/collapsed-btn.svg"
                    alt="collapse-nav-icon"
                />
                <h4 class="expanded-button-text" v-if="isExpanded">
                    Collapse Nav
                </h4>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "@vue/reactivity";
import SideNavBarLinks from "./SideNavBarLink.vue";
import NavLinks from "../../JSON/NavLinks.json";
export default {
    components: { SideNavBarLinks },
    setup() {
        const isExpanded = ref(true);
        const links = ref(NavLinks);
        return { links, isExpanded };
    },
};
</script>
<style lang="scss" scoped>
.left-container {
    display: flex;
    flex-direction: column;
    height: 100vh;
    width: 250px;
    box-shadow: 1px 0px 5px 0px #888888;
    background: #efefef;
    .leftnav {
        display: flex;
        flex-direction: column;
        height: 100vh;
        width: 100%;
    }
    .expanded-button-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-end;
        height: 50px;
        padding-bottom: 10px;
        .expanded-button {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            height: 40px;
            width: 200px;
            background-color: #6f499b;
            padding: 10px;
            border-radius: 5px;
            transition-duration: 0.4s;
            cursor: pointer;
            img {
                width: auto;
                height: 24px;
            }
            h4 {
                color: white;
                font-weight: 500;
                margin-left: 8px;
                padding-right: 5px;
            }
            &:hover {
                background-color: #92c156;
            }
        }
    }
}

.logo-placeholder {
    height: 60px;
    width: 100%;
    display: flex;
    align-content: center;
    justify-content: center;
    padding: 12.5px 20px;
}

.leftnav-logo {
    height: 100%;
}

.navlinks-sub-container {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-bottom: 5px;
}

.navlinks-sub-categotry {
    height: 34px;
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: center;
    background: #dedede;
    margin-bottom: 5px;
    padding: 0 38px;
}

.navlinks-sub-categotry img {
    height: 18px;
    width: auto;
    padding-right: 32px;
}

.navlinks-sub-categotry-text {
    font-weight: 600;
    font-size: 0.85em;
    color: #606060;
}

.navlinks-sub-categotry-active {
    height: 34px;
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: center;
    background: #24a7aa;
    margin-bottom: 5px;
    padding: 0 38px;
}

.navlinks-sub-categotry-active img {
    height: 18px;
    width: auto;
    padding-right: 32px;
    filter: invert(0%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(1000%)
        contrast(100%);
}

.navlinks-sub-categotry-active h4 {
    font-family: "Noto Sans";
    font-weight: 600;
    font-size: 0.85em;
    color: #ffffff;
}

.navlinks-sub-categotry:hover {
    background: #24a7aa;

    cursor: pointer;
}

.navlinks-sub-categotry:hover h4 {
    color: white;
}

.navlinks-sub-categotry:hover img {
    filter: invert(0%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(1000%)
        contrast(100%);
}

.navlinks-collapsed-container {
    height: 50px;
    width: 100%;
    display: none;
    justify-content: center;
    align-items: center;
    background: #dedede;
    margin-bottom: 10px;
    cursor: pointer;
}

.navlinks-active img {
    filter: invert(0%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(1000%)
        contrast(100%);
}

.navlink-arrow-toggle {
    transform: rotate(-90deg);
}

#menu-title-active {
    color: white;
}

.collapsed {
    width: auto;
    .expanded-button-container {
        .expanded-button {
            width: auto;
            img {
                transform: rotate(-180deg);
            }
        }
    }
}

// .collapsed-button-container {
//     display: none;
//     flex-direction: column;
//     align-items: center;
//     justify-content: flex-end;
//     height: 50px;
//     padding-bottom: 10px;
// }

// .collapsed-button {
//     display: none;
//     flex-direction: row;
//     align-content: center;
//     justify-content: center;
//     height: 40px;
//     width: 180px;
//     background-color: #6f499b;
//     padding: 10px;
//     border-radius: 5px;
//     cursor: pointer;
// }
</style>
