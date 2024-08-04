<script setup>
import { ref, reactive, watch, nextTick } from 'vue'
import types from './types'
import smsConfig from './sms-config'
import { merge, cloneDeep } from 'lodash'
import sms from '@/api/sms/sms'
import { Message } from '@arco-design/web-vue'

const visibie = ref(false)
const title = ref('')
const form = ref({ name: '' })
const formRef = ref()
const updated = ref(true)
const config = ref({})

const emit = defineEmits(['onSuccess'])

const open = (name, data = null) => {
  title.value = name
  visibie.value = true
  if (data === null) {
    config.value = {}
    columns.value = sourceColumns
    form.value = { name: '' }
  } else {
    config.value = smsConfig[data.name]
    form.value = {
      id: data.id,
      name: data.name,
    }
    for (let key in data.config) {
      form.value[key] = data.config[key]
    }
  }
}

const sourceColumns = [
  { title: 'ID', dataIndex: 'id', display: false },
  {
    title: '平台厂商',
    dataIndex: 'name',
    search: true,
    rules: [{ required: true, message: '平台厂商必填' }],
    formType: 'select',
    dict: { data: types, translation: true },
    onChange: (value) => {
      form.value.name = value
      config.value = smsConfig[value]
    }
  },
]

const columns = ref(sourceColumns)

watch(() => config.value, (value) => {
  columns.value = cloneDeep(sourceColumns)
  if (JSON.stringify(value) !== '{}') {
    columns.value.push({
      title: '参数配置',
      dataIndex: 'divider',
      formType: 'divider',
    })
    Object.keys(value).map(key => {
      columns.value.push({
        title: value[key].label,
        dataIndex: value[key].value,
        labelWidth: '300px',
        formType: 'input',
        rules: [{ required: true, message: value[key].label + '必填' }]
      })
    })
    // Object.keys(form.value).map(key => {
    //   if (key !== 'name') {
    //     form.value[key] = undefined
    //   }
    // })
    updated.value = false
    nextTick(() => {
      updated.value = true
    })
  }
})

const submit = (data, done) => {
  done(true)
  if (data.id === undefined) delete data.id
  delete data.divider
  const saveData = { name: '', config: {} }
  Object.keys(data).map(key => {
    if (key !== 'name') {
      saveData.config[key] = data[key]
    } else {
      saveData.name = data[key]
    }
  })

  if (data?.id) {
    delete saveData.id
    delete saveData.config.id
    sms.save(data.id, saveData).then(res => {
      if (res.success) {
        Message.success('保存成功')
        visibie.value = false
        emit('onSuccess')
        done(false)
      } else {
        done(false)
      }
    }).catch(e => {
      done(false)
    })
  } else {
    sms.create(saveData).then(res => {
      if (res.success) {
        Message.success('保存成功')
        visibie.value = false
        emit('onSuccess')
        done(false)
      } else {
        done(false)
      }
    }).catch(e => {
      done(false)
    })
  }
}

defineExpose({ open })
</script>
<template>
  <a-modal v-model:visible="visibie" :title="title" :footer="false" unmount-on-close>
    <ma-form
      v-if="updated"
      :options="{ layout: 'vertical' }"
      :columns="columns"
      v-model="form"
      ref="formRef"
      @submit="submit"
    >
    </ma-form>
  </a-modal>
</template>