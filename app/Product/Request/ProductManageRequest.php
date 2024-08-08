<?php

declare(strict_types=1);
/**
 * This file is part of MineAdmin.
 *
 * @link     https://www.mineadmin.com
 * @document https://doc.mineadmin.com
 * @contact  root@imoi.cn
 * @license  https://github.com/mineadmin/MineAdmin/blob/master/LICENSE
 */

namespace App\Product\Request;

use Hyperf\Validation\Rule;
use Mine\MineFormRequest;

/**
 * 商品列表验证数据类.
 */
class ProductManageRequest extends MineFormRequest
{
    /**
     * 公共规则.
     */
    public function commonRules(): array
    {
        return [];
    }

    /**
     * 新增数据验证规则
     * return array.
     */
    public function saveRules(): array
    {
        return [
            // 商品名称 验证
            'name' => 'required|max:200',
            // 商品建议销售价 验证
            'price' => 'required|decimal:0,2|min:0|max:999999',
            // 商品市场价 验证
            'market_price' => 'required|decimal:0,2|min:0|max:999999',
            // 商品库存 验证
            'sale' => 'required|integer|min:0|max:999999',
            // 商品首图 验证
            'image' => 'required',
            // 商品轮播图片 验证
            'images' => 'required|array',
            // 分组ID 验证
            'category_no' => 'required|exists:product_category,category_no',
            // 品牌ID 验证
            'brand_no' => 'required|exists:product_brand,brand_no',
            // 商品状态 验证
            'status' => 'required|integer|in:1,2',
            // 商品详情 验证
            'description' => 'required',
            // 商品单位 验证
            'unit' => 'nullable|string',
            // 成交量
            'booked_count' => 'nullable|integer|min:0|max:999999',
            // 商品规格
            'specs' => 'nullable|array',
            // 商品规格名称数组
            'specs.*.names' => 'required_with:specs|array',
            // 前端传递用于追踪商品规格的序号，
            'specs.*.names.*.id' => 'required_with:specs.*.names|integer',
            // 商品规格名
            'specs.*.names.*.name' => 'required_with:specs.*.names|string|max:25',
            // 商品规格值
            'specs.*.values' => 'required_with:specs|array',
            // 前端传递用于追踪商品规格的序号
            'specs.*.values.*.spec_name_id' => 'required_with:specs.*.values|integer',
            // 商品规格值ID，前端传递的对应值ID
            'specs.*.values.*.id' => 'required_with:specs.*.values|integer',
            // 商品规格
            'specs.*.values.*.name' => 'required_with:specs.*.values|string|max:25',
            // 商品spu
            'specs.*.options' => 'required_with:specs|array',
            // 商品规格值(前端传递的对应规格ID)
            'specs.*.options.*.spec_value_id' => 'required_with:specs.*.options|array',
            // 商品sku价格
            'specs.*.options.*.price' => 'required_with:specs.*.options|decimal:0,2|min:0|max:999999',
            // 商品sku市场价格
            'specs.*.options.*.market_price' => 'required_with:specs.*.options|decimal:0,2|min:0|max:999999',
            // 商品sku库存
            'specs.*.options.*.sale' => 'required_with:specs.*.options|integer|min:0|max:999999',
            // 商品sku属性ID所对应的显示名，比如颜色，尺码
            'specs.*.options.*.value' => 'required_with:specs.*.options|string',
            // 商品sku属性名称
            'specs.*.options.*.name' => 'required_with:specs.*.options|string|max:25',
            // 商品sku属性图片
            'specs.*.options.*.image' => 'required_with:specs.*.options|string',
            // 商品sku视频
            'specs.*.options.*.video' => 'nullable|string',
            // 商品sku排序
            'specs.*.options.*.sort' => 'nullable|integer|min:0|max:999999',
        ];
    }

    /**
     * 更新数据验证规则
     * return array.
     */
    public function updateRules(): array
    {
        return [
            // 商品编号 验证
            'product_no' => ['required', Rule::exists('product_info')->where(function ($query) {
                return $query->where('product_no', $this->route('id'));
            })],
            // 商品名称 验证
            'name' => 'required|max:200',
            // 商品建议销售价 验证
            'price' => 'required|decimal:0,2|min:0|max:999999',
            // 商品市场价 验证
            'market_price' => 'required|decimal:0,2|min:0|max:999999',
            // 商品库存 验证
            'sale' => 'required|integer|min:0|max:999999',
            // 商品首图 验证
            'image' => 'required',
            // 商品轮播图片 验证
            'images' => 'required|array',
            // 分组ID 验证
            'category_no' => 'required|exists:product_category,category_no',
            // 品牌ID 验证
            'brand_no' => 'required|exists:product_brand,brand_no',
            // 商品状态 验证
            'status' => 'required|integer|in:1,2',
            // 商品详情 验证
            'description' => 'required',
            // 商品单位 验证
            'unit' => 'nullable|string',
            // 成交量
            'booked_count' => 'nullable|integer|min:0|max:999999',
            // 商品规格
            'specs' => 'nullable|array',
            // 商品规格名称数组
            'specs.*.names' => 'required_with:specs|array',
            // 前端传递用于追踪商品规格的序号，
            'specs.*.names.*.id' => 'required_with:specs.*.names|integer',
            // 商品规格编号（原数据编号）
            'specs.*.names.*.attributes_no' => 'nullable|string',
            // 商品规格名
            'specs.*.names.*.name' => 'required_with:specs.*.names|string|max:25',
            // 商品规格值
            'specs.*.values' => 'required_with:specs|array',
            // 前端传递用于追踪商品规格的序号
            'specs.*.values.*.spec_name_id' => 'required_with:specs.*.values|integer',
            // 商品规格值ID，前端传递的对应值ID
            'specs.*.values.*.id' => 'required_with:specs.*.values|integer',
            // 商品规格值编号（原数据编号）
            'specs.*.values.*.attr_value_no' => 'nullable|string',
            // 商品规格
            'specs.*.values.*.name' => 'required_with:specs.*.values|string|max:25',
            // 商品spu
            'specs.*.options' => 'required_with:specs|array',
            // 商品规格值(前端传递的对应规格ID)
            'specs.*.options.*.spec_value_id' => 'required_with:specs.*.options|array',
            // 商品sku编码（原数据编号）
            'specs.*.options.*.sku_no' => 'nullable|string',
            // 商品sku价格
            'specs.*.options.*.price' => 'required_with:specs.*.options|decimal:0,2|min:0|max:999999',
            // 商品sku市场价格
            'specs.*.options.*.market_price' => 'required_with:specs.*.options|decimal:0,2|min:0|max:999999',
            // 商品sku库存
            'specs.*.options.*.sale' => 'required_with:specs.*.options|integer|min:0|max:999999',
            // 商品sku属性ID所对应的显示名，比如颜色，尺码
            'specs.*.options.*.value' => 'required_with:specs.*.options|string',
            // 商品sku属性名称
            'specs.*.options.*.name' => 'required_with:specs.*.options|string|max:25',
            // 商品sku属性图片
            'specs.*.options.*.image' => 'required_with:specs.*.options|string',
            // 商品sku视频
            'specs.*.options.*.video' => 'nullable|string',
            // 商品sku排序
            'specs.*.options.*.sort' => 'nullable|integer|min:0|max:999999',
        ];
    }

    /**
     * 字段映射名称
     * return array.
     */
    public function attributes(): array
    {
        return [
            'product_no' => '商品编号',
            'name' => '商品名称',
            'price' => '商品建议销售价',
            'market_price' => '商品市场价',
            'sale' => '商品库存',
            'image' => '商品首图',
            'images' => '商品轮播图片',
            'category_id' => '分组ID',
            'brand_id' => '品牌ID',
            'status' => '商品状态',
            'description' => '商品详情',
            'unit' => '商品单位',
            'booked_count' => '成交量',
            'specs' => '商品规格',
            'specs.*.names' => '商品规格名称数组',
            'specs.*.names.*.id' => '前端传递用于追踪商品规格的序号',
            'specs.*.names.*.name' => '商品规格名',
            'specs.*.names.*.attributes_no' => '商品规格原编号',
            'specs.*.values' => '商品规格值',
            'specs.*.values.*.spec_name_id' => '前端传递用于追踪商品规格名称的序号',
            'specs.*.values.*.id' => '商品规格值ID，前端传递的对应值ID',
            'specs.*.values.*.name' => '商品规格值',
            'specs.*.values.*.attr_value_no' => '商品规格值编号',
            'specs.*.options' => '商品spu',
            'specs.*.options.*.spec_value_id' => '商品规格值(前端传递的对应规格ID)',
            'specs.*.options.*.price' => '商品sku价格',
            'specs.*.options.*.market_price' => '商品sku市场价格',
            'specs.*.options.*.sale' => '商品sku库存',
            'specs.*.options.*.value' => '商品sku属性ID',
            'specs.*.options.*.name' => '商品sku属性名称',
            'specs.*.options.*.image' => '商品sku属性图片',
            'specs.*.options.*.video' => '商品sku视频',
            'specs.*.options.*.sort' => '商品sku排序',
            'specs.*.options.*.sku_no' => '商品sku编码（原数据编号）',
            'specs.*.options.*.attr_value_no' => '商品规格值编号（原数据编号）',
        ];
    }
}
