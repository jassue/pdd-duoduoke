<?php

/*
 * This file is part of the jassue/pdd-duoduoke.
 *
 * (c) jassue <jassue@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jassue\DuoDuoKe;

/**
 * Class Client
 *
 * @package Jassue\DuoDuoKe
 * @author jassue <jassue@163.com>
 */
class Client extends BaseClient
{
    /**
     * 生成商城-频道推广链接
     *
     * @param array $pidList
     * @param array $data
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cmsPromUrlGenerate(array $pidList, array $data = [])
    {
        return $this->request('pdd.ddk.cms.prom.url.generate', array_merge(['p_id_list' => $pidList], $data));
    }

    /**
     * 多多进宝商品详情查询
     *
     * @param array $data
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function goodsDetail(array $data = [])
    {
        return $this->request('pdd.ddk.goods.detail', $data);
    }

    /**
     * 创建多多进宝推广位
     *
     * @param int $number
     * @param array $data
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function goodsPidGenerate(int $number, array $data = [])
    {
        return $this->request('pdd.ddk.goods.pid.generate', array_merge(['number' => $number], $data));
    }

    /**
     * 查询已经生成的推广位信息
     *
     * @param array $data
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function goodsPidQuery(array $data = [])
    {
        return $this->request('pdd.ddk.goods.pid.query', $data);
    }

    /**
     * 多多进宝推广链接生成
     *
     * @param string $pid
     * @param array $data
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function goodsPromotionUrlGenerate(string $pid, array $data = [])
    {
        return $this->request('pdd.ddk.goods.promotion.url.generate', array_merge(['p_id' => $pid], $data));
    }

    /**
     * 多多进宝商品推荐API
     *
     * @param array $data
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function goodsRecommendGet(array $data = [])
    {
        return $this->request('pdd.ddk.goods.recommend.get', $data);
    }

    /**
     * 多多进宝商品查询
     *
     * @param array $data
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function goodsSearch(array $data = [])
    {
        return $this->request('pdd.ddk.goods.search', $data);
    }

    /**
     * 多多进宝转链接口
     *
     * @param string $pid
     * @param string $sourceUrl
     * @param array $customParams
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function goodsZSUnitUrlGen(string $pid, string $sourceUrl, array $customParams = [])
    {

        return $this->request('pdd.ddk.goods.zs.unit.url.gen',
            array_merge(
                [
                    'pid' => $pid,
                    'source_url' => $sourceUrl
                ],
                $customParams ? ['custom_parameters' => json_encode($customParams)] : []
            )
        );
    }

    /**
     * 查询是否绑定备案
     *
     * @param string $pid
     * @param array $customParams
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function memberAuthorityQuery(string $pid, array $customParams = [])
    {
        return $this->request('pdd.ddk.member.authority.query',
            array_merge(
                [
                    'pid' => $pid,
                ],
                $customParams ? ['custom_parameters' => json_encode($customParams)] : []
            )
        );
    }

    /**
     * 查询订单详情
     *
     * @param string $orderSn
     * @param int $queryOrderType
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function orderDetailGet(string $orderSn, int $queryOrderType = 0)
    {
        return $this->request('pdd.ddk.order.detail.get',
            array_merge(
                [
                    'order_sn' => $orderSn,
                ],
                $queryOrderType ? ['query_order_type' => $queryOrderType] : []
            )
        );
    }

    /**
     * 最后更新时间段增量同步推广订单信息
     *
     * @param int $startUpdateTime
     * @param int $endUpdateTime
     * @param array $data
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function orderListIncrementGet(int $startUpdateTime, int $endUpdateTime, array $data = [])
    {
        return $this->request('pdd.ddk.order.list.increment.get',
            array_merge(
                [
                    'start_update_time' => $startUpdateTime,
                    'end_update_time' => $endUpdateTime
                ],
                $data
            )
        );
    }

    /**
     * 用时间段查询推广订单接口
     *
     * @param string $startTime
     * @param string $endTime
     * @param array $data
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function orderListRangeGet(string $startTime, string $endTime, array $data = [])
    {
        return $this->request('pdd.ddk.order.list.range.get',
            array_merge(
                [
                    'start_time' => $startTime,
                    'end_time' => $endTime
                ],
                $data
            )
        );
    }

    /**
     * 批量绑定推广位的媒体id
     *
     * @param int $mediaId
     * @param array $pidList
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function mediaBind(int $mediaId, array $pidList)
    {
        return $this->request('pdd.ddk.pid.mediaid.bind', ['media_id' => $mediaId, 'pid_list' => $pidList]);
    }

    /**
     * 生成多多进宝频道推广
     *
     * @param string $pid
     * @param array $data
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function resourceUrlGen(string $pid, array $data = [])
    {
        return $this->request('pdd.ddk.resource.url.gen', array_merge(['pid' => $pid], $data));
    }

    /**
     * 生成营销工具推广链接
     *
     * @param array $pidList
     * @param array $data
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function rpPromUrlGenerate(array $pidList, array $data = [])
    {
        return $this->request('pdd.ddk.rp.prom.url.generate', array_merge(['p_id_list' => $pidList], $data));
    }

    /**
     * 多多客获取爆款排行商品接口
     *
     * @param array $data
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function topGoodsListQuery(array $data = [])
    {
        return $this->request('pdd.ddk.top.goods.list.query', $data);
    }
}
