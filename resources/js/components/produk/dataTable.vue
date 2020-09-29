<template>
  <div>
    <mdb-datatable-2 v-model="data" :searching="{value: search, field: 'office'}" />
    <mdb-input class="mt-0" v-model="search" label="Search by office" />
  </div>
</template>