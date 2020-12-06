<template>
    <el-submenu :index="menu.id.toString()">
        <template slot="title">
            <i :class="menu.icon||'bi-chevron-double-right'"></i>
            <span slot="title">{{ menu.name }}</span>
        </template>
        <template v-for="sub in menu.children">
            <sub-menu v-if="sub.children" :key="sub.id" :menu="sub"></sub-menu>
            <el-menu-item v-else :key="sub.id" :index="sub.id.toString()">
                <i :class="sub.icon||'bi-chevron-right'"></i>
                <span slot="title">{{ sub.name }}</span>
            </el-menu-item>
        </template>
    </el-submenu>
</template>

<script>
export default {
    name: "SubMenu",
    props: {
        menu: Object,
    }
}
</script>

<style scoped>

</style>