<template>
  <q-layout view="hHh lpR lFf">

    <q-header elevated class="bg-primary text-white" height-hint="98">
      <q-toolbar>
        <q-btn dense flat round icon="face" @click="left = !left" />

        <q-toolbar-title>
          <q-avatar>
          </q-avatar>
        </q-toolbar-title>

        <q-btn dense flat round icon="menu" @click="right = !right" />
      </q-toolbar>

      <!--<q-tabs align="left">-->
        <!--<q-route-tab to="/" label="داشبورد" />-->
        <!--<q-route-tab to="/" label="فعالیت ها" />-->
        <!--<q-route-tab to="/fin" label="مالی" />-->
      <!--</q-tabs>-->
    </q-header>

    <q-drawer show-if-above v-model="left" side="left" bordered>
      <q-list bordered padding class="rounded-borders text-primary">
        <q-item
          clickable
          v-ripple
          :active="link === 'inbox'"
          @click="link = 'inbox'"
          active-class="my-menu-link"
          to="/"
        >
          <q-item-section avatar>
            <q-icon name="inbox" />
          </q-item-section>

          <q-item-section>داشبورد</q-item-section>
        </q-item>

        <!--<q-item-->
          <!--clickable-->
          <!--v-ripple-->
          <!--:active="link === 'outbox'"-->
          <!--@click="link = 'outbox'"-->
          <!--active-class="my-menu-link"-->
          <!--to="/inbox"-->
        <!--&gt;-->
          <!--<q-item-section avatar>-->
            <!--<q-icon name="mail" />-->
          <!--</q-item-section>-->

          <!--<q-item-section>پیامها</q-item-section>-->
        <!--</q-item>     -->

        <q-item
          clickable
          v-ripple
          :active="link === 'outbox'"
          @click="link = 'outbox'"
          active-class="my-menu-link"
          to="/fin"
        >
          <q-tooltip
            transition-show="scale"
            transition-hide="flip-left"
          >
            در دست ساخت
          </q-tooltip>
          <q-item-section avatar>
            <q-icon name="mail" />
          </q-item-section>

          <q-item-section>مالی</q-item-section>
        </q-item>
        <q-item
          clickable
          v-ripple
          :active="link === 'trash'"
          @click="link = 'trash'"
          active-class="my-menu-link"
          to="/translate"
        >
          <q-tooltip
            transition-show="scale"
            transition-hide="flip-left"
          >
            در دست ساخت
          </q-tooltip>
          <q-item-section avatar>
            <q-icon name="translate" />
          </q-item-section>

          <q-item-section>ترجمه</q-item-section>
        </q-item>

        <q-separator spaced />

        <q-item
          clickable
          v-ripple
          :active="link === 'settings'"
          @click="link = 'settings'"
          active-class="my-menu-link"
          to="/setting"
        >
          <q-tooltip
            transition-show="scale"
            transition-hide="flip-left"
          >
            در دست ساخت
          </q-tooltip>
          <q-item-section avatar>
            <q-icon name="settings" />
          </q-item-section>

          <q-item-section>تنظیمات</q-item-section>
        </q-item>

        <q-item
          clickable
          v-ripple
          :active="link === 'help'"
          @click="link = 'help'"
          active-class="my-menu-link"
          to="/help"
        >
          <q-tooltip
            transition-show="scale"
            transition-hide="flip-left"
          >
            در دست ساخت
          </q-tooltip>
          <q-item-section avatar>
            <q-icon name="help" />
          </q-item-section>

          <q-item-section>راهنما</q-item-section>
        </q-item>
      </q-list>
    </q-drawer>

    <q-drawer show-if-above v-model="right" side="right" bordered>
      <q-scroll-area
        :bar-style="barStyle"
        style="height: 100%"
      >
      <q-list bordered>
        <q-item clickable v-ripple>
          <q-tooltip anchor="center right" self="center left" transition-show="flip-left" transition-hide="flip-right">
            568
          </q-tooltip>
          <q-item-section>
            <q-item-label caption>5 min ago</q-item-label>
            <q-item-label>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque molestias officiis omnis, pariatur quod repellat?</q-item-label>
          </q-item-section>
          <q-item-section side top>
            <q-avatar>
              <img src="https://cdn.quasar.dev/img/boy-avatar.png">
            </q-avatar>
          </q-item-section>
        </q-item>
        <q-separator />
      </q-list>
      </q-scroll-area>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>

    <q-footer elevated class="bg-grey-8 text-white">
      <q-toolbar>
        <q-toolbar-title @click="left = !left">
          <q-avatar>
            <img src="https://i.ya-webdesign.com/images/avatar-png-1.png">
          </q-avatar>
          هادی رفیعی
        </q-toolbar-title>
      </q-toolbar>
    </q-footer>

  </q-layout>
</template>

<script>
export default {
  data () {
    return {
      left: true,
      right: true
    }
  }
}
</script>
