<template>
  <div>
    <q-banner class="bg-grey-3">
      <template v-slot:avatar>
        <q-icon name="play_for_work" color="warning" />
      </template>
      شما در حال کار بر روی طراحی کاتالوگ برای مایا بودید. برای ثبت زمان لطفا به صفحه کار مراجعه کنید.
      <template v-slot:action>
        <q-btn flat color="warning" label="مشاهده گزارش کارها" />
      </template>
    </q-banner>
    <div v-for="task in tasks" :key="task.id">
    <q-expansion-item
      class="shadow-1 overflow-hidden q-mt-xs q-mx-md"
      style="border-radius: 30px"
      group="tasks"
      icon="info"
      v-bind:label="task.title"
      @show="startCounting"
      @hide="stopCounting"
      header-class="bg-negative text-dark"
      expand-icon-class="text-white"
    >
      <q-card>
        <q-card-section>
          <q-list>
            <q-item>
              <q-item-section avatar top>
                <q-icon name="work" color="black" size="34px" />
              </q-item-section>

              <q-item-section top class="col-2 gt-sm">
                <q-item-label class="q-mt-sm">تست کار</q-item-label>
              </q-item-section>

              <q-item-section top>
                <q-item-label lines="1">
                  <span class="text-weight-medium">[چاپ/فوری]</span>
                  <span class="text-grey-8"> - کاتالوگ تبلیغاتی مایا</span>
                </q-item-label>
                <q-item-label caption lines="1">
                  کاتالوگ در قطع بزرگ برای بازار
                </q-item-label>
                <q-item-label lines="1" class="q-mt-xs text-body2 text-weight-bold text-primary text-uppercase">
                  <span class="cursor-pointer">مشاهده گزارش</span>
                </q-item-label>
              </q-item-section>

              <q-item-section top side>
                <div class="text-grey-8 q-gutter-xs">
                  <q-btn class="gt-xs" size="12px" flat dense round icon="link" to="/task/212">
                    <q-tooltip>
                      مشاهده
                    </q-tooltip>
                  </q-btn>
                  <q-btn class="gt-xs" size="12px" flat dense round icon="done">
                    <q-tooltip>
                      کارم تموم شده
                    </q-tooltip>
                  </q-btn>
                  <q-btn class="gt-xs" size="12px" flat dense round icon="done_all">
                    <q-tooltip>
                      کار کاملا تموم شده
                    </q-tooltip>
                  </q-btn>
                  <q-btn size="12px" flat dense round icon="more_vert">
                    <q-menu anchor="bottom left" self="top left">
                      <q-item clickable>
                        <q-item-section>New tab</q-item-section>
                      </q-item>
                      <q-item clickable>
                        <q-item-section>New incognito tab</q-item-section>
                      </q-item>
                    </q-menu>
                  </q-btn>
                </div>
              </q-item-section>
            </q-item>
          </q-list>
        </q-card-section>
      </q-card>
    </q-expansion-item>
  </div>
    <!--<q-list bordered class="rounded-borders" style="">-->
      <!--<q-item-label header>کارهای من</q-item-label>-->

      <!--<q-item>-->
        <!--<q-item-section avatar top>-->
          <!--<q-icon name="work" color="positive" size="34px" />-->
        <!--</q-item-section>-->

        <!--<q-item-section top class="col-2 gt-sm">-->
          <!--<q-item-label class="q-mt-sm">524</q-item-label>-->
        <!--</q-item-section>-->

        <!--<q-item-section top>-->
          <!--<q-item-label lines="1">-->
            <!--<span class="text-weight-medium">[بخش چاپ]</span>-->
            <!--<span class="text-grey-8"> - محسن تنابنده</span>-->
          <!--</q-item-label>-->
          <!--<q-item-label caption lines="1">-->
            <!--طراحی و تولید ساعت دیواری تبلیغاتی برند مایا-->
          <!--</q-item-label>-->
          <!--<q-item-label lines="1" class="q-mt-xs text-body2 text-weight-bold text-primary text-uppercase">-->
            <!--<span class="cursor-pointer">مشاهده تسک</span>-->
          <!--</q-item-label>-->
        <!--</q-item-section>-->

        <!--<q-item-section top side>-->
          <!--<div class="text-grey-8 q-gutter-xs">-->
            <!--<q-btn class="gt-xs" size="12px" flat dense round icon="delete" />-->
            <!--<q-btn class="gt-xs" size="12px" flat dense round icon="done" />-->
            <!--<q-btn size="12px" flat dense round icon="more_vert" />-->
          <!--</div>-->
        <!--</q-item-section>-->
      <!--</q-item>-->

      <!--<q-separator spaced />-->

      <!--<q-item>-->
        <!--<q-item-section avatar top>-->
          <!--<q-icon name="account_tree" color="black" size="34px" />-->
        <!--</q-item-section>-->

        <!--<q-item-section top class="col-2 gt-sm">-->
          <!--<q-item-label class="q-mt-sm">GitHub</q-item-label>-->
        <!--</q-item-section>-->

        <!--<q-item-section top>-->
          <!--<q-item-label lines="1">-->
            <!--<span class="text-weight-medium">[quasarframework/quasar]</span>-->
            <!--<span class="text-grey-8"> - GitHub repository</span>-->
          <!--</q-item-label>-->
          <!--<q-item-label caption lines="1">-->
            <!--@rstoenescu in #1: > The build system-->
          <!--</q-item-label>-->
          <!--<q-item-label lines="1" class="q-mt-xs text-body2 text-weight-bold text-primary text-uppercase">-->
            <!--<span class="cursor-pointer">Open in GitHub</span>-->
          <!--</q-item-label>-->
        <!--</q-item-section>-->

        <!--<q-item-section top side>-->
          <!--<div class="text-grey-8 q-gutter-xs">-->
            <!--<q-btn class="gt-xs" size="12px" flat dense round icon="delete" />-->
            <!--<q-btn class="gt-xs" size="12px" flat dense round icon="done" />-->
            <!--<q-btn size="12px" flat dense round icon="more_vert" />-->
          <!--</div>-->
        <!--</q-item-section>-->
      <!--</q-item>-->
    <!--</q-list>-->
  </div>
</template>

<script>
// import axios from 'axios'

export default {
  name: 'PageIndex',
  data () {
    return {
      tasks: [],
      user: [],
      counter: 0
    }
  },
  mounted: function () {
    this.$q.notify({
      color: 'positive',
      position: 'bottom',
      message: 'ورود با موفقیت انجام شد',
      icon: 'done'
    })
    this.$axios('/api/d/u')
      .then((response) => {
        this.user = response.data
        this.$q.notify({
          color: 'positive',
          position: 'top',
          message: 'اطلاعات کاربر دریافت شد' + this.user.id,
          icon: 'report_problem'
        })
      })
      .catch(() => {
        this.$q.notify({
          color: 'negative',
          position: 'top',
          message: 'اطلاعات کاربر دریافت نشد',
          icon: 'report_problem'
        })
      })
    this.$axios('/api/d/task/all')
      .then((response) => {
        this.tasks = response.data
        this.$q.notify({
          color: 'positive',
          position: 'top',
          message: 'اطلاعات دریافت شد' + this.tasks.length,
          icon: 'report_problem'
        })
      })
      .catch(() => {
        this.$q.notify({
          color: 'negative',
          position: 'top',
          message: 'اطلاعات دریافت نشد',
          icon: 'report_problem'
        })
      })
  },
  methods: {
    startCounting () {
      this.timer = setInterval(() => {
        this.counter++
      }, 1000)
    },

    stopCounting () {
      clearInterval(this.timer)
    }
  },

  beforeDestroy () {
    this.stopCounting()
  }
}

</script>
