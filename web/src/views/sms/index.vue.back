<template>
  <div class="ma-content-block lg:flex justify-between p-4">
    <!-- CRUD 组件 -->
    <ma-crud :options="crud" :columns="columns" ref="crudRef" v-if="updated">
    </ma-crud>

    <!-- 自定义form -->
    <customForm ref="formRef" @onSuccess="() => crudRef.refresh()" />
  </div>
</template>

<script setup>
import { ref, reactive, inject, computed, nextTick } from 'vue'
import sms from '@/api/sms/sms'
import smsConfig from "./sms-config.js"
import types from './types.js'
import { Message } from '@arco-design/web-vue'
import customForm from './form.vue'

const crudRef = ref()
const formRef = ref()

const updated = ref(true)
const config = ref([])

const form = computed({
  get: () =>{
    return crudRef.value.getFormData()
  },
  set:(value)=>{
    crudRef.value.getFormData().value = value;
  }
})


const crud = reactive({
  api: sms.getList,
  rowSelection: { showCheckedAll: true },
  operationColumn: true,
  operationColumnWidth: 160,
  searchColNumber: 2,
  add: {
    show: true,
    auth: ['mineadmin:sms:save'],
    action: () => {
      formRef.value.open('新增短信厂商配置')
    }
  },
  edit: {
    show: true,
    auth: ['mineadmin:sms:update'],
    action: (record) => {
      formRef.value.open('编辑短信厂商配置', record)
    }
  },
  delete: { show: true,  api: sms.deletes, auth: ['mineadmin:sms:delete'] },
})

const columns = reactive([
  { title: 'ID', dataIndex: 'id', addDisplay: false, editDisplay: false, width: 50, hide: true },
  {
    title: '平台厂商',
    dataIndex: 'name',
    search: true,
    formType: 'select',
    dict: { data: types, translation: true },
  },
  {
    title: '创建时间', dataIndex: 'created_at', addDisplay: false, editDisplay: false,
    search: true, formType: 'range', width: 180
  },
])
</script>

<script>
export default { name: 'mineadmin:sms' }
</script>

<style scoped>

</style>