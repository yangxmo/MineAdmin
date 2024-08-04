import { request } from '@/utils/request.js'

/**
 * sms管理 API JS
 */

export default {

    /**
     * 获取接口管理分页列表
     * @returns
     */
    getList(params = {}) {
        return request({
            url: 'plugin/mineadmin/sms/index',
            method: 'get',
            params
        })
    },

    /**
     * 添加接口管理
     * @returns
     */
    create(data = {}) {
        return request({
            url: 'plugin/mineadmin/sms/create',
            method: 'post',
            data
        })
    },

    /**
     * 将接口管理移到回收站
     * @returns
     */
    deletes(data) {
        return request({
            url: 'plugin/mineadmin/sms/delete',
            method: 'delete',
            data
        })
    },

    /**
     * 更新接口管理数据
     * @returns
     */
    save(id, data = {}) {
        data.id = id;
        return request({
            url: 'plugin/mineadmin/sms/save',
            method: 'put',
            data
        })
    },

}