<template>
    <div class="nav-container" :class="{ collapsed: !isExpanded }">
        <div class="navlinks-container" @click="hideSubCategory">
            <div class="menu-icon-container">
                <img :src="link.img_logo_src" />
            </div>

            <p v-if="isExpanded">{{ link.name }}</p>

            <div class="menu-arrow-container" v-if="isExpanded">
                <img src="/assets/images/arrow-down.svg" />
            </div>
        </div>

        <div v-if="show && isExpanded" class="navlinks-sub-container">
            <router-link
                class="navlinks-sub-categotry"
                v-for="href in link.href"
                :key="href"
                :to="href.src"
            >
                <img src="/assets/images/sub-category-bullet.svg" />
                <h4 class="navlinks-sub-categotry-text">{{ href.name }}</h4>
            </router-link>
        </div>
    </div>
</template>

<script>
import { ref } from "@vue/reactivity";
export default {
    props: {
        link: {
            required: true,
            type: Object,
        },
        isExpanded: {
            default: true,
            type: Boolean,
        },
    },
    setup() {
        const show = ref(false);
        const hideSubCategory = () => {
            show.value = !show.value;
        };
        return { show, hideSubCategory };
    },
};
</script>

<style lang="scss" scoped>
.nav-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    .navlinks-container {
        height: 50px;
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        padding: 0 20px;
        transition-duration: 0.4s;
        background: #dedede;
        margin-bottom: 5px;
        margin-top: 5px;
        cursor: pointer;
        &:hover {
            background: #92c156;
        }
        .menu-icon-container {
            width: 20%;
            display: flex;
            justify-content: center;
            img {
                width: 24px;
            }
        }
        p {
            width: 70%;
            padding: 0;
            padding-left: 10px;
            color: #606060;
            font-family: "Source Sans Pro", sans-serif;
            font-weight: 600;
            font-size: 1em;
        }
        .menu-arrow-container {
            width: 10%;
            display: flex;
            justify-content: center;
            img {
                height: 10px;
                width: auto;
            }
        }
        &:hover {
            p {
                color: #ffffff;
            }
            .menu-icon-container,
            .menu-arrow-container {
                img {
                    filter: invert(0%) sepia(0%) saturate(0%) hue-rotate(0deg)
                        brightness(1000%) contrast(100%);
                }
            }
        }
    }
    .navlinks-sub-container {
        width: 100%;
    }
    .navlinks-sub-categotry {
        height: 34px;
        width: 100%;
        display: flex;
        align-items: center;
        background: #dedede;
        margin-top: 5px;
        margin-bottom: 5px;
        padding: 0 38px;
        transition-duration: 0.4s;
        text-decoration: none;
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
        filter: invert(0%) sepia(0%) saturate(0%) hue-rotate(0deg)
            brightness(1000%) contrast(100%);
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
        filter: invert(0%) sepia(0%) saturate(0%) hue-rotate(0deg)
            brightness(1000%) contrast(100%);
    }
}

.collapsed {
    position: relative;
    .navlinks-container {
        .menu-icon-container {
            width: 100%;
            img {
                width: 24px;
            }
        }
    }
    .navlinks-sub-categotry {
        position: absolute;
        left: 100%;
    }
}
</style>
