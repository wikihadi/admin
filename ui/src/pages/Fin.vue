<template>
  <q-page class="flex flex-center">
    <div>
      <q-banner class="bg-grey-3">
        <template v-slot:avatar>
          <q-icon name="sentiment_very_dissatisfied" color="primary" />
        </template>
        این صفحه آماده نیست. بعدا مراجعه کنید لطفا
        <template v-slot:action>
          <q-btn flat color="primary" label="برگرد" to="/" />
        </template>
      </q-banner>
    </div>
  </q-page>
</template>

<script>
export default {
  name: 'Fin'
}
</script>
